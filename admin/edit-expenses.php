<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/auth.php');

//check user level
$USERS = new User($_SESSION['id']);
$DEFAULTDATA = new DefaultData(NULL);
$DEFAULTDATA->checkUserLevelAccess('1,2,3', $USERS->user_level);


$id = '';
$id = $_GET['id'];
$EXPENSES = new Expenses($id);
?>

<!DOCTYPE html>
<html> 
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

        <title>Edit Expenses || Credit Master</title>
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
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
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

                <div class="card">
                    <div class="header">
                        <h2>Add New Expenses</h2>
                        <ul class="header-dropdown">
                            <li class="">
                                <a href="manage-expenses.php">
                                    <i class="material-icons">list</i> 
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        <form class="" action="post-and-get/expenses.php" method="post"  enctype="multipart/form-data"> 


                            <div class="row">
                                <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                    <label for="date">Date</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 p-bottom">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="date" class="hidden-lg hidden-md">Date</label>
                                            <input type="text" id="paid_date"  name="date" placeholder="Enter Date" class="form-control datepicker" autocomplete="off" required="TRUE" value="<?php echo $EXPENSES->date ?>" >
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                    <label for="time">Time</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 p-bottom">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="time" class="hidden-lg hidden-md">Time</label>
                                            <input type="time" id="paid_date"  name="time" placeholder="Enter Time" class="form-control  " autocomplete="off" required="TRUE"  value="<?php echo $EXPENSES->time ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                    <label for="amount">Amount</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 p-bottom">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="amount" class="hidden-lg hidden-md">Amount</label>
                                            <input type="number" id="paid_date"  name="amount" placeholder="Enter Amount" class="form-control  " autocomplete="off" required="TRUE" min="0" value="<?php echo $EXPENSES->amount ?>" step="0.001" >
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                    <label for="reason">Reason</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 p-bottom">
                                    <div class="form-group"> 
                                        <div class="form-line">
                                            <textarea rows="4" name="reason" class="form-control "><?php echo $EXPENSES->reason ?> </textarea>   
                                        </div>     
                                    </div>
                                </div>
                            </div> 

                            <div class="row clearfix">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5">  
                                </div>  
                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                    <input type="hidden" name="id" value="<?php echo $id ?>">
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
                $(".datepicker").datepicker({dateFormat: 'yy-mm-dd'});
            });
        </script> 
        <script src="js/ajax/postpone-date.js" type="text/javascript"></script> 

    </body>

</html>

