<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

echo "Service started [".date('d.m.Y h:i', time())."] with PID= ".getmypid()."\n";

include __DIR__.'/conf.php';
include __corePath.'libs/service.php';
include __corePath.'libs/jsonDB.php';
include __corePath.'libs/dumper.php';

if( checkLock('tasks') ) die("Found .lock file, exit.\n");
lock('tasks');

$tasksList = new JsonDB(__taskdb);

foreach($tasksList->data as $key=>$task)
  {
  $nextExec = nextExecDateTime($task);
  
  echo "+++++++++++++++++++++++++++++++++++++\n";
  echo $task['title']."\n";
  echo "+++++++++++++++++++++++++++++++++++++\n";
  echo "CurtTime = ".date('d.m.Y h:i', time())."\n";
  echo "Lastexec = ".date('d.m.Y h:i', $task['lastExec'])."\n";
  echo "NextExec = ".date('d.m.Y h:i', $nextExec)."\n";
  
  if((time() >= $nextExec) && ($nextExec > 0) )
    {
    switch($task['type'])
      {
      case 'files_backup':
        $res = 0;
        $tasksList->data[$key]['execStatus'] = 0;
        try 
          {
          $res = filesBackup($task);
          }
        catch(Exception $e)
          {
          echo $e->getMessage()."\n";
          $tasksList->data[$key]['execStatus'] = 2;
          }
        echo "$res \n";
        if($res == 'Ok')
          {
          $tasksList->data[$key]['lastExec'] = time();
          // if task have to execute only once
          if( $tasksList->data[$key]['frequency']['type'] == 'n-once' )
            $tasksList->data[$key]['status'] = 0;// disable the task
          }
      break;
      
      case 'mysql_backup':
        $res = 0;
        $tasksList->data[$key]['execStatus'] = 0;
        try
          {
          $res = mysqlBackup($task);
          }
        catch(Exception $e)
          {
          echo $e->getMessage()."\n";
          $tasksList->data[$key]['execStatus'] = 2;
          }
        echo "$res \n";
        if($res == 'Ok')
          {
          $tasksList->data[$key]['lastExec'] = time();
          // if task have to execute only once
          if( $tasksList->data[$key]['frequency']['type'] == 'n-once' )
            $tasksList->data[$key]['status'] = 0;// disable the task
          }
      break;
      }
    }
  }

$tasksList->saveToFile(__taskdb);
echo "Service finished [".date('d.m.Y h:i', time())."] \n";
unLock('tasks');
?>