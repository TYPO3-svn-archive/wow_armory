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
      case 'members': return $this->xml->guildInfo->guild->members;
      default: return parent::__get($name);// ask parent to handle
    }
  }
  
  public static function cmp($a,$b){
    return strcasecmp($a->name,$b->name);
  }
  
  public static function query($realm,$guildname,$charname=''){
    return tx_wowarmory_object::query('guild-info',sprintf('r=%s&gn=%s&cn=%s',urlencode($realm),urlencode($guildname),urlencode($charname)));
  }
  
}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/wow_armory/inc/class.tx_wowarmory_guild.php']) {
  include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/wow_armory/inc/class.tx_wowarmory_guild.php']);
}

?>