<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/auth.php');

//check user level
$USERS = new User($_SESSION['id']);
$DEFAULTDATA = new DefaultData(NULL);
$DEFAULTDATA->checkUserLevelAccess('1,2,3', $USERS->user_level);

$LOAN = new Loan($_GET['id']);
?>

<!DOCTYPE html>
<html> 
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

        <title>View Loan || Credit Master</title>
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
                        <h2>View Loan (# <?php echo $LOAN->id; ?>)</h2>
                        <ul class="header-dropdown">
                            <li class="">
                                <a href="manage-loan.php">
                                    <i class="material-icons">list</i> 
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        <div class="row">
                            <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                <label for="create_date">Create Date</label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 p-bottom">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label for="create_date" class="hidden-lg hidden-md">Create Date</label>
                                        <div class="form-control"><?php echo $LOAN->create_date; ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                <label for="customer">Customer</label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 p-bottom">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label for="customer" class="hidden-lg hidden-md">Customer</label>
                                        <div class="form-control"><?php
                                            $CUSTOMER = new Customer($LOAN->customer);
                                            echo $CUSTOMER->first_name . ' ' . $CUSTOMER->last_name;
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                <label for="guarantor">Guarantor 01</label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 p-bottom">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label for="guarantor" class="hidden-lg hidden-md">Guarantor 01</label>
                                        <div class="form-control"><?php
                                            $GARANTER_01 = new Customer($LOAN->guarantor_1);
                                            echo $GARANTER_01->first_name . ' ' . $GARANTER_01->last_name;
                                            ?>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                <label for="guarantor-02">Guarantor 02</label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 p-bottom">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label for="guarantor-02" class="hidden-lg hidden-md">Guarantor 02</label>
                                        <div class="form-control"><?php
                                            $GARANTER_02 = new Customer($LOAN->guarantor_2);
                                            echo $GARANTER_02->first_name . ' ' . $GARANTER_02->last_name;
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                <label for="loan_amount"> Amount</label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 p-bottom">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label for="loan_amount" class="hidden-lg hidden-md">Loan Amount</label>
                                        <div class="form-control"><?php echo $LOAN->loan_amount; ?></div>  
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                <label for="issue_mode">Issue Mode</label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 p-bottom">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label for="issue_mode" class="hidden-lg hidden-md">Issue Mode</label>
                                        <div class="form-control"><?php echo $LOAN->issue_mode; ?></div>  
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                <label for="loan_period"> Period</label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 p-bottom">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label for="loan_period" class="hidden-lg hidden-md"> Period</label>

                                        <div class="form-control">
                                            <?php
                                            if ($LOAN->loan_period == 1) {
                                                echo 'Day';
                                            } elseif ($LOAN->loan_period == 2) {
                                                echo 'Week';
                                            } elseif ($LOAN->loan_period == 3) {
                                                echo 'Month';
                                            } else {
                                                echo 'Year';
                                            }
                                            ?>
                                        </div>  
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                <label for="interest_rate">Interest Rate</label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 p-bottom">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label for="interest_rate" class="hidden-lg hidden-md">Interest Rate</label>
                                        <div class="form-control"><?php echo $LOAN->interest_rate; ?></div> 
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                <label for="installment_type">Installment Type</label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 p-bottom">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label for="installment_type" class="hidden-lg hidden-md">Installment Type</label>
                                        <div class="form-control">
                                            <?php
                                            if ($LOAN->installment_type == 1) {
                                                echo 'Day';
                                            } elseif ($LOAN->installment_type == 2) {
                                                echo 'Week';
                                            } elseif ($LOAN->installment_type == 3) {
                                                echo 'Month';
                                            } else {
                                                echo 'Year';
                                            }
                                            ?> 
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
    <script src="plugins/bootstrap/js/bootstrap.js"></script> 
    <script src="plugins/jquery-slimscroll/jquery.slimscroll.js"></script>
    <script src="plugins/node-waves/waves.js"></script>
    <script src="plugins/jquery-spinner/js/jquery.spinner.js"></script>
    <script src="js/admin.js"></script>
    <script src="js/demo.js"></script> 
</body>

</html>