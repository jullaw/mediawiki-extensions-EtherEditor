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
	 * @returns boolean
	 */
	protected static function isUsingEther( $output, $user ) {
		return ( $user->isLoggedIn()
			&& ( $user->getBoolOption( 'ethereditor_enableether' )
			|| $output->getRequest()->getCheck( 'enableether' ) ) );
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
	 */
	public static function saveComplete( &$article, &$user, $text, $summary, $minoredit,
		$watchthis, $sectionanchor, &$flags, $revision, &$status, $baseRevId ) {
		global $wgOut;
		if ( self::isUsingEther( $wgOut, $user ) ) {
			global $wgUser, $wgEtherpadConfig;
			$apiBackend = $wgEtherpadConfig['apiBackend'];
			$apiPort = $wgEtherpadConfig['apiPort'];
			$apiBaseUrl = $wgEtherpadConfig['apiUrl'];
			$apiUrl = 'http://' . $apiBackend . ':' . $apiPort . $apiBaseUrl;
			$apiKey = $wgEtherpadConfig['apiKey'];
			$epClient = new EtherpadLiteClient( $apiKey, $apiUrl );

			$title = $article->getTitle();

			$padId = $title->getPrefixedURL();
			$epPad = EtherEditorPad::newFromNameAndText( $padId, $text );

			$groupId = $epPad->getGroupId();
			$groupPadId = $groupId . '$' . $padId;
			$sessions = $epClient->listSessionsOfGroup( $groupId );
			$hasSession = false;
			$userId = $wgUser->getId();
			$authorId = $epClient->createAuthorIfNotExistsFor( $userId, $wgUser->getName() )->authorID;
			foreach ( (array) $sessions as $sess => $sinfo ) {
				if ( $sinfo->authorID == $authorId ) {
					$epClient->deleteSession( $sess );
				} else {
					$hasSession = true;
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
	 * @param $editPage page being edited
	 * @param $output output for the edit page
	 */
	public static function editPageShowEditFormInitial( $editPage, $output ) {
		global $wgOut, $wgEtherpadConfig, $wgUser;

		if ( self::isUsingEther( $output, $wgUser ) ) {
			$apiHost = $wgEtherpadConfig['apiHost'];
			$apiBackend = $wgEtherpadConfig['apiBackend'];
			$apiPort = $wgEtherpadConfig['apiPort'];
			$apiBaseUrl = $wgEtherpadConfig['apiUrl'];
			$apiUrl = 'http://' . $apiBackend . ':' . $apiPort . $apiBaseUrl;
			$apiKey = $wgEtherpadConfig['apiKey'];
			$epClient = new EtherpadLiteClient( $apiKey, $apiUrl );

			$title = $editPage->getTitle();
			$text = $editPage->getContent();
			$padId = $title->getPrefixedURL();

			$epPad = EtherEditorPad::newFromNameAndText( $padId, $text );
			$sessionId = $epPad->authenticateUser( $wgUser );

			$output->addJsConfigVars( array(
				'wgEtherEditorDbId' => $epPad->getId(),
				'wgEtherEditorOtherPads' => $epPad->getOtherPads(),
				'wgEtherEditorApiHost' => $apiHost,
				'wgEtherEditorApiPort' => $apiPort,
				'wgEtherEditorApiBaseUrl' => $apiBaseUrl,
				'wgEtherEditorPadUrl' => $wgEtherpadConfig['pUrl'],
				'wgEtherEditorPadName' => $epPad->getEpId(),
				'wgEtherEditorSessionId' => $sessionId ) );
			$wgOut->addModules( 'ext.etherEditor' );
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
	 * @return true
	 */
	public static function onSchemaUpdate( $updater = null ) {
		$updater->addExtensionTable( 'ethereditor_pads', dirname( __FILE__ ) . '/EtherEditor.sql' );

		// Add the group_id field
		$updater->addExtensionUpdate( array( 'addField', 'ethereditor_pads', 'group_id',
			dirname( __FILE__ ) . '/EtherEditor.patch.sql', true ) );

		return true;
	}

	/**
	 * Hook to add a link to the top bar.
	 *
	 * @since 0.1.0
	 *
	 * @param $sktemplate
	 * @param $links the list of links
	 *
	 * @return true
	 */
	public static function onSkinTemplateNavigation (&$skin, &$links) {
		global $wgUser;
		if ( $wgUser->isLoggedIn() ) {
			$title = $skin->getTitle();
			$links['views']['collaborate'] = array(
				'class' => false,
				'text' => wfMessage( 'ethereditor-collaborate-button')->text(),
				'href' => $title->getLocalUrl( 'action=edit&enableether=true' )
			);
		}
		return true;
	}
}

