<?php
	require_once "Core/init.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="style/bootstrap.min.css">
	<link rel="stylesheet" href="style/main.css">
	<script src="javascript/jquery-3.2.1.min.js"></script>
	<script src ="javascript/bootstrap.min.js"></script>
	<title>مطبعة الليزر</title>
</head>
<body>
	<!-- navbar -->
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<a class="navbar-brand" href="#">مطبعة الليزر</a>
		<div class="collapse navbar-collapse text-center m-auto" id="navbarSupportedContent">
		  <ul class="navbar-nav ml-auto">
		  	<li class="nav-item">
			  <a class="nav-link" href="index.php">الرئيسية</a>
			</li>
			<li class="nav-item">
			  <a class="nav-link active" href="check.php">الحسابات</a>
			</li>
			<li class="nav-item">
			  <a class="nav-link" href="history.php">السجل</a>
			</li>
		</ul>
		</div>
	</nav>
	<!-- end of navbar -->

	<!-- payment table -->
	<table id="check-table" border="1px" width="100%">
		<th>حصتك</th>
		<th>حصة المحل</th>
		<th>النسبة</th>
		<th>المبلغ</th>
		<th>الكمية</th>
		<th>نوع الفاتورة</th>
	<?php
		$bill = new Bill();
		$unchecked_bills = $bill->getBills(1);
		$total = 0;
		foreach($unchecked_bills as $bill) {
			$yourShare = yourShare($bill->bill_type, $bill->cash);
			$shopShare = shopShare($bill->bill_type, $bill->cash);
			echo "
				<tr>
					<td class='p-3'>{$yourShare}</td>
					<td class='p-3'>{$shopShare}</td>
					<td class='p-3'>".rate($bill->bill_type)."</td>
					<td class='p-3'>{$bill->cash}</td>
					<td class='p-3'>{$bill->quantity}</td>
					<td class='p-3'>{$bill->bill_type}</td>
				</tr>
			";
			$total += $yourShare;
		}
		echo "
			</table>
			<h3>الإجمالي</h3>
			<h4 class = 'text-center'> فقط {$total} جنيه </h4>
		";
	?>
	</table>
	<!-- end of table -->
	<form action="setchecked.php" method="POST">
		<input class="btn btn-primary main-btn my-3" type="submit" name="check" value="محاسبة">
	</form>
</body>
</html>