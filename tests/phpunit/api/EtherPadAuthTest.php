<?php
/**
 * Test API module to authenticate user to Etherpad instances
 *
 * @file EtherPadAuthTest.php
 *
 * @group API
 * @group Database
 * @group EtherEditor
 *
 * @since 0.2.5
 *
 * @license GNU GPL v2+
 * @author Mark Holmquist <mtraceur@member.fsf.org>
 */

require_once( 'EtherEditorApiTestCase.php' );

class EtherPadAuthTest extends EtherEditorApiTestCase {

	// Hold an EtherEditorPad for testing
	protected $epPad;

	function setUp() {
		$this->epPad = EtherEditorPad::newFromNameAndText( $this->nameOfPad, '', 0, false );
	}

	function tearDown() {
		$this->epPad->deleteFromDB();
		$this->epPad = null;
	}

	function userHasAuth( $epPad, $uid, $username ) {
		$epClient = EtherEditorPad::getEpClient();

		$initialString = 'The session did not get set';
		$actualSession = $initialString;
		$actualAuthor = $epClient->createAuthorIfNotExistsFor( $uid, $username )->authorID;
		$sessions = $epClient->listSessionsOfGroup( $epPad->getGroupId() );
		if ( !is_null( $sessions ) ) {
			foreach ( $sessions as $key => $value ) {
				if ( $value->authorID == $actualAuthor ) {
					$actualSession = $key;
				}
			}
		}
		return $actualSession != $initialString;
	}

	function testUserDoesNotGetAuthedUsually() {
		global $wgUser;
		$this->assertFalse( $this->userHasAuth( $this->epPad, $wgUser->getId(), $wgUser->getName() ) );
	}

	function testUserGetsAuthed() {
		global $wgUser;

		$data = $this->doApiRequest( array(
			'action' => 'EtherPadAuth',
			'padId' => $this->epPad->getId()
		) );

		$this->assertArrayHasKey( 'EtherPadAuth', $data[0] );
		$this->assertArrayHasKey( 'sessionId', $data[0]['EtherPadAuth'] );

		$this->assertTrue( $this->userHasAuth( $this->epPad, $wgUser->getId(), $wgUser->getName() ) );
	}
}
