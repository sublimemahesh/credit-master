<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/auth.php');
$id = '';
$id = $_GET['id'];
$ROUTE = new Route($id);
?> 
<!DOCTYPE html>
<html>

    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <title>View Route || Credit Master</title>

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
                                    View Route Details
                                </h2>
                                <ul class="header-dropdown">
                                    <li>
                                        <a href="create-route.php">
                                            <i class="material-icons">add</i> 
                                        </a>
                                    </li>
                                </ul>
                            </div> 
                            <div class="body">

                                <div class="row">
                                    <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                        <label for="route_name">Route Name</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="route_name" class="hidden-lg hidden-md">Route Name</label>
                                                <div class="form-control"><?php echo $ROUTE->name; ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                        <label for="Code">Code</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="Code" class="hidden-lg hidden-md"> Code</label>
                                                <div class="form-control"><?php echo $ROUTE->code; ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                        <label for="Code">Code</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="Code" class="hidden-lg hidden-md"> Code</label>
                                                <div class="form-control"><?php echo $ROUTE->code; ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                        <label for="end_location">End Location</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="end_location" class="hidden-lg hidden-md">End Location</label>
                                                <div class="form-control"><?php echo $ROUTE->end_location; ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                        </div>
                    </div>
                </div> 

                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                        <div class="card">
                            <div class="header">
                                <h2>
                                    View Route Customer
                                </h2>
                                <ul class="header-dropdown">
                                    <li>
                                        <a href="create-route.php">
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
                                                <th>ID</th>
                                                <th>Full Name</th>  
                                                <th>NIC Number</th>
                                                <th>Address</th>
                                                <th>Mobile</th>
                                                <th>Route/Center/City</th>
                                                <th>Options</th> 
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $CUSTOMER = new Customer(Null);
                                            foreach ($CUSTOMER->getCustomerByRoute($ROUTE->id)as $key => $customer) {
                                                ?>
                                                <tr id="row_<?php echo $customer['id']; ?>">
                                                    <td>#<?php echo $customer['id']; ?></td> 
                                                    <td><?php echo $customer['surname'] . ' ' . $customer['first_name'] . ' ' . $customer['last_name']; ?></td>
                                                    <td><?php echo $customer['nic_number']; ?></td>  
                                                    <td><?php echo $customer['address_line_1'] . ' ' . $customer['address_line_2']; ?></td>
                                                    <td><?php echo $customer['mobile']; ?></td>
                                                    <td>

                                                        <?php
                                                        $ROUTE = new Route($customer['route']);
                                                        $ROUTE = new Center($customer['route']);
                                                        $ROUTE = new City($customer['city']);

                                                        echo $ROUTE->name . ' | ' . $ROUTE->name . ' | ' . $ROUTE->name
                                                        ?></td>

                                                    </td>
                                                    <td>
                                                        <a href="view-customer.php?id=<?php echo $customer['id']; ?>"> <button class="glyphicon glyphicon-eye-open  arrange-btn" title="View"></button></a> |
                                                        <a href="edit-customer.php?id=<?php echo $customer['id']; ?>"> <button class="glyphicon glyphicon-pencil edit-btn" title="Edit"></button></a> |
                                                        <a href="#"  class="delete-customer" data-id="<?php echo $customer['id']; ?>"> <button class="glyphicon glyphicon-trash delete-btn" title="Delete"></button></a>

                                                    </td> 
                                                </tr>
                                                <?php
                                            }
                                            ?>   
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>ID</th>
                                                <th>Full Name</th>  
                                                <th>NIC Number</th>
                                                <th>Address</th>
                                                <th>Mobile</th>
                                                <th>Route/Center/City</th>
                                                <th>Options</th>
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
        <script src="delete/js/customer.js" type="text/javascript"></script>

    </body> 
</html> 