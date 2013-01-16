<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

t3lib_div::loadTCA('tt_content');

// Setting of backend fields "Bootstrap Helper Classes"
$be_fields = array(
	'tx_aomamebootstrap_direction' => array(		
		'exclude' => 1,		
		'label' => 'LLL:EXT:aomame_bootstrap/locallang_db.xml:tt_content.title_direction',		
		'config' => array(
			'type' => 'select',
			'items' => array(
				array('LLL:EXT:aomame_bootstrap/locallang_db.xml:tt_content.empty_field', '0'),
				array('LLL:EXT:aomame_bootstrap/locallang_db.xml:tt_content.select_direction_left', '1'),
				array('LLL:EXT:aomame_bootstrap/locallang_db.xml:tt_content.select_direction_right', '2'),
			),
			'size' => 1,	
			'maxitems' => 1,
		)
	),
	'tx_aomamebootstrap_alert' => array(		
		'exclude' => 1,		
		'label' => 'LLL:EXT:aomame_bootstrap/locallang_db.xml:tt_content.title_alert',		
		'config' => array(
			'type' => 'select',
			'items' => array(
				array('LLL:EXT:aomame_bootstrap/locallang_db.xml:tt_content.empty_field', '0'),
				array('LLL:EXT:aomame_bootstrap/locallang_db.xml:tt_content.select_alert_success', '1'),
				array('LLL:EXT:aomame_bootstrap/locallang_db.xml:tt_content.select_alert_info', '2'),
				array('LLL:EXT:aomame_bootstrap/locallang_db.xml:tt_content.select_alert_warning', '3'),
				array('LLL:EXT:aomame_bootstrap/locallang_db.xml:tt_content.select_alert_error', '4'),
			),
			'size' => 1,	
			'maxitems' => 1,
		)
	),
	'tx_aomamebootstrap_well' => array(		
		'exclude' => 1,		
		'label' => 'LLL:EXT:aomame_bootstrap/locallang_db.xml:tt_content.title_well',		
		'config' => array(
			'type' => 'select',
			'items' => array(
				array('LLL:EXT:aomame_bootstrap/locallang_db.xml:tt_content.empty_field', '0'),
				array('LLL:EXT:aomame_bootstrap/locallang_db.xml:tt_content.select_well_large', '1'),
				array('LLL:EXT:aomame_bootstrap/locallang_db.xml:tt_content.select_well_small', '2'),
			),
			'size' => 1,	
			'maxitems' => 1,
		)
	),
	'tx_aomamebootstrap_span' => array(		
		'exclude' => 1,		
		'label' => 'LLL:EXT:aomame_bootstrap/locallang_db.xml:tt_content.title_span',		
		'config' => array(
			'type' => 'select',
			'items' => array(
				array('LLL:EXT:aomame_bootstrap/locallang_db.xml:tt_content.empty_field', '0'),
				array('LLL:EXT:aomame_bootstrap/locallang_db.xml:tt_content.select_span_1', '1'),
				array('LLL:EXT:aomame_bootstrap/locallang_db.xml:tt_content.select_span_2', '2'),
				array('LLL:EXT:aomame_bootstrap/locallang_db.xml:tt_content.select_span_3', '3'),
				array('LLL:EXT:aomame_bootstrap/locallang_db.xml:tt_content.select_span_4', '4'),
				array('LLL:EXT:aomame_bootstrap/locallang_db.xml:tt_content.select_span_5', '5'),
				array('LLL:EXT:aomame_bootstrap/locallang_db.xml:tt_content.select_span_6', '6'),
				array('LLL:EXT:aomame_bootstrap/locallang_db.xml:tt_content.select_span_7', '7'),
				array('LLL:EXT:aomame_bootstrap/locallang_db.xml:tt_content.select_span_8', '8'),
				array('LLL:EXT:aomame_bootstrap/locallang_db.xml:tt_content.select_span_9', '9'),
				array('LLL:EXT:aomame_bootstrap/locallang_db.xml:tt_content.select_span_10', '10'),
				array('LLL:EXT:aomame_bootstrap/locallang_db.xml:tt_content.select_span_11', '11'),
				array('LLL:EXT:aomame_bootstrap/locallang_db.xml:tt_content.select_span_12', '12'),
			),
			'size' => 1,	
			'maxitems' => 1,
		)
	),
	'tx_aomamebootstrap_visibility' => array(		
		'exclude' => 1,		
		'label' => 'LLL:EXT:aomame_bootstrap/locallang_db.xml:tt_content.title_visibility',		
		'config' => array(
			'type' => 'select',
			'items' => array(
				array('LLL:EXT:aomame_bootstrap/locallang_db.xml:tt_content.empty_field', '0'),
				array('LLL:EXT:aomame_bootstrap/locallang_db.xml:tt_content.select_hidden_phone', '1'),
				array('LLL:EXT:aomame_bootstrap/locallang_db.xml:tt_content.select_hidden_tablet', '2'),
				array('LLL:EXT:aomame_bootstrap/locallang_db.xml:tt_content.select_hidden_desktop', '3'),
				array('LLL:EXT:aomame_bootstrap/locallang_db.xml:tt_content.select_visible_phone', '4'),
				array('LLL:EXT:aomame_bootstrap/locallang_db.xml:tt_content.select_visible_tablet', '5'),
				array('LLL:EXT:aomame_bootstrap/locallang_db.xml:tt_content.select_visible_desktop', '6'),
			),
			'size' => 1,
			'maxitems' => 1,
		)
	),
	'tx_aomamebootstrap_muted' => array(		
		'exclude' => 1,		
		'label' => 'LLL:EXT:aomame_bootstrap/locallang_db.xml:tt_content.select_muted',		
		'config' => array(
			'type' => 'check',
		)
	),
	'tx_aomamebootstrap_clear' => array(		
		'exclude' => 1,		
		'label' => 'LLL:EXT:aomame_bootstrap/locallang_db.xml:tt_content.select_clear',		
		'config' => array(
			'type' => 'check',
		)
	),
	'tx_aomamebootstrap_closebutton' => array(		
		'exclude' => 1,		
		'label' => 'LLL:EXT:aomame_bootstrap/locallang_db.xml:tt_content.select_closebutton',		
		'config' => array(
			'type' => 'check',
		)
	),
);

