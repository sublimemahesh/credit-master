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

        <title>Add New Customer || Credit Master</title>
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
        <link href="css/custom.css" rel="stylesheet" type="text/css"/>

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
                <form action="post-and-get/customer.php" method="post" id="customerform" enctype="multipart/form-data"> 
                    <div class="card">
                        <div class="header">
                            <h2>Add Customer Details</h2>
                            <ul class="header-dropdown">
                                <li class="">
                                    <a href="view-active-customer.php">
                                        <i class="material-icons">list</i> 
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="body">

                            <div class="row">
                                <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                    <label for="title">Title <span class="color-red"> *</span></label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 p-bottom">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="title" class="hidden-lg hidden-md">Title <span class="color-red"> *</span></label>
                                            <select id="title" name="title" class="form-control" required="TRUE">
                                                <option value=""> -- Please Select -- </option>
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
                                    <label for="first_name">First Name<span class="color-red"> *</span></label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 p-bottom">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="first_name" class="hidden-lg hidden-md">First Name <span class="color-red"> *</span></label>
                                            <input type="text" id="first_name"  name="first_name" required="TRUE" placeholder="Enter First Name" class="form-control" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                            </div> 

                            <div class="row">
                                <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                    <label for="last_name">Last Name  </label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 p-bottom">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="last_name" class="hidden-lg hidden-md">Last Name  </label>
                                            <input type="text" id="last_name"  name="last_name"   placeholder="Enter Last Name" class="form-control" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                            </div> 

                            <div class="row">
                                <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                    <label for="surname">Surname<span class="color-red"> *</span></label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 p-bottom">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="surname" class="hidden-lg hidden-md">Surname <span class="color-red"> *</span></label>
                                            <input type="text" id="surname"  name="surname" required="TRUE" placeholder="Enter Surname" class="form-control" autocomplete="off"  >
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
                                        <div class="form-line">
                                            <label for="profile_picture" class="hidden-lg hidden-md">Profile Picture</label>
                                            <input type="file" id="profile_picture"  name="profile_picture" class="form-control" autocomplete="off"  >
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                    <label for="nic_number">NIC Number <span class="color-red"> *</span></label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 p-bottom">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="nic_number" class="hidden-lg hidden-md">NIC Number <span class="color-red"> *</span></label>
                                            <input type="text" id="customer-nic" required="TRUE" name="nic_number" placeholder="Enter NIC Number" class="form-control" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                    <label for="nic_photo_front">NIC Photos(F/B)</label>
                                </div>
                                <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 p-bottom">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="nic_photo_front" class="hidden-lg hidden-md">NIC Photo Front</label>
                                            <input type="file" id="nic_photo_front"  name="nic_photo_front"  class="form-control" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 p-bottom">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="nic_photo_back" class="hidden-lg hidden-md">NIC Photo Back</label>
                                            <input type="file" id="nic_photo_back"  name="nic_photo_back"  class="form-control" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                    <label for="dob">Date of Birthday <span class="color-red"> *</span></label>
                                </div>
                                <div class="col-lg-10 col-md-10">
                                    <div class="form-group"> 
                                        <label for="dob" class="hidden-lg hidden-md">Date of Birthday <span class="color-red"> *</span></label> 
                                        <div class="col-md-4">
                                            <select name="month" onchange="call()" class="form-control form-line" id="month"  name="month"  required="TRUE">
                                                <option value=""> - Select Month - </option>
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
                                        <div class="col-md-4">
                                            <select id="day"  name="day" class="form-control form-line"  required="TRUE" >
                                                <option value=""> - Select Day - </option> 
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <select id="year" name="year" onchange="call()" class="form-control form-line" required="TRUE" >
                                                <option value=""> - Select  Year - </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                    <label for="address">Address <span class="color-red"> *</span></label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 p-bottom">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="address" class="hidden-lg hidden-md">Address <span class="color-red"> *</span></label>
                                            <input type="text" id="address"  name="address_line_1" required="TRUE" placeholder=" Address Line 1" class="form-control" autocomplete="off">
                                            <input type="text" id="address"  name="address_line_2"   placeholder=" Address Line 2" class="form-control" autocomplete="off" required="TRUE">
                                            <input type="text" id="address"  name="address_line_3" placeholder=" Address Line 3" class="form-control" autocomplete="off">
                                            <input type="text" id="address"  name="address_line_4" placeholder=" Address Line 4" class="form-control" autocomplete="off">
                                            <input type="text" id="address"  name="address_line_5" placeholder=" Address Line 5" class="form-control" autocomplete="off">
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
                                        <div class="form-line">
                                            <label for="billing_proof_image" class="hidden-lg hidden-md">Billing Proof Image</label>
                                            <input type="file" id="billing_proof_image"  name="billing_proof_image" class="form-control" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                    <label for="city_name">City<span class="color-red"> *</span></label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 p-bottom">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="city_name" class="hidden-lg hidden-md">City<span class="color-red"> *</span></label>
                                            <select class="form-control" autocomplete="off" id="city_name"  name="city"  required="TRUE" >
                                                <option selected="" value=""> - Select the City - </option>
                                                <?php
                                                $CITY = City::all();
                                                foreach ($CITY as $city) {
                                                    ?>
                                                    <option select="true" value="<?php echo $city['id'] ?>" required="true" > <?php echo $city['name'] ?></option>
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
                                    <label for="email">Email</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 p-bottom">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="email" class="hidden-lg hidden-md">Email</label>
                                            <input type="email" id="email"  name="email" placeholder="Enter Email" class="form-control" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                    <label for="mobile">Mobile<span class="color-red"> *</span></label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 p-bottom">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="mobile" class="hidden-lg hidden-md">Mobile<span class="color-red"> *</span></label>
                                            <input type="text" id="moblie_number"  name="mobile" required="TRUE" placeholder="Enter Mobile" class="form-control" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-2 col-md-3 hidden-sm hidden-xs form-control-label">
                                    <label for="telephone1">Telephone</label>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 p-bottom">
                                    <div class="form-group">
                                        <div class="form-line"> 
                                            <label for="telephone1" class="hidden-lg hidden-md">Telephone</label>
                                            <input type="text" id="telephone1"  name="telephone1" placeholder="Enter Telephone Number 1" class="form-control" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 p-bottom">
                                    <div class="form-group">
                                        <div class="form-line"> 
                                            <input type="text" id="telephone2"  name="telephone2" placeholder="Enter Telephone Number 2" class="form-control" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 p-bottom">
                                    <div class="form-group">
                                        <div class="form-line"> 
                                            <input type="text" id="telephone3"  name="telephone3" placeholder="Enter Telephone Number 3" class="form-control" autocomplete="off">
                                        </div>
                                    </div>
                                </div> 
                            </div>

                            <div class="row">
                                <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                    <label for="registration_type">Registration Type<span class="color-red"> *</span></label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 p-bottom">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="registration_type" class="hidden-lg hidden-md">Registration Type<span class="color-red"> *</span></label>
                                            <select class="form-control" autocomplete="off" id="registration_type"  name="registration_type" required="TRUE"  >
                                                <option value=""> -- Select Registration Type -- </option>
                                                <option  value="route">Route</option>
                                                <option value="center">Center</option>
                                                <option value="1">Center Leader</option>
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
                                            <select class="form-control" autocomplete="off" id="route"  name="route" required="true">  
                                                <option> -- Please Select a Route -- </option>
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
                                            <select class="form-control" autocomplete="off" id="center"  name="center" required="true">  
                                                <option> -- Please Select a Center -- </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                    <label for="credit_limit">Credit Limit<span class="color-red"> *</span></label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 p-bottom">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="credit_limit" class="hidden-lg hidden-md">Credit Limit<span class="color-red"> *</span></label>
                                            <input type="number" id="credit_limit" value="<?php echo DefaultData::getCreditLimit(); ?>"name="credit_limit" required="TRUE" placeholder="Enter Credit Limit" class="form-control" autocomplete="off" max="<?php echo DefaultData::getCreditLimit(); ?>" step="0.001" >
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
                                        <div class="form-line">
                                            <label for="signature_image" class="hidden-lg hidden-md">Signature Image</label>
                                            <input type="file" id="signature_image"  name="signature_image" class="form-control" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                            </div> 
                        </div>
                    </div>

                    <div class="card">
                        <div class="header">
                            <h2>Add Business Details</h2>
                            <ul class="header-dropdown">
                                <li class="">
                                    <a href="view-active-customer.php">
                                        <i class="material-icons">list</i> 
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="row">
                                <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                    <label for="business_name">Business Name</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 p-bottom">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="business_name" class="hidden-lg hidden-md">Business Name</label>
                                            <input type="text" id="business_name"  name="business_name" placeholder="Enter Business Name" class="form-control" autocomplete="off">
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
                                            <input type="text" id="br_number"  name="br_number" placeholder="Enter BR Number" class="form-control" autocomplete="off">
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
                                            <input type="text" id="nature_of_business"  name="nature_of_business" placeholder="Enter Nature of Bsiness" class="form-control" autocomplete="off">
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
                                        <div class="form-line">
                                            <label for="br_picture" class="hidden-lg hidden-md">BR Photo</label>
                                            <input type="file" id="br_picture"  name="br_picture" class="form-control" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="header">
                            <h2>Add Bank Details</h2>
                            <ul class="header-dropdown">
                                <li class="">
                                    <a href="view-active-customer.php">
                                        <i class="material-icons">list</i> 
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="body">

                            <div class="row">
                                <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                    <label for="bank">Bank  </label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 p-bottom">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="bank" class="hidden-lg hidden-md">Bank  </label>
                                            <select class="form-control" autocomplete="off" id="bank_id"  name="bank" >
                                                <option value=""> -- Select the Bank -- </option> 
                                                <?php
                                                $BANK = new Bank(NULL);
                                                foreach ($BANK->all() as $bank) {
                                                    ?>

                                                    <option value="<?php echo $bank['id'] ?>"><?php echo $bank['name'] ?> </option> 
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="row" style="display: none" id="branch_row">
                                <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                    <label for="branch">Branch</label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 p-bottom">
                                    <div class="form-group"branch>
                                        <div class="form-line">
                                            <label for="branch" class="hidden-lg hidden-md">Branch</label>
                                            <select class="form-control" autocomplete="off" id="branch"  name="branch">  
                                                <option> -- Please Select a Branch -- </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-1 col-lg-1">
                                    <input
                                        type="button" class="btn btn-primary" data-toggle="modal"  value="+" data-target="#exampleModalCenter">
                                    <!--                                                                      <a href="add-new-bank.php" class="btn btn-md">+</a>-->
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
                                            <input type="text" id="branch_code"  name="branch_code" placeholder="Enter Branch Code" class="form-control" autocomplete="off">
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
                                            <input type="text" id="account_number"  name="account_number" placeholder="Enter Account Number" class="form-control" autocomplete="off">
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
                                            <input type="text" id="holder_name"  name="holder_name" placeholder="Enter Holder Name" class="form-control" autocomplete="off">
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
                                        <div class="form-line">
                                            <label for="bank_book_picture" class="hidden-lg hidden-md">Bank Book Photo</label>
                                            <input type="file" id="bank_book_picture"  name="bank_book_picture"  class="form-control" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row clearfix">
                                <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">

                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 padd-bottom">
                                    <div class="form-group">
                                        <div class=" p-top ">
                                            <input class="filled-in chk-col-pink" type="checkbox" name="is_active" value="1" id="rememberme" checked="TRUE"/>
                                            <label for="rememberme" id="lable-active">Activate</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5"> 

                                </div>  
                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7 mar-gin">
                                    <input type="hidden" id="errors" value="1"/>
                                    <button class="btn btn-primary m-t-15 waves-effect  pull-left check-customer" type="submit" name="add-cus">Save Details</button>
                                    <input type="hidden" name="add-customer" value="add-customer"/>
                                    <div class=" text-danger btn-padding pull-left error-mess" id="message" ></div> 
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
        <!-- Modal -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">

                <div class="card">
                    <div class="header">
                        <h2>Add New Branch</h2>
                        <ul class="header-dropdown">
                            <li class="">
                                <a href="add-new-bank.php">
                                    <i class="material-icons">list</i> 
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        <div class="row">
                            <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                <label for="name">Bank Name</label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="selected_bank" bankId="" value="" name="selected_bank_name"  class="form-control" autocomplete="off" readonly>
                                    </div>
                                </div>
                            </div>
                        </div> 
                        <div class="row">
                            <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label">
                                <label for="name">Branch Name</label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="new_branch"  name="newbranchname" placeholder="Enter Branch Name" class="form-control" required autocomplete="off"  >
                                    </div>
                                </div>
                            </div>
                        </div> 
                        <div class="row text-right">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" id="add-new-branch" class="btn btn-primary">Save changes</button>
                        </div>

                    </div>
                </div> 


            </div>
        </div>

        <!-- Jquery Core Js -->
        <script src="plugins/jquery/jquery.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> 
        <script src="plugins/bootstrap/js/bootstrap.js"></script> 
        <script src="plugins/jquery-slimscroll/jquery.slimscroll.js"></script>
        <script src="plugins/node-waves/waves.js"></script>
        <script src="plugins/jquery-spinner/js/jquery.spinner.js"></script>
        <script src="plugins/sweetalert/sweetalert.min.js"></script>
        <script src="js/admin.js"></script>
        <script src="js/demo.js"></script>  
        <script src="js/birthday_script.js" type="text/javascript"></script>
        <script src="js/ajax/customer.js" type="text/javascript"></script> 

    </body>

</html> 