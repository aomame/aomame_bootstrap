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
 
$extensionPath = t3lib_extMgm::extPath('aomame_bootstrap');

return array(
    'tx_aomamebootstrap_component_collapse' => $extensionPath . 'classes/class.tx_aomamebootstrap_component_collapse.php',
    'tx_aomamebootstrap_component_tab' => $extensionPath . 'classes/class.tx_aomamebootstrap_component_tab.php',
    'tx_aomamebootstrap_component_popover' => $extensionPath . 'classes/class.tx_aomamebootstrap_component_popover.php',
    'tx_aomamebootstrap_component_carousel' => $extensionPath . 'classes/class.tx_aomamebootstrap_component_carousel.php',
    'tx_aomamebootstrap_fileinclude' => $extensionPath . 'classes/class.tx_aomamebootstrap_fileinclude.php'
);

?>