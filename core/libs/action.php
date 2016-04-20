<?php 

class Actions
{
  function __construct($db) 
  {
  global $_LANG;
  $this->_LANG = $_LANG;
  $this->db = $db;
  }

  public function redirect($path)
  {
  header('location: '.__spath.$path);
  die();
  }
  
  function __destruct() 
  {

  }  
}

?>