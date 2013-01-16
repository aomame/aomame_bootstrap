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

// require_once(PATH_tslib . 'class.tslib_pibase.php');

/**
 * Plugin 'Bootstrap Popover' for the 'aomame_bootstrap' extension.
 *
 * @author	Crausaz Patrick <support@aomame.ch>
 * @package	TYPO3
 * @subpackage	tx_aomamebootstrap
 */
class tx_aomamebootstrap_component_popover extends tslib_pibase {
	public $prefixId      = 'tx_aomamebootstrap_component_popover';		// Same as class name
	public $scriptRelPath = 'pi3/class.tx_aomamebootstrap_component_popover.php';	// Path to this script relative to the extension dir.
	public $extKey        = 'aomame_bootstrap';	// The extension key.
	public $pi_checkCHash = TRUE;
	
	/**
	 * The main method of the Plugin.
	 *
	 * @param string $content The Plugin content
	 * @param array $conf The Plugin configuration
	 * @return string The content that is displayed on the website
	 */
	public function __construct(array $conf, $cObj) {
		$this->conf = $conf;
		$this->cObj = $cObj;
		$this->pi_setPiVarDefaults();
		$this->pi_loadLL();
		$this->pi_initPIflexForm();
		$this->configuration();
		$this->getData();
		$this->writeJavaScriptConfiguration();
		
		//Debug
		//$GLOBALS["TSFE"]->set_no_cache();
		//echo t3lib_utility_Debug::debug();
		
		return true;
	}
	
	
	private function writeJavaScriptConfiguration(){
    	$GLOBALS['TSFE']->additionalFooterData[$this->extKey] = '
		  <script type="text/javascript" >
			$("'.$this->selector.'").popover({
				animation: true,
				html: true,		
				placement: "'.$this->direction.'",
				selector: false,
				trigger: "'.$this->trigger.'",
				title: "'.$this->popoverData['title'].'",
				content: "'.$this->popoverData['content'].'",
				delay: { 
					show: '.$this->delayShow.',
					hide: '.$this->delayHide.'
				}
			});	
		  </script>
		';
		return false;
	}
	
	
	private function getData(){
		$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery(
             '*',   #select
             'tt_content', #from
             'uid='.$this->contentUid,  #where
             $groupBy='',
             $orderBy='',
             $limit=''
        );
        
        while( $row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res)) {
        	foreach($row as $k => $v){
        		if ($k == 'header'){
        			$this->popoverData['title'] = $v;
        		}
        		if($k == 'bodytext'){
        			$this->popoverData['content'] = $v;
        		}
        	}
        }
		return false;
	}
	
	
	private function configuration(){
		//check for flexform or typoscript settings
		$getContentUid = $this->pi_getFFvalue($this->cObj->data['pi_flexform'], 'popover_contentuid', 'sDEF');
		$this->contentUid = $getContentUid?$getContentUid:$this->conf['bootstrap.']['popover.']['contentUid'];
		
		$getDirection = $this->pi_getFFvalue($this->cObj->data['pi_flexform'], 'popover_direction', 'sDEF');
		$this->direction = $getDirection?$getDirection:$this->conf['bootstrap.']['popover.']['direction'];
		
		$getSelector = $this->pi_getFFvalue($this->cObj->data['pi_flexform'], 'popover_selector', 'sDEF');
		$this->selector = $getSelector?$getSelector:$this->conf['bootstrap.']['popover.']['selector'];
		
		$getTrigger = $this->pi_getFFvalue($this->cObj->data['pi_flexform'], 'popover_trigger', 'sDEF');
		$this->trigger = $getTrigger?$getTrigger:$this->conf['bootstrap.']['popover.']['trigger'];
		
		$getDelayShow = $this->pi_getFFvalue($this->cObj->data['pi_flexform'], 'popover_delayshow', 'sDEF');
		$this->delayShow = $getDelayShow?$getDelayShow:$this->conf['bootstrap.']['popover.']['delayShow'];
		
		$getDelayHide = $this->pi_getFFvalue($this->cObj->data['pi_flexform'], 'popover_delayhide', 'sDEF');
		$this->delayHide = $getDelayHide?$getDelayHide:$this->conf['bootstrap.']['popover.']['delayHide'];
		
		return false;
	}
}


if (defined('TYPO3_MODE') && isset($GLOBALS['TYPO3_CONF_VARS'][TYPO3_MODE]['XCLASS']['ext/aomame_bootstrap/pi3/class.tx_aomamebootstrap_pi3.php'])) {
	include_once($GLOBALS['TYPO3_CONF_VARS'][TYPO3_MODE]['XCLASS']['ext/aomame_bootstrap/pi3/class.tx_aomamebootstrap_pi3.php']);
}

?>