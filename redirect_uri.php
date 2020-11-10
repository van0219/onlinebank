<!-- This is the page where subscription to my application takes place. -->
<!-- I use Globe SMS APi for mobile number registration and OTP. -->
<?php 
    session_start();
            
    if(!isset($_SESSION['adminLogin'])){
        header('location:admin_login.php');
    }  
    include 'connection.php';
    include 'GLobe\Connect\Oauth.php';
    use Globe\Connect\Oauth;       
?>
<!--#####-->
<?php
    if ($_SESSION['emp']) {
        $fname = $_SESSION['fname_'];
        $mname = $_SESSION['mname_'];
        $lname = $_SESSION['lname_'];
        $gender = $_SESSION['gender_'];
        $dob = $_SESSION['dob_'];
        $status = $_SESSION['status_'];
        $branch = $_SESSION['branch_'];
        $dateHired = $_SESSION['dateHired_'];
        $address = $_SESSION['address_'];
        $mobile = $_SESSION['mobile_'];
        $email = $_SESSION['email_'];
        $password = $_SESSION['password_'];
        #####
        $url = $_SERVER['REQUEST_URI'];//returns almost full url
        $code = substr($url, 34);//get the code part only from the address bar
        #####
        $query = "SELECT APP_ID 
                        ,APP_SECRET
                  FROM APP_CREDENTIALS
                  WHERE ID = 1";
        $queryResult = mysqli_query($link, $query) or die(mysqli_error());
        $rows = mysqli_fetch_array($queryResult);
        #####
        $oauth = new Oauth("$rows[0]", "$rows[1]");

        // get redirect url
        $oauth->getRedirectUrl();

        // redirect to dialog and process the code then ...

        // get access token
        $oauth->setCode("$code");
        $response = $oauth->getAccessToken();
        $removeQuotes = str_replace('"', '', $response);
        $segregate = explode(',',$removeQuotes);//converts the string into array for every comma found.
        $access_token = substr($segregate[0], 14);//the access_token starts at 14th position
        $subscriberNum = substr($segregate[1], 18, 10);//mobile number starts at 18th position, with 10 characters
        // echo "$access_token  , $subscriberNum";
        if (!is_null($access_token) && !is_null($subscriberNum)) {
            //We will insert in 2 tables, personnel and subscriber_info
            $queryInsert = "INSERT INTO PERSONNEL
                                 VALUES(''
                                       ,UPPER('$fname')
                                       ,UPPER('$mname')
                                       ,UPPER('$lname')
                                       ,'$gender'
                                       ,'$dob'
                                       ,'$status'
                                       ,'$branch'
                                       ,'$dateHired'
                                       ,UPPER('$address')
                                       ,'$subscriberNum'
                                       ,LOWER('$email')
                                       ,'$password'            
                                       ,''
                                       ,'ACTIVE')";
            mysqli_query($link, $queryInsert) or die(mysqli_error($link));
            ####
            $queryEmpID = "SELECT ID 
                                 ,CONCAT(FNAME,' ',MNAME,' ',LNAME) AS FULLNAME
                           FROM PERSONNEL
                           WHERE ID = (SELECT MAX(ID) FROM PERSONNEL)";
            $queryEmpIDResult = mysqli_query($link, $queryEmpID) or die(mysqli_error($link));
            $queryEmpIDRows = mysqli_fetch_array($queryEmpIDResult);
            $queryInsert2 = "INSERT INTO SUBSCRIBER_INFO
                                  VALUES(''
                                        ,'$queryEmpIDRows[0]'
                                        ,NULL
                                        ,'$queryEmpIDRows[1]'
                                        ,'$access_token'
                                        ,'$subscriberNum')";
            mysqli_query($link, $queryInsert2) or die(mysqli_error($link));
            echo "<script>alert('Personnel was added successfully!');";
            echo "window.location = 'homePageAdmin.php';</script>";
        }
        $_SESSION['emp'] = 0;
    }
