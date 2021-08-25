<?php 



    $detail_1 = false;
    if (isset($_POST['view_detail_1'])) {
        $detail_1 = true;
        // print_r("view_detail_1");
        $item_v1 = $_POST['id'];
        $it_name = $_POST['name'];
        $ful_n = $_POST['quantity'];
        $desc = $_POST['desc'];
        $created = $_POST['dt'];
        // print_r($it_name);
    }

    

 // Delete Material
 if (isset($_POST['delete_m'])) {
    $id = $_POST['id'];
    $sql = "DELETE FROM `material` WHERE `id` = $id";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        header("Location:../pages/materials.php?error=Material  Successfully Deleted");
    } else {
        header("Location:../pages/materials.php?error=Unabel To Delete material Sorry!");
    }
}
?>