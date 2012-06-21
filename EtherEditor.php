<?php
/**
 * EtherEditor extension
 * 
 * @file
 * @ingroup Extensions
 * 
 * @author Neil Kandalgaonkar <neilk@wikimedia.org>
 * @author Mark Holmquist <mtraceur@member.fsf.org>
 * @license GPL v2 or later
 * @version 0.1.0
 */
 

/* Setup */

$wgExtensionCredits['other'][] = array(
	'path' => __FILE__,
	'name' => 'EtherEditor',
	'author' => array( 'Neil Kandalgaonkar', 'Mark Holmquist' ),
	'version' => '0.1.0',
	'url' => 'https://www.mediawiki.org/wiki/Extension:EtherEditor',
	'descriptionmsg' => 'ethereditor-desc',
);
$dir = dirname( __FILE__ );

$wgAutoloadClasses['EtherEditorHooks'] = $dir . '/EtherEditorHooks.php';
$wgAutoloadClasses['EtherEditorPad'] = $dir) . '/includes/EtherEditorpad.php';
$wgAutoloadClasses['EtherpadLiteClient'] = $dir . '/EtherpadLiteClient.php';
$wgAutoloadClasses['ApiEtherEditor'] = $dir . '/ApiEtherEditor.php';

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
		'scripts' => 'ext.etherEditor.js',
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

$wgAPIModules['ApiEtherEditor'] = 'ApiEtherEditor';

