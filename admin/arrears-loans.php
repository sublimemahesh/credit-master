<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/auth.php');

//check user level
$USERS = new User($_SESSION['id']);
$DEFAULTDATA = new DefaultData(NULL);
$DEFAULTDATA->checkUserLevelAccess('1,2,3', $USERS->user_level);


$today = date("Y-m-d");
$LOAN = new Loan(NULL);
$LOAN->status = 'issued';

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
        <title> Arrears Loans || Credit Master</title>

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
                                    Arrears Loans :
                                    <?php
                                    echo $today;
                                    ?>
                                </h2>


                            </div> 

                            <div class="body">                            
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                        <thead>
                                            <tr>
                                                <th>Loan Details</th>  
                                                <th>Installment Details</th>
                                                <th>Number of arrears</th>                                                 
                                              
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php
                                            foreach ($LOAN->allByStatus() as $key => $loan) {
                                                ?> 
                                                <tr>
                                                    <td> 
                                                        <i class="glyphicon glyphicon-info-sign"></i>
                                                        <b> : 
                                                            <?php
                                                            $LT = $loan['installment_type'];
                                                            if ($LT == 30) {
                                                                echo 'BLD' . $loan['id'];
                                                            } elseif ($LT == 4) {
                                                                echo 'BLW' . $loan['id'];
                                                            } else {
                                                                echo 'BLM' . $loan['id'];
                                                            }
                                                            ?>
                                                        </b>
                                                        <br/>

                                                        <i class="glyphicon glyphicon-user"></i>
                                                        <b> : 
                                                            <?php
                                                            $Customer = new Customer($loan['customer']);
                                                            $DefaultData = new DefaultData();
                                                            $first_name = $DefaultData->getFirstLetterName(ucwords($Customer->surname));
                                                            echo $Customer->title . ' ' . $first_name . ' ' . $Customer->first_name . ' ' . $Customer->last_name;
                                                            ?>
                                                        </b> 
                                                    </td>

                                                    <td>
                                                        <b>
                                                            Type: <?php
                                                            $PR = DefaultData::getInstallmentType();
                                                            echo $PR[$loan['installment_type']];
                                                            ?>
                                                        </b>
                                                        <br/>
                                                        <b>Amount: </b>
                                                        <?php echo number_format($loan['installment_amount'], 2); ?>
                                                        <br/> 
                                                        <b>Nu. of Inst.: </b>
                                                        <?php
                                                        $numOfInst = DefaultData::getNumOfInstlByPeriodAndType($loan['loan_period'], $loan['installment_type']);
                                                        echo $numOfInst;
                                                        ?>
                                                        
                                                    </td>

                                                    <td>
                                                        <?php
                                                        $LOAN_1 = new Loan($loan['id']);
                                                        $status = $LOAN_1->getCurrentStatus();

                                                        if ($status["arrears-excess"] > 0) {
                                                            echo '<b class="text-danger">Arrears: </b>';
                                                            echo '<span  class="text-danger">' . '<b>' . round($status["arrears-excess-num-of-ins"], 1) . ' | ' . number_format($status["arrears-excess"], 2) . '</span>' . '<b>';
                                                        } else {
                                                            echo '<b class="text-success">Excess: </b>';
                                                            echo '<span  class="text-success">' . '<b>' . round(abs($status["arrears-excess-num-of-ins"]), 1) . ' |' . number_format(abs($status["arrears-excess"]), 2) . '</span>' . '<b>';
                                                        }
                                                        ?>
                                                        <br> 
                                                        <?php
                                                        if ($status["od_amount"] == 0) {
                                                            
                                                        } else {
                                                            echo '<b class="text-success">Od Amount: </b>';
                                                            echo '<span  class="text-success">' . '<b>' . number_format($status["od_amount"], 2) . '</span>' . '<b>';
                                                            echo '<br>';
                                                            echo '<b class="text-danger"  >All Aress Amount: </b>';
                                                            echo '<span  class="text-danger">' . '<b>' . number_format($status["all_arress"], 2) . '</span>' . '<b>';
                                                        }
                                                        ?>  
                                                    </td>                                                   
                                                </tr>
                                                <?php
                                            }
                                            ?>   
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Loan Details</th>  
                                                <th>Installment Details</th>
                                                <th>Number of arrears</th>                                                
                                                
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