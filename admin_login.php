<?php
	session_start();

	if (isset($_SESSION['adminLogin'])) {
		// echo "<script>window.location='homePageAdmin.php';</script>";
		header('location:homePageAdmin.php');
		// exit();
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<noscript>
		<meta http-equiv="refresh" content="0;url=jsDisabled.php">
	</noscript>
	<title>LOGIN - ADMIN</title>
	<link rel="stylesheet" type="text/css" href="design.css">
	<style type="text/css">
		.login{
			background: linear-gradient(to right, rgba(242,246,248,1) 0%, rgba(216,225,231,1) 31%, rgba(181,198,208,1) 99%, rgba(224,239,249,1) 100%);
		}
		.button1 .button:hover{
		    background: linear-gradient(to right, rgba(252,234,187,1) 0%, rgba(252,205,77,1) 99%, rgba(251,223,147,1) 100%);
    		color: #363636;
		}
	</style>
</head>
<?php include 'topBar.php'; ?>
<div class="data">
	<div class="login">
		<form action="" method="POST">
			<table align="center">
				<tr>
					<td><span class="caption">LOGIN | ADMIN</span></td>
				</tr>
				<tr>
					<td colspan="2"><hr></td>
				</tr>
				<tr>
					<td>Username</td>
				</tr>
				<tr>
					<td><input type="text" name="username" placeholder="sample123" required="" style="border-radius: 5px;"></td>
				</tr>
				<tr>
					<td>Password</td>
				</tr>
				<tr>
					<td><input type="Password" name="password" placeholder="********" required="" style="border-radius: 5px;"></td>
				</tr>
				<tr>
					<td class="button1"><input type="submit" name="submit" value="LOGIN" class="button" style="border-radius: 6px;"></td>
				</tr>
			</table>
		</form>
	</div>	
</div>
<?php include 'bot.php'; ?>
<?php include 'connection.php';
// echo("<script>alert('Pasok!')</script>");
	if (!isset($_SESSION['adminLogin'])) {
		if (isset($_REQUEST['submit'])) { 	
			$username = mysqli_real_escape_string($link, $_REQUEST['username']);
			$password = MD5(mysqli_real_escape_string($link, $_REQUEST['password']));	
			$query = "SELECT ID
							,USERNAME
							,PASSWORD 
					  FROM ADMIN 
					  WHERE USERNAME = '$username'";
			$result = mysqli_query($link, $query) or die(mysqli_error($link));
			$rows = mysqli_fetch_array($result);

			if (($username == $rows[1]) && ($password == $rows[2])) {
				$_SESSION['adminLogin'] = $rows[0];
				header('location:homePageAdmin.php');
			}
			else{
				echo"<script>alert('Incorrect Username or Password!');</script>";
				echo "<script>window.location = 'admin_login.php';</script>";
			}
		}
	} 
?>
</body>
</html>
