<?php

include_once 'header.php';
include_once 'footer.php';

class Page extends Controller
{ 

  public function prepare()
  {
  $header = new PageHeader($this->curpage, $this->db, $this->config);
  $footer = new PageFooter($this->curpage, $this->db, $this->config);
  $header->data['title'] = 'HotBackup installation';

  $this->data['title'] = 'HotBackup installation';
  $this->data['header'] = $header->show();
  $this->data['footer'] = $footer->show();
  
  $workUrl = 'http://' . $_SERVER['SERVER_NAME'] . str_replace('install/index.php', '', $_SERVER['SCRIPT_NAME']);
  $workFolder = str_replace('install/index.php', '', $_SERVER['SCRIPT_FILENAME']);
  
  $error = '';
  if( isset($_SESSION['error']) )
    $error = $_SESSION['error'];

  $formSent = array();
  
  if(isset($_SESSION['formSent']))
    $formSent = $_SESSION['formSent'];
  else
    {
    $formSent['login'] = 'hAdmin';
    $formSent['password'] = '';
    $formSent['confirmation'] = '';
    $formSent['email'] = '';
    $formSent['folder'] = $workFolder;
    $formSent['workUrl'] = $workUrl;
    }
  unset($_SESSION['error']);
  $this->data['formSent'] = $formSent;
  $this->data['error'] = $error;
  }


  public function show()
  {
  return $this->view('views/index.php', $this->data);
  }
}
?>