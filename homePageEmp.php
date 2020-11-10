<?php
	session_start();
	if (!isset($_SESSION['empLogin'])) {
		header('location:empLogin.php');
	}
?>
<!--#####-->
<?php
	$empID = $_SESSION['empID'];
	include 'connection.php';
	$query = "SELECT * FROM PERSONNEL
			  WHERE EMAIL = '$empID'";
	$result = mysqli_query($link, $query) or die(mysqli_error($link));
	$rows = mysqli_fetch_array($result);
	#####
	$id = $rows[0];
	$name = $rows[1].' '.$rows[2].' '.$rows[3];
	$dob = $rows[5];
	$branch = $rows[7];
	$hireDate = $rows[8];
	$mobile = $rows[10];
	$email = $rows[11];
	$lastAccess = $rows[13];
	#####
	$_SESSION['login_id'] = $email;
	$_SESSION['name'] = $name;
	$_SESSION['id'] = $id;
?>
<!--#####-->
<!DOCTYPE html>
<html>
<head>
	<title>HOME | PERSONNEL</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="design.css">
	<style type="text/css">
		.data_newEmp .content1 p{
			margin-left: 10px;
			margin-right: 10px;
		}
		.data_newEmp .content2 p{
			margin-left: 10px;
			margin-right: 10px;
		}
	</style>
</head>
<?php include 'topBar.php' ?>
<div class="data_newAcc">
	<?php include 'emp_nav.php' ?>
	<div class="account_top_nav" style="margin-left: 4px; margin-right: 4px;">
		<div class="text">
			Welcome, <span style="font-weight: normal;"><?php echo "$name"; ?>!</span>
		</div>
	</div>
	<!-- <div class="account_body"> -->
		<div class="content1">
			<p><span class="heading">Name: </span><?php echo "$name";?></p>
			<p><span class="heading">DOB: </span><?php echo "$dob";?></p>
			<p><span class="heading">Email: </span><?php echo "$email";?></p>
			<p><span class="heading">Mobile: </span><?php echo "$mobile";?></p>
		</div>
		<div class="content2" style="width: 250px;">
			<p><span class="heading">Branch: </span><?php echo "$branch";?></p>
			<p><span class="heading">Date Hired: </span><?php echo "$hireDate";?></p>
			<p><span class="heading">Last Access: </span><?php echo "$lastAccess";?></p>
		</div>
	<!-- </div> -->
</div>
<?php include 'bot.php' ;?>
<?php
	$date = date('Y-m-d H:i:s');
	$_SESSION['empDate'] = $date;
?>
</body>
</html>