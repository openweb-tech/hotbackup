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
  
  $header->data['title'] = 'Edit MYSQL backup task';
  
  $this->data['widgets'] = new Widgets($this->db, __corePath.'widgets/', $this->config);
  
  $this->data['header'] = $header->show();
  $this->data['footer'] = $footer->show();
  $this->data['topMenu'] = $topMenu->show();
  
  $tasksList = new JsonDB(__taskdb);
  
  $id = (int)$_GET['id'];
  
  $formsent = $tasksList->data[$id];
  
  if( !empty($_SESSION['formSent']) )
    $formsent = $_SESSION['formSent'];
  
  $_SESSION['formSent'] = array();
  
  if(!isset($formsent['title'])) $formsent['title'] = '';
  if(!isset($formsent['type'])) $formsent['type'] = '';
  if(!isset($formsent['status'])) $formsent['status'] = '';
  if(!isset($formsent['deep'])) $formsent['deep'] = '';
  if(!isset($formsent['mysql-backup-filename'])) $formsent['mysql-backup-filename'] = '';
  if(!isset($formsent['mysql-backup-address'])) $formsent['mysql-backup-address'] = '';
  if(!isset($formsent['mysql-backup-name'])) $formsent['mysql-backup-name'] = '';
  if(!isset($formsent['mysql-backup-user'])) $formsent['mysql-backup-user'] = '';
  if(!isset($formsent['mysql-backup-password'])) $formsent['mysql-backup-password'] = '';
  
  $this->data['task'] = $formsent;
  
  $_SESSION['formSent'] = array();
  
  }


  public function show()
  {
  return $this->view(__corePath.'views/tasks/edit_mysql_backup.php', $this->data);
  }
}
?>