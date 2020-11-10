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
		$id = $_REQUEST['custID'] != null ? $_REQUEST['custID'] : 0;
		#####
		if ($id >= 1) {
			$query = "SELECT STATUS 
				  	  FROM ATM
				  	  WHERE ID = '$id'";
			$result = mysqli_query($link, $query) or die(mysqli_error($link));
			$rows = mysqli_fetch_array($result);
			#####
			if ($rows[0] == 'PENDING') {
				$query2 = "UPDATE ATM
					   	   SET STATUS = 'ISSUED'
					   	  	  ,DATE_ISSUED = NOW()
					  	   WHERE ID = '$id'";
			#####
			mysqli_query($link, $query2) or die(mysqli_error($link));
			echo "<script>alert('Successfully issued ATM!');";
			echo "window.location = 'empApproveATM.php';</script>";
			}
		}
		else{
			header('location:empApproveATM.php');
		}
	}