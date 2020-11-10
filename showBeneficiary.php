<?php 
	session_start();
	if (!isset($_SESSION['accountLogin'])) {
		header('location:main.php');
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>My Beneficiaries</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="design.css">
	<style>
		.data_account table, th, td{
			padding: 6px;
			border: 1px solid #363636;
			border-collapse: collapse;
			text-align: center;
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
	<?php
		include 'connection.php';
		$senderID = $_SESSION['login_id'];
		$query = "SELECT * FROM BENEFICIARY 
				  WHERE SENDER_ID = '$senderID'
				  	AND STATUS = 'ACTIVE'";
		$result = mysqli_query($link, $query) or die(mysqli_error($link));
		$query2 = "SELECT MIN(ID) FROM BENEFICIARY
				   WHERE STATUS = 'ACTIVE'
				   	AND SENDER_ID = '$senderID'";
		$result2 = mysqli_query($link, $query2) or die(mysqli_error($link));
		$rowsQuery = mysqli_fetch_array($result2);
	?>
	<br><br><br>
	<h3 style="text-align: center; color: #363636;">
		List of Beneficiaries
	</h3>
	<form action="removeBeneficiary.php">
		<table align="center">
			<th>ID</th>
			<th>Name</th>
			<th>Account No</th>
			<th>Date Approved</th>
			<th>Status</th>
			<?php
				while ($rows = mysqli_fetch_array($result)) {
					echo "<tr><td><input type ='radio' name='custID' value=".$rows[0];
					if($rows[0] == $rowsQuery[0]) 
						echo " checked";
					echo "  />".$rows[0]."</td>";
					echo "<td>".$rows[5]."</td>";
					echo "<td>".$rows[4]."</td>";
					echo "<td>".$rows[1]."</td>";
					echo "<td>".$rows[6]."</td>";
					echo "</tr>";
				}
			?>
		</table>
		<table align="center">
			<tr>
				<td>
					<input type="submit" name="submit" value="Remove Beneficiary" class="addEmp_button"/>
				</td>
			</tr>
		</table>
	</form>
</div>
<?php include 'bot.php';?>
</body>
</html>