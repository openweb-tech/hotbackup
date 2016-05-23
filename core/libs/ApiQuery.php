<?php 

class ApiQuery
{
  private $httpPath;
  private $token;
  
  
  function __construct($host, $token, $timeout = 5) 
  {
  $this->httpPath = $host.'/api.php';
  $this->token = $token;
  
  $this->ctx = stream_context_create(array(
      'http' => array(
        'timeout' => $timeout
        )
      )
    ); 
  
  }
  
  function getServerInfo($returnarray = false)
  {
  $params = array('action' => 'serverinfo');
  $params['token'] = $this->genToken($params, $this->token);
  $query = $this->getQuery($params);
  $res = file_get_contents($query, 0, $this->ctx);
  if($res != '')
    return json_decode($res, $returnarray);
  else
    return array('responseStatus' => 'error');  
  }
  
  function deleteTask($id, $returnarray = false)
  {
  $params = array('action' => 'deleteTask', 'id' => $id);
  $params['token'] = $this->genToken($params, $this->token);
  $query = $this->getQuery($params);
  $res = file_get_contents($query, 0, $this->ctx);
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
  $res = file_get_contents($query, 0, $this->ctx);
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
  $res = file_get_contents($query, 0, $this->ctx);
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
  $res = file_get_contents($query, 0, $this->ctx);
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
  $res = file_get_contents($query, 0, $this->ctx);
  if($res)
    return json_decode($res, $returnarray);
  else
    return array('responseStatus' => 'error');  
  }
  
  function downloadFile($taskId, $fileName, $saveName)
  {
  $params = array('action' => 'downloadfile', 'taskId' => $taskId, 'fileName' => $fileName);
  $params['token'] = $this->genToken($params, $this->token);
  $query = $this->getQuery($params);
  
  $fp = fopen($saveName, 'w');
  $ch = curl_init($query);
  curl_setopt($ch, CURLOPT_FILE, $fp);
  $data = curl_exec($ch);
  curl_close($ch);
  fclose($fp);
  return true;
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