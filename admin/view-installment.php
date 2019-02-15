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
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                        <thead>
                                            <tr>
                                                <th class="text-center">ID</th> 
                                                <th class="text-center">Installment Date</th>  
                                                <th class="text-center">Status</th> 
                                                <th class="text-center">Paid Amount</th> 
                                                <th class="text-center">Due and Excess</th> 
                                                <th class="text-center">Od Interest</th> 
                                                <th class="text-center">Options</th> 
                                            </tr>
                                        </thead>
                                        <tbody>
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


                                            $x = 0;
                                            $count = 0;
                                            $ins_total = 0;
                                            $total_paid = 0;
                                            $data = array();
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

                                                $count++;
                                                $date = $start->format('Y-m-d');
                                                $customer = $LOAN->customer;

                                                $CUSTOMER = new Customer($customer);
                                                $route = $CUSTOMER->route;
                                                $center = $CUSTOMER->center;
                                                $amount = $LOAN->installment_amount;

                                                $Installment = new Installment(NULL);
                                                $paid_amount = 0;


                                                foreach ($Installment->CheckInstallmetByPaidDate($date, $loan_id) as $paid) {
                                                    $paid_amount += $paid['paid_amount'];
                                                }
                                                echo '<tr>';

                                                if (PostponeDate::CheckIsPostPoneByDateAndCustomer($date, $customer) || PostponeDate::CheckIsPostPoneByDateAndRoute($date, $route) || PostponeDate::CheckIsPostPoneByDateAndCenter($date, $center) || PostponeDate::CheckIsPostPoneByDateAndAll($date) || PostponeDate::CheckIsPostPoneByDateCenterAll($date) || PostponeDate::CheckIsPostPoneByDateRouteAll($date)) {
                                                    echo '<td class="padd-td gray ">';
                                                    echo $count;
                                                    echo '</td>';
                                                    echo '<td class="padd-td red">';
                                                    echo $date;
                                                    echo '</td>';
                                                    echo '<td class="padd-td gray text-center" colspan=5>';
                                                    echo '-- Postponed --';
                                                    echo '</td>';
                                                    $x--;
                                                } else {
                                                    echo '<td class="tr-color font-color-2">';
                                                    echo $count;
                                                    echo '</td>';
                                                    echo '<td class="padd-td f-style tr-color font-color-2">';
                                                    echo $date;
                                                    echo '</td>';


                                                    echo '<td class="f-style tr-color font-color-2">';
                                                    if ($paid_amount) {
                                                        echo 'Paid';
                                                    } elseif ($date <= $today) {
                                                        echo 'Posted';
                                                    } elseif ($date > $today) {
                                                        echo 'Unpaid';
                                                    } else {
                                                        echo 'Payble';
                                                    }
                                                    echo '</td>';

                                                    echo '<td class="f-style">';
                                                    if ($paid_amount) {
                                                        echo 'Rs: ' . number_format($paid_amount, 2);
                                                    } else {
                                                        echo '-';
                                                    }
                                                    echo '</td>';

                                                    echo '<td class="f-style">';
                                                    $ins_total += $amount;
                                                    $total_paid += $paid_amount;
                                                    $due_and_excess = $total_paid - $ins_total;

                                                    if ($due_and_excess > 0) {
                                                        echo '<span style="color:green">' . number_format($due_and_excess, 2) . '</span>';
                                                    } else if ($due_and_excess < 0) {

                                                        echo '<span style="color:red">' . number_format($due_and_excess - $paid_amount, 2) . '</span>';
                                                    } else {
                                                        echo number_format($due_and_excess, 2);
                                                    }
                                                    echo '</td>';

                                                    echo '<td class="tr-color font-color-2">';

                                                    if (strtotime(date("Y/m/d")) < strtotime($date)) {
                                                        
                                                    } else {
                                                        if (strtotime($LOAN->od_date) <= strtotime($date) ) {

                                                            if ($due_and_excess < 0) {
                                                                $od_interest = $LOAN->getOdIntereset($due_and_excess, $LOAN->installment_type, $LOAN->od_interest_limit);

                                                                $data[] = $od_interest;
                                                            }
                                                            echo json_encode(round(array_sum($data), 2));
                                                        }
                                                    }

                                                    echo '</td>';
                                                    echo '<td class="text-center tr-color font-color-2">';


                                                    //check payment button 
                                                    if ($date == $today) {
                                                        echo '<a href="add-new-installment.php?date=' . $date . '&loan=' . $loan_id . '&amount=' . $amount . '">
                                                    <button class="glyphicon glyphicon-send btn btn-info" title="Payment"></button> 
                                                    </a>';

                                                        //show week payment button
                                                    } elseif ($LOAN->installment_type == 4 && ($date <= $today)) {

                                                        echo '<a href="add-new-installment.php?date=' . $date . '&loan=' . $loan_id . '&amount=' . $amount . '">
                                                         <button class="glyphicon glyphicon-send btn btn-info" title="Payment"></button> 
                                                    </a>';
                                                    } elseif ($LOAN->installment_type == 1 && ($date <= $today)) {
                                                        echo '<a href="add-new-installment.php?date=' . $date . '&loan=' . $loan_id . '&amount=' . $amount . '">
                                                         <button class="glyphicon glyphicon-send btn btn-info" title="Payment"></button> 
                                                    </a>';
                                                    } else {
                                                        echo '<a href="add-new-installment.php?date=' . $date . '&loan=' . $loan_id . '&amount=' . $amount . '">
                                                         <button class="glyphicon glyphicon-send btn btn-info" title="Payment" ></button> 
                                                    </a>';
                                                    }

                                                    echo '</td>';
                                                }
                                                echo '</tr>';
                                                $start->modify($add_dates);

                                                $x++;
                                            }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th class="text-center">ID</th> 
                                                <th class="text-center">Installment Date</th>  
                                                <th class="text-center">Status</th> 
                                                <th class="text-center">Paid Amount</th> 
                                                <th class="text-center">Due and Excess</th> 
                                                <th class="text-center">Od Interest</th>  
                                                <th class="text-center">Options</th> 
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