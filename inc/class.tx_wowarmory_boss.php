<?php

/*
 *  Represents a boss in wow
 *  xpath: armory/dungeon/boss
 *
 */
require_once('class.tx_wowarmory_object.php');// = parent

class tx_wowarmory_boss extends tx_wowarmory_object{

  public function __construct(SimpleXMLElement $xml){
    parent::__construct($xml);
  }
  
  public function __get($name){
    switch($name){
      default: return parent::__get($name);
    }
  }
  
  public function __toString(){
    return sprintf('[%06d] %s',$this->id,$this->name);
  }
  
  public static function cmp($a,$b){
    return strcasecmp($a->name,$b->name);
  }
  
}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/wow_armory/inc/class.tx_wowarmory_boss.php']) {
  include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/wow_armory/inc/class.tx_wowarmory_boss.php']);
}

?>