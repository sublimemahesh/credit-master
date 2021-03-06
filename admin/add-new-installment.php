<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . './auth.php');


//check user level
$USERS = new User($_SESSION['id']);
//$DEFAULTDATA = new DefaultData(NULL);
//$DEFAULTDATA->checkUserLevelAccess('1,2,3', $USERS->user_level);


$id = null;
if (isset($_GET['loan'])) {
    $loan = $_GET['loan'];
}
?>

<!DOCTYPE html>
<html> 
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

        <title>Add New Installment || Credit Master</title>
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
        <link href="css/jquery.timepicker.css" rel="stylesheet" type="text/css"/>
        <!-- Bootstrap Spinner Css -->
        <link href="plugins/jquery-spinner/css/bootstrap-spinner.css" rel="stylesheet">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
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
                        <h2>Paid Installment</h2>
                        <ul class="header-dropdown"> 
                        </ul>
                    </div>
                    <div class="body">
                        <form class="" action="" method="post"  enctype="multipart/form-data" id="form-data"> 


                            <div class="row">
                                <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                    <label for="paid_date">Paid Date</label>
                                </div>
                                <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 p-bottom">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="paid_date" class="hidden-lg hidden-md">Paid Date</label>
                                            <input type="text" id="paid_date"  name="paid_date" value="<?php echo date("Y-m-d"); ?>"placeholder="Enter Paid Date" class="form-control datepicker" autocomplete="off">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-1 col-md-1 hidden-sm hidden-xs form-control-label">
                                    <label for="time">Time</label>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 p-bottom">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="paid_date" class="hidden-lg hidden-md">Time</label>
                                            <input type="text" id="time"  name="time" value="<?php
                                            date_default_timezone_set("Asia/Calcutta");
                                            $time = date('H:i:s');
                                            echo $time;
                                            ?>  "   class="form-control date-time-picker" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                            </div> 

                            <div class="row">
                                <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                    <label for="paid_amount"> Amount </label>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 p-bottom">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="paid_amount" class="hidden-lg hidden-md"> Amount</label>
                                            <input type="text" id="paid_amount"  name="paid_amount" placeholder="Amount" class="form-control"   autocomplete="off"    >
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 p-bottom">
                                    <div class="form-group">
                                        <div class="form-line"> 
                                            <input type="text" id="due_and_excess"   placeholder="Due Amount" class="form-control"  autocomplete="off"   readonly="" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 p-bottom">
                                    <div class="form-group">
                                        <div class="form-line">                                            
                                            <input type="text" id="od_limite"  name="od_limite"  placeholder="Od Amount" class="form-control"   autocomplete="off" readonly="" >
                                        </div>
                                    </div>
                                </div>
                            </div> 

                            <div class="row">
                                <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                    <label for="additional_interest">Additional Interest</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 p-bottom">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="additional_interest" class="hidden-lg hidden-md">Additional Interest</label>
                                            <input type="number" id="additional_interest"  name="additional_interest" placeholder="Enter Additional Interest" class="form-control" autocomplete="off" min="0">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row clearfix">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5">  
                                </div>  
                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                    <input type="hidden" value="<?php echo $USERS->id ?>" name="user_id">                                   
                                    <input type="hidden" value="<?php echo $loan ?>" name="loan" id="loan_id">
                                    <input type="hidden" value="<?php echo $date ?>" name="installment_date">
                                    <button class="btn btn-primary m-t-15 waves-effect  pull-left" type="submit"  id="paid_installment">Save Details</button>
                                    <?php
                                    $LOAN_1 = new Loan($loan);
                                    $status = $LOAN_1->getCurrentStatus();
                                    ?>
                                    <input type="hidden" value="<?php echo $status["od_amount"] ?>"  id="od_amount_all"   >
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
        <script src="js/ajax/paid_installment.js" type="text/javascript"></script>

        <script>
            var today = new Date();
            $(function () {
                $(".datepicker").datepicker({
                    dateFormat: 'yy-mm-dd',
//                     minDate: today
                });
                $('#time').timepicker({
                    timeFormat: 'H:i:s',
                });
            });
        </script> 
    </body>

</html>