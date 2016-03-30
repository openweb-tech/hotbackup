<?php
include __corePath.'libs/ApiQuery.php';

class action extends actions
{
  public function execute()
  {
  $user = new User(1);
  
  if( !$user->checkRights('administrator') ) return 0;
  
  $frequency = array();
  
  $frequency['type'] = $_POST['n-start'];
  
  switch($_POST['n-start']) {
    case 'n-minutes':
      $frequency['n-minutes-minute'] = (int)$_POST['n-minutes-minute'];
    break;
    
    case 'n-every-hour':
      $frequency['n-every-hour-minute'] = (int)$_POST['n-every-hour-minute'];
    break;
    
    case 'n-day':
     $frequency['n-day-hour'] = (int)$_POST['n-day-hour'];
     $frequency['n-day-minute'] = (int)$_POST['n-day-minute'];
    break;
    
    case 'n-month':
      $frequency['n-month-day'] = (int)$_POST['n-month-day'];
      $frequency['n-month-hour'] = (int)$_POST['n-month-hour'];
      $frequency['n-month-minutes'] = (int)$_POST['n-month-minutes'];
    break;
    
    case 'n-once':
      $frequency['n-once-month'] = (int)$_POST['n-once-month'];
      $frequency['n-once-day'] = (int)$_POST['n-once-day'];
      $frequency['n-once-year'] = (int)$_POST['n-once-year'];
      $frequency['n-once-hour'] = (int)$_POST['n-once-hour'];
      $frequency['n-once-minutes'] = (int)$_POST['n-once-minutes'];
    
    break;
  }
  $sid = (int)$_POST['sid'];
  $serversList = new JsonDB(__serversdb);  
  $newTask = array();
  $newTask['added'] = time();
  $newTask['type'] = 'files_backup';
  $newTask['title'] = $_POST['title'];
  $newTask['status'] = $_POST['status'];
  $newTask['execStatus'] = 0;
  $newTask['lastExec'] = time();
  $newTask['deep'] = (int)$_POST['deep'];;
  $newTask['frequency'] = $frequency;
  $newTask['file-filename'] = $_POST['file-filename'];
  $newTask['file-exclude'] = htmlspecialchars($_POST['file-exclude'], ENT_QUOTES);
  
  $query = new ApiQuery($serversList->data[$sid]['address'], $serversList->data[$sid]['apiKey']);
  
  $result = $query->addTask($newTask, true);
  
  if($result['responseStatus'] == 'success')
    {
    $id = (int)$result['id'];
    $serversList->data[$sid]['tasks'][$id] = $result['task'];
    $serversList->saveToFile(__serversdb);
    }
  
  $this->redirect('?r=servers/server_tasks_list&id='.$sid);
  }
}

?>