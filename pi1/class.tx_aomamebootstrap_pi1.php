<?php
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2012 Crausaz Patrick <support@aomame.ch>
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

//require_once(PATH_tslib . 'class.tslib_pibase.php');

/**
 * Plugin 'Bootstrap Collapse' for the 'aomame_bootstrap' extension.
 *
 * @author	Crausaz Patrick <support@aomame.ch>
 * @package	TYPO3
 * @subpackage	tx_aomamebootstrap
 */
class tx_aomamebootstrap_pi1 extends tslib_pibase {
	public $prefixId      = 'tx_aomamebootstrap_pi1';		// Same as class name
	public $scriptRelPath = 'pi1/class.tx_aomamebootstrap_pi1.php';	// Path to this script relative to the extension dir.
	public $extKey        = 'aomame_bootstrap';	// The extension key.
	public $pi_checkCHash = TRUE;
	
	/**
	 * The main method of the Plugin.
	 *
	 * @param string $content The Plugin content
	 * @param array $conf The Plugin configuration
	 * @return string The content that is displayed on the website
	 */
	public function main($content, array $conf) {
		$this->conf = $conf;
		$this->pi_setPiVarDefaults();
		$this->pi_initPIflexForm();
		
		//get selected component
		$getSelection = $this->pi_getFFvalue($this->cObj->data['pi_flexform'], 'selection', 'sDEF');
		$selection = $getSelection ? $getSelection : $this->conf['bootstrap.']['component'];
		
		
		switch($selection){
			case 'collapse':
				$i = t3lib_div::makeInstance('tx_aomamebootstrap_component_collapse', $conf, $this->cObj);
				$content = $i->content;
				break;
			case 'tab':
				$i = t3lib_div::makeInstance('tx_aomamebootstrap_component_tab', $conf, $this->cObj);
				$content = $i->content;
				break;
			case 'popover':
				$i = t3lib_div::makeInstance('tx_aomamebootstrap_component_popover', $conf, $this->cObj);
				$content = $i->content;
				break;
			case 'carousel':
				$i = t3lib_div::makeInstance('tx_aomamebootstrap_component_carousel', $conf, $this->cObj);
				$content = $i->content;
				break;
		}
			
		//Debug
		//$GLOBALS["TSFE"]->set_no_cache();
		//echo t3lib_utility_Debug::debug();
		
		return $this->pi_wrapInBaseClass($content);
	}	
	
}


if (defined('TYPO3_MODE') && isset($GLOBALS['TYPO3_CONF_VARS'][TYPO3_MODE]['XCLASS']['ext/aomame_bootstrap/pi1/class.tx_aomamebootstrap_pi1.php'])) {
	include_once($GLOBALS['TYPO3_CONF_VARS'][TYPO3_MODE]['XCLASS']['ext/aomame_bootstrap/pi1/class.tx_aomamebootstrap_pi1.php']);
}

?>