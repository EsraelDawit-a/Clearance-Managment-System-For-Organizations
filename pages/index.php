<?php

include "../db.inc.php";

session_start();

if (!isset($_SESSION['id'])) {
    header("Location:../login.php?error=Login Here First!");
} else {

     if(isset($_POST['approve'])){
         print_r("approve");

         $item = $_POST['id'];
         $sql = "UPDATE `clearance_list` SET `approved` = '1' WHERE `clearance_list`.`id` = $item";
         $result = mysqli_query($conn,$sql);
         if($result){
             header("Location:./index.php?error=Successfully Aproved");
         }
         else{
            header("Location:./index.php?error=Unabel to Approve Sorry!");
         }
     }

     if(isset($_POST['delete'])){
        print_r("delete");

        $item = $_POST['id'];
        $sql = "DELETE FROM `clearance_list` WHERE `clearance_list`.`id` = $item";
        $result = mysqli_query($conn,$sql);
        if($result){
            header("Location:./index.php?error=Successfully Deleted");
        }
        else{
           header("Location:./index.php?error=Unabel To delete Item Sorry!");
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
            .message{
                width: 100%;
                height: 70px;
                color: #fff;
                font-family: monospace;
                background-color: rgb(55, 167, 111);
            }
            .message h5{
                padding: 10px 25vw;
                font-size: 130px !important;
                font-weight: 700;
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
                            <a class="active-menu" href="index.html"><i class="fa fa-dashboard fa-3x"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="ui.html"><i class="fa fa-desktop fa-3x"></i> UI Elements</a>
                        </li>
                        <li>
                            <a href="tab-panel.html"><i class="fa fa-qrcode fa-3x"></i> Tabs & Panels</a>
                        </li>
                        <li>
                            <a href="chart.html"><i class="fa fa-bar-chart-o fa-3x"></i> Morris Charts</a>
                        </li>
                        <li>
                            <a href="table.html"><i class="fa fa-table fa-3x"></i> Table Examples</a>
                        </li>
                        <li>
                            <a href="form.html"><i class="fa fa-edit fa-3x"></i> Forms </a>
                        </li>


                        <li>
                            <a href="#"><i class="fa fa-sitemap fa-3x"></i> Multi-Level Dropdown<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="#">Second Level Link</a>
                                </li>
                                <li>
                                    <a href="#">Second Level Link</a>
                                </li>
                                <li>
                                    <a href="#">Second Level Link<span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="#">Third Level Link</a>
                                        </li>
                                        <li>
                                            <a href="#">Third Level Link</a>
                                        </li>
                                        <li>
                                            <a href="#">Third Level Link</a>
                                        </li>

                                    </ul>

                                </li>
                            </ul>
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

                    <?php if (isset($_GET['error'])) { ?>
					<div class="message">
						<h5>
							<p class="error"><?php echo $_GET['error']; ?></p>
				</h5>
					</div>
				<?php } ?>
                    <!-- /. ROW  -->
                    <hr />
                    <div class="row">
                        <div class="col-md-3 col-sm-6 col-xs-6">
                            <div class="panel panel-back noti-box">
                                <span class="icon-box bg-color-red set-icon">
                                    <i class="fa fa-envelope-o"></i>
                                </span>
                                <div class="text-box">
                                    <p class="main-text">120 Review</p>
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
                                    <p class="main-text">30 Clearance</p>
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
                                    <p class="main-text">20 approved</p>
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
                                    <p class="main-text">3 Requests</p>
                                    <p class="text-muted">Total</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /. ROW  -->
                    <hr />
                    <div class="row">
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="panel panel-back noti-box">
                                <span class="icon-box bg-color-blue">
                                    <i class="fa fa-warning"></i>
                                </span>
                                <div class="text-box">
                                    <p class="main-text">52 Clearances are Available </p>
                                    <p class="text-muted">Add Clearances and View Details Here</p>
                                    <button class="btn btn-primary"><i class="fa fa-edit "></i> Add Clerances</button> <button class="btn btn-warning"><i class="fa fa-pencil"></i> View Clerance List</button></td>

                                    <hr />
                                    <p class="text-muted">
                                        <span class="text-muted color-bottom-txt"><i class="fa fa-edit"></i>
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit gthn.
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit gthn.
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-3 col-sm-12 col-xs-12">
                            <div class="panel back-dash">
                                <i class="fa fa-dashboard fa-3x"></i><strong> &nbsp; SPEED</strong>
                                <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing sit ametsit amet elit ftr. Lorem ipsum dolor sit amet, consectetur adipiscing elit. </p>
                            </div>

                        </div>
                        <div class="col-md-3 col-sm-12 col-xs-12 ">
                            <div class="panel ">
                                <div class="main-temp-back">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-xs-6"> <i class="fa fa-cloud fa-3x"></i> Newyork City </div>
                                            <div class="col-xs-6">
                                                <div class="text-temp"> 10° </div>
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
                                    <p class="main-text">Display</p>
                                    <p class="text-muted">Looking Good</p>
                                </div>
                            </div>

                        </div>

                    </div>
                    <!-- /. ROW  -->
                    <div class="row col-md-10 col-sm-12 col-xs-12">

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
                                         $result = mysqli_query($conn,$sql);
                                        //  print_r($result);
                                         if($result -> num_rows >0)
                                         { 
                                             $count =0;
                                            // print_r($result);
                                            while($row = mysqli_fetch_assoc($result)){
                                                $owner = $row['clearance_owner'];
                                               
                                                
                                                $count += 1;
                                                $sql2 = "SELECT * FROM `users` where id = $owner ";
                                                $result2 = mysqli_query($conn,$sql2);
                                                
                                                $data = mysqli_fetch_assoc($result2); 

                                         
                                        ?>
                                        <tr>
                                            <td><?php echo $count; ?></td>
                                            <td><?php echo $row['name'] ?></td>
                                            <td><?php echo $data['full_name'] ?></td>
                                            <td><?php echo $_SESSION['office'].' office' ?></td>
                                            <td><?php echo $row['date_created'] ?></td>
                                            <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                                            <td><button class="btn btn-primary"><i class="fa fa-edit "></i> View Detail</button> <button name="approve" type="submit" class="btn btn-warning"><i class="fa fa-pencil"></i> Approve</button> <button name="delete" type="submit" class="btn btn-danger"><i class="fa fa-pencil"></i> Delete</button></td>
                                        </tr>
                                        <?php }} ?>
                                       
                                       </form>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    </div>
                    </div>

                </div>
                <!-- /. ROW  -->
                <div class="row">
                    <div class="col-md-3 col-sm-12 col-xs-12">
                        <div class="panel panel-primary text-center no-boder bg-color-green">
                            <div class="panel-body">
                                <i class="fa fa-comments-o fa-5x"></i>
                                <h4>200 New Comments </h4>
                                <h4>See All Comments </h4>
                            </div>
                            <div class="panel-footer back-footer-green">
                                <i class="fa fa-rocket fa-5x"></i>
                                Lorem ipsum dolor sit amet sit sit, consectetur adipiscing elitsit sit gthn ipsum dolor sit amet ipsum dolor sit amet

                            </div>
                        </div>
                    </div>
                    <div class="col-md-9 col-sm-12 col-xs-12">

                    <div class="panel panel-default">
                    <div class="panel-heading">
                                Approved Clerances
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Username</th>
                                            <th>User No.</th>
                                            <th>Change Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Mark</td>
                                            <td>Otto</td>
                                            <td>@mdo</td>
                                            <td>100090</td>
                                            <td><button class="btn btn-primary"><i class="fa fa-edit "></i> View Detail</button> <button class="btn btn-warning"><i class="fa fa-pencil"></i> Completed</button></td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Jacob</td>
                                            <td>Thornton</td>
                                            <td>@fat</td>
                                            <td>100090</td>
                                            <td><button class="btn btn-primary"><i class="fa fa-edit "></i> View Detail</button> <button class="btn btn-warning"><i class="fa fa-pencil"></i> Completed</button></td>

                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Larry</td>
                                            <td>the Bird</td>
                                            <td>@twitter</td>
                                            <td>100090</td>
                                            <td><button class="btn btn-primary"><i class="fa fa-edit "></i> View Detail</button> <button class="btn btn-warning"><i class="fa fa-pencil"></i> Completed</button></td>

                                        </tr>
                                        <tr>
                                            <td>1</td>
                                            <td>Mark</td>
                                            <td>Otto</td>
                                            <td>@mdo</td>
                                            <td>100090</td>
                                            <td><button class="btn btn-primary"><i class="fa fa-edit "></i> View Detail</button> <button class="btn btn-warning"><i class="fa fa-pencil"></i> Completed</button></td>

                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Jacob</td>
                                            <td>Thornton</td>
                                            <td>@fat</td>
                                            <td>100090</td>
                                            <td><button class="btn btn-primary"><i class="fa fa-edit "></i> View Detail</button> <button class="btn btn-warning"><i class="fa fa-pencil"></i> Completed</button></td>

                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Larry</td>
                                            <td>the Bird</td>
                                            <td>@twitter</td>
                                            <td>100090</td>
                                            <td><button class="btn btn-primary"><i class="fa fa-edit "></i> View Detail</button> <button class="btn btn-warning"><i class="fa fa-pencil"></i> Completed</button></td>

                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    </div>
                    </div>
                </div>
                <!-- /. ROW  -->
                <div class="row">
                    <div class="col-md-6 col-sm-12 col-xs-12">

                        <div class="chat-panel panel panel-default chat-boder chat-panel-head">
                            <div class="panel-heading">
                                <i class="fa fa-comments fa-fw"></i>
                                Some Feedbacks From users For You
                                <div class="btn-group pull-right">
                                    <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                        <i class="fa fa-chevron-down"></i>
                                    </button>
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
                                    <li class="left clearfix">
                                        <span class="chat-img pull-left">
                                            <img src="../assets/img/1.png" alt="User" class="img-circle" />
                                        </span>
                                        <div class="chat-body">
                                            <strong>Jack Sparrow</strong>
                                            <small class="pull-right text-muted">
                                                <i class="fa fa-clock-o fa-fw"></i>12 mins ago
                                            </small>
                                            <p>
                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.
                                            </p>
                                        </div>
                                    </li>
                                    <li class="right clearfix">
                                        <span class="chat-img pull-right">

                                            <img src="../img/2.png" alt="User" class="img-circle" />
                                        </span>
                                        <div class="chat-body clearfix">

                                            <small class=" text-muted">
                                                <i class="fa fa-clock-o fa-fw"></i>13 mins ago</small>
                                            <strong class="pull-right">Jhonson Deed</strong>

                                            <p>
                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.
                                            </p>
                                        </div>
                                    </li>
                                    <li class="left clearfix">
                                        <span class="chat-img pull-left">
                                            <img src="../img/3.png" alt="User" class="img-circle" />
                                        </span>
                                        <div class="chat-body clearfix">

                                            <strong>Jack Sparrow</strong>
                                            <small class="pull-right text-muted">
                                                <i class="fa fa-clock-o fa-fw"></i>14 mins ago</small>

                                            <p>
                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.
                                            </p>
                                        </div>
                                    </li>
                                    <li class="right clearfix">
                                        <span class="chat-img pull-right">
                                            <img src="../img/4.png" alt="User" class="img-circle" />
                                        </span>
                                        <div class="chat-body clearfix">

                                            <small class=" text-muted">
                                                <i class="fa fa-clock-o fa-fw"></i>15 mins ago</small>
                                            <strong class="pull-right">Jhonson Deed</strong>

                                            <p>
                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.
                                            </p>
                                        </div>
                                    </li>
                                    <li class="left clearfix">
                                        <span class="chat-img pull-left">
                                            <img src="../img/1.png" alt="User" class="img-circle" />
                                        </span>
                                        <div class="chat-body">
                                            <strong>Jack Sparrow</strong>
                                            <small class="pull-right text-muted">
                                                <i class="fa fa-clock-o fa-fw"></i>12 mins ago
                                            </small>
                                            <p>
                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.
                                            </p>
                                        </div>
                                    </li>
                                    <li class="right clearfix">
                                        <span class="chat-img pull-right">
                                            <img src="../img/2.png" alt="User" class="img-circle" />
                                        </span>
                                        <div class="chat-body clearfix">

                                            <small class=" text-muted">
                                                <i class="fa fa-clock-o fa-fw"></i>13 mins ago</small>
                                            <strong class="pull-right">Jhonson Deed</strong>

                                            <p>
                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.
                                            </p>
                                        </div>
                                    </li>
                                </ul>
                            </div>

                            <div class="panel-footer">
                                <div class="input-group">
                                    <input id="btn-input" type="text" class="form-control input-sm" placeholder="Type your message to send..." />
                                    <span class="input-group-btn">
                                        <button class="btn btn-warning btn-sm" id="btn-chat">
                                            Send
                                        </button>
                                    </span>
                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        
                    <div class="panel panel-default">
                    <div class="panel-heading">
                                Clerance Requests
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Username</th>
                                            <th>User No.</th>
                                            <th>Change Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Mark</td>
                                            <td>Otto</td>
                                            <td>@mdo</td>
                                            <td>100090</td>
                                            <td><button class="btn btn-primary"><i class="fa fa-edit "></i> View Detail</button> </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Jacob</td>
                                            <td>Thornton</td>
                                            <td>@fat</td>
                                            <td>100090</td>
                                            <td><button class="btn btn-primary"><i class="fa fa-edit "></i> View Detail</button> </td>

                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Larry</td>
                                            <td>the Bird</td>
                                            <td>@twitter</td>
                                            <td>100090</td>
                                            <td><button class="btn btn-primary"><i class="fa fa-edit "></i> View Detail</button> </td>

                                        </tr>
                                        <tr>
                                            <td>1</td>
                                            <td>Mark</td>
                                            <td>Otto</td>
                                            <td>@mdo</td>
                                            <td>100090</td>
                                            <td><button class="btn btn-primary"><i class="fa fa-edit "></i> View Detail</button> </td>

                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Jacob</td>
                                            <td>Thornton</td>
                                            <td>@fat</td>
                                            <td>100090</td>
                                            <td><button class="btn btn-primary"><i class="fa fa-edit "></i> View Detail</button> </td>

                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Larry</td>
                                            <td>the Bird</td>
                                            <td>@twitter</td>
                                            <td>100090</td>
                                            <td><button class="btn btn-primary"><i class="fa fa-edit "></i> View Detail</button> </td>

                                        </tr>

                                    </tbody>
                                </table>
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