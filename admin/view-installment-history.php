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

                                   <h5>Loan Amount : <?php echo number_format($LOAN->loan_amount,2) ?> </h5>

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
                                <div class="table-responsive ">
                                    <table class="table table-bordered table-striped table-hover dataTable" id="history-table">
                                        <thead>
                                            <tr>
                                                <th class="text-right">ID</th>
                                                <th class="text-right">Installment Date </th>                                               
                                                <th class="text-right">Status</th>
                                                <th class="text-right">DEBIT</th>
                                                <th class="text-right">CREDIT</th>
                                                <th class="text-right">BALANCE</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $row_count = 0;
                                            $defultdata = DefaultData::getNumOfInstlByPeriodAndType($LOAN->loan_period, $LOAN->installment_type);

                                            $first_installment_date = '';
                                            $installments = 0;

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

                                            foreach ($INSTALLMENT->CheckInstallmetDateByLoanId($first_date, $LOAN->id) as $installments) {
                                                $row_count++;
                                                ?>
                                                <tr style="background-color: white;">                                                    

                                                    <td><?php echo $row_count; ?></td>
                                                    <td   class="font-colors text-right"><?php echo $installments['paid_date'] . ' / ' . $installments['time']; ?></td>                                                  
                                                    <td class="font-colors text-right"><?php echo $installments['status']; ?></td>
                                                    <td class="font-colors text-right"> </td>
                                                    <td class="font-colors text-right"><?php echo number_format($installments['paid_amount'], 2); ?></td>                                                  
                                                    <td> </td>

                                                </tr>
                                                <?php
                                            }
                                            $previus_amount = 0;
                                            $paid_amount_beetwen_dates = 0;
                                            $previus_amount += $installments['paid_amount'];

                                            $x = 0;
                                            $ins_total = 0;
                                            $total_paid = 0;
                                            $od_array = array();
                                            $array_value = 0;
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

                                                $customer = $LOAN->customer;

                                                $CUSTOMER = new Customer($customer);
                                                $route = $CUSTOMER->route;
                                                $center = $CUSTOMER->center;
                                                $amount = $LOAN->installment_amount;
                                                $INSTALLMENT = new Installment(NULL);
                                                $paid_amount = 0;
                                                $balance = 0;
                                                $od_amount = 0;

                                                $FID = new DateTime($date);
                                                $FID->modify($add_dates);
                                                $day_remove = '-1 day';
                                                $FID->modify($day_remove);
                                                $second_installment_date = $FID->format('Y-m-d');

                                                if (strtotime(date("Y/m/d")) < strtotime($date)) {
                                                    break;
                                                }

                                                foreach ($INSTALLMENT->CheckInstallmetBeetwenTwoDateByLoanId($date, $second_installment_date, $loan_id, $today) as $paid) {
                                                    $paid_amount += $paid['paid_amount'];
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
                                                    if ($LOAN->installment_type == 4 || $LOAN->installment_type == 1) {
                                                        $row_count++;
                                                        $POSTD = new DateTime($date);
                                                        $POSTD->modify('+1 day');
                                                        $date = $POSTD->format('Y-m-d');


                                                        echo '<tr>';
                                                        echo '<td class="tr-color font-color-2">';
                                                        echo $row_count;
                                                        echo '</td>';
                                                        echo '<td class="padd-td f-style tr-color font-color-2">';
                                                        echo $date;
                                                        echo '</td>';
                                                        echo '<td class="padd-td f-style tr-color font-color-2">';
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

                                                        echo '<td class="padd-td f-style tr-color font-color-2">';
                                                        echo number_format($amount, 2);
                                                        echo '</td>';

                                                        echo '<td class="padd-td f-style tr-color font-color-2">';

                                                        echo '</td>';

                                                        echo '<td class="padd-td f-style tr-color font-color-2">';
                                                        $ins_total += $amount;
                                                        $total_paid += $paid_amount;
                                                        $due_and_excess = $total_paid - $ins_total;

                                                        if ($array_value == 0) {
                                                            if ($due_and_excess > 0) {
                                                                echo '<span style="color:green">' . number_format($due_and_excess, 2) . '</span>';
                                                            } else if ($due_and_excess < 0) {
                                                                $due_and_excess = $due_and_excess + $previus_amount;
                                                                echo '<span style="color:red">' . number_format($due_and_excess - $paid_amount, 2) . '</span>';
                                                            } else {
                                                                echo number_format($due_and_excess, 2);
                                                            }
                                                        } else {
                                                            $od_amount = $array_value[0];
                                                            $due_and_excess = $od_amount - ($amount);
                                                            echo '<span style="color:red">' . number_format($due_and_excess, 2) . '</span>';
                                                        }
                                                        echo '</td>';

                                                        echo '</tr>';
                                                    }
                                                } else {

                                                    echo '<tr>';
                                                    echo '<td class"tr-color font-color-2" style="background-color:#d7d7d7b3;">';
                                                    echo $row_count;
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

                                                    echo '<td class="f-style tr-color font-color-2">';
                                                    echo number_format($amount, 2);
                                                    echo '</td>';

                                                    echo '<td class="f-style tr-color font-color-2">';
                                                    echo '</td>';

                                                    echo '<td class="f-style tr-color font-color-2">';

                                                    $ins_total += $amount;
                                                    $total_paid += $paid_amount;
                                                    $due_and_excess = $total_paid - $ins_total;

                                                    if ($array_value == 0) {
                                                        if ($due_and_excess > 0) {
                                                            echo '<span style="color:green">' . number_format($due_and_excess, 2) . '</span>';
                                                        } else if ($due_and_excess < 0) {

                                                            $due_and_excess = $due_and_excess + $previus_amount;
                                                            echo '<span style="color:red">' . number_format($due_and_excess - $paid_amount, 2) . '</span>';
                                                        } else {
                                                            echo number_format($due_and_excess, 2);
                                                        }
                                                    } else {

                                                        echo '<span style="color:red">' . number_format($due_and_excess, 2) . '</span>';
                                                    }

                                                    echo '</td>';
                                                    echo '</tr>';
                                                }

                                                foreach ($INSTALLMENT->CheckInstallmetBeetwenTwoDateByLoanId($date, $second_installment_date, $loan_id, $today) as $Installment_payment) {
                                                    $row_count++;
                                                    ?>

                                                    <tr style="background-color: white;">  
                                                        <td>
                                                            <?php echo $row_count; ?>
                                                        </td>                                                        
                                                        <td class="font-colors text-right">
                                                            <?php echo $Installment_payment['paid_date'] . ' / ' . $Installment_payment['time']; ?>
                                                        </td>
                                                        <td class="font-colors text-right">
                                                            <?php echo $Installment_payment['status'] ?>
                                                        </td>
                                                        <td class="font-colors text-right"></td>                                                       
                                                        <td class="font-colors text-right">
                                                            <?php echo number_format($Installment_payment['paid_amount'], 2); ?>
                                                        </td>
                                                        <td class="font-colors text-right"> 
                                                            <?php
                                                            $balance += $Installment_payment['paid_amount'];
                                                            if ($due_and_excess < 0) {
                                                                $due_amount = $due_and_excess - $paid_amount;
                                                                echo '<p style="color:red">' . number_format($due_amount + $balance, 2) . '</p>';
                                                            } else if ($due_and_excess > 0) {
                                                                $due_amount = $due_and_excess - $paid_amount;
                                                                echo '<p style="color:red">' . number_format($due_amount + $balance, 2) . '</p>';
                                                            } else {
                                                                echo '00.0';
                                                            }
                                                            ?> 
                                                        </td>
                                                    </tr>

                                                    <?php
                                                }

                                                if (strtotime(date("Y/m/d")) < strtotime($date) || $LOAN->od_interest_limit == "NOT" || PostponeDate::CheckIsPostPoneByDateAndCustomer($date, $customer) || PostponeDate::CheckIsPostPoneByDateAndRoute($date, $route) || PostponeDate::CheckIsPostPoneByDateAndCenter($date, $center) || PostponeDate::CheckIsPostPoneByDateAndAll($date) || PostponeDate::CheckIsPostPoneByDateCenterAll($date) || PostponeDate::CheckIsPostPoneByDateRouteAll($date)) {
                                                    
                                                } else if (strtotime($LOAN->od_date) <= strtotime($date) && $due_and_excess < 0 && $LOAN->installment_type == 4) {

                                                    $od_interest = $LOAN->getOdIntereset($due_and_excess, $LOAN->od_interest_limit);

                                                    $y = 0;
                                                    $od_date_start = new DateTime($date);
                                                    $defult_val = 6;

                                                    while ($y <= $defult_val) {

                                                        if ($defult_val <= 6 && $LOAN->od_date <= $od_date_start) {
                                                            $od_dates = '+1 day';
                                                        }

                                                        $row_count++;
                                                        $od_date = $od_date_start->format('Y-m-d');

                                                        if (strtotime(date("Y/m/d")) <= strtotime($od_date)) {
                                                            break;
                                                        }
                                                        ?>

                                                        <tr style="background-color: #4bc1d4">   
                                                            <td><?php echo $row_count; ?> </td>
                                                            <td class="font-colors text-right"> 
                                                                <?php echo $od_date ?>
                                                            </td>
                                                            <td class="font-colors text-right"> 
                                                                OD Amount
                                                            </td>
                                                            <td class="font-colors text-right"> 
                                                                <?php
                                                                $od_array[] = $od_interest;
                                                                $od_amount = json_encode(round(array_sum($od_array), 2));
                                                                echo number_format($od_amount, 2);
                                                                ?> 
                                                            </td>
                                                            <td class="font-colors text-right"></td>
                                                            <td class="font-colors text-right">                                                                
                                                                <?php
                                                                if ($due_and_excess < 0) {

                                                                    $balance_in_od = $due_and_excess - $od_amount;
                                                                    echo '<p style="color:red">' . number_format($balance_in_od, 2) . '</p>';
                                                                }
                                                                ?>                                                                
                                                            </td>
                                                        </tr>

                                                        <?php
                                                        $od_date_start->modify($od_dates);
                                                        $y++;
                                                    }
                                                } else if (strtotime($LOAN->od_date) <= strtotime($date) && $due_and_excess < 0 && $LOAN->installment_type == 1) {

                                                    $od_interest = $LOAN->getOdIntereset($due_and_excess, $LOAN->od_interest_limit);


                                                    $y = 0;
                                                    $od_date_start = new DateTime($date);
                                                    $defult_val = 30;

                                                    while ($y <= $defult_val) {

                                                        if ($defult_val <= 30 && $LOAN->od_date <= $od_date_start) {
                                                            $od_dates = '+1 day';
                                                        }

                                                        $row_count++;
                                                        $od_date = $od_date_start->format('Y-m-d');
                                                        if (strtotime(date("Y/m/d")) <= strtotime($od_date)) {
                                                            break;
                                                        }
                                                        ?>
                                                        <tr style="background-color:#4bc1d4">   
                                                            <td><?php echo $row_count; ?> </td>
                                                            <td class="font-colors text-right"> <?php echo $od_date ?></td>
                                                            <td class="font-colors text-right">
                                                                OD Amount
                                                            </td>
                                                            <td class="font-colors text-right">
                                                                <?php
                                                                $od_array[] = $od_interest;
                                                                $od_amount = json_encode(round(array_sum($od_array), 2));
                                                                echo number_format($od_amount, 2);
                                                                ?> 
                                                            </td>

                                                            <td class="font-colors text-right"> </td>
                                                            <td class="font-colors text-right">
                                                                <?php
                                                                if ($due_and_excess < 0) {
                                                                    $balance_in_od = $due_and_excess - $od_amount;
                                                                    echo '<p style="color:red">' . number_format($balance_in_od, 2) . '</p>';
                                                                }
                                                                ?>
                                                            </td>
                                                        </tr>

                                                        <?php
                                                        $od_date_start->modify($od_dates);
                                                        $y++;
                                                    }
                                                } else if (strtotime($LOAN->od_date) <= strtotime($date) && $due_and_excess < 0) {

                                                    if (strtotime(date("Y/m/d")) <= strtotime($date)) {
                                                        break;
                                                    }
                                                    $od_interest = $LOAN->getOdIntereset($due_and_excess, $LOAN->od_interest_limit);

                                                    $row_count++;
                                                    ?>
                                                    <tr style="background-color:#4bc1d4">   
                                                        <td><?php echo $row_count; ?> </td>
                                                        <td class="font-colors text-right"> <?php echo $date ?></td>
                                                        <td class="font-colors text-right">
                                                            OD Amount
                                                        </td>
                                                        <td class="font-colors text-right">
                                                            <?php
                                                            $od_array[] = $od_interest;
                                                            $od_amount = json_encode(round(array_sum($od_array), 2));
                                                            echo number_format($od_amount, 2);
                                                            ?> 
                                                        </td>

                                                        <td class="font-colors text-right"> </td>
                                                        <td class="font-colors text-right">
                                                            <?php
                                                            if ($due_and_excess < 0) {
                                                                $balance_in_od = $due_and_excess - $od_amount;
                                                                echo '<p style="color:red" class="f-style   font-color-2">' . number_format($balance_in_od, 2) . '</p>';
                                                            }
                                                            ?>
                                                        </td>
                                                    </tr>  
                                                    <?php
                                                }

                                                $start->modify($add_dates);
                                                $x++;
                                            }
                                            if ($LOAN->status == "completed") {
                                                $row_count++;
                                                ?>
                                                <tr style="background-color: #75d44b">   
                                                    <td> <?php echo $row_count ?></td>
                                                    <td class="font-colors text-right"> 
                                                        <?php echo $Installment_payment['paid_date'] . ' / ' . $Installment_payment['time']; ?>

                                                    </td>
                                                    <td class="font-colors text-right"> 
                                                        Completed
                                                    </td>
                                                    <td class="font-colors text-right"> 

                                                    </td>
                                                    <td class="font-colors text-right"></td>
                                                    <td class="font-colors text-right">                                                                
                                                        00.00
                                                    </td>
                                                </tr>

                                                <?php
                                            }
                                            ?>
                                        </tbody>
                                        <tfoot>

                                            <tr>
                                                <th class="text-right">ID</th>
                                                <th class="text-right">Installment Date </th>                                               
                                                <th class="text-right">Status</th>
                                                <th class="text-right">DEBIT</th>
                                                <th class="text-right">CREDIT</th>
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