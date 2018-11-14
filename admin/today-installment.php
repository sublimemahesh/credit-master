<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/auth.php');

$today = date("Y-m-d");
$LOAN = new Loan(NULL);
$LOAN->status = 'issued';

if (isset($_GET['date'])) {
    $today = $_GET['date'];
} elseif (isset($_GET['back'])) {

    $BD = new DateTime($today);
    $BD->modify('-1 day');
    $today = $BD->format('Y-m-d');
} elseif (isset($_GET['next'])) {

    $ND = new DateTime($today);
    $ND->modify('+1 day');
    $today = $ND->format('Y-m-d');
}
?> 
<!DOCTYPE html>
<html> 
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <title> Day Instalment  || Credit Master</title>

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
                                    Day Instalment :
                                    <?php
                                    echo $today;
                                    ?>
                                </h2>

                                <ul class="header-dropdown"> 
                                    <a href="today-installment.php?back">
                                        <i class="material-icons" >
                                            arrow_back_ios
                                        </i>
                                    </a>
                                    <a href="today-installment.php?next">
                                        <i class="material-icons">
                                            arrow_forward_ios
                                        </i>
                                    </a> 
                                </ul>
                            </div> 

                            <div class="body">                            
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                        <thead>
                                            <tr>
                                                <th>Customer Details</th> 
                                                <th>Loan Details</th>  
                                                <th>Installment Details</th>                                                 
                                                <th class="text-center">Options</th> 
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($LOAN->allByStatus() as $key => $loan) {

                                                $defultdata = DefaultData::getNumOfInstlByPeriodAndType($loan['loan_period'], $loan['installment_type']);

                                                $start_date = $loan['effective_date'];
                                                $start = new DateTime("$start_date");

                                                $x = 0;
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


                                                    $date = $start->format('Y-m-d');
                                                    $customer = $loan['customer'];
                                                    $customer_name = new Customer($customer);
                                                    $LP = DefaultData::getLoanPeriod();
                                                    $IT = DefaultData::getInstallmentType();
                                                    $installment_amount = $loan['installment_amount'];

                                                    if (PostponeDate::CheckIsPostPoneByDateAndCustomer($date, $customer)) {
                                                        $start->modify($add_dates);
                                                    } else {
                                                        if ($date == $today) {
                                                            ?>
                                                            <tr>
                                                                <td>
                                                                    <i class="glyphicon glyphicon-user"></i>
                                                                    <?php
                                                                    echo $customer_name->surname . ' ' . $customer_name->first_name . ' ' . $customer_name->last_name;
                                                                    echo '</br><b>Mo No: </b> ' . $customer_name->mobile;
                                                                    $CENTER = new Center($customer_name->center);

                                                                    if ($customer_name->center = $CENTER->id) {
                                                                        echo '</br><b>' . 'Center - ' . '</b>' . $CENTER->name;
                                                                    } else {
                                                                        $ROUTE = new Route($customer_name->route);
                                                                        echo '</br><b>' . 'Route - ' . '</b>' . $ROUTE->name;
                                                                    }
                                                                    ?>
                                                                </td> 
                                                                <td>  
                                                                    <?php
                                                                    echo '<b>Amount: ' . $loan['loan_amount'] . '.00</b>';
                                                                    echo '</br><b>Period: </b>' . $LP[$loan['loan_period']];
                                                                    echo '</br><b>Type: </b>' . $IT[$loan['installment_type']];
                                                                    ?>
                                                                </td> 
                                                                <td>
                                                                    <?php
                                                                    echo '<b>In Amount: </b>'.$installment_amount.'.00';
                                                                    if ($INSTALLMENT = Installment::getInstallmentByLoanAndDate($loan['id'], $date)) {
                                                                        echo '<h5>Paid - ' . $INSTALLMENT['paid_amount'] . '.00</h5>';
                                                                    } else {
                                                                        'xxx';
                                                                    }
                                                                    ?>
                                                                </td>

                                                                <td class="text-center"> 
                                                                    <a href="add-new-installment.php?date=<?php echo $date ?>&loan<?php echo $loan['id'] ?>">
                                                                        <button class="glyphicon glyphicon-send btn btn-info" title="Payment"></button> 
                                                                    </a> 
                                                                </td> 
                                                            </tr>
                                                            <?php
                                                        }
                                                        $start->modify($add_dates);
                                                        $x++;
                                                    }
                                                }
                                            }
                                            ?> 
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Customer Details</th> 
                                                <th>Loan Details</th>    
                                                <th>Installment Details</th>                                                 
                                                <th class="text-center">Options</th> 
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