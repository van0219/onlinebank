<?php 
	session_start();
	if (!isset($_SESSION['emp_login'])) {
		header('location:empLogin.php');
	}
?>
<?php
	if (isset($_REQUEST['submit'])) {
		$id = $_REQUEST['benID'];
		#####
		if ($id >= 1) {
			include 'connection.php';
			$query = "UPDATE BENEFICIARY
				  	  SET STATUS = 'ACTIVE'
				  	  WHERE ID = '$id'";
			mysqli_query($link, $query) or die(mysqli_error($link));
			echo "<script>alert('Beneficiary Activated!');</script>";
			echo "window.location='empBeneficiary.php';</script>";
		}
		else{
			header('location:empBeneficiary.php');
		}
	}
?>