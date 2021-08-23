<?php

include "../db.inc.php";

session_start();

if (!isset($_SESSION['id'])) {
    header("Location:../login.php?error=Login Here First!");
} else {


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
    
    // Revoke Completion 
    if (isset($_POST['done'])) {
        $state = $_POST['state'];
        $idn = $_POST['idn'];
        print_r($idn);
        // print_r($state);
        // if($state == 0){$state =1;}else{$state = 0;}
        // $sql = "UPDATE `clearance_list ` SET `completed` = $state WHERE  id = $id";
        // $result = mysqli_query($conn, $sql);
        // if ($result) {
        //     header("Location:./clearanceList.php?error=Clearance Successfully Completed");
        // } else {
        //     header("Location:./clearanceList.php?error=Unabel To Complete Clearance Sorry!");
           
        // }
    }


   

?>

    <!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Free Bootstrap Admin Template : Binary Admin</title>
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
font-size: 16px;"> <a style="margin-right: 25px;"><?php echo $_SESSION['office'] . '   '  ?> </a> <a href="./logout.php" class="btn btn-danger square-btn-adjust">Logout</a> </div>
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
                        <li>
                            <a href="./addClerance.php"><i class="fa fa-desktop fa-3x"></i>Add Clearances</a>
                        </li>
                        <li>
                            <a href="./index.php"><i class="fa fa-qrcode fa-3x"></i>Overview</a>
                        </li>
                        <li>
                            <a href="./index.php"><i class="fa fa-bar-chart-o fa-3x"></i> View Clearance Details</a>
                        </li>
                        <li>
                            <a href="./index.php"><i class="fa fa-table fa-3x"></i>Update Clearances</a>
                        </li>
                        <li>
                            <a href="form.html"><i class="fa fa-edit fa-3x"></i> Submit Clearance Request </a>
                        </li>



                        <li>
                            <a href="blank.html"><i class="fa fa-square-o fa-3x"></i> Blank Page</a>
                        </li>
                    </ul>

                </div>

            </nav>
            <!-- /. NAV SIDE  -->
            <div id="page-wrapper">
                <div id="page-inner">
                    <div class="row">
                        <div class="col-md-12">
                            <h2>Admin <?php echo $_SESSION['office'] . '   '  ?> Dashboard</h2>
                            <h5>Welcome <?php echo $_SESSION['userName'] ?> , Love to see you back. </h5>
                        </div>

                        
                    </div>
                    <?php if (isset($_GET['message'])) { ?>
                        <div class="message">
                            <h5>
                                <p class="error"><?php echo $_GET['message']; ?></p>
                            </h5>
                            
                        </div>
                    <?php } ?>
                    <!-- here -->

                    <div class="row">
                        <div class="col-md-12">
                        <div class="panel-heading">
                                Remaining Clerances Waiting Your Confirmation
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
                                                    $sql = "SELECT * FROM `clearance_list` where approved = 1";
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
                                                                <input type="text" name="idn" value="<?php echo $row['id'] ?>">
                                                                <input type="hidden" name="name" value="<?php echo $row['name'] ?>">
                                                                <input type="hidden" name="full_name" value="<?php echo $data['full_name'] ?>">
                                                                <input type="hidden" name="state" value="<?php echo $row['completed'] ?>">
                                                                <input type="hidden" name="app" value="<?php echo $row['approved'] ?>">
                                                                <input type="hidden" name="desc" value="<?php echo $row['description'] ?>">
                                                                <input type="hidden" name="dt" value="<?php echo $row['date_created'] ?>">
                                                                <td><button name="view_detail_1" type="submit" class="btn btn-primary"><i class="fa fa-edit "></i> View Detail</button> 
                                                                
                                                               <?php 
                                                               
                                                                if($row['completed'] == 0){?>
                                                                  
                                                                     <button name="done" type="submit" class='btn btn-warning'><i class='fa fa-pencil'></i>Complete</button>
                                                               
                                                            <?php  }
                                                               
                                                               ?>
                                                            
                                                            
                                                            </td>
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
                        </div>


                    </div>
                </div>
            </div>
        </div>

        </div>
        <!-- /. ROW  -->

        <!-- /. ROW  -->

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