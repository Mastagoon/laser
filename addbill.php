<?php
	require_once "Core/init.php";
	$db = DB::getInstance();
	if(!Input::get("submit")) {
		exit("Unauthorized access.");
	}
	if(Empty(Input::get("type"))) {
		exit("please fill all the fields.");
	}
	$customer_name = Input::get("name");
	$type = Input::get("type");
	$quantity = Input::get("quantity");
	$desc = Input::get("desc");
	$fixed_price = Input::get("fixed-price");
	$cash = calculate($type, $quantity, $fixed_price);
	echo $type ."<br>";
	echo $quantity."<br>";
	echo $fixed_price."<br>";
	echo $cash;	
	$bill = new Bill();
	$bill->addBill(array(
		"customer_name" => $customer_name,
		"bill_type" => $type,
		"worker" => "سهل",
		"quantity" => $quantity,
		"description" => $desc,
		"cash" => $cash
	));
	echo "Bill added successfully.";
	Redirect::to("index.php");