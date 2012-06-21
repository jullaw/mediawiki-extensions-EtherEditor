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
	 * The revision off of which the pad is based; could be latest or not.
	 *
	 * @since 0.1.0
	 * @var int
	 */
	protected $baseRevision;

	/**
	 * The article being edited in the pad.
	 *
	 * @since 0.1.0
	 * @var string
	 */
	protected $baseRevision;
	
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
	 * @param string  $pageTitle
	 * @param boolean $baseRevision
	 */
	public function __construct( $id, $epid, $pageTitle, $baseRevision, $publicPad ) {
		$this->id = $id;
		$this->epid = $epid;
		$this->pageTitle = $pageTitle;
		$this->baseRevision = $baseRevision;
		$this->publicPad = $publicPad;
	}

	/**
	 * Returns the public pad with specified title and revision, or a new pad if there is no such pad.
	 *
	 * @since 0.1.0
	 *
	 * @param string $pageTitle
	 * @param integer $baseRevision
	 *
	 * @return EtherEditorPad
	 */
	public static function newFromName( $pageTitle, $baseRevision = 0 ) {
		return self::newFromDB( array(
			'page_title' => $pageTitle,
			'base_revision' => $baseRevision,
			'public_pad' => 1
		) );
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
	 * obtained by doing a select with the provided conditions on the _pads table.
	 * If no pad matches the conditions and the conditions cannot be artifically
	 * met, false will be returned.
	 *
	 * @since 0.1.0
	 *
	 * @param array $conditions
	 *
	 * @return EtherEditorPad or false
	 */
	protected static function newFromDB( array $conditions ) {
		$dbr = wfGetDB( DB_SLAVE );

		$pad = $dbr->selectRow(
			'ethereditor_pads',
			array(
				'pad_id',
				'ep_pad_id',
				'page_title',
				'base_revision',
				'public_pad'
			),
			$conditions
		);

		if ( !$pad ) {
			return self::newRemotePad( $conditions );
		}

		return new self(
			$pad->pad_id,
			$pad->ep_pad_id,
			$pad->page_title,
			$pad->base_revision,
			$pad->public_pad
		);
	}
	
	protected static function newRemotePad( $conditions ) {
		global $wgEtherpadConfig;

		$apiBackend = $wgEtherpadConfig['apiBackend'];
		$apiPort = $wgEtherpadConfig['apiPort'];
		$apiBaseUrl = $wgEtherpadConfig['apiUrl'];
		$apiUrl = 'http://' . $apiBackend . ':' . $apiPort . $apiBaseUrl;
		$apiKey = $wgEtherpadConfig['apiKey'];
		$epClient = new EtherpadLiteClient( $apiKey, $apiUrl );

		
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
	 * Returns the revision being edited in the pad.
	 * 
	 * @since 0.1.0
	 * 
	 * @return string
	 */
	public function getBaseRevision() {
		return $this->baseRevision;
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
				'page_title' => $this->pageTitle,
				'base_revision' => $this->baseRevision,
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
				'page_title' => $this->pageTitle,
				'base_revision' => $this->baseRevision,
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

}
