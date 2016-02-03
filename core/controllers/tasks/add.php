<?php

include_once __controllers.'header.php';
include_once __controllers.'footer.php';
include_once __controllers.'topMenu.php';

class Page extends Controller
{ 
  public function prepare()
  {
  
  $user = new User(1);
  if( !$user->isAuthorized() ) $this->redirect('?r=auth');
  
  $header = new PageHeader($this->curpage, $this->db, $this->config);
  $footer = new PageFooter($this->curpage, $this->db, $this->config);
  $topMenu = new TopMenu($this->curpage, $this->db, $this->config);
  
  $header->data['title'] = 'New task';
  
  $this->data['header'] = $header->show();
  $this->data['footer'] = $footer->show();
  $this->data['topMenu'] = $topMenu->show();
  
  if( isset($_SESSION['formSent']) )
    $formsent = $_SESSION['formSent'];
  
  #if( !isset($formsent['login'] )) $formsent['login'] = '';
      
  $this->data['formSent'] = $formsent;
  
  $_SESSION['formSent'] = array();
  
  }


  public function show()
  {
  return $this->view(__templates.'tasks/add.php', $this->data);
  }
}
?>