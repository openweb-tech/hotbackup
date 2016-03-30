<?php
include __corePath.'libs/ApiQuery.php';

class action extends actions
{
  public function execute()
  {
  
  $user = new User(1);
  
  if( !$user->checkRights('administrator') ) return 0;
  
  $id = (int)$_POST['id'];
  $sid = (int)$_POST['sid'];
  $serversList = new JsonDB(__serversdb);
  
  $query = new ApiQuery($serversList->data[$sid]['address'], $serversList->data[$sid]['apiKey']);
  
  $result = $query->deleteTask($id, true);

  if($result['responseStatus'] == 'success')
    {
    $id = (int)$result['id'];
    unset($serversList->data[$sid]['tasks'][$id]);
    $serversList->saveToFile(__serversdb);
    $dir = __archiveDIR."servers/$sid/$id";
    deleteDir($dir);
    }
  
  $this->redirect('?r=servers/server_tasks_list&id='.$sid);
  }
}

?>