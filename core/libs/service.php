<?php

// Check the multiprocess lock
function checkLock()
{
return file_exists(__workfolder.".lock");
}

// Save the .lock file to the work folder to prevent multi process execution
function lock()
{
return file_put_contents(__workfolder.".lock", getmypid());
}

function unLock()
{
unlink(__workfolder.".lock");
}

//--------------------------------------------------
function nextExecDateTime($task)
{
if($task['status'] == 0) return 0;//if task has been frozen

$res = 0;
$curTime = time();

switch($task['frequency']['type'])
  {
  case 'n-every-hour':
    $res = mktime(date('H', $task['lastExec']+(60*60)), $task['frequency']['n-every-hour-minute'], 0, date('n', $curTime), date('j', $curTime), date('Y', $curTime));
  break;
  
  case 'n-once':
    $res = mktime($task['frequency']['n-once-hour'], $task['frequency']['n-once-minutes'], 0, $task['frequency']['n-once-month'], $task['frequency']['n-once-day'], $task['frequency']['n-once-year']);
  break;
  
  case 'n-minutes':
    $res = $task['lastExec'] + ($task['frequency']['n-minutes-minute']*60);
  break;
  
  case 'n-day':
    $res = mktime($task['frequency']['n-day-hour'], $task['frequency']['n-day-minute'], 0, date('n', $curTime), date('j', $curTime), date('Y', $curTime));
  break;
  
  case 'n-month':
    $res = mktime( $task['frequency']['n-month-hour'], $task['frequency']['n-month-minutes'], 0, date('n', $curTime), $task['frequency']['n-month-day'], date('Y', $curTime) );
  break;
  }

return $res;
}

//--------------------------------------------------
function getTaskFolder($task)
{
if(!is_dir(__archiveDIR.$task['id']))
  if(!mkdir(__archiveDIR.$task['id']))
    return '';

return __archiveDIR.$task['id'];
}

//--------------------------------------------------
function dirSize($dir) 
{
$totalsize=0;
if ($dirstream = @opendir($dir)) 
  {
  while (false !== ($filename = readdir($dirstream))) 
    {
    if ($filename!="." && $filename!="..")
      {
      if (is_file($dir."/".$filename))
      $totalsize+=filesize($dir."/".$filename);
      if (is_dir($dir."/".$filename))
      $totalsize+=dirSize($dir."/".$filename);
      }
    }
  closedir($dirstream);
  }

return $totalsize;
}

//--------------------------------------------------
function memryFormat($size)
{
$ret = $size.' b';

if($size > (1024*1024*1024*1024))
  {
  $ret = round($size/(1024*1024*1024*1024), 1).' Tb';
  }elseif($size > (1024*1024*1024))
  {
  $ret = round($size/(1024*1024*1024), 1).' Gb';
  }elseif($size > (1024*1024))
  {
  $ret = round($size/(1024*1024), 1).' Mb';
  }elseif($size > 1024) 
  {
  $ret = round($size/1024, 1).' Kb';
  }

return $ret;
}


//--------------------------------------------------
function getMemoryUsage($task)
{
if(!is_dir(__archiveDIR.$task['id'])) return 0;

return memryFormat(dirSize(__archiveDIR.$task['id']));
}

//--------------------------------------------------
function delOldFiles($folder, $deep)
{
$filesList = array();

foreach(glob($folder."/*.*") as $file)
  $filesList[filemtime($file)] = $file;

krsort($filesList);

$start = $deep;

if( $start >= count($filesList) ) return 0;//if files count les then $deep- nothing to delete

$i = 0;

foreach($filesList as $fileName)
  {
  if($i>=$start)
    unlink($fileName);
  
  $i++;
  }

return 1;
}


//--------------------------------------------------
function filesBackup($task)
{
echo "Files backup with taskID = ".$task['id']."\n";

$archFolder = getTaskFolder($task);

if($archFolder == '')return 'Error';

$fileName = $archFolder."/".date('Y-m-d*h:i', time()).".tar.gz";

$exclude = '';
if($task['file-exclude']!='')$exclude = ' --exclude '.$task['file-exclude'];

$target = $task['file-filename'];

$execString = "tar -czvf $fileName $exclude $target";
$output = shell_exec($execString);

delOldFiles($archFolder, $task['deep']);

return 'Ok';
}

//--------------------------------------------------
function mysqlBackup($task)
{
echo "Mysql backup with taskID = ".$task['id']."\n";

$archFolder = getTaskFolder($task);

if($archFolder == '')return 'Error';

$fileName = date('Y-m-d*h:i', time());

$execString = "mysqldump -f -h ".$task['mysql-backup-address']." -u ".$task['mysql-backup-user']." -p".$task['mysql-backup-password']." ".$task['mysql-backup-name']." > $archFolder/$fileName.sql";
$output = shell_exec($execString);

$execString = "tar -czvf $archFolder/$fileName.tar.gz $archFolder/$fileName.sql";
$output = shell_exec($execString);

unlink("$archFolder/$fileName.sql");

delOldFiles($archFolder, $task['deep']);

return 'Ok';
}

?>