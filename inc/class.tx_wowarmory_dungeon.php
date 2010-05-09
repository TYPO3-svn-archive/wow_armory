<?php

/*
 *  Represents a dungeon in wow
 *  xpath: armory/dungeon
 *
 */
require_once('class.tx_wowarmory_object.php');// = parent
require_once('class.tx_wowarmory_boss.php');// = child

//http://eu.wowarmory.com/data/dungeonStrings.xml

class tx_wowarmory_dungeon extends tx_wowarmory_object{

  private $bosses = array();

  public function __construct(SimpleXMLElement $xml){
    parent::__construct($xml);
  }
  
  public function __get($name){
    switch($name){
      case 'boss': case 'bosses': return $this->getBosses();
      default: return parent::__get($name);// ask parent to handle
    }
  }
  
  public function __toString(){
    return sprintf('[%04d] %s',$this->id,$this->name);
  }
  
  // load bosses on demand
  private function getBosses() {
    if(count($this->bosses)) return $this->bosses;// return directly if already parsed
    foreach($this->xml->boss as $boss){
      $this->bosses[intval($boss['id'])] = new tx_wowarmory_boss($boss);
    }
    uasort($this->bosses,'tx_wowarmory_boss::cmp');
    return $this->bosses;
  }
  
  public static function cmp($a,$b){
    return strcasecmp($a->name,$b->name);
  }
  
  public static function query(){
    return parent::query('data/dungeonStrings');
  }
  
}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/wow_armory/inc/class.tx_wowarmory_dungeon.php']) {
  include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/wow_armory/inc/class.tx_wowarmory_dungeon.php']);
}

?>