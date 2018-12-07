<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/auth.php');

$LOAN = new Loan($_GET['id']);
$loan_id = $_GET['id'];
$CUSTOMER = new Customer($LOAN->customer);
$GR1 = new Customer($LOAN->guarantor_1);
$GR2 = new Customer($LOAN->guarantor_2);
?>

<!DOCTYPE html>
<html> 
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

        <title>Verify Loan || Credit Master</title>
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
        <link href="plugins/light-gallery/css/lightgallery.css" rel="stylesheet">
        <!-- Bootstrap Spinner Css -->
        <link href="plugins/jquery-spinner/css/bootstrap-spinner.css" rel="stylesheet">
        <link rel="stylesheet" href="plugins/jquery-ui/jquery-ui.css">
    </head>

    <body class="theme-red"  onLoad="focusOnMyInputBox()">
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
                        <h2>Verify Loan : # <?php echo str_pad($LOAN->id, 6, '0', STR_PAD_LEFT); ?></h2>
                        <ul class="header-dropdown">
                            <li class="">
                                <a href="manage-pending-loans.php">
                                    <i class="material-icons">list</i> 
                                </a>
                            </li>
                        </ul>
                    </div> 
                    <div class="header" style="padding: 0px !important;"> 
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#home"><h5>Loan Details</h5></a></li>
                            <li><a data-toggle="tab" href="#menu0"><h5>Installment</h5></a></li>
                            <li><a data-toggle="tab" href="#menu1"><h5>Customer Details</h5></a></li>
                            <li><a data-toggle="tab" href="#menu2"><h5>Guarantor 01</h5></a></li>
                            <li><a data-toggle="tab" href="#menu3"><h5>Guarantor 02</h5></a></li>
                            <li><a data-toggle="tab" href="#menu4"><h5>Loan Document</h5></a></li>
                        </ul> 
                    </div>
                    <div class="tab-content">  
                        <div id="home" class="tab-pane fade in active">
                            <div class="body"> 
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                        <label for="">Created Date</label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="" class="hidden-lg hidden-md">Created Date</label>
                                                <div class="form-control">
                                                    <?php echo $LOAN->create_date; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                        <label for="">Loan Amount</label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="" class="hidden-lg hidden-md">Loan Amount</label>
                                                <div class="form-control" >
                                                    <?php
                                                    echo number_format($LOAN->loan_amount, 2);
                                                    ?>
                                                </div>
                                                <input type="hidden"   id="loan_amount"  value="<?php echo $LOAN->loan_amount; ?>" />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                        <label for="">Interest Rate</label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="" class="hidden-lg hidden-md">Interest Rate</label>
                                                <div class="form-control">
                                                    <?php
                                                    echo $LOAN->interest_rate;
                                                    ?>%
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                        <label for="">Period</label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="" class="hidden-lg hidden-md">Period</label>
                                                <div class="form-control">
                                                    <?php
                                                    $PR = DefaultData::getLoanPeriod();
                                                    echo $PR[$LOAN->loan_period];
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                        <label for="">Installment Type</label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="" class="hidden-lg hidden-md">Installment Type</label>
                                                <div class="form-control">
                                                    <?php
                                                    $PR = DefaultData::getInstallmentType();
                                                    echo $PR[$LOAN->installment_type];
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                        <label for="">Installment Amount</label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="" class="hidden-lg hidden-md">Installment Amount</label>
                                                <div class="form-control">
                                                    <?php
                                                    echo number_format($LOAN->installment_amount, 2);
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                        <label for="">Number of Installment</label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="" class="hidden-lg hidden-md">Number of Installment</label>
                                                <div class="form-control">
                                                    <?php
                                                    echo DefaultData::getNumOfInstlByPeriodAndType($LOAN->loan_period, $LOAN->installment_type);
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                        <label for="effective_date">Effective Date</label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="" class="hidden-lg hidden-md">Effective Date</label>
                                                <input type="text" id="effective_date"  name="effective_date" value="<?php echo $LOAN->effective_date; ?>" placeholder="Please Select The Effective Date" class="form-control datepicker" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                        <label for="issue_mode">Issue Mode</label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="" class="hidden-lg hidden-md">Issue Mode</label>
                                                <input type="text"   id="issue_mode_onloard" name="issue_mode" value="<?php echo $LOAN->issue_mode; ?>"   class="form-control  " autocomplete="off" disabled="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="display: none" id="document_free">
                                    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                        <label for="Document Fee">Document Fee</label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="Document Free" class="hidden-lg hidden-md">Document Fee</label>
                                                <input type="text" id="document_free_amount"   name="document_free_amount"  placeholder="Document Fee" class="form-control  " autocomplete="off" disabled="">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row" style="display: none" id="cheque_free">
                                    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                        <label for="cheque_free">Cheque Fee</label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="cheque_free" class="hidden-lg hidden-md">Cheque Fee</label>
                                                <input type="text" id="cheque_free_amount"   name="cheque_free_amount"  placeholder="loan Cheque Fee" class="form-control  " autocomplete="off" disabled="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="display: none" id="stamp_fee_amount">
                                    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                        <label for="Stamp Fee">Stamp Fee</label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="Stamp Fee" class="hidden-lg hidden-md">Stamp Fee</label>
                                                <input type="text" id="stamp_fee"  name="stamp_fee"   placeholder="Stamp Fee" class="form-control  " autocomplete="off" disabled="">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row" style="display: none" id="loan_processing_pre">
                                    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                        <label for="loan_processing_pre_amount">Loan Processing Fee</label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="loan_processing_pre_amount" class="hidden-lg hidden-md">Loan Processing Fee</label>
                                                <input type="text" id="loan_processing_pre_amount"    name="loan_processing_pre_amount" placeholder="loan Processing Pre" class="form-control  " autocomplete="off" disabled="">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                        <label for="">Other Comments</label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="" class="hidden-lg hidden-md">Other Comments</label>
                                                <textarea name="comments" id="comments" class="form-control"><?php echo $LOAN->verify_comments; ?></textarea> 
                                            </div>
                                        </div>
                                    </div>
                                </div>  
                            </div>
                        </div>
                        <div id="menu0" class="tab-pane fade">
                            <div class="body">
                                <div class="row"> 
                                    <div class="col-md-1"></div>
                                    <div class="table-responsive col-md-10">
                                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                            <thead>
                                                <tr>
                                                    <th>Installment Date</th> 
                                                    <th>Installment Amount</th> 
                                                    <th>Status</th> 
                                                    <th>Paid Amount</th> 
                                                    <th>Due and Excess</th> 

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $defultdata = DefaultData::getNumOfInstlByPeriodAndType($LOAN->loan_period, $LOAN->installment_type);

                                                $start_date = $LOAN->effective_date;
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
                                                    if (PostponeDate::CheckIsPostPoneByDateAndCustomer($date, $customer) || PostponeDate::CheckIsPostPoneByDateAndRoute($date, $route) || PostponeDate::CheckIsPostPoneByDateAndCenter($date, $center) || PostponeDate::CheckIsPostPoneByDateAndAll($date)) {

                                                        echo '<td class="padd-td red">';
                                                        echo $date;
                                                        echo '</td>';
                                                        echo '<td class="padd-td gray text-center" colspan=5>';
                                                        echo '-- Postponed --';
                                                        echo '</td>';



                                                        $start->modify($add_dates);
                                                    } else {
                                                        echo '<td class="padd-td f-style">';
                                                        echo $date;
                                                        echo '</td>';
                                                        echo '<td class="f-style">';
                                                        echo 'Rs: ' . number_format($amount, 2);
                                                        echo '</td>';

                                                        echo '<td class="f-style">';
                                                        if ($paid_amount) {
                                                            echo 'Paid';
                                                        } elseif ($date < date("Y-m-d")) {

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

                                                        echo number_format($total_paid - $ins_total, 2);
                                                        echo '</td>';


                                                        $start->modify($add_dates);
                                                        $x++;
                                                    }
                                                    echo '</tr>';
                                                }
                                                ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Installment Date</th> 
                                                    <th>Installment Amount</th> 
                                                    <th>Status</th> 
                                                    <th>Paid Amount</th> 
                                                    <th>Due and Excess</th> 
                                                </tr>   
                                            </tfoot>
                                        </table>  
                                    </div>  
                                    <div class="col-md-1"></div>
                                </div>
                            </div>
                        </div>
                        <div id="menu1" class="tab-pane fade">
                            <div class="body">
                                <div class="row">
                                    <div class="col-md-9">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-4 hidden-sm hidden-xs form-control-label">
                                                <label for="title">Title</label>
                                            </div>
                                            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 p-bottom">
                                                <div class="form-group">
                                                    <div class="form-line"> 
                                                        <label  class="hidden-lg hidden-md">Title</label>
                                                        <div class="form-control"><?php echo $CUSTOMER->title; ?></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-4 col-md-4 hidden-sm hidden-xs form-control-label">
                                                <label for="first_name">First Name</label>
                                            </div>
                                            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 p-bottom">
                                                <div class="form-group">
                                                    <div class="form-line"> 
                                                        <label  class="hidden-lg hidden-md">First Name</label>
                                                        <div class="form-control"><?php echo $CUSTOMER->first_name; ?></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 

                                        <div class="row">
                                            <div class="col-lg-4 col-md-4 hidden-sm hidden-xs form-control-label">
                                                <label for="last_name">Last Name</label>
                                            </div>
                                            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 p-bottom">
                                                <div class="form-group">
                                                    <div class="form-line"> 
                                                        <label  class="hidden-lg hidden-md">Last Name</label>
                                                        <div class="form-control"><?php echo $CUSTOMER->last_name; ?></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 

                                        <div class="row">
                                            <div class="col-lg-4 col-md-4 hidden-sm hidden-xs form-control-label">
                                                <label for="surname">Surname</label>
                                            </div>
                                            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 p-bottom">
                                                <div class="form-group">
                                                    <div class="form-line"> 
                                                        <label  class="hidden-lg hidden-md">Surname</label>
                                                        <div class="form-control"><?php echo $CUSTOMER->surname; ?></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 

                                        <div class="row">
                                            <div class="col-lg-4 col-md-4 hidden-sm hidden-xs form-control-label">
                                                <label for="nic_number">NIC Number</label>
                                            </div>
                                            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 p-bottom">
                                                <div class="form-group">
                                                    <div class="form-line"> 
                                                        <label  class="hidden-lg hidden-md">NIC Number</label>
                                                        <div class="form-control"><?php echo $CUSTOMER->nic_number; ?></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="col-md-3">
                                        <div  class="list-unstyled row clearfix aniimated-thumbnials ">
                                            <a href="../upload/customer/profile/<?php echo $CUSTOMER->profile_picture; ?>" data-sub-html=" ">
                                                <img class="img-responsive thumbnail" src="../upload/customer/profile/<?php echo $CUSTOMER->profile_picture; ?>">
                                            </a> 
                                        </div>
                                    </div>
                                </div>
                                <div class="row  ">
                                    <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label" style="margin-bottom: 0px;">
                                        <label for="nic_photo_front" class="nic-padding">NIC Photos</label>
                                    </div>
                                    <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 p-bottom ">
                                        <div class="form-group">
                                            <div  class="list-unstyled  clearfix aniimated-thumbnials pull-right">
                                                <label for="nic_photo_front" class="hidden-lg hidden-md">NIC Photo Front</label>
                                                <a href="../upload/customer/nfp/<?php echo $CUSTOMER->nic_photo_front; ?>" data-sub-html=" ">
                                                    <img class="img-responsive thumbnail" src="../upload/customer/nfp/thumb/<?php echo $CUSTOMER->nic_photo_front; ?>">
                                                </a> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 p-bottom  ">
                                        <div class="form-group">
                                            <div  class="list-unstyled  clearfix aniimated-thumbnials pull-right">
                                                <label for="nic_photo_back" class="hidden-lg hidden-md">NIC Photo Back</label>
                                                <a href="../upload/customer/nbp/<?php echo $CUSTOMER->nic_photo_back; ?>" data-sub-html=" ">
                                                    <img class="img-responsive thumbnail" src="../upload/customer/nbp/thumb/<?php echo $CUSTOMER->nic_photo_back; ?>">
                                                </a> 
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="row"  style="margin-top: 20px;">
                                    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                        <label for="dob" style="margin-top: 30px;">Date of Birthday</label>
                                    </div><div class="  p-bottom">
                                        <div class="form-group"> 
                                            <label for="dob" class="hidden-lg hidden-md">Date of Birthday</label>
                                            <div class="register-form-row-col">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <div class="form-line"> 
                                                            <div class="form-control"><?php
                                                                if ($CUSTOMER->dob_month == 1) {
                                                                    echo 'Jan';
                                                                } elseif ($CUSTOMER->dob_month == 2) {
                                                                    echo 'Feb';
                                                                } elseif ($CUSTOMER->dob_month == 3) {
                                                                    echo 'Mar';
                                                                } elseif ($CUSTOMER->dob_month == 4) {
                                                                    echo 'Apr';
                                                                } elseif ($CUSTOMER->dob_month == 5) {
                                                                    echo 'May';
                                                                } elseif ($CUSTOMER->dob_month == 6) {
                                                                    echo 'Jun';
                                                                } elseif ($CUSTOMER->dob_month == 7) {
                                                                    echo 'Jul';
                                                                } elseif ($CUSTOMER->dob_month == 8) {
                                                                    echo 'Aug';
                                                                } elseif ($CUSTOMER->dob_month == 9) {
                                                                    echo 'Sep';
                                                                } elseif ($CUSTOMER->dob_month == 10) {
                                                                    echo 'Oct';
                                                                } elseif ($CUSTOMER->dob_month == 11) {
                                                                    echo 'Nov';
                                                                } else {
                                                                    echo 'Dec';
                                                                }
                                                                ?></div>
                                                        </div>
                                                    </div> 
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <div class="form-line"> 
                                                            <div class="form-control"><?php echo $CUSTOMER->dob_day; ?></div>
                                                        </div>
                                                    </div> 
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <div class="form-line"> 
                                                            <div class="form-control"><?php echo $CUSTOMER->dob_year; ?></div>
                                                        </div>
                                                    </div> 
                                                </div>
                                            </div> 
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                        <label >Address</label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label  class="hidden-lg hidden-md">Address</label>
                                                <div class="form-control" style="border-bottom: 1px solid #dddddd"><?php echo $CUSTOMER->address_line_1; ?></div>
                                                <div class="form-control" style="border-bottom: 1px solid #dddddd"><?php echo $CUSTOMER->address_line_2; ?></div>
                                                <div class="form-control" style="border-bottom: 1px solid #dddddd"><?php echo $CUSTOMER->address_line_3; ?></div>
                                                <div class="form-control" style="border-bottom: 1px solid #dddddd"><?php echo $CUSTOMER->address_line_4; ?></div>
                                                <div class="form-control" style="border-bottom: 1px solid #dddddd"><?php echo $CUSTOMER->address_line_5; ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row" class="list-unstyled   clearfix  ">
                                    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                        <label for="billing_proof_image">Billing Proof Image</label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-6 col-xs-6 p-bottom">
                                        <div class="form-group">
                                            <div  class="list-unstyled   clearfix aniimated-thumbnials">
                                                <label for="billing_proof_image" class="hidden-lg hidden-md">Billing Proof Image</label>
                                                <a href="../upload/customer/billing-proof/<?php echo $CUSTOMER->billing_proof_image ?>" data-sub-html=" ">
                                                    <img class="img-responsive thumbnail" src="../upload/customer/billing-proof/thumb/<?php echo $CUSTOMER->billing_proof_image ?>">
                                                </a> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                        <label for="email">Email</label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="email" class="hidden-lg hidden-md">Email</label>
                                                <div class="form-control"><?php echo $CUSTOMER->email; ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                        <label for="telephone">Telephone</label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="telephone" class="hidden-lg hidden-md">Telephone</label>
                                                <div class="form-control"><?php echo $CUSTOMER->telephone; ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                                <div class="row">
                                    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                        <label for="mobile">Mobile</label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="mobile" class="hidden-lg hidden-md">Mobile</label>
                                                <div class="form-control"><?php echo $CUSTOMER->mobile; ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                        <label for="registration_type">Registration Type</label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="registration_type" class="hidden-lg hidden-md">Registration Type</label>
                                                <div class="form-control"><?php
                                                    if ($CUSTOMER->registration_type == 1) {
                                                        echo " Center Leader";
                                                    } else {
                                                        echo ucfirst($CUSTOMER->registration_type);
                                                    }
                                                    ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <?php
                                $ROUTE = new Route($CUSTOMER->route);
                                if ($ROUTE->id == $CUSTOMER->route) {
                                    ?>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                            <label for="route">Route</label>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <label for="route" class="hidden-lg hidden-md">Route</label>
                                                    <div class="form-control">
                                                        <?php
                                                        echo $ROUTE->name;
                                                        ?>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <?php
                                } else {
                                    ?>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                            <label for="center">Center</label>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <label for="center" class="hidden-lg hidden-md">Center</label>
                                                    <div class="form-control"><?php
                                                        $CENTER = new Center($CUSTOMER->center);
                                                        echo $CENTER->name;
                                                        ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>

                                <div class="row">
                                    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                        <label for="city">City</label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="city" class="hidden-lg hidden-md">City</label>
                                                <div class="form-control">
                                                    <?php
                                                    $CITY = new City($CUSTOMER->city);
                                                    echo $CITY->name;
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                        <label for="credit_limit">Credit Limit</label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="credit_limit" class="hidden-lg hidden-md">Credit Limit</label>
                                                <div class="form-control"><?php echo $CUSTOMER->credit_limit; ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                        <label for="signature_photo">Signature Photo</label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class="form-line"> 
                                                <div  class="list-unstyled   clearfix aniimated-thumbnials">
                                                    <label for="signature_photo" class="hidden-lg hidden-md">Signature Photo</label>
                                                    <a href="../upload/customer/signature/<?php echo $CUSTOMER->signature_image; ?>" data-sub-html="Signature Photo">
                                                        <img class="img-responsive thumbnail" src="../upload/customer/signature/thumb/<?php echo $CUSTOMER->signature_image; ?>">
                                                    </a> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                        <label for="business_name">Business Name</label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="business_name" class="hidden-lg hidden-md">Business Name</label>
                                                <div class="form-control"><?php echo $CUSTOMER->business_name; ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                        <label for="br_number">BR Number</label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="br_number" class="hidden-lg hidden-md">BR Number</label>
                                                <div class="form-control"><?php echo $CUSTOMER->br_number; ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                        <label for="nature_of_business">Nature of Business</label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="nature_of_business" class="hidden-lg hidden-md">Nature of Business</label>
                                                <div class="form-control"><?php echo $CUSTOMER->nature_of_business; ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                        <label for="br_picture">BR Photo</label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div  class="list-unstyled   clearfix aniimated-thumbnials">
                                                <label for="br_picture" class="hidden-lg hidden-md">BR Photo</label>
                                                <?php if (empty($CUSTOMER->br_picture)) {
                                                    ?>
                                                    <img class="img-responsive thumbnail" src="../upload/sample-br.jpg">

                                                <?php } else { ?>

                                                    <a href="../upload/customer/br/<?php echo $CUSTOMER->br_picture ?>" data-sub-html=" ">
                                                        <img class="img-responsive thumbnail" src="../upload/customer/br/thumb/<?php echo $CUSTOMER->br_picture ?>">
                                                    </a>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                        <label for="bank">Bank</label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="bank" class="hidden-lg hidden-md">Bank</label>
                                                <div class="form-control"><?php
                                                    $BANK = new Bank($CUSTOMER->bank);
                                                    echo $BANK->name;
                                                    ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                        <label for="branch">Branch</label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="branch" class="hidden-lg hidden-md">Branch</label>
                                                <div class="form-control"><?php
                                                    $BRANCH = new Branch($CUSTOMER->branch);
                                                    echo $BRANCH->name;
                                                    ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                        <label for="branch_code">Branch Code</label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="branch_code" class="hidden-lg hidden-md">Branch Code</label>
                                                <div class="form-control"><?php echo $CUSTOMER->branch_code; ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                        <label for="account_number">Account Number</label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="account_number" class="hidden-lg hidden-md">Account Number</label>
                                                <div class="form-control"><?php echo $CUSTOMER->account_number; ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                        <label for="holder_name">Holder Name</label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="holder_name" class="hidden-lg hidden-md">Holder Name</label>
                                                <div class="form-control"><?php echo $CUSTOMER->holder_name; ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                        <label for="bank_book_picture">Bank Book Photo</label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class=" clearfix aniimated-thumbnials">
                                                <label for="bank_book_picture" class="hidden-lg hidden-md">Bank Book Photo</label>
                                                <a href="../upload/customer/bbp/<?php echo $CUSTOMER->bank_book_picture; ?>" data-sub-html=" ">
                                                    <img class="img-responsive thumbnail" src="../upload/customer/bbp/thumb/<?php echo $CUSTOMER->bank_book_picture; ?>">
                                                </a>  
                                            </div>
                                        </div> 
                                    </div>
                                </div> 
                            </div>
                        </div>
                        <div id="menu2" class="tab-pane fade">
                            <div class="body"> 
                                <div class="row">
                                    <div class="col-md-9">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-4 hidden-sm hidden-xs form-control-label">
                                                <label for="title">Title</label>
                                            </div>
                                            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 p-bottom">
                                                <div class="form-group">
                                                    <div class="form-line"> 
                                                        <label  class="hidden-lg hidden-md">Title</label>
                                                        <div class="form-control"><?php echo $GR1->title; ?></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-4 col-md-4 hidden-sm hidden-xs form-control-label">
                                                <label for="first_name">First Name</label>
                                            </div>
                                            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 p-bottom">
                                                <div class="form-group">
                                                    <div class="form-line"> 
                                                        <label  class="hidden-lg hidden-md">First Name</label>
                                                        <div class="form-control"><?php echo $GR1->first_name; ?></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 

                                        <div class="row">
                                            <div class="col-lg-4 col-md-4 hidden-sm hidden-xs form-control-label">
                                                <label for="last_name">Last Name</label>
                                            </div>
                                            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 p-bottom">
                                                <div class="form-group">
                                                    <div class="form-line"> 
                                                        <label  class="hidden-lg hidden-md">Last Name</label>
                                                        <div class="form-control"><?php echo $GR1->last_name; ?></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 

                                        <div class="row">
                                            <div class="col-lg-4 col-md-4 hidden-sm hidden-xs form-control-label">
                                                <label for="surname">Surname</label>
                                            </div>
                                            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 p-bottom">
                                                <div class="form-group">
                                                    <div class="form-line"> 
                                                        <label  class="hidden-lg hidden-md">Surname</label>
                                                        <div class="form-control"><?php echo $GR1->surname; ?></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 

                                        <div class="row">
                                            <div class="col-lg-4 col-md-4 hidden-sm hidden-xs form-control-label">
                                                <label for="nic_number">NIC Number</label>
                                            </div>
                                            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 p-bottom">
                                                <div class="form-group">
                                                    <div class="form-line"> 
                                                        <label  class="hidden-lg hidden-md">NIC Number</label>
                                                        <div class="form-control"><?php echo $GR1->nic_number; ?></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="col-md-3">
                                        <div   class="list-unstyled row clearfix aniimated-thumbnials ">
                                            <a href="../upload/customer/profile/<?php echo $GR1->profile_picture; ?>" data-sub-html=" ">
                                                <img class="img-responsive thumbnail" src="../upload/customer/profile/<?php echo $GR1->profile_picture; ?>">
                                            </a> 
                                        </div>                                        
                                    </div>
                                </div>

                                <div class="row  ">
                                    <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label  " style="margin-bottom: 0px;">
                                        <label for="nic_photo_front" class="nic-padding">NIC Photos</label>
                                    </div>
                                    <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 p-bottom ">
                                        <div class="form-group">
                                            <div  class="list-unstyled   clearfix aniimated-thumbnials pull-right">
                                                <label for="nic_photo_front" class="hidden-lg hidden-md">NIC Photo Front</label>
                                                <a href="../upload/customer/nfp/<?php echo $GR1->nic_photo_front; ?>" data-sub-html=" ">
                                                    <img class="img-responsive thumbnail" src="../upload/customer/nfp/thumb/<?php echo $CUSTOMER->nic_photo_front; ?>">
                                                </a> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 p-bottom  ">
                                        <div class="form-group">
                                            <div  class="list-unstyled  clearfix aniimated-thumbnials pull-right">
                                                <label for="nic_photo_back" class="hidden-lg hidden-md">NIC Photo Back</label>
                                                <a href="../upload/customer/nbp/<?php echo $GR1->nic_photo_back; ?>" data-sub-html=" ">
                                                    <img class="img-responsive thumbnail" src="../upload/customer/nbp/thumb/<?php echo $CUSTOMER->nic_photo_back; ?>">
                                                </a> 
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row" style="margin-top: 20px;">
                                    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                        <label for="dob" style="margin-top: 30px;">Date of Birthday</label>
                                    </div>
                                    <div class=" p-bottom">
                                        <div class="form-group"> 
                                            <label for="dob" class="hidden-lg hidden-md">Date of Birthday</label>
                                            <div class="register-form-row-col">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <div class="form-line"> 
                                                            <div class="form-control"><?php
                                                                if ($GR1->dob_month == 1) {
                                                                    echo 'Jan';
                                                                } elseif ($GR1->dob_month == 2) {
                                                                    echo 'Feb';
                                                                } elseif ($GR1->dob_month == 3) {
                                                                    echo 'Mar';
                                                                } elseif ($GR1->dob_month == 4) {
                                                                    echo 'Apr';
                                                                } elseif ($GR1->dob_month == 5) {
                                                                    echo 'May';
                                                                } elseif ($GR1->dob_month == 6) {
                                                                    echo 'Jun';
                                                                } elseif ($GR1->dob_month == 7) {
                                                                    echo 'Jul';
                                                                } elseif ($GR1->dob_month == 8) {
                                                                    echo 'Aug';
                                                                } elseif ($GR1->dob_month == 9) {
                                                                    echo 'Sep';
                                                                } elseif ($GR1->dob_month == 10) {
                                                                    echo 'Oct';
                                                                } elseif ($GR1->dob_month == 11) {
                                                                    echo 'Nov';
                                                                } else {
                                                                    echo 'Dec';
                                                                }
                                                                ?></div>
                                                        </div>
                                                    </div> 
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <div class="form-line"> 
                                                            <div class="form-control"><?php echo $GR1->dob_day; ?></div>
                                                        </div>
                                                    </div> 
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <div class="form-line"> 
                                                            <div class="form-control"><?php echo $GR1->dob_year; ?></div>
                                                        </div>
                                                    </div> 
                                                </div>
                                            </div> 
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                        <label >Address</label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label  class="hidden-lg hidden-md">Address</label>
                                                <div class="form-control" style="border-bottom: 1px solid #dddddd"><?php echo $GR1->address_line_1; ?></div>
                                                <div class="form-control" style="border-bottom: 1px solid #dddddd"><?php echo $GR1->address_line_2; ?></div>
                                                <div class="form-control" style="border-bottom: 1px solid #dddddd"><?php echo $GR1->address_line_3; ?></div>
                                                <div class="form-control" style="border-bottom: 1px solid #dddddd"><?php echo $GR1->address_line_4; ?></div>
                                                <div class="form-control" style="border-bottom: 1px solid #dddddd"><?php echo $GR1->address_line_5; ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row" class="list-unstyled   clearfix  ">
                                    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                        <label for="billing_proof_image">Billing Proof Image</label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-6 col-xs-6 p-bottom">
                                        <div class="form-group">
                                            <div  class="list-unstyled   clearfix aniimated-thumbnials">
                                                <label for="billing_proof_image" class="hidden-lg hidden-md">Billing Proof Image</label>
                                                <a href="../upload/customer/billing-proof/<?php echo $GR1->billing_proof_image ?>" data-sub-html=" ">
                                                    <img class="img-responsive thumbnail" src="../upload/customer/billing-proof/thumb/<?php echo $GR1->billing_proof_image ?>">
                                                </a> 
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                        <label for="email">Email</label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="email" class="hidden-lg hidden-md">Email</label>
                                                <div class="form-control"><?php echo $GR1->email; ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                        <label for="telephone">Telephone</label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="telephone" class="hidden-lg hidden-md">Telephone</label>
                                                <div class="form-control"><?php echo $GR1->telephone; ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                        <label for="mobile">Mobile</label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="mobile" class="hidden-lg hidden-md">Mobile</label>
                                                <div class="form-control"><?php echo $GR1->mobile; ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                $ROUTE = new Route($GR1->route);
                                if ($ROUTE->id == $GR1->route) {
                                    ?>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                            <label for="route">Route</label>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <label for="route" class="hidden-lg hidden-md">Route</label>
                                                    <div class="form-control">
                                                        <?php
                                                        echo $ROUTE->name;
                                                        ?>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <?php
                                } else {
                                    ?>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                            <label for="center">Center</label>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <label for="center" class="hidden-lg hidden-md">Center</label>
                                                    <div class="form-control"><?php
                                                        $CENTER = new Center($GR1->center);
                                                        echo $CENTER->name;
                                                        ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>

                                <div class="row">
                                    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                        <label for="city">City</label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="city" class="hidden-lg hidden-md">City</label>
                                                <div class="form-control">
                                                    <?php
                                                    $CITY = new City($GR1->city);
                                                    echo $CITY->name;
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                        <label for="credit_limit">Credit Limit</label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="credit_limit" class="hidden-lg hidden-md">Credit Limit</label>
                                                <div class="form-control"><?php echo $GR1->credit_limit; ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                        <label for="signature_photo">Signature Photo</label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class="form-line"> 
                                                <div  class="list-unstyled   clearfix aniimated-thumbnials">
                                                    <label for="signature_photo" class="hidden-lg hidden-md">Signature Photo</label>
                                                    <a href="../upload/customer/signature/<?php echo $GR1->signature_image; ?>" data-sub-html="Signature Photo">
                                                        <img class="img-responsive thumbnail" src="../upload/customer/signature/thumb/<?php echo $GR1->signature_image; ?>">
                                                    </a> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                        <label for="business_name">Business Name</label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="business_name" class="hidden-lg hidden-md">Business Name</label>
                                                <div class="form-control"><?php echo $GR1->business_name; ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                        <label for="br_number">BR Number</label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="br_number" class="hidden-lg hidden-md">BR Number</label>
                                                <div class="form-control"><?php echo $GR1->br_number; ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                        <label for="nature_of_business">Nature of Business</label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="nature_of_business" class="hidden-lg hidden-md">Nature of Business</label>
                                                <div class="form-control"><?php echo $GR1->nature_of_business; ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                        <label for="br_picture">BR Photo</label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <div  class="list-unstyled   clearfix aniimated-thumbnials">
                                                    <label for="br_picture" class="hidden-lg hidden-md">BR Photo</label>
                                                    <?php if (empty($GR1->br_picture)) {
                                                        ?>
                                                        <img class="img-responsive thumbnail" src="../upload/sample-br.jpg">

                                                    <?php } else { ?>

                                                        <a href="../upload/customer/br/<?php echo $GR1->br_picture ?>" data-sub-html=" ">
                                                            <img class="img-responsive thumbnail" src="../upload/customer/br/thumb/<?php echo $GR1->br_picture ?>">
                                                        </a>
                                                        <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                        <label for="bank">Bank</label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <div class="form-control"><?php
                                                    $BANK = new Bank($GR1->bank);
                                                    echo $BANK->name;
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                        <label for="branch">Branch</label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="branch" class="hidden-lg hidden-md">Branch</label>
                                                <div class="form-control">
                                                    <?php
                                                    $BRANCH = new Branch($GR1->branch);
                                                    echo $BRANCH->name;
                                                    ?>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                        <label for="branch_code">Branch Code</label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="branch_code" class="hidden-lg hidden-md">Branch Code</label>
                                                <div class="form-control"><?php echo $GR1->branch_code; ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                        <label for="account_number">Account Number</label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="account_number" class="hidden-lg hidden-md">Account Number</label>
                                                <div class="form-control"><?php echo $GR1->account_number; ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                        <label for="holder_name">Holder Name</label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="holder_name" class="hidden-lg hidden-md">Holder Name</label>
                                                <div class="form-control"><?php echo $GR1->holder_name; ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                        <label for="bank_book_picture">Bank Book Photo</label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group"> 
                                            <div class=" clearfix aniimated-thumbnials">
                                                <label for="bank_book_picture" class="hidden-lg hidden-md">Bank Book Photo</label>
                                                <a href="../upload/customer/bbp/<?php echo $GR1->bank_book_picture; ?>" data-sub-html=" ">
                                                    <img class="img-responsive thumbnail" src="../upload/customer/bbp/thumb/<?php echo $GR1->bank_book_picture; ?>">
                                                </a>  
                                            </div>  
                                        </div>
                                    </div>
                                </div> 
                            </div>
                        </div>
                        <div id="menu3" class="tab-pane fade">
                            <div class="body"> 
                                <div class="row">
                                    <div class="col-md-9">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-4 hidden-sm hidden-xs form-control-label">
                                                <label for="title">Title</label>
                                            </div>
                                            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 p-bottom">
                                                <div class="form-group">
                                                    <div class="form-line"> 
                                                        <label  class="hidden-lg hidden-md">Title</label>
                                                        <div class="form-control"><?php echo $GR2->title; ?></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-4 col-md-4 hidden-sm hidden-xs form-control-label">
                                                <label for="first_name">First Name</label>
                                            </div>
                                            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 p-bottom">
                                                <div class="form-group">
                                                    <div class="form-line"> 
                                                        <label  class="hidden-lg hidden-md">First Name</label>
                                                        <div class="form-control"><?php echo $GR2->first_name; ?></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 

                                        <div class="row">
                                            <div class="col-lg-4 col-md-4 hidden-sm hidden-xs form-control-label">
                                                <label for="last_name">Last Name</label>
                                            </div>
                                            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 p-bottom">
                                                <div class="form-group">
                                                    <div class="form-line"> 
                                                        <label  class="hidden-lg hidden-md">Last Name</label>
                                                        <div class="form-control"><?php echo $GR2->last_name; ?></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 

                                        <div class="row">
                                            <div class="col-lg-4 col-md-4 hidden-sm hidden-xs form-control-label">
                                                <label for="surname">Surname</label>
                                            </div>
                                            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 p-bottom">
                                                <div class="form-group">
                                                    <div class="form-line"> 
                                                        <label  class="hidden-lg hidden-md">Surname</label>
                                                        <div class="form-control"><?php echo $GR2->surname; ?></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 

                                        <div class="row">
                                            <div class="col-lg-4 col-md-4 hidden-sm hidden-xs form-control-label">
                                                <label for="nic_number">NIC Number</label>
                                            </div>
                                            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 p-bottom">
                                                <div class="form-group">
                                                    <div class="form-line"> 
                                                        <label  class="hidden-lg hidden-md">NIC Number</label>
                                                        <div class="form-control"><?php echo $GR2->nic_number; ?></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                    </div>

                                    <div class="col-md-3">
                                        <div  class="list-unstyled row clearfix aniimated-thumbnials ">
                                            <a href="../upload/customer/profile/<?php echo $GR2->profile_picture; ?>" data-sub-html=" ">
                                                <img class="img-responsive thumbnail" src="../upload/customer/profile/<?php echo $GR2->profile_picture; ?>">
                                            </a> 
                                        </div>
                                    </div>
                                </div
                                <div class="row  ">
                                    <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label" style="margin-bottom: 0px;">
                                        <label for="nic_photo_front" class="nic-padding">NIC Photos</label>
                                    </div>
                                    <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 p-bottom ">
                                        <div class="form-group">
                                            <div  class="list-unstyled   clearfix aniimated-thumbnials pull-right">
                                                <label for="nic_photo_front" class="hidden-lg hidden-md">NIC Photo Front</label>
                                                <a href="../upload/customer/nfp/<?php echo $GR2->nic_photo_front; ?>" data-sub-html=" ">
                                                    <img class="img-responsive thumbnail" src="../upload/customer/nfp/thumb/<?php echo $GR2->nic_photo_front; ?>">
                                                </a> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 p-bottom  ">
                                        <div class="form-group">
                                            <div  class="list-unstyled  clearfix aniimated-thumbnials pull-right">
                                                <label for="nic_photo_back" class="hidden-lg hidden-md">NIC Photo Back</label>
                                                <a href="../upload/customer/nbp/<?php echo $GR2->nic_photo_back; ?>" data-sub-html=" ">
                                                    <img class="img-responsive thumbnail" src="../upload/customer/nbp/thumb/<?php echo $GR2->nic_photo_back; ?>">
                                                </a> 
                                            </div>
                                        </div>
                                    </div>
                                </div>>



                                <div class="row" style="margin-top: 20px;">
                                    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                        <label for="dob">Date of Birthday</label>
                                    </div>
                                    <div class="   p-bottom">
                                        <div class="form-group"> 
                                            <label for="dob" class="hidden-lg hidden-md">Date of Birthday</label>
                                            <div class="register-form-row-col">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <div class="form-line"> 
                                                            <div class="form-control"><?php
                                                                if ($GR2->dob_month == 1) {
                                                                    echo 'Jan';
                                                                } elseif ($GR2->dob_month == 2) {
                                                                    echo 'Feb';
                                                                } elseif ($GR2->dob_month == 3) {
                                                                    echo 'Mar';
                                                                } elseif ($GR2->dob_month == 4) {
                                                                    echo 'Apr';
                                                                } elseif ($GR2->dob_month == 5) {
                                                                    echo 'May';
                                                                } elseif ($GR2->dob_month == 6) {
                                                                    echo 'Jun';
                                                                } elseif ($GR2->dob_month == 7) {
                                                                    echo 'Jul';
                                                                } elseif ($GR2->dob_month == 8) {
                                                                    echo 'Aug';
                                                                } elseif ($GR2->dob_month == 9) {
                                                                    echo 'Sep';
                                                                } elseif ($GR2->dob_month == 10) {
                                                                    echo 'Oct';
                                                                } elseif ($GR2->dob_month == 11) {
                                                                    echo 'Nov';
                                                                } else {
                                                                    echo 'Dec';
                                                                }
                                                                ?></div>
                                                        </div>
                                                    </div> 
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <div class="form-line"> 
                                                            <div class="form-control"><?php echo $GR2->dob_day; ?></div>
                                                        </div>
                                                    </div> 
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <div class="form-line"> 
                                                            <div class="form-control"><?php echo $GR2->dob_year; ?></div>
                                                        </div>
                                                    </div> 
                                                </div>
                                            </div> 
                                        </div>
                                    </div> 
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                        <label >Address</label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label  class="hidden-lg hidden-md">Address</label>
                                                <div class="form-control" style="border-bottom: 1px solid #dddddd"><?php echo $GR2->address_line_1; ?></div>
                                                <div class="form-control" style="border-bottom: 1px solid #dddddd"><?php echo $GR2->address_line_2; ?></div>
                                                <div class="form-control" style="border-bottom: 1px solid #dddddd"><?php echo $GR2->address_line_3; ?></div>
                                                <div class="form-control" style="border-bottom: 1px solid #dddddd"><?php echo $GR2->address_line_4; ?></div>
                                                <div class="form-control" style="border-bottom: 1px solid #dddddd"><?php echo $GR2->address_line_5; ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row" class="list-unstyled    ">
                                    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                        <label for="billing_proof_image">Billing Proof Image</label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-6 col-xs-6 p-bottom">
                                        <div class="form-group">
                                            <div  class="list-unstyled   clearfix aniimated-thumbnials">
                                                <label for="billing_proof_image" class="hidden-lg hidden-md">Billing Proof Image</label>
                                                <a href="../upload/customer/billing-proof/<?php echo $GR2->billing_proof_image ?>" data-sub-html=" ">
                                                    <img class="img-responsive thumbnail" src="../upload/customer/billing-proof/thumb/<?php echo $GR2->billing_proof_image ?>">
                                                </a> 
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                        <label for="email">Email</label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="email" class="hidden-lg hidden-md">Email</label>
                                                <div class="form-control"><?php echo $GR2->email; ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                        <label for="telephone">Telephone</label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="telephone" class="hidden-lg hidden-md">Telephone</label>
                                                <div class="form-control"><?php echo $GR2->telephone; ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                        <label for="mobile">Mobile</label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="mobile" class="hidden-lg hidden-md">Mobile</label>
                                                <div class="form-control"><?php echo $GR2->mobile; ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                $ROUTE = new Route($GR2->route);
                                if ($ROUTE->id == $GR2->route) {
                                    ?>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                            <label for="route">Route</label>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <label for="route" class="hidden-lg hidden-md">Route</label>
                                                    <div class="form-control">
                                                        <?php
                                                        echo $ROUTE->name;
                                                        ?>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <?php
                                } else {
                                    ?>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                            <label for="center">Center</label>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <label for="center" class="hidden-lg hidden-md">Center</label>
                                                    <div class="form-control"><?php
                                                        $CENTER = new Center($GR2->center);
                                                        echo $CENTER->name;
                                                        ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>

                                <div class="row">
                                    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                        <label for="city">City</label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="city" class="hidden-lg hidden-md">City</label>
                                                <div class="form-control">
                                                    <?php
                                                    $CITY = new City($GR2->city);
                                                    echo $CITY->name;
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                        <label for="credit_limit">Credit Limit</label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="credit_limit" class="hidden-lg hidden-md">Credit Limit</label>
                                                <div class="form-control"><?php echo $GR2->credit_limit; ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                        <label for="signature_photo">Signature Photo</label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class="form-line"> 
                                                <div  class="list-unstyled   clearfix aniimated-thumbnials">
                                                    <label for="signature_photo" class="hidden-lg hidden-md">Signature Photo</label>
                                                    <a href="../upload/customer/signature/<?php echo $GR2->signature_image; ?>" data-sub-html="Signature Photo">
                                                        <img class="img-responsive thumbnail" src="../upload/customer/signature/thumb/<?php echo $GR2->signature_image; ?>">
                                                    </a> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                        <label for="business_name">Business Name</label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="business_name" class="hidden-lg hidden-md">Business Name</label>
                                                <div class="form-control"><?php echo $GR2->business_name; ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                        <label for="br_number">BR Number</label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="br_number" class="hidden-lg hidden-md">BR Number</label>
                                                <div class="form-control"><?php echo $GR2->br_number; ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                        <label for="nature_of_business">Nature of Business</label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="nature_of_business" class="hidden-lg hidden-md">Nature of Business</label>
                                                <div class="form-control"><?php echo $GR2->nature_of_business; ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                        <label for="br_picture">BR Photo</label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <div  class="list-unstyled   clearfix aniimated-thumbnials">
                                                    <label for="br_picture" class="hidden-lg hidden-md">BR Photo</label>
                                                    <?php if (empty($GR2->br_picture)) {
                                                        ?>
                                                        <img class="img-responsive thumbnail" src="../upload/sample-br.jpg">

                                                    <?php } else { ?>

                                                        <a href="../upload/customer/br/<?php echo $GR2->br_picture ?>" data-sub-html=" ">
                                                            <img class="img-responsive thumbnail" src="../upload/customer/br/thumb/<?php echo $GR2->br_picture ?>">
                                                        </a>
                                                        <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                        <label for="bank">Bank</label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="bank" class="hidden-lg hidden-md">Bank</label>
                                                <div class="form-control">
                                                    <?php
                                                    $BANK = new Bank($GR2->bank);
                                                    echo $BANK->name;
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                        <label for="branch">Branch</label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="branch" class="hidden-lg hidden-md">Branch</label>
                                                <div class="form-control">
                                                    <?php
                                                    $BRANCH = new Branch($GR2->branch);
                                                    echo $BRANCH->name;
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                        <label for="branch_code">Branch Code</label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="branch_code" class="hidden-lg hidden-md">Branch Code</label>
                                                <div class="form-control"><?php echo $GR2->branch_code; ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                        <label for="account_number">Account Number</label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="account_number" class="hidden-lg hidden-md">Account Number</label>
                                                <div class="form-control"><?php echo $GR2->account_number; ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                        <label for="holder_name">Holder Name</label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="holder_name" class="hidden-lg hidden-md">Holder Name</label>
                                                <div class="form-control"><?php echo $GR2->holder_name; ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                        <label for="bank_book_picture">Bank Book Photo</label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group"> 
                                            <div class=" clearfix aniimated-thumbnials">
                                                <label for="bank_book_picture" class="hidden-lg hidden-md">Bank Book Photo</label>
                                                <a href="../upload/customer/bbp/<?php echo $GR2->bank_book_picture; ?>" data-sub-html=" ">
                                                    <img class="img-responsive thumbnail" src="../upload/customer/bbp/thumb/<?php echo $GR2->bank_book_picture; ?>">
                                                </a>  
                                            </div> 
                                        </div> 
                                    </div>
                                </div>  
                            </div>
                            <div id="menu4" class="tab-pane fade">
                                <div class="body"> 
                                    <div class="row">
                                        <?php
                                        $LOAN_DOCUMENT = new LoanDocument(NUll);
                                        foreach ($LOAN_DOCUMENT->getDocumentByLoan($loan_id) as $loan_document) {
                                            ?>
                                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 p-bottom">
                                                <div class="form-group">
                                                    <div class=" clearfix aniimated-thumbnials">
                                                        <a href="../upload/loan/document/<?php echo $loan_document['image_name'] ?>" data-sub-html="<?php echo $loan_document['caption'] ?>">
                                                            <img class="img-responsive thumbnail" src="../upload/loan/document/thumb/<?php echo $loan_document['image_name'] ?>">
                                                        </a>  
                                                    </div> 
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>                                     
                                    <a href="add-loan-document.php?id=<?php echo $loan_id ?>"><button class="btn btn-info" value="Manage Document"> Manage Document</button> </a>                                   
                                </div>
                            </div>


                            <div class="body" style="margin: -10px 0px 0px 0px; padding: 0px 0px 50px 23px;">
                                <div class="row">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 hidden-sm hidden-xs">
                                            <input type="hidden" id="loan_id" value="<?php echo $LOAN->id; ?>"/>
                                            <input type="hidden" value="<?php echo $_SESSION['id']; ?>" id="verify_by">
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                                            <input type="submit" id="verify" class="btn btn-success" value="Verify Now"/> | 
                                            <input type="submit" id="reject" class="btn btn-warning" value="Reject Loan"/> | 
                                            <input type="submit" id="delete" class="btn btn-danger" value="Delete Loan"/>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <script src="plugins/jquery/jquery.min.js"></script> 
        <script src="plugins/bootstrap/js/bootstrap.js"></script> 
        <script src="plugins/jquery-slimscroll/jquery.slimscroll.js"></script>
        <script src="plugins/node-waves/waves.js"></script>
        <script src="plugins/jquery-spinner/js/jquery.spinner.js"></script>
        <script src="js/admin.js"></script>
        <script src="js/demo.js"></script> 
        <script src="plugins/jquery-ui/jquery-ui.js"></script>
        <script src="plugins/sweetalert/sweetalert.min.js"></script>
        <script src="js/ajax/loan.js"></script> 
        <script src="js/image.js" type="text/javascript"></script>
        <script src="plugins/light-gallery/js/lightgallery-all.js"></script>
        <script src="js/ajax/loan.js" type="text/javascript"></script>

        <script>
        $(function () {
            $(".datepicker").datepicker({
                dateFormat: 'yy-mm-dd',
                minDate: '-3D',
                maxDate: '+3D',
            });
        });
        </script>
    </body> 
</html>