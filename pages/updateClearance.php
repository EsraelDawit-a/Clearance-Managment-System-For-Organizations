<?php

include "../db.inc.php";

session_start();

if (!isset($_SESSION['id'])) {
    header("Location:../login.php?error=Login Here First!");
}if($_SESSION['role'] ==2 || $_SESSION['role']==3){
    

    
// update Clearance

if (isset($_POST['Update_clearance'])) {
    print_r("update_clearance");
    $in_charge = $_POST['in_charge'];
    $name = $_POST['name'];
    $office = $_POST['office'];
    $material = $_POST['material'];
    $owener = $_POST['owener'];
    $desc = $_POST['desc'];
    $id = $_POST['id'];
    print_r($id);
    if (empty($in_charge) || empty($name) || empty($office) || empty($material) || empty($owener) || empty($desc)) {
        header("Location:./updateClearance.php?error=Please Fill Empty Fields First Please!");
    } else {
        $sql = "UPDATE `clearance_list` SET `name` = '$name', `description` = '$desc', 
        `clearance_owner` = $owener, `in_charge` = $in_charge, `material` = $material  WHERE `clearance_list`.`id` = $id ";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            header("Location:./index.php?success=New Clearance Successfully Updated!");
        } else {
            header("Location:./updateClearance.php?error=Unable To Update Clearance!");
        }
    }
}






   
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "SELECT * FROM clearance_list where id =$id";
    $result = mysqli_query($conn,$sql);
    if($result ->num_rows >0){
        $ray = mysqli_fetch_assoc($result);
        
    }
}


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
                    <!-- here -->

                    <div class="row">
                    <div class="col-md-8" style="margin:auto 15vw;background-color:darkgrey;padding:15px 15px;">
                            <div class="col-md-10">
                                <h3>Clerance Update Form</h3>
                                <form role="form" action="" method="POST">
                                    <!-- office -->
                                    <div class="form-group">

                                        <input class="form-control" name="office" type="hidden" value="<?php echo $_SESSION['office_id'] ?>" />

                                    </div>
                                    <div class="form-group">

                                        <input class="form-control" name="id" type="hidden" value="<?php echo $_GET['id'] ?>" />

                                    </div>
                                    <!-- ClearanceName -->
                                    <div class="form-group">

                                        <input class="form-control" name="name" placeholder="<?php echo $ray['name'] ?>" />

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
                                        <label>Select Clearance Material to Update</label>
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
                                        <label>Select Clearance Oweners to Update</label>
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

                                        <textarea class="form-control" name="desc"  placeholder="<?php echo $ray['description'] ?>"></textarea>

                                    </div>
                                    <!-- Description -->

                                    <button type="submit" name="Update_clearance" class="btn btn-info btn-lg">Update Clearance</button>

                                </form>
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
<?php } 
else{
    header("Location:../login.php?error=Trying to Access Unaoutorized Page!");
}

?>