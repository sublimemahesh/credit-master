<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . './auth.php');

$date = null;
$id = null;

$id = '';
$id = $_GET['id'];
 
$INSTALLMENT = new Installment($id);

if (isset($_GET['date'])) {
    $date = $_GET['date'];
} if (isset($_GET['loan'])) {
    $loan = $_GET['loan'];
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

        <title>Edit Paid Installment || Credit Master</title>
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
                        <h2>Edit Paid Installment</h2>
                        <ul class="header-dropdown">
                        </ul>
                    </div>
                    <div class="body">
                        <form class="" action="post-and-get/installment.php" method="post"  enctype="multipart/form-data">

                            <div class="row">
                                <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                    <label for="installment_date">Installment Date</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 p-bottom">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="installment_date" class="hidden-lg hidden-md">Installment Date</label>
                                            <input type="text" id="installment_date"   name="installment_date" value="<?php echo $INSTALLMENT->installment_date ?>" placeholder="Enter Paid Date" class="form-control  " disabled="true" autocomplete="off" readonly="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                    <label for="paid_date">Paid Date</label>
                                </div>
                                <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 p-bottom">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="paid_date" class="hidden-lg hidden-md">Paid Date</label>
                                            <input type="text" id="paid_date"  name="paid_date" value="<?php echo $INSTALLMENT->paid_date ?>"placeholder="Enter Paid Date" class="form-control  " autocomplete="off" readonly="">
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
                                            $time = date('h:i:s');

                                            echo $INSTALLMENT->time;
                                            ?>  "placeholder="Enter Paid Date" class="form-control date-time-picker" autocomplete="off" readonly="">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                    <label for="paid_amount"> Amount </label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 p-bottom">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="paid_amount" class="hidden-lg hidden-md"> Amount</label>
                                            <input type="number" id="address"  name="paid_amount" value="<?php echo $INSTALLMENT->paid_amount ?>" placeholder="Enter Paid Amount" class="form-control" autocomplete="off" min="0" step="0.001" >
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
                                            <input type="number" id="additional_interest" value="<?php echo $INSTALLMENT->additional_interest ?>" name="additional_interest" placeholder="Enter Additional Interest" class="form-control" autocomplete="off" min="0"  >
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                    <label for="status">Status</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 p-bottom">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="status" class="hidden-lg hidden-md">Status</label>
                                            <select class="form-control" name="status">
                                                <?php if ($INSTALLMENT->status == 'modified') {
                                                    ?>
                                                    <option value="modified" selected="">  Modified   </option>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <option  value="Paid" selected="">  Paid   </option>
                                                    <option value="modified"  >  Modified   </option>
                                                    <?php
                                                }
                                                ?>


                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row clearfix">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5"> 
                                </div> 
                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                    <input type="hidden" value="<?php echo $id ?>" name="id">
                                    <input type="hidden" value="<?php echo $USERS->id ?>" name="user_id">
                                    <input type="hidden" value="<?php echo $INSTALLMENT->paid_amount ?>" name="old_amount">
                                    <input type="hidden" value="<?php echo $INSTALLMENT->installment_date ?>" name="installment_date">
                                    <input type="hidden" value="<?php echo $INSTALLMENT->history ?>" name="history">
                                    <button class="btn btn-primary m-t-15 waves-effect  pull-left" type="submit" name="update">Save Details</button>
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