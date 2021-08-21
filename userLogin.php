<?php

include "./db.inc.php";
session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST'){



    
   $username = validate($_POST['username']);
   $password = validate($_POST['password']);

   $sql = "SELECT * FROM `users` WHERE `full_name` = '$username' and `password` = '$password'";
   $result = mysqli_query($conn,$sql);
   print_r($result->num_rows);
   if($result->num_rows >0){
    //  echo "User Found";
    $row = mysqli_fetch_assoc($result);
    $_SESSION['userName'] = $row['full_name'];
    $_SESSION['id'] = $row['id'];
    $_SESSION['role'] = $row['role'];
    $_SESSION['office'] = $row['office'];
    $_SESSION['office_id'] = $row['office'];
    $role_id = $row['role'];
    $office = $row['office'];
    
    // echo $_SESSION['role'];

    $sql2 = "SELECT * FROM `role` WHERE `id` = $role_id ";
    $sql3 = "SELECT * FROM `office` WHERE `id` = $office ";
    $result2 = mysqli_query($conn,$sql2);
    $result3 = mysqli_query($conn,$sql3);
    if($result2->num_rows >0 && $result3->num_rows >0)
    {
    $role = mysqli_fetch_assoc($result2);
    $off = mysqli_fetch_assoc($result3);
    // echo $role['user_type'];
    $_SESSION['user_role'] = $role['user_type'];
    $_SESSION['work_place'] = $role['work_place'];
    $_SESSION['office'] = $off['name'];
    
    // echo $role['user_type'];
    // print_r($off);
    header("Location:./pages/index.php");
      
    }else{
        echo "unabel to find role";
    }
    


   }
   else{
    header("Location:./login.php?error=Inncorrect User Or Password!");   
    echo "No User Found";

   }

}

else{
    echo 'error'. mysqli_error($conn);
}

?>
