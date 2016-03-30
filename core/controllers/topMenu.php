<?php

class TopMenu extends Controller
{ 
  public function prepare()
  {
  $user = new User(1);
  $this->data['userId'] = $user->userId;
  $this->data['accessGroup'] = $user->accessGroup;
  $this->data['userName'] = $user->data['login'];
  }
  
  public function show()
  {
  return $this->view(__corePath.'views/topMenu.php', $this->data);
  }
}
?>