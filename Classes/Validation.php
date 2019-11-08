<?php

Class Validation {
  private $_passed = false,
  $errors = array(),
  $_db = null;

  public function __construct() {
    $this->_db = DB::getInstance();
  }

  public function check($source, $items = array()) {
    foreach ($items as $item => $rules) {
      foreach($rules as $rule => $rule_value) {
        if($rule === 'name') {
          $name = $rule_value;
        }
        $value = $source[$item];
        if($rule === 'required' && empty($value)) {
          $this->addError("{$name} is required");
        } else {
          switch ($rule) {
            case 'min':
              if(strlen($value) < $rule_value) {
                $this->addError("{$name} must be a minimum of {$rule_value} characters !");
              }
              break;
            case 'max':
              if(strlen($value) > $rule_value) {
                $this->addError("{$name} must be a maximum of {$rule_value} characters !");
              }
              break;
            case 'matches':
              if($value != $source[$rule_value]) {
                $this->addError("{$name} does not match {$rule_value}");
              }
              break;
            case 'unique':
              $check = $this->_db->get($rule_value, array($item, '=', $value));
              if($check->count()) {
                $this->addError("this {$name} already exists !");
              }
              break;
            case 'validemail':
              if(!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                $this->addError("invalid {$name}");
              }
              break;
          }
        }
      }
    }
    if(empty($this->_errors)) {
      $this->_passed = true;
    }
    return $this;
  }

  private function addError($error) {
    $this->_errors[] = $error;
  }

  public function errors() {
    return $this->_errors;
  }

  public function passed() {
    return $this->_passed;
  }

/*  public function displayErrors() {
    if(!empty($_errors)) {
      foreach($_errors as $error) {
        switch ($error) {
          case 'value':
            // code...
            break;

          default:
            // code...
            break;
        }
      }
    }
  }*/


}
