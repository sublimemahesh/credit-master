<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/auth.php');

//check user level
$USERS = new User($_SESSION['id']);
$DEFAULTDATA = new DefaultData(NULL);
$DEFAULTDATA->checkUserLevelAccess('1,2,3', $USERS->user_level);

$id = '';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

$USER = new User($id);
?> 
﻿<!DOCTYPE html>
<html> 
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <title>Edit Users || Credit Master</title>
        <link rel="icon" href="favicon.ico" type="image/x-icon">
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
        <link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
        <link href="plugins/node-waves/waves.css" rel="stylesheet" />
        <link href="plugins/animate-css/animate.css" rel="stylesheet" />
        <link href="plugins/sweetalert/sweetalert.css" rel="stylesheet" />
        <link href="css/style.css" rel="stylesheet">
        <link href="css/themes/all-themes.css" rel="stylesheet" />
        <!-- Bootstrap Spinner Css -->
        <link href="plugins/jquery-spinner/css/bootstrap-spinner.css" rel="stylesheet">
        <link href="css/materialize.css" rel="stylesheet" type="text/css"/>
    </head>

    <body class="theme-red">
        <?php
        include './navigation-and-header.php';
        ?>

        <section class="content">
            <div class="container-fluid"> 
                <?php
                $vali = new Validator();
                $vali->show_message();
                ?>
                <!-- Vertical Layout -->
                <div class="card">
                    <div class="header">
                        <h2>Edit Collector: <?php echo $USER->name; ?></h2>
                        <ul class="header-dropdown">
                            <li class="">
                                <a href="manage-collectors.php">
                                    <i class="material-icons">list</i> 
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="body row">
                        <form class=" col-sm-9 col-md-9" method="post" action="post-and-get/users.php" enctype="multipart/form-data" id="user"> 
                            <div class="row clearfix">
                                <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                    <label for="name">Name</label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 padd-bottom">
                                    <div class="form-group">
                                        <div class="form-line p-top ">
                                            <label for="name" class="hidden-lg hidden-md">Name</label>
                                            <input type="text" id="name" name="name" value="<?php echo $USER->name; ?>" class="form-control" placeholder="Enter the name"autocomplete="off" required="TRUE">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                    <label for="profile_picture">Profile Picture</label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 padd-bottom">
                                    <div class="form-group">
                                        <div class="form-line p-top ">
                                            <label for="profile_picture" class="hidden-lg hidden-md">Profile Picture</label> 
                                            <input type="file" id="profile_picture" class="form-control" name="profile_picture">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                    <label for="nic_number">NIC Number</label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 padd-bottom">
                                    <div class="form-group">
                                        <div class="form-line p-top ">
                                            <label for="nic_number" class="hidden-lg hidden-md">NIC Number</label>
                                            <input type="text" id="nic_number" value="<?php echo $USER->nic_number; ?>" name="nic_number" class="form-control" placeholder="Enter NIC Number" autocomplete="off" required="TRUE">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                    <label for="nic_photo_front">NIC Photos</label>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 padd-bottom">
                                    <div class="form-group">
                                        <div class="form-line p-top ">
                                            <label for="nic_photo_front" class="hidden-lg hidden-md">NIC Front Photo</label> 
                                            <input type="file" id="nic_photo_front" class="form-control" name="nic_photo_front">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 padd-bottom">
                                    <div class="form-group">
                                        <div class="form-line p-top ">
                                            <label for="nic_photo_back" class="hidden-lg hidden-md">NIC Back Photo</label> 
                                            <input type="file" id="nic_photo_back" class="form-control" name="nic_photo_back">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                    <label for="address">Address</label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 padd-bottom">
                                    <div class="form-group">
                                        <div class="form-line p-top ">
                                            <label for="address" class="hidden-lg hidden-md">Address</label>
                                            <input type="text" id="address" name="address" value="<?php echo $USER->address; ?>"  class="form-control" placeholder="Enter Address" autocomplete="off" required="TRUE">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                    <label for="phone">Phone Number</label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 padd-bottom">
                                    <div class="form-group">
                                        <div class="form-line p-top ">
                                            <label for="phone" class="hidden-lg hidden-md">Phone Number</label>
                                            <input type="tel" id="phone" name="phone" value="<?php echo $USER->phone; ?>" class="form-control" placeholder="Enter Phone Number" autocomplete="off" required="TRUE">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                    <label for="email">Email</label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 padd-bottom">
                                    <div class="form-group">
                                        <div class="form-line p-top ">
                                            <label for="email" class="hidden-lg hidden-md">Email</label>
                                            <input type="email" id="email" name="email" value="<?php echo $USER->email; ?>" class="form-control" placeholder="Enter your email" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                    <label for="username">Username</label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 padd-bottom">
                                    <div class="form-group">
                                        <div class="form-line p-top ">
                                            <label for="Username" class="hidden-lg hidden-md">Username</label>
                                            <input type="text" id="username" value="<?php echo $USER->username; ?>" class="form-control" placeholder="Enter your username"  name="username" autocomplete="off" required="TRUE">
                                        </div>
                                    </div>
                                </div>
                            </div> 
                            <div class="row clearfix">
                                <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                    <label for="password">Password</label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 padd-bottom">
                                    <div class="form-group">
                                        <div class="form-line p-top ">
                                            <label for="password" class="hidden-lg hidden-md">Password</label>
                                            <input type="password" id="password" class="form-control" placeholder="Enter password"  name="password" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                            </div>  
                            <div class="row clearfix">
                                <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">

                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 padd-bottom"> 
                                    <div class="form-group">
                                        <div class=" p-top ">
                                            <?php
                                            $checked = '';
                                            if ($USER->isActive == 1) {
                                                $checked = 'checked = "TRUE"';
                                            }
                                            ?>
                                            <input class="filled-in chk-col-pink" type="checkbox" name="isActive" value="1" id="rememberme" <?php echo $checked; ?> >
                                            <label for="rememberme" id="lable-active">Activate</label>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                            <div class="row clearfix">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5">  
                                </div>  
                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7 mar-gin">
                                    <input type="hidden" id="authToken" value="<?php echo $_SESSION["authToken"]; ?>" name="authToken"/>
                                    <input type="hidden" id="user_level" name="user_level" value="2">
                                    <input type="hidden" id="user_id" name="user_id" value="<?php echo $USER->id; ?>">
                                    <input type="hidden" id="image_name" name="image_name" value="<?php echo $USER->image_name; ?>">
                                    <input type="hidden" id="nic_photo_front" name="nic_photo_front" value="<?php echo $USER->nic_photo_front; ?>">
                                    <input type="hidden" id="nic_photo_back" name="nic_photo_back" value="<?php echo $USER->nic_photo_back; ?>">
                                    <button type="submit" class="btn btn-primary m-t-15 waves-effect" name="update" value="submit" id="btnSubmit">Save Details</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </section>

        <script src="plugins/jquery/jquery.min.js"></script>
        <script src="plugins/bootstrap/js/bootstrap.js"></script> 
        <script src="plugins/jquery-slimscroll/jquery.slimscroll.js"></script>
        <script src="plugins/node-waves/waves.js"></script>
        <script src="plugins/jquery-spinner/js/jquery.spinner.js"></script>
        <script src="js/admin.js"></script>
        <script src="js/demo.js"></script> 
    </body>

</html>