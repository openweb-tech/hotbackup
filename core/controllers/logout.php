<?php

class Page extends Controller
{ 

  public function prepare()
  {
  session_destroy();
  $this->redirect("");
  }
}
?>