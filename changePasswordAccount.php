<?php
	session_start();
	include 'connection.php';
	if (!isset($_SESSION['accountLogin'])) {
		header('location:main.php');
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
			border:1px solid #363636;
			border-collapse: collapse;
			text-align: center;
		}
		.data_newEmp td{
			text-align: right;
		}
		.data_newEmp input{
			border-radius: 5px;
		}
	</style>
</head>
<?php include 'topBar.php' ?>
<div class="data_newAcc">
	<?php include 'account_nav.php' ?>
	<div class="account_top_nav">
		<div class="text">
			Welcome, <?php echo $_SESSION['name']?>!
		</div>
		<br><br><br><br>
		<h3 style="text-align: center; color: #363636;">
			Change Password
		</h3>
		<form action="" method="POST">
			<table align="center">
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
				<table align="center">
					<tr>
						<td><input type="submit" name="changePassword" value="Change" class="addEmp_button"/></td>
					</tr>
				</table>
			</table>
		</form>
		<?php
			$changePass = $_SESSION['login_id'];
			if (isset($_REQUEST['changePassword'])) {
				$query = "SELECT PASSWORD 
						  FROM ACCOUNTS 
						  WHERE ID = '$changePass'";
				$result = mysqli_query($link, $query) or die(mysqli_error($link));
				$rows = mysqli_fetch_array($result);
				#####
				$salt = "5%GHD7**0HGDs325kX";
				$curr = md5(sha1($_REQUEST['curr_pass'].$salt));
				$new = md5(sha1($_REQUEST['new_pass'].$salt));
				$retype = md5(sha1($_REQUEST['re_pass'].$salt));
				#####
				if ($rows[0] == $curr && $new == $retype) {
					$query2 = "UPDATE ACCOUNTS
							   SET PASSWORD = '$new'
							   WHERE ID = '$changePass'";
					mysqli_query($link, $query2) or die(mysqli_error($link));
					echo "<script>alert('Password updated successfully!');";
					echo "window.location = 'account_account_summary.php';</script>";
				}
				elseif ($rows[0] != $curr){
					echo "<script>alert('Incorrect Password!');";
					echo "window.location = 'changePasswordAccount.php';</script>";
				}
				elseif ($rows[0] == $curr && $new != $retype) {
					echo "<script>alert('Password mismatch!');";
					echo "window.location = 'changePasswordAccount.php';</script>";
				}
			}
		?>
	</div>
</div>
<?php include 'bot.php';?>
</body>
</html>