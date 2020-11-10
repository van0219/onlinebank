<?php
	session_start();

	if (!isset($_SESSION['adminLogin'])) {
		header('location:admin_login.php');
}
?>
<?php
	include 'connection.php';
	$query = "SELECT * FROM ACCOUNTS
			  WHERE STATUS = 'ACTIVE'";
	$result = mysqli_query($link, $query) or die(mysqli_error($link));
	$query2 = "SELECT MIN(ID) FROM ACCOUNTS
			   WHERE STATUS = 'ACTIVE'";
	$result2 = mysqli_query($link, $query2);
	$rowsQuery = mysqli_fetch_array($result2);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Remove Account</title>
	<link rel="stylesheet" type="text/css" href="design.css">
	<style>
		.showEmployeeData table, th, td{
			padding: 6px;
			border: 1px solid #363636;
			border-collapse: collapse;
		}
	</style>
</head>
<?php include 'topBar.php'?>
<div class="data_newAcc">
	<?php include 'admin_nav.php'?>
	<form action="editAccount.php" method="POST">
		<table align="center">
			<caption align="center" style="color: #363636"><h3>Account Details</h3></caption>
			<th>ID</th>
			<th>Name</th>
			<th>Gender</th>
			<th>DOB</th>
			<th>Account Type</th>
			<th>Address</th>
			<th>Mobile</th>
			<th>Email</th>
			<?php
				while ($rows = mysqli_fetch_array($result)) {
					echo "<tr><td><input type = 'radio' name= 'accountID' value=".$rows[0];
					if($rows[0] == $rowsQuery[0]){
						echo " checked";
					}
					echo "  />".$rows[0]."</td>";
					echo "<td>".$rows[1]." ".$rows[2]." ".$rows[3]."</td>";
					echo "<td>".$rows[4]."</td>";
					echo "<td>".$rows[5]."</td>";
					echo "<td>".$rows[6]."</td>";
					echo "<td>".$rows[7]."</td>";
					echo "<td>".$rows[8]."</td>";
					echo "<td>".$rows[9]."</td>";
					echo "</tr>";
				} 
			?>
		</table>
		<table align="center">
			<tr>
				<td>
					<input type="submit" name="submitDel" value="Deactivate Account" class="addEmp_button">
				</td>
			</tr>
		</table>
	</form>
</div>
<?php include 'bot.php' ?>
</body>
</html>