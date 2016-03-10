<?php

class Page extends Controller
{ 

  public function prepare()
  {
  $user = new User(1);
  if( !$user->isAuthorized() ) $this->redirect('?r=auth');
  
  $fileName = str_replace('/', '', $_GET['fileName']);
  $folder = str_replace('.', '', $_GET['folder']);
  $taskId = str_replace('.', '', $_GET['taskId']);
  $serverId = '';
  if(isset($_GET['serverId'])) $serverId = (int)$_GET['serverId'];
  
  switch($folder)
    {
    case 'local':
      $path = __archiveDIR."local/$taskId/$fileName";
      break;
      
    case 'remote':
      $path = __archiveDIR."servers/$serverId/$taskId/$fileName";
      break;
    }
  //echo $path;
  if(file_exists($path))
    {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Length: ' . filesize($path));
    header('Content-Disposition: attachment; filename=' . basename($path));
    readfile($path);
    }
  die();
  }

}
?>