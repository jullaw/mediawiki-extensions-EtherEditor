<?php
/**
 * EtherEditor extension
 *
 * @file
 * @ingroup Extensions
 *
 * @author Mark Holmquist <mtraceur@member.fsf.org>
 * @license GPL v2 or later
 * @version 0.2.1
 */


/* Setup */

$wgExtensionCredits['other'][] = array(
	'path' => __FILE__,
	'name' => 'EtherEditor',
	'author' => array( 'Mark Holmquist' ),
	'version' => '0.2.1',
	'url' => 'https://www.mediawiki.org/wiki/Extension:EtherEditor',
	'descriptionmsg' => 'ethereditor-desc',
);
$dir = dirname( __FILE__ );

$wgAutoloadClasses['EtherEditorHooks'] = $dir . '/EtherEditorHooks.php';
$wgAutoloadClasses['EtherEditorPad'] = $dir . '/includes/EtherEditorPad.php';
$wgAutoloadClasses['EtherpadLiteClient'] = $dir . '/includes/EtherpadLiteClient.php';
$wgAutoloadClasses['GetEtherPadText'] = $dir . '/api/GetEtherPadText.php';
$wgAutoloadClasses['ForkEtherPad'] = $dir . '/api/ForkEtherPad.php';
$wgAutoloadClasses['EtherPadAuth'] = $dir . '/api/EtherPadAuth.php';
$wgAutoloadClasses['GetContribs'] = $dir . '/api/GetContribs.php';
$wgAutoloadClasses['KickFromPad'] = $dir . '/api/KickFromPad.php';

$etherEditorTpl = array(
	'localBasePath' => $dir . '/modules',
	'remoteExtPath' => 'EtherEditor/modules',
	'group' => 'ext.etherEditor',
);

$wgResourceModules += array(
	'jquery.etherpad' => $etherEditorTpl + array(
		'scripts' => 'jquery.etherpad.js',
	),

    'ext.etherEditor' => $etherEditorTpl + array(
		'scripts' => array(
			'ext.etherEditor.js',
		),
		'messages' => array(
			'ethereditor-fork-button',
			'ethereditor-contrib-button',
			'ethereditor-kick-button',
		),
		'dependencies' => array(
			'jquery.etherpad',
			'jquery.cookie',
		)
	)
);

$wgExtensionMessagesFiles['WikiEditor'] = $dir . '/EtherEditor.i18n.php';
$wgHooks['LoadExtensionSchemaUpdates'][] = 'EtherEditorHooks::onSchemaUpdate';
$wgHooks['EditPage::showEditForm:initial'][] = 'EtherEditorHooks::editPageShowEditFormInitial';
$wgHooks['ArticleSaveComplete'][] = 'EtherEditorHooks::saveComplete';
$wgHooks['GetPreferences'][] = 'EtherEditorHooks::getPreferences';
$wgHooks['SkinTemplateNavigation'][] = 'EtherEditorHooks::onSkinTemplateNavigation';

$wgAPIModules['GetEtherPadText'] = 'GetEtherPadText';
$wgAPIModules['ForkEtherPad'] = 'ForkEtherPad';
$wgAPIModules['EtherPadAuth'] = 'EtherPadAuth';
$wgAPIModules['GetContribs'] = 'GetContribs';
$wgAPIModules['KickFromPad'] = 'KickFromPad';