?>
<?php
    if ($_SESSION['acc']) {
        $fname = $_SESSION['fname_'];
        $mname = $_SESSION['mname_'];
        $lname = $_SESSION['lname_'];
        $gender = $_SESSION['gender_'];
        $dob = $_SESSION['dob_'];
        $type = $_SESSION['type_'] ;
        $credit = $_SESSION['credit_'];
        $address = $_SESSION['address_'];
        $mobile = $_SESSION['mobile_'];
        $email = $_SESSION['email_'];
        $password = $_SESSION['password_'];
        $salt = "5%GHD7**0HGDs325kX";
        $password = MD5(sha1($password.$salt));
        #####
        $branch = $_SESSION['branch_'];
        #####
        $datequery = "SELECT CURRENT_TIMESTAMP";
        $dateRes = mysqli_query($link, $datequery) or die(mysqli_error($link));
        $dateFetch = mysqli_fetch_array($dateRes);
        $date = $dateFetch[0];
        switch ($branch) {
            case 'Quezon City':
                $branchCode = "1121";
                break;
            case 'Makati City':
                $branchCode = "1630";
                break;
            case 'Manila City':
                $branchCode = "1004";
            default:
                # code...
                break;
        }
        #####
        $url = $_SERVER['REQUEST_URI'];//returns almost full url
        $code = substr($url, 34);//get the code part only from the address bar
        // #####
        $query = "SELECT APP_ID 
                        ,APP_SECRET
                  FROM APP_CREDENTIALS
                  WHERE ID = 1";
        $queryResult = mysqli_query($link, $query) or die(mysqli_error());
        $rows = mysqli_fetch_array($queryResult);
        #####
        $oauth = new Oauth("$rows[0]", "$rows[1]");

        // get redirect url
        $oauth->getRedirectUrl();

        // redirect to dialog and process the code then ...

        // get access token
        $oauth->setCode("$code");
        $response = $oauth->getAccessToken();
        $removeQuotes = str_replace('"', '', $response);
        $segregate = explode(',',$removeQuotes);//converts the string into array for every comma found.
        $access_token = substr($segregate[0], 14);//the access_token starts at 14th position
        $subscriberNum = substr($segregate[1], 18, 10);//starts at 18th position, with 10 characters
        // echo "$access_token  , $subscriberNum";
        if (!is_null($access_token) && !is_null($subscriberNum)) {
            $query = "SHOW TABLE STATUS LIKE 'ACCOUNTS'";         
            $result = mysqli_query($link, $query) or die(mysqli_error($link));
            $rows = mysqli_fetch_array($result);
            $id = $rows[10];//gets the current value of auto_increment
            #####
            $query2 = "CREATE TABLE PASSBOOK".$id."
                                   (ID INT(10) UNSIGNED NOT NULL AUTO_INCREMENT
                                   ,TRANSDATE DATETIME
                                   ,FNAME VARCHAR(50)
                                   ,MNAME VARCHAR(50)
                                   ,LNAME VARCHAR(50)
                                   ,BRANCH VARCHAR(100)
                                   ,BRANCH_CODE VARCHAR(50)
                                   ,CREDIT DOUBLE(22,4)
                                   ,DEBIT DOUBLE(22,4)
                                   ,AMOUNT NUMERIC(10,2)
                                   ,DESCRIPTION VARCHAR(250)
                                   ,STATUS VARCHAR(20)
                                   ,PRIMARY KEY(`ID`))";
            #####
            $query3 = "INSERT INTO ACCOUNTS
                       VALUES(''
                             ,UPPER('$fname')
                             ,UPPER('$mname')
                             ,UPPER('$lname')
                             ,'$gender'
                             ,'$dob'
                             ,'$type'
                             ,UPPER('$address')
                             ,'$subscriberNum'
                             ,LOWER('$email')
                             ,'$password'
                             ,UPPER('$branch')
                             ,'$branchCode'
                             ,'$date'
                             ,'ACTIVE')";
            mysqli_query($link, $query2) or die(mysqli_error($link));
            mysqli_query($link, $query3) or die(mysqli_error($link));
            $query4 = "INSERT INTO PASSBOOK".$id."
                       VALUES(''
                             ,NOW()
                             ,UPPER('$fname')
                             ,UPPER('$mname')
                             ,UPPER('$lname')
                             ,UPPER('$branch')
                             ,'$branchCode'
                             ,'$credit'
                             ,'0'
                             ,'$credit'
                             ,'Open Account'
                             ,'ACTIVE')";
            mysqli_query($link, $query4) or die(mysqli_error($link));
            $queryAccID = "SELECT ID 
                                 ,CONCAT(FNAME,' ',MNAME,' ',LNAME) AS FULLNAME
                           FROM ACCOUNTS
                           WHERE ID = (SELECT MAX(ID) FROM ACCOUNTS)";
            $queryAccIDResult = mysqli_query($link, $queryAccID) or die(mysqli_error($link));
            $queryAccIDRows = mysqli_fetch_array($queryAccIDResult);
            $queryInsert2 = "INSERT INTO SUBSCRIBER_INFO
                                  VALUES(''
                                        ,NULL
                                        ,'$queryAccIDRows[0]'
                                        ,'$queryAccIDRows[1]'
                                        ,'$access_token'
                                        ,'$subscriberNum')";
            mysqli_query($link, $queryInsert2) or die(mysqli_error($link));
            echo "<script>alert('Account was added successfully!');";
            echo "window.location = 'homePageAdmin.php';</script>"; 
            $_SESSION['acc'] = 0;
        }
    }     
?>