<?php

include_once 'header.php';
include_once 'footer.php';

class Page extends Controller
{ 

  public function prepare()
  {
  $header = new PageHeader($this->curpage, $this->db, $this->config);
  $footer = new PageFooter($this->curpage, $this->db, $this->config);
  $header->data['title'] = 'Successful installation';
  
  $basePath = str_replace('install/index.php', '', $_SERVER['SCRIPT_FILENAME']);
  
  $dashboardUrdl = 'http://' . $_SERVER['HTTP_HOST'] . str_replace('install/?r=success', '', $_SERVER['REQUEST_URI']);

  $this->data['title'] = 'Successful installation';
  $this->data['serversServiceCron'] = $basePath . 'serversService.php';
  $this->data['tasksServiceCron'] = $basePath . 'tasksService.php';
  $this->data['dashboardUrdl'] = $dashboardUrdl;
  $this->data['header'] = $header->show();
  $this->data['footer'] = $footer->show();
  }


  public function show()
  {
  return $this->view('views/success.php', $this->data);
  }
}
?>