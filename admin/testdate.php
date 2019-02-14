<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/auth.php');


//check user level
$USERS = new User($_SESSION['id']);
$DEFAULTDATA = new DefaultData(NULL);
$DEFAULTDATA->checkUserLevelAccess('1,2,3', $USERS->user_level);

$loan_id = $_GET['id'];
$LOAN = new Loan($loan_id);
$today = date("Y-m-d");
?> 
<!DOCTYPE html>
<html>

    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <title>View Installment || Credit Master</title>

        <!-- Favicon-->
        <link rel="icon" href="favicon.ico" type="image/x-icon">

        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
        <link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
        <link href="plugins/node-waves/waves.css" rel="stylesheet" />
        <link href="plugins/animate-css/animate.css" rel="stylesheet" />
        <link href="plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
        <link href="plugins/sweetalert/sweetalert.css" rel="stylesheet" />
        <link href="css/style.css" rel="stylesheet">
        <link href="css/themes/all-themes.css" rel="stylesheet" />
        <link href="css/table-style.css" rel="stylesheet" type="text/css"/>
    </head>
    <style>
        .font-colors{
            color: black;
        }
        .tr-color{
            background-color:#927676b3;;
        }
        .font-color-2{
            color: white;  
        }
    </style>

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
                <!-- Manage Districts -->
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                        <div class="card">
                            <div class="header">
                                <h2>
                                    View Installment
                                </h2>
                            </div>

                            <div class="body">
                                <div> 
                                    <h5> ID: <?php
                                        if ($LOAN->installment_type == 30) {
                                            echo 'BLD' . $loan_id;
                                        } elseif ($LOAN->installment_type == 4) {
                                            echo 'BLW' . $loan_id;
                                        } else {
                                            echo 'BLM' . $loan_id;
                                        }
                                        ?></h5>
                                    <h5>
                                        Customer Name : 
                                        <?php
                                        $customer = new Customer($LOAN->customer);
                                        echo $customer->title . ' ' . $customer->first_name . ' ' . $customer->last_name;
                                        ?> 
                                    </h5>

                                    <h5>Loan Amount : <?php echo $LOAN->loan_amount ?> </h5>

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
                                </div> 
                                <?php
                                $defultdata = DefaultData::getNumOfInstlByPeriodAndType($LOAN->loan_period, $LOAN->installment_type);

                                $first_installment_date = '';

                                if ($LOAN->installment_type == 4) {
                                    $FID = new DateTime($LOAN->effective_date);
                                    $FID->modify('+7 day');
                                    $first_installment_date = $FID->format('Y-m-d');
                                } elseif ($LOAN->installment_type == 30) {
                                    $FID = new DateTime($LOAN->effective_date);
                                    $FID->modify('+1 day');
                                    $first_installment_date = $FID->format('Y-m-d');
                                } elseif ($LOAN->installment_type == 1) {
                                    $FID = new DateTime($LOAN->effective_date);
                                    $FID->modify('+1 months');
                                    $first_installment_date = $FID->format('Y-m-d');
                                }
                                $start = new DateTime($first_installment_date);

                                $first_date = $start->format('Y-m-d');
                                $INSTALLMENT = new Installment(NULL);
                                $installments = 0;
                                foreach ($INSTALLMENT->CheckInstallmetDateByLoanId($first_date, $LOAN->id) as $installments) {
                                    ?>


                                    <?php echo 'P-D: ' . $installments['paid_date'] . ' / Time ' . $installments['time']; ?>                                                   
                                    <?php echo 'Status: ' . $installments['status']; ?> 
                                    <?php echo 'Amount: ' . $installments['paid_amount']; ?> 
                                    <?php echo $installments['paid_amount']; ?>                                                   



                                    <?php
                                }
                               
                                foreach ($INSTALLMENT->CheckInstallmetBeetwenTwoDateByLoanId($date, $second_installment_date, $loan_id, $today) as $key => $Installment_payment) {
                                    ?>


                                    <?php echo 'P-D: ' . $Installment_payment['paid_date'] . '/ Time:' . $Installment_payment['time']; ?>
                                    <?php echo 'Status: ' . $Installment_payment['status']; ?>
                                    <?php echo 'Amount: ' . number_format($Installment_payment['paid_amount'], 2); ?>
                                    <?php
                                    $installemt_amount = $LOAN->installment_amount;
                                    $amount += $Installment_payment['paid_amount'];
                                    $all_installments = ($previse_amount + $amount) - $installemt_amount;
                                    echo $all_installments;
                                }
                                ?>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <script src = "plugins/jquery/jquery.min.js"></script>
        <script src="plugins/bootstrap/js/bootstrap.js"></script>
        <script src="plugins/bootstrap-select/js/bootstrap-select.js"></script>
        <script src="plugins/jquery-slimscroll/jquery.slimscroll.js"></script>
        <script src="plugins/node-waves/waves.js"></script>

        <script src="plugins/jquery-datatable/jquery.dataTables.js"></script>
        <script src="plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
        <script src="plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
        <script src="plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
        <script src="plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
        <script src="plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
        <script src="plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
        <script src="plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
        <script src="plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>

        <script src="plugins/sweetalert/sweetalert.min.js"></script>
        <script src="js/admin.js"></script>
        <script src="js/pages/tables/jquery-datatable.js"></script>
        <script src="js/demo.js"></script>
        <script src="delete/js/loan.js" type="text/javascript"></script>
    </body> 
</html> 