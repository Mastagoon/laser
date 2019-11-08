<?php
/*
The input class helps with getting the variables from POST and GET methods quickly
You can use $var = Input::get('x') instead of $var = $_POST['X']
You can use $var = Input::get('x') instead of $var = $_GET['X']
*/
Class Input {
  public static function exists($type = 'POST') {	//exists checks if the given variable name exists inside POST or GET globals
    switch ($type) {
      case 'POST':
        return (!empty($_POST)) ? true : false;
        break;

      case 'GET':
        return (!empty($_GET)) ? true : false;
        break;

      default:
        return false;
        break;
    }
  }

  public static function get($item) {	//simply returns the item from POST or GET
    if(isset($_POST[$item])) {
      return $_POST[$item];
    } else if(isset($_GET[$item])) {
      return $_GET[$item];
    } else {
      return "";
    }
  }
}
