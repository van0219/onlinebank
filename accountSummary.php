<?php
	session_start();
	if (!isset($_SESSION['accountLogin'])) {
		header('location:main.php');
	} 
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="design.css">
</head>
<?php include 'topBar.php'?>
<div class="data_account">
	<?php include 'customer_nav.php' ?>
	<?php
		$custID = $_SESSION['custID'];
		include 'connection.php';
		$query = "SELECT * FROM ACCOUNTS WHERE EMAIL = 'custID'";
		$result = mysqli_query($link, $query) or die(mysqli_error($link));
		$rows = mysqli_fetch_array($result);
		$accountNo = $rows[0];
		$name = $rows[1];
		$gender = $rows[2];
		$accType = $rows[5];
		$address = $rows[6];
		$mobile = $rows[7];
		$email = $rows[8];	
		$branch = $rows[10];
		$branchCode = $rows[11];
		$lastLogin = $rows[12];
		$accStatus = $rows[13];

		$_SESSION['login_id'] = $accountNo;
		$_SESSION['name'] = $name;

		$query2 = "SELECT * FROM PASSBOOK".$_SESSION['login_id'];
		$result2 = mysqli_query($link, $query2) or die(mysqli_error($link));
		$rows2 = mysqli_fetch_array($result2);
		$balance = $rows2[6]
	?>
	<p>Name: <?php echo $name;?></p>
	<p>Gender: <?php if($gender == 'M') echo "Male"; else echo "Female";?></p>
	<p>Mobile: <?php echo $mobile;?></p>
	<p>Email: <?php echo $email;?></p>
	<br>
	<p>Account No: <?php echo $accountNo;?></p>
	<p>Branch: <?php echo $branch;?></p>
	<p>Branch Code: <?php echo $branchCode;?></p>
	<p>Last Login: <?php echo $lastLogin;?></p>
	<br>
	<p>Account Status: <?php echo $accStatus;?></p>
	<p>Account Type: <?php echo $accType;?></p>
	<p>Address: <?php echo $address;?></p>
</div>
<?php include 'bot.php'; ?>
</body>
</html>