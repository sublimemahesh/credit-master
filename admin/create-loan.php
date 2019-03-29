<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/auth.php');

//check user level
$USERS = new User($_SESSION['id']);
$DEFAULTDATA = new DefaultData(NULL);
$DEFAULTDATA->checkUserLevelAccess('1,2,3', $USERS->user_level);
?> 
<!DOCTYPE html>
<html> 
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

        <title>Create New Loan  || Credit Master</title>
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
        <link href="plugins/light-gallery/css/lightgallery.css" rel="stylesheet">
        <link href="plugins/jquery-spinner/css/bootstrap-spinner.css" rel="stylesheet">
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
                        <h2>Create New Loan</h2>
                        <ul class="header-dropdown">
                            <li class="">
                                <a href="manage-pending-loans.php">
                                    <i class="material-icons">list</i> 
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        <form class="" action="post-and-get/loan.php" method="post"  enctype="multipart/form-data">  
                            <?php if ($USERS->user_level == 1) {
                                ?>
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                        <label for="create_date">Date</label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="create_date" class="hidden-lg hidden-md">Create Date</label>
                                                <input type="text" id="create_date"  name="create_date" value="<?php echo date("Y-m-d"); ?>" placeholder="Please Select Date" class="form-control create_date" autocomplete="off" required="TRUE"  >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            } else {
                                ?>
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                        <label for="create_date">Date</label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="create_date" class="hidden-lg hidden-md">Create Date</label>
                                                <input type="text" id="create_date"  name="create_date" value="<?php echo date("Y-m-d"); ?>" placeholder="Please Select Date" class="form-control" autocomplete="off" required="TRUE" readonly="readonly">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="row">
                                <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                    <label for="registration_type">Registration Type</label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="registration_type" class="hidden-lg hidden-md">Registration Type</label>
                                            <select class="form-control" autocomplete="off" id="registration_type"  name="registration_type" required="TRUE">
                                                <option value=""> -- Please Select Registration Type -- </option>
                                                <option value="center"> Center </option>
                                                <option value="route"> Route </option>
                                            </select> 
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="row" style="display: none" id="route_row">
                                <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                    <label for="route">Route</label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="route" class="hidden-lg hidden-md">Route</label>
                                            <select class="form-control customer-ref" autocomplete="off" id="route"  name="route">  
                                                <option> -- Please Select a Route -- </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row" style="display: none" id="center_row">
                                <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                    <label for="center">Center</label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="center" class="hidden-lg hidden-md">Center</label>
                                            <select class="form-control customer-ref" autocomplete="off" id="center"  name="center">  
                                                <option> -- Please Select a Center -- </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                    <label for="customer">Customer</label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="customer" class="hidden-lg hidden-md">Customer</label>
                                            <select class="form-control all-customers" autocomplete="off" id="customer" name="customer" required="TRUE">
                                                <option value=""> -- Please Select Registration Type First-- </option> 
                                            </select> 
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                    <label for="guarantor_1">Guarantor 01</label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="guarantor_1" class="hidden-lg hidden-md">Guarantor 01</label>
                                            <select class="form-control all-customers" autocomplete="off" id="guarantor_1"  name="guarantor_1" >
                                                <option  value=""> -- Please Select Registration Type First-- </option> 
                                            </select>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                    <label for="guarantor_2">Guarantor 02</label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="guarantor_2" class="hidden-lg hidden-md">Guarantor 02</label>
                                            <select class="form-control all-customers" autocomplete="off" id="guarantor_2"  name="guarantor_2" >
                                                <option id="emptygr2" value=""> -- Please Select Registration Type First-- </option> 
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                    <label for="guarantor_3">Guarantor 03</label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="guarantor_3" class="hidden-lg hidden-md">Guarantor 03</label>
                                            <select class="form-control all-customers" autocomplete="off" id="guarantor_3"  name="guarantor_3"  >
                                                <option id="emptygr3" value=""> -- Please Select Registration Type First-- </option> 
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                    <label for="installment_type">Installment Type</label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="installment_type" class="hidden-lg hidden-md">Installment Type</label>
                                            <select id="installment_type" name="installment_type" class="form-control installment_type" required="TRUE" id="installment_type">
                                                <option value=""> -- Please Select Installment Type -- </option>
                                                <?php
                                                $INSTALLMENT_TYPES = $DEFAULTDATA->getInstallmentType();
                                                foreach ($INSTALLMENT_TYPES as $key => $instrallment_type) {
                                                    ?>
                                                    <option value="<?php echo $key ?>"><?php echo $instrallment_type ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select> 
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                    <label for="loan_period">Loan Period</label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="loan_period" class="hidden-lg hidden-md">Loan Period</label>
                                            <select id="loan_period" name="loan_period" class="form-control loan_period" required="TRUE" >
                                                <option value=""> -- Please Select Loan Period -- </option>
                                                <?php
                                                $LOAN_PERIODS = $DEFAULTDATA->getLoanPeriod();
                                                foreach ($LOAN_PERIODS as $key => $loan_period) {
                                                    ?>
                                                    <option  id="<?php echo 'period_' . $key ?>" value="<?php echo $key ?>" ><?php echo ' (' . $key . ' Days) - ' . $loan_period; ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select> 
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                    <label for="loan_amount">Loan Amount</label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="loan_amount" class="hidden-lg hidden-md">Loan Amount</label>
                                            <input type="number" id="loan_amount"  name="loan_amount" max="" placeholder="Enter The Loan Amount" class="form-control loan_amount" autocomplete="off" required="TRUE" min="0"  >
                                        </div>
                                    </div>
                                </div>
                            </div> 

                            <div class="row">
                                <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                    <label for="interest_rate">Interest Rate (%)</label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="interest_rate" class="hidden-lg hidden-md">Interest Rate</label>
                                            <input type="number" id="interest_rate"  name="interest_rate" placeholder="Enter The Interest Rate" value="<?php echo $DEFAULTDATA->getDefaultInterestRate(); ?>"class="form-control interest_rate"  required="TRUE" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            

                            <div class="row">
                                <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                    <label for="period_price">Net Amount</label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label class="hidden-lg hidden-md" for="period_price">Net Amount</label>
                                            <input type="text" class="form-control" autocomplete="off" id="total" placeholder="00.00"  required="TRUE" readonly="readonly" > 
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                    <label for="installment_price">Installment Amount</label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="installment_amount" class="hidden-lg hidden-md">Installment Amount</label>
                                            <input type="text" class="form-control" name="installment_amount" autocomplete="nope" id="installment_price"  placeholder="Installment Amount" required="TRUE" readonly="readonly" >
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                    <label for="number_of_installments">Nu. of Installments</label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="number_of_installments" class="hidden-lg hidden-md">Nu. of Installments</label>

                                            <input type="text" class="form-control" name="number_of_installments" autocomplete="nope" id="number_of_installments"  placeholder="Number of Installments" required="TRUE"  readonly="readonly" >
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
                                            <label for="effective_date" class="hidden-lg hidden-md">Effective Date</label>
                                            <input type="text" id="effective_date"  name="effective_date" value="<?php echo date("Y-m-d"); ?>" placeholder="Please Select The Effective Date" class="form-control datepicker" autocomplete="off">
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
                                            <label for="issue_mode" class="hidden-lg hidden-md">Issue Mode</label>
                                            <select id="issue_mode" name="issue_mode" class="form-control" required="">
                                                <option value=""> -- Please Select Issue Mode -- </option>
                                                <?php
                                                $issueModes = DefaultData::getLoanIssueMode();
                                                foreach ($issueModes as $key => $issueMode) {
                                                    ?>
                                                    <option value="<?php echo $key ?>"><?php echo $issueMode ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div  class="row" style="display: none" id="loan_processing_pre">
                                <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                    <label for="issue_mode">Loan Processing Fee</label>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 p-bottom">
                                    <div class="form-group">
                                        <div class="form-line"> 
                                            <input type="text" id="loan_processing_pre_amount"    name="loan_processing_fee" value="" placeholder="loan Processing Pre" class="form-control  " autocomplete="off" readonly="">
                                        </div>
                                    </div>
                                </div>

                                <div style="display: none" id="document_free">                                
                                    <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class="form-line">                                                
                                                <input type="text" id="document_free_amount"   name="document_free_amount"   placeholder="Document Fee" class="form-control  " autocomplete="off" disabled="">
                                            </div>
                                        </div>
                                    </div>

                                    <div  style="display: none" id="cheque_free">
                                        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 p-bottom">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" id="cheque_free_amount"   name="cheque_free_amount"  placeholder="loan Cheque Fee" class="form-control  " autocomplete="off" disabled="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div   style="display: none" id="stamp_fee_amount">                                   
                                        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 p-bottom">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" id="stamp_fee"  name="stamp_fee"   placeholder="Stamp Fee" class="form-control  " autocomplete="off" disabled="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div   style="display: none" id="bank_transaction_free_amount">                                   
                                        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 p-bottom">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" id="bank_transaction_free"  name="bank_transaction_free"   placeholder="bank_transaction_free" class="form-control  " autocomplete="off" disabled="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                            <div class="row" >
                                <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                    <label for="">Balance Of the last Loan</label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="" class="hidden-lg hidden-md">Balance Of the last Loan</label>
                                            <div class="form-control"  > 
                                                <input type="text" id="balance_of_last_loan"  name="balance_of_last_loan" placeholder="00.00" class="form-control  " autocomplete="off" disabled="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row" id="total_deductions_row">
                                <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                    <label for="total_deductions">Total Deductions </label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="total_deductions" class="hidden-lg hidden-md">Total Deductions </label>
                                            <div class="form-control">
                                                <input type="text" id="total_deductions" placeholder="00.00" class="form-control  " autocomplete="off" disabled="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                    <label for="balance_pay">Balance Pay </label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="balance_pay" class="hidden-lg hidden-md">Balance Pay </label>
                                            <div class="form-control">
                                                <input type="text" id="balance_pay"  placeholder="00.00" class="form-control font-weight-new " autocomplete="off" disabled="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="row clearfix">
                                <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                    <div class="form-group">
                                        <button class="btn btn-primary m-t-15 waves-effect  pull-left" type="submit" name="create-new-loan" id="create">Save Details</button>
                                        <input type="hidden" value="<?php echo $_SESSION['id']; ?>" name="create_by">
                                        <input type="hidden" value="<?php echo $_SESSION['id']; ?>" name="collector">
                                        <input type="hidden" value="<?php echo $USERS->id; ?>" id="collector_id">
                                        <input type="hidden" class="form-control all-customers" id="guarantor_1_id" name="guarantor_1_id" required="TRUE">
                                    </div> 
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
        <script src="js/admin.js"></script>
        <script src="js/demo.js"></script> 
        <script src="plugins/jquery-ui/jquery-ui.js"></script>
        <script src="plugins/sweetalert/sweetalert.min.js"></script>   
        <script src="js/ajax/loan.js" type="text/javascript"></script>

        <script>
            $(function () {
                $(".datepicker").datepicker({
                    dateFormat: 'yy-mm-dd',
//                    minDate: '-3D',
//                    maxDate: '+3D',

                });

                $(".create_date").datepicker({
                    dateFormat: 'yy-mm-dd',

                });
               
            });

        </script>
    </body>

</html>