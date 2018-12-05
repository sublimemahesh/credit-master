<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/auth.php');

$id = '';
$id = $_GET['id'];

$CUSTOMER = new Customer($id);
$ROUTE = Route::all();
$CENTER = Center::all();
?>

<!DOCTYPE html>
<html> 
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

        <title>Edit Customer || Credit Master</title>
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
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
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
                        <h2>Edit Customer</h2>
                        <ul class="header-dropdown">
                            <li class="">
                                <a href="view-active-customer.php">
                                    <i class="material-icons">list</i> 
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        <form class="" action="post-and-get/customer.php" method="post"  enctype="multipart/form-data" id="form"> 
                            <div class="row">
                                <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                    <label for="title">Title</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 p-bottom">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="title" class="hidden-lg hidden-md">Title</label>
                                            <select id="title" name="title" class="form-control" >
                                                <option value="<?php echo $CUSTOMER->title ?>"><?php echo $CUSTOMER->title ?></option>
                                                <option value="Mr.">Mr.</option>
                                                <option value="Mrs.">Mrs.</option>
                                                <option value="Miss.">Miss.</option>
                                                <option value="Dr.">Dr.</option>
                                            </select> 
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                    <label for="first_name">First Name</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 p-bottom">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="first_name" class="hidden-lg hidden-md">First Name</label>
                                            <input type="text" id="first_name"  name="first_name" value="<?php echo $CUSTOMER->first_name ?>" class="form-control" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                            </div> 

                            <div class="row">
                                <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                    <label for="last_name">Last Name</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 p-bottom">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="last_name" class="hidden-lg hidden-md">Last Name</label>
                                            <input type="text" id="last_name"  name="last_name" value="<?php echo $CUSTOMER->last_name ?>" class="form-control" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                            </div> 

                            <div class="row">
                                <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                    <label for="surname">Surname</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 p-bottom">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="surname" class="hidden-lg hidden-md">Surname</label>
                                            <input type="text" id="surname"  name="surname" value="<?php echo $CUSTOMER->surname ?>" class="form-control" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                    <label for="profile_picture">Profile Picture</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 p-bottom">
                                    <div class="form-group">

                                        <label for="profile_picture" class="hidden-lg hidden-md">Profile Picture</label>
                                        <input type="file" id="profile_picture"  name="profile_picture"  value="<?php echo $CUSTOMER->profile_picture ?>" class="form-control" autocomplete="off">
                                        <?php
                                        if ($CUSTOMER->profile_picture) {
                                            ?>
                                            <img src="../upload/customer/profile/<?php echo $CUSTOMER->profile_picture; ?>" id="image" class="view-edit-img img img-responsive img-thumbnail" name="profile_picture" alt="old image">
                                            <?php
                                        }
                                        ?> 

                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                    <label for="nic_number">NIC Number</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 p-bottom">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="nic_number" class="hidden-lg hidden-md">NIC Number</label>
                                            <input type="text" id="customer_nic_number"  name="nic_number" value="<?php echo $CUSTOMER->nic_number ?>" class="form-control" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                    <label for="nic_photo_front">NIC Photos</label>
                                </div>
                                <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 p-bottom">
                                    <div class="form-group">

                                        <label for="nic_photo_front" class="hidden-lg hidden-md">NIC Photo Front</label>
                                        <input type="file" id="nic_photo_front"  name="nic_photo_front"  class="form-control" autocomplete="off">

                                        <?php
                                        if ($CUSTOMER->nic_photo_front) {
                                            ?>
                                            <img src="../upload/customer/nfp/thumb/<?php echo $CUSTOMER->nic_photo_front ?>" id="image" class="view-edit-img img img-responsive img-thumbnail" name="nic_photo_front" alt="old image">
                                            <?php
                                        }
                                        ?> 

                                    </div>
                                </div>
                                <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 p-bottom">
                                    <div class="form-group">

                                        <label for="nic_photo_back" class="hidden-lg hidden-md">NIC Photo Back</label>
                                        <input type="file" id="nic_photo_back"  name="nic_photo_back"  class="form-control" autocomplete="off">
                                        <?php
                                        if ($CUSTOMER->nic_photo_back) {
                                            ?>
                                            <img src="../upload/customer/nbp/thumb/<?php echo $CUSTOMER->nic_photo_back ?>" id="image" class="view-edit-img img img-responsive img-thumbnail" name="nic_photo_back" alt="old image">
                                            <?php
                                        }
                                        ?> 

                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                    <label for="dob">Date of Birthday</label>
                                </div>

                                <div class="form-group">

                                    <label for="dob" class="hidden-lg hidden-md">Date of Birthday</label>
                                    <div class="register-form-row-col">
                                        <div class="col-md-3">
                                            <select name="month" onchange="call()" class="form-control form-line " id="month"  name="month">
                                                <option value="<?php echo $CUSTOMER->dob_month ?>"><?php
                                                    if ($CUSTOMER->dob_month == 1) {
                                                        echo 'Jan';
                                                    } elseif ($CUSTOMER->dob_month == 2) {
                                                        echo 'Feb';
                                                    } elseif ($CUSTOMER->dob_month == 3) {
                                                        echo 'Mar';
                                                    } elseif ($CUSTOMER->dob_month == 4) {
                                                        echo 'Apr';
                                                    } elseif ($CUSTOMER->dob_month == 5) {
                                                        echo 'May';
                                                    } elseif ($CUSTOMER->dob_month == 6) {
                                                        echo 'Jun';
                                                    } elseif ($CUSTOMER->dob_month == 7) {
                                                        echo 'Jul';
                                                    } elseif ($CUSTOMER->dob_month == 8) {
                                                        echo 'Aug';
                                                    } elseif ($CUSTOMER->dob_month == 9) {
                                                        echo 'Sep';
                                                    } elseif ($CUSTOMER->dob_month == 10) {
                                                        echo 'Oct';
                                                    } elseif ($CUSTOMER->dob_month == 11) {
                                                        echo 'Nov';
                                                    } else {
                                                        echo 'Dec';
                                                    }
                                                    ?></option>
                                                <option value="1">Jan</option>
                                                <option value="2">Feb</option>
                                                <option value="3">Mar</option>
                                                <option value="4">Apr</option>
                                                <option value="5">May</option>
                                                <option value="6">Jun</option>
                                                <option value="7">Jul</option>
                                                <option value="8">Aug</option>
                                                <option value="9">Sep</option>
                                                <option value="10">Oct</option>
                                                <option value="11">Nov</option>
                                                <option value="12">Dec</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <select id="day"  name="day" class="form-control form-line">
                                                <option value="<?php echo $CUSTOMER->dob_day ?>"><?php echo $CUSTOMER->dob_day ?></option>

                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <select name="year" onchange="call()" class="form-control form-line">
                                                <option value="<?php echo $CUSTOMER->dob_year ?>"><?php echo $CUSTOMER->dob_year ?></option>
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

                                            <input type="text" id="addres-bar" name="address_line_1" value="<?php echo $CUSTOMER->address_line_1 ?>" class="form-control" autocomplete="off">
                                            <input type="text" id="addres-bar"  name="address_line_2" value="<?php echo $CUSTOMER->address_line_2 ?>" class="form-control" autocomplete="off">
                                            <input type="text" id="addres-bar"  name="address_line_3" value="<?php echo $CUSTOMER->address_line_3 ?>" class="form-control" autocomplete="off">
                                            <input type="text" id="addres-bar"  name="address_line_4" value="<?php echo $CUSTOMER->address_line_4 ?>" class="form-control" autocomplete="off">
                                            <input type="text" id="addres-bar"  name="address_line_5" value="<?php echo $CUSTOMER->address_line_5 ?>" class="form-control" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                    <label for="billing_proof_image">Billing Proof Image</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 p-bottom">
                                    <div class="form-group">

                                        <label for="billing_proof_image" class="hidden-lg hidden-md">Billing Proof Image</label>
                                        <input type="file" id="billing_proof_image"  name="billing_proof_image"  class="form-control" autocomplete="off">
                                        <?php
                                        if ($CUSTOMER->billing_proof_image) {
                                            ?>
                                            <img src="../upload/customer/billing-proof/thumb/<?php echo $CUSTOMER->billing_proof_image ?>" id="image" class="view-edit-img img img-responsive img-thumbnail" name="billing_proof_image" alt="old image">
                                            <?php
                                        }
                                        ?> 

                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                    <label for="email">Email</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 p-bottom">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="email" class="hidden-lg hidden-md">Email</label>
                                            <input type="email" id="email"  name="email" value="<?php echo $CUSTOMER->email ?>" class="form-control" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                    <label for="telephone">Telephone</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 p-bottom">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="telephone" class="hidden-lg hidden-md">Telephone</label>
                                            <input type="text" id="telephone"  name="telephone" value="<?php echo $CUSTOMER->telephone ?>" class="form-control" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                    <label for="mobile">Mobile</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 p-bottom">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="mobile" class="hidden-lg hidden-md">Mobile</label>
                                            <input type="text" id="customer_moblie_number"  name="mobile" value="<?php echo $CUSTOMER->mobile ?>" class="form-control" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                    <label for="registration_type">Registration Type</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 p-bottom">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="registration_type" class="hidden-lg hidden-md">Registration Type</label>
                                            <select class="form-control" autocomplete="off" id="edit_registration_type"  name="registration_type"   >
                                                <option value="" selected=""> -- Select Registration Type -- </option>

                                                <?php if ($CUSTOMER->registration_type == "route") {
                                                    ?>
                                                    <option value="route" selected="">Route</option>
                                                    <option value="center"  >Center</option>
                                                    <option value="1">Center Leader</option>


                                                <?php } elseif ($CUSTOMER->registration_type == "center") {
                                                    ?>
                                                    <option value="center"  selected="">Center</option>
                                                    <option value="route" >Route</option>
                                                    <option value="1">Center Leader</option>

                                                <?php } elseif ($CUSTOMER->registration_type == 1) {
                                                    ?>
                                                    <option value="1" selected="">Center Leader</option>
                                                    <option value="center"  >Center</option>
                                                    <option value="route" >Route</option>


                                                <?php } else { ?>
                                                    <option value="route" >Route</option>
                                                    <option value="center"  >Center</option>
                                                    <option value="1">Center Leader</option>

                                                <?php }
                                                ?>

                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php
                            if ($CUSTOMER->route != 0) {
                                ?>
                                <div class="row" id="route_row">
                                    <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                        <label for="route">Route</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="route" class="hidden-lg hidden-md">Route</label>
                                                <select class="form-control" autocomplete="off" id="route"  name="route">  
                                                    <?php
                                                    foreach ($ROUTE as $route) {
                                                        if ($route['id'] == $CUSTOMER->route) {
                                                            ?>
                                                            <option value="<?php echo $route['id'] ?>" selected=""> <?php echo $route['name'] ?></option>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <option value="<?php echo $route['id'] ?>" > <?php echo $route['name'] ?></option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row" style="display: none" id="center_row">
                                    <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                        <label for="center">Center</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="center" class="hidden-lg hidden-md">Center</label>
                                                <select class="form-control" autocomplete="off" id="center"  name="center">  
                                                    <option> -- Please Select a Center -- </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <?php
                            } elseif ($CUSTOMER->center) {
                                ?>

                                <div class="row" id="center_row">
                                    <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                        <label for="center">Center</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="center" class="hidden-lg hidden-md">Center</label>
                                                <select class="form-control" autocomplete="off" id="center"  name="center">  
                                                    <?php
                                                    foreach ($CENTER as $center) {
                                                        if ($center['id'] == $CUSTOMER->center) {
                                                            ?>
                                                            <option value="<?php echo $center['id'] ?>" selected=""> <?php echo $center['name'] ?></option>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <option value="<?php echo $center['id'] ?>"> <?php echo $center['name'] ?></option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row" style="display: none" id="route_row">
                                    <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                        <label for="route">Route</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="route" class="hidden-lg hidden-md">Route</label>
                                                <select class="form-control" autocomplete="off" id="route"  name="route">  
                                                    <option> -- Please Select a Route -- </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            <?php } ?>  

                            <div class="row">
                                <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                    <label for="city">City </label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 p-bottom">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="city" class="hidden-lg hidden-md">City</label>
                                            <select class="form-control" autocomplete="off" id="city_name"  name="city"   > 
                                                <?php
                                                $CITY = new City($CUSTOMER->city);
                                                ?>
                                                <option select="true" value="<?php echo $CITY->id ?>"> <?php echo $CITY->name ?></option>
                                                <?php
                                                $CITY = City::all();
                                                foreach ($CITY as $city) {
                                                    ?>

                                                    <option select="true" value="<?php echo $city['id'] ?>"> <?php echo $city['name'] ?></option>
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
                                    <label for="credit_limit">Credit Limit</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 p-bottom">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="credit_limit" class="hidden-lg hidden-md">Credit Limit</label>
                                            <input type="text" id="loan_amount"  name="credit_limit" value="<?php echo $CUSTOMER->credit_limit ?>" class="form-control" max="" autocomplete="off" min="0"   >
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                    <label for="signature_image">Signature Image</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 p-bottom">
                                    <div class="form-group">

                                        <label for="signature_image" class="hidden-lg hidden-md">Signature Image</label>
                                        <input type="file" id="bank_book_picture"  name="signature_image"  class="form-control" autocomplete="off">
                                        <?php
                                        if ($CUSTOMER->signature_image) {
                                            ?>
                                            <img src="../upload/customer/signature/thumb/<?php echo $CUSTOMER->signature_image ?>" id="image" class="view-edit-img img img-responsive img-thumbnail" name="bank_book_picture" alt="old image">
                                            <?php
                                        }
                                        ?> 

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                    <label for="business_name">Business Name</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 p-bottom">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="business_name" class="hidden-lg hidden-md">Business Name</label>
                                            <input type="text" id="business_name"  name="business_name" value="<?php echo $CUSTOMER->business_name ?>" class="form-control" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                    <label for="br_number">BR Number</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 p-bottom">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="br_number" class="hidden-lg hidden-md">BR Number</label>
                                            <input type="text" id="br_number"  name="br_number" value="<?php echo $CUSTOMER->br_number ?>" class="form-control" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                    <label for="nature_of_business">Nature of Bsiness</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 p-bottom">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="nature_of_business" class="hidden-lg hidden-md">Nature of Bsiness</label>
                                            <input type="text" id="nature_of_business"  name="nature_of_business" value="<?php echo $CUSTOMER->nature_of_business ?>" class="form-control" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                    <label for="br_picture">BR Photo</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 p-bottom">
                                    <div class="form-group">

                                        <label for="br_picture" class="hidden-lg hidden-md">BR Photo</label>
                                        <input type="file" id="bank_book_picture"  name="br_picture"  class="form-control" autocomplete="off">
                                        <?php
                                        if ($CUSTOMER->br_picture) {
                                            ?>
                                            <img src="../upload/customer/br/thumb/<?php echo $CUSTOMER->br_picture ?>" id="image" class="view-edit-img img img-responsive img-thumbnail" name="bank_book_picture" alt="old image">
                                            <?php
                                        }
                                        ?> 

                                    </div>
                                </div>
                            </div>




                            <div class="row">
                                <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                    <label for="bank">Bank  </label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 p-bottom">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="bank" class="hidden-lg hidden-md">Bank  </label>
                                            <select class="form-control" autocomplete="off" id="bank_id"  name="bank" > 
                                                <option>--Please Select other Bank--</option>
                                                <?php
                                                $BANK = new Bank(NULL);
                                                foreach ($BANK->all() as $bank) {
                                                    if ($CUSTOMER->bank == $bank['id']) {
                                                        ?> 
                                                        <option value="<?php echo $bank['id'] ?>" selected="TRUE"><?php echo $bank['name'] ?> </option> 
                                                        <?php
                                                    } else {
                                                        ?> 
                                                        <option value="<?php echo $bank['id'] ?>"><?php echo $bank['name'] ?> </option> 
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row" id="branch_row">
                                <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                    <label for="branch">Branch</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 p-bottom">
                                    <div class="form-group"branch>
                                        <div class="form-line">
                                            <label for="branch" class="hidden-lg hidden-md">Branch</label>
                                            <select class="form-control" autocomplete="off" id="branch"  name="branch">  
                                                <?php
                                                $BRANCH = new Branch(Null);
                                                $branchs = $BRANCH->getBrachByBank($CUSTOMER->bank);
                                                foreach ($branchs as $branch) {
                                                    if ($branch['id'] == $CUSTOMER->branch) {
                                                        ?>
                                                        <option value="<?php echo $branch['id'] ?>" selected="TRUE"><?php echo $branch['name'] ?></option>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <option value="<?php echo $branch['id'] ?>"><?php echo $branch['name'] ?></option>
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
                                    <label for="branch_code">Branch Code</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 p-bottom">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="branch_code" class="hidden-lg hidden-md">Branch Code</label>
                                            <input type="text" id="branch_code"  name="branch_code" value="<?php echo $CUSTOMER->branch_code ?>" class="form-control" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                    <label for="account_number">Account Number</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 p-bottom">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="account_number" class="hidden-lg hidden-md">Account Number</label>
                                            <input type="text" id="account_number"  name="account_number" value="<?php echo $CUSTOMER->account_number ?>" class="form-control" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                    <label for="holder_name">Holder Name</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 p-bottom">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="holder_name" class="hidden-lg hidden-md">Holder Name</label>
                                            <input type="text" id="holder_name"  name="holder_name" value="<?php echo $CUSTOMER->holder_name ?>" class="form-control" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                    <label for="bank_book_picture">Bank Book Photo</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 p-bottom">
                                    <div class="form-group">

                                        <label for="bank_book_picture" class="hidden-lg hidden-md">Bank Book Photo</label>
                                        <input type="file" id="bank_book_picture"  name="bank_book_picture"  class="form-control" autocomplete="off">
                                        <?php
                                        if ($CUSTOMER->bank_book_picture) {
                                            ?>
                                            <img src="../upload/customer/bbp/thumb/<?php echo $CUSTOMER->bank_book_picture ?>" id="image" class="view-edit-img img img-responsive img-thumbnail" name="bank_book_picture" alt="old image">
                                            <?php
                                        }
                                        ?> 

                                    </div>
                                </div>
                            </div>

                            <div class="row clearfix">
                                <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">

                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 padd-bottom">
                                    <div class="form-group">
                                        <div class=" p-top ">
                                            <input class="filled-in chk-col-pink" type="checkbox" <?php
                                            if ($CUSTOMER->is_active == 1) {
                                                echo 'checked';
                                            }
                                            ?> name="is_active" value="1" id="rememberme" />
                                            <label for="rememberme" id="lable-active">Activate</label> </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row clearfix">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5">  

                                </div>  
                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7"> 
                                    <button class="btn btn-primary m-t-15 waves-effect  pull-left " type="submit" name="update" >Update</button>
                                    <input type="hidden" name="update_input" value="update"/>
                                    <input type="hidden" id="id" value="<?php echo $CUSTOMER->id; ?>" name="id"/>
                                    <input type="hidden" id="oldImageName" value="<?php echo $CUSTOMER->profile_picture; ?>" name="oldImageName"/>
                                    <input type="hidden" id="oldImageNameBank" value="<?php echo $CUSTOMER->br_picture; ?>" name="oldImageNameBank"/>
                                    <input type="hidden" id="oldImageNameNfp" value="<?php echo $CUSTOMER->nic_photo_front; ?>" name="oldImageNameNfp"/>
                                    <input type="hidden" id="oldImageNameNbp" value="<?php echo $CUSTOMER->nic_photo_back; ?>" name="oldImageNameNbp"/>
                                    <input type="hidden" id="oldImageNameBBP" value="<?php echo $CUSTOMER->bank_book_picture; ?>" name="oldImageNameBBP"/> 
                                    <input type="hidden" id="oldImageNameSP" value="<?php echo $CUSTOMER->signature_image; ?>" name="oldImageNameSP"/> 
                                    <input type="hidden" id="oldImageNameSP" value="<?php echo $CUSTOMER->billing_proof_image; ?>" name="oldImageNameBI"/> 

                                    <div class=" text-danger btn-padding pull-left error-mess" id="message" ></div> 
                                </div>
                            </div> 
                            <input type="hidden" id="errors" value="1"/>
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
        <script src="plugins/sweetalert/sweetalert.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="js/birthday_script.js" type="text/javascript"></script>
        <script src="js/ajax/loan.js" type="text/javascript"></script>
        <script src="js/ajax/customer.js" type="text/javascript"></script> 

    </body>

</html>