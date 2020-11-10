<?php 
	session_start();
	if (!isset($_SESSION['accountLogin'])) {
		header('location:main.php');
	}
?>
<!--#####-->
<?php
	include 'connection.php';
	$id=  mysqli_real_escape_string($link, $_REQUEST['custID']);
	if (isset($_REQUEST['submit'])) {
		if ($id >= 1) {
			$custID = $_REQUEST['custID'];
			$query = "UPDATE BENEFICIARY 
					  SET STATUS = 'INACTIVE'
					  WHERE ID = '$custID'";
			$result = mysqli_query($link, $query) or die(mysqli_error($link));
			echo "<script>alert('Successfully removed beneficiary!');";
			echo "window.location = 'showBeneficiary.php';</script>";
		}
        else{
            header('location:showBeneficiary.php');
        }
	}
?>