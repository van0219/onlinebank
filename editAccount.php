<?php
	session_start();
	if (!isset($_SESSION['adminLogin'])) {
		header('location:admin_login.php');
		
	}
?>
<!--#####-->
<?php 
	include 'connection.php';
	$id = mysqli_real_escape_string($link, $_REQUEST['accountID']);
	if ($id >= 1) {
		$query = "SELECT * FROM ACCOUNTS WHERE ID = '$id'";
		$result = mysqli_query($link, $query) or die(mysqli_error($link));
		$rows = mysqli_fetch_array($result);	
	}
	else{
		header('location:showAccount.php');
	}
?>
<!--#####-->
<?php
	$delID = mysqli_real_escape_string($link, $_REQUEST['accountID']);
	if (isset($_REQUEST['submitDel'])) {
		if ($delID >= 1) {
			$query2 = "UPDATE ACCOUNTS
		    		   SET STATUS = 'INACTIVE'
		    		   WHERE ID = '$delID'";
			$query3 = "UPDATE PASSBOOK".$delID."
					   SET STATUS = 'INACTIVE'
					   WHERE ID = (SELECT MAX(ID) FROM PASSBOOK".$delID.")";
			mysqli_query($link, $query2) or die(mysqli_error($link));
			mysqli_query($link, $query3) or die(mysqli_error($link));
			header('location:removeAccount.php');
		}
		else{
			header('location:removeAccount.php');
		}
	}
?>
<!--#####-->
<?php
	$actID = mysqli_real_escape_string($link, $_REQUEST['accountID']);
	if (isset($_REQUEST['submitAct'])) {
		if ($actID >= 1) {
			$query4 = "UPDATE ACCOUNTS
					   SET STATUS = 'ACTIVE'
					   WHERE ID = '$delID'";
			$query5 = "UPDATE PASSBOOK".$actID."
				   	   SET STATUS = 'ACTIVE'
				   	   WHERE ID = (SELECT MAX(ID) FROM PASSBOOK".$actID.")";
			mysqli_query($link, $query4) or die(mysqli_error($link));
			mysqli_query($link, $query5) or die(mysqli_error($link));
			header('location:reactivateAccount.php');
		}
		else{
			header('location:reactivateAccount.php');
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Edit Account</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="design.css">
</head>
<?php include 'topBar.php'?>
<div class="data_newAcc">
	<?php include 'admin_nav.php' ?>
	<div class="newAcc">
		<form action="updateAccount.php" method="POST">
			<table align="center">
				<input type="hidden" name="currID" value="<?php echo($id);?>"/>
				<tr>
					<td colspan="2" align="center" style="color: #363636;">
						<u><b>Edit Account Information</b></u>
					</td>
				</tr>
				<tr>
					<td>First Name</td>
					<td><input style="border-radius: 5px; text-transform: uppercase;" type="text" name="fname" value="<?php echo($rows[1])?>" required=""/></td>
				</tr>
				<tr>
					<td>Middle Name</td>
					<td><input style="border-radius: 5px; text-transform: uppercase;" type="text" name="mname" value="<?php echo($rows[2])?>"/></td>
				</tr>
				<tr>
					<td>Last Name</td>
					<td><input style="border-radius: 5px; text-transform: uppercase;" type="text" name="lname" value="<?php echo($rows[3])?>" required=""/></td>
				</tr>
				<tr>
					<td>Gender</td>
					<td>
						<input type="radio" name = "gender" value="M" <?php if ($rows[4]=='M') {
							echo " checked";
						}?>/>Male
						<input type="radio" name="gender" value="F" style="margin-left: 70px;"<?php if ($rows[4]=='F') {
							echo " checked";
						}?>/>Female
					</td>
				</tr>
				<tr>
					<td>Date of Birth</td>
					<td>
						<input style="border-radius: 5px; width: 100%;" type="date" name="dob" value="<?php echo($rows[5]);?>">
					</td>
				</tr>
				<tr>
					<td>Account Type</td>
					<td>
						<select name="type" style="border-radius: 5px; width: 100%;">
							<option <?php if ($rows[6] == "Savings") {
								echo " selected";
							}?>>Savings
							</option>
							<option <?php if ($rows[6] == "Current") {
								echo " selected";
							}?>>Current								
							</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Address</td>
					<td>
						<textarea style="border-radius: 5px; text-transform: uppercase; width: 100%;" name="address"><?php echo $rows[7];?></textarea>
					</td>
				</tr>
				<tr>
					<td>Phone</td>
					<td>
						<input style="border-radius: 5px; width: 100%;" type="text" name="mobile" value="<?php echo($rows[8])?>" required="">
					</td>
				</tr>
				<tr>
					<td>Email</td>
					<td>
						<input style="border-radius: 5px; width: 100%;" type="text" name="email" value="<?php echo($rows[9])?>" required="">
					</td>
				</tr>
				<tr>
					<td colspan="2" align="center" style="padding-top: 20px;">
						<input style="border-radius: 5px;" type="submit" name="editAccount" value="Update" class="addEmp_button">
					</td>
				</tr>
			</table>
		</form>
	</div>
</div>
</body>
<?php include 'bot.php'?>
</html>