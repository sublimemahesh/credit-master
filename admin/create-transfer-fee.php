
<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/auth.php');

//check user level

$USERS = new User($_SESSION['id']);
$DEFAULTDATA = new DefaultData(NULL);
$DEFAULTDATA->checkUserLevelAccess('1,2,3', $USERS->user_level);

$date = '';
$date = date("Y/m/d");
?>

<!DOCTYPE html>
<html> 
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

        <title>Transfer Fee   || Credit Master</title>
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
        <link href="css/jquery.timepicker.css" rel="stylesheet" type="text/css"/>
        <link href="plugins/jquery-spinner/css/bootstrap-spinner.css" rel="stylesheet">
        <link href="css/materialize.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
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
                        <h2>Transfer Fee  </h2>
                    </div>

                    <div class="body">
                        <form class="" action="post-and-get/transfer-fee.php" method="post"  enctype="multipart/form-data">                             

                            <div class="row">
                                <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                    <label for="from_account">From Account:  </label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 p-bottom">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="from_account" class="hidden-lg hidden-md">From Account:</label>
                                            <select id="from_account"  name="from_account"  class="form-control" autocomplete="off"  >
                                                <?php
                                                $USER = new User(NULL);
                                                foreach ($USER->activeUsers() as $user) {
                                                    ?>
                                                    <option value="<?php echo $user['id'] ?>" data-name=""> <?php echo $user['username'] ?>   </option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div> 

                            <div class="row">
                                <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                    <label for="to_account">To Account:  </label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 p-bottom">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="to_account" class="hidden-lg hidden-md">To Account:</label>
                                            <select id="to_account"  name="to_account"  class="form-control" autocomplete="off"  >
                                                <?php
                                                $USER = new User(NULL);
                                                foreach ($USER->activeUsers() as $user) {
                                                    ?>
                                                    <option value="<?php echo $user['id'] ?>" data-name=""> <?php echo $user['username'] ?>   </option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>                            

                            <div class="row">
                                <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                    <label for="date"> Date</label>
                                </div>
                                <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 p-bottom">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="date" class="hidden-lg hidden-md">Paid Date</label>
                                            <input type="text" id="date"  name="date" value="<?php echo $date ?>"placeholder="Enter  Date" class="form-control datepicker" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-1 col-md-1 hidden-sm hidden-xs form-control-label">
                                    <label for="time">Time</label>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 p-bottom">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="time" class="hidden-lg hidden-md">Time</label>
                                            <input type="text" id="time"  name="time" value="<?php
                                            date_default_timezone_set("Asia/Calcutta");
                                            $time = date('H:i:s');
                                            echo $time;
                                            ?>  "placeholder="Enter Paid Date" class="form-control date-time-picker" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                            </div> 

                            <div class="row">
                                <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                    <label for="amount">Amount</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 p-bottom">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="amount" class="hidden-lg hidden-md">Amount</label>
                                            <input type="number" id="amount"   name="amount" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                    <label for="purpose">Purpose</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 p-bottom">
                                    <div class="form-group">   
                                        <div class="form-line">
                                            <label for="purpose" class="hidden-lg hidden-md">Purpose</label>
                                            <textarea rows="3" cols="105" name="purpose" class="form-control"></textarea>                                  
                                        </div>
                                    </div>
                                </div>
                            </div>                           

                            <div class="row clearfix">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5">  
                                </div>  
                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7"> 
                                    <button class="btn btn-primary m-t-15 waves-effect  pull-left" type="submit" name="create">Save </button> 
                                </div>
                            </div>
                        </form> 
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
        <script src="plugins/sweetalert/sweetalert.min.js"></script>
        <script src="js/admin.js"></script>
        <script src="js/demo.js"></script>  
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="js/jquery.timepicker.min.js" type="text/javascript"></script>
        <script>
            $(function () {
                $(".datepicker").datepicker({dateFormat: 'yy-mm-dd'});

                $('#time').timepicker();
            });
        </script>
    </body>

</html>