<?php
session_start();

if(!isset($_SESSION['adminLogin']))
	header('location:admin_login.php');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Add Account</title>
	<link rel="stylesheet" type="text/css" href="design.css">
</head>
<?php include 'topBar.php'; ?>
<div class="data_newAcc">
	<?php include 'admin_nav.php'; ?>
	<div class="newAcc">
		<form action="add_Account.php" method="POST">
			<table align="center">
				<tr>
					<td colspan="6" align="center" style="color: #363636"><h3><u><b>Add Account</b></u></h3></td>
				</tr>
				<tr>
					<td>First Name</td>
					<td><input type="text" name="fname" required="" style="border-radius: 5px; text-transform: uppercase;"></td>
					<td>DOB</td>
					<td><input type="date" name="dob" required="" style="border-radius: 5px; text-transform: uppercase; width: 100%;"></td>
				</tr>
				<tr>
					<td>Middle Name</td>
					<td><input type="text" name="mname" style="border-radius: 5px; text-transform: uppercase;"></td>
					<td>Gender</td>
					<td>
						<input type="radio" name="gender" value="M" checked>Male
						<input type="radio" name="gender" style="margin-left: 70px;" value="F">Female
					</td>
				</tr>
				<tr>
					<td>Last Name</td>
					<td><input type="text" name="lname" style="border-radius: 5px; text-transform: uppercase;"></td>
					<td>Account Type</td>
					<td>
						<select name="type" style="border-radius: 5px; width: 100%;">
							<option>Savings</option>
							<option>Current</option>
						</select>
					</td>
				</tr>
				<tr>				
					<td>Email Address</td>
					<td><input type="email" name="email" required="" style="border-radius: 5px; text-transform: lowercase;"></td>
					<td>Mobile</td>
					<td><input type="text" name="mobile" style="border-radius: 5px;"></td>
				</tr>
				<tr>
					<td>Password</td>
					<td><input type="Password" name="password" required="" style="border-radius: 5px;"></td>
					<td>ReType Password</td>
					<td><input type="Password" name="re_password" required="" style="border-radius: 5px;"></td>
				</tr>
				<tr>
					<td>Branch</td>
					<td>
						<select name="branch" style="border-radius: 5px; width: 100%;">
							<option>Quezon City</option>
							<option>Makati City</option>
							<option>Manila City</option>
						</select>
					</td>
					<td>Address</td>
					<td rowspan="2"><textarea name="address" required="" style="border-radius: 5px; text-transform: uppercase; width: 100%; height: 52px;"></textarea></td>
				</tr>
				<tr>
					<td>Initial Balance</td>
					<td><input type="number" name="initial" value="100" min="100" style="border-radius: 5px;"></td>
				</tr>
				<tr>
					<td colspan="6" align="center" style="padding-top: 30px;">
						<input type="submit" name="addNew" value="Add Account" class="addEmp_button" style="border-radius: 5px; font-weight: bold;">
					</td>
				</tr>
			</table>
		</form>
	</div>
</div>
<?php include 'bot.php'; ?>
</body>
</html>