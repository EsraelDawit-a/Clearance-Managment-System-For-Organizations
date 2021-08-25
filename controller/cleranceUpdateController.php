<?php 

    
// update Clearance

if (isset($_POST['Update_clearance'])) {
    print_r("update_clearance");
    $in_charge = $_POST['in_charge'];
    $name = $_POST['name'];
    $office = $_POST['office'];
    $material = $_POST['material'];
    $owener = $_POST['owener'];
    $desc = $_POST['desc'];
    $id = $_POST['id'];
    print_r($id);
    if (empty($in_charge) || empty($name) || empty($office) || empty($material) || empty($owener) || empty($desc)) {
        header("Location:../pages/updateClearance.php?error=Please Fill Empty Fields First Please!");
    } else {
        $sql = "UPDATE `clearance_list` SET `name` = '$name', `description` = '$desc', 
        `clearance_owner` = $owener, `in_charge` = $in_charge, `material` = $material  WHERE `clearance_list`.`id` = $id ";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            header("Location:../pages/index.php?success=New Clearance Successfully Updated!");
        } else {
            header("Location:../pages/updateClearance.php?error=Unable To Update Clearance!");
        }
    }
}






   
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "SELECT * FROM clearance_list where id =$id";
    $result = mysqli_query($conn,$sql);
    if($result ->num_rows >0){
        $ray = mysqli_fetch_assoc($result);
        
    }
}



?>