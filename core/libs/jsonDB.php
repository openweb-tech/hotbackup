<?php

class JsonDB 
{

public $data = array();
private $dbfile = '';


  function __construct($dbfile = '')
  {
  $this->dbfile = $dbfile;
  
  if( $dbfile == '') return 0;
  
  $this->loadFromFile($this->dbfile);

  }

  public function loadFromFile($fn)
  {
  
  if( !file_exists($fn) ) return $this->data = array();
  
  $this->data = json_decode( file_get_contents($fn), true );
  
  if( gettype($this->data) != 'array' ) $this->data = array();
  
  return $this->data;
  
  }
  
  public function saveToFile($fn)
  {
  
  file_put_contents($fn, json_encode($this->data));
  
  }
  
  public function selectBy($selector, $value)
  {

  foreach($this->data as $key => $val)
    if( $val[$selector] == $value )
      {
      $val['_id'] = $key;
      return $val;
      }
  
  return array();
  }
  
  public function deleteById($id)
  {
  unset($this->data[$id]);  
  }
  
  function __destruct() 
  {
  
  
  
  }
  
  
  

}
?>