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
	'url' => 'http://www.mediawiki.org/wiki/Extension:EtherEditor',
	'descriptionmsg' => 'ethereditor-desc',
);

$wgAutoloadClasses['EtherEditorHooks'] = dirname( __FILE__ ) . '/EtherEditorHooks.php';
$wgAutoloadClasses['EtherEditorPad'] = dirname( __FILE__ ) . '/includes/EtherEditorpad.php';
$wgAutoloadClasses['EtherpadLiteClient'] = dirname( __FILE__ ) . '/EtherpadLiteClient.php';
$wgAutoloadClasses['ApiEtherEditor'] = dirname( __FILE__ ) . '/ApiEtherEditor.php';

$etherEditorTpl = array(
	'localBasePath' => dirname( __FILE__ ) . '/modules',
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

$wgExtensionMessagesFiles['WikiEditor'] = dirname( __FILE__ ) . '/EtherEditor.i18n.php';
$wgHooks['LoadExtensionSchemaUpdates'][] = 'EtherEditorHooks::onSchemaUpdate';
$wgHooks['EditPage::showEditForm:initial'][] = 'EtherEditorHooks::editPageShowEditFormInitial';
$wgHooks['ArticleSaveComplete'][] = 'EtherEditorHooks::saveComplete';
$wgHooks['GetPreferences'][] = 'EtherEditorHooks::getPreferences';
$wgHooks['SkinTemplateNavigation'][] = 'EtherEditorHooks::onSkinTemplateNavigation';

$wgAPIModules['ApiEtherEditor'] = 'ApiEtherEditor';

?>
