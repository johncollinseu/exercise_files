<?php 
require_once('../db_connection/MySQLConnection.php'); 

class User extends MySQLConnection{ 

  public $name = "";

  /*
  Return this class 
  */
  public static function who()
  {
    return __CLASS__;
  }

  /*
  Return this class table
  */
  public static function table()
  {
    return 'names';
  }

  /*
  Add a name to the names table
  */
  public function addName()
  {
    $nameValue = array(); 
    $nameValue['name'] = $this->name;

    $db = self::addOneRow($nameValue);
  }



}
