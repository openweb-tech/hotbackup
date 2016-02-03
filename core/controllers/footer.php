<?php

class PageFooter extends Controller
{ 

  public function show()
  {
  return $this->view(__corePath.'views/footer.php', $this->data);
  }
}
?>