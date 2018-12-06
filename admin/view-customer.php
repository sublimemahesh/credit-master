<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/auth.php');

$CUSTOMER = new Customer($_GET['id']);
?>

<!DOCTYPE html>
<html> 
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

        <title>View Customer || Credit Master</title>
        <!-- Favicon-->
        <link rel="icon" href="favicon.ico" type="image/x-icon">
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
        <link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
        <link href="plugins/node-waves/waves.css" rel="stylesheet" />
        <link href="plugins/animate-css/animate.css" rel="stylesheet" />
        <link href="plugins/light-gallery/css/lightgallery.css" rel="stylesheet">
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
                        <h2>View Customer (# <?php echo $CUSTOMER->id; ?>)</h2>
                        <ul class="header-dropdown">
                            <li class="">
                                <a href="view-active-customer.php">
                                    <i class="material-icons">list</i> 
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        <form class="" action="post-and-get/customer.php" method="post"  enctype="multipart/form-data"> 

                            <div class="row">
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                            <label for="title">Title</label>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                            <div class="form-group">
                                                <div class="form-line"> 
                                                    <label  class="hidden-lg hidden-md">Title</label>
                                                    <div class="form-control"><?php echo $CUSTOMER->title; ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                            <label for="first_name">First Name</label>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                            <div class="form-group">
                                                <div class="form-line"> 
                                                    <label  class="hidden-lg hidden-md">First Name</label>
                                                    <div class="form-control"><?php echo $CUSTOMER->first_name; ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 

                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                            <label for="last_name">Last Name</label>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                            <div class="form-group">
                                                <div class="form-line"> 
                                                    <label  class="hidden-lg hidden-md">Last Name</label>
                                                    <div class="form-control"><?php echo $CUSTOMER->last_name; ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 

                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                            <label for="surname">Surname</label>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                            <div class="form-group">
                                                <div class="form-line"> 
                                                    <label  class="hidden-lg hidden-md">Surname</label>
                                                    <div class="form-control"><?php echo $CUSTOMER->surname; ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 

                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                            <label for="nic_number">NIC Number</label>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                            <div class="form-group">
                                                <div class="form-line"> 
                                                    <label  class="hidden-lg hidden-md">NIC Number</label>
                                                    <div class="form-control"><?php echo $CUSTOMER->nic_number; ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-lg-4 col-md-4 hidden-sm hidden-xs  ">
                                    <label for="nic_photo_front">Profile Picture</label>
                                </div>

                                <div class="p-bottom">
                                    <div class="form-group">                                         
                                        <label for="nic_photo_back" class="hidden-lg hidden-md">Profile Picture</label>
                                        <div   class="list-unstyled row clearfix aniimated-thumbnials ">
                                            <a href="../upload/customer/profile/<?php echo $CUSTOMER->profile_picture; ?>" data-sub-html=" ">
                                                <img class="img-responsive thumbnail" src="../upload/customer/profile/<?php echo $CUSTOMER->profile_picture; ?>">
                                            </a> 
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="row" class="list-unstyled   clearfix col-md-4">
                                <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                    <label for="nic_photo_front">NIC Photos</label>
                                </div>
                                <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 p-bottom">
                                    <div class="form-group">
                                        <div  class="list-unstyled   clearfix aniimated-thumbnials">
                                            <label for="nic_photo_front" class="hidden-lg hidden-md">NIC Photo Front</label>
                                            <a href="../upload/customer/nfp/<?php echo $CUSTOMER->nic_photo_front; ?>" data-sub-html=" ">
                                                <img class="img-responsive thumbnail" src="../upload/customer/nfp/thumb/<?php echo $CUSTOMER->nic_photo_front; ?>">
                                            </a> 
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 p-bottom">
                                    <div class="form-group">
                                        <div  class="list-unstyled  clearfix aniimated-thumbnials">
                                            <label for="nic_photo_back" class="hidden-lg hidden-md">NIC Photo Back</label>
                                            <a href="../upload/customer/nbp/<?php echo $CUSTOMER->nic_photo_back; ?>" data-sub-html=" ">
                                                <img class="img-responsive thumbnail" src="../upload/customer/nbp/thumb/<?php echo $CUSTOMER->nic_photo_back; ?>">
                                            </a> 
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                    <label for="dob">Date of Birthday</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 p-bottom">
                                    <div class="form-group">
                                        <div class="">
                                            <label for="dob" class="hidden-lg hidden-md">Date of Birthday</label>
                                            <div class="register-form-row-col">
                                                <div class="col-md-4">
                                                    <select name="month" onchange="call()" class="form-control form-line" id="month"  name="month" disabled="">
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
                                                    <select id="day"  name="day" class="form-control form-line" disabled="">
                                                        <option value="<?php echo $CUSTOMER->dob_day ?>"><?php echo $CUSTOMER->dob_day ?></option>

                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <select name="year" onchange="call()" class="form-control form-line" disabled="">
                                                        <option value="<?php echo $CUSTOMER->dob_year ?>"><?php echo $CUSTOMER->dob_year ?></option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-2 col-md-2hidden-sm hidden-xs form-control-label">
                                    <label >Address</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 p-bottom">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label  class="hidden-lg hidden-md">Address</label>
                                            <div class="form-control  " id="addres-bar"><?php echo $CUSTOMER->address_line_1; ?></div>
                                            <div class="form-control  " id="addres-bar"><?php echo $CUSTOMER->address_line_2; ?></div>
                                            <div class="form-control  " id="addres-bar"><?php echo $CUSTOMER->address_line_3; ?></div>
                                            <div class="form-control " id="addres-bar"><?php echo $CUSTOMER->address_line_4; ?></div>
                                            <div class="form-control  " id="addres-bar"><?php echo $CUSTOMER->address_line_5; ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row" class="list-unstyled   clearfix col-md-4">
                                <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                    <label for="billing_proof_image">Billing Proof Image</label>
                                </div>
                                <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 p-bottom">
                                    <div class="form-group">
                                        <div  class="list-unstyled   clearfix aniimated-thumbnials">
                                            <label for="billing_proof_image" class="hidden-lg hidden-md">Billing Proof Image</label>
                                            <a href="../upload/customer/billing-proof/<?php echo $CUSTOMER->billing_proof_image ?>" data-sub-html=" ">
                                                <img class="img-responsive thumbnail" src="../upload/customer/billing-proof/thumb/<?php echo $CUSTOMER->billing_proof_image ?>">
                                            </a> 
                                        </div>
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
                                            <div class="form-control"><?php echo $CUSTOMER->email; ?></div>
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
                                            <div class="form-control"><?php echo $CUSTOMER->telephone; ?></div>
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
                                            <div class="form-control"><?php echo $CUSTOMER->mobile; ?></div>
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
                                            <div class="form-control"><?php
                                                if ($CUSTOMER->registration_type == 1) {
                                                    echo " Center Leader";
                                                } else {
                                                    echo  ucfirst($CUSTOMER->registration_type);
                                                }
                                                ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                            $ROUTE = new Route($CUSTOMER->route);
                            if ($ROUTE->id == $CUSTOMER->route) {
                                ?>
                                <div class="row">
                                    <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                        <label for="route">Route</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="route" class="hidden-lg hidden-md">Route</label>
                                                <div class="form-control">
                                                    <?php
                                                    echo $ROUTE->name;
                                                    ?>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <?php
                            } elseif ($CUSTOMER->center) {
                                ?>
                                <div class="row">
                                    <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                        <label for="center">Center</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 p-bottom">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="center" class="hidden-lg hidden-md">Center</label>
                                                <div class="form-control"><?php
                                                    $CENTER = new Center($CUSTOMER->center);
                                                    echo $CENTER->name;
                                                    ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>

                            <div class="row">
                                <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                    <label for="city">City</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 p-bottom">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="city" class="hidden-lg hidden-md">City</label>
                                            <div class="form-control"><?php
                                                $CITY = new City($CUSTOMER->city);
                                                echo $CITY->name;
                                                ?></div>
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
                                            <div class="form-control"><?php echo $CUSTOMER->credit_limit; ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row" class="list-unstyled   clearfix col-md-4">
                                <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                    <label for="signature_photo">Signature Photo</label>
                                </div>
                                <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 p-bottom">
                                    <div class="form-group">
                                        <div  class="list-unstyled   clearfix aniimated-thumbnials">
                                            <label for="signature_photo" class="hidden-lg hidden-md">Signature Photo</label>
                                            <a href="../upload/customer/signature/<?php echo $CUSTOMER->signature_image; ?>" data-sub-html="Signature Photo">
                                                <img class="img-responsive thumbnail" src="../upload/customer/signature/thumb/<?php echo $CUSTOMER->signature_image; ?>">
                                            </a> 
                                        </div>
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
                                            <div class="form-control"><?php echo $CUSTOMER->business_name; ?></div>
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
                                            <div class="form-control"><?php echo $CUSTOMER->br_number; ?></div>
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
                                            <div class="form-control"><?php echo $CUSTOMER->nature_of_business; ?></div>
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

                                        <div  class="list-unstyled   clearfix aniimated-thumbnials">
                                            <label for="br_picture" class="hidden-lg hidden-md">BR Photo</label>
                                            <?php if (empty($CUSTOMER->br_picture)) {
                                                ?>
                                                <img class="img-responsive thumbnail" src="../upload/sample-br.jpg">

                                            <?php } else { ?>

                                                <a href="../upload/customer/br/<?php echo $CUSTOMER->br_picture ?>" data-sub-html=" ">
                                                    <img class="img-responsive thumbnail" src="../upload/customer/br/thumb/<?php echo $CUSTOMER->br_picture ?>">
                                                </a>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                    <label for="bank">Bank</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 p-bottom">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="bank" class="hidden-lg hidden-md">Bank</label>
                                            <div class="form-control">
                                                <?php
                                                $BANK = new Bank($CUSTOMER->bank);
                                                echo $BANK->name;
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                    <label for="branch">Branch</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 p-bottom">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="branch" class="hidden-lg hidden-md">Branch</label>
                                            <div class="form-control">
                                                <?php
                                                $BRANCH = new Branch($CUSTOMER->branch);
                                                echo $BRANCH->name;
                                                ?>
                                            </div>
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
                                            <div class="form-control"><?php echo $CUSTOMER->branch_code; ?></div>
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
                                            <div class="form-control"><?php echo $CUSTOMER->account_number; ?></div>
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
                                            <div class="form-control"><?php echo $CUSTOMER->holder_name; ?></div>
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
                                        <div class=" clearfix aniimated-thumbnials">
                                            <label for="bank_book_picture" class="hidden-lg hidden-md">Bank Book Photo</label>
                                            <a href="../upload/customer/bbp/<?php echo $CUSTOMER->bank_book_picture; ?>" data-sub-html=" ">
                                                <img class="img-responsive thumbnail" src="../upload/customer/bbp/thumb/<?php echo $CUSTOMER->bank_book_picture; ?>">
                                            </a>  
                                        </div>
                                    </div>
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
        <script src="js/image.js" type="text/javascript"></script>
        <script src="plugins/light-gallery/js/lightgallery-all.js"></script>
        <script src="js/admin.js"></script>
        <script src="js/demo.js"></script> 
        <script src="js/birthday_script.js" type="text/javascript"></script>
    </body>

</html>