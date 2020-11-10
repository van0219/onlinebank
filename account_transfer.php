<?php
	session_start();
	if (!isset($_SESSION['accountLogin'])) {
		header('location:main.php');
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Fund Transfer</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="design.css">
	<style>
		.data_newEmp table, th, td{
			padding: 6px;
			border: 1px solid #363636;
			text-align: center;
			border-collapse: collapse;
		}
		.data_newEmp td{
			padding: 10px;
			text-align: right;
		}
		.data_newEmp select, input{
			border-radius: 5px;
		}
		.head{
			text-align: center;
			color: #363636;
			font-weight: bold;
		}
	</style>
</head>
<?php include 'topBar.php' ?>
<div class="data_newAcc">
	<?php include 'account_nav.php' ?>
	<div class="account_top_nav">
		<div class="text">
			Welcome, <span style="font-weight: normal;"><?php echo $_SESSION['name'];?>!</span>
		</div>
	</div>
	<br><br><br><br>
	<h3 style="text-align: center; color: #363636">
		Fund Transfer
	</h3>
	<?php 
		include 'connection.php';
		$senderID = $_SESSION['login_id'];
		$query  = "SELECT SENDER_ID FROM BENEFICIARY 
				   WHERE SENDER_ID = '$senderID' AND STATUS = 'ACTIVE'"; 
		$result = mysqli_query($link, $query);
		$rows = mysqli_fetch_array($result);
		$id = $rows[0];
	?>
	<?php
		if ($senderID == $id) {
			echo "<form action = 'account_transfer_process.php' method ='POST'>";
			echo "<table align='center'>";
			echo "<tr><td>Choose Beneficiary: </td><td><select name='transfer'>";
			#####
			$query2 = "SELECT * FROM BENEFICIARY
					   WHERE SENDER_ID = '$senderID' AND STATUS = 'ACTIVE'";
			$result2 = mysqli_query($link, $query2);
			#####
			while ($rows2 = mysqli_fetch_array($result2)) {
				echo "<option value = '$rows2[4]'>$rows2[5]</option>";
			}
			echo "</td></tr></select>";
			
			echo "<tr><td>Enter Amount: </td><td><input type = 'number' name = 'amount' required=''></td></table>";
			echo "<table align='center'><tr><td style = 'padding: 5px;'><input type = 'submit' name = 'submit' value='Transfer' class = 'addEmp_button'></td></tr></table></form>";
		}
		else{
			echo "<br><br><div class = 'heading' style='margin-right:200px; float: left;'>Beneficiary list is empty.<h3></div>";
		}
	?>
</div>
<?php include 'bot.php'; ?>
</body>
</html>