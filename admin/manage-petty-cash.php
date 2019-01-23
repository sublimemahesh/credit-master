<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/auth.php');

//check user level
$USERS = new User($_SESSION['id']);
$DEFAULTDATA = new DefaultData(NULL);
$DEFAULTDATA->checkUserLevelAccess('1,2,3', $USERS->user_level);

?> 
<!DOCTYPE html>
<html>

    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <title>Manage Petty Cash  || Credit Master</title>

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
                                    Manage Petty Cash 
                                </h2>
                                <ul class="header-dropdown">
                                    <li>
                                        <a href="add-new-petty-cash.php">
                                            <i class="material-icons">add</i> 
                                        </a>
                                    </li>
                                </ul>
                            </div> 
                            <div class = "body">
                                <div class = "table-responsive">
                                    <table class = " dataTable table table-bordered table-striped table-hover js-basic-example" id = "postpone_date">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Date</th>
                                                <th>Amount</th> 
                                                <th>Type</th>
                                                <th>Reason</th>
                                                <th>Option</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $PETTYCASH = new PettyCash();
                                            foreach ($PETTYCASH->all() as $key => $petty_cash) {
                                                $key++;
                                                ?>
                                                <tr id="row_<?php echo $petty_cash['id']; ?>">
                                                    <td>
                                                        #<?php echo $key ?>
                                                    </td> 
                                                    <td>
                                                        <?php echo $petty_cash['date']; ?>
                                                    </td>

                                                    <td>
                                                        <?php echo 'Rs: ' .number_format($petty_cash['amount'],2); ?>
                                                    </td>  
                                                    <td>
                                                        <?php echo $petty_cash['type']; ?>
                                                    </td>   
                                                    <td>
                                                        <?php echo $petty_cash['reason']; ?>
                                                    </td>  
                                                    <td>     
                                                        <a href="view-petty-cash.php?id=<?php echo $petty_cash['id']; ?>"> <button class="glyphicon glyphicon-eye-open arrange-btn" title="View"></button></a> |
                                                        <a href="edit-petty-cash.php?id=<?php echo $petty_cash['id']; ?>"> <button class="glyphicon glyphicon-pencil edit-btn" title="Edit"></button></a> | 
                                                        <a href="#"  class="delete-petty-cash" data-id="<?php echo $petty_cash['id']; ?>"> <button class="glyphicon glyphicon-trash delete-btn" title="Delete"></button></a>
                                                    </td> 
                                                </tr>
                                                <?php
                                            }
                                            ?>   
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>ID</th>
                                                <th>Date</th>
                                                <th>Amount</th>
                                                <th>Type</th>
                                                <th>Reason</th>
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
        <script src="js/demo.js"></script>
        <script src="delete/js/petty-cash.js" type="text/javascript"></script> 
        <script type="text/javascript">
            $(document).ready(function () {
                $('#postpone_date').DataTable({
                    "order": [[1, "desc"]]
                });
            });
        </script>


    </body> 
</html> 