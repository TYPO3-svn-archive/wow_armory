<?php

/*
 *  Represents a dungeon in wow
 *  xpath: armory/dungeon
 *
 */
require_once('class.tx_wowarmory_object.php');// = parent

//http://armory.wow-europe.com/item-info.xml?i=47658

class tx_wowarmory_item extends tx_wowarmory_object{

  private $data = array();

  public function __construct($itemID){
    $xml = self::query($itemID);// get data
    if(!$xml->itemInfo->item)throw new Exception('no valid item');// check data
    $this->data = tx_wowarmory_object::xml_array($xml->itemInfo->item);// transform data
    // compact data:
    $this->data['cost'] = $this->data['cost'][0]['token'];
    $this->data['disenchantskillrank'] = $this->data['disenchantloot'][0]['requiredskillrank'];
    $this->data['disenchantloot'] = $this->data['disenchantloot'][0]['item'];
    $this->data['vendors'] = $this->data['vendors'][0]['creature'];
  }
  
  public function __get($name){
    switch($name){
      case 'markers': return array_filter($this->data,'tx_wowarmory_item::is_marker');
      case 'subparts': return array_filter($this->data,'tx_wowarmory_item::is_subpart');
      default: return $this->data[$name];
    }
  }
  
  public function __toString(){
    return t3lib_div::view_array($this->markers).t3lib_div::view_array($this->subparts);
  }
  
  public static function cmp($a,$b){
    return strcasecmp($a->name,$b->name);
  }
  
  public static function query($itemID){
    return parent::query('item-info',sprintf('i=%d',$itemID));
  }
  
  public static function is_subpart($a){
    return is_array($a);
  }
  
  public static function is_marker($a){
    return !is_array($a);
  }
  
}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/wow_armory/inc/class.tx_wowarmory_item.php']) {
  include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/wow_armory/inc/class.tx_wowarmory_item.php']);
}

?>