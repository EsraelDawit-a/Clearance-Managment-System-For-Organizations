<?php

include "../db.inc.php";

session_start();

if (!isset($_SESSION['id'])) {
    header("Location:../login.php?error=Login Here First!");
} 

if($_SESSION['role'] ==2 || $_SESSION['role']==3){

    include "../controller/clearanceAddController.php";
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
                    <?php if (isset($_GET['message'])) { ?>
                        <div class="message">
                            <h5>
                                <p class="error"><?php echo $_GET['message']; ?></p>
                            </h5>
                            
                        </div>
                    <?php } ?>
                    <!-- dont -->


                </div>
                <!-- /. ROW  -->
                <div class="row">
                    <!-- one -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="col-md-8">
                                <h3>Clerance Creation Form</h3>
                                <form role="form" action="" method="POST">
                                    <!-- office -->
                                    <div class="form-group">

                                        <input class="form-control" name="office" type="hidden" value="<?php echo $_SESSION['office_id'] ?>" />

                                    </div>
                                    <!-- ClearanceName -->
                                    <div class="form-group">

                                        <input class="form-control" name="name" placeholder="Clearance Name" />

                                    </div>
                                    <!-- ClearanceName -->
                                    <!--  -->

                                    <!-- InCharge -->
                                    <div class="form-group">

                                        <input class="form-control" type="hidden" name="in_charge" value="<?php echo $_SESSION['id'] ?>" />

                                    </div>
                                    <!-- In Charge -->
                                    <!--  -->
                                    <!-- Material -->
                                    <div class="form-group">
                                        <label>Select Clearance Material to Add</label>
                                        <select class="form-control" name="material">

                                            <?php

                                            $sql = "SELECT * FROM `material` where available_quantity > 0";
                                            $result = mysqli_query($conn, $sql);
                                            if ($result->num_rows > 0) {

                                                print_r($result);
                                                while ($row = mysqli_fetch_assoc($result)) {



                                            ?>
                                                    <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
                                                <?php }
                                            } else { ?>
                                                <div class="form-group">

                                                    <input class="form-control" disabeld placeholder="No Materials Are Availabel Please Add One" />
                                                </div><?php } ?>

                                        </select>
                                    </div>
                                    <!-- End Material -->
                                    <!--  -->
                                    <!-- Select Owener -->
                                    <div class="form-group">
                                        <label>Select Clearance Oweners to Add</label>
                                        <select class="form-control" name="owener">

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
                                    <!-- End Owner -->
                                    <!-- Description -->
                                    <div class="form-group">

                                        <textarea class="form-control" name="desc" placeholder="Clearance Description"></textarea>

                                    </div>
                                    <!-- Description -->

                                    <button type="submit" name="add_clearance" class="btn btn-info btn-lg">Add Clearance</button>

                                </form>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="col-md-8">
                                <h3>Material Creation Form</h3>
                                <form role="form" action="" method="POST">

                                    <!-- MaterialName -->
                                    <div class="form-group">

                                        <input class="form-control" name="name" placeholder="Material Name" />

                                    </div>
                                    <!-- ClearanceName -->
                                    <!--  -->

                                    <!-- InCharge -->
                                    <!-- <div class="form-group">

                                        <input class="form-control" type="hidden" name="in_charge" value="<?php echo $_SESSION['id'] ?>" />

                                    </div> -->
                                    <!-- In Charge -->
                                    <!-- Available Quantity -->
                                    <div class="form-group">

                                        <input class="form-control" type="number" min="1" name="quantity" placeholder="Availabel Quantity" />

                                    </div>
                                    <!-- End of AvailableQuantity -->
                                    <!-- Select Owener -->
                                    <div class="form-group">

                                        <input class="form-control" type="hidden" name="office" value="<?php echo $_SESSION['office_id'] ?>" />

                                    </div>
                                    <!-- End Owner -->
                                    <!-- Description -->
                                    <div class="form-group">

                                        <textarea class="form-control" name="desc" placeholder="Material Description"></textarea>

                                    </div>
                                    <!-- Description -->

                                    <button type="submit" name="add_material" class="btn btn-success btn-lg">Add Material</button>

                                </form>
                            </div>
                        </div>
                        
                    </div>
                    <!-- end one -->
                   <?php if ($_SESSION['role'] == 3) {?>

                    <div class="row" style="margin-top: 25px;background-color:grey;padding:25px 10px">
                        <!-- office -->
                        <div class="col-md-6">
                           <form action="" method="POST">
                           <h3 style="color: #fff;">Office Creation Form</h3>
                            <div class="form-group">
                                <input class="form-control" type="text" name="name" placeholder="Office Name" ?>
                            </div>

                            <div class="form-group">

                                <textarea class="form-control" name="desc" placeholder="Office Description"></textarea>

                            </div>
                            <button type="submit" name="add_office" class="btn btn-warning btn-lg">Add Office</button>

                           </form>
                        </div>
                        <!-- Office -->

                        <!-- Role Add Here -->
                        <div class="col-md-6">
                            <form action="" method="POST">
                            <h3 style="color: #fff;">Role Creation Form</h3>
                            <div class="form-group">
                            <div class="form-group">
                                <input class="form-control" type="text" name="name" placeholder="Role Name" ?>
                            </div>
                            </div>

                            <div class="form-group">
                                <label> Working Place(building number)</label>
                                <select class="form-control" name="building">
                                    <?php

                                    $current = $_SESSION['id'];
                                    $sql = "SELECT * FROM `work_place`";
                                    $result = mysqli_query($conn, $sql);
                                    if ($result->num_rows > 0) {

                                        // print_r($result);
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            //   print_r($row);


                                    ?>
                                            <option value="<?php echo $row['id'] ?>"><?php echo $row['block_no'] ?></option>
                                        <?php }
                                    } else { ?>
                                        <div class="form-group">

                                            <input class="form-control" disabeld placeholder="No Offices Are Availabel Please Add One" />
                                        </div><?php } ?>

                                </select>
                            </div>
                            <button type="submit" name="add_role" class="btn btn-info btn-lg">Add role</button>


                            </form>
                             
                            
                        </div>


                    </div>
                    <div class="row" style="margin-top: 25px;background-color:grey;padding:25px 10px">
                        <!-- office -->
                        <div class="col-md-6">
                            <form action="" method="POST">
                            <h3 style="color: #fff;">WorkPlace Creation Form</h3>
                            <div class="form-group">
                                <input class="form-control" type="number" min="1" name="building" placeholder="Building Number" ?>
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="number" min="1" name="office" placeholder="office Number" ?>
                            </div>

                            <div class="form-group">

                                <textarea class="form-control" name="desc" placeholder="Work Description"></textarea>

                            </div>
                            <button type="submit" name="add_work_place" class="btn btn-warning btn-lg">Add WorkPlace</button>

                            </form>
                        </div>
                        <!-- Office -->
                        <div class="col-md-6">
                            <form action="" method="POST">

                                <h3 style="color: #fff;">User Creation Form</h3>
                                <div class="form-group">
                                    <label>Select User Role</label>
                                    <select class="form-control" name="role">
                                        <?php

                                        $current = $_SESSION['id'];
                                        $sql = "SELECT * FROM `role`";
                                        $result = mysqli_query($conn, $sql);
                                        if ($result->num_rows > 0) {

                                            // print_r($result);
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                print_r($row);


                                        ?>
                                                <option value="<?php echo $row['id'] ?>"><?php echo $row['user_type'] ?></option>
                                            <?php }
                                        } else { ?>
                                            <div class="form-group">

                                                <input class="form-control" disabeld placeholder="No Roles Are Availabel Please Add One" />
                                            </div><?php } ?>

                                    </select>
                                </div>

                                <div class="form-group">
                                    <label> Working Office</label>
                                    <select class="form-control" name="office">
                                        <?php

                                        $current = $_SESSION['id'];
                                        $sql = "SELECT * FROM `office`";
                                        $result = mysqli_query($conn, $sql);
                                        if ($result->num_rows > 0) {

                                            // print_r($result);
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                //   print_r($row);


                                        ?>
                                                <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
                                            <?php }
                                        } else { ?>
                                            <div class="form-group">

                                                <input class="form-control" disabeld placeholder="No Offices Are Availabel Please Add One" />
                                            </div><?php } ?>

                                    </select>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" type="text" name="full_name" placeholder="Full Name" ?>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" type="text" name="user_type" placeholder="User_type" ?>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" type="text" name="phone" placeholder="Phone Number" ?>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" type="password" name="password1" placeholder="Password" ?>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" type="password" name="password2" placeholder="Password Confirm" ?>
                                </div>

                                <button type="submit" name="add_user" class="btn btn-success btn-lg">Add User</button>

                        </div>
                        <!-- here -->
                        </form>

                    </div>
                    <?php }?>

                    <!-- end two -->
                    <!-- row Final -->
                    

                    <!-- final row end -->



                </div>
                <!-- /. ROW  -->

                <!-- Clerance End -->
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
<?php } 

else{
    header("Location:../login.php?error=Trying to Access Unaoutorized Page!");
}
?>