<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/auth.php');


//check user level
$USERS = new User($_SESSION['id']);
$DEFAULTDATA = new DefaultData(NULL);
$DEFAULTDATA->checkUserLevelAccess('1,2,3', $USERS->user_level);

$INSTALLMENT = new Installment(NULL);
$loan_id = $_GET['id'];
$LOAN = new Loan($loan_id);
$today = date("Y-m-d");
$time = date('H:i:s');
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
                                <div class="pull-right">
                                    <a href="add-new-installment.php?loan=<?php echo $loan_id ?>"><button class="btn btn-primary btn-lg"><b>payment </b></button></a>
                                </div>
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
                                    <?php if ($LOAN->installment_type == 30) {
                                        ?>
                                        <table class="table table-bordered table-striped table-hover dataTable  js-basic-example "  >
                                            <thead>
                                                <tr>
                                                    <th class="text-center">ID</th> 
                                                    <th class="text-center">Installment Date</th>  
                                                    <th class="text-center">Status</th> 
                                                    <th class="text-center">Ins: Amount</th>  
                                                    <th class="text-center">Ins: Total</th>  
                                                    <th class="text-center">Od Interest</th> 

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $numOfInstallments = DefaultData::getNumOfInstlByPeriodAndType($LOAN->loan_period, $LOAN->installment_type);

                                                $first_installment_date = '';
                                                $installments = 0;
                                                if ($LOAN->installment_type == 4) {
                                                    $FID = new DateTime($LOAN->effective_date);
                                                    $FID->modify('+7 day');
                                                    $first_installment_date = $FID->format('Y-m-d H:i:s');
                                                } elseif ($LOAN->installment_type == 30) {
                                                    $FID = new DateTime($LOAN->effective_date);
                                                    $FID->modify('+1 day');
                                                    $first_installment_date = $FID->format('Y-m-d H:i:s');
                                                } elseif ($LOAN->installment_type == 1) {
                                                    $FID = new DateTime($LOAN->effective_date);
                                                    $FID->modify('+1 months');
                                                    $first_installment_date = $FID->format('Y-m-d H:i:s');
                                                }

                                                $start = new DateTime($first_installment_date);
                                                $first_date = $start->format('Y-m-d H:i:s');

                                                $x = 0;
                                                $count = 0;
                                                $ins_total = 0;
                                                $ins_for_od = 0;
                                                $total_paid = 0;
                                                $od_array = array();
                                                $od_amount_all_array = array();
                                                $last_od = array();
                                                $array = array();

                                                while ($x < $numOfInstallments) {
                                                    if ($numOfInstallments == 4) {
                                                        $add_dates = '+7 day';
                                                    } elseif ($numOfInstallments == 30) {
                                                        $add_dates = '+1 day';
                                                    } elseif ($numOfInstallments == 8) {
                                                        $add_dates = '+7 day';
                                                    } elseif ($numOfInstallments == 60) {
                                                        $add_dates = '+1 day';
                                                    } elseif ($numOfInstallments == 2) {
                                                        $add_dates = '+1 months';
                                                    } elseif ($numOfInstallments == 1) {
                                                        $add_dates = '+1 months';
                                                    } elseif ($numOfInstallments == 90) {
                                                        $add_dates = '+1 day';
                                                    } elseif ($numOfInstallments == 12) {
                                                        $add_dates = '+7 day';
                                                    } elseif ($numOfInstallments == 3) {
                                                        $add_dates = '+1 months';
                                                    } elseif ($numOfInstallments == 100) {
                                                        $add_dates = '+1 day';
                                                    } elseif ($numOfInstallments == 13) {
                                                        $add_dates = '+7 day';
                                                    }

                                                    $count++;
                                                    $paid_amount = 0;
                                                    $od_interest = 0;
                                                    $od_amount = 0;
                                                    $od_amount_all = 0;
                                                    $balance = 0;
                                                    $loan_proccesign_fee_paid = 0;
                                                    $total_od_paid = 0;
                                                    $paid_all_amount_before_ins_date = 0;
                                                    $paid_all_od_before_ins_date = 0;

                                                    $date = $start->format('Y-m-d H:i:s');
                                                    $customer = $LOAN->customer;
                                                    $CUSTOMER = new Customer($customer);

                                                    $INSTALLMENT = new Installment(NULL);
                                                    $route = $CUSTOMER->route;
                                                    $center = $CUSTOMER->center;
                                                    $amount = $LOAN->installment_amount;
                                                    $od_amount = $LOAN->od_interest_limit;

                                                    $ALl_AMOUNT = $INSTALLMENT->getAmountByLoanId($LOAN->id);

                                                    foreach ($INSTALLMENT->CheckInstallmetByPaidDate($date, $loan_id) as $paid) {
                                                        $paid_amount += $paid['paid_amount'];
                                                    }

                                                    $before_payment_amounts = $INSTALLMENT->getPaidAmountByBeforeDate($date, $LOAN->id);

                                                    foreach ($before_payment_amounts as $before_payment_amount) {
                                                        $paid_all_amount_before_ins_date += $before_payment_amount['paid_amount'];
                                                        $paid_all_od_before_ins_date += $before_payment_amount['additional_interest'];
                                                    }
                                                    echo '<tr>';

                                                    if (PostponeDate::CheckIsPostPoneByDateAndCustomer($date, $customer) || PostponeDate::CheckIsPostPoneByDateAndRoute($date, $route) || PostponeDate::CheckIsPostPoneByDateAndCenter($date, $center) || PostponeDate::CheckIsPostPoneByDateAndAll($date) || PostponeDate::CheckIsPostPoneByDateCenterAll($date) || PostponeDate::CheckIsPostPoneByDateRouteAll($date)) {
                                                        $date = new DateTime($date);
                                                        echo '<td class="padd-td gray ">';
                                                        echo $count;
                                                        echo '</td>';
                                                        echo '<td class="padd-td red">';
                                                        echo $date->format('Y-m-d');
                                                        echo '</td>';
                                                        echo '<td class="padd-td gray text-center" >';
                                                        echo '-- Postponed --';
                                                        echo '</td>';
                                                        echo '<td class="padd-td gray text-center" >';
                                                        echo '</td>';
                                                        echo '<td class="padd-td gray text-center" >';
                                                        echo '</td>';
                                                        echo '<td class="padd-td gray text-center" >';
                                                        echo '</td>';

                                                        $x--;
                                                    } else {
                                                        $last_od_amount = (float) end($od_amount_all_array);

                                                        $ins_total += $amount;
                                                        $total_paid += $paid_amount;
                                                        $due_and_excess = $ins_total - $total_paid;

                                                        //balance of the loan
                                                        $balance = $paid_all_od_before_ins_date + $paid_all_amount_before_ins_date - $ins_total - $last_od_amount;

                                                        foreach ($INSTALLMENT->CheckInstallmetByPaidDate($date, $loan_id) as $paid) {
                                                            $balance = $balance + $paid['paid_amount'] + $paid['paid_amount'];
                                                        }

                                                        $date_format = new DateTime($date);
                                                        echo '<td class="tr-color font-color-2">';
                                                        echo $count;
                                                        echo '</td>';
                                                        echo '<td class="padd-td f-style tr-color font-color-2">';
                                                        echo $date_format->format('Y-m-d');
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
                                                        echo number_format($amount, 2);
                                                        echo '</td>';

                                                        echo '<td class="f-style">';
                                                        echo '<span style="color:red">' . number_format($ins_total, 2) . '</span>';
                                                        echo '</td>';

                                                        echo '<td class="f-style">';
                                                        //get od amount
                                                        $OD = new OD(NULL);
                                                        $OD->loan = $LOAN->id;
                                                        $AllOd = $OD->allOdByLoan();

                                                        if (strtotime(date("Y/m/d")) < strtotime($date) || !$AllOd || PostponeDate::CheckIsPostPoneByDateAndCustomer($date, $customer) || PostponeDate::CheckIsPostPoneByDateAndRoute($date, $route) || PostponeDate::CheckIsPostPoneByDateAndCenter($date, $center) || PostponeDate::CheckIsPostPoneByDateAndAll($date) || PostponeDate::CheckIsPostPoneByDateCenterAll($date) || PostponeDate::CheckIsPostPoneByDateRouteAll($date) || $ALl_AMOUNT[0] >= $ins_total) {
                                                            
                                                        } else {

                                                            if ($AllOd) {
                                                                foreach ($AllOd as $key => $allod) {

                                                                    if (strtotime($allod['od_date_start']) <= strtotime($date) && strtotime($date) <= strtotime($allod['od_date_end']) && (-1 * ($allod['od_interest_limit'])) > $balance) {

                                                                        if (strtotime(date("Y/m/d")) <= strtotime($date)) {
                                                                            break;
                                                                        }
                                                                        $ODDATES = new DateTime($date);
                                                                        $ODDATES->modify(' +23 hours +59 minutes +58 seconds');

                                                                        $od_date_morning = $ODDATES->format('Y-m-d H:i:s');

                                                                        //get all paid ammount before od date
                                                                        $paid_all_amount_before_ins_date1 = 0;
                                                                        $before_payment_amounts1 = $INSTALLMENT->getPaidAmountByBeforeDate($od_date_morning, $LOAN->id);

                                                                        foreach ($before_payment_amounts1 as $before_payment_amount1) {
                                                                            $paid_all_amount_before_ins_date1 += $before_payment_amount1['paid_amount'];
                                                                        }

                                                                        $od_interest = $LOAN->getOdIntereset1(-$ins_total + $paid_all_amount_before_ins_date1, $allod['od_interest_limit']);
                                                                        $od_array[] = $od_interest;

                                                                        $od_amount_all = json_encode(round(array_sum($od_array), 2));

                                                                        if ($od_amount_all > 0) {
                                                                            array_push($od_amount_all_array, $od_amount_all);
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }

                                                        if ($numOfInstallments == $x + 1) {

                                                            $ODDATES = new DateTime($date);
                                                            $ODDATES->modify('+23 hours +59 minutes +58 seconds');
                                                            $od_date_morning = $ODDATES->format('Y-m-d H:i:s');

                                                            //check log ends with od or installment 
                                                            $last_od_date = date('D/M/Y', strtotime($od_date_morning));
                                                            $last_installment_date = date('D/M/Y', strtotime($date));

                                                            if ($last_od_date == $last_installment_date) {
                                                                $last_loop_od = $od_interest;
                                                            } else {
                                                                $last_loop_od = 0;
                                                            }

                                                            //get installment end date
                                                            $INSTALLMENT_END = new DateTime($date);
                                                            $INSTALLMENT_END->modify('+1 day');
                                                            $installment_end = $INSTALLMENT_END->format('Y-m-d H:i:s');

                                                            //get 5 years ahead date from installment end date
                                                            $INSTALLMENT_UNLIMITED_END = new DateTime($date);
                                                            $INSTALLMENT_UNLIMITED_END->modify('+1725 day');
                                                            $installment_unlimited_end = $INSTALLMENT_UNLIMITED_END->format('Y-m-d H:i:s');


                                                            $start_1 = strtotime($date);
                                                            $end = strtotime(date("Y/m/d"));
                                                            $days_between = floor(abs($end - $start_1) / 86400) - 1;
                                                            $od = $OD->allOdByLoanAndDate($date, $balance);
                                                            $y = 0;

                                                            $od_date_start1 = new DateTime($date);
                                                            $od_date_start1->modify('+47 hours +59 minutes +58 seconds');

                                                            $defult_val = $days_between;


                                                            while ($y <= $defult_val) {

                                                                if ($od['od_date_start'] <= $od_date_start1) {
                                                                    $od_dates = '+1 day';
                                                                }

                                                                $od_date = $od_date_start1->format('Y-m-d H:i:s');

                                                                //getting echo $od_date; before of date from current od date
                                                                $OLDODDATE = new DateTime($od_date);
                                                                $od_date_remove1 = '-23 hours -59 minutes -58 seconds';

                                                                $OLDODDATE->modify($od_date_remove1);
                                                                $old_od_date = $OLDODDATE->format('Y-m-d H:i:s');

                                                                //strtotime(date("Y/m/d")) <= strtotime($old_od_date)
                                                                if ((strtotime(date("Y/m/d")) <= strtotime($od_date)) || strtotime($od['od_date_end'] . $time) < strtotime($old_od_date)) {
                                                                    break;
                                                                }
                                                                $od_array[] = $od_interest;
                                                                $od_amount_all = json_encode(array_sum($od_array));

                                                                if ($od_amount_all > 0 || $paid_all_od_before_ins_date == $last_od_amount) {

                                                                    array_push($od_amount_all_array, $od_amount_all);
                                                                }


                                                                $od_date_start1->modify($od_dates);
                                                                $y++;
                                                            }
                                                        }

                                                        $INSTALLMENT = new Installment(NULL);

                                                        $paid_aditional_interrest = 0;
                                                        $total_paid_installment = 0;

                                                        foreach ($INSTALLMENT->getInstallmentByLoan($LOAN->id) as $installment) {
                                                            $paid_aditional_interrest += $installment["additional_interest"];
                                                            $total_paid_installment = $total_paid_installment + $installment["paid_amount"];
                                                        }
                                                        //echo od amount
                                                        if ($od_amount_all > 0) {
                                                            if ($numOfInstallments == $x + 1) {
                                                                echo number_format($od_amount_all - $paid_aditional_interrest, 2);
                                                            } else {
                                                                echo number_format($od_amount_all, 2);
                                                            }
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
                                                    <th class="text-center">Ins: Amount</th>  
                                                    <th class="text-center">Ins: Total</th>  
                                                    <th class="text-center">Od Interest</th> 

                                                </tr>  
                                            </tfoot>
                                        </table>  
                                    <?php } else if ($LOAN->installment_type == 4) {
                                        ?>
                                        <table class="table table-bordered table-striped table-hover dataTable" id="installment-table">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">ID</th> 
                                                    <th class="text-center">Installment Date</th>  
                                                    <th class="text-center">Status</th> 
                                                    <th class="text-center">Ins: Amount</th>  
                                                    <th class="text-center">Ins: Total</th>  
                                                    <th class="text-center">Od Interest</th> 

                                                </tr>  
                                            </thead>
                                            <tbody>
                                                <?php
                                                $numOfInstallments = DefaultData::getNumOfInstlByPeriodAndType($LOAN->loan_period, $LOAN->installment_type);

                                                $first_installment_date = '';
                                                $installments = 0;
                                                if ($LOAN->installment_type == 4) {
                                                    $FID = new DateTime($LOAN->effective_date);
                                                    $FID->modify('+7 day');
                                                    $first_installment_date = $FID->format('Y-m-d H:i:s');
                                                } elseif ($LOAN->installment_type == 30) {
                                                    $FID = new DateTime($LOAN->effective_date);
                                                    $FID->modify('+1 day');
                                                    $first_installment_date = $FID->format('Y-m-d H:i:s');
                                                } elseif ($LOAN->installment_type == 1) {
                                                    $FID = new DateTime($LOAN->effective_date);
                                                    $FID->modify('+1 months');
                                                    $first_installment_date = $FID->format('Y-m-d H:i:s');
                                                }
                                                $start = new DateTime($first_installment_date);

                                                $first_date = $start->format('Y-m-d H:i:s');

                                                $x = 0;
                                                $count = 0;
                                                $ins_total = 0;
                                                $total_paid = 0;
                                                $od_array = array();
                                                $last_od = array();
                                                $od_total = array();
                                                $last_od_balance = array();
                                                $payment_arr = array();
                                                $od_balance_amount = array();

                                                while ($x < $numOfInstallments) {
                                                    if ($numOfInstallments == 4) {
                                                        $add_dates = '+7 day';
                                                    } elseif ($numOfInstallments == 30) {
                                                        $add_dates = '+1 day';
                                                    } elseif ($numOfInstallments == 8) {
                                                        $add_dates = '+7 day';
                                                    } elseif ($numOfInstallments == 60) {
                                                        $add_dates = '+1 day';
                                                    } elseif ($numOfInstallments == 2) {
                                                        $add_dates = '+1 months';
                                                    } elseif ($numOfInstallments == 1) {
                                                        $add_dates = '+1 months';
                                                    } elseif ($numOfInstallments == 90) {
                                                        $add_dates = '+1 day';
                                                    } elseif ($numOfInstallments == 12) {
                                                        $add_dates = '+7 day';
                                                    } elseif ($numOfInstallments == 3) {
                                                        $add_dates = '+1 months';
                                                    } elseif ($numOfInstallments == 100) {
                                                        $add_dates = '+1 day';
                                                    } elseif ($numOfInstallments == 13) {
                                                        $add_dates = '+7 day';
                                                    }

                                                    $count++;
                                                    $date = $start->format('Y-m-d H:i:s');
                                                    $customer = $LOAN->customer;

                                                    $CUSTOMER = new Customer($customer);
                                                    $route = $CUSTOMER->route;
                                                    $center = $CUSTOMER->center;
                                                    $amount = $LOAN->installment_amount;

                                                    $INSTALLMENT = new Installment(NULL);
                                                    $paid_amount = 0;
                                                    $od_amount = 0;
                                                    $repeat = 0;
                                                    $paid_all_amount_before_ins_date = 0;
                                                    $paid_all_od_before_ins_date = 0;


                                                    $FID = new DateTime($date);
                                                    $FID->modify($add_dates);
                                                    $day_remove = '-1 day';
                                                    $FID->modify($day_remove);
                                                    $second_installment_date = $FID->format('Y-m-d H:i:s');

                                                    $ALl_AMOUNT = $INSTALLMENT->getAmountByLoanId($LOAN->id);

                                                    foreach ($INSTALLMENT->CheckInstallmetBeetwenTwoDateByLoanId($date, $second_installment_date, $loan_id) as $paid) {
                                                        $paid_amount += $paid['paid_amount'];
                                                    }

                                                    $before_payment_amounts = $INSTALLMENT->getPaidAmountByBeforeDate($date, $LOAN->id);

                                                    foreach ($before_payment_amounts as $before_payment_amount) {
                                                        $paid_all_amount_before_ins_date += $before_payment_amount['paid_amount'];
                                                        $paid_all_od_before_ins_date += $before_payment_amount['additional_interest'];
                                                    }

                                                    if (PostponeDate::CheckIsPostPoneByDateAndCustomer($date, $customer) || PostponeDate::CheckIsPostPoneByDateAndRoute($date, $route) || PostponeDate::CheckIsPostPoneByDateAndCenter($date, $center) || PostponeDate::CheckIsPostPoneByDateAndAll($date) || PostponeDate::CheckIsPostPoneByDateCenterAll($date) || PostponeDate::CheckIsPostPoneByDateRouteAll($date)) {

                                                        echo '<tr>';
                                                        echo '<td class="padd-td gray ">';
                                                        echo $count;
                                                        echo '</td>';
                                                        echo '<td class="padd-td red">';
                                                        echo $date;
                                                        echo '</td>';
                                                        echo '<td class="padd-td gray text-center" >';
                                                        echo '-- Postponed --';
                                                        echo '</td>';
                                                        echo '<td class="padd-td gray text-center" >';
                                                        echo '</td>';
                                                        echo '<td class="padd-td gray text-center" >';
                                                        echo '</td>';
                                                        echo '<td class="padd-td gray text-center" >';
                                                        echo '</td>';
                                                        echo '</tr>';

                                                        if ($LOAN->installment_type == 4) {

                                                            $end = new DateTime($date);
                                                            $end->modify('+6 day');
                                                            $end = $end->format('Y-m-d');

                                                            $date = new DateTime($date);
                                                            $date->modify('+1 day');
                                                            $date = $date->format('Y-m-d');

                                                            $begin = new DateTime($date);
                                                            $end = new DateTime($end);

                                                            for ($i = $begin; $i <= $end; $i->modify('+1 day')) {

                                                                if (PostponeDate::CheckIsPostPoneByDateAndCustomer($date, $customer) || PostponeDate::CheckIsPostPoneByDateAndRoute($date, $route) || PostponeDate::CheckIsPostPoneByDateAndCenter($date, $center) || PostponeDate::CheckIsPostPoneByDateAndAll($date) || PostponeDate::CheckIsPostPoneByDateCenterAll($date) || PostponeDate::CheckIsPostPoneByDateRouteAll($date)) {
                                                                    $count++;
                                                                    echo '<tr>';
                                                                    echo '<td class="padd-td gray ">';
                                                                    echo $count;
                                                                    echo '</td>';
                                                                    echo '<td class="padd-td red">';
                                                                    echo $date;
                                                                    echo '</td>';
                                                                    echo '<td class="padd-td gray text-center" >';
                                                                    echo '-- Postponed --';
                                                                    echo '</td>';
                                                                    echo '<td class="padd-td gray text-center" >';
                                                                    echo '</td>';
                                                                    echo '<td class="padd-td gray text-center" >';
                                                                    echo '</td>';
                                                                    echo '<td class="padd-td gray text-center" >';
                                                                    echo '</td>';
                                                                    echo '</tr>';

                                                                    $repeat = strtotime("+1 day", strtotime($date));
                                                                    $date = date('Y-m-d', $repeat);
                                                                } else {

                                                                    $count++;
                                                                    echo '<tr>';
                                                                    echo '<td class="tr-color font-color-2">';
                                                                    echo $count;
                                                                    echo '</td>';
                                                                    echo '<td class="padd-td f-style tr-color font-color-2">';
                                                                    echo $date;
                                                                    echo '</td>';

                                                                    echo '<td class="f-style">';
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
                                                                    echo number_format($amount, 2);
                                                                    echo '</td>';

                                                                    echo '<td class="f-style">';
                                                                    $total_paid += $paid_amount;
                                                                    $due_and_excess = $ins_total;
                                                                    $ins_total += $amount;

                                                                    echo '<span style="color:red">' . number_format($ins_total, 2) . '</span>';
                                                                    echo '</td>';

                                                                    echo '<td class="f-style font-color-2 text-right">';
                                                                    echo '</td>';

                                                                    echo '</tr>';

                                                                    $end = strtotime("+1 day", strtotime($date));
                                                                    $end = date('Y-m-d', $repeat);
                                                                }
                                                            }
                                                        }
                                                    } else {

                                                        echo '<tr>';
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
                                                        echo number_format($amount, 2);
                                                        echo '</td>';

                                                        echo '<td class="f-style">';

                                                        $ins_total += $amount;
                                                        $total_paid += $paid_amount;
                                                        $due_and_excess = $total_paid - $ins_total;

                                                        $before_balance_amount = $paid_all_amount_before_ins_date - $ins_total;
                                                        $last_od_amount = (float) end($last_od);
                                                        $od_total_amount = (float) end($od_total);

                                                        $balance = $paid_all_od_before_ins_date + $paid_all_amount_before_ins_date - $ins_total - $od_total_amount;

                                                        echo '<span style="color:red">' . number_format($ins_total, 2) . '</span>';

                                                        echo '</td>';

                                                        echo '<td class="f-style">';
                                                        $OD = new OD(NULL);
                                                        $OD->loan = $LOAN->id;
                                                        $od = $OD->allOdByLoanAndDate($date, $balance);

                                                        if (strtotime(date("Y/m/d")) < strtotime($date) || PostponeDate::CheckIsPostPoneByDateAndCustomer($date, $customer) || PostponeDate::CheckIsPostPoneByDateAndRoute($date, $route) || PostponeDate::CheckIsPostPoneByDateAndCenter($date, $center) || PostponeDate::CheckIsPostPoneByDateAndAll($date) || PostponeDate::CheckIsPostPoneByDateCenterAll($date) || PostponeDate::CheckIsPostPoneByDateRouteAll($date) || $ALl_AMOUNT[0] >= $ins_total) {
                                                            
                                                        } else {
                                                            if ($od !== false) {


                                                                $od_interest = $LOAN->getOdIntereset(-$ins_total + $paid_all_amount_before_ins_date, $od['od_interest_limit']);

                                                                $y = 0;
                                                                $od_date_start = new DateTime($date);
                                                                $od_date_start->modify('+23 hours +59 minutes +58 seconds');
                                                                $defult_val = 6;

                                                                while ($y <= $defult_val) {

                                                                    if ($defult_val <= 6 && $od['od_date_start'] <= $od_date_start) {
                                                                        $od_dates = '+1 day';
                                                                    }


                                                                    $od_date = $od_date_start->format('Y-m-d H:i:s');

                                                                    $ODDATES = new DateTime($od_date);
                                                                    $ODDATES->modify($od_dates);

                                                                    $od_date_remove = '-1 day -23 hours -59 minutes -58 seconds';

                                                                    $ODDATES->modify($od_date_remove);

                                                                    $od_night = $ODDATES->format('Y-m-d H:i:s');


                                                                    if (strtotime(date("Y/m/d")) <= strtotime($od_date)) {
                                                                        break;
                                                                    }

                                                                    $od_array[] = $od_interest;
                                                                    $od_amount = json_encode(array_sum($od_array), 2);

                                                                    array_push($last_od, $od_interest);

                                                                    $od_date_start->modify($od_dates);
                                                                    $y++;
                                                                }
                                                            }
                                                        }

                                                        if ($numOfInstallments == $x + 1) {
                                                            //get installment end date
                                                            $INSTALLMENT_END = new DateTime($date);
                                                            $INSTALLMENT_END->modify('+7 day');
                                                            $installment_end = $INSTALLMENT_END->format('Y-m-d H:i:s');

                                                            //get 5 years ahead date from installment end date
                                                            $INSTALLMENT_UNLIMITED_END = new DateTime($date);
                                                            $INSTALLMENT_UNLIMITED_END->modify('+1725 day');
                                                            $installment_unlimited_end = $INSTALLMENT_UNLIMITED_END->format('Y-m-d H:i:s');

                                                            $start_1 = strtotime($date);
                                                            $end = strtotime(date("Y/m/d"));

                                                            $days_between = floor(abs($end - $start_1) / 86400) - 1;

                                                            $z = 0;

                                                            $od_date_start1 = new DateTime($od_night);
                                                            $od_date_start1->modify('+1 day +23 hours +59 minutes +58 seconds');
                                                            $defult_val = $days_between;


                                                            //if having od after installment end
                                                            if ($od !== false) {

                                                                $last_od_date = date('D/M/Y', strtotime($od_night));
                                                                $last_installment_date = date('D/M/Y', strtotime($date));

                                                                if ($last_od_date == $last_installment_date) {
                                                                    $last_loop_od = $od_interest;
                                                                } else {
                                                                    $last_loop_od = 0;
                                                                }
                                                                $od_amount_all_array_1 = array();

                                                                while ($z <= $defult_val) {

                                                                    if ($od['od_date_start'] <= $od_date_start1) {
                                                                        $od_dates = '+1 day';
                                                                    }

                                                                    $od_date1 = $od_date_start1->format('Y-m-d H:i:s');

                                                                    //getting brfore of date from current od date
                                                                    $OLDODDATE = new DateTime($od_date1);
                                                                    $od_date_remove1 = '-23 hours -59 minutes -58 seconds';

                                                                    $OLDODDATE->modify($od_date_remove1);
                                                                    $old_od_date = $OLDODDATE->format('Y-m-d H:i:s');

                                                                    if (strtotime(date("Y/m/d")) <= strtotime($old_od_date) || strtotime(date("Y/m/d")) <= strtotime($od_date1) || strtotime($od['od_date_end'] . $time) < strtotime($old_od_date)) {
                                                                        break;
                                                                    }

                                                                    $od_array[] = $od_interest;
                                                                    $od_amount = json_encode(round(array_sum($od_array), 2));

                                                                    if ($od_amount > 0 || $paid_all_od_before_ins_date == $last_od_amount) {

                                                                        array_push($od_amount_all_array_1, $od_amount);
                                                                    }

                                                                    array_push($last_od, end($od_amount_all_array_1));

                                                                    $last_od_amount = (float) end($od_amount_all_array_1);


                                                                    $od_date_start1->modify($od_dates);
                                                                    $z++;
                                                                }
                                                            }
                                                        }

                                                        $INSTALLMENT = new Installment(NULL);

                                                        $paid_aditional_interrest = 0;
                                                        $total_paid_installment = 0;

                                                        foreach ($INSTALLMENT->getInstallmentByLoan($LOAN->id) as $installment) {
                                                            $paid_aditional_interrest += $installment["additional_interest"];
                                                            $total_paid_installment = $total_paid_installment + $installment["paid_amount"];
                                                        }

                                                        if ($od_amount > 0) {
                                                            if ($numOfInstallments == $x + 1) {
                                                                $od_amount = $od_amount - $paid_aditional_interrest;
                                                                echo number_format($od_amount, 2);
                                                            } else {
                                                                $od_amount = $od_amount - $paid_aditional_interrest;                                                                echo number_format($od_amount, 2);
                                                            }
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
                                                    <th class="text-center">Ins: Amount</th>  
                                                    <th class="text-center">Ins: Total</th>  
                                                    <th class="text-center">Od Interest</th> 

                                                </tr>    
                                            </tfoot>
                                        </table>  
                                    <?php } else { ?>
                                        <table class="table table-bordered table-striped table-hover dataTable" id="installment-table">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">ID</th> 
                                                    <th class="text-center">Installment Date</th>  
                                                    <th class="text-center">Status</th> 
                                                    <th class="text-center">Ins: Amount</th>  
                                                    <th class="text-center">Ins: Total</th>  
                                                    <th class="text-center">Od Interest</th> 

                                                </tr>  
                                            </thead>
                                            <tbody>
                                                <?php
                                                $numOfInstallments = DefaultData::getNumOfInstlByPeriodAndType($LOAN->loan_period, $LOAN->installment_type);

                                                $first_installment_date = '';
                                                $installments = 0;
                                                if ($LOAN->installment_type == 4) {
                                                    $FID = new DateTime($LOAN->effective_date);
                                                    $FID->modify('+7 day');
                                                    $first_installment_date = $FID->format('Y-m-d H:i:s');
                                                } elseif ($LOAN->installment_type == 30) {
                                                    $FID = new DateTime($LOAN->effective_date);
                                                    $FID->modify('+1 day');
                                                    $first_installment_date = $FID->format('Y-m-d H:i:s');
                                                } elseif ($LOAN->installment_type == 1) {
                                                    $FID = new DateTime($LOAN->effective_date);
                                                    $FID->modify('+1 months');
                                                    $first_installment_date = $FID->format('Y-m-d H:i:s');
                                                }
                                                $start = new DateTime($first_installment_date);

                                                $first_date = $start->format('Y-m-d H:i:s');



                                                $x = 0;
                                                $count = 0;
                                                $ins_total = 0;
                                                $total_paid = 0;
                                                $od_array = array();
                                                $last_od = array();
                                                $od_total = array();
                                                $last_od_balance = array();
                                                $payment_arr = array();
                                                $od_balance_amount = array();

                                                while ($x < $numOfInstallments) {
                                                    if ($numOfInstallments == 4) {
                                                        $add_dates = '+7 day';
                                                    } elseif ($numOfInstallments == 30) {
                                                        $add_dates = '+1 day';
                                                    } elseif ($numOfInstallments == 8) {
                                                        $add_dates = '+7 day';
                                                    } elseif ($numOfInstallments == 60) {
                                                        $add_dates = '+1 day';
                                                    } elseif ($numOfInstallments == 2) {
                                                        $add_dates = '+1 months';
                                                    } elseif ($numOfInstallments == 1) {
                                                        $add_dates = '+1 months';
                                                    } elseif ($numOfInstallments == 90) {
                                                        $add_dates = '+1 day';
                                                    } elseif ($numOfInstallments == 12) {
                                                        $add_dates = '+7 day';
                                                    } elseif ($numOfInstallments == 3) {
                                                        $add_dates = '+1 months';
                                                    } elseif ($numOfInstallments == 100) {
                                                        $add_dates = '+1 day';
                                                    } elseif ($numOfInstallments == 13) {
                                                        $add_dates = '+7 day';
                                                    }

                                                    $count++;
                                                    $date = $start->format('Y-m-d H:i:s');
                                                    $customer = $LOAN->customer;

                                                    $CUSTOMER = new Customer($customer);
                                                    $route = $CUSTOMER->route;
                                                    $center = $CUSTOMER->center;
                                                    $amount = $LOAN->installment_amount;

                                                    $INSTALLMENT = new Installment(NULL);
                                                    $paid_amount = 0;
                                                    $od_amount = 0;
                                                    $repeat = 0;
                                                    $paid_all_amount_before_ins_date = 0;
                                                    $paid_all_od_before_ins_date = 0;


                                                    $FID = new DateTime($date);
                                                    $FID->modify($add_dates);
                                                    $day_remove = '-1 day';
                                                    $FID->modify($day_remove);
                                                    $second_installment_date = $FID->format('Y-m-d H:i:s');

                                                    $ALl_AMOUNT = $INSTALLMENT->getAmountByLoanId($LOAN->id);

                                                    foreach ($INSTALLMENT->CheckInstallmetBeetwenTwoDateByLoanId($date, $second_installment_date, $loan_id) as $paid) {
                                                        $paid_amount += $paid['paid_amount'];
                                                    }

                                                    $before_payment_amounts = $INSTALLMENT->getPaidAmountByBeforeDate($date, $LOAN->id);

                                                    foreach ($before_payment_amounts as $before_payment_amount) {
                                                        $paid_all_amount_before_ins_date += $before_payment_amount['paid_amount'];
                                                        $paid_all_od_before_ins_date += $before_payment_amount['additional_interest'];
                                                    }

                                                    if (PostponeDate::CheckIsPostPoneByDateAndCustomer($date, $customer) || PostponeDate::CheckIsPostPoneByDateAndRoute($date, $route) || PostponeDate::CheckIsPostPoneByDateAndCenter($date, $center) || PostponeDate::CheckIsPostPoneByDateAndAll($date) || PostponeDate::CheckIsPostPoneByDateCenterAll($date) || PostponeDate::CheckIsPostPoneByDateRouteAll($date)) {

                                                        echo '<tr>';
                                                        echo '<td class="padd-td gray ">';
                                                        echo $count;
                                                        echo '</td>';
                                                        echo '<td class="padd-td red">';
                                                        echo $date;
                                                        echo '</td>';
                                                        echo '<td class="padd-td gray text-center" >';
                                                        echo '-- Postponed --';
                                                        echo '</td>';
                                                        echo '<td class="padd-td gray text-center" >';
                                                        echo '</td>';
                                                        echo '<td class="padd-td gray text-center" >';
                                                        echo '</td>';
                                                        echo '<td class="padd-td gray text-center" >';
                                                        echo '</td>';
                                                        echo '</tr>';

                                                        if ($LOAN->installment_type == 1) {

                                                            $end = new DateTime($date);
                                                            $end->modify('+6 day');
                                                            $end = $end->format('Y-m-d');

                                                            $date = new DateTime($date);
                                                            $date->modify('+1 day');
                                                            $date = $date->format('Y-m-d');

                                                            $begin = new DateTime($date);
                                                            $end = new DateTime($end);

                                                            for ($i = $begin; $i <= $end; $i->modify('+1 day')) {

                                                                if (PostponeDate::CheckIsPostPoneByDateAndCustomer($date, $customer) || PostponeDate::CheckIsPostPoneByDateAndRoute($date, $route) || PostponeDate::CheckIsPostPoneByDateAndCenter($date, $center) || PostponeDate::CheckIsPostPoneByDateAndAll($date) || PostponeDate::CheckIsPostPoneByDateCenterAll($date) || PostponeDate::CheckIsPostPoneByDateRouteAll($date)) {
                                                                    $count++;
                                                                    echo '<tr>';
                                                                    echo '<td class="padd-td gray ">';
                                                                    echo $count;
                                                                    echo '</td>';
                                                                    echo '<td class="padd-td red">';
                                                                    echo $date;
                                                                    echo '</td>';
                                                                    echo '<td class="padd-td gray text-center" >';
                                                                    echo '-- Postponed --';
                                                                    echo '</td>';
                                                                    echo '<td class="padd-td gray text-center" >';
                                                                    echo '</td>';
                                                                    echo '<td class="padd-td gray text-center" >';
                                                                    echo '</td>';
                                                                    echo '<td class="padd-td gray text-center" >';
                                                                    echo '</td>';
                                                                    echo '</tr>';

                                                                    $repeat = strtotime("+1 day", strtotime($date));
                                                                    $date = date('Y-m-d', $repeat);
                                                                } else {

                                                                    $count++;
                                                                    echo '<tr>';
                                                                    echo '<td class="tr-color font-color-2">';
                                                                    echo $count;
                                                                    echo '</td>';
                                                                    echo '<td class="padd-td f-style tr-color font-color-2">';
                                                                    echo $date;
                                                                    echo '</td>';

                                                                    echo '<td class="f-style">';
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
                                                                    echo number_format($amount, 2);
                                                                    echo '</td>';

                                                                    echo '<td class="f-style">';
                                                                    $total_paid += $paid_amount;
                                                                    $due_and_excess = $ins_total;
                                                                    $ins_total += $amount;

                                                                    echo '<span style="color:red">' . number_format($ins_total, 2) . '</span>';
                                                                    echo '</td>';

                                                                    echo '<td class="f-style font-color-2 text-right">';
                                                                    echo '</td>';

                                                                    echo '</tr>';

                                                                    $end = strtotime("+1 day", strtotime($date));
                                                                    $end = date('Y-m-d', $repeat);
                                                                }
                                                            }
                                                        }
                                                    } else {

                                                        echo '<tr>';
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
                                                        echo number_format($amount, 2);
                                                        echo '</td>';

                                                        echo '<td class="f-style">';

                                                        $ins_total += $amount;
                                                        $total_paid += $paid_amount;
                                                        $due_and_excess = $total_paid - $ins_total;

                                                        $before_balance_amount = $paid_all_amount_before_ins_date - $ins_total;
                                                        $last_od_amount = (float) end($last_od);
                                                        $od_total_amount = (float) end($od_total);

                                                        $balance = $paid_all_od_before_ins_date + $paid_all_amount_before_ins_date - $ins_total - $od_total_amount;

                                                        echo '<span style="color:red">' . number_format($ins_total, 2) . '</span>';

                                                        echo '</td>';


                                                        echo '<td class="f-style">';
                                                        $OD = new OD(NULL);
                                                        $OD->loan = $LOAN->id;
                                                        $od = $OD->allOdByLoanAndDate($date, $balance);

                                                        //get date for month 
                                                        $dateValue = strtotime($date);
                                                        $year = date("Y", $dateValue);
                                                        $month = date("m", $dateValue);

                                                        $daysOfMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);


                                                        if (strtotime(date("Y/m/d")) < strtotime($date) || PostponeDate::CheckIsPostPoneByDateAndCustomer($date, $customer) || PostponeDate::CheckIsPostPoneByDateAndRoute($date, $route) || PostponeDate::CheckIsPostPoneByDateAndCenter($date, $center) || PostponeDate::CheckIsPostPoneByDateAndAll($date) || PostponeDate::CheckIsPostPoneByDateCenterAll($date) || PostponeDate::CheckIsPostPoneByDateRouteAll($date) || $ALl_AMOUNT[0] >= $ins_total) {
                                                            
                                                        } else {
                                                            if ($od !== false) {

                                                                $od_interest = $LOAN->getOdIntereset(-$ins_total + $paid_all_amount_before_ins_date, $od['od_interest_limit']);

                                                                $y = 0;
                                                                //get how many dates in month
                                                                $dateValue = strtotime($date);
                                                                $year = date("Y", $dateValue);
                                                                $month = date("m", $dateValue);

                                                                $daysOfMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);

                                                                $od_date_start = new DateTime($date);
                                                                $defult_val = $daysOfMonth - 1;
                                                                $od_interest = $LOAN->getOdIntereset(-$ins_total + $paid_all_amount_before_ins_date, $od['od_interest_limit']);

                                                                $od_amount_all_array_1 = array();
                                                                while ($y <= $defult_val) {

                                                                    if ($defult_val <= $daysOfMonth - 1 && $LOAN->od_date <= $od_date_start) {
                                                                        $od_dates = '+1 day';
                                                                    }

                                                                    $od_date = $od_date_start->format('Y-m-d');

                                                                    if (strtotime(date("Y/m/d")) <= strtotime($od_date)) {
                                                                        break;
                                                                    }

                                                                    $ODDATES = new DateTime($od_date);
                                                                    $ODDATES->modify($od_dates);

                                                                    $od_date_remove = '-1 day -23 hours -59 minutes -58 seconds';

                                                                    $ODDATES->modify($od_date_remove);
                                                                    $od_night = $ODDATES->format('Y-m-d H:i:s');

                                                                    $od_array[] = $od_interest;
                                                                    $od_amount = json_encode(array_sum($od_array), 2);

                                                                    if ($od_amount > 0 || $paid_all_od_before_ins_date == $last_od_amount) {

                                                                        array_push($od_amount_all_array_1, $od_amount);
                                                                    }

                                                                    array_push($last_od, end($od_amount_all_array_1));

                                                                    $last_od_amount = (float) end($od_amount_all_array_1);

                                                                    $od_date_start->modify($od_dates);
                                                                    $y++;
                                                                }
                                                            }
                                                        }
                                                        if ($numOfInstallments == $x + 1) {

                                                            //get installment end date
                                                            $INSTALLMENT_END = new DateTime($date);
                                                            $INSTALLMENT_END->modify('+' . $daysOfMonth . ' day');
                                                            $installment_end = $INSTALLMENT_END->format('Y-m-d H:i:s');

                                                            //get 5 years ahead date from installment end date
                                                            $INSTALLMENT_UNLIMITED_END = new DateTime($date);
                                                            $INSTALLMENT_UNLIMITED_END->modify('+1725 day');
                                                            $installment_unlimited_end = $INSTALLMENT_UNLIMITED_END->format('Y-m-d H:i:s');


                                                            $start_1 = strtotime($date);
                                                            $end = strtotime(date("Y/m/d"));

                                                            $days_between = floor(abs($end - $start_1) / 86400) - 1;

                                                            $z = 0;

                                                            $od_date_start1 = new DateTime($od_night);
                                                            $od_date_start1->modify('+1 day +23 hours +59 minutes +58 seconds');

                                                            $defult_val = $days_between;

                                                            //if having od after installment end
                                                            if ($od !== false) {

                                                                $last_od_date = date('D/M/Y', strtotime($od_night));
                                                                $last_installment_date = date('D/M/Y', strtotime($date));

                                                                $od_amount_all_array_2 = array();
                                                                while ($z <= $defult_val) {

                                                                    if ($od['od_date_start'] <= $od_date_start1) {
                                                                        $od_dates = '+1 day';
                                                                    }

                                                                    $od_date1 = $od_date_start1->format('Y-m-d');

                                                                    if ((strtotime(date("Y/m/d")) <= strtotime($od_date1) || strtotime($od['od_date_end'] . $time) <= strtotime($od_date1 . $time))) {
                                                                        break;
                                                                    }
                                                                    //getting brfore of date from current od date
                                                                    $OLDODDATE = new DateTime($od_date1);

                                                                    $od_date_remove1 = '-23 hours -59 minutes -58 seconds';

                                                                    $OLDODDATE->modify($od_date_remove1);

                                                                    $old_od_date = $OLDODDATE->format('Y-m-d H:i:s');

                                                                    $od_array[] = $od_interest;
                                                                    $od_amount = json_encode(array_sum($od_array), 2);

                                                                    if ($od_amount > 0 || $paid_all_od_before_ins_date == $last_od_amount) {

                                                                        array_push($od_amount_all_array_2, $od_amount);
                                                                    }

                                                                    array_push($last_od, end($od_amount_all_array_2));


                                                                    $od_date_start1->modify($od_dates);
                                                                    $z++;

                                                                    $last_od_amount = (float) end($od_amount_all_array_2);
                                                                }
                                                            }
                                                        }


                                                        $INSTALLMENT = new Installment(NULL);

                                                        $paid_aditional_interrest = 0;
                                                        $total_paid_installment = 0;

                                                        foreach ($INSTALLMENT->getInstallmentByLoan($LOAN->id) as $installment) {
                                                            $paid_aditional_interrest += $installment["additional_interest"];
                                                            $total_paid_installment = $total_paid_installment + $installment["paid_amount"];
                                                        }
                                                        if ($od_amount > 0) {
                                                            if ($numOfInstallments == $x + 1) {
                                                                echo number_format($od_amount - $paid_aditional_interrest, 2);
                                                            } else {
                                                                echo number_format($od_amount - $paid_aditional_interrest, 2);
                                                            }
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
                                                    <th class="text-center">Ins: Amount</th>  
                                                    <th class="text-center">Ins: Total</th>  
                                                    <th class="text-center">Od Interest</th> 

                                                </tr>    
                                            </tfoot>
                                        </table>                        

                                    <?php } ?>
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
        <script type="text/javascript">
            $(document).ready(function () {
                $('#installment-table').DataTable({
                    "order": [[0, "desc"]],
                    responsive: true,

                });
            });
        </script>
    </body>
</body> 
</html> 