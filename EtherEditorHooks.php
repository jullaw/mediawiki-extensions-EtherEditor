<?php
/**
 * Hooks for EtherEditor extension
 * 
 * @file
 * @ingroup Extensions
 */

class EtherEditorHooks {
	/**
	 * ArticleSaveComplete hook
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
		if ( $user->getBoolOption( 'ethereditor_enableether' ) ) {
			global $wgEtherpadConfig;
			$apiUrl = $wgEtherpadConfig['apiUrl'];
			$apiKey = $wgEtherpadConfig['apiKey'];
			$epClient = new EtherpadLiteClient( $apiKey, $apiUrl );

			$title = $article->getTitle();
			$padId = $title->getPrefixedURL() . $baseRevId;
			try {
				$epClient->deletePad( $padId );
			} catch ( Exception $e ) {
				// this is just because the pad doesn't exist, probably nothing to worry about
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
	 * @param $editPage page being edited
	 * @param $output output for the edit page
	 */
	public static function editPageShowEditFormInitial( $editPage, $output ) {
		global $wgOut, $wgEtherpadConfig, $wgUser;

		if ( $wgUser->getBoolOption( 'ethereditor_enableether' ) ) {
			$apiHost = $wgEtherpadConfig['apiHost'];
			$apiUrl = $wgEtherpadConfig['apiUrl'];
			$apiKey = $wgEtherpadConfig['apiKey'];
			$epClient = new EtherpadLiteClient( $apiKey, $apiUrl );
			$userId = $wgUser->getId();

			$title = $editPage->getTitle();
			$text = $editPage->getContent();
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
			$padId = $title->getPrefixedURL() . $baseRevId;
			$authorResult = $epClient->createAuthorIfNotExistsFor( $wgUser->getName(), $userId );
			$authorId = $authorResult->authorID;
			$groupResult = $epClient->createGroupIfNotExistsFor( "editing" );
			$groupId = $groupResult->groupID;
			$sessionResult = $epClient->createSession( $groupId, $authorId, time() + 3600 );
			$sessionId = $sessionResult->sessionID;
			$groupPadId = $groupId . '$' . $padId;
			try {
				$epClient->createGroupPad( $groupId, $padId, $text );
			} catch ( Exception $e ) {
				// this is just because the pad already exists, probably nothing to worry about
			}
			$output->addJsConfigVars( array(
				'wgEtherEditorApiHost' => $apiHost,
				'wgEtherEditorPadName' => $groupPadId,
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
}

?>
