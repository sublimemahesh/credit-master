<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/auth.php');


//check user level
$USERS = new User($_SESSION['id']);
$DEFAULTDATA = new DefaultData(NULL);
$DEFAULTDATA->checkUserLevelAccess('1,2,3', $USERS->user_level);

$INSTALLMENT = new Installment(NULL);

$LOAN = new Loan($_GET['id']);
$loan_id = $_GET['id'];

$CUSTOMER = new Customer($LOAN->customer);
$GR1 = new Customer($LOAN->guarantor_1);
$GR2 = new Customer($LOAN->guarantor_2);
$GR3 = new Customer($LOAN->guarantor_3);

$today = date("Y-m-d");
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
        <link href="plugins/light-gallery/css/lightgallery.css" rel="stylesheet">
        <link rel="stylesheet" href="plugins/jquery-ui/jquery-ui.css">        
        <link href="css/materialize.css" rel="stylesheet" type="text/css"/>
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
                        <h2>View Loan : <?php
                            if ($LOAN->installment_type == 30) {
                                echo 'BLD' . $loan_id;
                            } elseif ($LOAN->installment_type == 4) {
                                echo 'BLW' . $loan_id;
                            } else {
                                echo 'BLM' . $loan_id;
                            }
                            ?></h2>
                        <ul class="header-dropdown">
                            <li class="">
                                <a href="manage-verified-loans.php">
                                    <i class="material-icons">list</i> 
                                </a>
                            </li>
                        </ul>
                    </div> 
                    <div class="header" style="padding: 0px !important;"> 
                        <div id="od_limit"> </div>
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#home"><h5>Loan Details</h5></a></li>
                            <li><a data-toggle="tab" href="#menu0"><h5>Installment</h5></a></li>
                            <li><a data-toggle="tab" href="#menu1"><h5>Customer Details</h5></a></li>
                            <li><a data-toggle="tab" href="#menu2"><h5>Guarantor 01</h5></a></li>
                            <li><a data-toggle="tab" href="#menu3"><h5>Guarantor 02</h5></a></li>
                            <?php
                            if ($GR3->id == NULL) {
                                ?>
                                <li style="display: none;"><a data-toggle="tab" href="#menu4"><h5>Guarantor 03</h5></a></li>
                            <?php } else { ?>
                                <li ><a data-toggle="tab" href="#menu4"><h5>Guarantor 03</h5></a></li>
                            <?php } ?>
                            <li><a data-toggle="tab" href="#menu5"><h5>Loan Document</h5></a></li>
                            <li><a data-toggle="tab" href="#menu6"><h5>User History</h5></a></li>   
                            <li><a data-toggle="tab" href="#menu7"><h5>Od Limit</h5></a></li>   
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
                                        <label for="">Customer Name</label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="" class="hidden-lg hidden-md">Customer Name</label>
                                                <div class="form-control">
                                                    <?php
                                                    $first_name = $DEFAULTDATA->getFirstLetterName(ucwords($CUSTOMER->surname));
                                                    echo $first_name . ' ' . $CUSTOMER->first_name . ' ' . $CUSTOMER->last_name
                                                    ?> 

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                        <label for="">NIC Number</label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="" class="hidden-lg hidden-md">NIC Number</label>
                                                <div class="form-control">
                                                    <?php echo $CUSTOMER->nic_number; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                        <label for="">Mobile Number</label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="" class="hidden-lg hidden-md">Mobile Number</label>
                                                <div class="form-control">
                                                    <?php echo $CUSTOMER->mobile; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                        <label for="">Telephone Numbers</label>
                                    </div>

                                    <?php
                                    $telephone_numbers = "$CUSTOMER->telephone";
                                    $telephone_number = split(",", $telephone_numbers);
                                    ?>

                                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="" class="hidden-lg hidden-md">Telephone Numbers</label>
                                                <div class="form-control">
                                                    <?php echo $telephone_number[0] ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="" class="hidden-lg hidden-md">Telephone Numbers</label>
                                                <div class="form-control">
                                                    <?php
                                                    if ($telephone_number[1] == 0) {
                                                        
                                                    } else {
                                                        echo $telephone_number[1];
                                                    }
                                                    ?> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="" class="hidden-lg hidden-md">Telephone Numbers</label>
                                                <div class="form-control">
                                                    <?php
                                                    if ($telephone_number[2] == 0) {
                                                        
                                                    } else {
                                                        echo $telephone_number[2];
                                                    }
                                                    ?> 
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
                                                    <input type="hidden" value="<?php echo $LOAN->interest_rate ?>" id="interest_rate"> 
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
                                        <label for="issue_mode">Issue Mode</label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="" class="hidden-lg hidden-md">Issue Mode</label>
                                                <div> <?php echo ucfirst($LOAN->issue_mode); ?></div>
                                                <input type="hidden"   id="issue_mode_onloard" name="issue_mode" value="<?php echo $LOAN->issue_mode; ?>"   class="form-control  " autocomplete="off" disabled="">
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="row" style="display: none" id="loan_processing_pre">
                                    <div class="col-lg-3 col-md-3 form-control-label">
                                        <label for="deductions">Loan Processing Fee</label>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" id="loan_processing_pre_amount"   name="loan_processing_pre_amount"   class="form-control  " autocomplete="off" disabled="">
                                            </div>
                                        </div>
                                    </div>                               

                                    <div class="col-lg-2 col-md-2  col-sm-12 col-xs-12  form-control-label">
                                        <div class="form-group">
                                            <div class="form-line" style="display: none" id="document_free">
                                                <input type="text" id="document_free_amount"   name="document_free_amount"  placeholder="Document Fee" class="form-control  " autocomplete="off" disabled="">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 " style="display: none" id="stamp_fee_amount">
                                        <div class="form-group">
                                            <div class="form-line"> 
                                                <input type="text" id="stamp_fee"  name="stamp_fee"   placeholder="Stamp Fee" class="form-control  " autocomplete="off" disabled="">
                                            </div>
                                        </div>
                                    </div>

                                    <div  style="display: none" id="bank_transaction_free_amount">                                   
                                        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 p-bottom">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" id="bank_transaction_free"  name="bank_transaction_free"   placeholder="bank_transaction_free" class="form-control  " autocomplete="off" disabled="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12  " style="display: none" id="cheque_free">
                                        <div class="form-group">
                                            <div class="form-line" > 
                                                <input type="text" id="cheque_free_amount"   name="cheque_free_amount"  placeholder=" Cheque Fee" class="form-control  " autocomplete="off" disabled="">
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                                <?php if ($LOAN->balance_of_last_loan != 0) { ?>
                                    <div class="row" id="balance_of_last_loan_row"  >
                                        <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                            <label for="balance_of_last_loan">Balance Of the last Loan</label>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <label for="balance_of_last_loan" class="hidden-lg hidden-md">Balance Of the last Loan</label>
                                                    <div class="form-control"  > 
                                                        <input type="text"    id="balance_of_last_loan_amount" name="balance_of_last_loan" placeholder="00.00" value="<?php echo number_format($LOAN->balance_of_last_loan, 2) ?>"class="form-control  " autocomplete="off" disabled="" style="color: red;">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>

                                <div class="row">
                                    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                        <label for="total_deductions">Total Deductions </label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="total_deductions" class="hidden-lg hidden-md">Total Deductions </label>
                                                <div class="form-control">
                                                    <?php
                                                    $DEFAULTDATA_2 = new DefaultData(NULL);
                                                    if ($LOAN->issue_mode == 'cash') {

                                                        $loan_proccesign_fee = $DEFAULTDATA_2->loanProcessingPreCash($LOAN->loan_amount);
                                                        ?>
                                                        <input type="text"  class="form-control "   value="<?php echo number_format($LOAN->balance_of_last_loan + $loan_proccesign_fee['total'], 2) ?>" autocomplete="off" disabled="" style="color: red;">
                                                        <?php
                                                    } else if ($LOAN->issue_mode == 'bank') {
                                                        $loan_proccesign_fee = $DEFAULTDATA_2->loanProcessingPreBank($LOAN->loan_amount);
                                                        ?>
                                                        <input type="text"     class="form-control "  value="<?php echo number_format($LOAN->balance_of_last_loan + $loan_proccesign_fee['total'], 2) ?>" autocomplete="off" disabled="" style="color: red;">
                                                        <?php
                                                    } else if ($LOAN->issue_mode == "cheque") {
                                                        $loan_proccesign_fee = $DEFAULTDATA_2->loanProcessingPreCheque($LOAN->loan_amount);
                                                        ?>
                                                        <input type="text"     class="form-control "  value="<?php echo number_format($LOAN->balance_of_last_loan + $loan_proccesign_fee['total'], 2) ?>" autocomplete="off" disabled="" style="color: red;">
                                                        <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                $loan = $LOAN->getDetailsByCustomer($LOAN->customer);
                                $down_payment = $INSTALLMENT->getAmountByType($loan[0], 'down_payment');

                                if ((int) $down_payment[0] != NULL) {
                                    ?>
                                    <div class="row" id="down_payment_row" >
                                        <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                            <label for="down_payment">Down Payment</label>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <label for="down_payment" class="hidden-lg hidden-md">Down Payment</label>
                                                    <div class="form-control"> 
                                                        <input type="text"    class="form-control" value="<?php echo number_format($down_payment[0], 2) ?>" autocomplete="off" readonly="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>                               
                                <?php } ?>

                                <?php
                                $paid_loan_processing_fee = $INSTALLMENT->getAmountByType($loan[0], 'loan_processing_fee');
                                if ((int) $paid_loan_processing_fee[0] != NULL) {
                                    ?>
                                    <div class="row" id="paid_loan_processing_fee_row" >
                                        <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                            <label for="paid_loan_processing_fee">Paid Loan Processing Fee</label>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <label for="paid_loan_processing_fee" class="hidden-lg hidden-md">Paid Loan Processing Fee</label>
                                                    <div class="form-control">

                                                        <input type="text"   value="<?php echo number_format($paid_loan_processing_fee[0], 2) ?>" class="form-control  " autocomplete="off" disabled="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>

                                <div class="row">
                                    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                        <label for="balance_pay">Balance Pay </label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="balance_pay" class="hidden-lg hidden-md">Balance Pay </label>
                                                <div class="form-control">
                                                    <?php
                                                    $balance_pay = $LOAN->loan_amount - $LOAN->balance_of_last_loan - $loan_proccesign_fee['total'] + $down_payment[0] + $paid_loan_processing_fee[0];
                                                    ?>
                                                    <input type="text" id="balance_pay_amount" value="<?php echo number_format($balance_pay, 2) ?>" class="form-control font-weight-new " autocomplete="off" disabled="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <?php
                                if ($LOAN->issue_mode == "bank") {
                                    ?>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                            <label for="balance_pay">Balance Pay</label>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <label for="balance_pay" class="hidden-lg hidden-md">Balance Pay</label>
                                                    <div> 
                                                        <?php
                                                        $DEFAULTDATA_2 = new DefaultData();
                                                        $loan_proccesign_fee = $DEFAULTDATA_2->getLoanBankFee();
                                                        echo $LOAN->loan_amount - $LOAN->balance_of_last_loan;
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
                                <?php } elseif ($LOAN->issue_mode == "cash") { ?>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                            <label for="collector">Collector</label>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <label for="collector" class="hidden-lg hidden-md">Collector</label>
                                                    <div class="form-control"><?php
                                                        $USER = new User($LOAN->collector);
                                                        echo $USER->name
                                                        ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } else { ?>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                            <label for="collector">Collector</label>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <label for="collector" class="hidden-lg hidden-md">Collector</label>
                                                    <div class="form-control"><?php
                                                        $USER = new User($LOAN->collector);
                                                        echo $USER->name
                                                        ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>



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
                                                    $PT = DefaultData::getInstallmentType();
                                                    $pt = $PT[$LOAN->installment_type];
                                                    echo $pt;
                                                    ?>
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
                                                <input type="text" id="number_of_installments" class="form-control" value="<?php echo DefaultData::getNumOfInstlByPeriodAndType($LOAN->loan_period, $LOAN->installment_type); ?>" readonly="">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                        <label for="first_installment_date">First Installment Date </label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="first_installment_date" class="hidden-lg hidden-md">First Installment Date </label>
                                                <?php
                                                if ($LOAN->installment_type == 4) {
                                                    $FID = new DateTime($LOAN->effective_date);
                                                    $FID->modify('+7 day');
                                                    $first_installment_date = $FID->format('Y-m-d');
                                                    ?>
                                                    <input type="text"   value="<?php echo date("Y m M d D", strtotime($first_installment_date)) . ' | ' . $pt ?>" placeholder="Please Select The Effective Date" class="form-control  " disabled="" autocomplete="off"> 
                                                    <?php
                                                } elseif ($LOAN->installment_type == 30) {

                                                    $FID = new DateTime($LOAN->effective_date);
                                                    $FID->modify('+1 day');
                                                    $first_installment_date = $FID->format('Y-m-d');
                                                    ?>
                                                    <input type="text"   value="<?php echo date("Y m M d D", strtotime($first_installment_date)) . ' | ' . $pt ?>" placeholder="Please Select The Effective Date" class="form-control  " disabled="" autocomplete="off">
                                                    <?php
                                                } elseif ($LOAN->installment_type == 1) {
                                                    $FID = new DateTime($LOAN->effective_date);
                                                    $FID->modify('+1 months');
                                                    $first_installment_date = $FID->format('Y-m-d');
                                                    ?>
                                                    <input type="text"   value="<?php echo date("Y m M d D", strtotime($first_installment_date)) . ' | ' . $pt ?>" placeholder="Please Select The Effective Date" class="form-control  " disabled="" autocomplete="off">
                                                    <?php
                                                }
                                                ?>
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
                                                <input type="text" id="effective_date"  name="effective_date" value="<?php echo $LOAN->effective_date; ?>" placeholder="Please Select The Effective Date" class="form-control  " autocomplete="off" readonly="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr/>

                                <div class="row">
                                    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                        <label for="paid_number_installment">Paid Number of Installments</label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="paid_number_installment" class="hidden-lg hidden-md"> Paid Number of Installments</label>
                                                <?php
                                                $paid_numbers_of_installments = $INSTALLMENT->getPaidNumberOfInstallment($LOAN->installment_amount, $loan_id);
                                                ?>
                                                <input type="text" id="paid_number_installment"  name="paid_number_installment" value="<?php echo round($paid_numbers_of_installments, 1) ?>" readonly="" class="form-control  " autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                        <label for="payble_number_installment">Payble Number of Installments</label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="payble_number_installment" class="hidden-lg hidden-md"> Payble Number of Installments</label>
                                                <?php
                                                $payble_of_installments = $INSTALLMENT->getPaybleNumberOfInstallments(DefaultData::getNumOfInstlByPeriodAndType($LOAN->loan_period, $LOAN->installment_type), $INSTALLMENT->getPaidNumberOfInstallment($LOAN->installment_amount, $loan_id));
                                                ?>
                                                <input type="text" id="paid_number_installment"  name="paid_number_installment" value="<?php echo number_format($payble_of_installments, 1) ?>" readonly="" class="form-control  " autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                        <label for="paid_amount">Paid Amount </label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="paid_amount" class="hidden-lg hidden-md">Paid  Amount</label>
                                                <?php $paid_amount = $INSTALLMENT->getAmountByLoanId($loan_id); ?>
                                                <input type="text" id="paid_amount"  name="paid_amount" value="<?php echo number_format($paid_amount[0], 2) ?>" class="form-control  " autocomplete="off" readonly="">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                        <label for="total_payble_amount"> Payable Amount </label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="total_payble_amount" class="hidden-lg hidden-md"> Payable Amount</label>
                                                <?php
                                                $LOAN_1 = new Loan($loan_id);
                                                $status = $LOAN_1->getCurrentStatus();

                                                $payble_amount = $INSTALLMENT->getPaybleInstallmentAmount($loan_id, $LOAN->loan_amount, $LOAN->interest_rate, $LOAN->number_of_installments);
                                                ?>
                                                <!--<input type="text" id="paid_number_installment"  name="paid_number_installment" value="<?php echo number_format($status["actual-due"], 2) ?>"   class="form-control  " autocomplete="off" readonly="">-->
                                            </div>
                                        </div>
                                    </div>
                                </div>



                                <div class="row">
                                    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                        <label for="interest"> Interest</label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="interest" class="hidden-lg hidden-md"> Interest</label>
                                                <input type="text" class="form-control" id="interest_amount" readonly=""/>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                        <label for="due_amount">  Due Amount</label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="due_amount" class="hidden-lg hidden-md"> Due Amount</label>
                                                <input type="text" class="form-control" id="due_amount" readonly="" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php if ($LOAN->od_interest_limit !== 'NOT') { ?>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                            <label for="od_interest_limit">OD Interest Limit</label>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 p-bottom">
                                            <div class="form-group">
                                                <div class="form-line"> 
                                                    <input type="number" name="od_interest_limit"  placeholder="Enter OD Interest Limit" class="form-control" value="<?php echo $LOAN->od_interest_limit ?>" autocomplete="off" min="0" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 p-bottom">
                                            <div class="form-group">
                                                <div class="form-line">                                            
                                                    <input type="text" name="od_date"  placeholder="Enter OD Interest Limit Date" class="form-control od_date" value="<?php echo $LOAN->od_date ?>"autocomplete="off"  >
                                                </div>
                                            </div>
                                        </div>                                        
                                    </div>  
                                <?php } ?>
                                <hr/>

                                <div class="row">
                                    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                        <label for="issued_date">Issue Date</label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="issued_date" class="hidden-lg hidden-md">Issue Date</label>
                                                <input type="text" id="issued_date"  name="issued_date" value="<?php echo $LOAN->issued_date ?>"  readonly="" class="form-control " autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                        <label for="issue_note">Issue Note</label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="issue_note" class="hidden-lg hidden-md">Issue Note</label>
                                                <textarea name="issue_note" id="issue_note" class="form-control" readonly=""><?php echo $LOAN->issue_note ?></textarea> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                        <label for="transaction_id">Transaction Id</label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="transaction_id" class="hidden-lg hidden-md">Transaction Id</label>
                                                <input type="text" id="transaction_id"  name="transaction_id" value="<?php echo $LOAN->transaction_id ?>"  readonly="" class="form-control " autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row" class="list-unstyled   clearfix  ">
                                    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                        <label for="transaction_document">Transaction Document</label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-6 col-xs-6 p-bottom">
                                        <div class="form-group">
                                            <div  class="list-unstyled   clearfix aniimated-thumbnials">
                                                <label for="transaction_document" class="hidden-lg hidden-md">Transaction Document</label>
                                                <?php if (empty($LOAN->transaction_document)) {
                                                    ?>
                                                    <img class="img-responsive thumbnail image-width" src="../upload/sample.jpg">

                                                <?php } else { ?>

                                                    <a href="../upload/loan/transaction_document/<?php echo $LOAN->transaction_document ?>" data-sub-html=" ">
                                                        <img class="img-responsive thumbnail image-width" src="../upload/loan/transaction_document/thumb/<?php echo $LOAN->transaction_document ?>">
                                                    </a>  
                                                    <?php
                                                }
                                                ?>

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
                                                    <th>ID</th>
                                                    <th>Installment Date</th> 
                                                    <th>Installment Amount</th> 
                                                    <th>Due and Excess</th> 

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
                                                    if (PostponeDate::CheckIsPostPoneByDateAndCustomer($date, $customer) || PostponeDate::CheckIsPostPoneByDateAndRoute($date, $route) || PostponeDate::CheckIsPostPoneByDateAndCenter($date, $center) || PostponeDate::CheckIsPostPoneByDateAndAll($date)) {
                                                        echo '<td>';
                                                        echo $count;
                                                        echo '</td>';
                                                        echo '<td class="padd-td red">';
                                                        echo $date;
                                                        echo '</td>';
                                                        echo '<td class="padd-td red gray text-center" colspan=5>';
                                                        echo '-- Postponed --';
                                                        echo '</td>';

                                                        $start->modify($add_dates);
                                                    } else {
                                                        echo '<td>';
                                                        echo $count;
                                                        echo '</td>';
                                                        echo '<td class="padd-td f-style">';
                                                        echo $date;
                                                        echo '</td>';
                                                        echo '<td class="f-style">';
                                                        echo 'Rs: ' . number_format($amount, 2);
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
                                                    <th>ID</th>
                                                    <th>Installment Date</th> 
                                                    <th>Installment Amount</th>                                                      
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
                                            <?php if (empty($CUSTOMER->profile_picture)) {
                                                ?>
                                                <img class="img-responsive thumbnail " src="../upload/sample.jpg">

                                            <?php } else { ?>

                                                <a href="../upload/customer/profile/<?php echo $CUSTOMER->profile_picture; ?>" data-sub-html=" ">
                                                    <img class="img-responsive thumbnail  " src="../upload/customer/profile/thumb/<?php echo $CUSTOMER->profile_picture; ?>">
                                                </a> 
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                        <label for="nic_photo_front">NIC Photos(F/B)</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 p-bottom">
                                        <div class="form-group">
                                            <div  class="list-unstyled   clearfix aniimated-thumbnials">
                                                <label for="nic_photo_front" class="hidden-lg hidden-md">NIC Photo Front</label>

                                                <?php if (empty($CUSTOMER->nic_photo_front)) {
                                                    ?>
                                                    <img class="img-responsive thumbnail image-width" src="../upload/sample.jpg">

                                                <?php } else { ?>


                                                    <a href="../upload/customer/nfp/<?php echo $CUSTOMER->nic_photo_front; ?>" data-sub-html=" ">
                                                        <img class="img-responsive thumbnail image-width" src="../upload/customer/nfp/thumb/<?php echo $CUSTOMER->nic_photo_front; ?>">
                                                    </a> 
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 p-bottom">
                                        <div class="form-group">
                                            <div  class="list-unstyled  clearfix aniimated-thumbnials">
                                                <label for="nic_photo_back" class="hidden-lg hidden-md">NIC Photo Back</label>
                                                <?php if (empty($CUSTOMER->nic_photo_back)) {
                                                    ?>
                                                    <img class="img-responsive thumbnail image-width" src="../upload/sample.jpg">

                                                <?php } else { ?>

                                                    <a href="../upload/customer/nbp/<?php echo $CUSTOMER->nic_photo_back; ?>" data-sub-html=" ">
                                                        <img class="img-responsive thumbnail image-width" src="../upload/customer/nbp/thumb/<?php echo $CUSTOMER->nic_photo_back; ?>">
                                                    </a> 
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                                <div class="row"  >
                                    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                        <label for="dob"  >Date of Birthday</label>
                                    </div><div class="  p-bottom">
                                        <div class="form-group"> 
                                            <label for="dob" class="hidden-lg hidden-md">Date of Birthday</label>
                                            <div class="register-form-row-col">
                                                <div class="col-md-3">
                                                    <div class="form-group" style="margin-top: -20px;">
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
                                                    <div class="form-group" style="margin-top: -20px;">
                                                        <div class="form-line"> 
                                                            <div class="form-control"><?php echo $CUSTOMER->dob_day; ?></div>
                                                        </div>
                                                    </div> 
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group" style="margin-top: -20px;">
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
                                                <?php if (empty($CUSTOMER->billing_proof_image)) {
                                                    ?>
                                                    <img class="img-responsive thumbnail image-width" src="../upload/sample.jpg">

                                                <?php } else { ?>

                                                    <a href="../upload/customer/billing-proof/<?php echo $CUSTOMER->billing_proof_image ?>" data-sub-html=" ">
                                                        <img class="img-responsive thumbnail image-width" src="../upload/customer/billing-proof/thumb/<?php echo $CUSTOMER->billing_proof_image ?>">
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
                                        <label for="gn_division">GN Division</label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="gn_division" class="hidden-lg hidden-md">GN Division</label>
                                                <div class="form-control">
                                                    <?php
                                                    $GNDIVISION = new GnDivision($CUSTOMER->gn_division);
                                                    echo $GNDIVISION->name;
                                                    ?>
                                                </div>
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
                                        <label for="">Telephone Numbers</label>
                                    </div>

                                    <?php
                                    $telephone_numbers = "$CUSTOMER->telephone";
                                    $telephone_number = split(",", $telephone_numbers);
                                    ?>

                                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="" class="hidden-lg hidden-md">Telephone Numbers</label>
                                                <div class="form-control">
                                                    <?php echo $telephone_number[0] ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="" class="hidden-lg hidden-md">Telephone Numbers</label>
                                                <div class="form-control">
                                                    <?php
                                                    if ($telephone_number[1] == 0) {
                                                        
                                                    } else {
                                                        echo $telephone_number[1];
                                                    }
                                                    ?> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="" class="hidden-lg hidden-md">Telephone Numbers</label>
                                                <div class="form-control">
                                                    <?php
                                                    if ($telephone_number[2] == 0) {
                                                        
                                                    } else {
                                                        echo $telephone_number[2];
                                                    }
                                                    ?> 
                                                </div>
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
                                                    <?php if (empty($CUSTOMER->signature_image)) {
                                                        ?>
                                                        <img class="img-responsive thumbnail image-width" src="../upload/sample.jpg">

                                                    <?php } else { ?>

                                                        <a href="../upload/customer/signature/<?php echo $CUSTOMER->signature_image; ?>" data-sub-html="Signature Photo">
                                                            <img class="img-responsive thumbnail image-width" src="../upload/customer/signature/thumb/<?php echo $CUSTOMER->signature_image; ?>">
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
                                                    <img class="img-responsive thumbnail image-width" src="../upload/sample.jpg">

                                                <?php } else { ?>

                                                    <a href="../upload/customer/br/<?php echo $CUSTOMER->br_picture ?>" data-sub-html=" ">
                                                        <img class="img-responsive thumbnail image-width" src="../upload/customer/br/thumb/<?php echo $CUSTOMER->br_picture ?>">
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
                                                <?php if (empty($CUSTOMER->bank_book_picture)) {
                                                    ?>
                                                    <img class="img-responsive thumbnail image-width" src="../upload/sample.jpg">

                                                <?php } else { ?>

                                                    <a href="../upload/customer/bbp/<?php echo $CUSTOMER->bank_book_picture; ?>" data-sub-html=" ">
                                                        <img class="img-responsive thumbnail image-width" src="../upload/customer/bbp/thumb/<?php echo $CUSTOMER->bank_book_picture; ?>">
                                                    </a>  
                                                    <?php
                                                }
                                                ?>

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

                                        <?php if (empty($GR1->profile_picture)) {
                                            ?>
                                            <img class="img-responsive thumbnail " src="../upload/sample.jpg">

                                        <?php } else { ?>

                                            <div   class="list-unstyled row clearfix aniimated-thumbnials ">
                                                <a href="../upload/customer/profile/<?php echo $GR1->profile_picture; ?>" data-sub-html=" ">
                                                    <img class="img-responsive thumbnail" src="../upload/customer/profile/thumb/<?php echo $GR1->profile_picture; ?>">
                                                </a> 
                                            </div>
                                            <?php
                                        }
                                        ?>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                        <label for="nic_photo_front">NIC Photos(F/B)</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 p-bottom">
                                        <div class="form-group">
                                            <div  class="list-unstyled   clearfix aniimated-thumbnials">
                                                <label for="nic_photo_front" class="hidden-lg hidden-md">NIC Photo Front</label>

                                                <?php if (empty($GR1->nic_photo_front)) {
                                                    ?>
                                                    <img class="img-responsive thumbnail image-width" src="../upload/sample.jpg">

                                                <?php } else { ?>

                                                    <a href="../upload/customer/nfp/<?php echo $GR1->nic_photo_front; ?>" data-sub-html=" ">
                                                        <img class="img-responsive thumbnail image-width" src="../upload/customer/nfp/thumb/<?php echo $CUSTOMER->nic_photo_front; ?>">
                                                    </a>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 p-bottom">
                                        <div class="form-group">
                                            <div  class="list-unstyled  clearfix aniimated-thumbnials">
                                                <label for="nic_photo_back" class="hidden-lg hidden-md">NIC Photo Back</label>
                                                <?php if (empty($GR1->nic_photo_back)) {
                                                    ?>
                                                    <img class="img-responsive thumbnail image-width" src="../upload/sample.jpg">

                                                <?php } else { ?>

                                                    <a href="../upload/customer/nbp/<?php echo $GR1->nic_photo_back; ?>" data-sub-html=" ">
                                                        <img class="img-responsive thumbnail image-width" src="../upload/customer/nbp/thumb/<?php echo $CUSTOMER->nic_photo_back; ?>">
                                                    </a> 
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row" >
                                    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                        <label for="dob"  >Date of Birthday</label>
                                    </div>
                                    <div class=" p-bottom">
                                        <div class="form-group"> 
                                            <label for="dob" class="hidden-lg hidden-md">Date of Birthday</label>
                                            <div class="register-form-row-col">
                                                <div class="col-md-3">
                                                    <div class="form-group" style="margin-top: -20px;">
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
                                                    <div class="form-group" style="margin-top: -20px;">
                                                        <div class="form-line"> 
                                                            <div class="form-control"><?php echo $GR1->dob_day; ?></div>
                                                        </div>
                                                    </div> 
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group" style="margin-top: -20px;">
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
                                                <?php if (empty($GR1->billing_proof_image)) {
                                                    ?>
                                                    <img class="img-responsive thumbnail image-width" src="../upload/sample.jpg">

                                                <?php } else { ?>

                                                    <a href="../upload/customer/billing-proof/<?php echo $GR1->billing_proof_image ?>" data-sub-html=" ">
                                                        <img class="img-responsive thumbnail image-width" src="../upload/customer/billing-proof/thumb/<?php echo $GR1->billing_proof_image ?>">
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
                                        <label for="gn_division">GN Division</label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="gn_division" class="hidden-lg hidden-md">GN Division</label>
                                                <div class="form-control">
                                                    <?php
                                                    $GNDIVISION = new GnDivision($GR1->gn_division);
                                                    echo $GNDIVISION->name;
                                                    ?>
                                                </div>
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
                                        <label for="">Telephone Numbers</label>
                                    </div>

                                    <?php
                                    $telephone_numbers = "$GR1->telephone";
                                    $telephone_number = split(",", $telephone_numbers);
                                    ?>

                                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="" class="hidden-lg hidden-md">Telephone Numbers</label>
                                                <div class="form-control">
                                                    <?php echo $telephone_number[0] ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="" class="hidden-lg hidden-md">Telephone Numbers</label>
                                                <div class="form-control">
                                                    <?php
                                                    if ($telephone_number[1] == 0) {
                                                        
                                                    } else {
                                                        echo $telephone_number[1];
                                                    }
                                                    ?> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="" class="hidden-lg hidden-md">Telephone Numbers</label>
                                                <div class="form-control">
                                                    <?php
                                                    if ($telephone_number[2] == 0) {
                                                        
                                                    } else {
                                                        echo $telephone_number[2];
                                                    }
                                                    ?> 
                                                </div>
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

                                                    <?php if (empty($GR1->signature_image)) {
                                                        ?>
                                                        <img class="img-responsive thumbnail image-width" src="../upload/sample.jpg">

                                                    <?php } else { ?>

                                                        <a href="../upload/customer/signature/<?php echo $GR1->signature_image; ?>" data-sub-html="Signature Photo">
                                                            <img class="img-responsive thumbnail image-width" src="../upload/customer/signature/thumb/<?php echo $GR1->signature_image; ?>">
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
                                                        <img class="img-responsive thumbnail image-width" src="../upload/sample.jpg">

                                                    <?php } else { ?>

                                                        <a href="../upload/customer/br/<?php echo $GR1->br_picture ?>" data-sub-html=" ">
                                                            <img class="img-responsive thumbnail image-width" src="../upload/customer/br/thumb/<?php echo $GR1->br_picture ?>">
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

                                                <?php if (empty($GR1->bank_book_picture)) {
                                                    ?>
                                                    <img class="img-responsive thumbnail image-width" src="../upload/sample.jpg">

                                                <?php } else { ?>

                                                    <a href="../upload/customer/bbp/<?php echo $GR1->bank_book_picture; ?>" data-sub-html=" ">
                                                        <img class="img-responsive thumbnail image-width" src="../upload/customer/bbp/thumb/<?php echo $GR1->bank_book_picture; ?>">
                                                    </a>
                                                    <?php
                                                }
                                                ?>

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
                                            <?php if (empty($GR2->profile_picture)) {
                                                ?>
                                                <img class="img-responsive thumbnail" src="../upload/sample.jpg">

                                            <?php } else { ?>

                                                <a href="../upload/customer/profile/<?php echo $GR2->profile_picture; ?>" data-sub-html=" ">
                                                    <img class="img-responsive thumbnail" src="../upload/customer/profile/thumb/<?php echo $GR2->profile_picture; ?>">
                                                </a> 
                                                <?php
                                            }
                                            ?>

                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                        <label for="nic_photo_front">NIC Photos(F/B)</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 p-bottom">
                                        <div class="form-group">
                                            <div  class="list-unstyled   clearfix aniimated-thumbnials">
                                                <label for="nic_photo_front" class="hidden-lg hidden-md">NIC Photo Front</label>
                                                <?php if (empty($GR2->nic_photo_front)) {
                                                    ?>
                                                    <img class="img-responsive thumbnail image-width" src="../upload/sample.jpg">

                                                <?php } else { ?>
                                                    <a href="../upload/customer/nfp/<?php echo $GR2->nic_photo_front; ?>" data-sub-html=" ">
                                                        <img class="img-responsive thumbnail image-width" src="../upload/customer/nfp/thumb/<?php echo $GR2->nic_photo_front; ?>">
                                                    </a> 

                                                    <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 p-bottom">
                                        <div class="form-group">
                                            <div  class="list-unstyled  clearfix aniimated-thumbnials">
                                                <label for="nic_photo_back" class="hidden-lg hidden-md">NIC Photo Back</label>
                                                <?php if (empty($GR2->nic_photo_back)) {
                                                    ?>
                                                    <img class="img-responsive thumbnail image-width" src="../upload/sample.jpg">

                                                <?php } else { ?>
                                                    <a href="../upload/customer/nbp/<?php echo $GR2->nic_photo_back; ?>" data-sub-html=" ">
                                                        <img class="img-responsive thumbnail image-width" src="../upload/customer/nbp/thumb/<?php echo $GR2->nic_photo_back; ?>">
                                                    </a>

                                                    <?php
                                                }
                                                ?>  
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row" >
                                    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                        <label for="dob">Date of Birthday</label>
                                    </div>
                                    <div class="   p-bottom">
                                        <div class="form-group"> 
                                            <label for="dob" class="hidden-lg hidden-md">Date of Birthday</label>
                                            <div class="register-form-row-col">
                                                <div class="col-md-3">
                                                    <div class="form-group" style="margin-top: -20px;">
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
                                                    <div class="form-group" style="margin-top: -20px;">
                                                        <div class="form-line"> 
                                                            <div class="form-control"><?php echo $GR2->dob_day; ?></div>
                                                        </div>
                                                    </div> 
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group" style="margin-top: -20px;">
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
                                                <?php if (empty($GR2->billing_proof_image)) {
                                                    ?>
                                                    <img class="img-responsive thumbnail image-width" src="../upload/sample.jpg">

                                                <?php } else { ?>
                                                    <a href="../upload/customer/billing-proof/<?php echo $GR2->billing_proof_image ?>" data-sub-html=" ">
                                                        <img class="img-responsive thumbnail image-width" src="../upload/customer/billing-proof/thumb/<?php echo $GR2->billing_proof_image ?>">
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
                                        <label for="gn_division">GN Division</label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="gn_division" class="hidden-lg hidden-md">GN Division</label>
                                                <div class="form-control">
                                                    <?php
                                                    $GNDIVISION = new GnDivision($GR2->gn_division);
                                                    echo $GNDIVISION->name;
                                                    ?>
                                                </div>
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

                                <div class="row">
                                    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                        <label for="">Telephone Numbers</label>
                                    </div>

                                    <?php
                                    $telephone_numbers = "$GR2->telephone";
                                    $telephone_number = split(",", $telephone_numbers);
                                    ?>

                                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="" class="hidden-lg hidden-md">Telephone Numbers</label>
                                                <div class="form-control">
                                                    <?php echo $telephone_number[0] ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="" class="hidden-lg hidden-md">Telephone Numbers</label>
                                                <div class="form-control">
                                                    <?php
                                                    if (empty($telephone_number[1])) {
                                                        echo '0';
                                                    } else {

                                                        echo $telephone_number[1];
                                                    }
                                                    ?>  
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="" class="hidden-lg hidden-md">Telephone Numbers</label>
                                                <div class="form-control">
                                                    <?php
                                                    if (empty($telephone_number[2])) {
                                                        echo '0';
                                                    } else {

                                                        echo $telephone_number[2];
                                                    }
                                                    ?> 
                                                </div>
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

                                                    <?php if (empty($GR2->signature_image)) {
                                                        ?>
                                                        <img class="img-responsive thumbnail image-width" src="../upload/sample.jpg">

                                                    <?php } else { ?>
                                                        <a href="../upload/customer/signature/<?php echo $GR2->signature_image; ?>" data-sub-html="Signature Photo">
                                                            <img class="img-responsive thumbnail image-width" src="../upload/customer/signature/thumb/<?php echo $GR2->signature_image; ?>">
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
                                                        <img class="img-responsive thumbnail image-width" src="../upload/sample.jpg">

                                                    <?php } else { ?>

                                                        <a href="../upload/customer/br/<?php echo $GR2->br_picture ?>" data-sub-html=" ">
                                                            <img class="img-responsive thumbnail image-width" src="../upload/customer/br/thumb/<?php echo $GR2->br_picture ?>">
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

                                                <?php if (empty($GR2->bank_book_picture)) {
                                                    ?>
                                                    <img class="img-responsive thumbnail image-width" src="../upload/sample.jpg">

                                                <?php } else { ?>

                                                    <a href="../upload/customer/bbp/<?php echo $GR2->bank_book_picture; ?>" data-sub-html=" ">
                                                        <img class="img-responsive thumbnail image-width" src="../upload/customer/bbp/thumb/<?php echo $GR2->bank_book_picture; ?>">
                                                    </a>
                                                    <?php
                                                }
                                                ?>

                                            </div> 
                                        </div> 
                                    </div>
                                </div>  
                            </div>
                        </div>
                        <div id="menu4" class="tab-pane fade">
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
                                                        <div class="form-control"><?php echo $GR3->title; ?></div>
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
                                                        <div class="form-control"><?php echo $GR3->first_name; ?></div>
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
                                                        <div class="form-control"><?php echo $GR3->last_name; ?></div>
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
                                                        <div class="form-control"><?php echo $GR3->surname; ?></div>
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
                                                        <div class="form-control"><?php echo $GR3->nic_number; ?></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>  
                                    </div>
                                    <div class="col-md-3">
                                        <div  class="list-unstyled row clearfix aniimated-thumbnials ">
                                            <?php if (empty($GR3->profile_picture)) {
                                                ?>
                                                <img class="img-responsive thumbnail" src="../upload/sample.jpg">

                                            <?php } else { ?>

                                                <a href="../upload/customer/profile/<?php echo $GR3->profile_picture; ?>" data-sub-html=" ">
                                                    <img class="img-responsive thumbnail " src="../upload/customer/profile/thumb/<?php echo $GR3->profile_picture; ?>">
                                                </a> 
                                                <?php
                                            }
                                            ?>

                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                        <label for="nic_photo_front">NIC Photos(F/B)</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 p-bottom">
                                        <div class="form-group">
                                            <div  class="list-unstyled   clearfix aniimated-thumbnials">
                                                <label for="nic_photo_front" class="hidden-lg hidden-md">NIC Photo Front</label>
                                                <?php if (empty($GR3->nic_photo_front)) {
                                                    ?>
                                                    <img class="img-responsive thumbnail image-width" src="../upload/sample.jpg">

                                                <?php } else { ?>

                                                    <a href="../upload/customer/nfp/<?php echo $GR3->nic_photo_front; ?>" data-sub-html=" ">
                                                        <img class="img-responsive thumbnail image-width" src="../upload/customer/nfp/thumb/<?php echo $GR3->nic_photo_front; ?>">
                                                    </a> 
                                                    <?php
                                                }
                                                ?>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 p-bottom">
                                        <div class="form-group">
                                            <div  class="list-unstyled  clearfix aniimated-thumbnials">
                                                <label for="nic_photo_back" class="hidden-lg hidden-md">NIC Photo Back</label>
                                                <?php if (empty($GR3->nic_photo_back)) {
                                                    ?>
                                                    <img class="img-responsive thumbnail image-width" src="../upload/sample.jpg">
                                                <?php } else { ?>

                                                    <a href="../upload/customer/nbp/<?php echo $GR3->nic_photo_back; ?>" data-sub-html=" ">
                                                        <img class="img-responsive thumbnail image-width" src="../upload/customer/nbp/thumb/<?php echo $GR3->nic_photo_back; ?>">
                                                    </a> 
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div> 

                                <div class="row" >
                                    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                        <label for="dob">Date of Birthday</label>
                                    </div>
                                    <div class="   p-bottom">
                                        <div class="form-group"> 
                                            <label for="dob" class="hidden-lg hidden-md">Date of Birthday</label>
                                            <div class="register-form-row-col">
                                                <div class="col-md-3">
                                                    <div class="form-group" style="margin-top: -20px;">
                                                        <div class="form-line"> 
                                                            <div class="form-control"><?php
                                                                if ($GR3->dob_month == 1) {
                                                                    echo 'Jan';
                                                                } elseif ($GR3->dob_month == 2) {
                                                                    echo 'Feb';
                                                                } elseif ($GR3->dob_month == 3) {
                                                                    echo 'Mar';
                                                                } elseif ($GR3->dob_month == 4) {
                                                                    echo 'Apr';
                                                                } elseif ($GR3->dob_month == 5) {
                                                                    echo 'May';
                                                                } elseif ($GR3->dob_month == 6) {
                                                                    echo 'Jun';
                                                                } elseif ($GR3->dob_month == 7) {
                                                                    echo 'Jul';
                                                                } elseif ($GR3->dob_month == 8) {
                                                                    echo 'Aug';
                                                                } elseif ($GR3->dob_month == 9) {
                                                                    echo 'Sep';
                                                                } elseif ($GR3->dob_month == 10) {
                                                                    echo 'Oct';
                                                                } elseif ($GR3->dob_month == 11) {
                                                                    echo 'Nov';
                                                                } else {
                                                                    echo 'Dec';
                                                                }
                                                                ?></div>
                                                        </div>
                                                    </div> 
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group"style="margin-top: -20px;">
                                                        <div class="form-line"> 
                                                            <div class="form-control"><?php echo $GR3->dob_day; ?></div>
                                                        </div>
                                                    </div> 
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group" style="margin-top: -20px;">
                                                        <div class="form-line"> 
                                                            <div class="form-control"><?php echo $GR3->dob_year; ?></div>
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
                                                <div class="form-control" style="border-bottom: 1px solid #dddddd"><?php echo $GR3->address_line_1; ?></div>
                                                <div class="form-control" style="border-bottom: 1px solid #dddddd"><?php echo $GR3->address_line_2; ?></div>
                                                <div class="form-control" style="border-bottom: 1px solid #dddddd"><?php echo $GR3->address_line_3; ?></div>
                                                <div class="form-control" style="border-bottom: 1px solid #dddddd"><?php echo $GR3->address_line_4; ?></div>
                                                <div class="form-control" style="border-bottom: 1px solid #dddddd"><?php echo $GR3->address_line_5; ?></div>
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
                                                <?php if (empty($GR3->billing_proof_image)) {
                                                    ?>
                                                    <img class="img-responsive thumbnail image-width" src="../upload/sample.jpg">
                                                <?php } else { ?>
                                                    <a href="../upload/customer/billing-proof/<?php echo $GR3->billing_proof_image ?>" data-sub-html=" ">
                                                        <img class="img-responsive thumbnail image-width" src="../upload/customer/billing-proof/thumb/<?php echo $GR3->billing_proof_image ?>">
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
                                        <label for="city">City</label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="city" class="hidden-lg hidden-md">City</label>
                                                <div class="form-control">
                                                    <?php
                                                    $CITY = new City($GR3->city);
                                                    echo $CITY->name;
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                        <label for="gn_division">GN Division</label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="gn_division" class="hidden-lg hidden-md">GN Division</label>
                                                <div class="form-control">
                                                    <?php
                                                    $GNDIVISION = new GnDivision($GR3->gn_division);
                                                    echo $GNDIVISION->name;
                                                    ?>
                                                </div>
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
                                                <div class="form-control"><?php echo $GR3->email; ?></div>
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
                                                <div class="form-control"><?php echo $GR3->mobile; ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                        <label for="">Telephone Numbers</label>
                                    </div>

                                    <?php
                                    $telephone_numbers = "$GR3->telephone";
                                    $telephone_number = split(",", $telephone_numbers);
                                    ?>

                                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="" class="hidden-lg hidden-md">Telephone Numbers</label>
                                                <div class="form-control">
                                                    <?php echo $telephone_number[0] ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="" class="hidden-lg hidden-md">Telephone Numbers</label>
                                                <div class="form-control">
                                                    <?php
                                                    if ($telephone_number[1] == 0) {
                                                        
                                                    } else {
                                                        echo $telephone_number[1];
                                                    }
                                                    ?> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="" class="hidden-lg hidden-md">Telephone Numbers</label>
                                                <div class="form-control">
                                                    <?php
                                                    if ($telephone_number[2] == 0) {
                                                        
                                                    } else {
                                                        echo $telephone_number[2];
                                                    }
                                                    ?> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                                <?php
                                $ROUTE = new Route($GR3->route);
                                if ($ROUTE->id == $GR3->route) {
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
                                        <label for="credit_limit">Credit Limit</label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="credit_limit" class="hidden-lg hidden-md">Credit Limit</label>
                                                <div class="form-control"><?php echo $GR3->credit_limit; ?></div>
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
                                            <div  class="list-unstyled   clearfix aniimated-thumbnials">
                                                <label for="signature_photo" class="hidden-lg hidden-md">Signature Photo</label>
                                                <?php if (empty($GR3->signature_image)) {
                                                    ?>
                                                    <img class="img-responsive thumbnail image-width" src="../upload/sample.jpg">
                                                <?php } else { ?>

                                                    <a href="../upload/customer/signature/<?php echo $GR3->signature_image; ?>" data-sub-html="Signature Photo">
                                                        <img class="img-responsive thumbnail image-width" src="../upload/customer/signature/thumb/<?php echo $GR3->signature_image; ?>">
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
                                        <label for="business_name">Business Name</label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="business_name" class="hidden-lg hidden-md">Business Name</label>
                                                <div class="form-control"><?php echo $GR3->business_name; ?></div>
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
                                                <div class="form-control"><?php echo $GR3->br_number; ?></div>
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
                                                <div class="form-control"><?php echo $GR3->nature_of_business; ?></div>
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
                                                <?php if (empty($GR3->br_picture)) {
                                                    ?>
                                                    <img class="img-responsive thumbnail image-width" src="../upload/sample.jpg">

                                                <?php } else { ?>

                                                    <a href="../upload/customer/br/<?php echo $GR2->br_picture ?>" data-sub-html=" ">
                                                        <img class="img-responsive thumbnail image-width" src="../upload/customer/br/thumb/<?php echo $GR3->br_picture ?>">
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
                                                <div class="form-control">
                                                    <?php
                                                    $BANK = new Bank($GR3->bank);
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
                                                    $BRANCH = new Branch($GR3->branch);
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
                                                <div class="form-control"><?php echo $GR3->branch_code; ?></div>
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
                                                <div class="form-control"><?php echo $GR3->account_number; ?></div>
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
                                                <div class="form-control"><?php echo $GR3->holder_name; ?></div>
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
                                                <?php if (empty($GR3->bank_book_picture)) {
                                                    ?>
                                                    <img class="img-responsive thumbnail image-width" src="../upload/sample.jpg">

                                                <?php } else { ?>

                                                    <a href="../upload/customer/bbp/<?php echo $GR3->bank_book_picture; ?>" data-sub-html=" ">
                                                        <img class="img-responsive thumbnail image-width" src="../upload/customer/bbp/thumb/<?php echo $GR3->bank_book_picture; ?>">
                                                    </a>
                                                    <?php
                                                }
                                                ?>                                                      
                                            </div> 
                                        </div> 
                                    </div>
                                </div>  
                            </div>
                        </div>
                        <div id="menu5" class="tab-pane fade">
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
                                                    <lable><b><?php echo $loan_document['caption'] ?></b></lable>
                                                </div> 
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>    
                                <a href="add-loan-document.php?id=<?php echo $loan_id ?>"><button class="btn btn-info" value="Manage Document"> Manage Document</button> </a>                                   
                            </div>
                        </div>
                        <div id="menu6" class="tab-pane fade">
                            <div class="body"> 
                                <div class="row">
                                    <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                        <label for="created_by">Created By :</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class="form-line"> 
                                                <label  class="hidden-lg hidden-md">Created By :</label>
                                                <div class="form-control"><?php
                                                    $USER = new User($LOAN->create_by);
                                                    echo $USER->name;
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>                                    
                                </div>                                  
                                <div class="row">
                                    <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                        <label for="verified_by">Verified By :</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class="form-line"> 
                                                <label  class="hidden-lg hidden-md">Verified By :</label>
                                                <div class="form-control"><?php
                                                    $USER = new User($LOAN->verify_by);
                                                    echo $USER->name;
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>                                    
                                </div> 
                                <div class="row">
                                    <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                        <label for="approved_by">Approved By :</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class="form-line"> 
                                                <label  class="hidden-lg hidden-md">Approved By :</label>
                                                <div class="form-control"><?php
                                                    $USER = new User($LOAN->approved_by);
                                                    echo $USER->name;
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>                                    
                                </div> 
                                <?php if ($LOAN->issue_by == 0) { ?>
                                    <div class="row">
                                        <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                            <label for="release_by">Release By :</label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 p-bottom">
                                            <div class="form-group">
                                                <div class="form-line"> 
                                                    <label  class="hidden-lg hidden-md">Release By :</label>
                                                    <div class="form-control"><?php
                                                        $USER = new User($LOAN->release_by);
                                                        echo $USER->name;
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>                                    
                                    </div> 
                                <?php } else { ?>
                                    <div class="row">
                                        <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                            <label for="issued_by">Issued By :</label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 p-bottom">
                                            <div class="form-group">
                                                <div class="form-line"> 
                                                    <label  class="hidden-lg hidden-md">Issued By :</label>
                                                    <div class="form-control"><?php
                                                        $USER = new User($LOAN->issue_by);
                                                        echo $USER->name;
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>                                    
                                    </div> 
                                <?php } ?>
                            </div>
                        </div>
                        <div id="menu7" class="tab-pane fade">
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
                                <br>

                                <form class="" action="" method="post"  enctype="multipart/form-data" id="form-data">  

                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                            <label for="od_interest_limit">OD Interest Limit</label>
                                        </div>

                                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 p-bottom">
                                            <div class="form-group">
                                                <div class="form-line">                                            
                                                    <input type="text"  name="od_date_start"  id="od_date_start" placeholder="Enter OD Start Date" class="form-control od_date_start" autocomplete="off"  >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 p-bottom">
                                            <div class="form-group">
                                                <div class="form-line"> 
                                                    <input type="text" name="od_date_end" id="od_date_end" placeholder="Enter OD End Date" class="form-control" autocomplete="off" >
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 p-bottom">
                                            <div class="form-group">
                                                <div class="form-line"> 
                                                    <input type="number" name="od_interest_limit" id="od_interest_limit" placeholder="Enter OD Interest Limit" class="form-control" autocomplete="off" min="0" >
                                                </div>
                                            </div>
                                        </div> 
                                    </div> 

                                    <div class="row clearfix">
                                        <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                            <div class="form-group">
                                                <input class="btn btn-primary m-t-15 waves-effect  pull-left" type="submit"  id="create-od" value="Save Details ">
                                            </div> 
                                            <input type="hidden" name="id" id="id" value="<?php echo $loan_id ?>">
                                        </div> 
                                    </div> 
                                </form>  
                            </div>
                            <div class="body"> 
                                <div> 
                                    <h2 class="text-center">  Manage Od Dates </h2>

                                </div> 
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Od Start Date</th>  
                                                <th>Od End Date</th>                                                 
                                                <th>Od Limit</th> 
                                                <th>Options</th> 
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $OD = new Od(NULL);
                                            foreach ($OD->getOdByLoanId($loan_id) as $key => $od) {
                                                $key++;
                                                ?>
                                                <tr id="row_<?php echo $od['id']; ?>">
                                                    <td>#<?php echo $key ?></td> 
                                                    <td><?php echo $od['od_date_start']; ?></td> 
                                                    <td>
                                                        <?php
                                                        $END = new DateTime($od['od_date_start']);
                                                        $END->modify('+2 years');
                                                        $end = $END->format('Y-m-d');
                                                        if ($end == $od['od_date_end']) {
                                                            echo 'Unlimited';
                                                        } else {
                                                            echo $od['od_date_end'];
                                                        }
                                                        ?>
                                                    </td> 
                                                    <td><?php echo number_format($od['od_interest_limit'], 2); ?></td> 
                                                    <?php if ($today > $od['od_date_end']) { ?>
                                                        <td>
                                                            <a href="edit-od.php?id=<?php echo $od['id']; ?>&loan=<?php echo $loan_id ?>"> <button class="glyphicon glyphicon-pencil edit-btn " title="Edit" disabled=""></button></a> | 
                                                            <a href="#"  class="delete-od" data-id="<?php echo $od['id']; ?>"> <button class="glyphicon glyphicon-trash delete-btn" title="Delete" disabled="" ></button></a>

                                                        </td> 
                                                    <?php } else { ?>
                                                        <td>
                                                            <a href="edit-od.php?id=<?php echo $od['id']; ?>&loan=<?php echo $loan_id ?>"> <button class="glyphicon glyphicon-pencil edit-btn" title="Edit" ></button></a> | 
                                                            <a href="#"  class="delete-od" data-id="<?php echo $od['id']; ?>"> <button class="glyphicon glyphicon-trash delete-btn" title="Delete"></button></a>

                                                        </td> 
                                                    <?php } ?>
                                                </tr>
                                                <?php
                                            }
                                            ?>   
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                            <tr>
                                                <th>ID</th>
                                                <th>Od Start Date</th>  
                                                <th>Od End Date</th>                                                 
                                                <th>Od Limit</th> 
                                                <th>Options</th> 
                                            </tr>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>


                    <input type="hidden"   id="issue_mode_onloard" name="issue_mode" value="<?php echo $LOAN->issue_mode; ?>" >
                    <?php $paid_amount = $INSTALLMENT->getAmountByLoanId($loan_id); ?>
                    <input type="hidden" id="paids_amount"  name="paid_amount" value="<?php echo$paid_amount[0] ?>" class="form-control  " autocomplete="off">
                    <input type="hidden" id="customer_id" value="<?php echo $CUSTOMER->id; ?>"/>
                    <input type="hidden" name="id" value="<?php echo $id ?>">
                    <input type="hidden"   id="loan_amount"  value="<?php echo $LOAN->loan_amount; ?>" />
                    <input type="hidden"   id="loan_id"  value="<?php echo $LOAN->id; ?>" />
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
<script src="js/ajax/loan.js" type="text/javascript"></script>

<script src="js/image.js" type="text/javascript"></script>
<script src="plugins/light-gallery/js/lightgallery-all.js"></script>
<script src="js/ajax/od-limite.js" type="text/javascript"></script>
<script src="delete/js/od.js" type="text/javascript"></script>
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