<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/auth.php');

//check user level
$USERS = new User($_SESSION['id']);
$DEFAULTDATA = new DefaultData(NULL);
$DEFAULTDATA->checkUserLevelAccess('1,2,3', $USERS->user_level);


$id = '';
$id = $_GET['id'];

$INSTALLMENT = new Installment($id);
?>

<!DOCTYPE html>
<html> 
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

        <title>Edit Installment || Credit Master</title>
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
                        <h2>Edit Installment</h2>
                        
                    </div>
                    <div class="body">
                        <form class="" action="post-and-get/installment.php" method="post"  enctype="multipart/form-data"> 

                            <div class="row">
                                <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                    <label for="paid_date">Paid Date</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 p-bottom">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="paid_date" class="hidden-lg hidden-md">Paid Date</label>
                                            <input type="text" id="Paid_date"  name="paid_date" value="<?php echo $INSTALLMENT->paid_date ?>"  class="form-control datepicker" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                            </div> 

                            <div class="row">
                                <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                    <label for="paid_amount">Paid Amount</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 p-bottom">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="paid_amount" class="hidden-lg hidden-md">Paid Amount</label>
                                            <input type="text" id="address"  name="paid_amount" value="<?php echo $INSTALLMENT->paid_amount ?>"  class="form-control" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                            </div> 

                            <div class="row">
                                <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                    <label for="additional_interest">Additional Iinterest</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 p-bottom">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="additional_interest" class="hidden-lg hidden-md">Center Leader Name</label>
                                            <input type="text" id="additional_interest"  name="additional_interest" value="<?php echo $INSTALLMENT->additional_interest ?>"  class="form-control" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                    <label for="paid_by">Paid By</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 p-bottom">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="paid_by" class="hidden-lg hidden-md">Paid By</label>
                                            <select class="form-control" autocomplete="off" id="paid_by"  name="paid_by">
                                                <option selected="" value="<?php echo $INSTALLMENT->paid_by ?>"> 
                                                    <?php
                                                    $CUSTOMER_NAME = new Customer($INSTALLMENT->paid_by);
                                                    $customer_name = $CUSTOMER_NAME->surname . ' ' . $CUSTOMER_NAME->first_name . ' ' . $CUSTOMER_NAME->last_name;
                                                    echo $customer_name;
                                                    ?>
                                                </option>
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


                            <div class="row clearfix">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5">  
                                </div>  
                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                    <input type="hidden" value="<?php echo $id?>" name="id">
                                    <button class="btn btn-primary m-t-15 waves-effect  pull-left" type="submit" name="update">Update</button>
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