<?php

/*
 *  Represents a dungeon in wow
 *  xpath: armory/dungeon
 *
 */
require_once('class.tx_wowarmory_object.php');// = parent

//http://armory.wow-europe.com/guild-info.xml?r=Blackhand&cn=Jobe&gn=The+Raven+Claws

class tx_wowarmory_guild extends tx_wowarmory_object{

  public function __construct(SimpleXMLElement $xml){
    parent::__construct($xml);
  }
  
  public function __get($name){
    switch($name){
      default: return parent::__get($name);// ask parent to handle
    }
  }
  
  public function __toString(){
    return sprintf('%s (%s)',$this->name,$this->realm);
  }
  
  public static function cmp($a,$b){
    return strcasecmp($a->name,$b->name);
  }
  
  public static function query($guildname){
    //return tx_wowarmory_object::query(sprintf('http://armory.wow-europe.com/guild-info.xml?gn=%s',$guildname));
    return tx_wowarmory_object::query(sprintf('http://localhost/guild-info.xml?gn=%s',$guildname));
  }
  
}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/wow_armory/inc/class.tx_wowarmory_guild.php']) {
  include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/wow_armory/inc/class.tx_wowarmory_guild.php']);
}

?>