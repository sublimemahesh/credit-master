<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/auth.php');

$LOAN = new Loan(NULL);
$LOAN->status = 'verified';
?> 
<!DOCTYPE html>
<html>

    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <title>Manage Verified Loans || Credit Master</title>

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
                                    Manage Verified Loans
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
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                        <thead>
                                            <tr>
                                                <th>Loan</th> 
                                                <th>Customer Details</th> 
                                                <th>Loan Details</th>  
                                                <th>Installment Details</th>                                                 
                                                <th class="text-center">Options</th> 
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($LOAN->allByStatus() as $key => $loan) {
                                                ?>
                                                <tr id="row_<?php echo $loan['id']; ?>">
                                                    <td>
                                                        <b>
                                                            ID: # 
                                                            <?php echo str_pad($loan['id'], 6, '0', STR_PAD_LEFT); ?>
                                                        </b>
                                                        <br/>
                                                        <b>Date: </b><?php echo $loan['create_date']; ?>
                                                    </td>  
                                                    <td>
                                                        <i class="glyphicon glyphicon-user"></i>
                                                        <b> : 
                                                            <?php
                                                            $Customer = new Customer($loan['customer']);
                                                            echo $Customer->title . ' ' . $Customer->first_name . ' ' . $Customer->last_name;
                                                            ?>
                                                        </b>
                                                        <br/>
                                                        <small>
                                                            <i class="glyphicon glyphicon-user"></i>
                                                            <i class="glyphicon glyphicon-user"></i> : 
                                                            <?php
                                                            $Customer1 = new Customer($loan['guarantor_1']);
                                                            echo $Customer1->title . ' ' . $Customer1->first_name . ' ' . $Customer1->last_name;
                                                            ?>
                                                        </small>
                                                        <br/>

                                                        <small>
                                                            <i class="glyphicon glyphicon-user"></i>
                                                            <i class="glyphicon glyphicon-user"></i> : 
                                                            <?php
                                                            $Customer2 = new Customer($loan['guarantor_2']);
                                                            echo $Customer2->title . ' ' . $Customer2->first_name . ' ' . $Customer2->last_name;
                                                            ?>
                                                        </small> 
                                                    </td>
                                                    <td>
                                                        <b>Amount: <?php echo number_format($loan['loan_amount'], 2); ?></b>
                                                        <br/>
                                                        <b>Int. Rate: </b><?php echo $loan['interest_rate']; ?>%
                                                        <br/> 
                                                        <b>Period: </b>
                                                        <?php
                                                        $PR = DefaultData::getLoanPeriod();
                                                        echo $PR[$loan['loan_period']];
                                                        ?> 
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
                                                        <br/>
                                                    </td>
                                                    <td class="text-center" style="padding-top: 24px;">
                                                        <a href="approve-loan.php?id=<?php echo $loan['id']; ?>"> <button class="glyphicon glyphicon-ok btn btn-info" title="Approve Loan #<?php echo str_pad($loan['id'], 6, '0', STR_PAD_LEFT); ?>"></button></a> |  
                                                        <a href="#"  class="delete-loan" data-id="<?php echo $loan['id']; ?>"> <button class="glyphicon glyphicon-trash delete-btn btn btn-danger" title="Delete Loan #<?php echo str_pad($loan['id'], 6, '0', STR_PAD_LEFT); ?>"></button></a>
                                                    </td> 
                                                </tr>
                                                <?php
                                            }
                                            ?>   
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Loan</th> 
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
        <script src="delete/js/loan.js" type="text/javascript"></script>
    </body> 
</html> 