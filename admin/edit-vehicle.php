<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/auth.php');

$id = '';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
$VEHICLE = new Vehicle($id);
?> 
﻿<!DOCTYPE html>
<html> 
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <title>Edit vehicle || Admin || Taxi galle</title>

        <!-- Favicon-->
        <link rel="icon" href="favicon.ico" type="image/x-icon">
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
        <link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
        <link href="plugins/node-waves/waves.css" rel="stylesheet" />
        <link href="plugins/animate-css/animate.css" rel="stylesheet" />
        <link href="plugins/sweetalert/sweetalert.css" rel="stylesheet" />
        <link href="css/style.css" rel="stylesheet">
        <link href="css/themes/all-themes.css" rel="stylesheet" />
    </head>

    <body class="theme-red">
        <?php
        include './navigation-and-header.php';
        ?>

        <section class="content">
            <?php
            $vali = new Validator();

            $vali->show_message();
            ?>
            <div class="container-fluid"> 
                <!-- Body Copy -->

                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h2>
                                    Edit Vehicle
                                </h2>
                                <ul class="header-dropdown">
                                    <li class="">
                                        <a href="manage-vehicle.php">
                                            <i class="material-icons">list</i> 
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="body row">
                                <form class="form-horizontal col-sm-9 col-md-12" method="post" action="post-and-get/vehicle.php" enctype="multipart/form-data"> 

                                    <!--vehicle name-->
                                    <div class="row clearfix">
                                        <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                            <label for="Vehicle Type">Vehicle Type</label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <label for="Vehicle Type" class="hidden-lg hidden-md">Vehicle Type</label>
                                                    <?php
                                                    $VEHICLE_TYPES= new Vehicle_type($VEHICLE->type);
                                                        $VEHICLE_NAME    = $VEHICLE_TYPES->name;                                                            
                                                    ?>
                                                    <input type="text" id="type" class="form-control" placeholder="Enter Vehicle Name" autocomplete="off" name="type" value="<?php echo $VEHICLE_NAME;?>" disabled="true">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--Model_and_Brand-->
                                    <div class="row clearfix">
                                        <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                            <label for="Model_and_Brand">Model And Brand</label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <label for="Model_and_Brand" class="hidden-lg hidden-md">Model And Brand</label>
                                                    <input type="text" id="type" class="form-control" placeholder="Enter Model_and_Brand" autocomplete="off" name="model_and_brand" value="<?php echo $VEHICLE->model_and_brand; ?>" >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--REg -number-->
                                    <div class="row clearfix">
                                        <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                            <label for="Reg Number">Reg Number</label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <label for="Reg Number" class="hidden-lg hidden-md">Reg Number</label>
                                                    <input type="text" id="type" class="form-control" placeholder="Enter Reg Number" autocomplete="off" name="reg_number" value="<?php echo $VEHICLE->reg_number; ?>" >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--email-->
                                    <div class="row clearfix">
                                        <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                            <label for="Email">Email</label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <label for="Email" class="hidden-lg hidden-md">Email</label>
                                                    <input type="text" id="type" class="form-control" placeholder="Enter Email" autocomplete="off" name="email" value="<?php echo $VEHICLE->email; ?>" >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--Contact Number-->
                                    <div class="row clearfix">
                                        <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                            <label for="Contact Number">Contact Number</label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <label for="Contact Number" class="hidden-lg hidden-md">Contact Number</label>
                                                    <input type="text" id="type" class="form-control" placeholder="Enter Contact Number" autocomplete="off" name="contact_number" value="<?php echo $VEHICLE->contact_number; ?>" >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--Contact Number-->
                                    <div class="row clearfix">
                                        <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                            <label for="Vehicle Image">Vehicle Image</label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <label for="Vehicle Image" class="hidden-lg hidden-md">Vehicle Image</label>
                                                    <input type="file" id="file" class="form-control" placeholder="Enter Contact Number" autocomplete="off" name="image_name" value="<?php echo $VEHICLE->image_name; ?>" >
                                                    <img src="../upload/vehicle/<?php echo $VEHICLE->image_name?>" id="image" class="view-edit-img img img-responsive img-thumbnail" name="image" alt="old image">

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row clearfix">
                                        <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-4">
                                            <input type="hidden" id="type" value="<?php echo $VEHICLE->type; ?>" name="type"/>
                                            <input type="hidden" id="id" value="<?php echo $VEHICLE->id; ?>" name="id"/>
                                            <input type="hidden" id="image" value="<?php echo $VEHICLE->image_name; ?>" name="oldImageName"/>                                            
                                            <button type="submit" class="btn btn-primary m-t-15 waves-effect" name="edit-vehicle" value="submit">Save Changes</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <!-- Jquery Core Js -->
        <script src="plugins/jquery/jquery.min.js"></script>
        <script src="plugins/bootstrap/js/bootstrap.js"></script> 
        <script src="plugins/jquery-slimscroll/jquery.slimscroll.js"></script>
        <script src="plugins/node-waves/waves.js"></script>
        <script src="plugins/jquery-spinner/js/jquery.spinner.js"></script>
        <script src="js/admin.js"></script>
        <script src="js/demo.js"></script>
        <script src="js/add-new-ad.js" type="text/javascript"></script>

    </body>

</html>