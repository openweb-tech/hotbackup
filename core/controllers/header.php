<?php

class PageHeader extends Controller
{ 

  public function show()
  {
  return $this->view(__templates.'header.php', $this->data);
  }
}
?>