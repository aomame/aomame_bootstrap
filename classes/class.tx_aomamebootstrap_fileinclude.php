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
****************************************************************/

require_once(PATH_t3lib. 'class.t3lib_pagerenderer.php');
/**
 * Including files
 * 
 * @author	Crausaz Patrick <support@aomame.ch>
 * @package	TYPO3
 * @subpackage	tx_aomamebootstrap
  extends tslib_pibase
 */
class tx_aomamebootstrap_fileinclude {
	
	function fileInclude($conf){
		
		$pagerenderer = t3lib_div::makeInstance('t3lib_PageRenderer');
		
		//debug
		//echo t3lib_utility_Debug::debug();
		
		// unserializing the configuration of the extension setted within the ext manager
		$_EXTCONF = unserialize($conf);
		$path = t3lib_extMgm::siteRelPath('aomame_bootstrap') . 'res/bootstrap/';
		
		
		if($_EXTCONF['dontUseMinifiedFiles']){
			$compress = false;
			$min = '';
		}else {
			$compress = true;
			$min = '.min';
		}
		
		
		//include Styles
		if($_EXTCONF['includeBootstrapCSS']) {
			
			if($_EXTCONF['useBootstrapResponsive']){
				$pagerenderer->addCssFile(
					$path . 'css/bootstrap-responsive'.$min.'.css',
					$rel = 'stylesheet',
				 	$media = 'all',
				 	$title = '',
				 	$compress,
				 	$forceOnTop = true,
				 	$allWrap = '',
				 	$excludeFromConcatenation = FALSE
				);
				$meta = '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
				$pagerenderer->addMetaTag($meta);
			}
			
			$pagerenderer->addCssFile(
				$path . 'css/bootstrap'.$min.'.css',
				$rel = 'stylesheet',
			 	$media = 'all',
			 	$title = '',
			 	$compress,
			 	$forceOnTop = true,
			 	$allWrap = '',
			 	$excludeFromConcatenation = FALSE
			);
			
		}
		
		//include JavaScripts
		if($_EXTCONF['allJStoHead']){
			
			//include jQuery
			if ($_EXTCONF['includeJQuery'])	{
				$pagerenderer->addJsFile(
				 	$path . 'js/jquery'.$min.'.js',
				 	$type = 'text/javascript',
				 	$compress,
				 	$forceOnTop = true,
				 	$allWrap = '',
				 	$excludeFromConcatenation = FALSE 
				);
			}
			
			//include Bootstrap JS
			if ($_EXTCONF['includeBootstrapJS']) {
				$pagerenderer->addJsFile(
				 	$path . 'js/bootstrap'.$min.'.js',
				 	$type = 'text/javascript',
				 	$compress,
				 	$forceOnTop = true,
				 	$allWrap = '',
				 	$excludeFromConcatenation = FALSE 
				);
			}
			
		}else{
			
			//include jQuery
			if ($_EXTCONF['includeJQuery'])	{
				$pagerenderer->addJsFooterLibrary(
					'jquery',
				 	$path . 'js/jquery'.$min.'.js',
				 	$type = 'text/javascript',
				 	$compress,
				 	$forceOnTop = true,
				 	$allWrap = '',
				 	$excludeFromConcatenation = FALSE 
				);
			}
			
			//include Bootstrap JS
			if ($_EXTCONF['includeBootstrapJS']) {
				$pagerenderer->addJsFooterLibrary(
					'bootstrap_js',
				 	$path . 'js/bootstrap'.$min.'.js',
				 	$type = 'text/javascript',
				 	$compress,
				 	$forceOnTop = true,
				 	$allWrap = '',
				 	$excludeFromConcatenation = FALSE 
				);
			}	
		}
	
		return void;
	}
}

if (defined('TYPO3_MODE') && isset($GLOBALS['TYPO3_CONF_VARS'][TYPO3_MODE]['XCLASS']['ext/aomame_bootstrap/classes/class.tx_aomamebootstrap_fileinclude.php'])) {
	include_once($GLOBALS['TYPO3_CONF_VARS'][TYPO3_MODE]['XCLASS']['ext/aomame_bootstrap/classes/class.tx_aomamebootstrap_fileinclude.php']);
}
?>