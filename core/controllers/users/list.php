<?php

include_once __corePath.'controllers/header.php';
include_once __corePath.'controllers/footer.php';
include_once __corePath.'controllers/topMenu.php';

class Page extends Controller
{ 
  public function prepare()
  {
  
  $user = new User(1, __userdb);
  if( !$user->isAuthorized() ) $this->redirect('?r=auth');
  
  $header = new PageHeader($this->curpage, $this->db, $this->config);
  $footer = new PageFooter($this->curpage, $this->db, $this->config);
  $topMenu = new TopMenu($this->curpage, $this->db, $this->config);
  $topMenu->prepare();
  
  $usersList = new JsonDB(__userdb);
  
  $header->data['title'] = 'Users list';
  
  $this->data['usersList'] = $usersList->data;
  $this->data['header'] = $header->show();
  $this->data['footer'] = $footer->show();
  $this->data['topMenu'] = $topMenu->show();
  
  }


  public function show()
  {
  return $this->view(__corePath.'views/users/list.php', $this->data);
  }
}
?>