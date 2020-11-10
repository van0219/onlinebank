<?php 
	session_start();
	include 'connection.php';
	if (!isset($_SESSION['empLogin'])) {
		header('location:emp_login.php');
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Change Password</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="design.css">
	<style>
		.data_newEmp table, th, td{
			padding: 6px;
			border-style: none;
			border-collapse: collapse;
			text-align: right;
			margin-top: 50px;
		}
		.data_newEmp input{
			border-radius: 5px;
		}
	</style>
</head>
<?php include 'topBar.php' ?>
<div class="data_newAcc">
	<?php include 'emp_nav.php' ?>
	<form action="" method="POST">
		<div class="content1" style="height: 270px; width: 400px; margin-top: 20px; margin-left: 300px;">
			<table align="center" style="margin-top: 20px;">
				<tr>
					<td style="padding-right: 30px;"><img src="key.ico"></td>
					<td><h3 style="text-align: center; color: #363636; padding-right: 30px;">
			 			Change Password
						</h3>
					</td>
				</tr>
				<tr>
					<td>Current Password:</td>
					<td><input type="Password" name="curr_pass" required=""></td>
				</tr>
				<tr>
					<td>New Password:</td>
					<td><input type="Password" name="new_pass" required=""></td>
				</tr>
				<tr>
					<td>ReType New Password:</td>
					<td><input type="Password" name="re_pass" required=""></td>
				</tr>			
			</table>
			<table align="center" style="margin-top: 10px;">
				<tr>
					<td><input type="submit" name="changePassword" value="Change" class="addEmp_button"/></td>
				</tr>
			</table>
		</div>
	</form>
	<?php
		$user = $_SESSION['login_id'];
		if (isset($_REQUEST['changePassword'])) {
			$query = "SELECT PASSWORD 
					  FROM EMPLOYEE 
					  WHERE EMAIL = '$user'";
			$result = mysqli_query($link, $query);
			$rows = mysqli_fetch_array($result);
			$salt = "5%GHD7**0HGDs325kX";
			$curr = md5(sha1(mysqli_real_escape_string($link, $_REQUEST['curr_pass']).$salt));
			$new = md5(sha1(mysqli_real_escape_string($link, $_REQUEST['new_pass']).$salt));
			$ReType = md5(sha1(mysqli_real_escape_string($link, $_REQUEST['re_pass']).$salt))
			;
			if ($rows[0] == $curr && $new == $ReType) {
				$query2 = "UPDATE EMPLOYEE
						   SET PASSWORD = '$new'
						   WHERE EMAIL = '$user'";
				mysqli_query($link, $query2) or die(mysqli_error($link));
				echo "<script>alert('Password changed successfully!');</script>";
				echo "<script>window.location = 'homePageEmp.php';</script>";
			}
			elseif ($rows[0] != $curr){
				echo "<script>alert('Incorrect Password!');</script>";
				echo "<script>window.location = 'changePasswordEmp.php';</script>";
			}
			else{
				echo "<script>alert('Password mismatch!');</script>";
				echo "<script>window.location = 'changePasswordEmp.php';</script>";
			}
		}
	?>
</div>
<?php include 'bot.php';?>
</body>
</html>