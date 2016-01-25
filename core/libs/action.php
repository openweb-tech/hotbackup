<?php 

class Actions
{
  function __construct($db) 
  {
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