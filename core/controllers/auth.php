<?php

include_once __corePath.'controllers/header.php';
include_once __corePath.'controllers/footer.php';

class Page extends Controller
{ 
  public function prepare()
  {
  $header = new PageHeader($this->curpage, $this->db, $this->config);
  $header->data['title'] = $this->_LANG['auth']['Authorize'];
  $this->data['header'] = $header->show();
  }


  public function show()
  {
  return $this->view(__corePath.'views/auth.php', $this->data);
  }
}
?>