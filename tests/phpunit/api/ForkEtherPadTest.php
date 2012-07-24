<?php
/**
 * Test API module to fork Etherpad instances
 *
 * @file ForkEtherPadTest.php
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

class ForkEtherPadTest extends EtherEditorApiTestCase {
	function testForkOccursWithRightText() {
		global $wgUser;

		$testText = 'If a fork is created with this text, the test will pass!';
		$epPad = EtherEditorPad::newFromNameAndText( $this->nameOfPad, $testText, 0, false );

		$data = $this->doApiRequest( array(
			'action' => 'ForkEtherPad',
			'padId' => $epPad->getId()
		) );

		$this->assertArrayHasKey( 'ForkEtherPad', $data[0] );
		$this->assertArrayHasKey( 'padId', $data[0]['ForkEtherPad'] );
		$this->assertArrayHasKey( 'dbId', $data[0]['ForkEtherPad'] );
		$this->assertArrayHasKey( 'sessionId', $data[0]['ForkEtherPad'] );

		$dbId = $data[0]['ForkEtherPad']['dbId'];
		$this->assertPadExists( $dbId );
		$this->assertPadHasText( $dbId, $testText );
		$this->assertIsAdmin( $dbId, $wgUser );

		$epPad->deleteFromDB();
	}
}
