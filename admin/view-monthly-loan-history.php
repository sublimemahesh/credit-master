<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/auth.php');

date_default_timezone_set('Asia/Colombo');
//check user level
$USERS = new User($_SESSION['id']);
$DEFAULTDATA = new DefaultData(NULL);
$DEFAULTDATA->checkUserLevelAccess('1,2,3', $USERS->user_level);

$loan_id = $_GET['id'];
$LOAN = new Loan($loan_id);
$today = date("Y-m-d H:i:s");
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
        <link href="css/table-scroll.css" rel="stylesheet" type="text/css"/>
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

                                    <h5>Loan Amount : <?php echo number_format($LOAN->loan_amount, 2) ?> </h5>

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
                                    <h5>
<!--                                        <a href="view-all-loan-history.php?customer_id=<?php echo $LOAN->customer ?>&loan_id=<?php echo $LOAN->id ?>">
                                            <button  style="text-align: right"  class="btn btn-primary  ">All History</button>
                                        </a>-->
                                    </h5>
                                </div>
                                <div class="table-responsive ">
                                    <table class="table table-bordered table-striped table-hover dataTable" id="history-table">
                                        <thead>
                                            <tr>
                                                <th class="text-right th-width">ID</th>
                                                <th class="text-right th-width-2">Date</th> 
                                                <th class="text-right th-width">Trans:ID</th>     
                                                <th class="text-right th-width-2">Status</th>
                                                <th class="text-right th-width">DEBIT</th>
                                                <th class="text-right th-width-2">CREDIT</th>
                                                <th class="text-right">BALANCE</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $row_count = 0;
                                            $no_of_installments = DefaultData::getNumOfInstlByPeriodAndType($LOAN->loan_period, $LOAN->installment_type);

                                            $first_installment_date = '';
                                            $installments = 0;
                                            $all_amount = 0;
                                            $balance = 0;
                                            $all_paid_dowonpayments = 0;
                                            $all_paid_processing_fee = 0;
                                            if ($LOAN->installment_type == 4) {
                                                $FID = new DateTime($LOAN->effective_date . " 00:00:01");
                                                $FID->modify('+7 day');
                                                $first_installment_date = $FID->format('Y-m-d H:i:s');
                                            } elseif ($LOAN->installment_type == 30) {
                                                $FID = new DateTime($LOAN->effective_date . " 00:00:01");
                                                $FID->modify('+1 day');
                                                $first_installment_date = $FID->format('Y-m-d H:i:s');
                                            } elseif ($LOAN->installment_type == 1) {
                                                $FID = new DateTime($LOAN->effective_date . " 00:00:01");
                                                $FID->modify('+1 months');
                                                $first_installment_date = $FID->format('Y-m-d H:i:s');
                                            }
                                            $start = new DateTime($first_installment_date);

                                            $first_date = $start->format('Y-m-d H:i:s');
                                            $INSTALLMENT = new Installment(NULL);
                                            $row_count++;


                                            foreach ($INSTALLMENT->getOtherPaymentByLoan($LOAN->id) as $installment_type) {

                                                if ($installment_type['type'] == 'down_payment') {
                                                    ?>
                                                    <tr style="background-color: lightsalmon;">     
                                                        <td>
                                                            <?php
                                                            $row_count++;
                                                            echo $row_count;
                                                            ?> 
                                                        </td>
                                                        <td class="font-colors text-right f-style"> <?php echo $installment_type['paid_date'] . ' / ' . $installment_type['time'] ?></td>   
                                                        <td class="font-colors text-right f-style">  </td>    
                                                        <td class="font-colors text-right f-style"> down Payment</td>
                                                        <td class="font-colors text-right f-style">  </td>
                                                        <td class="font-colors text-right f-style"> <?php echo number_format($installment_type['paid_amount'], 2) . '</p>' ?> </td>                                                 
                                                        <td class=" font-colors text-right f-style" > <?php
                                                            if ($balance == 0) {
                                                                $balance = $balance + $installment_type['paid_amount'];
                                                                echo number_format($balance, 2);
                                                            } else {
                                                                $balance = $balance + $installment_type['paid_amount'];
                                                                echo number_format($balance, 2);
                                                            }
                                                            ?> 
                                                        </td>                                                 
                                                    </tr>
                                                    <?php
                                                }
                                            }

                                            foreach ($INSTALLMENT->getOtherPaymentByLoan($LOAN->id) as $installment_type) {

                                                if ($installment_type['type'] == 'loan_processing_fee' && $installment_type['paid_date'] <= $first_date) {
                                                    ?>

                                                    <tr style="background-color: lightseagreen;">     
                                                        <td>
                                                            <?php
                                                            $row_count++;
                                                            echo $row_count;
                                                            ?> 
                                                        </td>
                                                        <td class="font-colors text-right f-style"> <?php echo $installment_type['paid_date'] . ' / ' . $installment_type['time'] ?></td>   
                                                        <td class="font-colors text-right f-style">  </td>    
                                                        <td class="font-colors text-right f-style">Processing Fee Paid</td>
                                                        <td class="font-colors text-right f-style">  </td>
                                                        <td class="font-colors text-right f-style"> <?php echo number_format($installment_type['paid_amount'], 2) . '</p>' ?> </td>                                                 
                                                        <td class=" font-colors text-right f-style" > <?php
                                                            if ($balance == 0) {
                                                                $balance = $balance + $installment_type['paid_amount'];
                                                                echo number_format($balance, 2);
                                                            } else {
                                                                $balance = $balance + $installment_type['paid_amount'];
                                                                echo number_format($balance, 2);
                                                            }
                                                            ?> 
                                                        </td>                                                 
                                                    </tr>
                                                    <?php
                                                }
                                            }


                                            if ($LOAN->issue_mode == 'bank') {
                                                ?>

                                                <tr style="background-color: white;">    
                                                    <td>
                                                        <?php
                                                        $row_count++;
                                                        echo $row_count;
                                                        ?> 
                                                    </td>
                                                    <td class="font-colors text-right f-style"> <?php echo $first_date ?></td>                                                 
                                                    <td class="font-colors text-right f-style">  </td>                                                 
                                                    <td class="font-colors text-right f-style"> Released</td>
                                                    <td class="font-colors text-right f-style">  </td>
                                                    <td class="font-colors text-right f-style"><?php echo number_format($LOAN->loan_amount, 2) ?>  </td>                                                 
                                                    <td class=" font-colors text-right f-style" > <?php echo number_format($LOAN->loan_amount, 2) ?>                                               </td>                                                 
                                                </tr>
                                            <?php } else {
                                                ?>
                                                <tr style="background-color: white;">    
                                                    <td>
                                                        <?php
                                                        $row_count++;
                                                        echo $row_count;
                                                        ?> 
                                                    </td>
                                                    <td class="font-colors text-right f-style"> <?php echo $LOAN->effective_date ?></td>                                                 
                                                    <td class="font-colors text-right f-style">  </td>                                                 
                                                    <td class="font-colors text-right f-style"> Released</td>
                                                    <td class="font-colors text-right f-style">  </td>
                                                    <td class="font-colors text-right f-style"><?php echo number_format($LOAN->loan_amount, 2) ?>  </td>                                                 
                                                    <td class=" font-colors text-right f-style" > <?php
                                                        //total relesed amount
                                                        $balance = $LOAN->loan_amount + $balance;
                                                        echo number_format($balance, 2);
                                                        ?>                  
                                                    </td>                                                 
                                                </tr>

                                                <?php
                                            }
                                            ?>

                                            <?php if ($LOAN->balance_of_last_loan) { ?>
                                                <tr style="background-color: white;">     
                                                    <td>
                                                        <?php
                                                        $row_count++;
                                                        echo $row_count;
                                                        ?> 
                                                    </td>
                                                    <td class="font-colors text-right f-style"> <?php echo $LOAN->effective_date ?></td>   
                                                    <td class="font-colors text-right f-style">  </td>    
                                                    <td class="font-colors text-right f-style">Balance of L:Loan</td>
                                                    <td class="font-colors text-right f-style">  <?php echo '<p style="color:red">' . number_format($LOAN->balance_of_last_loan, 2) . '</p>' ?></td>
                                                    <td class="font-colors text-right f-style">  </td>                                                 
                                                    <td class=" font-colors text-right f-style" > <?php
                                                        $balance = $balance - $LOAN->balance_of_last_loan;
                                                        echo number_format($balance, 2)
                                                        ?> 
                                                    </td>                                                 
                                                </tr>
                                            <?php } ?>


                                            <tr style="background-color: white;">     
                                                <td>
                                                    <?php
                                                    $row_count++;
                                                    echo $row_count;
                                                    ?> 
                                                </td>
                                                <td class="font-colors text-right f-style"> <?php echo $LOAN->effective_date ?></td>   
                                                <td class="font-colors text-right f-style">  </td>    
                                                <td class="font-colors text-right f-style">Processing Fee</td>
                                                <td class="font-colors text-right f-style">  <?php echo '<p style="color:red">' . number_format($LOAN->loan_processing_pre, 2) . '</p>' ?></td>
                                                <td class="font-colors text-right f-style">  </td>                                                 
                                                <td class=" font-colors text-right f-style" > <?php
                                                    $balance = $balance - $LOAN->loan_processing_pre;
                                                    echo number_format($balance, 2);
                                                    ?> 
                                                </td>                                                 
                                            </tr>

                                            <?php
                                            if ($LOAN->status == "issued") {
                                                ?>

                                                <tr style="background-color: white;">
                                                    <td><?php
                                                        $row_count++;
                                                        echo $row_count;
                                                        ?>
                                                    </td>
                                                    <td class="font-colors text-right f-style"><?php echo $LOAN->issued_date ?></td>  
                                                    <td class="font-colors text-right f-style">  </td>    
                                                    <td class="font-colors text-right f-style">Issued</td>
                                                    <td class="font-colors text-right f-style"> 
                                                        <?php
                                                        echo '<p style="color:red">' . number_format($balance, 2) . '</p>'
                                                        ?>
                                                    </td>      
                                                    <td class="font-colors text-right f-style">  </td> 
                                                    <td class="text-right font-colors f-style">
                                                        0.00
                                                        <?php
                                                        $balance = 0;
                                                        ?>
                                                    </td>                                                 
                                                </tr> 

                                                <?php
                                            }


                                            foreach ($INSTALLMENT->CheckInstallmetDateByLoanId($first_date, $LOAN->id) as $installments) {
                                                $row_count++;
                                                if ($installments['type'] == 'installment') {
                                                    ?>
                                                    <tr  id="payment-color">   
                                                        <td><?php echo $row_count; ?></td>
                                                        <td class="font-colors text-right f-style"><?php echo $installments['paid_date']; ?></td>     
                                                        <td class="font-colors text-right f-style">  </td>    
                                                        <td class="font-colors text-right f-style"> <?php
                                                            if ($installments['status'] == 'paid' || 'Paid')
                                                                echo 'Receipt';
                                                            ?></td>
                                                        <td class="font-colors text-right f-style"> </td>
                                                        <td class="font-colors text-right f-style">
                                                            <?php echo number_format($installments['paid_amount'], 2); ?>
                                                        </td>                                                 
                                                        <td class="font-colors text-right f-style">  <?php
                                                            $balance += $installments['paid_amount'];
                                                            echo number_format($balance, 2);
                                                            ?></td>
                                                    </tr>
                                                    <?php
                                                }
                                            }

                                            $previus_amount = 0;
                                            $paid_amount_beetwen_dates = 0;
                                            $previus_amount += $installments['paid_amount'];

                                            $x = 0;
                                            $ins_total = 0;
                                            $total_paid = 0;
                                            $one_ins_amount = 0;
                                            $total_paid_amount = 0;
                                            $od_array = array();
                                            $last_od = array();
                                            $od_total = array();
                                            $last_od_balance = array();
                                            $payment_arr = array();

                                            //dsw
                                            $od_balance_amount = array();


                                            while ($x < $no_of_installments) {
                                                if ($no_of_installments == 4) {
                                                    $add_dates = '+7 day';
                                                } elseif ($no_of_installments == 30) {
                                                    $add_dates = '+1 day';
                                                } elseif ($no_of_installments == 8) {
                                                    $add_dates = '+7 day';
                                                } elseif ($no_of_installments == 60) {
                                                    $add_dates = '+1 day';
                                                } elseif ($no_of_installments == 2) {
                                                    $add_dates = '+1 months';
                                                } elseif ($no_of_installments == 1) {
                                                    $add_dates = '+1 months';
                                                } elseif ($no_of_installments == 90) {
                                                    $add_dates = '+1 day';
                                                } elseif ($no_of_installments == 12) {
                                                    $add_dates = '+7 day';
                                                } elseif ($no_of_installments == 3) {
                                                    $add_dates = '+1 months';
                                                } elseif ($no_of_installments == 100) {
                                                    $add_dates = '+1 day';
                                                } elseif ($no_of_installments == 13) {
                                                    $add_dates = '+7 day';
                                                }


                                                $date = $start->format('Y-m-d H:i:s');

                                                $customer = $LOAN->customer;
                                                $CUSTOMER = new Customer($customer);
                                                $route = $CUSTOMER->route;
                                                $center = $CUSTOMER->center;
                                                $amount = $LOAN->installment_amount;
                                                $INSTALLMENT = new Installment(NULL);
                                                $paid_amount = 0;
                                                $od_amount = 0;
                                                $due_and_excess = 0;
                                                $ins_total_all = 0;
                                                $total_paid_all = 0;
                                                //dsw
                                                $od_balance = 0;
                                                $paid_all_amount_before_ins_date = 0;
                                                $paid_all_od_before_ins_date = 0;
                                                $PaidOD = 0;
                                                $paidadditional_interest = 0;

                                                $FIDS = new DateTime($date);
                                                $FIDS->modify($add_dates);
                                                $day_remove = '-2 seconds';

                                                $FIDS->modify($day_remove);
                                                $second_installment_date = $FIDS->format('Y-m-d H:i:s');
                                                $ALl_AMOUNT = $INSTALLMENT->getAmountByLoanId($LOAN->id);


                                                if (strtotime(date("Y/m/d") . " 00:00:01") < strtotime($date)) {
                                                    break;
                                                }

                                                foreach ($INSTALLMENT->CheckInstallmetBeetwenTwoDateByLoanId($date, $second_installment_date, $loan_id) as $paid) {
                                                    $paid_amount += $paid['paid_amount'];
                                                }

                                                $before_payment_amounts = $INSTALLMENT->getPaidAmountByBeforeDate($date, $LOAN->id);

                                                foreach ($before_payment_amounts as $before_payment_amount) {
                                                    $paid_all_amount_before_ins_date += $before_payment_amount['paid_amount'];
                                                    $paid_all_od_before_ins_date += $before_payment_amount['additional_interest'];
                                                }
                                                $row_count++;

                                                if (PostponeDate::CheckIsPostPoneByDateAndCustomer($date, $customer) || PostponeDate::CheckIsPostPoneByDateAndRoute($date, $route) || PostponeDate::CheckIsPostPoneByDateAndCenter($date, $center) || PostponeDate::CheckIsPostPoneByDateAndAll($date) || PostponeDate::CheckIsPostPoneByDateCenterAll($date) || PostponeDate::CheckIsPostPoneByDateRouteAll($date)) {
                                                    echo '<tr>';
                                                    echo '<td class="padd-td gray">';
                                                    echo $row_count;
                                                    echo '</td>';
                                                    echo '<td class="padd-td red ">';
                                                    echo $date;
                                                    echo '</td>';
                                                    echo '<td class="padd-td red ">';
                                                    echo '</td>';

                                                    echo '<td class="padd-td gray text-right"  >';
                                                    echo '-- Postponed --';
                                                    echo '</td>';
                                                    echo '<td class="padd-td gray text-center"  >';

                                                    echo '</td>';
                                                    echo '<td class="padd-td gray text-center"  >';
                                                    echo '</td>';
                                                    echo '<td class="padd-td gray text-center"  >';
                                                    echo '</td>';
                                                    echo '</tr>';

                                                    $x--;
                                                    ///monthly and weekly
                                                    if ($LOAN->installment_type == 4 || $LOAN->installment_type == 1) {
                                                        $row_count++;
                                                        $POSTD = new DateTime($date);
                                                        $POSTD->modify('+1 day');
                                                        $date = $POSTD->format('Y-m-d H:i:s');

                                                        echo '<tr>';
                                                        echo '<td class"tr-color font-color-2"  id="back-color">';
                                                        echo $row_count;
                                                        echo '</td>';
                                                        echo '<td class="padd-td f-style tr-color font-color-2" id="back-color">';
                                                        echo $date;
                                                        echo '</td>';
                                                        echo '<td class="padd-td f-style tr-color font-color-2" id="back-color">';

                                                        echo '</td>';
                                                        echo '<td class="f-style tr-color font-color-2" id="back-color">';
                                                        echo 'Installment';
                                                        echo '</td>';

                                                        echo '<td class="f-style tr-color font-color-2" id="back-color">';
                                                        echo '<p style="color:red">' . number_format($amount, 2) . '</p>  ';
                                                        echo '</td>';

                                                        echo '<td class="f-style tr-color font-color-2" id="back-color">';
                                                        echo '</td>';

                                                        echo '<td class="f-style tr-color font-color-2" id="back-color">';
                                                        //installment balance
//                                                        $installment_balance = $balance - $ins_total;
//
//                                                        $balance = $paid_all_amount_before_ins_date - $ins_total;
//
//                                                        echo number_format($balance, 2);

                                                        $ins_total += $amount;
                                                        $total_paid += $paid_amount;
                                                        $due_and_excess = $total_paid - $ins_total;

                                                        $before_balance_amount = $paid_all_amount_before_ins_date - $ins_total;
                                                        $last_od_amount = (float) end($last_od);
                                                        $od_total_amount = (float) end($od_total);


                                                        //dsw
                                                        $last_pay_total = (float) end($payment_arr);

//                                                    echo $before_balance_amount - $last_od;
                                                        //installment last balance
//                                                    $before_installment = (-1 * ($amount)) + $last_od_total - $paid_all_amount_before_ins_date;
                                                        //installment balance daily
                                                        $balance = $paid_all_od_before_ins_date + $paid_all_amount_before_ins_date - $ins_total - $od_total_amount;

                                                        echo number_format($balance, 2);

                                                        echo '</td>';
                                                        echo '</tr>';
                                                    }
                                                } else {


                                                    echo '<tr>';
                                                    echo '<td class"tr-color font-color-2"  id="back-color">';
                                                    echo $row_count;
                                                    echo '</td>';
                                                    echo '<td class="padd-td f-style tr-color font-color-2" id="back-color">';
                                                    echo $date;
                                                    echo '</td>';
                                                    echo '<td class="padd-td f-style tr-color font-color-2" id="back-color">';

                                                    echo '</td>';
                                                    echo '<td class="f-style tr-color font-color-2" id="back-color">';
                                                    echo 'Installment';
                                                    echo '</td>';

                                                    echo '<td class="f-style tr-color font-color-2" id="back-color">';
                                                    echo '<p style="color:red">' . number_format($amount, 2) . '</p>  ';
                                                    echo '</td>';

                                                    echo '<td class="f-style tr-color font-color-2" id="back-color">';
                                                    echo '</td>';

                                                    echo '<td class="f-style tr-color font-color-2" id="back-color">';
                                                    $ins_total += $amount;
                                                    $total_paid += $paid_amount;
                                                    $due_and_excess = $total_paid - $ins_total;

                                                    $before_balance_amount = $paid_all_amount_before_ins_date - $ins_total;
                                                    $last_od_amount = (float) end($last_od);
                                                    $od_total_amount = (float) end($od_total);





//                                                    echo $before_balance_amount - $last_od;
                                                    //installment last balance
//                                                    $before_installment = (-1 * ($amount)) + $last_od_total - $paid_all_amount_before_ins_date;
                                                    //installment balance daily
                                                    $balance = $paid_all_od_before_ins_date + $paid_all_amount_before_ins_date - $ins_total - $od_total_amount;

                                                    echo number_format($balance, 2);
//                                                    echo (-1 * ($amount)) - $last_pay_total + $last_pay_total;

                                                    echo '</td>';
                                                }
                                                echo '</tr>';

                                                $ArriersNoofInstallment = floor(($ins_total - $paid_all_amount_before_ins_date) / $amount);
                                                $ArriersInstallmentAmount = -1 * ($ArriersNoofInstallment * $amount);
                                                //not having od and payments betwwen only installments
                                                //Od new code segment
                                                $OD = new OD(NULL);
                                                $OD->loan = $LOAN->id;

                                                $od = $OD->allOdByLoanAndDate($date, $balance);


                                                if (strtotime(date("Y/m/d")) < strtotime($date) || PostponeDate::CheckIsPostPoneByDateAndCustomer($date, $customer) || PostponeDate::CheckIsPostPoneByDateAndRoute($date, $route) || PostponeDate::CheckIsPostPoneByDateAndCenter($date, $center) || PostponeDate::CheckIsPostPoneByDateAndAll($date) || PostponeDate::CheckIsPostPoneByDateCenterAll($date) || PostponeDate::CheckIsPostPoneByDateRouteAll($date)) {
                                                    
                                                } else {
                                                    if ($od !== false) {
                                                        $od_interest = $LOAN->getOdIntereset(-$ins_total + $paid_all_amount_before_ins_date, $od['od_interest_limit']);

                                                        $y = 0;

                                                        //get month and year from inst date
                                                        $dateValue = strtotime($date);
                                                        $year = date("Y", $dateValue);
                                                        $month = date("m", $dateValue);

                                                        $daysOfMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);

                                                        $od_date_start = new DateTime($date);

                                                        $od_date_start->modify('+23 hours +59 minutes +58 seconds');



                                                        $defult_val = $daysOfMonth - 1;

                                                        while ($y <= $defult_val) {

                                                            if ($defult_val <= $daysOfMonth - 1 && $od['od_date_start'] <= $od_date_start) {
                                                                $od_dates = '+1 day';
                                                            }

                                                            $row_count++;
                                                            $od_date = $od_date_start->format('Y-m-d H:i:s');

                                                            //// od dates range

                                                            $ODDATES = new DateTime($od_date);
                                                            $ODDATES->modify($od_dates);

                                                            $od_date_remove = '-1 day -23 hours -59 minutes -58 seconds';

                                                            $ODDATES->modify($od_date_remove);

                                                            $od_night = $ODDATES->format('Y-m-d H:i:s');

                                                            //get receipts if od loop ends in current date(od loop break in current date)
                                                            if (strtotime(date("Y/m/d")) <= strtotime($od_date)) {

                                                                $SS = $ODDATES->modify('+30 days');

                                                                $ss = $SS->format('Y-m-d H:i:s');


                                                                foreach ($INSTALLMENT->CheckInstallmetBeetwenTwoDateByLoanId($od_night, $ss, $loan_id) as $Installment_payment) {
                                                                    ?>
                                                                    <tr  id="payment-color">  
                                                                        <td>
                                                                            <?php echo $row_count; ?>
                                                                        </td>                                                       
                                                                        <td class="font-colors text-right f-style">
                                                                            <?php echo $Installment_payment['paid_date']; ?>
                                                                        </td>
                                                                        <td class="font-colors text-right f-style">

                                                                        </td>
                                                                        <td class="font-colors text-right f-style">
                                                                            <?php
                                                                            if ($Installment_payment['status'] == 'paid' || 'Paid')
                                                                                echo 'Receipt';
                                                                            ?>
                                                                        </td>
                                                                        <td class="font-colors text-right f-style"></td>                                                      
                                                                        <td class="font-colors text-right f-style">
                                                                            <?php echo number_format($Installment_payment['paid_amount'] + $Installment_payment['additional_interest'], 2); ?>
                                                                        </td>
                                                                        <td class="font-colors text-right f-style">
                                                                            <?php
                                                                            $before_all_balnce_amount = $balance + $Installment_payment['paid_amount'];
//                                                                            $payment_balance = -1 * ($ins_total) + $Installment_payment['paid_amount'] + $Installment_payment['additional_interest'];
//                                                                            array_push($payment_arr, $payment_balance);
                                                                            //
                                                                    $balance = $balance + $Installment_payment['paid_amount'] + $Installment_payment['additional_interest'];
                                                                            if (($od_amount - $od_total_amount) < 0) {
                                                                                $dd = 0;
                                                                            } else {
                                                                                $dd = ($od_amount - $od_total_amount);
                                                                            }
                                                                            echo number_format($balance - ($dd), 2);

                                                                            $row_count++
                                                                            ?>
                                                                        </td>
                                                                    </tr>
                                                                    <?php
                                                                }
                                                                break;
                                                            }

                                                            foreach ($INSTALLMENT->CheckInstallmetBeetwenTwoDateByLoanId($od_night, $od_date, $loan_id) as $Installment_payment) {
                                                                $row_count++;
                                                                ?>

                                                                <tr  id="payment-color">  
                                                                    <td>
                                                                        <?php echo $row_count; ?>
                                                                    </td>                                                       
                                                                    <td class="font-colors text-right f-style">
                                                                        <?php echo $Installment_payment['paid_date']; ?>
                                                                    </td>
                                                                    <td class="font-colors text-right f-style">

                                                                    </td>
                                                                    <td class="font-colors text-right f-style">
                                                                        <?php
                                                                        if ($Installment_payment['status'] == 'paid' || 'Paid')
                                                                            echo 'Receipt';
                                                                        ?>
                                                                    </td>
                                                                    <td class="font-colors text-right f-style"></td>                                                      
                                                                    <td class="font-colors text-right f-style">
                                                                        <?php echo number_format($Installment_payment['paid_amount'] + $Installment_payment['additional_interest'], 2); ?>
                                                                    </td>
                                                                    <td class="font-colors text-right f-style">
                                                                        <?php
                                                                        $before_all_balnce_amount = $balance + $Installment_payment['paid_amount'];
//                                                                            $payment_balance = -1 * ($ins_total) + $Installment_payment['paid_amount'] + $Installment_payment['additional_interest'];
//                                                                            array_push($payment_arr, $payment_balance);
                                                                        //
                                                                    $balance = $balance + $Installment_payment['paid_amount'] + $Installment_payment['additional_interest'];
                                                                        if (($od_amount - $od_total_amount) < 0) {
                                                                            $dd = 0;
                                                                        } else {
                                                                            $dd = ($od_amount - $od_total_amount);
                                                                        }
                                                                        echo number_format($balance - ($dd), 2);

                                                                        $row_count++
                                                                        ?>
                                                                    </td>
                                                                </tr>

                                                                <?php
                                                            }
                                                            if ((-1 * ($od['od_interest_limit'])) < ($balance)) {
                                                                foreach ($INSTALLMENT->CheckInstallmetBeetwenTwoDateByLoanId($od_date, $second_installment_date, $loan_id) as $Installment_payment) {
                                                                    $row_count++;
                                                                    ?>

                                                                    <tr  id="payment-color">  
                                                                        <td>
                                                                            <?php echo $row_count; ?>
                                                                        </td>                                                       
                                                                        <td class="font-colors text-right f-style">
                                                                            <?php echo $Installment_payment['paid_date']; ?>
                                                                        </td>
                                                                        <td class="font-colors text-right f-style">

                                                                        </td>
                                                                        <td class="font-colors text-right f-style">
                                                                            <?php
                                                                            if ($Installment_payment['status'] == 'paid' || 'Paid')
                                                                                echo 'Receipt';
                                                                            ?>
                                                                        </td>
                                                                        <td class="font-colors text-right f-style"></td>                                                      
                                                                        <td class="font-colors text-right f-style">
                                                                            <?php echo number_format($Installment_payment['paid_amount'] + $Installment_payment['additional_interest'], 2); ?>
                                                                        </td>
                                                                        <td class="font-colors text-right f-style">
                                                                            <?php
                                                                            $before_all_balnce_amount = $balance + $Installment_payment['paid_amount'];
//                                                                            $payment_balance = -1 * ($ins_total) + $Installment_payment['paid_amount'] + $Installment_payment['additional_interest'];
//                                                                            array_push($payment_arr, $payment_balance);
                                                                            //
                                                                    $balance = $balance + $Installment_payment['paid_amount'] + $Installment_payment['additional_interest'];
                                                                            if (($od_amount - $od_total_amount) < 0) {
                                                                                $dd = 0;
                                                                            } else {
                                                                                $dd = ($od_amount - $od_total_amount);
                                                                            }
                                                                            echo number_format($balance - ($dd), 2);

                                                                            $row_count++
                                                                            ?>
                                                                        </td>
                                                                    </tr>
                                                                    <?php
                                                                }
                                                                break;
                                                            }
                                                            if (strtotime($od['od_date_end']) <= strtotime($od_date)) {

                                                                foreach ($INSTALLMENT->CheckInstallmetBeetwenTwoDateByLoanId($od['od_date_end'] . ' 23:59:59', $second_installment_date, $loan_id) as $Installment_payment) {
                                                                    $row_count++;
                                                                    ?>

                                                                    <tr  id="payment-color">  
                                                                        <td>
                                                                            <?php echo $row_count; ?>
                                                                        </td>                                                       
                                                                        <td class="font-colors text-right f-style">
                                                                            <?php echo $Installment_payment['paid_date']; ?>
                                                                        </td>
                                                                        <td class="font-colors text-right f-style">

                                                                        </td>
                                                                        <td class="font-colors text-right f-style">
                                                                            <?php
                                                                            if ($Installment_payment['status'] == 'paid' || 'Paid')
                                                                                echo 'Receipt';
                                                                            ?>
                                                                        </td>
                                                                        <td class="font-colors text-right f-style"></td>                                                      
                                                                        <td class="font-colors text-right f-style">
                                                                            <?php echo number_format($Installment_payment['paid_amount'] + $Installment_payment['additional_interest'], 2); ?>
                                                                        </td>
                                                                        <td class="font-colors text-right f-style">
                                                                            <?php
                                                                            $before_all_balnce_amount = $balance + $Installment_payment['paid_amount'];
//                                                                            $payment_balance = -1 * ($ins_total) + $Installment_payment['paid_amount'] + $Installment_payment['additional_interest'];
//                                                                            array_push($payment_arr, $payment_balance);
                                                                            //
                                                                    $balance = $balance + $Installment_payment['paid_amount'] + $Installment_payment['additional_interest'];
                                                                            if (($od_amount - $od_total_amount) < 0) {
                                                                                $dd = 0;
                                                                            } else {
                                                                                $dd = ($od_amount - $od_total_amount);
                                                                            }
                                                                            echo number_format($balance - ($dd), 2);

                                                                            $row_count++
                                                                            ?>
                                                                        </td>
                                                                    </tr>
                                                                    <?php
                                                                }
                                                                break;
                                                            }
                                                            ?>


                                                            <!-- 
                                                                                                              OD start
                                                            -->
                                                            <tr style="background-color: #8acae4b3">  
                                                                <td><?php echo $row_count; ?> </td>
                                                                <td class="font-colors text-right f-style">
                                                                    <?php echo $od_date ?>
                                                                </td>
                                                                <td class="font-colors text-right f-style">

                                                                </td>
                                                                <td class="font-colors text-right f-style">
                                                                    OD Interest(<?php echo $od['od_interest_limit'] ?>)

                                                                </td>
                                                                <td class="font-colors text-right f-style">
                                                                    <?php
                                                                    $od_array[] = $od_interest;
                                                                    $od_amount = json_encode(array_sum($od_array), 2);
                                                                    array_push($last_od, $od_interest);
                                                                    echo '<p style="color:red">' . number_format($od_interest, 2) . '</p>';
                                                                    ?>
                                                                </td>
                                                                <td class="font-colors text-right f-style"></td>
                                                                <td class="font-colors text-right f-style">   

                                                                    <!--                                                     
                                                                                                                                    if ($due_and_excess < 0) {
                                                                                                                                        $balance_in_od = $before_installment - $od_amount;
                                                                                                                                        array_push($last_od_balance, $balance_in_od);
                                                                                                                                        echo number_format($balance_in_od, 2) . "weekly od";
                                                                                                                                    }
                                                                    -->
                                                                    <?php
                                                                    array_push($od_total, $od_amount);
                                                                    $payment_balance = $balance - ($od_amount - $od_total_amount);
                                                                    array_push($payment_arr, $payment_balance);
                                                                    echo '<p class="f-style font-color-2">' . number_format($payment_balance, 2) . '</p>';
                                                                    ?>
                                                                </td>
                                                            </tr>
                                                            <!--                                                        OD end -->

                                                            <?php
                                                            $od_date_start->modify($od_dates);
                                                            $y++;
                                                        }
                                                    } else {
                                                        foreach ($INSTALLMENT->CheckInstallmetBeetwenTwoDateByLoanId($date, $second_installment_date, $loan_id) as $Installment_payment) {
                                                            $row_count++;
                                                            ?>
                                                            <tr  id="payment-color">  
                                                                <td>
                                                                    <?php echo $row_count; ?>
                                                                </td>                                                       
                                                                <td class="font-colors text-right f-style">
                                                                    <?php echo $Installment_payment['paid_date']; ?>
                                                                </td>
                                                                <td class="font-colors text-right f-style">

                                                                </td>
                                                                <td class="font-colors text-right f-style">
                                                                    <?php
                                                                    if ($Installment_payment['status'] == 'paid' || 'Paid')
                                                                        echo 'Receipt';
                                                                    ?>
                                                                </td>
                                                                <td class="font-colors text-right f-style"></td>                                                      
                                                                <td class="font-colors text-right f-style">
                                                                    <?php echo number_format($Installment_payment['paid_amount'] + $Installment_payment['additional_interest'], 2); ?>
                                                                </td>
                                                                <td class="font-colors text-right f-style">
                                                                    <?php
                                                                    $before_all_balnce_amount = $balance + $Installment_payment['paid_amount'];
//                                                              $payment_balance = -1 * ($ins_total) + $Installment_payment['paid_amount'] + $Installment_payment['additional_interest'];
//                                                                array_push($payment_arr, $payment_balance);
                                                                    //
                                                                $balance = $balance + $Installment_payment['paid_amount'] + $Installment_payment['additional_interest'];
                                                                    echo number_format($balance, 2);
                                                                    $row_count++
                                                                    ?>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                        }
                                                    }
                                                }


                                                $start->modify($add_dates);
                                                $x++;


                                                //this is to get receipts after installment end 
                                                if ($no_of_installments == $x) {


//                                                      //get installment end date
//                                                    $OD_END = new DateTime($od_date);
//                                                    $OD_END->modify('+'.$daysOfMonth.' day');
//                                                    $installment_end = $INSTALLMENT_END->format('Y-m-d H:i:s');
                                                    //get installment end date
                                                    $INSTALLMENT_END = new DateTime($date);
                                                    $INSTALLMENT_END->modify('+' . $daysOfMonth . ' day');
                                                    $installment_end = $INSTALLMENT_END->format('Y-m-d H:i:s');

                                                    //get 5 years ahead date from installment end date
                                                    $INSTALLMENT_UNLIMITED_END = new DateTime($date);
                                                    $INSTALLMENT_UNLIMITED_END->modify('+1725 day');
                                                    $installment_unlimited_end = $INSTALLMENT_UNLIMITED_END->format('Y-m-d H:i:s');


                                                    $start = strtotime($date);
                                                    $end = strtotime(date("Y/m/d"));

                                                    $days_between = floor(abs($end - $start) / 86400) - 1;


//                                                    dd($days_between);
                                                    //  $od = $OD->allOdByLoanAndDate($date, $balance);

                                                    $z = 0;

                                                    $od_date_start1 = new DateTime($od_night);

                                                    $od_date_start1->modify('+1 day +23 hours +59 minutes +58 seconds');

                                                    $defult_val = $days_between;

                                                    //if having od after installment end
                                                    if ($od !== false) {

                                                        $last_od_date = date('D/M/Y', strtotime($od_night));
                                                        $last_installment_date = date('D/M/Y', strtotime($date));

//                                                        if ($last_od_date == $last_installment_date) {
//                                                            $last_loop_od = $od_interest;
//                                                        } else {
//                                                            $last_loop_od = 0;
//                                                        }

                                                        while ($z <= $defult_val) {

                                                            if ($od['od_date_start'] <= $od_date_start1) {
                                                                $od_dates = '+1 day';
                                                            }

                                                            $row_count++;
                                                            $od_date1 = $od_date_start1->format('Y-m-d H:i:s');

                                                            //getting brfore of date from current od date

                                                            $OLDODDATE = new DateTime($od_date1);


                                                            $od_date_remove1 = '-23 hours -59 minutes -58 seconds';

                                                            $OLDODDATE->modify($od_date_remove1);

                                                            $old_od_date = $OLDODDATE->format('Y-m-d H:i:s');



                                                            //get receipts if od loop ends in current date(od loop break in current date)
                                                            if (strtotime(date("Y/m/d")) <= strtotime($od_date1)) {

//                                                                $SS = $ODDATES->modify('+30 days');
//
//                                                                $ss = $SS->format('Y-m-d H:i:s');


                                                                foreach ($INSTALLMENT->CheckInstallmetBeetwenTwoDateByLoanId($od_date1, $installment_unlimited_end, $loan_id) as $Installment_payment) {
                                                                    ?>
                                                                    <tr  id="payment-color">  
                                                                        <td>
                                                                            <?php echo $row_count; ?>
                                                                        </td>                                                       
                                                                        <td class="font-colors text-right f-style">
                                                                            <?php echo $Installment_payment['paid_date']; ?>
                                                                        </td>
                                                                        <td class="font-colors text-right f-style">

                                                                        </td>
                                                                        <td class="font-colors text-right f-style">
                                                                            <?php
                                                                            if ($Installment_payment['status'] == 'paid' || 'Paid')
                                                                                echo 'Receipt';
                                                                            ?>
                                                                        </td>
                                                                        <td class="font-colors text-right f-style"></td>                                                      
                                                                        <td class="font-colors text-right f-style">
                                                                            <?php echo number_format($Installment_payment['paid_amount'] + $Installment_payment['additional_interest'], 2); ?>
                                                                        </td>
                                                                        <td class="font-colors text-right f-style">
                                                                            <?php
                                                                            $before_all_balnce_amount = $balance + $Installment_payment['paid_amount'];
//                                                                            $payment_balance = -1 * ($ins_total) + $Installment_payment['paid_amount'] + $Installment_payment['additional_interest'];
//                                                                            array_push($payment_arr, $payment_balance);
                                                                            //
                                                                    $balance = $balance + $Installment_payment['paid_amount'] + $Installment_payment['additional_interest'];
                                                                            if (($od_amount - $od_total_amount) < 0) {
                                                                                $dd = 0;
                                                                            } else {
                                                                                $dd = ($od_amount - $od_total_amount);
                                                                            }
                                                                            echo number_format($balance - ($dd), 2);

                                                                            $row_count++
                                                                            ?>
                                                                        </td>
                                                                    </tr>
                                                                    <?php
                                                                }
                                                                break;
                                                            }

                                                            //receipts between two od dates 
                                                            foreach ($INSTALLMENT->CheckInstallmetBeetwenTwoDateByLoanId($old_od_date, $od_date1, $loan_id) as $Installment_payment) {
                                                                $row_count++;
                                                                ?>
                                                                <tr  id="payment-color">  
                                                                    <td>
                                                                        <?php echo $row_count; ?>
                                                                    </td>                                                       
                                                                    <td class="font-colors text-right f-style">
                                                                        <?php echo $Installment_payment['paid_date']; ?>
                                                                    </td>
                                                                    <td class="font-colors text-right f-style">

                                                                    </td>
                                                                    <td class="font-colors text-right f-style">
                                                                        <?php
                                                                        if ($Installment_payment['status'] == 'paid' || 'Paid')
                                                                            echo 'Receipt';
                                                                        ?>
                                                                    </td>
                                                                    <td class="font-colors text-right f-style"></td>                                                      
                                                                    <td class="font-colors text-right f-style">
                                                                        <?php echo number_format($Installment_payment['paid_amount'] + $Installment_payment['additional_interest'], 2); ?>
                                                                    </td>
                                                                    <td class="font-colors text-right f-style">
                                                                        <?php
                                                                        $before_all_balnce_amount = $balance + $Installment_payment['paid_amount'];
//                                                                            $payment_balance = -1 * ($ins_total) + $Installment_payment['paid_amount'] + $Installment_payment['additional_interest'];
//                                                                            array_push($payment_arr, $payment_balance);
                                                                        //
                                                                    $balance = $balance + $Installment_payment['paid_amount'] + $Installment_payment['additional_interest'];
                                                                        if (($od_amount - $od_total_amount) < 0) {
                                                                            $dd = 0;
                                                                        } else {
                                                                            $dd = ($od_amount - $od_total_amount);
                                                                        }
                                                                        echo number_format($balance - ($dd), 2);

                                                                        $row_count++
                                                                        ?>
                                                                    </td>
                                                                </tr>

                                                                <?Php
                                                            }
                                                            //if receipt balance break the od loop then use this to show receipts from end od date
                                                            if ((-1 * ($od['od_interest_limit'])) < ($balance)) {
                                                                foreach ($INSTALLMENT->CheckInstallmetBeetwenTwoDateByLoanId($od_date1, $installment_unlimited_end, $loan_id) as $Installment_payment) {
                                                                    $row_count++;
                                                                    ?>

                                                                    <tr  id="payment-color">  
                                                                        <td>
                                                                            <?php echo $row_count; ?>
                                                                        </td>                                                       
                                                                        <td class="font-colors text-right f-style">
                                                                            <?php echo $Installment_payment['paid_date']; ?>
                                                                        </td>
                                                                        <td class="font-colors text-right f-style">

                                                                        </td>
                                                                        <td class="font-colors text-right f-style">
                                                                            <?php
                                                                            if ($Installment_payment['status'] == 'paid' || 'Paid')
                                                                                echo 'Receipt';
                                                                            ?>
                                                                        </td>
                                                                        <td class="font-colors text-right f-style"></td>                                                      
                                                                        <td class="font-colors text-right f-style">
                                                                            <?php echo number_format($Installment_payment['paid_amount'] + $Installment_payment['additional_interest'], 2); ?>
                                                                        </td>
                                                                        <td class="font-colors text-right f-style">
                                                                            <?php
                                                                            $before_all_balnce_amount = $balance + $Installment_payment['paid_amount'];
//                                                                            $payment_balance = -1 * ($ins_total) + $Installment_payment['paid_amount'] + $Installment_payment['additional_interest'];
//                                                                            array_push($payment_arr, $payment_balance);
                                                                            //
                                                                    $balance = $balance + $Installment_payment['paid_amount'] + $Installment_payment['additional_interest'];
                                                                            if (($od_amount - $od_total_amount) < 0) {
                                                                                $dd = 0;
                                                                            } else {
                                                                                $dd = ($od_amount - $od_total_amount);
                                                                            }
                                                                            echo number_format($balance - ($dd), 2);

                                                                            $row_count++
                                                                            ?>
                                                                        </td>
                                                                    </tr>
                                                                    <?php
                                                                }
                                                                break;
                                                            }
                                                            //show receipts from od end date if od loop ends with od end date 
                                                            if ($od_date1 >= $od['od_date_end']) {
                                                                foreach ($INSTALLMENT->CheckInstallmetBeetwenTwoDateByLoanId($od['od_date_end'] . ' 23:59:59', $installment_unlimited_end, $loan_id) as $Installment_payment) {
                                                                    $row_count++;
                                                                    ?>

                                                                    <tr  id="payment-color">  
                                                                        <td>
                                                                            <?php echo $row_count; ?>
                                                                        </td>                                                       
                                                                        <td class="font-colors text-right f-style">
                                                                            <?php echo $Installment_payment['paid_date']; ?>
                                                                        </td>
                                                                        <td class="font-colors text-right f-style">

                                                                        </td>
                                                                        <td class="font-colors text-right f-style">
                                                                            <?php
                                                                            if ($Installment_payment['status'] == 'paid' || 'Paid')
                                                                                echo 'Receipt';
                                                                            ?>
                                                                        </td>
                                                                        <td class="font-colors text-right f-style"></td>                                                      
                                                                        <td class="font-colors text-right f-style">
                                                                            <?php echo number_format($Installment_payment['paid_amount'] + $Installment_payment['additional_interest'], 2); ?>
                                                                        </td>
                                                                        <td class="font-colors text-right f-style">
                                                                            <?php
                                                                            $before_all_balnce_amount = $balance + $Installment_payment['paid_amount'];
//                                                                            $payment_balance = -1 * ($ins_total) + $Installment_payment['paid_amount'] + $Installment_payment['additional_interest'];
//                                                                            array_push($payment_arr, $payment_balance);
                                                                            //
                                                                    $balance = $balance + $Installment_payment['paid_amount'] + $Installment_payment['additional_interest'];
                                                                            if (($od_amount - $od_total_amount) < 0) {
                                                                                $dd = 0;
                                                                            } else {
                                                                                $dd = ($od_amount - $od_total_amount);
                                                                            }
                                                                            echo number_format($balance - ($dd), 2);

                                                                            $row_count++
                                                                            ?>
                                                                        </td>
                                                                    </tr>
                                                                    <?php
                                                                }
                                                                break;
                                                            }
                                                            ?>





                                                            <tr style="background-color: #8acae4b3">  
                                                                <td><?php echo $row_count; ?> </td>
                                                                <td class="font-colors text-right f-style">
                                                                    <?php echo $od_date1; ?>
                                                                </td>
                                                                <td class="font-colors text-right f-style">

                                                                </td>
                                                                <td class="font-colors text-right f-style">
                                                                    OD Interest(<?php echo $od['od_interest_limit']; ?>)
                                                                </td>
                                                                <td class="font-colors text-right f-style">
                                                                    <?php
                                                                    $od_array[] = $od_interest;
                                                                    $od_amount = json_encode(array_sum($od_array), 2);
                                                                    array_push($last_od, $od_interest);
                                                                    echo '<p style="color:red">' . number_format($od_interest, 2) . '</p>';
                                                                    ?>
                                                                </td>
                                                                <td class="font-colors text-right f-style"></td>
                                                                <td class="font-colors text-right f-style">   

                                                                    <!--                                                     
                                                                                                                                    if ($due_and_excess < 0) {
                                                                                                                                        $balance_in_od = $before_installment - $od_amount;
                                                                                                                                        array_push($last_od_balance, $balance_in_od);
                                                                                                                                        echo number_format($balance_in_od, 2) . "weekly od";
                                                                                                                                    }
                                                                    -->

                                                                    <?php
                                                                    array_push($od_total, $od_amount);
                                                                    $payment_balance = $balance - ($od_amount - $od_total_amount);
                                                                    array_push($payment_arr, $payment_balance);
                                                                    echo '<p class="f-style font-color-2">' . number_format($payment_balance, 2) . '</p>';
                                                                    ?>
                                                                </td>
                                                            </tr>

                                                            <?php
                                                            $od_date_start1->modify($od_dates);
                                                            $z++;
                                                        }
                                                    } else {
                                                        //Receipts after installment end if there is no od when installment end

                                                        foreach ($INSTALLMENT->CheckInstallmetBeetwenTwoDateByLoanId($installment_end, $installment_unlimited_end, $loan_id) as $Installment_payment) {
                                                            $row_count++;
                                                            ?>
                                                            <tr  id="payment-color">  
                                                                <td>
                                                                    <?php echo $row_count; ?>
                                                                </td>                                                       
                                                                <td class="font-colors text-right f-style">
                                                                    <?php echo $Installment_payment['paid_date']; ?>
                                                                </td>
                                                                <td class="font-colors text-right f-style">

                                                                </td>
                                                                <td class="font-colors text-right f-style">
                                                                    <?php
                                                                    if ($Installment_payment['status'] == 'paid' || 'Paid')
                                                                        echo 'Receipt';
                                                                    ?>
                                                                </td>
                                                                <td class="font-colors text-right f-style"></td>                                                      
                                                                <td class="font-colors text-right f-style">
                                                                    <?php echo number_format($Installment_payment['paid_amount'] + $Installment_payment['additional_interest'], 2) ?>
                                                                </td>
                                                                <td class="font-colors text-right f-style">
                                                                    <?php
                                                                    $before_all_balnce_amount = $balance + $Installment_payment['paid_amount'];
//                                                                            $payment_balance = -1 * ($ins_total) + $Installment_payment['paid_amount'] + $Installment_payment['additional_interest'];
//                                                                            array_push($payment_arr, $payment_balance);
                                                                    //
                                                                    $balance = $balance + $Installment_payment['paid_amount'] + $Installment_payment['additional_interest'];
                                                                    if (($od_amount - $od_total_amount) < 0) {
                                                                        $dd = 0;
                                                                    } else {
                                                                        $dd = ($od_amount - $od_total_amount);
                                                                    }
                                                                    echo number_format($balance - ($dd), 2);
                                                                    $row_count++
                                                                    ?>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                        }
                                                    }
                                                }




