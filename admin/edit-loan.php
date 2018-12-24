<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/auth.php');

//check user level
$USERS = new User($_SESSION['id']);
$DEFAULTDATA = new DefaultData(NULL);
$DEFAULTDATA->checkUserLevelAccess('1,2,3', $USERS->user_level);


$LOAN = new Loan($_GET['id']);
$CUSTOMER = new Customer($LOAN->customer);
$GR1 = new Customer($LOAN->guarantor_1);
$GR2 = new Customer($LOAN->guarantor_2);
$GR3 = new Customer($LOAN->guarantor_3);
$ROUTE = Route::all();
$CENTER = Center::all();
?>
<!DOCTYPE html>
<html> 
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

        <title>Edit  Loan  || Credit Master</title>
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
        <link rel="stylesheet" href="plugins/jquery-ui/jquery-ui.css">
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
                        <h2>Edit Loan: <?php
                            if ($LOAN->installment_type == 30) {
                                echo 'BLD' . $LOAN->id;
                            } elseif ($LOAN->installment_type == 4) {
                                echo 'BLW' . $LOAN->id;
                            } else {
                                echo 'BLM' . $LOAN->id;
                            }
                            ?></h2>
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

                            <div class="row">
                                <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                    <label for="create_date">Date</label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="create_date" class="hidden-lg hidden-md">Create Date</label>
                                            <input type="text" id="create_date"  name="create_date" value="<?php echo $LOAN->create_date ?>" placeholder="Please Select Date" class="form-control" autocomplete="off"   readonly="readonly" disabled=""> 
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
                                            <select class="form-control" autocomplete="off" id="registration_type"  name="registration_type" disabled="" >
                                                <option value=""> -- Please Select Registration Type -- </option>

                                                <?php
                                                if ($CUSTOMER->registration_type == "route") {
                                                    ?>
                                                    <option value="route" selected="">Route</option>
                                                    <option value="center"  >Center</option>
                                                    <option value="1">Center Leader</option>


                                                <?php } elseif ($CUSTOMER->registration_type == "center") {
                                                    ?>
                                                    <option value="center"  selected="">Center</option>
                                                    <option value="route" >Route</option>
                                                    <option value="1">Center Leader</option>

                                                <?php } elseif ($CUSTOMER->registration_type == 1) {
                                                    ?>
                                                    <option value="1" selected="">Center Leader</option>
                                                    <option value="center"  >Center</option>
                                                    <option value="route" >Route</option>


                                                <?php } else { ?>
                                                    <option value="route" >Route</option>
                                                    <option value="center"  >Center</option>
                                                    <option value="1">Center Leader</option>

                                                <?php }
                                                ?>
                                            </select> 
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <?php
                            if ($CUSTOMER->route) {
                                ?>
                                <div class="row" id="route_row">
                                    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                        <label for="route">Route</label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="route" class="hidden-lg hidden-md">Route</label>
                                                <select class="form-control" autocomplete="off" id="route"  name="route" disabled="">  
                                                    <?php
                                                    foreach ($ROUTE as $route) {
                                                        if ($route['id'] == $CUSTOMER->route) {
                                                            ?>
                                                            <option value="<?php echo $route['id'] ?>" selected=""> <?php echo $route['name'] ?></option>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <option value="<?php echo $route['id'] ?>" > <?php echo $route['name'] ?></option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            } elseif ($CUSTOMER->center) {
                                ?>

                                <div class="row" id="center_row">
                                    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                        <label for="center">Center</label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="center" class="hidden-lg hidden-md">Center</label>
                                                <select class="form-control" autocomplete="off" id="center"  name="center" disabled="">  
                                                    <?php
                                                    foreach ($CENTER as $center) {
                                                        if ($center['id'] == $CUSTOMER->center) {
                                                            ?>
                                                            <option value="<?php echo $center['id'] ?>" selected=""> <?php echo $center['name'] ?></option>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <option value="<?php echo $center['id'] ?>"> <?php echo $center['name'] ?></option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>  


                            <div class="row">
                                <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                    <label for="customer">Customer</label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="customer" class="hidden-lg hidden-md">Customer</label>
                                            <select class="form-control all-customers" autocomplete="off" id="customer" name="customer"   disabled="">
                                                <option value="<?php echo $LOAN->customer ?>" selected="">
                                                    <?php
                                                    $first_name = $DEFAULTDATA->getFirstLetterName(ucwords($CUSTOMER->surname));
                                                    echo $first_name . ' ' . $CUSTOMER->first_name . ' ' . $CUSTOMER->last_name;
                                                    ?>   
                                                </option> 
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
                                            <input type="hidden" class="form-control all-customers" id="guarantor_1_id"  name="guarantor_1"   >
                                            <select class="form-control all-customers" disabled="" autocomplete="off" id="guarantor_1"  name="test"    >
                                                <option  value="" selected="" id="emptygr1" > <?php
                                                    $first_name = $DEFAULTDATA->getFirstLetterName(ucwords($GR1->surname));
                                                    echo $first_name . ' ' . $GR1->first_name . ' ' . $GR1->last_name;
                                                    ?></option>  
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
                                            <select class="form-control all-customers" autocomplete="off" id="guarantor_2"  name="guarantor_2"  >
                                                <?php
                                                $guarantors = $CUSTOMER->getCustomrByCenter($CUSTOMER->center);

                                                foreach ($guarantors as $guarantor) {

                                                    $norAllowed = array($LOAN->customer, $LOAN->guarantor_1, $LOAN->guarantor_3);

                                                    if (!in_array($guarantor['id'], $norAllowed)) {
                                                        if ($LOAN->guarantor_2 === $guarantor['id']) {
                                                            ?>
                                                            <option id="<?php echo $guarantor['id']; ?>" selected="TRUE"><?php
                                                                $first_name = $DEFAULTDATA->getFirstLetterName(ucwords($guarantor['surname']));
                                                                echo $first_name . ' ' . $guarantor['first_name'] . ' ' . $guarantor['last_name'];
                                                                ?></option>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <option id="<?php echo $guarantor['id']; ?>"><?php
                                                                $first_name = $DEFAULTDATA->getFirstLetterName(ucwords($guarantor['surname']));
                                                                echo $first_name . ' ' . $guarantor['first_name'] . ' ' . $guarantor['last_name'];
                                                                ?></option>
                                                            <?php
                                                        }
                                                    }
                                                }
                                                ?>
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
                                                <?php
                                                $guarantors = $CUSTOMER->getCustomrByCenter($CUSTOMER->center);
                                                foreach ($guarantors as $guarantor) {

                                                    $norAllowed = array($LOAN->customer, $LOAN->guarantor_1, $LOAN->guarantor_2);

                                                    if (!in_array($guarantor['id'], $norAllowed)) {
                                                        if ($LOAN->guarantor_3 === $guarantor['id']) {
                                                            ?>
                                                            <option id="<?php echo $guarantor['id']; ?>" selected="TRUE"><?php
                                                                $first_name = $DEFAULTDATA->getFirstLetterName(ucwords($guarantor['surname']));
                                                                echo $first_name . ' ' . $guarantor['first_name'] . ' ' . $guarantor['last_name'];
                                                                ?></option>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <option id="<?php echo $guarantor['id']; ?>"><?php
                                                                $first_name = $DEFAULTDATA->getFirstLetterName(ucwords($guarantor['surname']));
                                                                echo $first_name . ' ' . $guarantor['first_name'] . ' ' . $guarantor['last_name'];
                                                                ?></option>
                                                            <?php
                                                        }
                                                    }
                                                }
                                                ?>
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
                                                $LOAN_TYPE = $DEFAULTDATA->getInstallmentType();
                                                foreach ($LOAN_TYPE as $key => $loan_type) {
                                                    if ($key == $LOAN->installment_type) {
                                                        ?>
                                                        <option value="<?php echo $key ?>" selected="true"><?php echo $loan_type ?></option>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <option value="<?php echo $key ?>"><?php echo $loan_type ?></option> 
                                                        <?php
                                                    }
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

                                                    if ($key == $LOAN->loan_period) {
                                                        ?>

                                                        <option  id="<?php echo 'period_' . $key ?>" value="<?php echo $key ?>" selected=""><?php echo ' (' . $key . ' Days) - ' . $loan_period; ?></option>

                                                        <?php
                                                    } else {
                                                        ?>
                                                        <option  id="<?php echo 'period_' . $key ?>" value="<?php echo $key ?>" ><?php echo ' (' . $key . ' Days) - ' . $loan_period; ?></option>
                                                        <?php
                                                    }
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
                                            <input type="number" id="loan_amount"  name="loan_amount" max="" placeholder="Enter The Loan Amount" class="form-control loan_amount" autocomplete="off" required="TRUE" min="0"  value="<?php echo $LOAN->loan_amount ?>">
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
                                            <input type="number" name="interest_rate"    id="interest_rate" placeholder="Enter The Interest Rate"  class="form-control interest_rate "  required="TRUE" autocomplete="off" value="<?php echo $LOAN->interest_rate ?>">
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
                                            <input type="text" class="form-control " autocomplete="off"  id="total" placeholder="00.00"  required="TRUE" readonly="readonly" > 
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
                                            <input type="text" class="form-control" name="installment_amount" autocomplete="nope" id="installment_amount"  placeholder="Installment Amount" required="TRUE" readonly="readonly" value="<?php echo $LOAN->installment_amount ?>">
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

                                            <input type="text" class="form-control" name="number_of_installments" autocomplete="nope" id="number_of_installments"  placeholder="Number of Installments" required="TRUE"  readonly="readonly" value="<?php echo $LOAN->number_of_installments ?>">
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
                                            <input type="text" id="effective_date"  name="effective_date" value="<?php echo  $LOAN->effective_date ?>" placeholder="Please Select The Effective Date" class="form-control datepicker" autocomplete="off">
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

                                            <select id="issue_mode_onloard"    name="issue_mode" class="form-control issue_mode">
                                                <option value=""> -- Please Select Issue Mode -- </option>
                                                <?php
                                                $issueModes = DefaultData::getLoanIssueMode();
                                                foreach ($issueModes as $key => $issueMode) {

                                                    if ($key == $LOAN->issue_mode) {
                                                        ?>
                                                        <option value="<?php echo $key ?>" selected=""><?php echo $issueMode ?></option>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <option value="<?php echo $key ?>"><?php echo $issueMode ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
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
                            <div class="row clearfix">
                                <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                    <div class="form-group">
                                        <button class="btn btn-primary m-t-15 waves-effect  pull-left" type="submit" name="update-loan">Save Details</button>
                                        <input type="hidden" value="<?php echo $LOAN->id ?>" name="id">
                                        <input type="hidden" value="<?php echo $_SESSION['id']; ?>" name="create_by">
                                        <input type="hidden" value="<?php echo $_SESSION['id']; ?>" name="collector">
                                         
                                        <input type="hidden" id="guarantor_3_name" name="" value=" <?php
                                        $first_name = $DEFAULTDATA->getFirstLetterName(ucwords($GR2->surname));
                                        echo $first_name . ' ' . $GR2->first_name . ' ' . $GR2->last_name;
                                        ?>">
                                        <input type="hidden" id="guarantor_2_name" value=" <?php
                                               $first_name = $DEFAULTDATA->getFirstLetterName(ucwords($GR3->surname));
                                               echo $first_name . ' ' . $GR3->first_name . ' ' . $GR3->last_name;
                                               ?>">
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
        <script src="plugins/jquery-ui/jquery-ui.js"></script>
        <script src="plugins/sweetalert/sweetalert.min.js"></script>
        <script src="js/admin.js"></script>
        <script src="js/demo.js"></script>  
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