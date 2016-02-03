<?php

class action extends actions
{
  public function execute()
  {
  
  $user = new User(1);
  
  if( !$user->checkRights('administrator') ) return 0;
  
  $login = htmlspecialchars($_POST['login'],ENT_QUOTES);
  $email = htmlspecialchars($_POST['email'],ENT_QUOTES);
  $password1 = md5($_POST['password1']);
  $password2 = md5($_POST['password2']);
  $accessGroup = htmlspecialchars($_POST['accessGroup'],ENT_QUOTES);
  $alerts = htmlspecialchars($_POST['alerts'],ENT_QUOTES);
  
  $_SESSION['formSent'] = $_POST;
  
  if( $password1 != $password2 )
    {
    $this->redirect('?r=users/add&error=Passwords do not much!');
    }
  
  $id = time();
  
  $newUser = array(
    'id' => $id,
    'login' => $login,
    'email' => $email,
    'password' => $password1, 
    'accessGroup' => $accessGroup,
    'alerts' => $alerts  
  );
  
  $usersDB = new JsonDB(__userdb);
  
  $usersDB->data[$id] = $newUser;
  
  $usersDB->saveToFile(__userdb);
  
  $_SESSION['formSent'] = array();
  
  $this->redirect('?r=users/list');

  }
}

?>