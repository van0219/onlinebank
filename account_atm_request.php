<?php
	session_start();
	if (!isset($_SESSION['accountLogin'])) {
		header('location:main.php');
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>ATM | Request</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="design.css">
	<style>
		.data_newEmp table, th, td{
			padding: 6px;
			border: 1px solid #363636;
			border-collapse: collapse;
			text-align: center;
		}
		.data_newEmp select{
			border-radius: 5px;
		}
	</style>
</head>
<?php include 'topBar.php' ?>
<div class="data_newAcc">
	<?php include 'account_nav.php' ?>
	<div class="account_top_nav">
		<div class="text">
			Welcome, <?php echo $_SESSION['name']?>!
		</div>
	</div>
	<br><br><br><br>
	<form action="account_atm_request_process.php" method="POST"> 
		<table align="center" style="margin-top: 50px;">
			<tr>
				<td>
					Issue: 
					<select name="select" style="border-radius: 5px;">
						<option value="ATM" selected="">ATM Card</option>
						<option value="Cheque">Cheque Book</option>
					</select>
				</td>
			</tr>
		</table>
		<table align="center">
			<tr>
				<td>
					<input type="submit" name="submit" value="Request" class="addEmp_button">
				</td>
			</tr>
		</table>
	</form>
<?php 
	include 'connection.php';
	$senderID = $_SESSION['login_id'];
	#####
	$query = "SELECT ACCNUM
				    ,STATUS 
			  FROM CHECKBOOK 
			  WHERE ACCNUM = '$senderID'";
	$result = mysqli_query($link, $query) or die(mysqli_error($link));
	$rows = mysqli_fetch_array($result);
	$statusCheck = $rows[1];
	$accnumCheck = $rows[0];
	#####
	$query2 = "SELECT ACCNUM
				     ,STATUS
			   FROM ATM 
			   WHERE ACCNUM = '$senderID'";
	$result2 = mysqli_query($link, $query2) or die(mysqli_error($link));
	$rows2 = mysqli_fetch_array($result2);
	$statusAtm = $rows2[1];
	$accnumAtm = $rows2[0];
	#####
	if (($accnumAtm == $senderID)||($accnumCheck == $senderID)) {
		echo "<table align='center' style='margin-top:50px;'>";
		echo "<th>Requests</th><th>Status</th>";
		echo "<tr><td style='text-align:right;'>ATM CARD Status: </td><td>$statusAtm</td></tr>";
		echo "<tr><td style='text-align:right;'>Cheque Book Status: </td><td>$statusCheck</td></tr>";
		echo "</table>";
	}
?>
</div>
<?php include 'bot.php'; ?>
</body>
</html>