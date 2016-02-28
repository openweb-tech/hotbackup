<?php 

class ApiResponse
{
  private $settings;
  
  
  function __construct($settingsdb, $serversdb, $taskdb, $userdb) 
  {
  $settings = new JsonDB($settingsdb);
  $this->settingsdb = $settingsdb;
  $this->serversdb = $serversdb;
  $this->taskdb = $taskdb;
  $this->userdb = $userdb;  
  
  $this->settings = $settings->data;
  }
  
  function response()
  {
  $action = $this->getAction();
  $params = $this->getParams();
  
  if(!$this->checkToken())die(json_encode(array('responseStatus' => 'Unathorized')));
  
  switch($action)
    {
    case 'serverinfo':
      return json_encode($this->getServerInfo());
      break;
    
    case 'taskslist':
      return json_encode($this->getTasksList());
      break;
    
    case 'tasksfiles':
      return json_encode($this->getTasksFiles());
      break;
    
    case 'downloadfile':
      return $this->downloadFile($params['taskId'], $params['fileName']);
      break;
    
    }
  }
  
  function downloadFile($task, $fileName)
  {
  if(file_exists(__archiveDIR.'local/'.$task.'/'.$fileName))
    return file_get_contents(__archiveDIR.'local/'.$task.'/'.$fileName);
  return '';
  }
  
  
  function getTasksFiles()
  {
  $tasks = new JsonDB($this->taskdb);
  
  $res = array();
  foreach($tasks->data as $id => $task)
    {
    $files = glob(__archiveDIR.'local/'.$id.'/*');
    
    $filesRes = array();
    
    foreach($files as $key => $file)
      if( ($file !='.') && ($file !='..') && (!is_dir(__archiveDIR.'local/'.$id.'/'.$file)) )
        $filesRes[] = array('name' => str_replace(__archiveDIR.'local/'.$id.'/', '', $file), 'updated' => filemtime($file), 'size' => filesize($file));
    
    $res[$id] = $filesRes;
    }

  return $res;
  }
  
  function getTasksList()
  {
  $tasks = new JsonDB($this->taskdb);
  
  return $tasks->data;
  }
  
  function getServerInfo()
  {
  $tasks = new JsonDB($this->taskdb);
  
  $result = $this->settings;
  unset($result['apiKey']);
  $result['serverSoftware'] = $_SERVER['SERVER_SOFTWARE'];
  $result['documentRoot'] = $_SERVER['DOCUMENT_ROOT'];
  $result['freeSpace'] = disk_free_space(getcwd());
  $result['tasksCount'] = count($tasks->data);
  $result['responseStatus'] = 'ok';
  
  return $result;
  }
  
  function checkToken()
  {
  if(!isset($_REQUEST['token']))die(json_encode(array('responseStatus' => 'Unathorized')));
  $params = $_REQUEST;
  unset($params['token']);
  $token = $this->genToken($params, $this->settings['apiKey']);
  if($token == $_REQUEST['token']) return 1;
  return 0;
  }
  
  function genToken($params, $apiKey)
  {
  $ar = $params;
  ksort($ar);
  $st = '';
  foreach($ar as $key => $val)
    $st.=$key.$val;
  return md5($st.$apiKey);
  }
  
  function getParams()
  {
  $params = $_REQUEST;
  
  unset($params['action']);
  unset($params['token']);
  
  return $params;
  }
  
  
  function getAction()
  {
  if(!isset($_REQUEST['action']))die('No action');
  
  return $_REQUEST['action'];
  }

  function __destruct() 
  {

  }  
}

?>