<?php
echo "Service started [".date('d.m.Y h:i', time())."] with PID= ".getmypid()."\n";

include $_SERVER['PWD'].'/conf.php';
include __corePath.'libs/service.php';
include __corePath.'libs/jsonDB.php';

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
    switch($task['type'])
      {
      case 'files_backup':
        $res = filesBackup($task);
        echo "$res \n";
        if($res == 'Ok')
          $tasksList->data[$key]['lastExec'] = time();
      break;
      
      case 'mysql_backup':
        $res = mysqlBackup($task);
        echo "$res \n";
        if($res == 'Ok')
          $tasksList->data[$key]['lastExec'] = time();
      break;
      }
  echo "-------------------------------------\n\n";
  }

$tasksList->saveToFile(__taskdb);
echo "Service finished [".date('d.m.Y h:i', time())."] \n";
unLock('tasks');
?>