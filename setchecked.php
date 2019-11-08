<?php 
	require_once "Core/init.php";
	if(!Input::get("check")) {
		exit("Unauthorized Access.");
	}
	$bill = new Bill();
	$bill->setChecked();