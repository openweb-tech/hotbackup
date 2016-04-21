<?php

class action extends actions
{
  public function execute()
  {
  $login = $_POST['login'];
  $pass1 = $_POST['password'];
  $pass2 = $_POST['confirmation'];
  $email = $_POST['email'];
  $folder = $_POST['folder'];
  $workUrl = $_POST['workUrl'];
  
  $beforeInstallError = 0;
  
  if( !is_writable('../archive/'))
    $beforeInstallError = 1;
  if( !is_writable('../core/data'))
    $beforeInstallError = 1;
  if( !is_writable('../conf.php'))
    $beforeInstallError = 1;
  
  if( ( $beforeInstallError == 0 ) && ( $pass2 == $pass1 )&& ( $login != '' ) && ( $email != '' ) && is_dir($folder) && ( $workUrl != '' ) )
    {
    $id = time();
    $newUser = array(
      'id' => $id,
      'login' => $login,
      'email' => $email,
      'password' => md5($pass1), 
      'accessGroup' => 'administrator',
      'alerts' => 'all'  
    );
    $usersDB = new JsonDB('../core/data/users.json');
    $usersDB->data = array();
    $usersDB->data[$id] = $newUser;
    $usersDB->saveToFile('../core/data/users.json');
    
    $basePath = str_replace('install/index.php', '', $_SERVER['SCRIPT_FILENAME']);
    $httpPath = 'http://' . $_SERVER['HTTP_HOST'] . str_replace('/install/', '', $_SERVER['REQUEST_URI']);
    $urlPath = str_replace('/install/', '', $_SERVER['REQUEST_URI']);
    $salt = md5(rand());

    $config = file_get_contents($basePath.'conf.php');
    
    $config = str_replace('{basePath}', $basePath, $config);
    $config = str_replace('{httpPath}', $httpPath, $config);
    $config = str_replace('{urlPath}', $urlPath, $config);
    $config = str_replace('{salt}', $salt, $config);
    
    file_put_contents($basePath.'conf.php', $config);
    
    unset($_SESSION['formSent']);
    
    // check settings db
    $settingsDB = new JsonDB('../core/data/settings.json');
    if(!isset($settingsDB->data['shortName']))
      { // db have not created, have to create clean
      $settingsDB->data['serverName'] = 'My new Backup server';
      $settingsDB->data['shortName'] = 'BCKP';
      $settingsDB->data['apiKey'] = md5(rand());
      $settingsDB->data['lang'] = 'en';
      $settingsDB->saveToFile('../core/data/settings.json');
      }
    
    //-- check installation
    
    // check usersDB
    
    $usersDB = new JsonDB('../core/data/users.json');
    if( count($usersDB->data) == 0 )
      {
      $this->redirect('?r=error');
      $_SESSION['error'] = 'Unable to access to users db, please check permissions to the /core/data folder.';
      }
    //--
    $this->redirect('?r=success');
    } else {
    
    $_SESSION['formSent'] = $_POST;
    
    if( $beforeInstallError )
      $_SESSION['error'] = 'Please check write permissions for work folder.';
    else
      $_SESSION['error'] = 'Please check the installation form!';
    
    $this->redirect('');
    
    }
  }
}

?>