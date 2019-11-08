<?php
/*
The user class handles all interaction with the users in this project
*/
Class user {
  private $_db,
          $_data;

  public function __construct($user = null) {
	$this->_db = DB::getInstance();
	if($user) {
		$this->find($user);
	}
  }

  public function create($data) {
    if(!$this->_db->insert('users', $data)) {
      throw new exception('There was a problem registering this account.');
    }
  }

  public function find($user = null) {
    if($user) {
       $field = is_int($user) ? 'id' : 'phone_number';
       $result = $this->_db->get('users',array($field ,'=', $user));
       if($result->count()) {
         $this->_data = $result->first();
         return true;
       } else {
		   echo "this user does not exist.";
		   return false;
	   }
    }
    return false;
  }

  public function data() {
    return $this->_data;
  }
}
