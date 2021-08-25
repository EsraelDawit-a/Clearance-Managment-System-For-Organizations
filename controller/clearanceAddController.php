<?php 

if (isset($_POST['add_clearance'])) {
    print_r("add_clearance");
    $in_charge = $_POST['in_charge'];
    $name = $_POST['name'];
    $office = $_POST['office'];
    $material = $_POST['material'];
    $owener = $_POST['owener'];
    $desc = $_POST['desc'];
    // print_r($desc);
    if (empty($in_charge) || empty($name) || empty($office) || empty($material) || empty($owener) || empty($desc)) {
        header("Location:../pages/addClerance.php?message=Please Fill Empty Fields First Please!");
    } else {
        $sql = "INSERT INTO `clearance_list` ( `name`, `description`,
    `clearance_owner`, `in_charge`, `office`, `material`) 
   VALUES ('$name', '$desc', $owener, $in_charge, $office, $material)";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            header("Location:../pages/addClerance.php?message=New Clearance Successfully Added!");
        } else {
            header("Location:../pages/addClerance.php?message=Unable To Create New Clearance!");
        }
    }
}
// Add Material
if (isset($_POST['add_material'])) {
    print_r("add_clearance");
    $in_charge = $_POST['in_charge'];
    $name = $_POST['name'];
    $office = $_POST['office'];
    // $material = $_POST['material'];
    $quantity = $_POST['quantity'];
    // $owener = $_POST['owener'];
    $desc = $_POST['desc'];
    // print_r($desc);
    if (empty($name) || empty($office)  || empty($desc) || empty($quantity)) {
        header("Location:../pages/addClerance.php?message=Please Fill Empty Fields First Please!");
    } else {
        print_r($in_charge);
        $sql = "INSERT INTO `material` ( `name`, 
        `in_charge`, `available_quantity`, `description`) 
        VALUES ('$name',$office,$quantity, '$desc')";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            header("Location:../pages/addClerance.php?message=New Material Successfully Added!");
        } else {
            header("Location:../pages/addClerance.php?message=Unable To Create New Material!");
            // print_r(mysqli_error($conn));
        }
    }
}
// Add Users
if (isset($_POST['add_user'])) {
     $name = $_POST['full_name'];
     $phone = $_POST['phone'];
     $password1 = $_POST['password1'];
     $password2 = $_POST['password2'];
     $user_type = $_POST['user_type'];
     $office = $_POST['office'];
     $role = $_POST['role'];

    if (empty($name) || empty($office)  || empty($phone) || empty($role) || empty($user_type) || empty($password1) || empty($password2)) {
        header("Location:../pages/addClerance.php?error=Please Fill Empty Fields First Please!");
    }else{
    

   if($password1 !=$password2){
    header("Location:../pages/addClerance.php?message=The two Password Fields DontMatch  Please Try Again!");

   }else{
    $password1 = password_hash($password1,PASSWORD_DEFAULT);
    $sql = "INSERT INTO `users` (`full_name`, `role`, 
    `phone`, `password`, `office`, `user_type`) 
    VALUES ('$name', $role, '$phone', '$password1', $office, '$user_type')";

    $result = mysqli_query($conn,$sql);
    if ($result) {
        header("Location:../pages/addClerance.php?message=New User Successfully Added!");
    } else {
        header("Location:../pages/addClerance.php?message=Unable To Create New User!");
        // print_r(mysqli_error($conn));
    }
   }

}
}

// Add Work_Place

if (isset($_POST['add_work_place'])) {
    print_r("add_work_place");
    $building = $_POST['building'];
    $office = $_POST['office'];
    $desc = $_POST['desc'];
    // print_r($desc);
    if (empty($building) || empty($office)  || empty($desc)) {
        header("Location:../pages/addClerance.php?message=Please Fill Empty Fields First Please!");
    } else {
        print_r($in_charge);
        $sql = "INSERT INTO `work_place` (`block_no`, `office_no`, `work_desc`) 
        VALUES ($building, $office, '$desc')";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            header("Location:../pages/addClerance.php?message=New WorkPlace Successfully Added!");
        } else {
            header("Location:../pages/addClerance.php?message=Unable To Create New WorkPlace!");
            // print_r(mysqli_error($conn));
        }
    }
}

// Add Role
if (isset($_POST['add_role'])) {
    print_r("add_role");
    $building = $_POST['building'];
    $role_name = $_POST['name'];
    
    // print_r($desc);
    if (empty($building) || empty($role_name)) {
        header("Location:../pages/addClerance.php?message=Please Fill Empty Fields First Please!");
    } else {
        print_r($in_charge);
        $sql = "INSERT INTO `role` (`user_type`, `work_place`) VALUES ('$role_name',$building) ";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            header("Location:../pages/addClerance.php?message=New Role Successfully Added!");
        } else {
            header("Location:../pages/addClerance.php?message=Unable To Create New Role!");
            // print_r(mysqli_error($conn));
        }
    }
}

// Add Office
if (isset($_POST['add_office'])) {
    print_r("add_office");
    $desc = $_POST['desc'];
    $name = $_POST['name'];
    
    // print_r($desc);
    if (empty($desc) || empty($name)) {
        header("Location:../pages/addClerance.php?message=Please Fill Empty Fields First Please!");
    } else {
        print_r($in_charge);
        $sql = "INSERT INTO `office` (`name`, `description`) VALUES ('$name', '$desc'); ";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            header("Location:../pages/addClerance.php?message=New Office Successfully Added!");
        } else {
            header("Location:../pages/addClerance.php?message=Unable To Create New Office!");
            // print_r(mysqli_error($conn));
        }
    }
}


?>