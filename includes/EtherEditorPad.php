<?php

/**
 * Class that represents a single pad.
 *
 * @file
 * @ingroup Extensions
 *
 * @since 0.1.0
 *
 * @license GNU GPL v2+
 * @author Mark Holmquist < mtraceur@member.fsf.org >
 */

/**
 * Utility function for converting a database result to an array for JSON
 *
 * @since 0.2.2
 *
 * @param ResultWrapper $result the result object
 *
 * @return array an array of associative arrays of the results
 */
function resToArray( $result ) {
	$arr = array();
	foreach ( $result as $row ) {
		$arr[] = $row;
	}
	return $arr;
}

class EtherEditorPad {

	/**
	 * The ID of the pad.
	 * Either this matched a record in the ethereditor_pads table or is null.
	 *
	 * @since 0.1.0
	 * @var integer or null
	 */
	protected $id;

	/**
	 * The etherpad-generated ID of the pad.
	 * This name is used when we need to access the pad via the API.
	 *
	 * @since 0.1.0
	 * @var string
	 */
	protected $epid;

	/**
	 * The etherpad-generated group ID for this pad.
	 * This is used to authenticate users, so it's good to keep it around.
	 *
	 * @since 0.2.0
	 * @var string
	 */
	protected $groupId;

	/**
	 * The admin of this pad.
	 *
	 * @since 0.2.2
	 * @var string
	 */
	protected $adminUser;

	/**
	 * Whether the pad is public or not.
	 *
	 * @since 0.1.0
	 * @var boolean
	 */
	protected $publicPad;

	/**
	 * Create a new pad.
	 *
	 * @since 0.1.0
	 *
	 * @param integer $id
	 * @param integer $epid
	 * @param string  $groupId
	 * @param string  $pageTitle
	 * @param boolean $publicPad
	 */
	public function __construct( $id, $epid, $groupId, $pageTitle, $adminUser, $publicPad ) {
		$this->id = $id;
		$this->epid = $epid;
		$this->groupId = $groupId;
		$this->pageTitle = $pageTitle;
		$this->adminUser = $adminUser;
		$this->publicPad = $publicPad;
		$this->writeToDB();
	}

	/**
	 * Returns an EtherpadLiteClient from the current $wgEtherPadConfig values
	 *
	 * @since 0.2.3
	 *
	 * @return EtherpadLiteClient
	 */
	public static function getEpClient() {
		$apiBackend = $wgEtherpadConfig['apiBackend'];
		$apiPort = $wgEtherpadConfig['apiPort'];
		$apiBaseUrl = $wgEtherpadConfig['apiUrl'];
		$apiUrl = 'http://' . $apiBackend . ':' . $apiPort . $apiBaseUrl;
		$apiKey = $wgEtherpadConfig['apiKey'];
		return new EtherpadLiteClient( $apiKey, $apiUrl );
	}

	/**
	 * Returns the public pad with specified title,
	 * or a new pad with the specified text if there is no such pad.
	 *
	 * @since 0.2.0
	 *
	 * @param string $pageTitle
	 * @param string $text
	 *
	 * @return EtherEditorPad
	 */
	public static function newFromNameAndText( $pageTitle, $text ) {
		return self::newFromDB( array(
			'page_title' => $pageTitle,
			'public_pad' => 1
		), $text );
	}

	/**
	 * Returns a new pad with the same text as the old pad.
	 *
	 * @since 0.2.0
	 *
	 * @param string $padId the ID for the old pad
	 * @param User $user the user who will be administrator
	 *
	 * @return EtherEditorPad
	 */
	public static function newFromOldPadId( $padId, $user ) {
		$oldPad = self::newFromId( $padId );
		return self::newFromDB( array(
			'pad_id' => -1,
			'page_title' => $oldPad->getPageTitle(),
			'admin_user' => $user->getName(),
			'public_pad' => 1
		), $oldPad->getText() );
	}

	/**
	 * Returns the pad with specified ID, or false if there is no such pad.
	 *
	 * @since 0.1.0
	 *
	 * @param integer $id
	 *
	 * @return EtherEditorPad or false
	 */
	public static function newFromId( $id ) {
		return self::newFromDB( array( 'pad_id' => $id ) );
	}

	/**
	 * Returns a new instance of EtherEditorPad built from a database result
	 * obtained by doing a select with the provided conditions on the pads table.
	 * If no pad matches the conditions and the conditions cannot be artifically
	 * met, false will be returned.
	 *
	 * @since 0.1.0
	 *
	 * @param array $conditions the stuff to put into the database
	 * @param string $text the text to put into the pad right away
	 *
	 * @return EtherEditorPad or false
	 */
	protected static function newFromDB( array $conditions, $text='' ) {
		$dbr = wfGetDB( DB_SLAVE );

		$pad = $dbr->selectRow(
			'ethereditor_pads',
			array(
				'pad_id',
				'ep_pad_id',
				'group_id',
				'page_title',
				'admin_user',
				'public_pad'
			),
			$conditions
		);

		if ( !$pad ) {
			$conditions['extra_title'] = '';
			if ( isset( $conditions['pad_id'] ) && $conditions['pad_id'] == -1 ) {
				unset( $conditions['pad_id'] );
				$conditions['extra_title'] = time();
			}
			return self::newRemotePad( $conditions, $text );
		}

		return new self(
			$pad->pad_id,
			$pad->ep_pad_id,
			$pad->group_id,
			$pad->page_title,
			$pad->admin_user,
			$pad->public_pad
		);
	}

