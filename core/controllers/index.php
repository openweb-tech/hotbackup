<?php

include_once __controllers.'header.php';
include_once __controllers.'footer.php';
include_once __controllers.'topMenu.php';

class Page extends Controller
{ 
  public function prepare()
  {
  
  $user = new User(1, __userdb);
  if( !$user->isAuthorized() ) $this->redirect('?r=auth');
  
  $header = new PageHeader($this->curpage, $this->db, $this->config);
  $footer = new PageFooter($this->curpage, $this->db, $this->config);
  $topMenu = new TopMenu($this->curpage, $this->db, $this->config);
  
  $header->data['title'] = 'Simple web page';
  
  $this->data['header'] = $header->show();
  $this->data['footer'] = $footer->show();
  $this->data['topMenu'] = $topMenu->show();
  
  }


  public function show()
  {
  return $this->view(__templates.'index.php', $this->data);
  }
}
?>