<?php 

$detail_1 = false;
if (isset($_POST['view_detail_1'])) {
    $detail_1 = true;
    // print_r("view_detail_1");
    $item_v1 = $_POST['idn'];
    $app = $_POST['app'];
    $it_name = $_POST['name'];
    $ful_n = $_POST['full_name'];
    $comp = $_POST['completed'];
    $desc = $_POST['desc'];
    $created = $_POST['dt'];
    // print_r($it_name);
}

// Revoke Completion 
if (isset($_POST['done'])) {
    $state = $_POST['completed'];
    $idn = $_POST['idn'];
    // print_r($idn);
    print_r($state);
    if($state == 0){$state =1;}else{$state = 0;}
    print_r($state);

    $sql = "UPDATE `clearance_list` SET completed = $state WHERE id = $idn ";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        header("Location:../pages/clearanceList.php?error=Clearance Successfully Completed");
    } else {
        header("Location:../pages/clearanceList.php?error=Unabel To Complete Clearance Sorry!");

    }
}


?>