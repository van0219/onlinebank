<!--##THIS IS WHERE THE ACCOUNT HOLDERS LOGIN###-->
<?php
	session_start();
	if (isset($_SESSION['accountLogin'])) {
		header('location:account_account_summary.php');
	}
?>
<?php
	if (isset($_REQUEST['submit'])) {
		include 'connection.php';
		$email = mysqli_real_escape_string($link, $_REQUEST['email']);
		$salt="5%GHD7**0HGDs325kX";
		$password = MD5(sha1(mysqli_real_escape_string($link, $_REQUEST['pass']).$salt));

		$query = "SELECT ID
						,`EMAIL`
						,`PASSWORD` 
				  FROM ACCOUNTS 
				  WHERE EMAIL ='$email' AND PASSWORD = '$password'";
		$result = mysqli_query($link, $query) or die(mysqli_error($link));
		$rows = mysqli_fetch_array($result);

		$user = $rows[1];
		$pass = $rows[2];
		if ($user == $email && $pass == $password) {
			$_SESSION['custID'] = $email;
			$_SESSION['pass'] = $pass;
			$_SESSION['login_id'] = $rows[0];
			$_SESSION['acc'] = 1;
			header('location:verify_otp2.php');
		}
		else{
			echo "<script>alert('Incorrect username or password!');";
			echo "window.location = 'main.php';</script>";
		}
	} 
?>
	<!DOCTYPE html>
	<html>
	<head>
		<title>Online Banking System</title>
		<meta charset="utf-8">
		<noscript>
			<meta http-equiv="refresh" content="0;url=jsDisabled.php">
		</noscript>
		<link rel="stylesheet" type="text/css" href="design.css">
		<style type="text/css">
			.login a{
				color: blue;
				text-decoration: none;
			}
		</style>
	</head>
	<body>
		<div class="wrapper">
			<div class="header">
				<div style="color: goldenrod;"><hr style="line-height: 5px;"></div>
			</div>
			<div class="navbar">
				<ul>
					<li><a href="main.php">Home</a></li>
					<li><a href="contacts.php">Contact Us</a></li>
				</ul>
			</div>
			<div class="login">
				<form action="" method="POST">
					<table align="right">
						<tr>
							<td class="caption" style="margin-top: 20px;">LOGIN</td>
						</tr>
						<tr>
							<td colspan="2"><hr></td>
						</tr>
						<tr>
							<td>Email</td>
						</tr>
						<tr>
							<td><input type="text" name="email"  placeholder="sample@ymail.com" required="" style="border-radius: 5px;"></td>
						</tr>
						<tr>
							<td>Password</td>
						</tr>
						<tr>
							<td><input type="password" name="pass" placeholder="********" required="" style="border-radius: 5px;"></td>
						</tr>
						<tr>
							<td class="button1"><input type="submit" name="submit" value="Log In" class="button" style="border-radius: 6px;"></td>
						</tr>
						<tr>
							<td style="margin: 10px;"></td>
						</tr>
					</table>
				</form>
			</div>
			<div class="image" style="border: 1px solid goldenrod;">
				<img src="home.png" height="100%" width="100%" style="border-radius: 5px;">
			</div>
			<div class="left_panel">
				<h3>Services</h3>
				<ul style="font-size: 12px;">
					<li>Online Bank Registration</li>
					<li>Add Beneficiary</li>
					<li>Fund Transfer</li>
					<li>Secure Login</li>
					<li>ATM and Checkbook</li>
					<li>Statement of Account</li>
					<li>and More...</li>
				</ul>
			</div>
			<div class="right_panel">
			</div>
			<?php include 'bot.php' ?>
		</div>
	</body>
	</html>

