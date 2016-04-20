<?php

class action extends actions
{

  public function execute()
  {
  $user = new User(1);
  
  if( !$user->checkRights('administrator') )
    {
    addNotification($this->_LANG['misc']["You don't have permissions"], 'warning');
    return 0;
    }
  
  $serversDB = new JsonDB(__serversdb);
  
  $id = (int)$_POST['id'];
  
  $serversDB->data[$id]['address'] = $_POST['address'];
  $serversDB->data[$id]['apiKey'] = $_POST['apiKey'];
  $serversDB->data[$id]['archSync'] = $_POST['archSync'];
  $serversDB->data[$id]['archDepth'] = $_POST['depth'];
  
  $serversDB->saveToFile(__serversdb);
  
  $this->redirect('?r=servers/servers');

  }
}

?>