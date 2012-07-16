<?php
/**
 * EtherEditor extension
 *
 * @file
 * @ingroup Extensions
 *
 * @author Mark Holmquist <mtraceur@member.fsf.org>
 * @license GPL v2 or later
 * @version 0.3.0
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

foreach ( array(
		'EtherEditorHooks' => '/EtherEditorHooks',
		'EtherEditorPad' => '/includes/EtherEditorPad',
		'EtherpadLiteClient' => '/includes/EtherpadLiteClient',
		'GetEtherPadText' => '/api/GetEtherPadText',
		'ForkEtherPad' => '/api/ForkEtherPad',
		'DeleteEtherPad' => '/api/DeleteEtherPad',
		'EtherPadAuth' => '/api/EtherPadAuth',
		'GetContribs' => '/api/GetContribs',
		'KickFromPad' => '/api/KickFromPad',
		'GetOtherEtherpads' => '/api/GetOtherEtherpads',
		'CreateNewPadFromPage' => '/api/CreateNewPadFromPage',
		'SpecialEtherEditor' => '/includes/special/SpecialEtherEditor',
	) as $module => $path ) {
	$wgAutoloadClasses[$module] = $dir . $path . '.php';
}

$wgSpecialPages['EtherEditor'] = 'SpecialEtherEditor';
$wgSpecialPageGroups['EtherEditor'] = 'pagetools';

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
			'ethereditor-delete-button',
			'ethereditor-summary-message',
		),
		'dependencies' => array(
			'mediawiki.user',
			'jquery.etherpad',
			'jquery.cookie',
		)
	),

	'ext.etherManager' => $etherEditorTpl + array(
		'scripts' => array(
			'ext.etherManager.js',
		),
		'styles' => array(
			'ext.etherManager.css',
		),
		'messages' => array(
			'ethereditor-fork-button',
			'ethereditor-delete-button'
		),
		'dependencies' => array(
			'mediawiki.user',
			'jquery.cookie',
		)
	),

	'ext.etherEditorWarn' => $etherEditorTpl + array(
		'scripts' => array(
			'ext.etherEditorWarn.js',
		),
		'messages' => array(
			'ethereditor-warn-others',
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
$wgAPIModules['DeleteEtherPad'] = 'DeleteEtherPad';
$wgAPIModules['EtherPadAuth'] = 'EtherPadAuth';
$wgAPIModules['GetContribs'] = 'GetContribs';
$wgAPIModules['KickFromPad'] = 'KickFromPad';
$wgAPIModules['GetOtherEtherpads'] = 'GetOtherEtherpads';
$wgAPIModules['CreateNewPadFromPage'] = 'CreateNewPadFromPage';
