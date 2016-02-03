<?php

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
  
  $id = time();
  
  $newTask = array();
  $newTask['id'] = $id;
  $newTask['added'] = time();
  $newTask['type'] = 'mysql_backup';
  $newTask['title'] = $_POST['title'];
  $newTask['status'] = $_POST['status'];
  $newTask['execStatus'] = 0;
  $newTask['lastExec'] = 0;
  $newTask['deep'] = (int)$_POST['deep'];;
  $newTask['frequency'] = $frequency;
  $newTask['mysql-backup-filename'] = $_POST['mysql-backup-filename'];
  $newTask['mysql-backup-address'] = $_POST['mysql-backup-address'];
  $newTask['mysql-backup-name'] = $_POST['mysql-backup-name'];
  $newTask['mysql-backup-user'] = $_POST['mysql-backup-user'];
  $newTask['mysql-backup-password'] = $_POST['mysql-backup-password'];
  
  $tasksDB = new JsonDB(__taskdb);
  
  $tasksDB->data[$id] = $newTask;
  
  $tasksDB->saveToFile(__taskdb);
  
  $this->redirect('?r=tasks/list');

  }
}

?>