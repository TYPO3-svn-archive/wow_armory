<?php

/*
 *  Provides armory data
 *  xpath: armory
 *
 */
 
require_once('class.tx_wowarmory_object.php');// = parent
require_once('class.tx_wowarmory_dungeon.php');// = child
require_once('class.tx_wowarmory_character.php');// = child
require_once('class.tx_wowarmory_item.php');// = child

class tx_wowarmory_armory {

  private $dungeons = array();

  public function __construct(){
    // constructor
  }
  
  public function __get($name){
    switch($name){
      case 'dungeon': case 'dungeons': return $this->getDungeons();
      default: return null;
    }
  }
  
  // load dungeons on demand
  private function getDungeons(){
    if(count($this->dungeons)) return $this->dungeons;// direct return if already loaded
    $query = tx_wowarmory_dungeon::query();
    foreach($query->dungeons->dungeon as $node){// create dungeons
      $this->dungeons[intval($node['id'])] = new tx_wowarmory_dungeon($node);
    }
    uasort($this->dungeons,'tx_wowarmory_dungeon::cmp');
    return $this->dungeons;
  }
  
  public function getCharacter($realm,$name){
    $query = tx_wowarmory_character::query($realm,$name);
    return $query->asXML();
  }
  
  public function getItem($itemID){
    return new tx_wowarmory_item(tx_wowarmory_item::query($itemID));
  }
  
}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/wow_armory/inc/class.tx_wowarmory_armory.php']) {
  include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/wow_armory/inc/class.tx_wowarmory_armory.php']);
}

?>