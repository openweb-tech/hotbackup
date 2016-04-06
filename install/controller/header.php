<?php

class PageHeader extends Controller
{ 

  public function show()
  {
  return $this->view('views/header.php', $this->data);
  }
}
?>