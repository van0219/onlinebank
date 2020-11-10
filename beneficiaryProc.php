<?php
	session_start();
	if (!isset($_SESSION['accountLogin'])) {
		header('location:main.php');
	}
?>
<?php
	$senderID = $_SESSION['login_id'];
	$senderName = $_SESSION['name'];
	#####
	$payeeFullname = $_REQUEST['fname'].' '.$_REQUEST['mname'].' '.$_REQUEST['lname'];
	$payeeMname = $_REQUEST['mname'];
	$payeeLname = $_REQUEST['lname'];
	$accNum = $_REQUEST['accNum'];
	$branch = $_REQUEST['branch_select'];
	$branchCode = $_REQUEST['branchCode'];
	#####
	include 'connection.php';
	$query = "SELECT SENDER_ID
					,RECEIVER_ID 
			  FROM BENEFICIARY 
			  WHERE SENDER_ID ='$senderID' AND RECEIVER_ID ='$accNum'";
	$result = mysqli_query($link, $query) or die(mysqli_error($link));
	$rows = mysqli_fetch_array($result);
	$sID = $rows[0];
	$rID = $rows[1];
	#####
	$query2 = "SELECT ID
					 ,FNAME
					 ,MNAME
					 ,LNAME
					 ,BRANCH 
					 ,BRANCH_CODE
					 ,STATUS
			   FROM ACCOUNTS
			   WHERE ID = '$accNum'";
	$result2 = mysqli_query($link, $query2) or die(mysqli_error($link));
	$rows2 = mysqli_fetch_array($result2);
	$beneficiaryFullname = $rows2[1].' '.$rows2[2].' '.$rows2[3];//benificiaries are account holders too.
	if ($senderID == $rows2[0]) {
		echo "<script>alert('Invalid Action!');";//You cannot add yourself as a beneficiary
		echo "window.location = 'addBeneficiary.php';</script>";
	}
	elseif ($sID == $senderID && $rID == $accNum) {
		echo "<script>alert('Already a beneficiary!');";
		echo "window.location='addBeneficiary.php';</script>";
	}
	elseif ($beneficiaryFullname != $payeeFullname && $rows2[0] != $accNum && $rows2[4] != $branch && $rows2[5] != $branchCode) {
		echo "<script>alert('Benificiary not found!\nPlease check the details.');";
		echo "window.location='addBeneficiary.php';</script>";
	}
	else{
		if ($rows2[6] == 'ACTIVE') {
			$query3 = "INSERT INTO BENEFICIARY 
				   	   VALUES(''
				   	   		 ,NOW()
				   		 	 ,'$senderID'
				   		 	 ,UPPER('$senderName')
				   		 	 ,UPPER('$accNum')
				   		 	 ,UPPER('$payeeFullname')
				   		 	 ,'PENDING')";
			mysqli_query($link, $query3) or die(mysqli_error($link));
			header('location:showBeneficiary.php');
		}
		else{
			echo "<script>alert('The account is no longer active.');";
			echo "window.location = 'addBeneficiary.php';</script>";
		}
	}
?>