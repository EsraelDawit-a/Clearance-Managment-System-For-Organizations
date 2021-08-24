<?php

include "../db.inc.php";

session_start();

if (!isset($_SESSION['id'])) {
    header("Location:../login.php?error=Login Here First!");
}if($_SESSION['role'] ==2 || $_SESSION['role']==3){

    
// update Clearance

if (isset($_POST['update_material'])) {
    print_r("update_clearance");
    $name = $_POST['name'];
    $quantity = $_POST['quantity'];
    $desc = $_POST['desc'];
    $id = $_POST['id'];
    print_r($id);
    if (empty($quantity) || empty($name) || empty($id) || empty($desc)) {
        header("Location:./updateMaterial.php?message=Please Fill Empty Fields First Please!&id=$id");
    } else {
        $sql = "UPDATE `material` SET `name` = '$name', `available_quantity` = '$quantity', 
        `description` = '$desc' WHERE 
        `material`.`id` = $id ";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            header("Location:./materials.php?message=Material Successfully Updated!");
        } else {
            header("Location:./updateMaterial.php?message=Unable To Update Material!");
        }
    }
}






   
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "SELECT * FROM material where id =$id";
    $result = mysqli_query($conn,$sql);
    if($result ->num_rows >0){
        $row = mysqli_fetch_assoc($result);
        
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
                    <?php if (isset($_GET['message'])) { ?>
                        <div class="message">
                            <h5>
                                <p class="error"><?php echo $_GET['message']; ?></p>
                            </h5>
                            
                        </div>
                    <?php } ?>
                    <!-- here -->

                    <div class="row">
                    <div class="col-md-8">
                            <div class="col-md-10">
                                <div class="col-md-8">
                                <h3>Material Update Form</h3>
                                <form role="form" action="" method="POST">

                                    <!-- MaterialName -->
                                    <div class="form-group">

                                        <input class="form-control" name="name" placeholder="Material Name <?php echo $row['name'] ?>" />

                                    </div>
                                
                                    <!-- Available Quantity -->
                                    <div class="form-group">

                                        <input class="form-control" type="number" min="1" name="quantity" placeholder="Availabel Quantity  <?php echo $row['available_quantity']?>" />

                                    </div>
                                    <!-- End of AvailableQuantity -->
                                    <!-- Select Owener -->
                                    <div class="form-group">

                                        <input class="form-control" type="hidden" name="id" value="<?php echo $row['id'] ?>" />

                                    </div>
                                    <!-- End Owner -->
                                    <!-- Description -->
                                    <div class="form-group">

                                        <textarea class="form-control" name="desc" placeholder="<?php echo $row['description'] ?>"></textarea>

                                    </div>
                                    <!-- Description -->

                                    <button type="submit" name="update_material" class="btn btn-success btn-lg">Update Material</button>

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
<?php } else{
    header("Location:../login.php?error=Trying to Access Unaoutorized Page!");
}
    ?>