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
  
  $header->data['title'] = $this->_LANG['tasks']['Edit files backup task'];
  
  $this->data['widgets'] = new Widgets($this->db, __corePath.'widgets/', $this->config);
  
  $this->data['header'] = $header->show();
  $this->data['footer'] = $footer->show();
  $this->data['topMenu'] = $topMenu->show();
  
  $serversList = new JsonDB(__serversdb);
  
  $id = (int)$_GET['id'];
  $sid = (int)$_GET['sid'];
  
  $formsent = $serversList->data[$sid]['tasks'][$id];
  
  if( isset($_SESSION['formSent']) && !empty($_SESSION['formSent']))
    $formsent = $_SESSION['formSent'];
  
  $_SESSION['formSent'] = array();
  
  if(!isset($formsent['title'])) $formsent['title'] = '';
  if(!isset($formsent['type'])) $formsent['type'] = '';
  if(!isset($formsent['status'])) $formsent['status'] = '';
  if(!isset($formsent['deep'])) $formsent['deep'] = '';
  if(!isset($formsent['file-filename'])) $formsent['file-filename'] = '';
  if(!isset($formsent['file-exclude'])) $formsent['file-exclude'] = '';
 
  $this->data['task'] = $formsent;
  $this->data['serverName'] = $serversList->data[$sid]['name'];
  $this->data['id'] = $id;
  $this->data['sid'] = $sid;
  
  $_SESSION['formSent'] = array();
  
  }


  public function show()
  {
  return $this->view(__corePath.'views/servers/tasks/edit_files_backup.php', $this->data);
  }
}
?>