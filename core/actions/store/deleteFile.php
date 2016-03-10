<?php

class action extends actions
{
  public function execute()
  {
  
  $user = new User(1);
  
  if( !$user->checkRights('administrator') ) return 0;
  
  $taskId = (int)$_POST['taskId'];
  $fileName = str_replace('/', '', $_POST['fileName']);
  $folder = $_POST['folder'];
  $server = (int)$_POST['server'];
  
  switch($folder)
    {
    case 'local':
      $path = __archiveDIR."local/$taskId/$fileName";
      unlink($path);
      $this->redirect("?r=store/local/folder&id=$taskId");
        break;
    
    case 'remote':
      $path = __archiveDIR."servers/$server/$taskId/$fileName";
      unlink($path);
      $this->redirect("?r=store/remote/folder&fid=$taskId&sid=$server");
        break;
    }
  }
}

?>