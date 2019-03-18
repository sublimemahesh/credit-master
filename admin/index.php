<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/auth.php');
$USERS = new User($_SESSION['id']);

$LOANS = count(Loan::all());
$CUSTOMER = count(Customer::all());
$CENTER = count(Center::all());
$ROUTE = count(Route::all());
//$COUNT_TOUR = count(TourPackage::all());
//$COUNT_GALLERY = count(AlbumPhoto::getAlbumPhotosById(6));
?> 
<!DOCTYPE html>
<html> 
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=Edge">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <title>Dashbord || Admin || Credit Master</title>
        <!-- Favicon-->
        <link rel="icon" href="favicon.ico" type="image/x-icon">

        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
        <link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
        <link href="plugins/node-waves/waves.css" rel="stylesheet" />
        <link href="plugins/animate-css/animate.css" rel="stylesheet" />
        <link href="plugins/morrisjs/morris.css" rel="stylesheet" />
        <link href="css/style.css" rel="stylesheet">
        <link href="css/themes/all-themes.css" rel="stylesheet" />
    </head>
    <style>
        .list-group a:hover{
            text-decoration: none;
        }
        .list-group-item{
            text-align: center !important;
        }
    </style>
    <body class="theme-red">
        <?php
        if ($USERS->user_level == 1) {
            include './navigation-and-header.php';
        } elseif ($USERS->user_level == 2) {
            include './navigation-and-header_1.php';
        } elseif ($USERS->user_level == 3) {
            include './navigation-and-header_2.php';
        } else {
            
        }
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


                <div class="block-header">
                    <h2>DASHBOARD</h2>
                </div>

                <!-- Widgets -->
                <div class="row clearfix">
                    <a href="index.php">
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box bg-pink hover-expand-effect">
                                <div class="icon">
                                    <i class="material-icons">av_timer</i>
                                </div>
                                <div class="content">
                                    <div class="text"><h4>Dashboard</h4></div>
                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="day-installment.php">
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box bg-cyan hover-expand-effect">
                                <div class="icon">

                                    <i class="material-icons">event_available</i>
                                </div>
                                <div class="content">
                                    <div class="text"><h4> Day Instalment </h4></div>
                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="add-new-postpone-date.php">
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box bg-light-green hover-expand-effect">
                                <div class="icon">
                                    <i class="material-icons">perm_contact_calendar</i>
                                </div>
                                <div class="content">
                                    <div class="text"><h4>Postpone Date</h4></div>

                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="create-city.php">
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box bg-orange hover-expand-effect">
                                <div class="icon">
                                    <i class="material-icons">
                                        room
                                    </i>
                                </div>
                                <div class="content">
                                    <div class="text"><h4>Cities</h4></div>
                                </div>
                            </div>
                        </div>
                    </a>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="card">
                            <div class="header bg-blue-grey">
                                <h2>
                                    LOANS

                                    <small class="pull-right">   
                                        <?php echo $LOANS ?>
                                    </small>
                                </h2>

                            </div>
                            <div class="body">
                                <div class="list-group">
                                    <a href="create-loan.php"><button type="button" class="list-group-item">Add new</button></a>
                                    <a href="manage-loan.php"><button type="button" class="list-group-item">Manage</button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="card">
                            <div class="header bg-blue-grey">
                                <h2>
                                    CUSTOMER
                                    <small class="pull-right"><?php echo $CUSTOMER ?></small>                                    
                                </h2>

                            </div>
                            <div class="body">
                                <div class="list-group">
                                    <a href="add-new-customer.php"><button type="button" class="list-group-item">Add new</button></a>
                                    <a href="manage-customers.php"><button type="button" class="list-group-item">Manage</button></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="card">
                            <div class="header bg-blue-grey">
                                <h2>
                                    CENTER
                                    <small class="pull-right"><?php echo $CENTER ?> </small>
                                </h2>

                            </div>
                            <div class="body">

                                <div class="list-group">
                                    <a href="add-new-center.php"><button type="button" class="list-group-item">Add new</button></a>
                                    <a href="manage-center.php"><button type="button" class="list-group-item">Manage</button></a>

                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="card">
                            <div class="header bg-blue-grey">
                                <h2>
                                    ROUTE
                                    <small class="pull-right"><?php echo $ROUTE ?></small>
                                </h2>

                            </div>
                            <div class="body">
                                <div class="list-group">
                                    <a href="create-route.php"><button type="button" class="list-group-item">Add new</button></a>
                                    <a href="manage-route.php"><button type="button" class="list-group-item">Manage</button></a>
                                </div>
                            </div>
                        </div>
                    </div>



                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h2>
                                    ICONS GUIDE
                                </h2>
                                <ul class="header-dropdown m-r--5">
                                    <li class="dropdown">
                                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                            <i class="material-icons">more_vert</i>
                                        </a>
                                        <ul class="dropdown-menu pull-right">
                                            <li><a href="javascript:void(0);">Action</a></li>
                                            <li><a href="javascript:void(0);">Another action</a></li>
                                            <li><a href="javascript:void(0);">Something else here</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                            <div class="body">
                                <div class="row clearfix demo-icon-container">
                                    <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                        <button class="glyphicon glyphicon-trash delete-btn"></button> <span class="icon-name">Delete</span>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                        <button class="glyphicon glyphicon-pencil edit-btn"></button> <span class="icon-name">Edit</span>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                        <button class="glyphicon glyphicon-random arrange-btn"></button> <span class="icon-name">Arrange</span> 
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                        <button class="glyphicon glyphicon-info-sign btn btn-info"></button> <span class="icon-name">Infomation</span>
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

        <!-- Jquery CountTo Plugin Js -->
        <script src="plugins/jquery-countto/jquery.countTo.js"></script>

        <!-- Morris Plugin Js -->
        <script src="plugins/raphael/raphael.min.js"></script>
        <script src="plugins/morrisjs/morris.js"></script>

        <!-- ChartJs -->
        <script src="plugins/chartjs/Chart.bundle.js"></script>

        <!-- Flot Charts Plugin Js -->
        <script src="plugins/flot-charts/jquery.flot.js"></script>
        <script src="plugins/flot-charts/jquery.flot.resize.js"></script>
        <script src="plugins/flot-charts/jquery.flot.pie.js"></script>
        <script src="plugins/flot-charts/jquery.flot.categories.js"></script>
        <script src="plugins/flot-charts/jquery.flot.time.js"></script>

        <!-- Sparkline Chart Plugin Js -->
        <script src="plugins/jquery-sparkline/jquery.sparkline.js"></script>

        <!-- Custom Js -->
        <script src="js/admin.js"></script>
        <script src="js/pages/index.js"></script>

        <!-- Demo Js -->
        <script src="js/demo.js"></script>
    </body>

</html>