<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/auth.php');

//check user level
$USERS = new User($_SESSION['id']);
$DEFAULTDATA = new DefaultData(NULL);
$DEFAULTDATA->checkUserLevelAccess('1,2,3', $USERS->user_level);


$id = '';
$id = $_GET['id'];
$LOAN = new Loan($id);
$balance_pay = $_GET['balance_pay'];
$issued_date = $_GET['issued_date'];
$issue_mode = $_GET['issue_mode'];
$effective_date = $_GET['effective_date'];
$balance_of_last_loan = $_GET['balance_of_last_loan'];



$CUSTOMER = new Customer($LOAN->customer);
?>

<!DOCTYPE html>
<html> 
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

        <title>Transfer Loan || Credit Master</title>
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
        <link href="plugins/light-gallery/css/lightgallery.css" rel="stylesheet">
        <link rel="stylesheet" href="plugins/jquery-ui/jquery-ui.css">
        <link href="plugins/light-gallery/css/lightgallery.css" rel="stylesheet">
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
                        <h2>Release Loan :  <?php
                            if ($LOAN->installment_type == 30) {
                                echo 'BLD' . $id;
                            } elseif ($LOAN->installment_type == 4) {
                                echo 'BLW' . $id;
                            } else {
                                echo 'BLM' . $id;
                            }
                            ?></h2>
                        <ul class="header-dropdown">
                            <li class="">
                                <a href=" ">
                                    <i class="material-icons">list</i> 
                                </a>
                            </li>
                        </ul>
                    </div> 


                    <form id="form-data" method="post" enctype="multipart/form-data">
                        <div class="body"> 
                            <div class="row">
                                <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                    <label for="balance_pay" style="font-size: 20px;"><b>Balance Pay</b> </label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 p-bottom">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="balance_pay" class="hidden-lg hidden-md" style="font-size: 20px;"><b>Balance Pay</b> </label>
                                            <div class="form-control" style="font-size: 23px;">
                                                <div style="font-size: 22px;font-weight: 800;"><?php echo number_format($balance_pay, 2); ?></div>                                                 
                                                <input type="hidden" name="balance_pay" id="balance_pay" value="<?php echo $balance_pay; ?>" readonly="" class="form-control" style="font-size: 22px;font-weight: 800;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                    <label for="transaction_id" > Transaction id </label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 p-bottom">                                         
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="transaction_id" class="hidden-lg hidden-md">Transaction id </label>
                                            <input type="text" id="transaction_id"  name="transaction_id"  placeholder="Enter The Transaction id " class="form-control   " autocomplete="off" required="TRUE" min="0"  >
                                        </div>                                            
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                    <label for="transaction_document" > Transaction document  </label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 p-bottom">                                         
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="transaction_document" class="hidden-lg hidden-md">Transaction document  </label>
                                            <input type="file" id="transaction_document"  name="transaction_document"  placeholder="Enter The Transaction id " class="form-control   " autocomplete="off" required="TRUE" min="0"  >
                                        </div>                                            
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="body" style="margin: -10px 0px 0px 0px; padding: 0px 0px 50px 23px;">
                            <div class="row">
                                <div class="row">
                                    <div class="col-lg-2 col-md-2 hidden-sm hidden-xs"> 
                                        <input type="hidden" name="loan_id" id="loan_id" value="<?php echo $id ?>">                                      
                                        <input type="hidden"  id="create_by" name="create_by" value="<?php echo $LOAN->create_by ?>">                                      
                                        <input type="hidden" id="balance_pay" ame="balance_pay" value="<?php echo $balance_pay ?>"/>  
                                        <input type="hidden" id="issued_date" name="issued_date" value="<?php echo $issued_date; ?>"/>
                                        <input type="hidden" id="effective_date" name="effective_date" value="<?php echo $effective_date; ?>"/>
                                        <input type="hidden" id="issue_mode" name="issue_mode" value="<?php echo $issue_mode; ?>"/>
                                        <input type="hidden" id="loan_processing_pre_amount" name="loan_processing_pre_amount" value="<?php echo $LOAN->loan_processing_pre; ?>"/>
                                        <input type="hidden" id="issue_note" name="issue_note" value="<?php echo $LOAN->issue_note; ?>"/>                                    
                                        <input type="hidden" id="balance_of_last_loan" name="balance_of_last_loan" value="<?php echo $balance_of_last_loan ?>"/>                                    
                                        <input type="hidden" value="<?php echo $_SESSION['id']; ?>" name="release_by" id="release_by">
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
                                        <input type="submit"  class="btn btn-info pull-left"   id="release" value="Release Loan"/> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
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

<script src="plugins/light-gallery/js/lightgallery-all.js"></script>
<script>
    $(function () {
        $(".datepicker").datepicker({dateFormat: 'yy-mm-dd'});
    });
</script>
<script>
    $(function () {
        $(".datepicker-effective").datepicker({
            dateFormat: 'yy-mm-dd',
            minDate: '-3D',
            maxDate: '+3D',

        });
    });
</script>
</body> 
</html>