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
  
  $id = (int)$_POST['id'];
  
  $serversDB = new JsonDB(__serversdb);
  
  $server = $serversDB->data[$id];
  
  $serversDB->deleteById($id);  
  
  $serversDB->saveToFile(__serversdb);
  
  deleteDir( __archiveDIR.'servers/'.$server['id']);
  
  $this->redirect('?r=servers/servers');
  }
}

?>