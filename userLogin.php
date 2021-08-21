<?php

include "./db.inc.php";
session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST'){



    
   $username = validate($_POST['username']);
   $password = validate($_POST['password']);

   $sql = "SELECT * FROM `users` WHERE `full_name` = '$username' and `password` = '$password'";
   $result = mysqli_query($conn,$sql);
   if($result){
     echo "User Found";
    $row = mysqli_fetch_assoc($result);
    $_SESSION['userName'] = $row['full_name'];
    $_SESSION['id'] = $row['id'];
    $_SESSION['role'] = $row['role'];
    $_SESSION['office'] = $row['office'];

    echo $_SESSION['role'];
      


   }
   else{
       echo "No User Found";
   }

}

else{
    echo 'error'. mysqli_error($conn);
}

?>
