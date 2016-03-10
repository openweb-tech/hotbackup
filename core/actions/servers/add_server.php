<?php

class action extends actions
{
  public function newServer($address, $apiKey, $archSync, $archDepth)
  {
  $server = array();
  
  $server['address'] = $address;
  $server['apiKey'] = $apiKey;
  $server['archSync'] = $archSync;
  $server['archDepth'] = $archDepth;
  $server['name'] = '';
  $server['lastCheck'] = 0;
  $server['status'] = 0;
  $server['tasksCount'] = 0;
  $server['freeSpace'] = 0;
  
  return $server;
  }

  public function execute()
  {
  $user = new User(1);
  
  if( !$user->checkRights('administrator') ) return 0;
  
  $address = $_POST['address'];
  $apiKey = $_POST['apiKey'];
  $archSync = $_POST['archSync'];
  $archDepth = $_POST['depth'];
  
  $newServer = $this->newServer($address, $apiKey, $archSync, $archDepth);
  
  $serversDB = new JsonDB(__serversdb);
  
  $id = time();
  
  $newServer['id'] = $id;
  
  $serversDB->data[$id] = $newServer;
  
  $serversDB->saveToFile(__serversdb);
  
  $this->redirect('?r=servers/servers');

  }
}

?>