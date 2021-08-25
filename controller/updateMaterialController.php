<?php 

// update Material

if (isset($_POST['update_material'])) {
    print_r("update_clearance");
    $name = $_POST['name'];
    $quantity = $_POST['quantity'];
    $desc = $_POST['desc'];
    $id = $_POST['id'];
    print_r($id);
    if (empty($quantity) || empty($name) || empty($id) || empty($desc)) {
        header("Location:../pages/updateMaterial.php?message=Please Fill Empty Fields First Please!&id=$id");
    } else {
        $sql = "UPDATE `material` SET `name` = '$name', `available_quantity` = '$quantity', 
        `description` = '$desc' WHERE 
        `material`.`id` = $id ";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            header("Location:../pages/materials.php?message=Material Successfully Updated!");
        } else {
            header("Location:../pages/updateMaterial.php?message=Unable To Update Material!");
        }
    }
}






   
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "SELECT * FROM material where id =$id";
    $result = mysqli_query($conn,$sql);
    if($result ->num_rows >0){
        $row = mysqli_fetch_assoc($result);
        
    }
}



?>