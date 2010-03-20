<?php

/*
 *  Represents a dungeon in wow
 *  xpath: armory/dungeon
 *
 */
require_once('class.tx_wowarmory_object.php');// = parent

//http://armory.wow-europe.com/character-sheet.xml?r=Blackhand&cn=Jobe&gn=The+Raven+Claws
//http://armory.wow-europe.com/character-talents.xml?r=Blackhand&cn=Jobe&gn=The+Raven+Claws
//http://armory.wow-europe.com/character-reputation.xml?r=Blackhand&cn=Jobe&gn=The+Raven+Claws
//http://armory.wow-europe.com/character-achievements.xml?r=Blackhand&cn=Jobe&gn=The+Raven+Claws
//http://armory.wow-europe.com/character-statistics.xml?r=Blackhand&cn=Jobe&gn=The+Raven+Claws
//http://armory.wow-europe.com/character-feed.xml?r=Blackhand&cn=Jobe&gn=The+Raven+Claws
//http://armory.wow-europe.com/vault/character-calendar.xml?r=Blackhand&cn=Jobe&gn=The+Raven+Claws

class tx_wowarmory_character extends tx_wowarmory_object{

  public function __construct(SimpleXMLElement $xml){
    parent::__construct($xml);
  }
  
  public function __get($name){
    switch($name){
      default: return parent::__get($name);// ask parent to handle
    }
  }
  
  public static function cmp($a,$b){
    return strcasecmp($a->name,$b->name);
  }
  
  // wrapper to query different sheets
  public static function query($realm,$name,$sheet=''){
    switch($sheet){
      case 't': $sheet = 'talents'; break;
      case 'r': $sheet = 'reputation'; break;
      case 'a': $sheet = 'achievements'; break;
      case 's': $sheet = 'statistics'; break;
      case 'f': $sheet = 'feed'; break;
      default : $sheet = 'sheet'; break;
    }
    //return tx_wowarmory_object::query('http://armory.wow-europe.com/character-'.$sheet.'.xml?r='.$realm.'&n='.$name);
    return tx_wowarmory_object::query('http://localhost/wowarmory/character-'.$sheet.'.xml?r='.$realm.'&n='.$name);// offline testing
  }
  
}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/wow_armory/inc/class.tx_wowarmory_character.php']) {
  include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/wow_armory/inc/class.tx_wowarmory_character.php']);
}

?>