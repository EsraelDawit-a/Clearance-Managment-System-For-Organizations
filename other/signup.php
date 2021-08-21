<?php 
// session_start(); 
include "db.inc.php";

if (isset($_POST['fullname']) && isset($_POST['password'])
    && isset($_POST['password_confirm']) && isset($_POST['role'])  && isset($_POST['email'])) {

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	$uname = validate($_POST['fullname']);
	$pass = validate($_POST['password']);

	$re_pass = validate($_POST['password_confirm']);
	$role = validate($_POST['role']);
    $vertified = false;
    $email = validate(($_POST['email']));
	$user_data = 'fullname='. $uname. '&role='. $role;


	if (empty($uname)) {
		header("Location: ./mainPage.php?error=User Name is required&$user_data");
	    exit();
	}else if(empty($pass)){
        header("Location: ./mainPage.php?error=Password is required&$user_data");
	    exit();
	}
	else if(empty($re_pass)){
        header("Location: ./mainPage.php?error=Re Password is required&$user_data");
	    exit();
	}

	else if(empty($name)){
        header("Location: ./mainPage.php?error=Name is required&$user_data");
	    exit();
	}

	else if(empty($email)){
        header("Location: ./mainPage.php?error=Email is required&$user_data");
	    exit();
	}

	else if($pass !== $re_pass){
        header("Location: ./mainPage.php?error=The confirmation password  does not match&$user_data");
	    exit();
	}
    
    else if(empty($role)){
        header("Location: ./mainPage.php?error=role is required&$user_data");
	    exit();
	}

	else{

		// hashing the password
        // $pass = md5($pass);
        $pass = $pass;

	    $sql = "SELECT * FROM users WHERE fullname='$uname' ";
		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) > 0) {
			header("Location: ./mainPage.php?error=The username is taken try another&$user_data");
	        exit();
		}else {
           $sql2 = "INSERT INTO users(fullname, password, role,is_vertified,email,phone) VALUES('$uname', '$pass', '$role','$vertified','$email','+251')";
           $result2 = mysqli_query($conn, $sql2);
           if ($result2) {
           	 header("Location: ./mainPage.php?success=Your account has been created successfully");
	         exit();
           }else {
	           	header("Location: ./mainPage.php?error=unknown error occurred&$user_data");
		        exit();
           }
		}
	}
	
}
  