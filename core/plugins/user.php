<?php

class User 
{

public $dada;
public $userId = 0;
public $accessGroup = '';
private $dbfile = '';

  function __construct($autoload = 1, $dbfile = '')
  {
  
  $this->data = array();
  
  $this->dbfile = $dbfile;
  
  if( isset( $_SESSION['user']) && $autoload )
    if( $_SESSION['user']['id'] != 0 )
      {
      $this->data = $_SESSION['user'];
      $this->userId = $_SESSION['user']['id'];
      $this->accessGroup = $_SESSION['user']['accessGroup'];
      }
  
  }

  public function auth($login, $password)
  {
  
  $usersList = new jsonDB($this->dbfile);
  
  $user = $usersList->selectBy('login', $login);

  if( !empty($user) )
    if( $user['password'] == md5($password) )
      {
      $this->userId = $user['id'];
      $this->accessGroup = $user['accessGroup'];
      $this->data = $user;
      $_SESSION['user'] = $this->data;
      }
  }
  
  public function checkRights($need)
  {
  $groups = array(
   'guest' => 0,
   'manager' => 1,
   'administrator' => 2,
   );
  if( !isset($groups[$this->accessGroup]) ) return 0;
  if( !isset($groups[$need]) ) return 0;

  if( $groups[$this->accessGroup] >= $groups[$need] )
    return 1;

  return 0;
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