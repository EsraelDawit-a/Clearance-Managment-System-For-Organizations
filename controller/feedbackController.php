<?php 

 // Send FeedBack
 if (isset($_POST['send'])) {
    print_r("add_office");
    $desc = $_POST['mess'];
    $office= $_POST['office'];
    $us = $_SESSION['id'];

    // print_r($desc);
    if (empty($desc) || empty($office)) {
        header("Location:../pages/sendFeedback.php?message=Please Fill Empty Fields First Please!");
    } else {
        print_r($in_charge);
        $sql = "INSERT INTO `feedbacks` (`to_office`, `from_user`, `content`) 
        VALUES ($office, $us, '$desc')";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            header("Location:../pages/sendFeedback.php?message=New Feddeback Successfully Sent!");
        } else {
            header("Location:../pages/sendFeedback.php?message=Unable To Send Feedback!");
            // print_r(mysqli_error($conn));
        }
    }
}

?>