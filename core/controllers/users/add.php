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
  
  $this->data['header'] = $header->show();
  $this->data['footer'] = $footer->show();
  $this->data['topMenu'] = $topMenu->show();
  
  
  if( isset($_SESSION['formSent']) && !empty($_SESSION['formSent']))
    $formsent = $_SESSION['formSent'];
  
  if( !isset($formsent['login'] )) $formsent['login'] = '';
  if( !isset($formsent['email'] )) $formsent['email'] = '';
  if( !isset($formsent['password1'] )) $formsent['password1'] = '';
  if( !isset($formsent['password2'] )) $formsent['password2'] = '';
  if( !isset($formsent['accessGroup'] )) $formsent['accessGroup'] = '';
  if( !isset($formsent['alerts'] )) $formsent['alerts'] = '';
      
  $this->data['formSent'] = $formsent;
  
  $_SESSION['formSent'] = array();
  
  }


  public function show()
  {
  return $this->view(__corePath.'views/users/add.php', $this->data);
  }
}
?>