//                                                if (strtotime(date("Y/m/d")) < strtotime($date) || $LOAN->od_interest_limit == "NOT" || PostponeDate::CheckIsPostPoneByDateAndCustomer($date, $customer) || PostponeDate::CheckIsPostPoneByDateAndRoute($date, $route) || PostponeDate::CheckIsPostPoneByDateAndCenter($date, $center) || PostponeDate::CheckIsPostPoneByDateAndAll($date) || PostponeDate::CheckIsPostPoneByDateCenterAll($date) || PostponeDate::CheckIsPostPoneByDateRouteAll($date)) {
//                                                    
//                                                } else if (strtotime($LOAN->od_date) <= strtotime($date) && (-1 * ($LOAN->od_interest_limit)) > $ArriersInstallmentAmount && $LOAN->installment_type == 4) {
//
//                                                 
//                                                }
//
//                                                $start->modify($add_dates);
//                                                $x++;
                                            }

                                            if ($LOAN->status == "completed") {
                                                $row_count++;
                                                ?>

                                                <tr style="background-color: #75d44b">  
                                                    <td> <?php echo $row_count ?></td>
                                                    <td class="font-colors text-right f-style">
                                                        <?php echo $Installment_payment['paid_date']; ?>
                                                    </td>
                                                    <td class="font-colors text-right f-style">

                                                    </td>
                                                    <td class="font-colors text-right f-style">
                                                        Completed
                                                    </td>
                                                    <td class="font-colors text-right f-style">

                                                    </td>
                                                    <td class="font-colors text-right f-style">
                                                        <?php echo number_format($Installment_payment['paid_amount'], 2) ?>
                                                    </td>
                                                    <td class="font-colors text-right f-style">                                                               
                                                        00.0
                                                    </td>
                                                </tr>

                                                <?php
                                            }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th class="text-right th-width">ID</th>
                                                <th class="text-right th-width-2">Date</th> 
                                                <th class="text-right th-width">Trans:ID</th>     
                                                <th class="text-right th-width-2">Status</th>
                                                <th class="text-right th-width">DEBIT</th>
                                                <th class="text-right th-width-2">CREDIT</th>
                                                <th class="text-right">BALANCE</th>
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
        <script type="text/javascript">
            $(document).ready(function () {
                $('#history-table').DataTable({
                    "order": [[0, "desc"]],
                    responsive: true,
                    iDisplayLength: 100,
                    aLengthMenu: [[100, 500, 1000, 2000, -1], [100, 500, 1000, 2000, "All"]],
                    dom: 'Bfrtip',
                    buttons: [
                        'copy', 'csv', 'excel', 'pdf', 'print'
                    ]
                });
            });
        </script>
    </body>
</html>