	/**
	 * Makes a new remote pad.
	 *
	 * @since 0.1.0
	 *
	 * @param array $conditions the stuff to put into the database
	 * @param string $text the text to put into the pad right away
	 *
	 * @return EtherEditorPad or false
	 */
	protected static function newRemotePad( $conditions, $text='' ) {
		$padId = $conditions['page_title'] . $conditions['extra_title'];

		$epClient = self::getEpClient();
		$groupId = $epClient->createGroupIfNotExistsFor( $padId )->groupID;
		try {
			$epClient->createGroupPad( $groupId, $padId, $text );
		} catch ( Exception $e ) {
			// this is just because the pad already exists, probably nothing to worry about
		}
		if ( !isset( $conditions['admin_user'] ) ) {
			$conditions['admin_user'] = '';
		}
		return new self(
			null,
			$groupId . '$' . $padId,
			$groupId,
			$conditions['page_title'],
			$conditions['admin_user'],
			$conditions['public_pad']
		);
	}

	/**
	 * Authenticates a user to the group.
	 * Also adds them to the list of collaborators in the database
	 *
	 * @since 0.2.0
	 *
	 * @param User the user to authenticate
	 *
	 * @return sessionId or false
	 */
	public function authenticateUser( $user ) {
		if ( !$this->isKicked( $user ) ) {
			$epClient = self::getEpClient();
			$authorId = $epClient->createAuthorIfNotExistsFor( $user->getId(), $user->getName() )->authorID;

			$this->addToContribs( $user->getName(), $authorId );

			return $epClient->createSession( $this->groupId, $authorId, time() + 3600 )->sessionID;
		}
		return false;
	}

	/**
	 * Kicks a user from the pad.
	 * Also removes them from the list of collaborators in the database
	 *
	 * @since 0.2.2
	 *
	 * @param User the user doing the kicking
	 * @param User the user to kick
	 *
	 * @return sessionId or false
	 */
	public function kickUser( $user, $kickuser ) {
		$isAdmin = $this->isAdmin( $user );
		if ( $isAdmin ) {
			if ( !$kickuser || $this->isKicked( $kickuser ) ) {
				return true;
			}
			$epClient = self::getEpClient();
			$authorId = $epClient->createAuthorIfNotExistsFor( $kickuser->getId(), $kickuser->getName() )->authorID;
			$sessions = (array) $epClient->listSessionsOfAuthor( $authorId );
			foreach ( $sessions as $sid => $sess ) {
				if ( $sess->groupID == $this->groupId ) {
					$epClient->deleteSession( $sid );
				}
			}

			$this->removeFromContribs( $kickuser->getName() );
		}
		return $isAdmin; // The user not being admin is the only possible error
	}

	/**
	 * Check whether a user is admin
	 *
	 * @since 0.2.2
	 *
	 * @param User the user to check
	 *
	 * @return boolean
	 */
	protected function isAdmin( $user ) {
		return $this->adminUser == $user->getName();
	}

	/**
	 * Check whether a user is kicked
	 *
	 * @since 0.2.2
	 *
	 * @param User the user to check
	 *
	 * @return boolean
	 */
	protected function isKicked( $user ) {
		$dbr = wfGetDB( DB_SLAVE );
		$contrib = $dbr->selectField(
			'ethereditor_contribs',
			'kicked',
			array(
				'pad_id' => $this->id,
				'username' => $user->getName()
			)
		);
		return $contrib != 0;
	}

	/**
	 * Adds a user to the list of contributors
	 *
	 * @since 0.2.1
	 *
	 * @param string the username to add
	 * @param string the authorId returned by Etherpad
	 *
	 * @return boolean success indicator
	 */
	protected function addToContribs( $username, $authorId ) {
		$dbr = wfGetDB( DB_SLAVE );
		$contrib = $dbr->selectRow(
			'ethereditor_contribs',
			array(
				'contrib_id',
				'username'
			),
			array(
				'pad_id' => $this->id,
				'username' => $username
			)
		);

		if ( !$contrib ) {
			$dbw = wfGetDB( DB_MASTER );

			return $dbw->insert(
				'ethereditor_contribs',
				array(
					'pad_id' => $this->id,
					'username' => $username,
					'ep_user_id' => $authorId,
					'has_contributed' => 1
				),
				__METHOD__
			);
		}
		return true;
	}

