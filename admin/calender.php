<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/auth.php');
?>
   
<!DOCTYPE html>
<html> 
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

        <title>Post Pone Dates || Credit Master</title>
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
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

        <link href="calender/style.css" rel="stylesheet" type="text/css"/>

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
                        <h2>Post Pone Dates</h2>
                        <ul class="header-dropdown">
                            <li class="">
                                <a href="manage-postpone-dates.php">
                                    <i class="material-icons">list</i> 
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        <div class="panel panel-default"> 
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="tab-pane fade active in" id="hotels-tab"> 
                                            <div class="row search-avalable-bar" id="result"  align="center"> 
                                            </div>
                                            <div class="row" align="center" style="margin-top: 6px;">
                                                <button id="back" class="calendar-navigation">Back</button>
                                                <button id="next" class="calendar-navigation">Next</button> 
                                                <input type="hidden" id="month" value="<?php echo date('m'); ?>">
                                                <input  type="hidden" id="year" value="<?php echo date('Y'); ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </section>

        <!-- Jquery Core Js -->
        <script src="plugins/jquery/jquery.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> 
        <script src="plugins/bootstrap/js/bootstrap.js"></script> 
        <script src="plugins/jquery-slimscroll/jquery.slimscroll.js"></script>
        <script src="plugins/node-waves/waves.js"></script>
        <script src="plugins/jquery-spinner/js/jquery.spinner.js"></script>

        <script src="js/admin.js"></script>
        <script src="js/demo.js"></script>  
        <script src="js/birthday_script.js" type="text/javascript"></script>
        <script src="js/ajax/customer.js" type="text/javascript"></script> 
        <script src="calender/calendar-one.js" type="text/javascript"></script>
        <script src="calender/calendar.js" type="text/javascript"></script>
    </body>

</html> 