//add field to content elements: Bootstrap Helper Class, muted
t3lib_extMgm::addTCAcolumns('tt_content',$be_fields,1);
t3lib_extMgm::addToAllTCAtypes(
	'tt_content',
	'tx_aomamebootstrap_direction;;;;1-1-1,
	tx_aomamebootstrap_alert,
	tx_aomamebootstrap_well,
	tx_aomamebootstrap_span,
	tx_aomamebootstrap_visibility,
	tx_aomamebootstrap_muted,
	tx_aomamebootstrap_clear,
	tx_aomamebootstrap_closebutton'
);



#pi1
$TCA['tt_content']['types']['list']['subtypes_excludelist'][$_EXTKEY.'_pi1'] = 'layout,select_key,pages';
$TCA['tt_content']['types']['list']['subtypes_addlist'][$_EXTKEY.'_pi1'] ='pi_flexform';
t3lib_extMgm::addStaticFile($_EXTKEY,"static/","Aomame Bootstrap");
t3lib_extMgm::addPiFlexFormValue($_EXTKEY.'_pi1', 'FILE:EXT:aomame_bootstrap/res/flexform/components.xml');

t3lib_extMgm::addPlugin(array(
	'LLL:EXT:aomame_bootstrap/locallang_db.xml:tt_content.list_type_pi1',
	$_EXTKEY . '_pi1',
	t3lib_extMgm::extRelPath($_EXTKEY) . 'ext_icon.gif'
),'list_type');


if (TYPO3_MODE === 'BE') {
	$TBE_MODULES_EXT['xMOD_db_new_content_el']['addElClasses']['tx_aomamebootstrap_pi1_wizicon'] = t3lib_extMgm::extPath($_EXTKEY) . 'pi1/class.tx_aomamebootstrap_pi1_wizicon.php';
}

?>