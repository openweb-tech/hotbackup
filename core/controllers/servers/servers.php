<?php

include_once __corePath.'controllers/header.php';
include_once __corePath.'controllers/footer.php';
include_once __corePath.'controllers/topMenu.php';

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

  $header->data['title'] = $this->_LANG['servers']['Servers list'];
  
  $serversDB = new JsonDB(__serversdb);
  
  $this->data['servers'] = $serversDB->data;
  
  $this->data['header'] = $header->show();
  $this->data['footer'] = $footer->show();
  $this->data['topMenu'] = $topMenu->show();
  
  }


  public function show()
  {
  return $this->view(__corePath.'views/servers/servers.php', $this->data);
  }
}
?>