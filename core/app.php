<?php 

class App
{
  function __construct($dbconf) 
  {
  $this->config['db'] = $dbconf;
  
  if($this->config['db']['usedb'])
    $this->db = new DB($dbconf['dbaddr'], $dbconf['dbname'], $dbconf['dbuser'], $dbconf['dbpass'], $perm='write');
      else
        $this->db = 0;
  }

  function doAction()
  {
  $action = getaction();
  //если есть экшин- выполняем
  if(file_exists(__corePath."actions/$action.php"))
    {
    include __corePath."actions/$action.php";
    $action = new action($this->db);
    $action->execute();
    }
  }
  
  function showPage()
  {
  $curpage = getcurpage();
  // берём контроллер для текущей страницы
  include __corePath."controllers/$curpage.php";
  $page = new page($curpage, $this->db, $this->config);
  $page->prepare();
  $page->render();
  echo $page->show();//показываем страницу
  }
  
  function __destruct() 
  {
  
  }
  
}

?>