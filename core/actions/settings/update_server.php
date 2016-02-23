<?php

class action extends actions
{

  public function execute()
  {
  $user = new User(1);
  
  if( !$user->checkRights('administrator') ) return 0;
  
  $serversDB = new JsonDB(__serversdb);
  
  $id = (int)$_POST['id'];
  
  $serversDB->data[$id]['address'] = $_POST['address'];
  $serversDB->data[$id]['apiKey'] = $_POST['apiKey'];
  
  $serversDB->saveToFile(__serversdb);
  
  $this->redirect('?r=settings/servers');

  }
}

?>