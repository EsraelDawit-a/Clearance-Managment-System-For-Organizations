<?php

include "../db.inc.php";

session_start();

if (!isset($_SESSION['id'])) {
    header("Location:../login.php?error=Login Here First!");
} else {

    if (isset($_POST['add_clearance'])) {
        print_r("add_clearance");
        $in_charge = $_POST['in_charge'];
        $name = $_POST['name'];
        $office = $_POST['office'];
        $material = $_POST['material'];
        $owener = $_POST['owener'];
        $desc = $_POST['desc'];
        // print_r($desc);
        if (empty($in_charge) || empty($name) || empty($office) || empty($material) || empty($owener) || empty($desc)) {
            header("Location:./addClerance.php?error=Please Fill Empty Fields First Please!");
        } else {
            $sql = "INSERT INTO `clearance_list` ( `name`, `description`,
        `clearance_owner`, `in_charge`, `office`, `material`) 
       VALUES ('$name', '$desc', $owener, $in_charge, $office, $material)";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                header("Location:./addClerance.php?success=New Clearance Successfully Added!");
            } else {
                header("Location:./addClerance.php?error=Unable To Create New Clearance!");
            }
        }
    }
    // Add Material
    if (isset($_POST['add_material'])) {
        print_r("add_clearance");
        $in_charge = $_POST['in_charge'];
        $name = $_POST['name'];
        $office = $_POST['office'];
        // $material = $_POST['material'];
        $quantity = $_POST['quantity'];
        // $owener = $_POST['owener'];
        $desc = $_POST['desc'];
        // print_r($desc);
        if (empty($name) || empty($office)  || empty($desc) || empty($quantity)) {
            header("Location:./addClerance.php?error=Please Fill Empty Fields First Please!");
        } else {
            print_r($in_charge);
            $sql = "INSERT INTO `material` ( `name`, 
            `in_charge`, `available_quantity`, `description`) 
            VALUES ('$name',$office,$quantity, '$desc')";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                header("Location:./addClerance.php?success=New Material Successfully Added!");
            } else {
                header("Location:./addClerance.php?error=Unable To Create New Material!");
                // print_r(mysqli_error($conn));
            }
        }
    }
    // Add Users
    if (isset($_POST['add_user'])) {
         $name = $_POST['full_name'];
         $phone = $_POST['phone'];
         $password1 = $_POST['password1'];
         $password2 = $_POST['password2'];
         $user_type = $_POST['user_type'];
         $office = $_POST['office'];
         $role = $_POST['role'];

        if (empty($name) || empty($office)  || empty($phone) || empty($role) || empty($user_type) || empty($password1) || empty($password2)) {
            header("Location:./addClerance.php?error=Please Fill Empty Fields First Please!");
        }else{
        

       if($password1 !=$password2){
        header("Location:./addClerance.php?error=The two Password Fields DontMatch  Please Try Again!");

       }else{
        $sql = "INSERT INTO `users` (`full_name`, `role`, 
        `phone`, `password`, `office`, `user_type`) 
        VALUES ('$name', $role, '$phone', '$password1', $office, '$user_type')";

        $result = mysqli_query($conn,$sql);
        if ($result) {
            header("Location:./addClerance.php?success=New User Successfully Added!");
        } else {
            header("Location:./addClerance.php?error=Unable To Create New User!");
            // print_r(mysqli_error($conn));
        }
       }

    }
    }

    // Add Work_Place

    if (isset($_POST['add_work_place'])) {
        print_r("add_work_place");
        $building = $_POST['building'];
        $office = $_POST['office'];
        $desc = $_POST['desc'];
        // print_r($desc);
        if (empty($building) || empty($office)  || empty($desc)) {
            header("Location:./addClerance.php?error=Please Fill Empty Fields First Please!");
        } else {
            print_r($in_charge);
            $sql = "INSERT INTO `work_place` (`block_no`, `office_no`, `work_desc`) 
            VALUES ($building, $office, '$desc')";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                header("Location:./addClerance.php?success=New WorkPlace Successfully Added!");
            } else {
                header("Location:./addClerance.php?error=Unable To Create New WorkPlace!");
                // print_r(mysqli_error($conn));
            }
        }
    }

    // Add Role
    if (isset($_POST['add_role'])) {
        print_r("add_role");
        $building = $_POST['building'];
        $role_name = $_POST['name'];
        
        // print_r($desc);
        if (empty($building) || empty($role_name)) {
            header("Location:./addClerance.php?error=Please Fill Empty Fields First Please!");
        } else {
            print_r($in_charge);
            $sql = "INSERT INTO `role` (`user_type`, `work_place`) VALUES ('$role_name',$building) ";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                header("Location:./addClerance.php?success=New Role Successfully Added!");
            } else {
                header("Location:./addClerance.php?error=Unable To Create New Role!");
                // print_r(mysqli_error($conn));
            }
        }
    }

    // Add Office
    if (isset($_POST['add_office'])) {
        print_r("add_office");
        $desc = $_POST['desc'];
        $name = $_POST['name'];
        
        // print_r($desc);
        if (empty($desc) || empty($name)) {
            header("Location:./addClerance.php?error=Please Fill Empty Fields First Please!");
        } else {
            print_r($in_charge);
            $sql = "INSERT INTO `office` (`name`, `description`) VALUES ('$name', '$desc'); ";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                header("Location:./addClerance.php?success=New Office Successfully Added!");
            } else {
                header("Location:./addClerance.php?error=Unable To Create New Office!");
                // print_r(mysqli_error($conn));
            }
        }
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
<?php } ?>