	/**
	 * Removes a user from the list of contributors
	 *
	 * @since 0.2.2
	 *
	 * @param string the username to remove
	 * @param string the authorId returned by Etherpad
	 *
	 * @return boolean success indicator
	 */
	protected function removeFromContribs( $username ) {
		$dbw = wfGetDB( DB_MASTER );

		$d1 = $dbw->update(
			'ethereditor_contribs',
			array(
				'kicked' => 1
			),
			array(
				'pad_id' => $this->id,
				'username' => $username
			),
			__METHOD__
		);

		return $d1;
	}

	/**
	 * Returns the ID of the pad.
	 *
	 * @since 0.1.0
	 *
	 * @return integer
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * Returns the Etherpad-generated ID of the pad.
	 *
	 * @since 0.1.0
	 *
	 * @return string
	 */
	public function getEpId() {
		return $this->epid;
	}

	/**
	 * Returns the title of the page being edited in the pad.
	 *
	 * @since 0.1.0
	 *
	 * @return string
	 */
	public function getPageTitle() {
		return $this->pageTitle;
	}

	/**
	 * Returns if the pad is public.
	 *
	 * @since 0.1.0
	 *
	 * @return boolean
	 */
	public function getIsPublic() {
		return $this->publicPad;
	}

	/**
	 * Returns the group ID for the pad.
	 *
	 * @since 0.1.0
	 *
	 * @return boolean
	 */
	public function getGroupId() {
		return $this->groupId;
	}

	/**
	 * Returns the text of the pad.
	 *
	 * @since 0.2.0
	 *
	 * @return string the text of the pad
	 */
	public function getText() {
		global $wgEtherpadConfig;
		$padId = $this->epid;
		$groupId = $this->groupId;
		$epClient = self::getEpClient();
		return $epClient->getText( $padId )->text;
	}

	/**
	 * Write the pad to the DB.
	 * If it's already there, it'll be updated, else it'll be inserted.
	 *
	 * @since 0.1.0
	 *
	 * @return boolean Success indicator
	 */
	public function writeToDB() {
		if ( is_null( $this->id ) ) {
			return $this->insertIntoDB();
		}
		else {
			return $this->updateInDB();
		}
	}

	/**
	 * Insert the pad into the DB.
	 *
	 * @since 0.1.0
	 *
	 * @return boolean Success indicator
	 */
	protected function insertIntoDB() {
		$dbw = wfGetDB( DB_MASTER );

		$success = $dbw->insert(
			'ethereditor_pads',
			array(
				'ep_pad_id' => $this->epid,
				'group_id' => $this->groupId,
				'page_title' => $this->pageTitle,
				'admin_user' => $this->adminUser,
				'public_pad' => $this->publicPad,
			),
			__METHOD__,
			array( 'pad_id' => $this->id )
		);

		if ( $success ) {
			$this->id = $dbw->insertId();
		}

		return $success;
	}

	/**
	 * Update the pad in the DB.
	 *
	 * @since 0.1.0
	 *
	 * @return boolean Success indicator
	 */
	protected function updateInDB() {
		$dbw = wfGetDB( DB_MASTER );

		$success = $dbw->update(
			'ethereditor_pads',
			array(
				'ep_pad_id' => $this->epid,
				'group_id' => $this->groupId,
				'page_title' => $this->pageTitle,
				'admin_user' => $this->adminUser,
				'public_pad' => $this->publicPad,
			),
			array( 'pad_id' => $this->id ),
			__METHOD__
		);

		return $success;
	}

	/**
	 * Delete the pad from the DB (when present).
	 *
	 * @since 0.1.0
	 *
	 * @return boolean Success indicator
	 */
	public function deleteFromDB() {
		if ( is_null( $this->id ) ) {
			return true;
		}

		$dbw = wfGetDB( DB_MASTER );

		$d1 = $dbw->delete(
			'ethereditor_pads',
			array( 'pad_id' => $this->id ),
			__METHOD__
		);

		return $d1;
	}

	/**
	 * Get other pads for this page, if they exist
	 *
	 * @since 0.2.0
	 *
	 * @return array Array of pad IDs
	 */
	public function getOtherPads() {
		$dbr = wfGetDB( DB_SLAVE );

		return resToArray( $dbr->select(
			'ethereditor_pads',
			array(
				'pad_id',
				'ep_pad_id',
				'admin_user',
				'group_id'
			),
			array(
				'pad_id <> ' . $this->id,
				'page_title' => $this->pageTitle,
				'public_pad' => '1'
			),
			__METHOD__
		) );
	}

	/**
	 * Get the current list of contributors to this pad. Could be big!
	 *
	 * @since 0.2.1
	 *
	 * @return array Array of contributors
	 */
	public function getContribs() {
		$dbr = wfGetDB( DB_SLAVE );

		return resToArray( $dbr->select(
			'ethereditor_contribs',
			array(
				'contrib_id',
				'username'
			),
			array(
				'pad_id' => $this->id,
				'has_contributed' => 1
			),
			__METHOD__
		) );
	}
}
