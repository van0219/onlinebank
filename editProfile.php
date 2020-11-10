<!DOCTYPE html>
<?php 
	include 'connection.php';
	$query = "SELECT * FROM 'ADMIN' WHERE ID = 1";
	$result = mysqli_query($link, $query) or die(mysqli_error($link));
	$rows = mysqli_fetch_array($result);
?>
<html>
<head>
	<title>Edit Profile</title>
	<link rel="stylesheet" type="text/css" href="design.css">
</head>
<body>
	<div class="wrapper">
		<div class="header"></div>
		<div class="contentsection">
			<form action="editProfile.php" method="POST"enctype="multipart/form-data">
				<table align="center" border="2" class="table">
					<tr>
						<td>Name</td>
						<td>
							<input type="text" name="name" value="<?php echo($rows[1])?>" required=""/>
						</td>
					</tr>
					<tr>
						<td>Gender</td>
						<td>
							M<input type="radio" name="gender" value="M" <?php if ($rows[2] == 'M') {
								echo "checked";?>
							}>
							F<input type="radio" name="gender" value="F" <?php if ($rows[2] == 'F') {
								echo "checked";?>
							}>
						</td>
					</tr>
					<tr>
						<td>Date of Birth</td>
						<td>
							<input type="date" name="dob" value="<?php echo($rows[3])?>">
						</td>
					</tr>
					<tr>
						<td>Nominee</td>
						<td>
							<input type="text" name="nominee" value="<?php echo($rows[4])?>" required=""/>
						</td>
					</tr>
					<tr>
						<td>Relationship</td>
						<td>
							<select name="status">
								<option <?php if ($rows[5] == "single") {
									echo "selected";?>
								}>Single</option>
								<option <?php if ($rows[5] == "Married") {
									echo "selected";?>
								}>Married</option>
								<option <?php if ($rows[5] == "Widowed") {
									echo "selected";?>
								}>Widowed</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>Designation</td>
						<td>
							<input type="text" name="designation" value="<?php echo($rows[6])?>">
						</td>
					</tr>
					<tr>
						<td>Department</td>
						<td>
							<select name="dept">
								<option <?php if ($rows[7] == "revenue") {
									echo "selected";?>
								}>Revenue</option>
								<option <?php if ($rows[7] == "developer") {
									echo "selected";?>
								}>Developer</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>Date Hired</td>
						<td>
							<input type="date" name="dateHired" value="<?php echo($rows[8]);?>" readonly>
						</td>
					</tr>
					<tr>
						<td>Upload Image</td>
						<td>
							<input type="file" name="profile">
							<br/>
						</td>
					</tr>
					<tr>
						<td>Address</td>
						<td>
							<textarea name="address"><?php echo "$rows[10]";?></textarea>
						</td>
					</tr>
					<tr>
						<td>Phone</td>
						<td>
							<input type="text" name="phone" value="<?php echo($rows[11])?>" required="">
						</td>
					</tr>
					<tr>
						<td>Mobile</td>
						<td>
							<input type="text" name="mobile" value="<?php echo($rows[12])?>" required="">
						</td>
					</tr>
					<tr>
						<td>Email</td>
						<td>
							<input type="email" name="email" value="<?php echo($rows[13])?>">
						</td>
					</tr>
					<tr>
						<td>Password</td>
						<td>
							<input type="Password" name="Password" value="<?php echo($rows[14])?>">
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<input type="submit" name="edit" value="UPDATE PROFILE"/>
						</td>
					</tr>
				</table>
			</form>
		</div>
		<div class="footer">
			
			
		</div>
	</div>
</body>
</html>