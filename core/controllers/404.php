<?php

include_once __corePath.'controllers/header.php';
include_once __corePath.'controllers/footer.php';

class Page extends Controller
{ 
  public function prepare()
  {
  header('HTTP/1.0 404 Not Found');
  
  $header = new PageHeader($this->curpage, $this->db, $this->config);
  $footer = new PageFooter($this->curpage, $this->db, $this->config);
  
  $header->data['title'] = 'Page not found';
  
  $this->data['header'] = $header->show();
  $this->data['footer'] = $footer->show();
  
  }


  public function show()
  {
  return $this->view(__corePath.'views/404.php', $this->data);
  }
}
?>