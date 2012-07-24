<?php
/**
 * Test API module to kick users from pads
 *
 * @file KickFromPadTest.php
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

class KickFromPadTest extends EtherEditorApiTestCase {
	function assertRequestSucceeds( $dbId, $username ) {
		$data = $this->doApiRequest( array(
			'action' => 'KickFromPad',
			'padId' => $dbId,
			'user' => $username
		) );

		$this->assertArrayHasKey( 'KickFromPad', $data[0] );
		$this->assertArrayHasKey( 'success', $data[0]['KickFromPad'] );
		return $data[0]['KickFromPad']['success'];
	}

	function testKickHappensWithIdealConditions() {
		global $wgUser;

		$kickuser = 'spammer';
		$epPad = EtherEditorPad::newFromNameAndText( $this->nameOfPad, '', 0, false );
		$epFork = EtherEditorPad::newFromOldPadId( $epPad->getId(), $wgUser->getName() );
		$epFork->authenticateUser( $kickuser, 50 );

		$this->assertTrue( $this->assertRequestSucceeds( $epFork->getId(), $kickuser ) );
		$epPad->deleteFromDB();
		$epFork->deleteFromDB();
	}

	function testKickFailsWithoutAdmin() {
		global $wgUser;

		$kickuser = 'spammer';
		$epPad = EtherEditorPad::newFromNameAndText( $this->nameOfPad, '', 0, false );
		$epFork = EtherEditorPad::newFromOldPadId( $epPad->getId(), '' );
		$epFork->authenticateUser( $kickuser, 50 );

		$data = $this->assertRequestSucceeds( $epFork->getId(), $kickuser );

		$this->assertTrue( is_null( $data[0]['KickFromPad']['success'] ) );
		$epPad->deleteFromDB();
		$epFork->deleteFromDB();
	}
}
