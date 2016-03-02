<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

echo "Servers Service started [".date('d.m.Y h:i', time())."] with PID= ".getmypid()."\n";

include __DIR__.'/conf.php';
include __corePath.'libs/service.php';
include __corePath.'libs/ApiQuery.php';
include __corePath.'libs/jsonDB.php';

if( checkLock('servers') ) die("Found .lock file, exit.\n");
lock('servers');

$serversList = new JsonDB(__serversdb);

foreach($serversList->data as $key => $server)
  if(checkServerTestTime($server, 60)) 
    {
    $query = new ApiQuery($server['address'], $server['apiKey']);
    
    $info = $query->getServerInfo();
    
    if($info->responseStatus != 'Unathorized')
      {
      $serversList->data[$key]['name'] = $info->serverName;
      $serversList->data[$key]['tasksCount'] = $info->tasksCount;;
      $serversList->data[$key]['freeSpace'] = $info->freeSpace;;
      $serversList->data[$key]['lastCheck'] = time();
      $serversList->data[$key]['status'] = 1;
      
      if($server['archSync'])
        {
        $tasksfiles = $query->getTasksFiles(true);
        // ----------------------------------
        foreach($tasksfiles as $taskId => $files)
          {
          $folder = getServersTaskFolder($server['id'], $taskId);
          foreach($files as $file)
            if(!checkArchFile($folder, $file))// download file
              {
              $fileData = $query->downloadFile($taskId, $file['name']);
              if($fileData)
                file_put_contents($folder.$file['name'], $fileData);
              }
          deleteOldFiles($folder, $files);
          }        
        // ----------------------------------
        }
      
      
      }else
      {
      echo 'Unathorized!';
      $serversList->data[$key]['lastCheck'] = time();
      $serversList->data[$key]['status'] = 3;
      }
    }

$serversList->saveToFile(__serversdb);
echo "Servers Service finished [".date('d.m.Y h:i', time())."] \n";
unLock('servers');
?>