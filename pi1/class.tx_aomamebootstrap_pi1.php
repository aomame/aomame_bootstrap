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
		$this->pi_loadLL();
		$this->pi_initPIflexForm();
		$this->configuration();
		$this->writeJavaScriptConfiguration();
		$this->getData();
		$this->buildContent();
			
		//Debug
		//$GLOBALS["TSFE"]->set_no_cache();
		//echo t3lib_utility_Debug::debug();
		
		$content = $this->content;
		return $this->pi_wrapInBaseClass($content);
	}	
	
	
	private function buildContent(){
		$according_id = $this->accordingHtmlId ? 'id="'.$this->accordingHtmlId.'"':'';
		$bootstrap_span = $this->bootstrapSpan ? ' '.$this->bootstrapSpan : '';
		$content = '';
		
		$i=0;
		foreach($this->collapseData as $k => $v){
			$content .= '
				<div class="accordion-group">
					<div class="accordion-heading">
						<a class="accordion-toggle" data-toggle="collapse" data-parent="#'.$this->accordingHtmlId.'" href="#collapse_'.$i.'">
							'.$this->collapseData[$i]['header'].'
						</a>
					</div>
					<div id="collapse_'.$i.'"class="accordion-body collapse">
						<div class="accordion-inner">
							'.$this->collapseData[$i]['content'].'
						</div>
					</div>
				</div>
			';
			$i++;
		}
		
		
		$content = '<div class="accordion'.$bootstrap_span.'" '.$according_id.'>'.$content.'</div>';
		if($this->bootstrapRow){
			$content = '<div class="'.$this->bootstrapRow.'">'.$content.'</div>';
		}
		$this->content = $content;
		
		return false;
	}
	
	
	private function writeJavaScriptConfiguration(){
		$GLOBALS['TSFE']->additionalFooterData[$this->extKey] = '
		  <script type="text/javascript" >
			$(".collapse").collapse("'.$this->collapseStyle.'");
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
        			$this->collapseData[$c]['header'] = $v;
        		}
        		if($k == 'uid'){
        			$conf = array('tables' => 'tt_content','source' => $v,'dontCheckPid' => 1);
	    			$this->collapseData[$c]['content'] = $this->cObj->RECORDS($conf);
        		}
        	}
        	$c++;
        }
        return false;
	}
	
	
	private function configuration(){
		//check for flexform or typoscript settings
		$getContentUidList = $this->pi_getFFvalue($this->cObj->data['pi_flexform'], 'contentuidlist', 'sDEF');
		$this->contentUidList = $getContentUidList ? $getContentUidList:$this->conf['bootstrap.']['collapse.']['contentUidList'];
		
		$getAccordingHtmlId = $this->pi_getFFvalue($this->cObj->data['pi_flexform'], 'accordinghtmlid', 'sDEF');
		$this->accordingHtmlId = $getAccordingHtmlId ? $getAccordingHtmlId:$this->conf['bootstrap.']['collapse.']['accordingHtmlId'];
		
		$getBootstrapSpan = $this->pi_getFFvalue($this->cObj->data['pi_flexform'], 'bootstrapspan', 'sDEF');
		$this->bootstrapSpan = $getBootstrapSpan ? $getBootstrapSpan:$this->conf['bootstrap.']['collapse.']['bootstrapSpan'];
		
		$getBootstrapRow = $this->pi_getFFvalue($this->cObj->data['pi_flexform'], 'bootstraprow', 'sDEF');
		$this->bootstrapRow = $getBootstrapRow ? $getBootstrapRow:$this->conf['bootstrap.']['collapse.']['bootstrapRow'];
		
		$getCollapseStyle = $this->pi_getFFvalue($this->cObj->data['pi_flexform'], 'collapsestyle', 'sDEF');
		$this->collapseStyle = $getCollapseStyle ? $getCollapseStyle:$this->conf['bootstrap.']['collapse.']['collapseStyle'];
		
		return false;
	}
}


if (defined('TYPO3_MODE') && isset($GLOBALS['TYPO3_CONF_VARS'][TYPO3_MODE]['XCLASS']['ext/aomame_bootstrap/pi1/class.tx_aomamebootstrap_pi1.php'])) {
	include_once($GLOBALS['TYPO3_CONF_VARS'][TYPO3_MODE]['XCLASS']['ext/aomame_bootstrap/pi1/class.tx_aomamebootstrap_pi1.php']);
}

?>