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
  
  $usersList = new JsonDB(__userdb);
  
  $id = (int)$_GET['id'];
  
  $header->data['title'] = 'Edir user id: '.$id;
  
  $this->data['header'] = $header->show();
  $this->data['footer'] = $footer->show();
  $this->data['topMenu'] = $topMenu->show();
  
  $user = $usersList->data[$id];
  
  $user['password1'] = '';
  $user['password2'] = '';
  
  $this->data['id'] = $id;
  
  if( !empty($_SESSION['formSent']) )
    {
    $formsent = $_SESSION['formSent'];
    if( isset($formsent['login']) ) $user['login'] = $formsent['login'];
    if( isset($formsent['email']) ) $user['email'] = $formsent['email'];
    if( isset($formsent['accessGroup']) ) $user['accessGroup'] = $formsent['accessGroup'];
    if( isset($formsent['alerts']) ) $user['alerts'] = $formsent['alerts'];
    if( isset($formsent['login']) ) $user['login'] = $formsent['login'];
    $_SESSION['formSent'] = array();
    }
    
  $this->data['user'] = $user;
  }


  public function show()
  {
  return $this->view(__templates.'users/edit.php', $this->data);
  }
}
?>