<?php

class action extends actions
{
  public function execute()
  {
  $user = new User(1);
  
  if( !$user->checkRights('administrator') ) return 0;
  
  $usersDB = new JsonDB(__userdb);
  
  $id = (int)$_POST['id'];
  $login = htmlspecialchars($_POST['login'],ENT_QUOTES);
  $email = htmlspecialchars($_POST['email'],ENT_QUOTES);
  $password1 = md5($_POST['password1']);
  $password2 = md5($_POST['password2']);
  $accessGroup = htmlspecialchars($_POST['accessGroup'],ENT_QUOTES);
  $alerts = htmlspecialchars($_POST['alerts'],ENT_QUOTES);
  
  
  $user = $usersDB->data[$id];
  
  $_SESSION['formSent'] = $_POST;
  
  if( $password1 != $password2 )
    {
    $this->redirect('?r=users/edit&id='.$id.'&error=Passwords do not much!');
    }
  
  $user['login'] = $login;
  $user['email'] = $email;
  $user['accessGroup'] = $accessGroup;
  $user['alerts'] = $alerts;
  
  if( $_POST['password1']!='' )
    {
    $user['password'] = $password1;
    }
  
  $usersDB->data[$id] = $user;
  
  $usersDB->saveToFile(__userdb);
  
  $_SESSION['formSent'] = array();
  
  $this->redirect('?r=users/list');

  }
}

?>