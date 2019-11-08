<?php
	require_once "Core/init.php";
	function rate($type) {
		return Config::get("payment/{$type}")*100 . "%";
	}

	function shopShare($type, $cash) {
		return (1 - Config::get("payment/{$type}"))*$cash;
	}

	function yourShare($type, $cash) {
		return Config::get("payment/{$type}")*$cash;
	}