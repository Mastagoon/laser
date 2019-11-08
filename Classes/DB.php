<?php
/*
This is the database class, it is the biggest and most important class in this project.
The DB class will be used in every interaction with the database.
*/
class DB {
  private static $_instance = null;
  private $_pdo,	//the database connection will be using PDO objects(and not mysqli_connect)
  $_query,
  $_error = false,
  $results,
  $_count = 0;


  private function __construct() {	
    try {	//we connect to the database using pdo, we get the neccessery info from the Config class and values stored in Core/init
      $host = Config::get("mysql/host");
      $dbname = Config::get("mysql/dbname");
      $username = Config::get("mysql/username");
      $password = Config::get("mysql/password");
      $this->_pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);	//don't forget to set charset utf8 or arabic won't work
    } catch (PDOException $e) {
      die($e->getMessage());
    }

  }
  
  public static function getInstance() {	//this is a static function to get an instance of the database object, basically calling DB::getInstance() gives you a connection to the database
    if(!isset(self::$_instance)) {	//if there is no created DB object (no connection to the database) then make a new DB object and run the constructor to connect
      self::$_instance = new DB();
    } else {
      return self::$_instance;	//if there is an object simply return the lastest instance of it
    }
  }

//this query function is the lowest level of logic in this class, it takes an sql query and its params and executes them.
  public function query($sql, $params = array()) {	//example params $sql = "insert into .... VALUES ? ? ?" and $params = ['value1', 'value2' ,'value3']
    $this->_error = false;
    if($this->_query = $this->_pdo->prepare($sql)){
      $i = 1;
      if(count($params)) {
        foreach($params as $param) {
          $this->_query->bindValue($i, $param);	//bindValue function binds the values and replaces the "?" question marks with them to complete the sql, this is just for security.
          $i++;
        }
      }
      if($this->_query->execute()) {	//the execute function executes the query , the response is stored in the local result variable
        $this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);	//response is saved as an object (PDO::FECTH_OBJ)
        $this->_count = $this->_query->rowCount();	//the local count variable hold the number of rows(results) fetched from the database
      } else {
        $this->_error = true;
      }
    }
    return $this;
  }
//the action function is the 2nd lowest level of logic in this class, it invokes the query function
//action is used for all database operations(get, insert, delete, update)
  public function action($action, $table, $where = array()){	//example params $action = "SELECT *", $table = "users", $where = ["username", "=", "xxx"]
    if(count($where) === 3){
      $operators = array('=', '>', '<', '>=', '<=');	//we take the values from the $where array and store them in indivisual variables
      $field = $where[0];	//$field = "username"
      $operator = $where[1];	//$operator = "=" 
      $value = $where[2];	//"value = "xxx"

      if(in_array($operator, $operators)){
        $sql = "{$action} FROM {$table} WHERE {$field} {$operator} ?";	//$sql = SELECT * FROM users WHERE username = ?(note that we use ? and not the direct value for security.)
        if(!$this->query($sql, array($value))->error()){	//we forward the $sql and the value to the query function to bind and execute them
          return $this;
        }
      }
    }
    return false;
  }

//the get and delete functions are the highest level of logic in this class, they invoke the action function and are invoked by the developer directly
  public function get($table, $where) {	
    return $this->action("SELECT *", $table, $where);
  }

  public function delete($table, $where){
    return $this->action("DELETE", $table, $where);
  }

  public function insert($table, $data = array()) {
    if(count($data)){
      $keys = array_keys($data);
      $values = null;
      $i = 1;
      foreach($data as $bit) {
        $values .= '?';
        if($i < count($data)) {
          $values .= ', ';
        }
        $i++;
      }
	  $sql = "INSERT INTO $table (" . implode (',',$keys) . ") VALUES ({$values})";
      if(!$this->query($sql, $data)->error()){
        return true;
      }
    }
    return false;
  }

  public function update($table, $id, $data = array()) {
    $set = "";
    $i = 1;
    foreach($data as $name => $value) {
      $set .= "{$name} = ?";
      if($i < count($data)) {
        $set .= ',';
      }
      $i++;
    }
    $sql = "UPDATE {$table} SET $set WHERE id = {$id}";
    if(!$this->query($sql, $data)->error()) {
      return true;
    }
    return false;
  }

//functions below return the private variables in this class.
  public function error() {
    return $this->_error;
  }

  public function count() {
    return $this->_count;
  }

  public function results() {
    return $this->_results;
  }

  public function first() {
    return $this->results()[0];
  }

}
