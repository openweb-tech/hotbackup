<?php

class TopMenu extends Controller
{ 

  public function show()
  {
  return $this->view(__templates.'topMenu.php', $this->data);
  }
}
?>