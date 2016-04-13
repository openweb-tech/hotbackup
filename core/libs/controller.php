<?php

class Controller
{

  public $db;
  public $template;
  public $data;
  public $curpage;

  function __construct($curpage, $db, $appConfig) 
  {
  global $_LANG;
  
  $this->_LANG = $_LANG;
  $this->db = $db;
  $this->curpage = $curpage;
  $this->config = $appConfig;
  $this->data = array('_LANG' => $_LANG);
  $this->template = __corePath.'views/index.php';
  
  }

  function __destruct() 
  {
  
  }
  
  public function view($file, $data = array()) 
  {
  if (file_exists($file)) 
    {
    extract($data);
    ob_start();
    require($file);
    $output = ob_get_contents();
    ob_end_clean();
    return $output;
    }else
    {
    echo('Error: Could not load template ' . $file . '!');
    exit();
    }
  }
  
  public function prepare()
  {
  
  }
  
  public function render()
  {
  
  
  }
  
  public function redirect($path)
  {
  header('location: '.__spath.$path);
  die();
  }
  
  public function show()
  {
  $this->data['_LANG'] = $this->_LANG;
  return $this->view($this->template, $this->data);
  }
}

?>