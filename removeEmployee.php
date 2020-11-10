<?php
	session_start();

	if(!isset($_SESSION['adminLogin']))
		header('location:admin_login.php');
?>
<?php
	include 'connection.php';
	$query = "SELECT * FROM PERSONNEL
			  WHERE STATUS = 'ACTIVE'";
	$result = mysqli_query($link, $query) or die(mysqli_error($link));
	$query2 = "SELECT MIN(ID) FROM PERSONNEL
			   WHERE STATUS = 'ACTIVE'";
	$result2 = mysqli_query($link, $query2);
	$rowsQuery = mysqli_fetch_array($result2);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Remove Staff</title>
	<style>
		.showEmployeeData table, th, td{
			padding: 6px;
			border: 1px solid #363636;
			border-collapse: collapse;
		}
		#button{
			border: none;
		}
	</style>
	<link rel="stylesheet" type="text/css" href="design.css">
</head>
<?php include 'topBar.php' ?>
<div>
	<div class="data_newAcc">
		<?php include 'admin_nav.php' ?>
		<form action="editEmployee.php" method="POST">
			<table align="center">
				<caption align="center" style="color: #363636"><h3>Personnel Details</h3></caption>
				<th>ID</th>
				<th>Name</th>
				<th>Gender</th>
				<th>DOB</th>
				<th>Civil Status</th>
				<th>Branch</th>
				<th>Date Hired</th>
				<th>Address</th>
				<th>Mobile</th>
				<th>Email</th>
				<?php
					while ( $rows = mysqli_fetch_array($result)) {
						echo "<tr><td><input type='radio' name='empID' value=".$rows[0];
						if($rows[0] == $rowsQuery[0]){
							echo " checked";
						}
						echo "  />".$rows[0]."</td>";
						echo "<td>".$rows[1].' '.$rows[2].' '.$rows[3]."</td>";
						echo "<td>".$rows[4]."</td>";
						echo "<td>".$rows[5]."</td>";
						echo "<td>".$rows[6]."</td>";
						echo "<td>".$rows[7]."</td>";
						echo "<td>".$rows[8]."</td>";
						echo "<td>".$rows[9]."</td>";
						echo "<td>".$rows[10]."</td>";
						echo "<td>".$rows[11]."</td>";
						echo "</tr>";
					} 
				?>
			</table>
			<table align="center" id="button">
				<tr>
					<td>
						<input type="submit" name="submit2_ID" value="Deactivate Personnel" class="addEmp_button">
					</td>
				</tr>
			</table>
		</form>
	</div>
</div>
<?php include 'bot.php'; ?>
</body>
</html>