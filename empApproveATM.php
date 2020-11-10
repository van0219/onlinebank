<?php 
	session_start();
	if (!isset($_SESSION['empLogin'])) {
		header('location:empLogin.php');
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>ATM | Requests</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="design.css">
	<style>
		.showEmployeeData table, th, td{
			padding: 6px;
			border: 1px solid #363636;
			border-collapse: collapse;
			text-align: center;
		}
	</style>
</head>
<?php include 'topBar.php' ?>
<div class="data_newAcc">
	<?php include 'emp_nav.php' ?>
	<h3 style="text-align: center; color: #363636;">
		<b>ATM Requests for Approval</b>
	</h3>
	<?php
		include 'connection.php';
		$query = "SELECT * FROM ATM
				  WHERE STATUS = 'PENDING'";
		$result = mysqli_query($link, $query) or die(mysqli_error($link));
	?>
	<form action="empApproveATMproc.php" method="POST">
		<table align="center">
			<th>ID</th>
			<th>Name</th>
			<th>Account No.</th>
			<th>ATM Card Status</th>
			<?php
				while ($rows = mysqli_fetch_array($result)) {
					echo "<tr><td><input type ='radio' name='custID' value=".$rows[0];
					echo " checked";
					echo "  />".$rows[0]."</td>";
					echo "<td>".$rows[1]."</td>";
					echo "<td>".$rows[2]."</td>";
					echo "<td>".$rows[3]."</td>";
					echo "</tr>";
				}
			?>
		</table>
		<table align="center">
			<tr>
				<td>
					<input type="submit" name="submit" value="Approve" class="addEmp_button"/>
				</td>
			</tr>
		</table>
	</form>
</div>
<?php include 'bot.php' ?>
</body>
</html>