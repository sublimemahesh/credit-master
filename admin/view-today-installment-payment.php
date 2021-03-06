<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/auth.php');

//check user level
$USERS = new User($_SESSION['id']);
$DEFAULTDATA = new DefaultData(NULL);
$DEFAULTDATA->checkUserLevelAccess('1,2,3', $USERS->user_level);

$INSTALLMENT = new Installment(NULL);

$asia_date = new DateTime('now', new DateTimezone('Asia/Dhaka'));
$today = $asia_date->format('Y-m-d');


if (isset($_GET['date'])) {
    $today = $_GET['date'];
}

$BD = new DateTime($today);
$BD->modify('-1 day');
$back = $BD->format('Y-m-d');

$ND = new DateTime($today);
$ND->modify('+1 day');
$next = $ND->format('Y-m-d');
?> 
<!DOCTYPE html>
<html> 
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <title>View Installment Payment  || Credit Master</title>

        <!-- Favicon-->
        <link rel="icon" href="favicon.ico" type="image/x-icon">

        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
        <link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
        <link href="plugins/node-waves/waves.css" rel="stylesheet" />
        <link href="plugins/animate-css/animate.css" rel="stylesheet" />
        <link href="plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
        <link href="plugins/sweetalert/sweetalert.css" rel="stylesheet" />
        <link href="css/style.css" rel="stylesheet">
        <link href="css/themes/all-themes.css" rel="stylesheet" />
        <link href="css/table-style.css" rel="stylesheet" type="text/css"/>
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
                <!-- Manage Districts -->
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                        <div class="card">
                            <div class="header">
                                <h2>
                                    Today Instalments :
                                    <?php
                                    echo $today;
                                    ?>
                                </h2>

                                <ul class="header-dropdown">                                    
                                    <a href="view-today-installment-payment.php?date=<?php echo $back ?>">
                                        <i class="material-icons" >
                                            arrow_back_ios
                                        </i>
                                    </a>  
                                    <a href="view-today-installment-payment.php?date=<?php echo $next ?>">
                                        <i class="material-icons">
                                            arrow_forward_ios
                                        </i>
                                    </a>
                                </ul>
                            </div>

                            <div class = "body">
                                <div class = "table-responsive">
                                    <table class = "table table-bordered table-striped table-hover js-basic-example dataTable  ">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Loan Id</th>
                                                <th>Customer Name</th>
                                                <th>Registration Type</th>
                                                <th>Date / Time</th>
                                                <th>Total Payment</th>
                                                <th>Option</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($INSTALLMENT->getAllPaymentsByPaidDate($today) as $key => $installment) {
                                                $key++;
                                                ?>
                                                <tr>
                                                    <td> 
                                                        #<?php echo $key ?>
                                                    </td> 

                                                    <td>  
                                                        <?php
                                                        $LOAN = new loan($installment['loan']);
                                                        $IT = $LOAN->installment_type;
                                                        if ($IT == 30) {
                                                            echo 'BLD' . $installment['loan'];
                                                        } elseif ($IT == 4) {
                                                            echo 'BLW' . $installment['loan'];
                                                        } else {
                                                            echo 'BLM' . $installment['loan'];
                                                        }
                                                        ?>
                                                    </td> 
                                                    <td>
                                                        <?php
                                                        $LOAN = new loan($installment['loan']);
                                                        $CUSTOMER = new Customer($LOAN->customer);

                                                        $first_name = $DEFAULTDATA->getFirstLetterName(ucwords($CUSTOMER->surname));
                                                        echo '<b>' . $first_name . ' ' . $CUSTOMER->first_name . ' ' . $CUSTOMER->last_name . '</b>';
                                                        ?>

                                                    </td>
                                                    <td>
                                                        <?php
                                                        $CENTER = new Center($CUSTOMER->center);
                                                        $ROUTE = new Route($CUSTOMER->route);
                                                        if ($CUSTOMER->center) {
                                                            echo '<b>' . 'Center - ' . '</b>' . $CENTER->name;
                                                        } elseif ($CUSTOMER->route) {

                                                            echo '<b>' . 'Route - ' . '</b>' . $ROUTE->name;
                                                        } else {
                                                            echo '<b>' . 'Center Leader - ' . '</b>';
                                                        }
                                                        ?>

                                                    </td>
                                                    <td >
                                                        <?php echo $installment['paid_date'] ?>
                                                    </td>

                                                    <?php ?>
                                                    <td>
                                                        <?php echo $installment['paid_amount'] ?>
                                                    </td>
                                                    <td>
                                                        <a href="edit-installment.php?id=<?php echo $installment['id']; ?>"> <button class="glyphicon glyphicon-pencil edit-btn"></button></a> |  
                                                        <a href="view-edit-history.php?id=<?php echo $installment['loan']; ?>"> <button class="glyphicon glyphicon-repeat arrange-btn"></button></a> 
                                                    </td>

                                                </tr>
                                                <?php
                                            }
                                            ?> 
                                        </tbody>

                                        <tfoot>
                                            <tr>
                                                <th>Id</th> 
                                                <th>Loan Id</th>  
                                                <th>Customer Name</th>  
                                                <th>Registration Type</th> 
                                                <th>Date / Time</th>
                                                <th>Total Payment</th> 
                                                <th>Option</th>
                                            </tr>
                                        </tfoot>
                                    </table> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </section>

        <script src="plugins/jquery/jquery.min.js"></script>
        <script src="plugins/bootstrap/js/bootstrap.js"></script>
        <script src="plugins/bootstrap-select/js/bootstrap-select.js"></script>
        <script src="plugins/jquery-slimscroll/jquery.slimscroll.js"></script>
        <script src="plugins/node-waves/waves.js"></script>

        <script src="plugins/jquery-datatable/jquery.dataTables.js"></script>
        <script src="plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
        <script src="plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
        <script src="plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
        <script src="plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
        <script src="plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
        <script src="plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
        <script src="plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
        <script src="plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>

        <script src="plugins/sweetalert/sweetalert.min.js"></script>
        <script src="js/admin.js"></script>
        <script src="js/pages/tables/jquery-datatable.js"></script>
        <script src="js/demo.js"></script>


    </body> 
</html> 