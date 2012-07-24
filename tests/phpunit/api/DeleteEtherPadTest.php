<?php
/**
 * Test API module to delete Etherpad forks
 *
 * @file DeleteEtherPadTest.php
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

class DeleteEtherPadTest extends EtherEditorApiTestCase {
	function doRequest( $dbId ) {
		$data = $this->doApiRequest( array(
			'action' => 'DeleteEtherPad',
			'padId' => $dbId
		) );
		$this->assertArrayHasKey( 'DeleteEtherPad', $data[0] );
		$this->assertArrayHasKey( 'authed', $data[0]['DeleteEtherPad'] );
		$this->assertArrayHasKey( 'success', $data[0]['DeleteEtherPad'] );
		return $data;
	}

	function testDeleteHappensWithIdealConditions() {
		global $wgUser;

		$epPad = EtherEditorPad::newFromNameAndText( $this->nameOfPad, '', 0, false );
		$epFork = EtherEditorPad::newFromOldPadId( $epPad->getId(), $wgUser->getName() );

		$data = $this->doRequest( $epFork->getId() );

		$this->assertTrue( $data[0]['DeleteEtherPad']['authed'] );
		$this->assertEquals( $data[0]['DeleteEtherPad']['success'], 1 );
		$epPad->deleteFromDB();
		$this->assertEquals( $epFork->deleteFromDB(), 1 );
	}

	function testDeleteFailsWithoutAdmin() {
		global $wgUser;

		$epPad = EtherEditorPad::newFromNameAndText( $this->nameOfPad, '', 0, false );
		$epFork = EtherEditorPad::newFromOldPadId( $epPad->getId(), '' );

		$data = $this->doRequest( $epFork->getId() );

		$this->assertFalse( $data[0]['DeleteEtherPad']['authed'] );
		$this->assertFalse( $data[0]['DeleteEtherPad']['success'] );
		$epPad->deleteFromDB();
		$this->assertEquals( $epFork->deleteFromDB(), 1 );
	}
}
