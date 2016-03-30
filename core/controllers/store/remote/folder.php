<?php

include_once __corePath.'controllers/header.php';
include_once __corePath.'controllers/footer.php';
include_once __corePath.'controllers/topMenu.php';

class Page extends Controller
{ 
  private function getlFolderFiles($serversList, $sid, $fid)
  {
  $tasks = $serversList->data[$sid]['tasks'];
  
  $res = array();
  
  foreach(glob(__archiveDIR."servers/$sid/$fid/*") as $path)
    {
    $name = str_replace(__archiveDIR."servers/$sid/$fid/", '', $path);
    
    $res[] = array('id' => $fid,
      'name' => $name,
      'size' => filesize($path),
      'time' => filectime($path)
      );
    }

  return $res;
  }
  
  public function prepare()
  {
  
  $user = new User(1);
  if( !$user->isAuthorized() ) $this->redirect('?r=auth');
  
  $header = new PageHeader($this->curpage, $this->db, $this->config);
  $footer = new PageFooter($this->curpage, $this->db, $this->config);
  $topMenu = new TopMenu($this->curpage, $this->db, $this->config);
  $topMenu->prepare();
  
  $serversList = new JsonDB(__serversdb);
  
  $sid = (int)$_GET['sid'];
  $fid = (int)$_GET['fid'];
  
  $serverTitle = 'Undefined';
  $taskTitle = 'Undefined';
  
  if(isset($serversList->data[$sid]))
    $serverTitle = $serversList->data[$sid]['name'];

  if(isset($serversList->data[$sid]['tasks'][$fid]))
    $taskTitle = $serversList->data[$sid]['tasks'][$fid]['title'];
  
  $header->data['title'] = "Store / Remote / $serverTitle / $taskTitle";
  
  $this->data['serverTitle'] = $serverTitle;
  $this->data['taskTitle'] = $taskTitle;
  $this->data['files'] = $this->getlFolderFiles($serversList, $sid, $fid);
  $this->data['taskId'] = $fid;
  $this->data['serverId'] = $sid;
  $this->data['header'] = $header->show();
  $this->data['footer'] = $footer->show();
  $this->data['topMenu'] = $topMenu->show();
  }

  public function show()
  {
  return $this->view(__corePath.'views/store/remote/folder.php', $this->data);
  }
}
?>