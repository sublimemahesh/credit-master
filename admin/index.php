<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/auth.php');

//$COUNT_COMMENT = count(Comments::pendingComments());
//$COUNT_ACTIVITY = count(Activities::all());
//$COUNT_ATTRACTION = count(Attraction::all());
//$COUNT_ROOM = count(Room::all());
//$SLIDER_IMAGES = count(Slider::all());
//$COUNT_TOUR = count(TourPackage::all());
//$COUNT_GALLERY = count(AlbumPhoto::getAlbumPhotosById(6));
?> 
<!DOCTYPE html>
<html> 
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=Edge">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <title>Dashbord || Admin || Support Lanka || www.sublime.lk</title>
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


                <div class="block-header">
                    <h2>DASHBOARD</h2>
                </div>

                <!-- Widgets -->
                <div class="row clearfix">
                    <a href="index.php">
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box bg-pink hover-expand-effect">
                                <div class="icon">
                                    <i class="material-icons">photo</i>
                                </div>
                                <div class="content">
                                    <div class="text"><h3>Dashboard</h3></div>
                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="create-feedback.php">
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box bg-cyan hover-expand-effect">
                                <div class="icon">
                                    <i class="material-icons">burst_mode</i>
                                </div>
                                <div class="content">
                                    <div class="text"><h3>Feed Back</h3></div>
                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="manage-messages-member.php">
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box bg-light-green hover-expand-effect">
                                <div class="icon">
                                    <i class="material-icons">forum</i>
                                </div>
                                <div class="content">
                                    <div class="text"><h3>Messages</h3></div>

                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="create-district.php">
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box bg-orange hover-expand-effect">
                                <div class="icon">
                                    <i class="material-icons">dvr</i>
                                </div>
                                <div class="content">
                                    <div class="text"><h3>Districts</h3></div>
                                </div>
                            </div>
                        </div>
                    </a>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="card">
                            <div class="header bg-blue-grey">
                                <h2>
                                    MEMBER <small>   

                                    </small>
                                </h2>

                            </div>
                            <div class="body">
                                <div class="list-group">
                                    <a href="create-member.php"><button type="button" class="list-group-item">Add new</button></a>
                                    <a href="manage-member.php"><button type="button" class="list-group-item">Manage</button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="card">
                            <div class="header bg-blue-grey">
                                <h2>
                                    Company
                                    <small>  </small>
                                </h2>

                            </div>
                            <div class="body">
                                <div class="list-group">
                                    <a href="create-company.php"><button type="button" class="list-group-item">Add new</button></a>
                                    <a href="manage-company.php"><button type="button" class="list-group-item">Manage</button></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="card">
                            <div class="header bg-blue-grey">
                                <h2>
                                    Category
                                </h2>

                            </div>
                            <div class="body">

                                <div class="list-group">
                                    <a href="create-industry.php"><button type="button" class="list-group-item">Add new</button></a>
                                    <a href="manage-industry.php"><button type="button" class="list-group-item">Manage</button></a>

                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="card">
                            <div class="header bg-blue-grey">
                                <h2>
                                    Skill
                                    <small></small>
                                </h2>

                            </div>
                            <div class="body">
                                <div class="list-group">
                                    <a href="create-skill.php"><button type="button" class="list-group-item">Add new</button></a>
                                    <a href="manage-skills.php"><button type="button" class="list-group-item">Manage</button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--                     #END# Widgets 
                                         CPU Usage 
                                                        <div class="row clearfix">
                                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                                <div class="card">
                                                                    <div class="header">
                                                                        <div class="row clearfix">
                                                                            <div class="col-xs-12 col-sm-6">
                                                                                <h2>CPU USAGE (%)</h2>
                                                                            </div>
                                                                            <div class="col-xs-12 col-sm-6 align-right">
                                                                                <div class="switch panel-switch-btn">
                                                                                    <span class="m-r-10 font-12">REAL TIME</span>
                                                                                    <label>OFF<input type="checkbox" id="realtime" checked><span class="lever switch-col-cyan"></span>ON</label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
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
                                                                        <div id="real_time_chart" class="dashboard-flot-chart"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                         #END# CPU Usage -->
                    <!--                                    <div class="row clearfix">
                                                             Visitors 
                                                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                                                <div class="card">
                                                                    <div class="body bg-pink">
                                                                        <div class="sparkline" data-type="line" data-spot-Radius="4" data-highlight-Spot-Color="rgb(233, 30, 99)" data-highlight-Line-Color="#fff"
                                                                             data-min-Spot-Color="rgb(255,255,255)" data-max-Spot-Color="rgb(255,255,255)" data-spot-Color="rgb(255,255,255)"
                                                                             data-offset="90" data-width="100%" data-height="92px" data-line-Width="2" data-line-Color="rgba(255,255,255,0.7)"
                                                                             data-fill-Color="rgba(0, 188, 212, 0)">
                                                                            12,10,9,6,5,6,10,5,7,5,12,13,7,12,11
                                                                        </div>
                                                                        <ul class="dashboard-stat-list">
                                                                            <li>
                                                                                TODAY
                                                                                <span class="pull-right"><b>1 200</b> <small>USERS</small></span>
                                                                            </li>
                                                                            <li>
                                                                                YESTERDAY
                                                                                <span class="pull-right"><b>3 872</b> <small>USERS</small></span>
                                                                            </li>
                                                                            <li>
                                                                                LAST WEEK
                                                                                <span class="pull-right"><b>26 582</b> <small>USERS</small></span>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                             #END# Visitors 
                                                             Latest Social Trends 
                                                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                                                <div class="card">
                                                                    <div class="body bg-cyan">
                                                                        <div class="m-b--35 font-bold">LATEST SOCIAL TRENDS</div>
                                                                        <ul class="dashboard-stat-list">
                                                                            <li>
                                                                                #socialtrends
                                                                                <span class="pull-right">
                                                                                    <i class="material-icons">trending_up</i>
                                                                                </span>
                                                                            </li>
                                                                            <li>
                                                                                #materialdesign
                                                                                <span class="pull-right">
                                                                                    <i class="material-icons">trending_up</i>
                                                                                </span>
                                                                            </li>
                                                                            <li>#adminbsb</li>
                                                                            <li>#freeadmintemplate</li>
                                                                            <li>#bootstraptemplate</li>
                                                                            <li>
                                                                                #freehtmltemplate
                                                                                <span class="pull-right">
                                                                                    <i class="material-icons">trending_up</i>
                                                                                </span>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                             #END# Latest Social Trends 
                                                             Answered Tickets 
                                                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                                                <div class="card">
                                                                    <div class="body bg-teal">
                                                                        <div class="font-bold m-b--35">ANSWERED TICKETS</div>
                                                                        <ul class="dashboard-stat-list">
                                                                            <li>
                                                                                TODAY
                                                                                <span class="pull-right"><b>12</b> <small>TICKETS</small></span>
                                                                            </li>
                                                                            <li>
                                                                                YESTERDAY
                                                                                <span class="pull-right"><b>15</b> <small>TICKETS</small></span>
                                                                            </li>
                                                                            <li>
                                                                                LAST WEEK
                                                                                <span class="pull-right"><b>90</b> <small>TICKETS</small></span>
                                                                            </li>
                                                                            <li>
                                                                                LAST MONTH
                                                                                <span class="pull-right"><b>342</b> <small>TICKETS</small></span>
                                                                            </li>
                                                                            <li>
                                                                                LAST YEAR
                                                                                <span class="pull-right"><b>4 225</b> <small>TICKETS</small></span>
                                                                            </li>
                                                                            <li>
                                                                                ALL
                                                                                <span class="pull-right"><b>8 752</b> <small>TICKETS</small></span>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                             #END# Answered Tickets 
                                                        </div>
                                         Browser Usage -->

                    <!--
                                                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                                            <div class="card">
                                                                <div class="header">
                                                                    <h2>TOUR PACKAGES</h2>
                                                                    <ul class="header-dropdown m-r--5">
                                                                        <li class="dropdown">
                                                                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                                                <i class="material-icons">more_vert</i>
                                                                            </a>
                                                                            <ul class="dropdown-menu pull-right">
                                                                                <li><a href="create-tour-package.php">Create</a></li>
                                                                                <li><a href="manage-tour-package.php">Manage</a></li>
                                                                                <li><a href="arrange-tour-package.php">Arrange</a></li>
                                                                            </ul>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                                <div class="body">
                                                                    <div class="bg-black">
                                        
                                                                        <div class="content">
                                                                            <div class="number count-to" data-from="0" data-to="1225" data-speed="1000" data-fresh-interval="20"></div>
                                                                        </div>
                                                                    </div>
                                                                    <div id="donut_chart" class="dashboard-donut-chart"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                        
                                                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                                            <div class="card">
                                                                <div class="header">
                                                                    <h2>ATTRACTIONS</h2>
                                                                    <ul class="header-dropdown m-r--5">
                                                                        <li class="dropdown">
                                                                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                                                <i class="material-icons">more_vert</i>
                                                                            </a>
                                                                            <ul class="dropdown-menu pull-right">
                                                                                <li><a href="create-attraction.php">Create</a></li>
                                                                                <li><a href="manage-attraction.php">Manage</a></li>
                                                                                <li><a href="arrange-attraction.php">Arrange</a></li>
                                                                            </ul>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                                <div class="body">
                                                                    <div id="donut_chart" class="dashboard-donut-chart"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                        
                                                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                                            <div class="card">
                                                                <div class="header">
                                                                    <h2>ACTIVITIES</h2>
                                                                    <ul class="header-dropdown m-r--5">
                                                                        <li class="dropdown">
                                                                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                                                <i class="material-icons">more_vert</i>
                                                                            </a>
                                                                            <ul class="dropdown-menu pull-right">
                                                                                <li><a href="create-activity.php">Create</a></li>
                                                                                <li><a href="manage-activity.php">Manage</a></li>
                                                                                <li><a href="arrange-activity.php">Arrange</a></li>
                                                                            </ul>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                                <div class="body">
                                                                    <div id="donut_chart" class="dashboard-donut-chart"></div>
                                                                </div>
                                                            </div>
                                                        </div>-->
                    <!--                    
                                                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                                            <div class="card">
                                                                <div class="header">
                                                                    <h2>ACCOMMODATION</h2>
                                                                    <ul class="header-dropdown m-r--5">
                                                                        <li class="dropdown">
                                                                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                                                <i class="material-icons">more_vert</i>
                                                                            </a>
                                                                            <ul class="dropdown-menu pull-right">
                                                                                <li><a href="create-room.php">Create</a></li>
                                                                                <li><a href="manage-room.php">Manage</a></li>
                                                                                <li><a href="arrange-room.php">Arrange</a></li>
                                                                            </ul>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                                <div class="body">
                                                                    <div id="donut_chart" class="dashboard-donut-chart"></div>
                                                                </div>
                                                            </div>
                                                        </div>-->


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
                                        <button class="glyphicon glyphicon-picture arrange-btn"></button> <span class="icon-name">Add Photos</span>
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