<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/auth.php');

$id = $_GET['id'];
$LOAN = new Loan($id);
?> 
<!DOCTYPE html>
<html>

    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <title>View Installment || Credit Master</title>

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
                                    View Installment
                                </h2>
                                <ul class="header-dropdown">
                                    <li>
                                        <a href="create-loan.php">
                                            <i class="material-icons">add</i> 
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <div class="body">


                                <div> 

                                    <h5> ID  # : <?php echo str_pad($LOAN->id, 6, '0', STR_PAD_LEFT) ?>  </h5>
                                    <h5>
                                        Customer Name : 
                                        <?php
                                        $customer = new Customer($LOAN->customer);
                                        echo $customer->title . ' ' . $customer->first_name . ' ' . $customer->last_name;
                                        ?> 
                                    </h5>

                                    <h5>Loan Amount : <?php echo $LOAN->loan_amount ?> </h5>

                                    <h5>Installment Type : 
                                        <?php
                                        $IT = DefaultData::getInstallmentType();

                                        echo $IT[$LOAN->installment_type];
                                        ?> 
                                    </h5>

                                    <h5>Loan Period : 
                                        <?php
                                        $LP = DefaultData::getLoanPeriod();
                                        echo $LP[$LOAN->loan_period];
                                        ?> 
                                    </h5>
                                </div> 
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                        <thead>
                                            <tr>
                                                <th>Dates</th> 
                                                <th>Installment Amount</th> 
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $defultdata = DefaultData::getNumOfInstlByPeriodAndType($LOAN->loan_period, $LOAN->installment_type);

                                            $start_date = $LOAN->effective_date;
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
                                                $customer = $LOAN->customer;
                                                $CUSTOMER = new Customer($customer);
                                                $route = $CUSTOMER->route;
                                                $center = $CUSTOMER->center;
                                                $amount = $LOAN->installment_amount;
                                                echo '<tr>';
                                                if (PostponeDate::CheckIsPostPoneByDateAndCustomer($date, $customer) || PostponeDate::CheckIsPostPoneByDateAndRoute($date, $route) || PostponeDate::CheckIsPostPoneByDateAndCenter($date, $center)|| PostponeDate::CheckIsPostPoneByDateAndAll($date)) {

                                                    echo '<td class="padd-td red">';
                                                    echo $date;
                                                    echo '</td>';
                                                    echo '<td class="padd-td red">';
                                                    echo 'Rs: ' . $amount . '.00';
                                                    echo '</td>';

                                                    $start->modify($add_dates);
                                                } else {

                                                    echo '<td class="padd-td f-style">';
                                                    echo $date;
                                                    echo '</td>';
                                                    $start->modify($add_dates);
                                                    $x++;
                                                    echo '<td class="f-style">';
                                                    echo 'Rs: ' . $amount . '.00';
                                                    echo '</td>';
                                                }
                                                echo '</tr>';
                                            }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Dates</th> 
                                                <th>Installment Amount</th> 
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

        <script src = "plugins/jquery/jquery.min.js"></script>
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
        <script src="delete/js/loan.js" type="text/javascript"></script>
    </body> 
</html> 