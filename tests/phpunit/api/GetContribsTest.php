<?php
/**
 * Test API module to get the contributors to a pad
 *
 * @file GetContribsTest.php
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

class GetContribsTest extends EtherEditorApiTestCase {
	function testContribsGet() {
		global $wgMetaNamespace, $wgUser;

		$epPad = EtherEditorPad::newFromNameAndText( $this->nameOfPad, '', 0, false );
		$epPad->authenticateUser( $wgUser->getName(), $wgUser->getId() );
		$epPad->authenticateUser( 'helper', 50 );

		$data = $this->doApiRequest( array(
			'action' => 'GetContribs',
			'padId' => $epPad->getId()
		) );

		$this->assertArrayHasKey( 'GetContribs', $data[0] );
		$this->assertArrayHasKey( 'contribs', $data[0]['GetContribs'] );

		$contribs = array();
		foreach ( $data[0]['GetContribs']['contribs'] as $contrib ) {
			$contribs[] = $contrib->username;
		}

		$this->assertContains( $wgUser->getName(), $contribs );
		$this->assertContains( 'helper', $contribs );
		$this->assertNotContains( 'spammer', $contribs );

		$epPad->deleteFromDB();
	}
}
