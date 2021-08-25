<?php 

// Approve
    if (isset($_POST['approve'])) {
        print_r("approve");

        $item = $_POST['id'];
        $sql = "UPDATE `clearance_list` SET `approved` = '1' WHERE `clearance_list`.`id` = $item";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            header("Location:../pages/index.php?error=Successfully Aproved");
        } else {
            header("Location:../pages/index.php?error=Unabel to Approve Sorry!");
        }
    }
    // dis Approve
    if (isset($_POST['dis_approve'])) {
        print_r("dis_approve");

        $item = $_POST['id'];
        $sql = "UPDATE `clearance_list` SET `approved` = '0' WHERE `clearance_list`.`id` = $item";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            header("Location:../pages/index.php?error=Approval Successfully Chancelled");
        } else {
            header("Location:../pages/index.php?error=Unabel to Chancel Approval Sorry!");
        }
    }

    // Delete Clerances
    if (isset($_POST['delete'])) {
        print_r("delete");

        $item = $_POST['id'];
        $sql = "DELETE FROM `clearance_list` WHERE `clearance_list`.`id` = $item";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            header("Location:../pages/index.php?error=Successfully Deleted");
        } else {
            header("Location:../pages/index.php?error=Unabel To delete Item Sorry!");
        }
    }
    // Handle Detail
    $detail_1 = false;
    if (isset($_POST['view_detail_1'])) {
        $detail_1 = true;
        // print_r("view_detail_1");
        $item_v1 = $_POST['id'];
        $app = $_POST['app'];
        $it_name = $_POST['name'];
        $ful_n = $_POST['full_name'];
        $comp = $_POST['completed'];
        $desc = $_POST['desc'];
        $created = $_POST['dt'];
        // print_r($it_name);
    }

    // Add Todo
    if (isset($_POST['add_todo'])) {
        $content = $_POST['content'];
        $name = $_POST['name'];
        $uid = $_SESSION['id'];
        $off = $_SESSION['office_id'];
        $sql = "INSERT INTO `todos` (`office`, `incharge`, `content`) 
        VALUES ($off, $uid, '$content')";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            header("Location:../pages/index.php?error=Successfully Task Addeed");
        } else {
            header("Location:../pages/index.php?error=Unabel To Add Task Sorry!");
        }
    }

    // Revoke Todo
    if (isset($_POST['todo'])) {
        $state = $_POST['state'];
        $id = $_POST['id'];
        if ($state == 0) {
            $state = 1;
        } else {
            $state = 0;
        }
        $sql = "UPDATE `todos` SET `completed` = $state WHERE `todos`.`id` = $id";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            header("Location:../pages/index.php?error=Successfully Task Updated");
        } else {
            header("Location:../pages/index.php?error=Unabel To Update Task Sorry!");
        }
    }
    // Delete Todo
    if (isset($_POST['delete_todo'])) {
        $id = $_POST['id'];
        $sql = "DELETE FROM `todos` WHERE `todos`.`id` = $id";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            header("Location:../pages/index.php?error=Task Successfully Deleted");
        } else {
            header("Location:../pages/index.php?error=Unabel To Delete Task Sorry!");
        }
    }



    // Send Message
    if (isset($_POST['sendM'])) {
        $reciver = $_POST['reciver'];
        $sender = $_SESSION['id'];
        $content = $_POST['cont'];
        $sql = "INSERT INTO `message` (`to_user`, `content`, 
        `sender`) VALUES ($reciver, '$content',$sender)";
        if (mysqli_query($conn, $sql)) {
            header("Location:../pages/index.php?error=Message Successfully Sent");
        } else {
            header("Location:../pages/index.php?error=Unabel To Send Message Sorry!");
        }
    }