<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/auth.php');

$id = '';
$id = $_GET['id'];
$CENTER = new Center($id);
?>

<!DOCTYPE html>
<html> 
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

        <title>Edit Center || Credit Master</title>
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
                        <h2>Edit Center</h2>
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
                                            <input type="text" id="name"  name="name" value="<?php echo $CENTER->name ?>"  class="form-control" autocomplete="off">
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
                                                foreach (Customer::all()as $customer) {

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
                                                    if ($CENTER->leader == $customer['id']) {
                                                        ?> 
                                                        <option value="<?php echo $customer['id']; ?>" data-address="<?php echo $addres; ?>" selected="TRUE"> 
                                                            <?php echo $customer['first_name'] . ' ' . $customer['last_name']; ?> 
                                                        </option>
                                                        <?php
                                                    } else {
                                                        ?> 
                                                        <option value="<?php echo $customer['id']; ?>" data-address="<?php echo $addres; ?>"> 
                                                            <?php echo $customer['first_name'] . ' ' . $customer['last_name']; ?> 
                                                        </option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                    <label for="address">Address</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 p-bottom">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="address" class="hidden-lg hidden-md">Address</label>
                                            <input type="text" id="address"  name="address" value="<?php echo $CENTER->address ?>"  class="form-control" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="row clearfix">     
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5">  
                                </div> 
                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                    <input type="hidden" id="id" value="<?php echo $CENTER->id; ?>" name="id"/>
                                    <button class="btn btn-primary m-t-15 waves-effect  pull-left" type="submit" name="update">Update</button>
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