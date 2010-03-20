<?php
/***************************************************************
 *  Copyright notice
 *
 *  (c) 1999-2004 Kasper Skaarhoj (kasper@typo3.com)
 *  (c) 2005-2006 Jan-Erik Revsbech <jer@moccompany.com>
 *  (c) 2006 Stanislas Rolland <stanislas.rolland(arobas)fructifor.ca>
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
 *  A copy is found in the textfile GPL.txt and important notices to the license
 *  from the author is found in LICENSE.txt distributed with these scripts.
 *
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

unset($MCONF);
include ('conf.php');
include ($BACK_PATH.'init.php');
include ($BACK_PATH.'template.php');

/**
 * Class to producing navigation frame of the tx_directmail extension
 *
 * @author    Kasper Sk?rh?j <kasper@typo3.com>
 * @author    Ivan-Dharma Kartolo  <ivan.kartolo@dkd.de>
 *
 * @package   TYPO3
 * @subpackage   tx_directmail
 * @version   $Id: index.php 8299 2008-02-18 12:02:16Z ivankartolo $
 */

/**
 * [CLASS/FUNCTION INDEX of SCRIPT]
 *
 *
 *
 *   62: class tx_wowarmory_navframe
 *   68:     function init()
 *  134:     function main()
 *  177:     function printContent()
 *
 * TOTAL FUNCTIONS: 3
 * (This index is automatically created/updated by the extension "extdeveval")
 *
 */
class tx_wowarmory_navframe{
  /**
 * first initialization of the global variables. Set some JS-code
 *
 * @return  void    ...
 */
  function init()  {
    global $BE_USER,$LANG,$BACK_PATH,$TYPO3_CONF_VARS;

    $this->doc = t3lib_div::makeInstance('template');
    $this->doc->backPath = $BACK_PATH;

    $this->currentSubScript = t3lib_div::_GP('currentSubScript');

    $this->doc->JScode='';

      // Setting JavaScript for menu.
    $this->doc->JScode=$this->doc->wrapScriptTags(
      ($this->currentSubScript?'top.currentSubScript=unescape("'.rawurlencode($this->currentSubScript).'");':'').'

      function jumpTo(params,linkObj,highLightID){//
        var theUrl = top.TS.PATH_typo3+top.currentSubScript+"?"+params;
        if (top.condensedMode)  {
          top.content.document.location=theUrl;
        } else {
          parent.list_frame.document.location=theUrl;
        }
        '.($this->doHighlight?'hilight_row("row"+top.fsMod.recentIds["txwowguildM1"],highLightID);':'').'
        '.(!$GLOBALS['CLIENT']['FORMSTYLE'] ? '' : 'if (linkObj) {linkObj.blur();}').'
        return false;
      }

      // Call this function, refresh_nav(), from another script in the backend if you want to refresh the navigation frame (eg. after having changed a page title or moved pages etc.)
      // See t3lib_BEfunc::getSetUpdateSignal()
      function refresh_nav(){window.setTimeout("_refresh_nav();",0);}

      function _refresh_nav(){document.location="'.htmlspecialchars(t3lib_div::getIndpEnv('SCRIPT_NAME').'?unique='.time()).'";}

    ');
  }

  /**
   * Main function, rendering the browsable page tree
   *
   * @return  void    ...
   */
  function main()  {
    global $LANG,$BACK_PATH, $TYPO3_DB;
  }

}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/wow_armory/mod1/index.php'])  {
  include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/wow_armory/mod1/index.php']);
}

// Make instance:

$GLOBALS['SOBE'] = t3lib_div::makeInstance('tx_wowarmory_navframe');
$SOBE->init();
$SOBE->main();

?>
