<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/auth.php');


//check user level
$USERS = new User($_SESSION['id']);
$DEFAULTDATA = new DefaultData(NULL);
$DEFAULTDATA->checkUserLevelAccess('1,2,3', $USERS->user_level);

$LOAN = new Loan($_GET['id']);
$START_DATE = $LOAN->create_date;
$END_DATE = $LOAN->end_date;
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
                        <h2>View Loan (# <?php echo $LOAN->id; ?>)</h2>
                        <ul class="header-dropdown">
                            <li class="">
                                <a href="manage-loan.php">
                                    <i class="material-icons">list</i> 
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="body">

                        <div class="row">
                            <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                           
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 p-bottom">
                                <div class="form-group">
                                    <div class="form-line">
                                        <?php
                                        $a = $START_DATE;
                                        $b = $END_DATE;

                                        $date = date("Y-m-d", strtotime($a));
                                        while ($date <= date("Y-m-d", strtotime($b))) {

                                            echo "<table>";
                                            echo "<tr>";                                            
                                            echo "<td>". $date . "</td>";
                                            echo "</tr>";
                                            echo "</table>";
                                            
                                            if (substr($date, 4, 2) == "12")
                                                $date = (date("Y", strtotime($date . "01")) + 1) . "01";
                                            else
                                                $date++;
                                        }
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
<script src="js/ajax/customer.js" type="text/javascript"></script>
</body>

</html>