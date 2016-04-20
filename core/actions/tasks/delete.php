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
  
  $tasksDB = new JsonDB(__taskdb);
  
  unset($tasksDB->data[$id]);
  
  $tasksDB->saveToFile(__taskdb);
  
  $dir = __archiveDIR."local/$id";
  deleteDir($dir);
  
  $this->redirect('?r=tasks/list');
  }
}

?>