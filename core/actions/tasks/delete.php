<?php

class action extends actions
{
  public function execute()
  {
  
  $user = new User(1);
  
  if( !$user->checkRights('administrator') ) return 0;
  
  $id = (int)$_POST['id'];
  
  $tasksDB = new JsonDB(__taskdb);
  
  unset($tasksDB->data[$id]);
  
  $tasksDB->saveToFile(__taskdb);
  
  $this->redirect('?r=tasks/list');

  }
}

?>