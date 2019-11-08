<?php
	require_once "Core/init.php";

Class Bill {
	private $_db,
			$_bills;
	public function __construct() {
		$this->_db = DB::getInstance();
	}

	public function addBill($data) {
		if(!$this->_db->insert('bills', $data)) {
			throw new exception('There was a problem adding this bill.');
		}
	}

	public function getBills($check = false) {
		//TODO get a certin bill
		$this->_bills = $check ?	$this->_db->get("bills", array("checked", "=", 0))->results() :
									$this->_db->get("bills", array("id", ">", 0))->results();
		if(!$this->_bills) {
			echo "there are no bills.";
		}
		return $this->_bills;
	}

	public function setChecked() {
		$this->getBills();
		foreach($this->_bills as $bill) {
			$this->_db->update("bills", $bill->id, array(
				"checked" => 1
			));
		}
	}
}