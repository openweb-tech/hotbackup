<?php

include_once 'header.php';
include_once 'footer.php';

class Page extends Controller
{ 

  public function prepare()
  {
  $header = new PageHeader($this->curpage, $this->db, $this->config);
  $footer = new PageFooter($this->curpage, $this->db, $this->config);
  $header->data['title'] = 'OpenBackup installation';

  $this->data['title'] = 'OpenBackup installation';
  $this->data['header'] = $header->show();
  $this->data['footer'] = $footer->show();
  
  $workUrl = 'http://' . $_SERVER['SERVER_NAME'] . str_replace('install/index.php', '', $_SERVER['SCRIPT_NAME']);
  $workFolder = str_replace('install/index.php', '', $_SERVER['SCRIPT_FILENAME']);
  
  $error = '';
  if( isset($_SESSION['error']) )
    $error = $_SESSION['error'];
  unset($_SESSION['error']);
  $formSent = [];
  if(isset($_SESSION['formSent']))
    $formSent = $_SESSION['formSent'];
  else
    {
    $formSent['login'] = 'OpenAdmin';
    $formSent['password'] = '';
    $formSent['confirmation'] = '';
    $formSent['email'] = '';
    $formSent['folder'] = $workFolder;
    $formSent['workUrl'] = $workUrl;
    }
  
  $this->data['formSent'] = $formSent;
  $this->data['error'] = $error;
  }


  public function show()
  {
  return $this->view('views/index.php', $this->data);
  }
}
?>