<?php

class PageHeader extends Controller
{ 

  public function show()
  {
  return $this->view(__corePath.'views/header.php', $this->data);
  }
}
?>