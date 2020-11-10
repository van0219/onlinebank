<?php
	session_start();
	if (!isset($_SESSION['accountLogin'])) {
		header('location:main.php');
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Mini Statement</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="design.css">
	<style>
		.data_newEmp table, th, td{
			padding: 6px;
			border: 1px solid #363636;
			text-align: center;
		}
	</style>
</head>
<?php include 'topBar.php'?>
<div class="data_newAcc">
	<?php include 'account_nav.php' ?>
	<div class="account_top_nav">
		<div class="text">
			Welcome, <span style="font-weight: normal;"><?php echo $_SESSION['name']?>!</span>
		</div>
	</div>
	<?php include 'connection.php';
		$senderID = $_SESSION['login_id'];
		// echo"<script>alert('$senderID');</script>";
		$query = "SELECT * FROM PASSBOOK".$senderID." LIMIT 10";
		$result = mysqli_query($link, $query) or die(mysqli_error($link));
	?>
	<br><br><br>
	<h3 style="text-align: center; color: #363636;">
		Previous Transaction <span style="font-size: 10px;">(1-10)</span>
	</h3>
	<table align="center">
		<th>ID</th>
		<th>Transaction Date</th>
		<th>Credit</th>
		<th>Debit</th>
		<th>Balance</th>
		<th>Description</th>
		<!--#####-->
		<?php
			while ($rows = mysqli_fetch_array($result)) {
				echo "<tr>";
				echo "<td>".$rows[0]."</td>";
				echo "<td>".$rows[1]."</td>";
				echo "<td>".$rows[7]."</td>";
				echo "<td>".$rows[8]."</td>";
				echo "<td>".$rows[9]."</td>";
				echo "<td>".$rows[10]."</td>";
				echo "</tr>";
			}
		?>
	</table>
</div>
<?php include 'bot.php' ?>
</body>
</html>