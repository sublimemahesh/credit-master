<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/auth.php');

//check user level
$USERS = new User($_SESSION['id']);
$DEFAULTDATA = new DefaultData(NULL);
$DEFAULTDATA->checkUserLevelAccess('1,2,3', $USERS->user_level);

$id = '';
$id = $_GET['id'];
$TRANSFER_FEE = new TransferFee($id);
?>

<!DOCTYPE html>
<html> 
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

        <title>View Transfer fee  || Credit Master</title>
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
                        <h2>View Transfer fee </h2>
                        <ul class="header-dropdown">
                            <li class="">
                                <a href="manage-transfer-fee.php">
                                    <i class="material-icons">list</i> 
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        <div class="row">
                            <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                <label for="from_account">From Account:  </label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 p-bottom">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label for="from_account" class="hidden-lg hidden-md">From Account:  </label>
                                        <div class="form-control">                                          
                                            <?php
                                            $USER = new User($TRANSFER_FEE->from_account);
                                            echo $USER->name;
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                <label for="to_account">To Account:  </label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 p-bottom">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label for="to_account" class="hidden-lg hidden-md">To Account:  </label>
                                        <div class="form-control">
                                            <?php
                                            $USER = new User($TRANSFER_FEE->to_account);
                                            echo $USER->name;
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                <label for="date"> Date</label>
                            </div>
                            <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 p-bottom">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label for="date" class="hidden-lg hidden-md">Paid Date</label>
                                        <div class="form-control">
                                            <?php echo $TRANSFER_FEE->date ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-1 col-md-1 hidden-sm hidden-xs form-control-label">
                                <label for="time">Time</label>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 p-bottom">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label for="time" class="hidden-lg hidden-md">Time</label>
                                        <div class="form-control">
                                            <?php echo $TRANSFER_FEE->time ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> 


                        <div class="row">
                            <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                <label for="amount"  >Amount</label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 p-bottom">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label for="amount" class="hidden-lg hidden-md">Amount</label>
                                        <div class="form-control"> 
                                            <?php
                                            echo number_format($TRANSFER_FEE->amount, 2);
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                <label for="purpose">Purpose</label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 p-bottom">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label for="purpose" class="hidden-lg hidden-md">Purpose</label>
                                        <div class="form-control"> 
                                            <?php
                                            echo $TRANSFER_FEE->purpose;
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
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

    <script src="tinymce/js/tinymce/tinymce.min.js"></script>
    <script>
        tinymce.init({
            selector: "#description",
            // ===========================================
            // INCLUDE THE PLUGIN
            // ===========================================

            plugins: [
                "advlist autolink lists link image charmap print preview anchor",
                "searchreplace visualblocks code fullscreen",
                "insertdatetime media table contextmenu paste"
            ],
            // ===========================================
            // PUT PLUGIN'S BUTTON on the toolbar
            // ===========================================

            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image jbimages",
            // ===========================================
            // SET RELATIVE_URLS to FALSE (This is required for images to display properly)
            // ===========================================

            relative_urls: false

        });


    </script>
</body>

</html>