<?php

class PageFooter extends Controller
{ 

  public function show()
  {
  return $this->view(__templates.'footer.php', $this->data);
  }
}
?>