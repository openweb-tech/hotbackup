<?php

class User 
{

public $dada;
public $userId = 0;
private $dbfile = '';


  function __construct($autoload = 1, $dbfile = '')
  {
  
  $this->data = array();
  $this->dbfile = $dbfile;
  
  if(isset( $_SESSION['user'] ))
    if( $_SESSION['user']['userId'] != 0 )
      {
      $this->data = $_SESSION['user'];
      $this->userId = $_SESSION['user']['userId'];
      }
  
  }

  public function loadFromFile($fn)
  {
  
  
  
  }
  
  public function saveToFile($fn)
  {
  
  }
  
  public function auth($login, $password)
  {
  
  $this->userId = 1;
  
  $this->data['userId'] = $this->userId;
  
  $_SESSION['user'] = $this->data;
  
  }
  
  public function isAuthorized()
  {
  if( $this->userId ) return 1;
    else return 0;  
  }
  
  
  function __destruct() 
  {
  
  
  
  }
  
  
  

}
?>