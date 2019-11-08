<?php
/*
This is the configuration class, it allows you to get data from the global variable $GLOBALS['config'] alot easier.
The config global variable can be found in Core/init.php and it holds an array that contains the host and database information.
There is only one function in this class, the get() function returns the specific data stored in the config variable.
*/
Class Config {
  public static function get($path = null){
    if($path){	// example for path : mysql/host (you want to get the mysql array inside the config variable, and then host value inside that array)
      $config = $GLOBALS['config'];	//get the config variable
      $path = explode('/',$path);	//seperating the path by / (now you have $path = ['mysql', 'host'])
      foreach($path as $bit){	//loop through the $path array to get the needed information
        if(isset($config[$bit])){
          $config = $config[$bit];
        }
      }
      return $config;
    }
    return false;
  }
}
