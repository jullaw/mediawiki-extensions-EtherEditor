<?php
/**
 * Test that the basic requirements for EtherEditor are met
 *
 * @file EtherEditorApiTestCase.php
 *
 * @since 0.2.5
 *
 * @license GNU GPL v2+
 * @author Mark Holmquist <mtraceur@member.fsf.org>
 */

class EtherEditorApiTestCase extends ApiTestCase {
	function setUp() {
		parent::setUp();
		$this->doLogin();
		$this->nameOfPad = strval( time() );
	}

	public function tearDown() {
		unset( $this->nameOfPad );
		parent::tearDown();
	}

	function assertPadExists( $dbId ) {
		$epPad = EtherEditorPad::newFromId( $dbId );
		$this->assertFalse( is_null( $epPad ) );
	}

	function assertPadHasText( $dbId, $padText ) {
		$epPad = EtherEditorPad::newFromId( $dbId );
		$this->assertEquals(
			$padText,
			trim( $epPad->getText() )
		);
	}

	function assertIsAdmin( $dbId, $user ) {
		$epPad = EtherEditorPad::newFromId( $dbId );
		$this->assertTrue(
			$epPad->isAdmin( $user )
		);
	}
}
