<?php
/**
 * Hooks for EtherEditor extension
 *
 * @file
 * @ingroup Extensions
 */

class EtherEditorHooks {
	/**
	 * Abstraction of all possible ways to enable the EtherEditor
	 *
	 * @since 0.1.0
	 *
	 * @param OutputPage $output
	 * @param User $user
	 * @return boolean
	 */
	protected static function isUsingEther( $output, $user ) {
		return ( $user->isLoggedIn()
			&& ( $user->getBoolOption( 'ethereditor_enableether' )
			|| $output->getRequest()->getCheck( 'enableether' ) ) );
	}

	/**
	 * Check whether there are other editing sessions happening on this page
	 *
	 * @since 0.2.3
	 *
	 * @param Title $title
	 * @return boolean
	 */
	protected static function areOthersUsingEther( $title ) {
		$epPad = EtherEditorPad::newFromNameAndText( $title->getPrefixedURL(), '' );
		if ( $epPad->getOtherPads() ) {
			return true;
		}
		return false;
	}

	/**
	 * ArticleSaveComplete hook
	 *
	 * @since 0.0.1
	 *
	 * @param Article $article needed to find the title
	 * @param User $user
	 * @param string $text
	 * @param string $summary
	 * @param boolean $minoredit
	 * @param boolean $watchthis
	 * @param $sectionanchor deprecated
	 * @param integer $flags
	 * @param Revision $revision
	 * @param Status $status
	 * @param integer $baseRevId need this to find the padId
	 * @param boolean $redirect
	 *
	 * @return bool true
	 */
	public static function saveComplete( &$article, &$user, $text, $summary, $minoredit,
		$watchthis, $sectionanchor, &$flags, $revision, &$status, $baseRevId ) {
		global $wgOut;
		if ( self::isUsingEther( $wgOut, $user ) ) {
			$dbId = $output->getRequest()->getInt( 'dbId' );
			$epClient = EtherEditorPad::getEpClient();
			$epPad = EtherEditorPad::newFromId( $dbId );

			$groupId = $epPad->getGroupId();
			$sessions = $epClient->listSessionsOfGroup( $groupId );
			$authorId = $epClient->createAuthorIfNotExistsFor( $user->getId(), $user->getName() )->authorID;
			foreach ( (array) $sessions as $sess => $sinfo ) {
				if ( $sinfo->authorID == $authorId ) {
					$epClient->deleteSession( $sess );
				}
			}
		}
		return true;
	}

	/**
	 * EditPage::showEditForm:initial hook
	 *
	 * Adds the modules to the edit form
	 * Creates an etherpad if necessary
	 *
	 * @since 0.0.1
	 *
	 * @param EditPage $editPage page being edited
	 * @param OutputPage $output output for the edit page
	 *
	 * @return bool true
	 */
	public static function editPageShowEditFormInitial( $editPage, $output ) {
		global $wgEtherpadConfig, $wgUser, $wgLocalTZoffset;

		if ( self::isUsingEther( $output, $wgUser ) ) {
			$apiPort = $wgEtherpadConfig['apiPort'];
			$apiHost = $wgEtherpadConfig['apiHost'];

			$title = $editPage->getTitle();
			$text = $editPage->getContent();
			$padId = $title->getPrefixedURL();
			if ( $text || $title->exists() ) {
				$baseRev = $editPage->getBaseRevision();
				if ( $baseRev ) {
					$baseRevId = $baseRev->getId();
				}
			} else {
				if ( $text == false )  {
					$text = '';
				}
				$baseRevId = 0;
			}

			$epPad = EtherEditorPad::newFromNameAndText( $padId, $text, $baseRevId );
			if ( $epPad->getBaseRevision() < $baseRevId ) {
				$epClient = EtherEditorPad::getEpClient();
				if ( $epClient->padUsersCount( $epPad->getEpId() )->padUsersCount == 0 ) {
					$epClient->setText( $epPad->getEpId(), $text );
				} else {
					// TODO: Handle this properly. How? We don't know.
					// This is where we should fork off the old pad, hopefully without
					// Etherpad Lite.
					// disconnecting users. That may not be possible with the current
				}
			}
			$sessionId = $epPad->authenticateUser( $wgUser );

			$output->addJsConfigVars( array(
				'wgEtherEditorDbId' => $epPad->getId(),
				'wgEtherEditorOtherPads' => $epPad->getOtherPads(),
				'wgEtherEditorApiHost' => $apiHost,
				'wgEtherEditorApiPort' => $apiPort,
				'wgEtherEditorPadUrl' => $wgEtherpadConfig['pUrl'],
				'wgEtherEditorPadName' => $epPad->getEpId(),
				'wgEtherEditorSessionId' => $sessionId ) );
			$output->addModules( 'ext.etherEditor' );
		} else if ( $wgUser->getBoolOption( 'ethereditor_enableether' )
			|| $output->getRequest()->getCheck( 'enableether' ) ) {
			throw new UserNotLoggedIn( 'ethereditor-cannot-nologin' );
		} else if ( self::areOthersUsingEther( $editPage->getTitle() ) ) {
			$output->addJsConfigVars( array(
				'wgEtherEditorOthersUsing' => true
			) );
			$output->addModules( 'ext.etherEditorWarn' );
		}

		return true;
	}

	/**
	 * GetPreferences hook
	 *
	 * Adds EtherEditor-releated items to the preferences
	 *
	 * @param $user User current user
	 * @param $preferences array list of default user preference controls
	 *
	 * @return bool true
	 */
	public static function getPreferences( $user, array &$preferences ) {
		$preferences['ethereditor_enableether'] = array(
			'type' => 'check',
			'label-message' => 'ethereditor-prefs-enable-ether',
			'section' => 'editing/advancedediting'
		);
		return true;
	}
	/**
	 * Schema update to set up the needed database tables.
	 *
	 * @since 0.1.0
	 *
	 * @param DatabaseUpdater $updater
	 *
	 * @return bool true
	 */
	public static function onSchemaUpdate( $updater = null ) {
		$updater->addExtensionTable( 'ethereditor_pads', dirname( __FILE__ ) . '/sql/EtherEditor.sql' );

		// Add the group_id field
		$updater->addExtensionUpdate( array( 'addField', 'ethereditor_pads', 'group_id',
			dirname( __FILE__ ) . '/sql/AddGroupId.patch.sql', true ) );

		// Add the admin field
		$updater->addExtensionUpdate( array( 'addField', 'ethereditor_pads', 'admin_user',
			dirname( __FILE__ ) . '/sql/AddAdminField.patch.sql', true ) );

		// Add the kicked field
		$updater->addExtensionUpdate( array( 'addField', 'ethereditor_contribs', 'kicked',
			dirname( __FILE__ ) . '/sql/AddKickedField.patch.sql', true ) );

		// Add the is_old field
		$updater->addExtensionUpdate( array( 'addField', 'ethereditor_pad', 'base_revision',
			dirname( __FILE__ ) . '/sql/AddBaseRevision.patch.sql', true ) );

		return true;
	}

	/**
	 * Hook to add a link to the top bar.
	 *
	 * @since 0.1.0
	 *
	 * @param $skin Skin
	 * @param $links array the list of links
	 *
	 * @return bool true
	 */
	public static function onSkinTemplateNavigation (&$skin, &$links) {
		$title = $skin->getTitle();
		$links['views']['collaborate'] = array(
			'class' => false,
			'text' => wfMessage( 'ethereditor-collaborate-button')->text(),
			'href' => $title->getLocalUrl( 'action=edit&enableether=true' )
		);
		return true;
	}
}

