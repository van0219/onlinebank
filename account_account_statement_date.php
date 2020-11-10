<?php 
	session_start();
	if (!isset($_SESSION['accountLogin'])) {
		header('location:main.php');
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Statement of Account</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="design.css">
	<style>
		.data_account table, th, td{
			padding: 6px;
			border: 1px solid #363636;
			border-collapse: collapse;
			text-align: center;
		}
	</style>
</head>
<?php include 'topBar.php' ?>
<div class="data_newAcc">
	<?php include 'account_nav.php' ?>
	<div class="account_top_nav">
		<div class="text">
			<b>Welcome, <span style="font-weight: normal"><?php echo $_SESSION['name']?>!</span></b>
		</div>
	</div>
	<h3 style="text-align: center; color: #363636; margin-top: 50px;">
		Summary of Account
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
			if (isset($_REQUEST['summary'])) {
				$start = $_REQUEST['start'];
				$end = $_REQUEST['end'];
				#####
				include 'connection.php';
				$senderID = $_SESSION['login_id'];
				$query = "SELECT * FROM PASSBOOK".$senderID." 
						  WHERE TRANSDATE BETWEEN '$start' AND DATE_ADD(DATE('$end'), INTERVAL 1 DAY)";
				$result = mysqli_query($link, $query) or die(mysqli_error($link));
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
			}
		?>
	</table>
</div>
<?php include 'bot.php' ?>
</body>
</html>