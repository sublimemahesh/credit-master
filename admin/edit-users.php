﻿<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/auth.php');

$id = '';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
$USERS = new User($id);
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

                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h2>
                                    Edit Users
                                </h2>
                                <ul class="header-dropdown">
                                    <li class="">
                                        <a href="view-active-users.php">
                                            <i class="material-icons">list</i> 
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="body row">
                                <form class=" col-sm-9 col-md-9" method="post" action="post-and-get/users.php" enctype="multipart/form-data"> 

                                    <div class="row clearfix">
                                        <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                            <label for="name">Name</label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 padd-bottom">
                                            <div class="form-group">
                                                <div class="form-line p-top ">
                                                    <label for="name" class="hidden-lg hidden-md">Name</label>
                                                    <input type="text" id="name" class="form-control" placeholder="Enter your name" value="<?php echo $USERS->name; ?>"  name="name"  required="TRUE">
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
                                                    <input type="text" id="username" class="form-control" placeholder="Enter your username" value="<?php echo $USERS->username; ?>" name="user_name" required="TRUE">
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
                                                    <input type="email" id="email" class="form-control" placeholder="Enter your email" value="<?php echo $USERS->email; ?>" name="email" required="TRUE">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row clearfix ">
                                        <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                            <label for="user_level">User Level</label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 p-bottom">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <label for="user_level" class="hidden-lg hidden-md">User Level</label>
                                                    <select id="user_level" name="user_level" class="form-control" required="TRUE" >

                                                        <?php
                                                        if ($USERS->user_level == 1) {
                                                            ?>                                                            
                                                            <option value="1" selected="">Level 1</option> 
                                                            <option value="2">Level 2</option> 
                                                            <option value="3">Level 3</option> 
                                                            <?php
                                                        } elseif ($USERS->user_level == 2) {
                                                            ?>
                                                            <option value="1" >Level 1</option> 
                                                            <option value="2" selected="">Level 2</option> 
                                                            <option value="3">Level 3</option> 
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <option value=" ">--Please Select User Level--</option> 
                                                            <option value="1" >Level 1</option> 
                                                            <option value="2">Level 2</option> 
                                                            <option value="3" selected="">Level 3</option> 
                                                            <?php
                                                        }
                                                        ?>
                                                    </select> 
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
                                                    <input type="file" id="picture" class="form-control" name="image_name" value="<?php echo $USERS->image_name ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row clearfix">
                                        <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">

                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 padd-bottom">
                                            <div class="form-group">
                                                <div class=" p-top ">
                                                    <input class="filled-in chk-col-pink" type="checkbox" <?php
                                                    if ($USERS->isActive == 1) {
                                                        echo 'checked';
                                                    }
                                                    ?> name="is_active" value="1" id="rememberme" />
                                                    <label for="rememberme" id="lable-active">Activate</label> </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row clearfix">
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5">  
                                        </div>  
                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7 mar-gin">
                                            <input type="hidden" id="oldImageName" value="<?php echo $USERS->image_name; ?>" name="oldImageName"/>
                                            <input type="hidden" id="id" value="<?php echo $USERS->id; ?>" name="id"/>

                                            <button type="submit" class="btn btn-primary m-t-15 waves-effect" name="update" value="submit">Save Changes</button>
                                        </div>
                                    </div>
                                </form>
                                <div class="col-sm-3 col-md-3">
                                    <img src="../upload/users/<?php echo $USERS->image_name ?>" class="img img-responsive img-thumbnail"/>
                                </div>
                            </div>
                        </div>
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