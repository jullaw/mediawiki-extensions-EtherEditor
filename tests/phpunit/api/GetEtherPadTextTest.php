<?php
/**
 * API module to export data from Etherpad instances
 *
 * @file GetEtherPadTextTest.php
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

class GetEtherPadTextTest extends EtherEditorApiTestCase {
	function testTextGetsReturned() {
		$testText = 'If this text gets properly returned from the server, this test will pass!';
		$epPad = EtherEditorPad::newFromNameAndText( $this->nameOfPad, $testText, 0, false );

		$data = $this->doApiRequest( array(
			'action' => 'GetEtherPadText',
			'padId' => $epPad->getId()
		) );

		$this->assertArrayHasKey( 'GetEtherPadText', $data[0] );
		$this->assertArrayHasKey( 'text', $data[0]['GetEtherPadText'] );

		$this->assertEquals(
			$testText,
			trim( $data[0]['GetEtherPadText']['text'] )
		);
	}
}
