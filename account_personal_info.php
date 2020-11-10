<?php
	session_start();
	if (!isset($_SESSION['accountLogin'])) {
		header('location:main.php');
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Personal Information</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="design.css">
	<style type="text/css">
		.data_newEmp .content3 p{
			margin-left: 5px;
			margin-right: 5px;
		}
		.data_newEmp .content4 p{
			margin-left: 10px;
			margin-right: 10px;
		}
		.con{
			padding-left: 130px;
		}
	</style>
</head>
<?php include 'topBar.php'?>
<div class="data_newAcc">
	<?php 
		$custID = $_SESSION['custID'];
		include 'connection.php';
		$query = "SELECT * FROM ACCOUNTS 
				  WHERE EMAIL = '$custID'";
		$result = mysqli_query($link, $query) or die(mysqli_error($link));
		$rows = mysqli_fetch_array($result);
		#####
		$accNum = $rows[0];
		$name = $rows[1].' '.$rows[2].' '.$rows[3];
		$gender = $rows[4];		
		$dob = $rows[5];
		$accType = $rows[6];
		$address = $rows[7];
		$mobile = $rows[8];
		$email = $rows[9];
		$branch = $rows[11];
		$branchCode = $rows[12];
		$lastAccess = $rows[13];
		$accStatus = $rows[14];	
	?>
	<?php include 'account_nav.php' ?>
	<div class="account_top_nav" style="margin-right: 4px; margin-left: 4px;">
		<div class="text">
			Welcome, <?php echo $_SESSION['name']?>!
		</div>
	</div>
	<br><br><br><br>
	<h3 style="text-align: center; color: #363636; margin-bottom: 0px;">
		Personal Information
	</h3>
	<div class="con">
		<div class="content3">
			<p><span class="heading">Name: </span><?php echo $name;?></p>
			<p><span class="heading">Gender: </span><?php if($gender=='M') echo "Male"; else echo "Female";?></p>
			<p><span class="heading">Phone </span><?php echo $mobile;?></p>
			<p><span class="heading">Email: </span><?php echo $email;?></p>
			<p><span class="heading">Address: </span><?php echo $address;?></p>
		</div>
		<div class="content4">
			<p><span class="heading">Account No: </span><?php echo $accNum;?></p>
			<p><span class="heading">Branch: </span><?php echo $branch;?></p>
			<p><span class="heading">Branch Code: </span><?php echo $branchCode;?></p>
			<p><span class="heading">Account Type: </span><?php echo $accType;?></p>
		</div>
	</div>
</div>
<?php include 'bot.php';?>
</body>
</html>