
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

        <title>Add New Center || Credit Master</title>
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
        <link href="css/materialize.css" rel="stylesheet" type="text/css"/>

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
                        <h2>Add New Center</h2>
                        <ul class="header-dropdown">
                            <li class="">
                                <a href="manage-center.php">
                                    <i class="material-icons">list</i> 
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        <form class="" action="post-and-get/center.php" method="post"  enctype="multipart/form-data"> 

                            <div class="row">
                                <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                    <label for="name">Center Name</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 p-bottom">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="name" class="hidden-lg hidden-md">Center Name</label>
                                            <input type="text" id="name"  name="name" placeholder="Enter Center Name" class="form-control" autocomplete="off" required="TRUE">
                                        </div>
                                    </div>
                                </div>
                            </div> 

                            <div class="row">
                                <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                    <label for="collector">Collector</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 p-bottom">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="collector" class="hidden-lg hidden-md">Collector</label>
                                            <select id="collector" name="collector" class="form-control" required="TRUE">
                                                <option value=""> -- Please Select Collector-- </option>
                                                <?php
                                                $USER = new User(NULL);
                                                foreach ($USER->all() as $users) {
                                                    ?>
                                                    <option value="<?php echo $users['id'] ?>"><?php echo $users['name'] ?></option>
                                                <?php } ?>
                                            </select> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                    <label for="leader">Leader</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 p-bottom">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="leader" class="hidden-lg hidden-md">Leader</label>
                                            <select id="leader"  name="leader" class="form-control" required="TRUE">
                                                <option value=""> -- Please Select -- </option>
                                                <?php
                                                foreach (Customer::getCustomerByCenterLeader()as $customer) {

                                                    $addres = $customer['address_line_1'];

                                                    if (!empty($customer['address_line_2'])) {
                                                        if (strpos($customer['address_line_1'], ',') != TRUE) {
                                                            $addres .= ', ';
                                                        }
                                                        $addres .= $customer['address_line_2'];
                                                    }

                                                    if (!empty($customer['address_line_3'])) {
                                                        if (strpos($customer['address_line_2'], ',') != TRUE) {
                                                            $addres .= ', ';
                                                        }
                                                        $addres .= $customer['address_line_3'];
                                                    }

                                                    if (!empty($customer['address_line_4'])) {
                                                        if (strpos($customer['address_line_3'], ',') != TRUE) {
                                                            $addres .= ', ';
                                                        }
                                                        $addres .= $customer['address_line_4'];
                                                    }

                                                    if (!empty($customer['address_line_5'])) {
                                                        if (strpos($customer['address_line_4'], ',') != TRUE) {
                                                            $addres .= ', ';
                                                        }
                                                        $addres .= $customer['address_line_5'];
                                                    }
                                                    ?>

                                                    <option value="<?php echo $customer['id']; ?>" data-address="<?php echo $addres; ?>"> 
                                                        <?php echo $customer['first_name'] . ' ' . $customer['last_name']; ?> 
                                                    </option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                    <label for="address">Center Address</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 p-bottom">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="address" class="hidden-lg hidden-md">Center Address</label>
                                            <input type="text" id="address"  name="address" placeholder="Enter Address" class="form-control" autocomplete="off" required="TRUE">
                                        </div>
                                    </div>
                                </div>
                            </div> 

                            <div class="row clearfix">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5">  
                                </div>  
                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                    <button class="btn btn-primary m-t-15 waves-effect  pull-left" type="submit" name="add-center">Save Details</button>
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
        <script>
            $(document).ready(function () {
                $('#leader').change(function () {
                    var address = $('option:selected', this).attr('data-address');
                    $('#address').val(address);
                })
            });
        </script>
    </body>

</html>