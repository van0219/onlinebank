<?php 
	session_start();
	if (!isset($_SESSION['accountLogin'])) {
		header('location:main.php');
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Add Beneficiary</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="design.css">
	<style>
		.data_newAcc table, th, td{
			padding: 6px;
			border: 1px solid #363636;
			border-collapse: collapse;
		}
		.data_newAcc td{
			text-align: right;
			color: #363636;
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
	<br><br/>
	<form action="beneficiaryProc.php" method="POST">
		<br><br/>
		<h3 style="text-align: center;color: #363636;">Add Beneficiary</h3>
		<table align="center">
			<tr>
				<td><span class="heading">Payee Fname:</span></td>
				<td><input type="text" name="fname" style="border-radius: 5px; text-transform: uppercase;" required=""></td>
			</tr>
			<tr>
				<td><span class="heading">Payee Mname:</span></td>
				<td><input type="text" name="mname" style="border-radius: 5px; text-transform: uppercase;"></td>
			</tr>
			<tr>
				<td><span class="heading">Payee Lname:</span></td>
				<td><input type="text" name="lname" style="border-radius: 5px; text-transform: uppercase;" required=""></td>
			</tr>
			<tr>
				<td><span class="heading">Account No:</span></td>
				<td><input type="text" name="accNum" style="border-radius: 5px;" required=""></td>
			</tr>
			<tr>
				<td><span class="heading">Branch:</span></td>
				<td>
					<select name="branch_select" style="width: 100%; border-radius: 5px;" required="">
						<option value="Quezon City">Quezon City</option>
						<option value="Makati City">Makati City</option>
						<option value="Manila City">Manila City</option>
					</select>
				</td>
			</tr>
			<tr>
				<td><span class="heading">Branch Code:</span></td>
				<td><input type="text" name="branchCode" style="border-radius: 5px;" required=""></td>
			</tr>
		</table>
		<table align="center" style="border-collapse: collapse;">
			<tr>
				<td><input type="submit" name="submit" value="Add Beneficiary" class="addEmp_button"></td>
			</tr>
		</table>
	</form>
</div>
<?php include 'bot.php' ?>
</body>
</html>