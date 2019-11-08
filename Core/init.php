<?php
/*
The Init.php file holds all the global variables needed in this project(the database connection only so far)
It also gets an instance of the database which means you are always connected when you require Core/init.php
It also automatically loads the classes using spl_autoload function
*/
  $GLOBALS['config'] = array(	//global variable config equals this array
    'mysql' => array(
      'host' => '127.0.0.1',
      'username' => 'root',
      'password' => '',
      'dbname' =>   'laser'
	),
	'pricing' => array(
		'printout' => 2,
		'bulkprintout' => 1.8,
		'colored' => 8,
		'typing' => 25,
		'englishtyping' => 30,
		'translation' => 80,
		'coordinate' => 5,
		'other' => 0.5
	),
	'payment' => array(
		'printout' => 0.25,
		'bulkprintout' => 0.25,
		'colored' => 0.2,
		'typing' => 0.5,
		'englishtyping' => 0.5,
		'translation' => 0.75,
		'coordinate' => 0.5,
		'other' => 0.5
	)
  );

  spl_autoload_register(function($class){	//this function automatically loads the given class ONLY when it's called, when you use Input::get() this function requires it immediately.
    require_once "Classes/" . $class . ".php";
  });

  DB::getInstance();
  require_once "Functions/escape.php";	
  require_once "Functions/calculate.php";
  require_once "Functions/rate.php";