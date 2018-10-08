<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/auth.php');

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
        <title>Edit Profile -  Sublime Web Manager</title>
        <link rel="icon" href="favicon.ico" type="image/x-icon">
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
        <link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
        <link href="plugins/node-waves/waves.css" rel="stylesheet" />
        <link href="plugins/animate-css/animate.css" rel="stylesheet" />
        <link href="css/style.css" rel="stylesheet">
        <link href="css/themes/all-themes.css" rel="stylesheet" />
    </head>

    <body class="theme-red">
        <?php
        include './navigation-and-header.php';
        ?>

        <section class="content">
            <div class="container-fluid"> 
                <?php
                if (isset($_GET['message'])) {

                    $MESSAGE = New Message($_GET['message']);
                    ?>
                    <div class="alert alert-<?php echo $MESSAGE->status; ?>" role = "alert">
                        <?php echo $MESSAGE->description; ?>
                    </div>
                    <?php
                }
                ?>

                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h2>
                                    Edit Your Profile
                                </h2>

                            </div>
                            <div class="body row">
                                <form class=" col-sm-9 col-md-9" method="post" action="post-and-get/edit-profile.php" enctype="multipart/form-data"> 

                                    <div class="row clearfix">
                                        <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                            <label for="name">Name</label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 padd-bottom">
                                            <div class="form-group">
                                                <div class="form-line p-top ">
                                                    <label for="name" class="hidden-lg hidden-md">Name</label>
                                                    <input type="text" id="name" class="form-control" placeholder="Enter your name" value="<?php echo $USER->name; ?>"  name="name"  required="TRUE">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row clearfix">
                                        <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                            <label for="username">Username</label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 padd-bottom">
                                            <div class="form-group">
                                                <div class="form-line p-top ">
                                                    <label for="Username" class="hidden-lg hidden-md">Username</label>
                                                    <input type="text" id="username" class="form-control" placeholder="Enter your username" value="<?php echo $USER->username; ?>" name="username" required="TRUE">
                                                </div>
                                            </div>
                                        </div>
                                    </div> 

                                    <div class="row clearfix">
                                        <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                            <label for="Email">Email</label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 padd-bottom">
                                            <div class="form-group">
                                                <div class="form-line p-top ">
                                                    <label for="Email" class="hidden-lg hidden-md">Email</label>
                                                    <input type="email" id="email" class="form-control" placeholder="Enter your email" value="<?php echo $USER->email; ?>" name="email" required="TRUE">
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row clearfix">
                                        <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                            <label for="picture">Picture</label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 padd-bottom">
                                            <div class="form-group">
                                                <div class="form-line p-top ">
                                                    <label for="picture" class="hidden-lg hidden-md">Picture</label>
                                                    
                                                    <input type="file" id="picture" class="form-control" name="picture">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row clearfix">
                                        <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">

                                            <input type="hidden" id="id" value="<?php echo $USER->id; ?>" name="id"/>
                                            <input type="hidden" id="authToken" value="<?php echo $_SESSION["authToken"]; ?>" name="authToken"/>

                                            <button type="submit" class="btn btn-primary m-t-15 waves-effect" name="submit" value="submit">Save Changes</button>
                                        </div>
                                    </div>
                                </form>
                                <div class="col-sm-3 col-md-3">
                                    <img src="images/profile/<?php echo $USER->id; ?>.jpg" class="img img-responsive img-thumbnail"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <!-- Jquery Core Js -->
        <script src="plugins/jquery/jquery.min.js"></script>

        <!-- Bootstrap Core Js -->
        <script src="plugins/bootstrap/js/bootstrap.js"></script>

        <!-- Select Plugin Js -->
        <script src="plugins/bootstrap-select/js/bootstrap-select.js"></script>

        <!-- Slimscroll Plugin Js -->
        <script src="plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

        <!-- Waves Effect Plugin Js -->
        <script src="plugins/node-waves/waves.js"></script>

        <!-- Custom Js -->
        <script src="js/admin.js"></script>

        <!-- Demo Js -->
        <script src="js/demo.js"></script>
    </body>

</html>