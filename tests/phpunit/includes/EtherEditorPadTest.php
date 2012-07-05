<?php
/**
 * Test the main library for dealing with pads.
 *
 * @file EtherEditorPadTest.php
 *
 * @group Database
 *
 * @since 0.2.5
 *
 * @license GNU GPL v2+
 * @author Mark Holmquist <mtraceur@member.fsf.org>
 */

class EtherEditorPadTest extends MediaWikiTestCase {
	function setUp() {
		parent::setUp();
		$this->nameOfPad = strval( time() );
		$this->username = 'user' . $this->nameOfPad;
		$this->uid = time() % 100;
		$this->testText = 'If this is the text in the pad, then everything is good!';
		$this->epPad = EtherEditorPad::newFromNameAndText( $this->nameOfPad, $this->testText, 40, false );
		$this->epClient = EtherEditorPad::getEpClient();
	}

	function tearDown() {
		unset( $this->nameOfPad );
		unset( $this->username );
		unset( $this->uid );
		if ( isset( $this->epClient ) ) unset( $this->epClient );
		if ( isset( $this->epPad ) ) {
			$this->epPad->deleteFromDB();
			unset( $this->epPad );
		}
		parent::tearDown();
	}

	function testCreatePad() {
		$apparentText = trim( $this->epClient->getText( $this->epPad->getEpId() )->text );
		$this->assertEquals( $this->testText, $apparentText );
		$this->assertEquals( $this->testText, trim( $this->epPad->getText() ) );
	}

	function testAuthToPad() {
		$maybeSession = $this->epPad->authenticateUser( $this->username, $this->uid );
		$authorId = $this->epClient->createAuthorIfNotExistsFor( $this->uid, $this->username )->authorID;
		$sessions = $this->epClient->listSessionsOfGroup( $this->epPad->getGroupId() );
		$this->assertObjectHasAttribute( $maybeSession, $sessions );
	}

	function testFetchPad() {
		$maybePad = EtherEditorPad::newFromId( $this->epPad->getId() );
		$this->assertInstanceOf( 'EtherEditorPad', $maybePad );
		$this->assertEquals( $this->testText, trim( $maybePad->getText() ) );
	}

	function testGetters() {
		$this->assertEquals( $this->nameOfPad, $this->epPad->getPageTitle() );
		$this->assertEquals( 40, $this->epPad->getBaseRevision() );
		$this->assertEquals( 1, $this->epPad->getIsPublic() );
	}

	function testForkingAction() {
		$epFork = EtherEditorPad::newFromOldPadId( $this->epPad->getId(), $this->username );
		$this->assertArrayHasKey( 0, $this->epPad->getOtherPads(), "The fork didn't happen, or wasn't reported in the database, or getOtherPads is broken." );
		$this->assertArrayNotHasKey( 1, $this->epPad->getOtherPads() );
		$this->assertEquals( trim( $this->epPad->getText() ), trim( $epFork->getText() ) );
		$this->assertTrue( $epFork->isAdmin( $this->username ) );
		$this->assertTrue( $epFork->kickUser( $this->username, 'doesnotexist', 50 ) );
		$this->assertTrue( $epFork->authenticateUser( 'doesexist', 51 ) != false );
		$this->assertTrue( $epFork->kickUser( $this->username, 'doesexist', 51 ) );
		$this->assertTrue( $epFork->kickUser( $this->username, 'doesexist', 51 ) );
		$this->assertFalse( $epFork->authenticateUser( 'doesexist', 51 ) );
		$this->epClient->deletePad( $epFork->getEpId() );
		$this->assertEquals( '', $epFork->getText() );
		$this->assertTrue( $epFork->deleteFromDB() );
	}

	function testAutoFork() {
		$epAutoFork = EtherEditorPad::newFromNameAndText( $this->nameOfPad, $this->testText, 42, true );
		$apparentText = trim( $this->epClient->getText( $epAutoFork->getEpId() )->text );
		$this->assertEquals( $this->testText, $apparentText );
		$this->assertEquals( $this->testText, trim( $epAutoFork->getText() ) );
		$this->assertTrue( $epAutoFork->deleteFromDB() );
	}
}
