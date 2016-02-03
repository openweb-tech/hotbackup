<?php

class TopMenu extends Controller
{ 

  public function show()
  {
  return $this->view(__corePath.'views/topMenu.php', $this->data);
  }
}
?>