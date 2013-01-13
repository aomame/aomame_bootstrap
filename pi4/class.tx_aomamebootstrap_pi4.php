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
class tx_aomamebootstrap_pi4 extends tslib_pibase {
	public $prefixId      = 'tx_aomamebootstrap_pi4';		// Same as class name
	public $scriptRelPath = 'pi4/class.tx_aomamebootstrap_pi4.php';	// Path to this script relative to the extension dir.
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
		$this->getData();
		$this->writeJavaScriptConfiguration();
		$this->buildContent();
		
		//Debug
		//$GLOBALS["TSFE"]->set_no_cache();
		//echo t3lib_utility_Debug::debug();
		
		$content = $this->content;
		return $this->pi_wrapInBaseClass($content);
	}
	
	
	private function buildContent(){
		$BsSpan = $this->bootstrapSpan ? ' '.$this->bootstrapSpan: '';
		$content = '';
		$i=0;
		foreach($this->carouselData as $k => $v){
			$content .= '
				<div class="item">
                    <img alt="" src="uploads/pics/'.$this->carouselData[$i]['image'].'">';
                    if($this->showText){
	                    $content .= 
							'<div class="carousel-caption">
		                      <h4>'.$this->carouselData[$i]['header'].'</h4>
		                      <p>'.$this->carouselData[$i]['bodytext'].'</p>
		                    </div>';
                    }
 			$content .= '</div>';
			$i++;
		}
		$prev = '<a data-slide="prev" href="#'.$this->carouselHtmlId.'" class="left carousel-control">&lsaquo;</a>';
		$next = '<a data-slide="next" href="#'.$this->carouselHtmlId.'" class="right carousel-control">&rsaquo;</a>';
		$content = '<div class="carousel-inner">'.$content.'</div>';
		$content = '<div class="carousel slide'.$BsSpan.'" id="'.$this->carouselHtmlId.'">'.$content.$prev.$next.'</div>';
		
		if($this->bootstrapRow){
			$content = '<div class="'.$this->bootstrapRow.'">'.$content.'</div>';
		}
		$this->content = $content;
		return false;
	}
	
	
	private function writeJavaScriptConfiguration(){
		$stopOnHover = $this->stopOnHover ? 'hover':'nonstop';
    	$GLOBALS['TSFE']->additionalFooterData[$this->extKey] = '
		  <script type="text/javascript" >
			    $(".carousel").carousel({
			    	interval: "'.$this->interval.'",
			    	pause: "'.$stopOnHover.'"
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
        			$this->carouselData[$c]['header'] = $v;
        		}
        		if($k == 'bodytext'){
        			$this->carouselData[$c]['bodytext'] = $v;
        		}
        		if($k == 'image'){
        			$this->carouselData[$c]['image'] = $v;
        		}
        	}
        	$c++;
        }
        return false;
	}
	
	
	private function configuration(){
		//check for flexform or typoscript settings
		$getContentUidList = $this->pi_getFFvalue($this->cObj->data['pi_flexform'], 'contentuidlist', 'sDEF');
		$this->contentUidList = $getContentUidList ? $getContentUidList:$this->conf['bootstrap.']['carousel.']['contentUidList'];
		
		$getCarouselHtmlId = $this->pi_getFFvalue($this->cObj->data['pi_flexform'], 'carouselhtmlid', 'sDEF');
		$this->carouselHtmlId = $getCarouselHtmlId ? $getCarouselHtmlId:$this->conf['bootstrap.']['carousel.']['carouselHtmlId'];
		
		$getBootstrapSpan = $this->pi_getFFvalue($this->cObj->data['pi_flexform'], 'bootstrapspan', 'sDEF');
		$this->bootstrapSpan = $getBootstrapSpan ? $getBootstrapSpan:$this->conf['bootstrap.']['carousel.']['bootstrapSpan'];
		
		$getBootstrapRow = $this->pi_getFFvalue($this->cObj->data['pi_flexform'], 'bootstraprow', 'sDEF');
		$this->bootstrapRow = $getBootstrapRow ? $getBootstrapRow:$this->conf['bootstrap.']['carousel.']['bootstrapRow'];
		
		$getShowText = $this->pi_getFFvalue($this->cObj->data['pi_flexform'], 'showtext', 'sDEF');
		$this->showText = $getShowText ? $getShowText:$this->conf['bootstrap.']['carousel.']['showText'];
		
		$getInterval = $this->pi_getFFvalue($this->cObj->data['pi_flexform'], 'interval', 'sDEF');
		$this->interval = $getInterval ? $getInterval:$this->conf['bootstrap.']['carousel.']['interval'];
		
		$getStopOnHover = $this->pi_getFFvalue($this->cObj->data['pi_flexform'], 'stoponhover', 'sDEF');
		$this->stopOnHover = $getStopOnHover ? $getStopOnHover:$this->conf['bootstrap.']['carousel.']['stopOnHover'];
		
		return false;
	}
}


if (defined('TYPO3_MODE') && isset($GLOBALS['TYPO3_CONF_VARS'][TYPO3_MODE]['XCLASS']['ext/aomame_bootstrap/pi4/class.tx_aomamebootstrap_pi4.php'])) {
	include_once($GLOBALS['TYPO3_CONF_VARS'][TYPO3_MODE]['XCLASS']['ext/aomame_bootstrap/pi4/class.tx_aomamebootstrap_pi4.php']);
}

?>