<?php
	session_start();
	if (!isset($_SESSION['empLogin'])) {
		header('location:empLogin.php');
	}
?>
<!--#####-->
<?php 
	if (isset($_REQUEST['submit'])) {
		include 'connection.php';
		$id = $_REQUEST['custID'];
		#####
		if ($id >= 1) {
			$query = "SELECT * FROM CHECKBOOK
		    	  	  WHERE ID = '$id'";
			$result = mysqli_query($link, $query) or die(mysqli_error($link));
			$rows = mysqli_fetch_array($result);
			if ($rows[3] == 'PENDING') {
				$query2 = "UPDATE CHECKBOOK
						   SET STATUS = 'ISSUED'
						   	  ,DATE_ISSUED = NOW()
						   WHERE ID = '$id'";
				mysqli_query($link, $query2) or die(mysqli_error($link));	
				echo "<script>alert('Successfully Issued Cheque Book!');";
				echo "window.location = 'empApproveCheque.php';</script>";
			}
		}
		else{
			header('location:empApproveCheque.php');
		}	   
	}