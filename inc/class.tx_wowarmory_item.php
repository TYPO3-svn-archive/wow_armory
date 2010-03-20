<?php

/*
 *  Represents a dungeon in wow
 *  xpath: armory/dungeon
 *
 */
require_once('class.tx_wowarmory_object.php');// = parent

//http://armory.wow-europe.com/item-info.xml?i=47658

class tx_wowarmory_item extends tx_wowarmory_object{

  public function __construct(SimpleXMLElement $xml){
    parent::__construct($xml);
  }
  
  public function __get($name){
    if(!empty( $value = strval($this->xml->itemInfo->item[$name]) ))return $value;
    return parent::__get($name);// ask parent to handle
  }
  
  public static function cmp($a,$b){
    return strcasecmp($a->name,$b->name);
  }
  
  public static function query($itemID){
    //return tx_wowarmory_object::query(sprintf('http://armory.wow-europe.com/item-info.xml?i=%d',$itemID));
    return tx_wowarmory_object::query(sprintf('http://localhost/wowarmory/item-info.xml?i=%d',$itemID));
  }
  
}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/wow_armory/inc/class.tx_wowarmory_item.php']) {
  include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/wow_armory/inc/class.tx_wowarmory_item.php']);
}

?>