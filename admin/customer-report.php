<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/auth.php');

//check user level
$USERS = new User($_SESSION['id']);
$DEFAULTDATA = new DefaultData(NULL);
$DEFAULTDATA->checkUserLevelAccess('1,2,3', $USERS->user_level);

$CUSTOMER = new Customer(NULL);
?> 
<!DOCTYPE html>
<html>

    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <title>Customer Report || Credit Master</title>

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
                                    Customers Report
                                </h2>
                                <ul class="header-dropdown">
                                    <li>
                                        <a href=" ">
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
                                                <th>Customer Name</th>
                                                <th>Personal Details</th>   
                                                <th>Business Details</th>
                                                <th>Bank Details</th> 
                                                <th>Options</th> 
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $DefaultData = new DefaultData(NULl);

                                            foreach ($CUSTOMER->getCustomerReport() as $key => $customer) {

                                                $key++;
                                                ?>
                                                <tr id="row_<?php echo $customer['id']; ?>">
                                                    <td><?php echo $customer['id'] ?></td> 
                                                    <td> <?php
                                                        $first_name = $DefaultData->getFirstLetterName(ucwords($customer['surname']));
                                                        echo $first_name . ' ' . $customer['first_name'];
                                                        ?> 
                                                    </td> 
                                                    <td>
                                                        <?php
                                                        if ($customer['last_name'] == NULL) {
                                                            echo 'Last Name is empty.';
                                                        } elseif ($customer['profile_picture'] == NULL) {
                                                            echo 'Profile Picture is empty.';
                                                        } elseif ($customer['nic_photo_front'] == NULL) {
                                                            echo 'NIC Front is empty.';
                                                        } elseif ($customer['nic_photo_back'] == NULL) {
                                                            echo 'NIC Back is empty.';
                                                        } elseif ($customer['billing_proof_image'] == NULL) {
                                                            echo 'Billing Proof Image is empty.';
                                                        } elseif ($customer['email'] == NULL) {
                                                            echo 'Email is empty.';
                                                        } elseif ($customer['telephone'] == NULL) {
                                                            echo 'Telephone Number is empty.';
                                                        } elseif ($customer['signature_image'] == NULL) {
                                                            echo 'Signature Image is empty.';
                                                        } elseif ($customer['gn_division'] == NULL) {
                                                            echo 'GN Division  is empty.';
                                                        } else {
                                                            echo 'Customer Details is Completed';
                                                        }
                                                        ?> 
                                                    </td>

                                                    <td> 
                                                        <?php
                                                        if ($customer['business_name'] == NULL) {
                                                            echo 'Business Name is empty.';
                                                        } elseif ($customer['br_number'] == NULL) {
                                                            echo 'Br Number Name is empty.';
                                                        } elseif ($customer['nature_of_business'] == NULL) {
                                                            echo 'Nature Of Business is empty.';
                                                        } elseif ($customer['br_picture'] == NULL) {
                                                            echo 'Br Picture is empty.';
                                                        } else {
                                                            echo 'Business Details is Completed';
                                                        }
                                                        ?>
                                                    </td>

                                                    <td>
                                                        <?php
                                                        if ($customer['bank'] == NULL) {
                                                            echo 'Bank Name is empty.';
                                                        } elseif ($customer['branch'] == NULL) {
                                                            echo 'Branch Name is empty.';
                                                        } elseif ($customer['branch_code'] == NULL) {
                                                            echo 'Branch Code Name is empty.';
                                                        } elseif ($customer['bank_book_picture'] == NULL) {
                                                            echo 'Bank Book Picture is empty.';
                                                        } elseif ($customer['account_number'] == NULL) {
                                                            echo 'Account Number is empty.';
                                                        } elseif ($customer['holder_name'] == NULL) {
                                                            echo 'Holder Name is empty.';
                                                        } else {
                                                            echo 'Bank Details is Completed';
                                                        }
                                                        ?>
                                                    </td>

                                                    <td>
                                                        <a href="view-customer.php?id=<?php echo $customer['id']; ?>"> <button class="glyphicon glyphicon-eye-open  arrange-btn" title="View"></button></a> |
                                                        <a href="edit-customer.php?id=<?php echo $customer['id']; ?>"> <button class="glyphicon glyphicon-pencil edit-btn" title="Edit"></button></a>
                                                    </td> 
                                                </tr>
                                                <?php
                                            }
                                            ?>   
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>ID</th>
                                                <th>Customer Name</th>
                                                <th>Full Name</th>   
                                                <th>Address</th>
                                                <th>Mobile</th>                                                
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
        <script src="js/demo.js"></script>
        <script src="delete/js/tranfer-fee.js" type="text/javascript"></script> 



    </body> 
</html> 