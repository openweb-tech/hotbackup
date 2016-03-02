<?php

// Check the multiprocess lock
function checkLock($name)
{
return file_exists(__workfolder.".".$name."lock");
}

// Save the .lock file to the work folder to prevent multi process execution
function lock($name)
{
return file_put_contents(__workfolder.".".$name."lock", getmypid());
}

function unLock($name)
{
unlink(__workfolder.".".$name."lock");
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
if(!is_dir(__archiveDIR.'local/'.$task['id']))
  if(!mkdir(__archiveDIR.'local/'.$task['id']))
    return '';

return __archiveDIR.'local/'.$task['id'];
}

function getServersTaskFolder($serverid, $task)
{
if(!is_dir(__archiveDIR.'servers/'.$serverid.'/'.$task['id']))
  if(!mkdir(__archiveDIR.'servers/'.$serverid.'/'.$task['id']))
    return '';

return __archiveDIR.'servers/'.$serverid.'/'.$task['id'];
}

function getServerFolder($task)
{
if(!is_dir(__archiveDIR.'servers/'.$task['id']))
  if(!mkdir(__archiveDIR.'servers/'.$task['id']))
    return '';

return __archiveDIR.'local/'.$task['id'];
}

function checkArchFile($dir, $file)
{
if(!file_exists($dir.'/'.$file['name'])) return false;
if(filesize($dir.'/'.$file['name']) != $file['size']) return false;
return true;
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

function checkFile($folder, $files, $file)
{
$fname = str_replace($folder, '', $file);
$tr = false;

foreach($files as $fn)
  if($fn['name'] == $fname)
    $tr = true;

return $tr;
}

function deleteOldFiles($folder, $files)
{
$folderFiles = glob($folder.'*');

foreach($folderFiles as $folderFile)
  if( !checkFile($folder, $files, $folderFile) )
    unlink($folderFile);
}

//--------------------------------------------------
function getMemoryUsage($task)
{
if(!is_dir(__archiveDIR.'local/'.$task['id'])) return 0;

return memryFormat(dirSize(__archiveDIR.'local/'.$task['id']));
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

function addLastSlash($path)
{
$symbol = substr($path, strlen($path)-1, 1);
if($symbol != '/') return $path.'/';
return $path;
}

function getStructFiles($folder)
{
$struct = glob(addLastSlash($folder)."*");

$res = array();

foreach($struct as $key => $item)
  if(is_dir($item))
    {
    $res = array_merge($res, getStructFiles($item));
    } else {
    $res[] = $item;
    }

return $res;
}

function getStructFolders($folder)
{
$struct = glob(addLastSlash($folder)."*");

$res = array();

foreach($struct as $key => $item)
  if(is_dir($item))
    {
    $res[] = $item;
    $res = array_merge($res, getStructFolders($item));
    } 

return $res;
}

function exCheckItem($item, $excludeArray)
{
foreach($excludeArray as $exItem)
  if(strpos('---'.$item, trim($exItem)))
    return false;
return true;
}

function excludeFiles($filesArray, $excludeArray)
{
$tmpArray = array();
foreach($filesArray as $key => $item)
  {
  if(exCheckItem($item, $excludeArray))
    $tmpArray[] = $item;
  }
return $tmpArray;
}

//--------------------------------------------------
function filesBackup($task)
{
echo "Files backup with taskID = ".$task['id']."\n";

$archFolder = getTaskFolder($task);
$target = $task['file-filename'];
if($archFolder == '')return 'Error';
$fileName = $archFolder."/".date('Y-m-d*h:i', time()).".tar.gz";

$zip = new ZipArchive();
$zip->open($fileName, ZipArchive::CREATE | ZipArchive::OVERWRITE);

$exclude = explode("\n", $task['file-exclude']);
if(!$exclude[0]) $exclude = array();

if(is_file($target))// Archiving only 1 file
  {
  $zip->addFile($target, basename($target));
  } else { // Archiving folder
  $files = excludeFiles(getStructFiles($target), $exclude);
  
  $folders = excludeFiles(getStructFolders($target), $exclude);
  
  foreach($folders as $folder)
    {
    $zip->addEmptyDir(str_replace(addLastSlash($target), '', $folder) );
    }
  
  foreach($files as $file)
    {
    $zip->addFile($file, str_replace(addLastSlash($target), '', $file));
    }
  echo "Num files = ".$zip->numFiles."\n";
  echo "Status = ".$zip->status. "\n";
  }

$zip->close();

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

$world_dumper = Shuttle_Dumper::create(array(
	'host' => $task['mysql-backup-address'],
	'username' => $task['mysql-backup-user'],
	'password' => $task['mysql-backup-password'],
	'db_name' => $task['mysql-backup-name'],
));

echo "$archFolder/$fileName.sql.gz\n";

$world_dumper->dump("$archFolder/$fileName.sql.gz");

delOldFiles($archFolder, $task['deep']);

return 'Ok';
}

function checkServerTestTime($server, $timeout)
{
$interval = time() - $server['lastCheck'];

if($interval >= $timeout) return 1;

return 0;
}

?>