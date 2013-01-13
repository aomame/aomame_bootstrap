<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

t3lib_extMgm::addPItoST43($_EXTKEY, 'pi1/class.tx_aomamebootstrap_pi1.php', '_pi1', 'list_type', 1);
t3lib_extMgm::addPItoST43($_EXTKEY, 'pi2/class.tx_aomamebootstrap_pi2.php', '_pi2', 'list_type', 1);
t3lib_extMgm::addPItoST43($_EXTKEY, 'pi3/class.tx_aomamebootstrap_pi3.php', '_pi3', 'list_type', 1);
t3lib_extMgm::addPItoST43($_EXTKEY, 'pi4/class.tx_aomamebootstrap_pi4.php', '_pi4', 'list_type', 1);

// unserializing the configuration of the extension setted within the ext manager
$_EXTCONF = unserialize($_EXTCONF);	

//add ts config
if ($_EXTCONF['setPageTSconfig'])	{
	t3lib_extMgm::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:'.$_EXTKEY.'/static/page_ts_config.txt">');
}

?>