<?php

/*
 *  Represents the base class
 *  xpath: -
 *
 */

//http://armory.wow-europe.com/wow-icons/_images/64x64/inv_wand_32.jpg
//http://armory.wow-europe.com/wow-icons/_images/43x43/inv_enchant_abysscrystal.png
//http://armory.wow-europe.com/wow-icons/_images/21x21/spell_holy_summonchampion.png

define(ARMORY_URL,'http://armory.wow-europe.com/');
//define(ARMORY_URL,'http://localhost/');

class tx_wowarmory_object{
  
  public $xml = array();
	
  public function __construct(SimpleXMLElement $xml){
    $this->xml = $xml;
  }
  
  public function __get($name){
    switch($name){
      default: return strval($this->xml[$name]);
    }
  }
  
  public function __toString(){
    return $this->xml->asXML();
  }
  
  /*
   * load remote xml data
   */
	public static function query($page,$parameters=''){
    $options = array( 'http' => array(
      'user_agent' => 'Mozilla/5.0 (Windows; U; Windows NT 5.1; de; rv:1.9.2) Gecko/20100115 Firefox/3.6 (.NET CLR 3.5.30729)',
      'max_redirects' => 10,
      'timeout' => 60,
			'header' => array(
        'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
        'Accept-Language: de-de,de;q=0.8,en-us;q=0.5,en;q=0.3',
        'Accept-Encoding: gzip,deflate',
        'Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7',
        'Keep-Alive: 115',
        'Connection: keep-alive',
      ),
    ));
		$url = ARMORY_URL.$page.'.xml';
		if($parameters)$url = $url.'?'.$parameters;
    print("<!-- tx_wowarmory_object::query(\"".$url."\") -->\n");//DEBUG
		libxml_use_internal_errors(false);
    libxml_clear_errors();
		libxml_set_streams_context(stream_context_create($options));
		$xml = @simplexml_load_file($url);
    if(empty($xml))throw new Exception("ARMORY DIDN'T REPLY (".$url.")\n\n".implode("\n",$http_response_header)."\n");
    return $xml;
  }
  
  /*
   *  convert a SimpleXMLElement hirachy into an array
   */
  public static function xml_array(SimpleXMLElement $xml){
    $result = array();
		// parse attributes
    foreach( $xml->attributes() as $k => $v )$result[strtolower($k)] = strval($v);
		// parse children
    foreach( $xml->children() as $k => $v )if($v['id']){
			$result[strtolower($k)][strval($v['id'])] = self::xml_array($v);
		}else{
			$result[strtolower($k)][] = self::xml_array($v);
		}
    return $result;
  }
	
  public static function getImageURL($key,$size=64){
    switch($size){
      case 21: $size = '21x21'; break;
      case 43: $size = '43x43'; break;
      default: $size = '64x64'; break;
    }
    return sprintf('http://armory.wow-europe.com/wow-icons/_images/%s/%s',$size,$key);
  }
  
}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/wow_armory/inc/class.tx_wowarmory_object.php']) {
  include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/wow_armory/inc/class.tx_wowarmory_object.php']);
}

?>