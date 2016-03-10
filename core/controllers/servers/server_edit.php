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
  $header->data['title'] = 'Connect to the server';
  
  $this->data['header'] = $header->show();
  $this->data['footer'] = $footer->show();
  $this->data['topMenu'] = $topMenu->show();
  
  if( isset($_SESSION['formSent']) && !empty($_SESSION['formSent']))
    $formsent = $_SESSION['formSent'];
  else
    {
    $serversDB = new JsonDB(__serversdb);
    $id = (int)$_GET['id'];
    $formsent = $serversDB->data[$id];
    }
  
  if( !isset($formsent['address'] )) $formsent['address'] = '';
  if( !isset($formsent['apiKey'] )) $formsent['apiKey'] = '';
  if( !isset($formsent['archSync'] )) $formsent['archSync'] = '';
  if( !isset($formsent['archDepth'] )) $formsent['archDepth'] = '';
      
  $this->data['formSent'] = $formsent;
  
  $_SESSION['formSent'] = array();
  
  }

  public function show()
  {
  return $this->view(__corePath.'views/servers/server_edit.php', $this->data);
  }
}
?>