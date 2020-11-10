<?php
	session_start();
	if (isset($_SESSION['empLogin'])) {
		header('location:homePageEmp.php');
	}
?>
<!--#####-->
<!DOCTYPE html>
<html>
<head>
	<title>LOGIN | Personnel</title>
	<meta charset="utf-8">
	<noscript>
		<meta http-equiv="refresh" content="0;url=jdDisabled.php">
	</noscript>
	<link rel="stylesheet" type="text/css" href="design.css">
	<style type="text/css">
		.data .login input{
			border-radius: 5px;
		}
	</style>
</head>
<?php include 'topBar.php' ?>
<div class="data">
	<div class="login">
		<form action="" method="POST">
			<table align="center">
				<tr>
					<td><span class="caption">Personnel Login</span></td>
				</tr>
				<tr>
					<td colspan="2"><hr></td>
				</tr>
				<tr>
					<td>Email </td>
				</tr>
				<tr>
					<td><input type="text" placeholder="sample@ymail.com" name="username" required=""></td>
				</tr>
				<tr>
					<td>Password </td>
				</tr>
				<tr>
					<td><input type="password" placeholder="********" name="password" required=""></td>
				</tr>
				<tr>
					<td class="button1"><input type="submit" name="submitEmp" value="Login" class="button"></td>
				</tr>
			</table>
		</form>
	</div>
</div>
<?php include 'bot.php'; ?>
<!--######-->
<?php 
	if (isset($_REQUEST['submitEmp'])) {
		include 'connection.php';
		$username = mysqli_real_escape_string($link, $_REQUEST['username']);
		$salt = "5%GHD7**0HGDs325kX";
		$password = MD5(sha1(mysqli_real_escape_string($link, $_REQUEST['password']).$salt));
		#####
		$query = "SELECT `EMAIL`
					    ,`PASSWORD`
			      FROM PERSONNEL
			      WHERE EMAIL = '$username' AND
			      	    PASSWORD = '$password'";
		$result = mysqli_query($link, $query) or die(mysqli_error($link));
		$rows = mysqli_fetch_array($result);
		#####
		if ($rows[0]) {
			$_SESSION['empID'] = $username;
			$_SESSION['password'] = $password;
			$_SESSION['emp'] = 1;
			header('location:verify_otp.php');// I created this php file to validate OTP entered by user
		}
		else{
			echo "<script>alert('Invalid username or password!');</script>";
			echo "<script>window.location = 'empLogin.php';</script>";
		}
	}
?>
</body>
</html>