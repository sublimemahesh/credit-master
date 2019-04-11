<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/auth.php');

//check user level
$USERS = new User($_SESSION['id']);
$DEFAULTDATA = new DefaultData(NULL);
$DEFAULTDATA->checkUserLevelAccess('1,2,3', $USERS->user_level);
$id = NULL;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
}if (isset($_GET['loan'])) {
    $loan = $_GET['loan'];
}
$LOAN = new Loan($loan);
$OD = new Od($id);
$today = date("Y-m-d");
?>

<!DOCTYPE html>
<html> 
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

        <title>Edit Od  || Credit Master</title>
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
        <link rel="stylesheet" href="plugins/jquery-ui/jquery-ui.css">   
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
                        <h2>Edit Gn Division</h2>
                        <ul class="header-dropdown">
                            <li class="">
                                <a href="manage-gn-division.php">
                                    <i class="material-icons">list</i> 
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="body"> 
                        <div> 
                            <h5> ID: <?php
                                if ($LOAN->installment_type == 30) {
                                    echo 'BLD' . $LOAN->id;
                                } elseif ($LOAN->installment_type == 4) {
                                    echo 'BLW' . $LOAN->id;
                                } else {
                                    echo 'BLM' . $LOAN->id;
                                }
                                ?></h5>
                            <h5>
                                Customer Name : 
                                <?php
                                $customer = new Customer($LOAN->customer);
                                echo $customer->title . ' ' . $customer->first_name . ' ' . $customer->last_name;
                                ?> 
                            </h5>

                            <h5>Installment Type : 
                                <?php
                                $IT = DefaultData::getInstallmentType();
                                echo $IT[$LOAN->installment_type];
                                ?> 
                            </h5>

                            <h5>Loan Period : 
                                <?php
                                $LP = DefaultData::getLoanPeriod();
                                echo $LP[$LOAN->loan_period];
                                ?> 
                            </h5>
                            <h5>Loan Amount : 
                                <?php
                                echo number_format($LOAN->loan_amount, 2)
                                ?> 
                            </h5>
                            <h5>Installment Amount :
                                <?php
                                echo Number_format($LOAN->installment_amount, 2)
                                ?> 
                            </h5>
                            <h5>Effective date :
                                <?php
                                echo $LOAN->effective_date
                                ?> 
                            </h5>
                        </div> 
                        <br>

                        <form class="" action="" method="post"  enctype="multipart/form-data" id="form-data">  

                            <div class="row">
                                <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                    <label for="od_interest_limit">OD Interest Limit</label>
                                </div>

                                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 p-bottom">
                                    <div class="form-group">
                                        <div class="form-line"> 
                                            <?php
                                            if ($OD->od_date_start < $today) {
                                                ?>
                                                <input type="text"  name="od_date_start"  placeholder="Enter OD Start Date" class="form-control  " autocomplete="off" value="<?php echo $OD->od_date_start ?>" readonly="">
                                            <?php } else { ?>
                                                <input type="text"  name="od_date_start"  id="od_date_start" placeholder="Enter OD Start Date" class="form-control od_date_start" autocomplete="off" value="<?php echo $OD->od_date_start ?>" >
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 p-bottom">
                                    <div class="form-group">
                                        <div class="form-line"> 
                                            <input type="text" name="od_date_end" id="od_date_end" placeholder="Enter OD End Date" class="form-control" autocomplete="off" value="<?php
                                            $END = new DateTime($OD->od_date_start);
                                            $END->modify('+2 years');
                                            $end = $END->format('Y-m-d');
                                            if ($end == $OD->od_date_end) {
                                                echo 'Unlimited';
                                            } else {
                                                echo $OD->od_date_end;
                                            }
                                            ?>">
                                        </div>
                                    </div>
                                </div> 
                                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 p-bottom">
                                    <div class="form-group">
                                        <div class="form-line"> 
                                            <input type="number" name="od_interest_limit" id="od_interest_limit" placeholder="Enter OD Interest Limit" class="form-control" autocomplete="off" min="0" value="<?php echo $OD->od_interest_limit ?>">
                                        </div>
                                    </div>
                                </div> 
                            </div> 

                            <div class="row clearfix">
                                <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                    <div class="form-group">
                                        <input class="btn btn-primary m-t-15 waves-effect  pull-left" type="submit"  id="edit-od" value="Save Details ">
                                    </div> 
                                    <input type="hidden" name="id" id="id" value="<?php echo $OD->id ?>">
                                    <input type="hidden" name="loan_id" id="loan_id" value="<?php echo $LOAN->id ?>">
                                    <input type="hidden" name="today" id="today" value="<?php echo $today ?>">
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
        <script src="js/ajax/od-limite.js" type="text/javascript"></script>
        <script src="plugins/jquery-ui/jquery-ui.js"></script>
        <script>
             var today = new Date();
            $(function () {
                $(".datepicker").datepicker({
                    dateFormat: 'yy-mm-dd'
                    
                });
                $("#od_date_start").datepicker({
                    dateFormat: 'yy-mm-dd',
                       minDate: today

                });
                $("#od_date_end").datepicker({
                    dateFormat: 'yy-mm-dd',
                       minDate: today
                });
            });
        </script>
    </body>

</html>