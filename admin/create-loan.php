<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . './auth.php');
?>

<!DOCTYPE html>
<html> 
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

        <title>Create Loan  || Credit Master</title>
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
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
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
                        <h2>Create Loan  </h2>
                        <ul class="header-dropdown">
                            <li class="">
                                <a href="manage-customers.php">
                                    <i class="material-icons">list</i> 
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        <form class="" action="post-and-get/loan.php" method="post"  enctype="multipart/form-data"> 

                            <div class="row">
                                <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                    <label for="create_date">Create Date</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 p-bottom">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="create_date" class="hidden-lg hidden-md">Create Date</label>
                                            <input type="text" id="create_date"  name="create_date" placeholder="Enter Create Date" class="form-control datepicker" autocomplete="off">
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
                                            <select class="form-control" autocomplete="off" id="customer"  name="customer">
                                                <option selected=""> -- Customer -- </option>
                                                <?php
                                                $CUSTOMER = Customer::all();
                                                foreach ($CUSTOMER as $customer) {
                                                    ?>
                                                    <option select="true" value="<?php echo $customer['id'] ?>"> <?php echo $customer['surname'] . ' ' . $customer['first_name'] . ' ' . $customer['last_name'] ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>

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
                                            <select class="form-control" autocomplete="off" id="guarantor"  name="guarantor_1">
                                                <option selected=""> -- Guarantor 01 -- </option>
                                                <?php
                                                $CUSTOMER = Customer::all();
                                                foreach ($CUSTOMER as $customer) {
                                                    ?>
                                                    <option select="true" value="<?php echo $customer['id'] ?>"> <?php echo $customer['surname'] . ' ' . $customer['first_name'] . ' ' . $customer['last_name'] ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>

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
                                            <select class="form-control" autocomplete="off" id="guarantor-02"  name="guarantor_2">
                                                <option selected=""> -- Guarantor 02 -- </option>
                                                <?php
                                                $CUSTOMER = Customer::all();
                                                foreach ($CUSTOMER as $customer) {
                                                    ?>
                                                    <option select="true" value="<?php echo $customer['id'] ?>"> <?php echo $customer['surname'] . ' ' . $customer['first_name'] . ' ' . $customer['last_name'] ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                    <label for="loan_amount">Loan Amount</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 p-bottom">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="loan_amount" class="hidden-lg hidden-md">Loan Amount</label>
                                            <input type="text" id="loan_amount"  name="loan_amount" placeholder="Enter Loan Amount" class="form-control" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                            </div> 

                            <div class="row">
                                <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                    <label for="loan_period">Loan Period</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 p-bottom">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="loan_period" class="hidden-lg hidden-md">Loan Period</label>
                                            <select id="loan_period" name="loan_period" class="form-control" >
                                                <option value=""> -- Please Select Loan Period -- </option>
                                                <?php
                                                $LOAN_PERIODS = DefultData::getloanperiod();
                                                foreach ($LOAN_PERIODS as $key => $loan_period) {
                                                    ?>
                                                    <option value="<?php echo $key ?>"><?php echo $loan_period ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select> 
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
                                            <input type="text" id="interest_rate"  name="interest_rate" placeholder="Enter Interest Rate" class="form-control" autocomplete="off">
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
                                            <select id="installment_type" name="installment_type" class="form-control" >
                                                <option value=""> -- Please Select Installment Type -- </option>
                                                <?php
                                                $INSTALLMENT_TYPES = DefultData::getinstallmenttype();
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

                            <div class="row clearfix">
                                <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 p-bottom">
                                    <div class="form-group">
                                        <button class="btn btn-primary m-t-15 waves-effect  pull-left" type="submit" name="add-loan">Save Details</button>
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
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script>
            $(function () {
                $(".datepicker").datepicker();
            });
        </script>
    </body>

</html>