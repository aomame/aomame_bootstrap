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
 * Plugin 'Bootstrap Tab' for the 'aomame_bootstrap' extension.
 *
 * @author	Crausaz Patrick <support@aomame.ch>
 * @package	TYPO3
 * @subpackage	tx_aomamebootstrap
 */
class tx_aomamebootstrap_component_tab extends tslib_pibase {
	public $prefixId      = 'tx_aomamebootstrap_component_tab';		// Same as class name
	public $scriptRelPath = 'pi2/class.tx_aomamebootstrap_component_tab.php';	// Path to this script relative to the extension dir.
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
		$this->writeJavaScriptConfiguration();
		$this->getData();
		$this->buildContent();
		
		//Debug
		//$GLOBALS["TSFE"]->set_no_cache();
		//echo t3lib_utility_Debug::debug();
	
		return true;
	}
		
	
	private function buildContent(){
		$active = $this->activeTab -1;
		$content = '';
		$tabHeader = '';
		$tabContent = '';
		$i=0;
		
		foreach($this->tabData as $k => $v){
			if($i==$active){
				$tabHeader .= '<li class="active"><a href="#tab_'.$i.'" data-toggle="tab">'.$this->tabData[$i]['header'].'</a></li>';
				$tabContent .= '<div class="tab-pane active" id="tab_'.$i.'">'.$this->tabData[$i]['content'].'</div>';
			}else{
				$tabHeader .= '<li><a href="#tab_'.$i.'" data-toggle="tab">'.$this->tabData[$i]['header'].'</a></li>';
				$tabContent .= '<div class="tab-pane" id="tab_'.$i.'">'.$this->tabData[$i]['content'].'</div>';
			}
			$i++;
		}
		$tabHeader = '<ul class="nav nav-tabs" id="'.$this->tabHtmlId.'">'.$tabHeader.'</ul>'; 
		$tabContent = '<div class="tab-content">'.$tabContent.'</div>';
		$content = '<div class="'.$this->bootstrapSpan.'">'.$tabHeader . $tabContent.'</div>';
		
		$this->content = $content;
		return false;
	}
	
	
	private function writeJavaScriptConfiguration(){
    	$GLOBALS['TSFE']->additionalFooterData[$this->extKey] = '
		  <script type="text/javascript" >
			$("#'.$this->tabHtmlId.' a").click(function (e) {
			    $(this).tab("show");
			});
		  </script>
		';
		return false;
	}
	
	
	private function getData(){
		$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery(
             '*',   #select
             'tt_content', #from
             'uid IN('.$this->contentUidList.')',  #where
             $groupBy='',
             $orderBy='',
             $limit=''
        );
        
        $c=0;
        while( $row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res)) {
        	foreach($row as $k => $v){
        		if ($k == 'header'){
        			$this->tabData[$c]['header'] = $v;
        		}
        		if($k == 'uid'){
        			$conf = array('tables' => 'tt_content','source' => $v,'dontCheckPid' => 1);
	    			$this->tabData[$c]['content'] = $this->cObj->RECORDS($conf);
        		}
        	}
        	$c++;
        }
		return false;
	}
	
	
	private function configuration(){
		//check for flexform or typoscript settings
		$getContentUidList = $this->pi_getFFvalue($this->cObj->data['pi_flexform'], 'tab_contentuidlist', 'sDEF');
		$this->contentUidList = $getContentUidList ? $getContentUidList:$this->conf['bootstrap.']['tab.']['contentUidList'];
		
		$getTabHtmlId = $this->pi_getFFvalue($this->cObj->data['pi_flexform'], 'tab_tabhtmlid', 'sDEF');
		$this->tabHtmlId = $getTabHtmlId ? $getTabHtmlId:$this->conf['bootstrap.']['tab.']['tabHtmlId'];
		
		$getBootstrapSpan = $this->pi_getFFvalue($this->cObj->data['pi_flexform'], 'tab_bootstrapspan', 'sDEF');
		$this->bootstrapSpan = $getBootstrapSpan ? $getBootstrapSpan:$this->conf['bootstrap.']['tab.']['bootstrapSpan'];
		
		$getBootstrapRow = $this->pi_getFFvalue($this->cObj->data['pi_flexform'], 'tab_bootstraprow', 'sDEF');
		$this->bootstrapRow = $getBootstrapRow ? $getBootstrapRow:$this->conf['bootstrap.']['tab.']['bootstrapRow'];
		
		$getActiveTab = $this->pi_getFFvalue($this->cObj->data['pi_flexform'], 'tab_activetab', 'sDEF');
		$this->activeTab = $getActiveTab?$getActiveTab:$this->conf['bootstrap.']['tab.']['activeTab'];
		
		return false;
	}
}


if (defined('TYPO3_MODE') && isset($GLOBALS['TYPO3_CONF_VARS'][TYPO3_MODE]['XCLASS']['ext/aomame_bootstrap/pi2/class.tx_aomamebootstrap_pi2.php'])) {
	include_once($GLOBALS['TYPO3_CONF_VARS'][TYPO3_MODE]['XCLASS']['ext/aomame_bootstrap/pi2/class.tx_aomamebootstrap_pi2.php']);
}

?>