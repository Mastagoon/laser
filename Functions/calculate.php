<?php
	require_once "Core/init.php";
	function calculate($type, $quantity, $setprice = null) {
		switch($type) {	
			case "typing":
				$pricing = Config::get("pricing/typing");
				return !Empty($setprice) ? $quantity*$setprice : $quantity*$pricing;
			case "printout":
				$pricing = Config::get("pricing/printout");
				return !Empty($setprice) ? $quantity*$setprice : $quantity*$pricing;
			case "bulkprintout":
				$pricing = Config::get("pricing/bulkprintout");
				return !Empty($setprice) ? $quantity*$setprice : $quantity*$pricing;
			case "colored":
				$pricing = Config::get("pricing/colored");
				return !Empty($setprice) ? $quantity*$setprice : $quantity*$pricing;
			case "englishtyping":
				$pricing = Config::get("pricing/englishtyping");
				return !Empty($setprice) ? $quantity*$setprice : $quantity*$pricing;
			case "translation":
				$pricing = Config::get("pricing/translation");
				return !Empty($setprice) ? $quantity*$setprice : $quantity*$pricing;
			case "coordinate":
				$pricing = Config::get("pricing/coordinate");
				return !Empty($setprice) ? $quantity*$setprice : $quantity*$pricing;
			case "other":
				$pricing = Config::get("pricing/other");
				return !Empty($setprice) ? $quantity*$setprice : $quantity*$pricing;
			default:
				return 0;
		}
	}