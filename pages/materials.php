<?php

include "../db.inc.php";

session_start();

if (!isset($_SESSION['id'])) {
    header("Location:../login.php?error=Login Here First!");
}if($_SESSION['role'] ==2 || $_SESSION['role']==3){

include "../controller/materialController.php";
?>

    <!DOCTYPE html>
    <html>

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
                        <div class="col-md-12">
                            <h2>Admin <?php echo $_SESSION['office'] . '   '  ?> Dashboard</h2>
                            <h5>Welcome <?php echo $_SESSION['userName'] ?> , Love to see you back. </h5>
                        </div>

                        
                    </div>
                    <?php if (isset($_GET['error'])) { ?>
                        <div class="message">
                            <h5>
                                <p class="error"><?php echo $_GET['error']; ?></p>
                            </h5>
                            
                        </div>
                    <?php } ?>
                    <!-- here -->

                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-10">
                                <h3>Available Materials List</h3>

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
                                                            <th>Quantity Available</th>
                                                            <th>In_charge</th>
                                                            <th>Date Created.</th>
                                                            <th>Change Material Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <form action="" method="POST">

                                                            <?php
                                                            $office = $_SESSION['office_id'];
                                                            // echo $office;
                                                            $sql = "SELECT * FROM `material` ORDERD  where in_charge = $office ORDER BY -date ";
                                                            $result = mysqli_query($conn, $sql);

                                                            if ($result->num_rows > 0) {
                                                                $count = 0;
                                                                // print_r($result);
                                                                while ($row = mysqli_fetch_assoc($result)) {
                                                                    $count += 1;
                                                            ?>

                                                                    <tr>
                                                                        <td><?php echo $count; ?></td>
                                                                        <td><?php echo $row['name'] ?></td>
                                                                        <td><?php echo $row['available_quantity'] ?></td>
                                                                        <td><?php echo $_SESSION['office'] . ' office' ?></td>
                                                                        <td><?php echo $row['date'] ?></td>
                                                                        <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                                                                        <input type="hidden" name="name" value="<?php echo $row['name'] ?>">
                                                                        <input type="hidden" name="quantity" value="<?php echo $row['available_quantity'] ?>">
                                                                        <input type="hidden" name="office" value="<?php echo $row['office'] ?>">
                                                                        <input type="hidden" name="desc" value="<?php echo $row['description'] ?>">
                                                                        <input type="hidden" name="dt" value="<?php echo $row['date'] ?>">
                                                                        <td><a href="./updateMaterial.php?id=<?php echo $row['id'] ?>" style="margin:5px 15px;" name="update" class="btn btn-default"><i class=" fa fa-refresh "></i> Update</a><button name="view_detail_1" type="submit" class="btn btn-primary"><i class="fa fa-edit "></i> View Detail</button> <button name="delete_m" type="submit" class="btn btn-danger"><i class="fa fa-edit "></i>delete</button> </td>
                                                                    </tr>
                                                            <?php }
                                                            } ?>

                                                        </form>
                                                    </tbody>
                                                </table>
                                            </div>

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
                                                            <p><?php echo "Available Quantity " . " " . $ful_n ?>.</p>
                                                            <p>Name <?php echo $it_name ?></p>
                                                        </div>
                                                      
                                                        <div class="tab-pane fade" id="messages-pills">
                                                            <h4>Material Creation Date</h4>
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
<?php }else{
    header("Location:../login.php?error=Trying to Access Unaoutorized Page!");
} ?>