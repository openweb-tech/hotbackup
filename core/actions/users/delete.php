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
  
  $usersDB = new JsonDB(__userdb);
  
  unset($usersDB->data[$id]);
  
  $usersDB->saveToFile(__userdb);
  
  $this->redirect('?r=users/list');

  }
}

?>