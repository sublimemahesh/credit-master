<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/auth.php');

//check user level
$USERS = new User($_SESSION['id']);
$DEFAULTDATA = new DefaultData(NULL);
$DEFAULTDATA->checkUserLevelAccess('1,2,3', $USERS->user_level);


$today = date("Y-m-d");
$LOAN = new Loan(NULL);
$LOAN->status = 'issued';

if (isset($_GET['date'])) {
    $today = $_GET['date'];
}

$BD = new DateTime($today);
$BD->modify('-1 day');
$back = $BD->format('Y-m-d');

$ND = new DateTime($today);
$ND->modify('+1 day');
$next = $ND->format('Y-m-d');
?> 
<!DOCTYPE html>
<html> 
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <title> Arrears Loans || Credit Master</title>

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
                                    Arrears Loans :
                                    <?php
                                    echo $today;
                                    ?>
                                </h2>


                            </div> 

                            <div class="body">                            
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                        <thead>
                                            <tr>
                                                <th>Loan Id</th> 
                                                <th>Customer</th>
                                                <th>Number of arrears</th>                                                 
                                                <th class="text-center">Arrears Total</th> 
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php
                                            foreach ($LOAN->allByStatus() as $key => $loan) {

                                                $defultdata = DefaultData::getNumOfInstlByPeriodAndType($loan['loan_period'], $loan['installment_type']);

                                                $start_date = $loan['effective_date'];
                                                $start = new DateTime("$start_date");

                                                $x = 0;
                                                $ins_total = 0;
                                                $total_paid = 0;
                                                while ($x < $defultdata) {
                                                    if ($defultdata == 4) {
                                                        $add_dates = '+7 day';
                                                    } elseif ($defultdata == 30) {
                                                        $add_dates = '+1 day';
                                                    } elseif ($defultdata == 8) {
                                                        $add_dates = '+7 day';
                                                    } elseif ($defultdata == 60) {
                                                        $add_dates = '+1 day';
                                                    } elseif ($defultdata == 2) {
                                                        $add_dates = '+1 months';
                                                    } elseif ($defultdata == 1) {
                                                        $add_dates = '+1 months';
                                                    } elseif ($defultdata == 90) {
                                                        $add_dates = '+1 day';
                                                    } elseif ($defultdata == 12) {
                                                        $add_dates = '+7 day';
                                                    } elseif ($defultdata == 3) {
                                                        $add_dates = '+1 months';
                                                    } elseif ($defultdata == 100) {
                                                        $add_dates = '+1 day';
                                                    } elseif ($defultdata == 13) {
                                                        $add_dates = '+7 day';
                                                    }


                                                    $date = $start->format('Y-m-d');
                                                    $customer = $loan['customer'];
                                                    $CUSTOMER = new Customer($customer);
                                                    $route = $CUSTOMER->route;
                                                    $center = $CUSTOMER->center;
                                                    $LP = DefaultData::getLoanPeriod();
                                                    $IT = DefaultData::getInstallmentType();
                                                    $amount = $loan['installment_amount'];
                                                    $INSTALLMENT = new Installment(NULL);
                                                    $paid_amount = 0;


                                                    foreach ($INSTALLMENT->CheckInstallmetByPaidDate($date, $loan['id']) as $paid) {
                                                        $paid_amount += $paid['paid_amount'];
                                                    }

                                                    $ins_total += $amount;
                                                    $total_paid += $paid_amount;

                                                    if (PostponeDate::CheckIsPostPoneByDateAndCustomer($date, $customer) || PostponeDate::CheckIsPostPoneByDateAndRoute($date, $route) || PostponeDate::CheckIsPostPoneByDateAndCenter($date, $center) || PostponeDate::CheckIsPostPoneByDateAndAll($date)) {

                                                        $start->modify($add_dates);
                                                    } else {
                                                        $ITYPE = $loan['installment_type'];
                                                        $arreas_amount = $total_paid - $ins_total;
                                                        if ($date == $today && $ITYPE == 30 && $arreas_amount < 0) {
                                                            ?>
                                                            <tr>
                                                                <td>
                                                                    <b>
                                                                        <?php
                                                                        $LT = $loan['installment_type'];
                                                                        if ($LT == 30) {
                                                                            echo 'BLD' . $loan['id'];
                                                                        } elseif ($LT == 4) {
                                                                            echo 'BLW' . $loan['id'];
                                                                        } else {
                                                                            echo 'BLM' . $loan['id'];
                                                                        }
                                                                        ?>
                                                                    </b>
                                                                </td> 

                                                                <td>  
                                                                    <?php
                                                                    $first_name = $DEFAULTDATA->getFirstLetterName(ucwords($CUSTOMER->surname));
                                                                    echo '<b>' . $first_name . ' ' . $CUSTOMER->first_name . ' ' . $CUSTOMER->last_name . '</b>';
                                                                    ?>
                                                                </td> 

                                                                <td>
                                                                    <?php
                                                                    $number_of_arreas = ($total_paid - $ins_total) / $loan['installment_amount'];
                                                                    dd($number_of_arreas);
                                                                    if ($number_of_arreas > 0) {
                                                                        echo '0';
                                                                    } else {
                                                                        echo abs((int) $number_of_arreas);
                                                                    }
                                                                    ?>
                                                                </td>

                                                                <td class="text-center"> 
                                                                    <?php
                                                                    $arreas_amount = $total_paid - $ins_total;
                                                                    if ($arreas_amount < 0) {
                                                                        echo '<span style="color:red">' . number_format($arreas_amount, 2) . '</span>';
                                                                    } else {
                                                                        echo '0';
                                                                    }
                                                                    ?>
                                                                </td> 
                                                            </tr>
                                                            <?php
                                                        }
                                                        $start->modify($add_dates);
                                                        $x++;
                                                    }
                                                }
                                            }
                                            ?> 
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Loan Id</th> 
                                                <th>Customer</th>    
                                                <th>Number of arrears</th>                                                
                                                <th class="text-center">Arrears Total</th>
                                            </tr>
                                        </tfoot>
                                    </table> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </section>

        <script src="plugins/jquery/jquery.min.js"></script>
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


    </body> 
</html> 