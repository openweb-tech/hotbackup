<?php

include_once 'header.php';
include_once 'footer.php';

class Page extends Controller
{ 

  public function prepare()
  {
  $header = new PageHeader($this->curpage, $this->db, $this->config);
  $footer = new PageFooter($this->curpage, $this->db, $this->config);
  $header->data['title'] = 'Error';
  
  $error = 'Uknown error';
  
  if( isset($_SESSION['error']) )
    $error = $_SESSION['error'];

  $this->data['title'] = 'Error';
  $this->data['error'] = $error;
  $this->data['installPath'] = str_replace('index.php', '', $_SERVER['PHP_SELF']);
  $this->data['header'] = $header->show();
  $this->data['footer'] = $footer->show();
  }


  public function show()
  {
  return $this->view('views/error.php', $this->data);
  }
}
?>