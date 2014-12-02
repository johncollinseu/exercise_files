<?php 

require_once('config.php');

Class MySQLConnection {

  protected static $connection;

  function __construct() 
  {
    $this->openConnection();
  }

  /*
  Return table 
  */
  public static function table() 
  {
    return __CLASS__;
  }

  /*
  Use mysqli to connect to the database 
  */
  public static function openConnection() 
  {
    self::$connection = mysqli_connect(DB_HOST,DB_USER, DB_PASSWORD, DB_NAME); 
    if (self::$connection->connect_error){
      echo "Problem with connection >>" .  self::$connection->connect_error; die(); 
    }
    return self::$connection;
  }

  /*
  Close the database connection
  */
  public static function closeConnection() 
  {
    self::$connection->close();
  } 

  /*
  Add data into the database one row at a time. 
  */
  public static function addOneRow($val_array) 
  { 
    // Prepare array
    $prepared_array = self::formatBind($val_array);

    $db = self::openConnection();
    // build query 
    $sql = 'INSERT INTO ' . static::table() . 
          ' ( ' . self::colNames($val_array) . ' ) ' . 
            'VALUES ( '. self::queryValue($val_array) . ' );';

    $stmt = $db->prepare($sql);
    call_user_func_array(array($stmt, 'bind_param'), 
                          self::makeValuesReferenced($prepared_array));

    $stmt->execute();
  }

  /*
  -----------------
  Helper functions 
  -----------------
  */
  
  /*
  Return an array formatted to be used in a bind 
  */
  public static function formatBind($values) 
  {
    $prepared_array = array();
    $prepared_array[0] = '';  
    $i = 1;
    // loop through array and create new array. 
      foreach ($values as $val) {
        $prepared_array[0] .= gettype($val)[0];
        $prepared_array[$i] = $val;
        $i++;
      } 

    return $prepared_array;
  }

  /*
  Simply makes all the values referenced for bind_param
  */
  public static function makeValuesReferenced($array)
  {
    $refs = array();
      foreach($array as $key => $value){
          $refs[$key] = &$array[$key];
      }
    return $refs;
  }

  /*
  Return the col names by extracting from the array keys
  */ 
  public static function colNames($array)
  {
    return implode(", ",array_flip($array));
  }

  /*
  Using the number of values in the array, create string with number
  of bindings required
  */  
  public static function queryValue($array)
  {
    $query_values = ''; 
    $count = count($array);    
    for($i = 1; $i <= $count; $i++) {
      if ($i == $count){
        $query_values .= '?';
      }else{
        $query_values .= '?, ';
      }
    }
    return $query_values;
  } 


}