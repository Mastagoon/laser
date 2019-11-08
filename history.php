<!DOCTYPE html>
<html lang="en">
<?php
	require_once "Core/init.php";
?>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="style/bootstrap.min.css">
	<link rel="stylesheet" href="style/main.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src ="javascript/bootstrap.min.js"></script>
	<title>مطبعة الليزر</title>
</head>
<body>
	<!-- navbar -->
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<a class="navbar-brand" href="#">مطبعة الليزر</a>
		<div class="collapse navbar-collapse text-center m-auto" id="navbarSupportedContent">
		  <ul class="navbar-nav ml-auto">
		    <li class="nav-item ">
			  <a class="nav-link" href="index.php">الرئيسية</a>
			</li>
			<li class="nav-item">
			  <a class="nav-link" href="check.php">الحسابات</a>
			</li>
			<li class="nav-item active">
			  <a class="nav-link" href="history.php">السجل</a>
			</li>
		</ul>
		</div>
	</nav>
	<!-- end of navbar -->
	<!-- history table -->
	<h3 class="my-2">اختر تاريخاً للبحث</h3>
	<form method="POST" action="history.php" class="mb-3">
		<input name="date" type="date" class="w-100 text-center p-3">
		<input type="submit" class="my-2 btn btn-primary main-btn" name="submit" value="البحث">
	</form>
	<?php
		if(Input::get("date")) {
			echo "<h3>".Input::get("date")." جميع الفواتير بتاريخ</h3><br>";
		}
	?>

	
	<table border="1px" style="width:100%">
		<tr>
			<th class="p-2">الوقت</th>
		    <th class="p-2">ملاحظات</th>
		    <th class="p-2">المبلغ</th>
		    <th class="p-2">الكمية</th>
		    <th class="p-2">نوع الفاتورة</th>
		    <th class="p-2">اسم العميل</th>
		</tr>
	<?php
		$bill = new Bill();
		$bills = $bill->getBills();
		foreach($bills as $bill) {
			//converting mysql date format to php date format
			$phpdate = strtotime($bill->bill_date);
			$date = date("Y-m-d", $phpdate);
			if($date == Input::get("date")) {
				echo "
				<tr>
					<td class='p-3'>".date("h:i A", $phpdate)."</td>
					<td class='p-3'>{$bill->description}</td>
					<td class='p-3'>{$bill->cash}</td>
					<td class='p-3'>{$bill->quantity}</td>
					<td class='p-3'>{$bill->bill_type}</td>
					<td class='p-3'>{$bill->customer_name}</td>
				</tr>
			";
			}
			
		}
	?>
	</table>
</body>
</html>