<?php

include "../db.inc.php";

session_start();

if (!isset($_SESSION['id'])) {
    header("Location:../login.php?error=Login Here First!");
} else {

   include "../controller/indexController.php";
?>

    <!DOCTYPE html>
    <html >

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Clearance Managment System Dashboard</title>
        <!-- BOOTSTRAP STYLES-->
        <link href="../css/bootstrap.css" rel="stylesheet" />
        <!-- FONTAWESOME STYLES-->
        <link href="../css/font-awesome.css" rel="stylesheet" />
        <!-- MORRIS CHART STYLES-->
        <link href="../js/morris/morris-0.4.3.min.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
        <link href="../css/custom.css" rel="stylesheet" />
        <!-- GOOGLE FONTS-->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
        <style>
            .message {
                width: 100%;
                height: 70px;
                color: #fff;
                font-family: monospace;
                background-color: rgb(55, 167, 111);
            }

            .message h5 {
                padding: 10px 25vw;
                font-size: 130px !important;
                font-weight: 700;
            }

            #page-inner {
                min-height: 50px !important;
            }
        </style>
    </head>

    <body>
        <div id="wrapper">
            <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.html">You are <?php echo $_SESSION['user_role'] ?></a>
                </div>
                <div style="color: white;
padding: 15px 50px 5px 50px;
float: right;
font-size: 16px;">
                    <a style="margin-right: 25px;"><?php echo $_SESSION['office'] . '   '  ?> </a> <a href="./logout.php" class="btn btn-danger square-btn-adjust">Logout</a>
                </div>
            </nav>
            <!-- /. NAV TOP  -->
            <nav class="navbar-default navbar-side" role="navigation">
                <div class="sidebar-collapse">
                    <ul class="nav" id="main-menu">
                        <li class="text-center">
                            <img src="../img/find_user.png" class="user-image img-responsive" />
                        </li>


                        <li>
                            <a class="active-menu" href="./index.php"><i class="fa fa-dashboard fa-3x"></i>Home</a>
                        </li>
                        <!-- Admins Only -->
                        <?php if($_SESSION['role'] ==3 || $_SESSION['role'] == 2) {?>

                        <li>
                            <a href="./addClerance.php"><i class="fa fa-desktop fa-3x"></i>Add Clearances</a>
                        </li>
                        <li>
                            <a href="./index.php"><i class="fa fa-bar-chart-o fa-3x"></i> View Clearance Details</a>
                        </li>
                        <li>
                            <a href="./index.php"><i class="fa fa-table fa-3x"></i>Update Clearances</a>
                        </li>
                        
                        <li>
                            <a href="./materials.php"><i class="fa fa-square-o fa-3x"></i> Available Materials</a>
                        </li><?php }?>
                        <!-- Admins Only -->

                        <li>
                            <a href="./sendFeedback.php"><i class="fa fa-qrcode fa-3x"></i>sendFeedback</a>
                        </li>
                       
                      



                    </ul>

                </div>

            </nav>
            <!-- /. NAV SIDE  -->
            <div id="page-wrapper">
                <div id="page-inner">
                    <div class="row">
                        <div class="col-md-7">
                            <h2>Admin <?php echo $_SESSION['office'] . '   '  ?> Dashboard</h2>
                            <h5>Welcome <?php echo $_SESSION['userName'] ?> , Love to see you back. </h5>
                        </div>
                        <div class="col-sm-1" style="margin-top: 15px;">
                            <button type="button" class="btn btn-info btn-circle">
                                <h1 style="color:#fff; font-size:20px; margin:0;font-weight:700;"> <?php
                                                                                                    $m_id = $_SESSION['id'];
                                                                                                    $sql = "SELECT * FROM message where to_user = $m_id";
                                                                                                    $result = mysqli_query($conn, $sql);
                                                                                                    echo $result->num_rows;
                                                                                                    ?></h1>

                            </button>
                        </div>
                        <div class="col-md-1">
                            <h2>Messages</h2>

                        </div>

                    </div>

                    <?php if (isset($_GET['error'])) { ?>
                        <div class="message">
                            <h5>
                                <p class="error"><?php echo $_GET['error']; ?></p>
                            </h5>
                        </div>
                    <?php } ?>
                    <!-- /. ROW  -->
                    <hr />
                    <!-- Admins Only -->
                    <?php if($_SESSION['role'] ==3 || $_SESSION['role'] == 2) {?>

                    <div class="row">
                        <div class="col-md-3 col-sm-6 col-xs-6">
                            <div class="panel panel-back noti-box">
                                <span class="icon-box bg-color-red set-icon">
                                    <i class="fa fa-envelope-o"></i>
                                </span>
                                <div class="text-box">
                                    <p class="main-text"><?php
                                                            $my_of = $_SESSION['office_id'];
                                                            $sql = "SELECT * FROM `feedbacks` where to_office = $my_of ";
                                                            $result = mysqli_query($conn, $sql);
                                                            echo $result->num_rows;



                                                            ?> Review</p>
                                    <p class="text-muted">Feedbacks</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-6">
                            <div class="panel panel-back noti-box">
                                <span class="icon-box bg-color-green set-icon">
                                    <i class="fa fa-bars"></i>
                                </span>
                                <div class="text-box">
                                    <p class="main-text"><?php

                                                            $office = $_SESSION['office_id'];
                                                            // echo $office;
                                                            $sql = "SELECT * FROM `clearance_list` where office = $office and `approved` = 0 ";
                                                            $result = mysqli_query($conn, $sql);
                                                            $remaning = $result->num_rows;
                                                            echo $remaning; ?> Clearance</p>
                                    <p class="text-muted">Remaining Pending</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-6">
                            <div class="panel panel-back noti-box">
                                <span class="icon-box bg-color-blue set-icon">
                                    <i class="fa fa-bell-o"></i>
                                </span>
                                <div class="text-box">
                                    <p class="main-text"><?php
                                                            $sql = "SELECT * FROM `clearance_list` where office = $office and `approved` = 1 ";
                                                            $result = mysqli_query($conn, $sql);
                                                            echo $result->num_rows;



                                                            ?> approved</p>
                                    <p class="text-muted">Approved Clearances</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-6">
                            <div class="panel panel-back noti-box">
                                <span class="icon-box bg-color-brown set-icon">
                                    <i class="fa fa-rocket"></i>
                                </span>
                                <div class="text-box">
                                    <p class="main-text"><?php
                                                            $sql = "SELECT * FROM `clerance_request` where office_requested  = $office";
                                                            $result = mysqli_query($conn, $sql);
                                                            echo $result->num_rows;

                                                            ?> Requests</p>
                                    <p class="text-muted">Total</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php }?>
                    <!-- Admins Only -->
                    <!-- /. ROW  -->
                    <hr />
                    <div class="row">

                    <!-- Admins Only -->
                       <?php if($_SESSION['role'] ==3 || $_SESSION['role'] == 2) {?>
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="panel panel-back noti-box">
                                <span class="icon-box bg-color-blue">
                                    <i class="fa fa-warning"></i>
                                </span>
                                <div class="text-box">
                                    <p class="main-text"> <?php
                                                            $sql = "SELECT * FROM `clearance_list` where office = $office";
                                                            $result = mysqli_query($conn, $sql);
                                                            echo $result->num_rows;



                                                            ?> Clearances are Available </p>
                                    <p class="text-muted">Add Clearances and View Details Here</p>
                                    <a href="./addClerance.php" class="btn btn-primary"><i class="fa fa-edit "></i> Add Clerances</a>
                                    <?php
                                    if ($_SESSION['role'] == 3) {
                                        echo "<a href='./clearanceList.php' class='btn btn-warning'><i class='fa fa-pencil'></i> View Clerance List</a>  ";
                                    }

                                    ?>
                                    <a href="./materials.php" class="btn btn-success"><i class="fa fa-edit "></i> View Materials</a>



                                    </td>

                                    <hr />
                                    <p class="text-muted">




                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <?php }?>
              <!-- Admins Only -->

                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="panel back-dash">
                                <i class="fa fa-dashboard fa-3x"></i><strong> &nbsp; Todo List</strong>

                                <?php
                                $office = $_SESSION['office_id'];
                                $user_id =  $_SESSION['id'];
                                // echo $office;
                                $sql = "SELECT * FROM `todos` where office = $office and `incharge` = $user_id ";
                                $result = mysqli_query($conn, $sql);
                                $remaning = $result->num_rows;

                                //  print_r($result);
                                if ($result->num_rows > 0) {
                                    $count = 0;
                                    // print_r($result);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                        <div class="row" style="background-color: #d2322d; margin:5px 5px;border-radius:5px;">
                                            <div class="col-sm-3">

                                                <p class="text-muted"><?php echo $row['content'] ?> </p>

                                            </div>
                                            <div class="col-sm-3">

                                                <p class="text-muted" style="color: #39b3d7;"><?php
                                                                                                if ($row['completed'] == 0) {
                                                                                                    echo "Ongoing Task!";
                                                                                                } else {
                                                                                                    echo "Comleted Task!";
                                                                                                }
                                                                                                ?> </p>

                                            </div>
                                            <div class="col-sm-3">
                                                <p class="text-muted"><?php echo "Date:" . $row['date'] ?> </p>

                                            </div>

                                            <form action="" method="POST">
                                                <input class="form-control" name="id" type="hidden" value="<?php echo $row['id'] ?>" />
                                                <input class="form-control" name="state" type="hidden" value="<?php echo $row['completed'] ?>" />


                                                <div class="col-sm-3" style="padding-top: 8px;">
                                                    <?php

                                                    if ($row['completed'] == 0) {
                                                        echo "<button type='submit' name='todo' class='btn btn-warning btn-sm' >complete</button>";
                                                    } else {
                                                        echo "<button type='submit' name='todo' class='btn btn-info btn-sm' >Renew todo</button>";
                                                    }

                                                    ?>
                                                </div>

                                                <button style="margin-left:15px;" type='submit' name='delete_todo' class='btn btn-success btn-sm'>delete</button>
                                            </form>
                                        </div>
                                <?php }
                                } ?>



                            </div>

                        </div>

                        <div class="col-md-6 col-sm-12 col-xs-12 ">
                            <div class="panel ">
                                <div class="main-temp-back">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-xs-6"> <i class="fa fa-cloud fa-3x"></i> Add todo </div>
                                            <div class="col-xs-6">
                                                <div class="text-temp">

                                                    <?php
                                                    $office = $_SESSION['office_id'];
                                                    $user_id =  $_SESSION['id'];
                                                    // echo $office;
                                                    $sql = "SELECT * FROM `todos` where office = $office and `incharge` = $user_id ";
                                                    $result = mysqli_query($conn, $sql);
                                                    $remaning = $result->num_rows;
                                                    echo $remaning . " " . "Tasks";

                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="panel panel-back noti-box">
                                <span class="icon-box bg-color-green set-icon">
                                    <i class="fa fa-desktop"></i>
                                </span>
                                <div class="text-box">
                                    <!-- Add Task -->
                                    <form action="" method="POST">

                                        <div class="form-group">

                                            <input class="form-control" name="name" type="text" placeholder="task Name" />

                                        </div>
                                        <div class="form-group">

                                            <input class="form-control" name="content" type="text" placeholder="task content" />

                                        </div>
                                        <button name="add_todo" type="submit" class="btn btn-primary">Add Task</button>
                                    </form>
                                    <!-- Add Task -->
                                </div>
                            </div>

                        </div>
                        <!-- Send Message -->

                        <div class="col-md-6 col-sm-12 col-xs-12 ">
                            <div class="panel ">
                                <div class="main-temp-back">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-xs-6"> <i class="fa fa-cloud fa-3x"></i> Send Message </div>
                                            <div class="col-xs-6">

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="panel panel-back noti-box">
                                <span class="icon-box bg-color-red set-icon">
                                    <i class="fa fa-envelope-o"></i>
                                </span>
                                <div class="text-box">
                                    <!-- Send -->
                                    <form action="" method="POST">

                                        <div class="form-group">
                                            <label>Select Reciver</label>
                                            <select class="form-control" name="reciver">

                                                <?php

                                                $current = $_SESSION['id'];
                                                $sql = "SELECT * FROM `users` where id!=$current";
                                                $result = mysqli_query($conn, $sql);
                                                if ($result->num_rows > 0) {

                                                    print_r($result);
                                                    while ($row = mysqli_fetch_assoc($result)) {



                                                ?>
                                                        <option value="<?php echo $row['id'] ?>"><?php echo $row['full_name'] ?></option>
                                                    <?php }
                                                } else { ?>
                                                    <div class="form-group">

                                                        <input class="form-control" disabeld placeholder="No Materials Are Availabel Please Add One" />
                                                    </div><?php } ?>

                                            </select>
                                        </div>
                                        <div class="form-group">

                                            <textarea name="cont" id="" cols="63" rows="5"></textarea>
                                        </div>
                                        <button name="sendM" type="submit" class="btn btn-primary">Send Message</button>
                                    </form>
                                    <!-- Send -->
                                </div>
                            </div>

                        </div>


                        <!-- Send Message -->

                    </div>
                    <!-- /. ROW  -->
                    <!-- Admins Only -->
                    <div class="row col-md-12 col-sm-12 col-xs-12">

                    <?php if($_SESSION['role'] ==3 || $_SESSION['role'] == 2) {?>


                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Remaining Clerances
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Clerance Name</th>
                                                    <th>Clerance Owner</th>
                                                    <th>In_charge</th>
                                                    <th>Date Created.</th>
                                                    <th>Change Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <form action="" method="POST">

                                                    <?php
                                                    $office = $_SESSION['office_id'];
                                                    // echo $office;
                                                    $sql = "SELECT * FROM `clearance_list` where office = $office and `approved` = 0 ";
                                                    $result = mysqli_query($conn, $sql);
                                                    $remaning = $result->num_rows;

                                                    //  print_r($result);
                                                    if ($result->num_rows > 0) {
                                                        $count = 0;
                                                        // print_r($result);
                                                        while ($row = mysqli_fetch_assoc($result)) {
                                                            $owner = $row['clearance_owner'];


                                                            $count += 1;
                                                            $sql2 = "SELECT * FROM `users` where id = $owner ";
                                                            $result2 = mysqli_query($conn, $sql2);

                                                            $data = mysqli_fetch_assoc($result2);


                                                    ?>
                                                            <tr>
                                                                <td><?php echo $count; ?></td>
                                                                <td><?php echo $row['name'] ?></td>
                                                                <td><?php echo $data['full_name'] ?></td>
                                                                <td><?php echo $_SESSION['office'] . ' office' ?></td>
                                                                <td><?php echo $row['date_created'] ?></td>
                                                                <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                                                                <input type="hidden" name="name" value="<?php echo $row['name'] ?>">
                                                                <input type="hidden" name="full_name" value="<?php echo $data['full_name'] ?>">
                                                                <input type="hidden" name="completed" value="<?php echo $row['completed'] ?>">
                                                                <input type="hidden" name="app" value="<?php echo $row['approved'] ?>">
                                                                <input type="hidden" name="desc" value="<?php echo $row['description'] ?>">
                                                                <input type="hidden" name="dt" value="<?php echo $row['date_created'] ?>">
                                                                <td><button name="view_detail_1" type="submit" class="btn btn-primary"><i class="fa fa-edit "></i> View Detail</button> <button name="approve" type="submit" class="btn btn-warning"><i class="fa fa-pencil"></i> Approve</button> <button name="delete" type="submit" class="btn btn-danger"><i class="fa fa-pencil"></i> Delete</button><a href="./updateClearance.php?id=<?php echo $row['id'] ?>" style="margin:5px 15px;" name="update" class="btn btn-default"><i class=" fa fa-refresh "></i> Update</a></td>
                                                            </tr>
                                                    <?php }
                                                    } ?>

                                                </form>
                                            </tbody>
                                        </table>

                                        <!--  -->
                                        <?php
                                        if ($detail_1) {

                                        ?>
                                            Detail Tabs

                                            <div class="panel-body">
                                                <ul class="nav nav-pills">
                                                    <li class=""><a href="#home-pills" data-toggle="tab">Description</a>
                                                    </li>
                                                    <li class=""><a href="#profile-pills" data-toggle="tab">Status</a>
                                                    </li>
                                                    <li class=""><a href="#messages-pills" data-toggle="tab">Date Created</a>
                                                    </li>
                                                    <li class="active"><a href="#settings-pills" data-toggle="tab">InCharge</a>
                                                    </li>
                                                </ul>

                                                <div class="tab-content">
                                                    <div class="tab-pane fade" id="home-pills">
                                                        <h4>Description</h4>
                                                        <p><?php echo $desc ?>.</p>
                                                        <p><?php echo "Clerance Owner " . " " . $ful_n ?>.</p>
                                                        <p><?php echo "Clerance Name " . " " . $it_name ?>.</p>
                                                    </div>
                                                    <div class="tab-pane fade" id="profile-pills">
                                                        <h4>Clerance Status</h4>
                                                        <p><?php
                                                            if ($comp == 0 && $app == 1) {
                                                                echo "<h4 style='color:yellow;'>you have Approved it , Waiting Supper Admin Approval!</h4>";
                                                            }
                                                            if ($comp == 1 && $app == 1) {
                                                                echo "<h4 style='color:green'>clerance Approval Process Is Completed!</h4>";
                                                            }

                                                            if ($app ==  0) {
                                                                echo "<h4 style='color:blue' >Still Waiting For Your Approval ,Please Approve As possible As you Can!</h4>";
                                                            }

                                                            ?>.</p>
                                                    </div>
                                                    <div class="tab-pane fade" id="messages-pills">
                                                        <h4>Clerance Creation Date</h4>
                                                        <p><?php echo $created ?>.</p>
                                                    </div>
                                                    <div class="tab-pane fade active in" id="settings-pills">
                                                        <h4>InCharge Of Controlling this Clerance and Management</h4>
                                                        <p><?php echo $_SESSION['office'] . ' office' ?>.</p>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                <?php } else { ?>


                                    <div class="panel-body">
                                        <ul class="nav nav-pills">
                                            <li class=""><a href="#home-pills" data-toggle="tab">Description</a>
                                            </li>
                                            <li class=""><a href="#profile-pills" data-toggle="tab">Status</a>
                                            </li>
                                            <li class=""><a href="#messages-pills" data-toggle="tab">Date Created</a>
                                            </li>
                                            <li class="active"><a href="#settings-pills" data-toggle="tab">InCharge</a>
                                            </li>
                                        </ul>

                                        <div class="tab-content">
                                            <div class="tab-pane fade" id="home-pills">
                                                <h4>description</h4>
                                                <p>Noting TO show Here Select one First</p>
                                            </div>
                                            <div class="tab-pane fade" id="profile-pills">
                                                <h4>Status</h4>
                                                <p>Noting TO show Here Select one First</p>
                                            </div>
                                            <div class="tab-pane fade" id="messages-pills">
                                                <h4>Date Created</h4>
                                                <p>Noting TO show Here Select one First</p>
                                            </div>
                                            <div class="tab-pane fade active in" id="settings-pills">
                                                <h4>InCharge</h4>
                                                <p>Noting TO show Here Select one First</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                            <!--  -->


                            <!--  -->


                            </div>

                        </div>
                    </div><?php }?>
                    <!-- Admins Only -->
                </div>

            </div>
            <!-- /. ROW  -->
            <div class="row">
                <!-- here notification -->
                <!-- Admins Only -->
                <?php if($_SESSION['role'] ==3 || $_SESSION['role'] == 2) {?>

                <div class="col-md-12 col-sm-12 col-xs-12">

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Approved Clerances
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Clerance Name</th>
                                                <th>Clerance Owner</th>
                                                <th>In_charge</th>
                                                <th>Date Created.</th>
                                                <th>Super Admin Approval Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <form action="" method="POST">

                                                <?php
                                                $office = $_SESSION['office_id'];
                                                // echo $office;
                                                $sql = "SELECT * FROM `clearance_list` where office = $office and `approved` = 1 ";
                                                $result = mysqli_query($conn, $sql);

                                                if ($result->num_rows > 0) {
                                                    $count = 0;
                                                    // print_r($result);
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        $owner = $row['clearance_owner'];


                                                        $count += 1;
                                                        $sql2 = "SELECT * FROM `users` where id = $owner ";
                                                        $result2 = mysqli_query($conn, $sql2);

                                                        $data = mysqli_fetch_assoc($result2);




                                                ?>

                                                        <tr>
                                                            <td><?php echo $count; ?></td>
                                                            <td><?php echo $row['name'] ?></td>
                                                            <td><?php echo $data['full_name'] ?></td>
                                                            <td><?php echo $_SESSION['office'] . ' office' ?></td>
                                                            <td><?php echo $row['date_created'] ?></td>
                                                            <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                                                            <input type="hidden" name="name" value="<?php echo $row['name'] ?>">
                                                            <input type="hidden" name="full_name" value="<?php echo $data['full_name'] ?>">
                                                            <input type="hidden" name="completed" value="<?php echo $row['completed'] ?>">
                                                            <input type="hidden" name="app" value="<?php echo $row['approved'] ?>">
                                                            <input type="hidden" name="desc" value="<?php echo $row['description'] ?>">
                                                            <input type="hidden" name="dt" value="<?php echo $row['date_created'] ?>">
                                                            <td><a href="./updateClearance.php?id=<?php echo $row['id'] ?>" style="margin:5px 15px;" name="update" class="btn btn-default"><i class=" fa fa-refresh "></i> Update</a><button name="view_detail_1" type="submit" class="btn btn-primary"><i class="fa fa-edit "></i> View Detail</button> <button name="dis_approve" type="submit" class="btn btn-danger"><i class="fa fa-edit "></i>disApprove</button> <button class="btn
                                             <?php
                                                        if ($row['completed'] == 0) {
                                                            echo "btn-warning";
                                                        } else {
                                                            echo "btn-primary";
                                                        }
                                                ?>"><i class="fa fa-check"></i> <?php
                                                                                if ($row['completed'] == 0) {
                                                                                    echo "Pending";
                                                                                } else {
                                                                                    echo "Completed";
                                                                                }



                                                                                ?></button></td>
                                                        </tr>
                                                <?php }
                                                } ?>

                                            </form>
                                        </tbody>
                                    </table>
                                </div>

                                <!--  -->
                            </div>
                        </div>
                    </div>





                </div>
                <?php }?>
            </div>
            <!-- /. ROW  -->
            <div class="row">
                <!-- Admins Only -->
            <?php if($_SESSION['role'] ==3 || $_SESSION['role'] == 2) {?>

                <div class="col-md-6 col-sm-12 col-xs-12">

                    <div class="chat-panel panel panel-default chat-boder chat-panel-head" style="margin:20px auto; ">
                        <div class="panel-heading">
                            <i class="fa fa-comments fa-fw"></i>
                            Some Feedbacks From users For You
                            <div class="btn-group pull-right">

                                <ul class="dropdown-menu slidedown">
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-refresh fa-fw"></i>Refresh
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-check-circle fa-fw"></i>Available
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-times fa-fw"></i>Busy
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-clock-o fa-fw"></i>Away
                                        </a>
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-sign-out fa-fw"></i>Sign Out
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="panel-body">
                            <ul class="chat-box">

                                <?php
                                $my_of = $_SESSION['office_id'];
                                $sql = "SELECT * FROM `feedbacks` where to_office = $my_of ";
                                $result = mysqli_query($conn, $sql);
                                if ($result->num_rows) {

                                    while ($row = mysqli_fetch_assoc($result)) {

                                ?>

                                        <li class="left clearfix">
                                            <span class="chat-img pull-left">
                                                <img src="../img/3.png" alt="User" class="img-circle" />
                                            </span>
                                            <div class="chat-body clearfix">

                                                <strong><?php
                                                        $user = $row['from_user'];
                                                        $sql = "SELECT * FROM `users` where id = $user";
                                                        $result = mysqli_query($conn, $sql);
                                                        $fn = mysqli_fetch_assoc($result);


                                                        echo  $fn['full_name'] ?></strong>
                                                <small class="pull-right text-muted">
                                                    <i class="fa fa-clock-o fa-fw"></i><?php echo $row['date'] ?></small>

                                                <p>
                                                    <?php echo  $row['content'] ?>
                                                </p>
                                            </div>
                                        </li>
                                <?php  }
                                } ?>

                            </ul>
                        </div>



                    </div>
                    <?php }?>
                    <!-- Admins Only -->

                </div>
                <div class="col-md-6 col-sm-12 col-xs-12">
                    <di class="row">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                My Clerances
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Clerance Name</th>
                                                    <th>Clerance Owner</th>
                                                    <th>In_charge</th>
                                                    <th>Date Created.</th>
                                                    <th>Super Admin Approval Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <form action="" method="POST">

                                                    <?php
                                                    $id = $_SESSION['id'];
                                                    // echo $office;
                                                    $sql = "SELECT * FROM `clearance_list` where clearance_owner = $id";
                                                    $result = mysqli_query($conn, $sql);

                                                    if ($result->num_rows > 0) {
                                                        $count = 0;
                                                        // print_r($result);
                                                        while ($row = mysqli_fetch_assoc($result)) {
                                                            $owner = $row['clearance_owner'];


                                                            $count += 1;
                                                            $sql2 = "SELECT * FROM `users` where id = $owner ";
                                                            $result2 = mysqli_query($conn, $sql2);

                                                            $data = mysqli_fetch_assoc($result2);




                                                    ?>

                                                            <tr>
                                                                <td><?php echo $count; ?></td>
                                                                <td><?php echo $row['name'] ?></td>
                                                                <td><?php echo $data['full_name'] ?></td>
                                                                <td><?php echo $_SESSION['office'] . ' office' ?></td>
                                                                <td><?php echo $row['date_created'] ?></td>
                                                                <td><?php

                                                                    if ($row['completed'] == 0 || $row['approved'] == 0) {
                                                                        echo "<button class='btn btn-success btn-sm disabled'><i class='fa fa-edit'></i> Incomplete </button>";
                                                                    }
                                                                    ?>

                                                                </td>


                                                            </tr>
                                                    <?php }
                                                    } ?>

                                                </form>
                                            </tbody>
                                        </table>


                                    </div>

                                </div>
                            </div>
                        </div>
                </div>
                <div class="row" style="background-color: burlywood;">
                    <div class="col-md-6 col-sm-12 col-xs-12" style="margin:20px auto; background-color:burlywood;max-height:300px;overflow:scroll;padding:20px auto;">
                        <div class="chat-panel panel panel-default chat-boder chat-panel-head" style="max-height: 300px;">
                            <div class="panel-heading">
                                <i class="fa fa-comments fa-fw"></i>
                                Messages

                            </div>

                            <div class="panel-body" style="background-color: #fff;">
                                <ul class="chat-box">

                                    <?php
                                    $my_of = $_SESSION['id'];

                                    $sql = "SELECT * FROM `message` where to_user = $my_of ";
                                    $resultx = mysqli_query($conn, $sql);
                                    if ($resultx->num_rows) {

                                        while ($rm = mysqli_fetch_assoc($resultx)) {

                                    ?>

                                            <li class="left clearfix">
                                                <span class="chat-img pull-left">
                                                    <img src="../img/3.png" alt="User" class="img-circle" />
                                                </span>
                                                <div class="chat-body clearfix">

                                                    <strong><?php
                                                            $of = $rm['sender'];
                                                            $sql = "SELECT * FROM `office` where id = $of";
                                                            $result = mysqli_query($conn, $sql);
                                                            $fn = mysqli_fetch_assoc($result);


                                                            echo  $fn['name'] ?></strong>
                                                    <small class="pull-right text-muted">
                                                        <i class="fa fa-clock-o fa-fw"></i><?php echo $rm['date'] ?></small>

                                                    <p>
                                                        <?php echo  $rm['content'] ?>
                                                    </p>
                                                </div>
                                            </li>
                                    <?php  }
                                    } ?>

                                </ul>
                            </div>



                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /. ROW  -->
        </div>
        <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
        </div>
        <!-- /. WRAPPER  -->
        <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
        <!-- JQUERY SCRIPTS -->
        <script src="../js/jquery-1.10.2.js"></script>
        <!-- BOOTSTRAP SCRIPTS -->
        <script src="../js/bootstrap.min.js"></script>
        <!-- METISMENU SCRIPTS -->
        <script src="../js/jquery.metisMenu.js"></script>
        <!-- MORRIS CHART SCRIPTS -->
        <script src="../js/morris/raphael-2.1.0.min.js"></script>
        <script src="../js/morris/morris.js"></script>
        <!-- CUSTOM SCRIPTS -->
        <script src="../js/custom.js"></script>


    </body>

    </html>
<?php } ?>