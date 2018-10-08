<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/auth.php');

$id = '';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
$VEHICLE_PHOTO = new VehiclePhotos($id);
?> 
﻿<!DOCTYPE html>
<html> 
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <title>Edit City || Admin || Support Lanka</title>

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
        include '/navigation-and-header.php';
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
                                    Edit Vehicle Photos
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
                                <form class="form-horizontal col-sm-9 col-md-12" method="post" action="post-and-get/vehicle-photos.php" enctype="multipart/form-data"> 


                                    <div class="row clearfix">
                                        <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                            <label for="caption">Caption</label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <label for="caption" class="hidden-lg hidden-md">Caption</label>
                                                    <input type="text" id="caption" class="form-control" placeholder="Enter Caption" autocomplete="off" name="caption" value="<?php echo $VEHICLE_PHOTO->caption; ?>" >
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row clearfix">
                                        <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                            <label for="Vehicle Image">Vehicle Image</label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <label for="Vehicle Image" class="hidden-lg hidden-md">Vehicle Image</label>
                                                    <input type="file" id="file" class="form-control" placeholder="Enter Contact Number" autocomplete="off" name="image_name" value="<?php echo $VEHICLE_PHOTO->image_name; ?>" >
                                                    <img src="../upload/vehicle/gallery/thumb/<?php echo $VEHICLE_PHOTO->image_name ?>" id="image" class="view-edit-img img img-responsive img-thumbnail" name="image" alt="old image">

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row clearfix">
                                        <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-4">
                                            <input type="hidden" id="id" value="<?php echo $VEHICLE_PHOTO->id; ?>" name="id"/>
                                            <input type="hidden" id="image" value="<?php echo $VEHICLE_PHOTO->image_name; ?>" name="oldImageName"/>                                            


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