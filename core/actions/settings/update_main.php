<?php

class action extends actions
{
  public function execute()
  {
  $user = new User(1);
  
  if( !$user->checkRights('administrator') ) return 0;
  
  $settingsDB = new JsonDB(__settingsdb);
  
  $settingsDB->data['serverName'] = $_POST['serverName'];
  $settingsDB->data['shortName'] = $_POST['shortName'];
  $settingsDB->data['apiKey'] = $_POST['apiKey'];
  $settingsDB->data['lang'] = $_POST['lang'];

  $settingsDB->saveToFile(__settingsdb);
  
  $this->redirect('?r=settings/main');

  }
}

?>