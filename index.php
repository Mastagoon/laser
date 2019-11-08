<!DOCTYPE html>
<html lang="en">
	<?php
		include_once "Core/init.php";
	?>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="style/bootstrap.min.css">
	<link rel="stylesheet" href="style/main.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src ="javascript/bootstrap.min.js"></script>
	<title>مكتبة الليزر</title>
</head>
<body>
	<!-- navbar -->
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<a class="navbar-brand" href="#">مطبعة الليزر</a>
		<div class="collapse navbar-collapse text-center m-auto" id="navbarSupportedContent">
		  <ul class="navbar-nav ml-auto">
			<li class="nav-item active">
			  <a class="nav-link" href="#">الرئيسية</a>
			</li>
			<li class="nav-item">
			  <a class="nav-link" href="check.php">الحسابات</a>
			</li>
			<li class="nav-item">
			  <a class="nav-link" href="history.php">السجل</a>
			</li>
		</ul>
		</div>
	</nav>
	<!-- end of navbar -->
	<h1>مكتبة الليزر</h1>
	<button class = "btn btn-primary main-btn" data-toggle="modal" data-target="#billmodal" id="add">أضف فاتورة جديدة</button>
		<div class="modal fade" id="billmodal" tabindex="-1">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header text-center">
						<h2 class="w-100 modal-title">فاتورة جديدة</h2>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-d-none="true">&times;</span>
						</button>
					</div>
					<!-- new bill modal -->
					<div class="modal-body">
						<form action="addbill.php" method="POST">
							<div class="md-form">
								<label for="name">اسم العميل</label>
								<input type="text" name="name">	
							</div>
							<div class="md-form">
								<label for="type">نوع العمل</label>
								<select name="type" id="type">
									<option value="printout">اسود وابيض</option>
									<option value="colored">ملون</option>
									<option value="coordinate">تنسيق</option>
									<option value="typing">طباعة</option>
									<option value="translation">ترجمة</option>
									<option value="other">....أخرى</option>
								</select>
							</div>
							<div class="md-form">
								<label for="quantity">العدد</label>
								<input type="number" name="quantity">
							</div>
							<div class="md-form">
								<label for="desc">الوصف</label>
								<input type="text" name="desc">
							</div>
							<div class="md-form">
								<label for="fixed-price">سعر الوحدة</label>
								<input name="fixed-price" type="number">
							</div>								
							<div class="modal-footer d-flex justify-content-center">
								<input value="إضافة" type = "submit" name = "submit" class="btn btn-deep-orange">
							</div>				
						</form>		
					</div>
				</div>
			</div>
		</div>
		<!-- end of modal -->
		<!-- display recent bills -->
		<h3 class="text-center my-5">فواتير اليوم</h3>
		<table border="true" width="100%" id="recent-table">
		    <tr>
		      <th class="p-3">الوقت</th>
		      <th class="p-3">ملاحظات</th>
		      <th class="p-3">المبلغ</th>
		      <th class="p-3">الكمية</th>
		      <th class="p-3">نوع الفاتورة</th>
		      <th class="p-3">اسم العميل</th>
			</tr>
			<?php 
				$bill = new Bill();
				$bills = $bill->getBills(1);
				foreach($bills as $bill) {
					$phpdate = strtotime($bill->bill_date);
					$time = date("h:i A", $phpdate);
					echo "
						<tr>
							<td class='p-3'>".$time."</td>
							<td class='p-3'>{$bill->description}</td>
							<td class='p-3'>{$bill->cash}</td>
							<td class='p-3'>{$bill->quantity}</td>
							<td class='p-3'>{$bill->bill_type}</td>
							<td class='p-3'>{$bill->customer_name}</td>
						</tr>
					";
				}
			?>
		</table>
		
</body>

</html>
