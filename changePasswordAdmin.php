<?php
	session_start();
	include 'connection.php';
	if (!isset($_SESSION['adminLogin'])) {
		header('location:admin_login.php');
	} 
?>
<!DOCTYPE html>
<html>
<head>
	<title>Change Password</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="design.css">
</head>
<?php include 'topBar.php' ?>
<div class="data_newAcc">
	<?php include 'admin_nav.php'?>
	<div class="acp">
		<form action="" method="POST">
			<table align="center">
				<tr>
					<img src="key.ico" style="margin-left: 25px; margin-top: 10px;">
				</tr>
				<tr>
					<td>Current Password</td>
					<td><input type="Password" name="curr_password" required=""></td>
				</tr>
				<tr>
					<td>New Password</td>
					<td><input type="Password" name="new_password" required=""></td>
				</tr>
				<tr>
					<td>Re-enter New Password</td>
					<td><input type="Password" name="re_password" required=""></td>
				</tr>
				<tr>
					<td colspan="2" style="padding-top: 20px; padding-left: 100px;"><input type="submit" name="change_password" value="Change" class="addEmp_button"></td>
				</tr>
			</table>
		</form>
	</div>
</div>
<?php include 'bot.php'; ?>
<?php
	if (isset($_REQUEST['change_password'])) {
		$curr = mysqli_real_escape_string($link, $_REQUEST['curr_password']);
		$new = mysqli_real_escape_string($link, $_REQUEST['new_password']);
		$retype = mysqli_real_escape_string($link, $_REQUEST['re_password']);
		$id = $_SESSION['adminLogin'];
		$query = "SELECT PASSWORD 
				  FROM ADMIN 
				  WHERE ID = '$id' AND STATUS = 'ACTIVE'";
		$result = mysqli_query($link, $query);
		$rows = mysqli_fetch_array($result);
		if ($rows[0] == $curr && $new == $retype) {
			$query2 = "UPDATE ADMIN 
					   SET PASSWORD  = '$new' 
					   WHERE ID = '$id'";
			mysqli_query($link, $query2) or die(mysqli_error($link));
			echo "<script>alert('Password Changed Succesfully!');</script>";
		    echo "<script>window.location = 'homePageAdmin.php';</script>";
		    exit();
		}
		elseif ($rows[0] != $curr) {
			echo "<script>alert('Incorrect Password!');</script>";
			echo "<script>window.location = 'changePasswordAdmin.php';</script>";
			exit();
		}
		elseif ($rows[0] == $curr && $new != $retype) {
			echo "<script>alert('Password Mismatch!');</script>";
			echo "<script>window.location = 'changePasswordAdmin.php';</script>";
			exit();
		}
	}
?>
</body>
</html>
<!-- <script type="text/javascript">
	function clearTextboxes(){
		$('input[name=curr_password]').val("");
		$('input[name=new_password]').val("");
		$('input[name=re_password]').val("");
		alert('Pass Mismatch!');
	}
</script> -->
