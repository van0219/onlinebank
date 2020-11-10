<?php
	session_start();
	if (!isset($_SESSION['accountLogin'])) {
		header('location:main.php');
	}
?>
<!--#####-->
<?php
	$custID = $_SESSION['custID'];
	include 'connection.php';
	$query = "SELECT ID
				  ,CONCAT(SUBSTRING(`FNAME`,1,1), SUBSTRING(LOWER(`FNAME`) FROM 2)) AS FNAME
				  ,CONCAT(SUBSTRING(`MNAME`,1,1), SUBSTRING(LOWER(`MNAME`) FROM 2)) AS MNAME
				  ,CONCAT(SUBSTRING(`LNAME`,1,1), SUBSTRING(LOWER(`LNAME`) FROM 2)) AS LNAME
				  ,`GENDER`
				  ,`DOB`
				  ,`ACC_TYPE`
				  ,`ADDRESS`
				  ,`MOBILE`
				  ,`EMAIL`
				  ,`PASSWORD`
				  ,`BRANCH`
				  ,`BRANCH_CODE`
				  ,`LAST_ACCESS`
				  ,`STATUS`
		      FROM accounts
			  WHERE EMAIL = '$custID'";
	$result = mysqli_query($link, $query) or die(mysqli_error($link));
	$rows = mysqli_fetch_array($result);
	#####
	$accNum = $rows[0];
	$name = $rows[1]." ".$rows[2]." ".$rows[3];
	$gender = $rows[4];
	$accType = $rows[6];
	$address = $rows[7];
	$mobile = $rows[8];
	$email = $rows[9];
	$branch = $rows[11];
	$branchCode = $rows[12];
	$lastLogin = $rows[13];
	$accStatus = $rows[14];
	#####
	$_SESSION['login_id'] = $accNum;
	$_SESSION['name'] = $name;
?>
<!DOCTYPE html>
<html>
<head>
	<title>HOME | Online Bank</title>
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
	<?php include 'account_nav.php'?>
	<div class="account_top_nav">
		<div class="text">
		Welcome, <span style="font-weight: normal;"><?php echo $_SESSION['name'];?>!</span>
		</div>
	</div>
	<?php
		$query2 = "SELECT * FROM PASSBOOK".$_SESSION['login_id'];
		$result2 = mysqli_query($link, $query2) or die(mysqli_error($link));
		while ($rows2 = mysqli_fetch_array($result2)) {
			$balance = $rows2[7];
		}
	?>

		<div class="content1">
			<p><span class="heading">Account No: </span><?php echo $accNum;?></p>
			<p><span class="heading">Branch: </span><?php echo $branch;?></p>
			<p><span class="heading">Branch Code: </span><?php echo $branchCode;?></p>
		</div>
		<div class="content2">
			<p><span class="heading">Balance: Php </span><?php echo $balance;?></p>
			<p><span class="heading">Status: </span><?php echo $accStatus;?></p>
			<p><span class="heading">Last Access: </span><?php echo $lastLogin;?></p>
		</div>

</div>
	<?php include 'bot.php'; ?>
</body>
</html>

