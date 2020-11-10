<?php
	session_start();

	if (!isset($_SESSION['adminLogin'])){
		// echo "<script>window.location='admin_login.php';</script>";
		header('location:admin_login.php');
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="design.css">
	<title>HOME | Admin</title>
	<style type="text/css">
		.data .admin_nav a{
			color:blue;
		}
		.admin hr{
		    background-color: white;
		    border:none;
		    height: 1px;
		}
		.account hr{
		    background-color: white;
    		border:none;
    		height: 1px;
		}
		.data .account{
			float: right;
			margin-right: 350px;
		}
		.data .admin{
			float: left;
			margin-left: 165px;
		}
		.admin .divButton{
			background: linear-gradient(to right, rgba(241,231,103,1) 0%, rgba(254,182,69,1) 100%);
			border-radius: 5px; 
			text-align: center; 
			height: 25px;
			color: #363636;
			width: 95%;
		}
		.pButton{
			position: relative; 
			top: 4px;
			margin: -3%;
		}
		.account .divButton{
			background: linear-gradient(to right, rgba(241,231,103,1) 0%, rgba(254,182,69,1) 100%);
			border-radius: 5px; 
			text-align: center; 
			height: 25px;
			color: #363636;
			width: 95%;
		}
		.data .admin div:hover{
		    background: linear-gradient(to right, rgba(252,234,187,1) 0%, rgba(252,205,77,1) 99%, rgba(251,223,147,1) 100%);
    		color: #363636;
		}
		.data .account div:hover{
		    background: linear-gradient(to right, rgba(252,234,187,1) 0%, rgba(252,205,77,1) 99%, rgba(251,223,147,1) 100%);
    		color: #363636;
		}
		.admin_nav a{
			font-size: 12.5px;
		}
	</style>
</head>
<?php include 'topBar.php'; ?>
	<div class="data">
		<?php include 'admin_nav.php'; ?>
		<div class="admin">
			<ul>
				<li><b>Bank Personnel</b></li><hr>
				<li><a href="addEmployee.php" style="color: #363636;"><div class="divButton"><p class="pButton">Add Personnel</p></div></a></li>
				<li><a href="showEmployee.php" style="color: #363636;"><div class="divButton"><p class="pButton">Update Personnel</p></div></a></li>
				<li><a href="removeEmployee.php" style="color: #363636;"><div class="divButton"><p class="pButton">Deactivate Personnel</p></div></a></li>
				<li><a href="reactivateEmployee.php" style="color: #363636"><div class="divButton"><p class="pButton">Reactivate Personnel</p></div></a></li>
			</ul>
		</div>
		<div class="account">
			<ul>
				<li><b>Bank Account</b></li><hr>
				<li><a href="addAccount.php"><div class="divButton"><p class="pButton">Add Account</p></div></a></li>
				<li><a href="showAccount.php"><div class="divButton"><p class="pButton">Update Account</p></div></a></li>
				<li><a href="removeAccount.php"><div class="divButton"><p class="pButton">Deactivate Account</p></div></a></li>
				<li><a href="reactivateAccount.php"><div class="divButton"><p class="pButton">Reactivate Account</p></div></a></li>
			</ul>
		</div>
	</div>
	<?php include 'bot.php'; ?>
</body>
</html>
