<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . './auth.php');

$id = '';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
$VEHICLE = new VehiclePhotos($id)
?> 

<!DOCTYPE html>
<html> 
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

        <title>Add new Vehicle || Admin ||</title>
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
        <!-- Bootstrap Spinner Css -->
        <link href="plugins/jquery-spinner/css/bootstrap-spinner.css" rel="stylesheet">
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
                        <h2>Add Vehicle</h2>
                        <ul class="header-dropdown">
                            <li class="">
                                <a href="manage-vehicle.php">
                                    <i class="material-icons">list</i> 
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        <form class="" action="post-and-get/vehicle-photos.php" method="post"  enctype="multipart/form-data"> 


                            <!--vehicle Model_and_Brand-->
                            <div class="row">
                                <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                    <label for="caption">caption</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 p-bottom">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="caption" class="hidden-lg hidden-md">caption </label>
                                            <input type="text" id="caption" class="form-control" placeholder="Enter caption " autocomplete="off" name="caption">
                                        </div>
                                    </div>
                                </div>
                            </div> 
                            <!--Reg_number-->


                            <!--Profile Picture-->
                            <div class="row clearfix">
                                <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                    <label for="Vehicle_Image">Vehicle Images</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="Vehicle_Image Image" class="hidden-lg hidden-md">Vehicle Images</label>
                                            <input type="file" id="Vehicle_Image" class="form-control" name="image" >
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--Profile Picture -->

                            <!--Add Vehicle-->
                            <div class="row clearfix">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5">  

                                </div>  
                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                    <input type="hidden" id="vehicle" name="vehicle" value="<?php echo $VEHICLE->id ?>"/>
                                    <button class="btn btn-primary m-t-15 waves-effect  pull-left" type="submit" name="add-vehicle-photo">Add Photos</button>
                                    <div class=" text-danger btn-padding pull-left error-mess" id="message" ></div> 
                                </div>
                            </div> 
                        </form> 
                        <div class="row">
                        </div>
                        <hr/>
                        <div class="row clearfix">
                            <?php
                            $VEHICLE_PHOTOS = VehiclePhotos::GetVehiclePhotosById($id);
                            if (count($VEHICLE_PHOTOS) > 0) {
                                foreach ($VEHICLE_PHOTOS as $key => $vehicle_photos) {
                                    ?>
                                    <div class="col-md-3"  id="row_<?php echo $vehicle_photos['id']; ?>">
                                        <div class="photo-img-container">
                                            <img src="../upload/vehicle/gallery/thumb/<?php echo $vehicle_photos['image_name']; ?>" class="img-responsive ">
                                        </div>
                                        <div class="img-caption">
                                            <p class="maxlinetitle"><?php echo $vehicle_photos['caption']; ?></p>
                                            <div class="d">
                                                <a href="#" class="delete-vehicle-photo" data-id="<?php echo $vehicle_photos['id']; ?>"> <button class="glyphicon glyphicon-trash delete-btn"></button></a>
                                                <a href="edit-vehicle-photo.php?id=<?php echo $vehicle_photos['id']; ?>"> <button class="glyphicon glyphicon-pencil edit-btn"></button></a>
                                                <a href="arrange-vehicle-photos.php?id=<?php echo $id; ?>">  <button class="glyphicon glyphicon-random arrange-btn"></button></a>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                            } else {
                                ?> 
                                <b style="padding-left: 15px;">No Vehicle photos in the database.</b> 
                            <?php } ?> 

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
        <script src="tinymce/js/tinymce/tinymce.min.js"></script>
        <script src="plugins/sweetalert/sweetalert.min.js"></script>
        <script src="delete/js/vehicle-photos.js" type="text/javascript"></script>


        <script>
            tinymce.init({
                selector: "#about_me",
                // ===========================================
                // INCLUDE THE PLUGIN
                // ===========================================

                plugins: [
                    "advlist autolink lists link image charmap print preview anchor",
                    "searchreplace visualblocks code fullscreen",
                    "insertdatetime media table contextmenu paste"
                ],
                // ===========================================
                // PUT PLUGIN'S BUTTON on the toolbar
                // ===========================================

                toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image jbimages",
                // ===========================================
                // SET RELATIVE_URLS to FALSE (This is required for images to display properly)
                // ===========================================

                relative_urls: false

            });
        </script>
    </body>

</html>