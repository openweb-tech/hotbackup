<?php

class action extends actions
{
  public function execute()
  {
  sleep(1);
  
  $login = htmlspecialchars($_POST['login'],ENT_QUOTES);
  $password = $_POST['password'];
  
  $user = new User(0, __userdb);
  
  $user->auth($login, $password);
  
  if( $user->isAuthorized() )
    $this->redirect('');
      else
        $this->redirect('?r=auth&error=1');

  }
}

?>