<?php

class PageFooter extends Controller
{ 

  public function show()
  {
  return $this->view('views/footer.php', $this->data);
  }
}
?>