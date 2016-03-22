<?php

include_once __corePath.'controllers/header.php';
include_once __corePath.'controllers/footer.php';
include_once __corePath.'controllers/topMenu.php';

class Page extends Controller
{ 
  private function getlFolderFiles()
  {
  $res = array();
  $id = (int)$_GET['id'];
  foreach(glob(__archiveDIR."local/$id/*") as $path)
    {
    $name = str_replace(__archiveDIR."local/$id/", '', $path);
    $res[] = array('id' => $id,
      'name' => $name,
      'size' => filesize($path),
      'time' => filemtime($path)
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
  
  $tasksList = new JsonDB(__taskdb);
  
  $id = (int)$_GET['id'];
  
  if(isset($tasksList->data[$id]))
    {
    $this->data['taskTitle'] = $tasksList->data[$id]['title'];
    $header->data['title'] = 'Store / local / '.$tasksList->data[$id]['title'];
    }
    else
    {
    $this->data['taskTitle'] = 'undefined';
    $header->data['title'] = 'Store / local / undefined';
    }
  
  $this->data['files'] = $this->getlFolderFiles();
  $this->data['taskId'] = $id;
  $this->data['header'] = $header->show();
  $this->data['footer'] = $footer->show();
  $this->data['topMenu'] = $topMenu->show();
  }

  public function show()
  {
  return $this->view(__corePath.'views/store/local/folder.php', $this->data);
  }
}
?>