<?php

class DB
{

  function __construct($addr, $dbname, $user, $pass, $perm='write') 
  {
  $this->connection=mysqli_connect($addr,$user,$pass,$dbname);
  mysqli_set_charset($this->connection,"utf8");
  $this->permission=$perm;
  }

  function __destruct() 
  {
  mysqli_close($this->connection);
  }
  
  public function select($query)
  {
  //if(strripos(' '.$query,'insert ')>0)return 'error';
  //if(strripos(' '.$query,'update ')>0)return 'error';
  //if(strripos(' '.$query,'delete ')>0)return 'error';
  $res=mysqli_query($this->connection,$query);
  
  if(!$res) return 0;
  $ret=array();
  while($row=mysqli_fetch_assoc($res))$ret[]=$row;
  
  return $ret;
  }
  
  public function insert($query)
  {
  //if(strripos(' '.$query,'select ')>0)return 'error';
  //if(strripos(' '.$query,'update ')>0)return 'error';
  //if(strripos(' '.$query,'delete ')>0)return 'error';
  
  if($this->permission=='read')return 'error';
  return mysqli_query($this->connection,$query);
  }
  
  public function update($query)
  {
  //if(strripos(' '.$query,'select ')>0)return 'error';
  //if(strripos(' '.$query,'insert ')>0)return 'error';
  //if(strripos(' '.$query,'delete ')>0)return 'error';
  
  if($this->permission=='read')return 'error';
  return mysqli_query($this->connection,$query);
  }
  public function delete($query)
  {
  //if(strripos(' '.$query,'select ')>0)return 'error';
  //if(strripos(' '.$query,'insert ')>0)return 'error';
  //if(strripos(' '.$query,'update ')>0)return 'error';
  
  if($this->permission=='read')return 'error';
  return mysqli_query($this->connection,$query);
  }
}

?>