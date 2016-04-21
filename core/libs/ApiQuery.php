<?php 

class ApiQuery
{
  private $httpPath;
  private $token;
  
  
  function __construct($host, $token) 
  {
  $this->httpPath = $host.'/api.php';
  $this->token = $token;
  }
  
  function getServerInfo($returnarray = false)
  {
  $params = array('action' => 'serverinfo');
  $params['token'] = $this->genToken($params, $this->token);
  $query = $this->getQuery($params);
  
  $res = file_get_contents($query);
  if($res)
    return json_decode($res, $returnarray);
  else
    return array('responseStatus' => 'error');  
  }
  
  function deleteTask($id, $returnarray = false)
  {
  $params = array('action' => 'deleteTask', 'id' => $id);
  $params['token'] = $this->genToken($params, $this->token);
  $query = $this->getQuery($params);
  $res = file_get_contents($query);
  if($res)
    return json_decode($res, $returnarray);
  else
    return array('responseStatus' => 'error');  
  }
  
  function updateTask($task, $id, $returnarray = false)
  {
  $params = array('action' => 'updateTask', 'task' => base64_encode(json_encode($task)), 'id' => $id);
  $params['token'] = $this->genToken($params, $this->token);
  $query = $this->getQuery($params);
  $res = file_get_contents($query);
  if($res)
    return json_decode($res, $returnarray);
  else
    return array('responseStatus' => 'error');  
  }
  
  function addTask($task, $returnarray = false)
  {
  $params = array('action' => 'addTask', 'task' => base64_encode(json_encode($task)));
  $params['token'] = $this->genToken($params, $this->token);
  $query = $this->getQuery($params);
  $res = file_get_contents($query);
  if($res)
    return json_decode($res, $returnarray);
  else
    return array('responseStatus' => 'error');  
  }
  
  function getTasksList($returnarray = false)
  {
  $params = array('action' => 'taskslist');
  $params['token'] = $this->genToken($params, $this->token);
  
  $query = $this->getQuery($params);
  $res = file_get_contents($query);
  if($res)
    return json_decode($res, $returnarray);
  else
    return array('responseStatus' => 'error');  
  }
  
  function getTasksFiles($returnarray = false)
  {
  $params = array('action' => 'tasksfiles');
  $params['token'] = $this->genToken($params, $this->token);
  
  $query = $this->getQuery($params);
  $res = file_get_contents($query);
  if($res)
    return json_decode($res, $returnarray);
  else
    return array('responseStatus' => 'error');  
  }
  
  function downloadFile($taskId, $fileName)
  {
  $params = array('action' => 'downloadfile', 'taskId' => $taskId, 'fileName' => $fileName);
  $params['token'] = $this->genToken($params, $this->token);
  
  $query = $this->getQuery($params);
  $res = file_get_contents($query);
  if($res)
    return json_decode($res, $returnarray);
  else
    return array('responseStatus' => 'error');  
  }
  
  function getQuery($params)
  {
  $query = '';
  
  foreach($params as $key=>$val)
    $query.="$key=$val&";
  
  return $this->httpPath.'?'.$query;
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

  function __destruct() 
  {

  }  
}

?>