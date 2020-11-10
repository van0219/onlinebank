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
		.data_newEmp table, th, td{
			padding: 6px;
			border: 1px solid #363636;
			text-align: center;
			border-collapse: collapse;
		}
	</style>
</head>
<?php include 'topBar.php' ?>
<div class="data_newAcc">
	<?php include 'account_nav.php' ?>
	<div class="account_top_nav">
		<div class="text">
			Welcome, <span style="font-weight: normal;"><?php echo $_SESSION['name']?>!</span>
		</div>
	</div>
	<br><br><br><br>
	<h3 style="text-align: center; color: #363636">
		Summary of Account
	</h3>
	<form action="account_account_statement_date.php" method="POST">
		<table align="center">
			<tr>
				<td>Start Date</td>
				<td><input type="date" name="start" required=""></td>
			</tr>
			<tr>
				<td>End Date</td>
				<td><input type="date" name="end" required=""></td>
			</tr>
		</table>
		<table align="center">
			<tr>
				<td colspan="2" align="center">
					<input type="submit" name="summary" value="Go" class="addEmp_button"/>
				</td>
			</tr>
		</table>
	</form>
</div>
<?php include 'bot.php' ?>
</body>
</html>