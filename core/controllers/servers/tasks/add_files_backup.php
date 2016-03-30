<?php

include_once __corePath.'controllers/header.php';
include_once __corePath.'controllers/footer.php';
include_once __corePath.'controllers/topMenu.php';
include_once __corePath.'libs/widget.php';

class Page extends Controller
{ 
  public function prepare()
  {
  
  $user = new User(1);
  if( !$user->isAuthorized() ) $this->redirect('?r=auth');
  
  $header = new PageHeader($this->curpage, $this->db, $this->config);
  $footer = new PageFooter($this->curpage, $this->db, $this->config);
  $topMenu = new TopMenu($this->curpage, $this->db, $this->config);
  $topMenu->prepare();
  
  $header->data['title'] = 'New Files backup';
  
  $this->data['widgets'] = new Widgets($this->db, __corePath.'widgets/', $this->config);
  
  $serversList = new JsonDB(__serversdb);
  $sid = (int)$_GET['sid'];
  
  $this->data['header'] = $header->show();
  $this->data['footer'] = $footer->show();
  $this->data['topMenu'] = $topMenu->show();
  $this->data['serverName'] = $serversList->data[$sid]['name'];
  $this->data['sid'] = $sid;
  
  }


  public function show()
  {
  return $this->view(__corePath.'views/servers/tasks/add_files_backup.php', $this->data);
  }
}
?>