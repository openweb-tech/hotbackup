<?php

class Notification extends Controller
{ 
  public function prepare()
  {
  if(isset($_SESSION['notifications']))
    {
    $this->data['visible'] = true;
    $this->data['notifications'] = $_SESSION['notifications'];
    } else {
    $this->data['visible'] = false;
    }
    
  unset($_SESSION['notifications']);
  }
  
  public function show()
  {
  return $this->view(__corePath.'views/notification.php', $this->data);
  }
}
?>