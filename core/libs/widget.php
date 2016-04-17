<?php

class Widgets
{

public $widgets;

  function __construct($db, $widgetFolder, $config) 
  {
  global $_LANG;
  $this->_LANG = $_LANG;
  $this->db = $db;
  
  foreach (glob("$widgetFolder*.php") as $filename)
    {
    $fName = str_replace($widgetFolder, '', str_replace('.php', '', $filename));
    $this->widgets[$fName] = file_get_contents($filename);
    }
  
  }

  public function show($widget, $params = array())
  {
  $html = '';
  $params['_LANG'] = $this->_LANG;
  extract($params);
  ob_start();
  eval('?>'.$this->widgets[$widget]);
  $html = ob_get_contents();
  ob_end_clean();
  return $html;
  }
  
  function __destruct() 
  {
  
  }

}

?>