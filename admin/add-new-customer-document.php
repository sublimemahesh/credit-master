<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/auth.php');

$id = $_GET['id'];
$CUSTOMER = new Customer($id);
?> 

<!DOCTYPE html>
<html> 
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

        <title>Add Customer Photo || Credit Master</title>
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
        <link href="plugins/light-gallery/css/lightgallery.css" rel="stylesheet">
        <!-- Bootstrap Spinner Css -->
        <link href="plugins/jquery-spinner/css/bootstrap-spinner.css" rel="stylesheet">        
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

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
                <form class="" action="post-and-get/customer-document.php" method="post"  enctype="multipart/form-data"> 

                    <div class="card">
                        <div class="header">
                            <h2><?php echo $CUSTOMER->surname.' '.$CUSTOMER->first_name.' '.$CUSTOMER->last_name?>  Customer Details</h2>
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
                                    <label for="caption">Caption</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 p-bottom">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="caption" class="hidden-lg hidden-md">Caption</label>
                                            <input type="text" id="caption"  name="caption" placeholder="Enter Caption" class="form-control" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                            </div> 

                            <div class="row">
                                <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                    <label for="customer_photo">Customer Photo</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 p-bottom">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="customer_photo" class="hidden-lg hidden-md">Customer Photo</label>
                                            <input type="file" id="br_picture"  name="image_name" class="form-control" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row clearfix">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5">  
                                </div>  
                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                    <button class="btn btn-primary m-t-15 waves-effect  pull-left" type="submit" name="create">Save Details</button>
                                    <input type="hidden" name="id" value="<?php echo $id ?>"/>
                                    <div class="text-danger btn-padding pull-left error-mess" id="message" ></div> 
                                </div>
                            </div>
                        </div>
                    </div>
                </form> 


                <div class="card">
                    <div class="header">
                        <h2>Customer Document</h2>

                    </div>
                    <div class="body">
                        <div class="row">
                            <div class="form-line clearfix aniimated-thumbnials"> 
                                <?php
                                $COUSTMER_DOCUMENT = new CustomerDocument(NUll);
                                foreach ($COUSTMER_DOCUMENT->getDocumentByCustomer($id) as $customerdocument) {
                                    ?>
                                    <div class="col-md-3"> 
                                        <a href="../upload/customer/document/<?php echo $customerdocument['image_name'] ?>" data-sub-html="<?php echo $customerdocument['caption']?>">
                                            <img class="img-responsive thumbnail" src="../upload/customer/document/thumb/<?php echo $customerdocument['image_name'] ?>">
                                        </a> 



                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>

                </div>
        </section>

        <!-- Jquery Core Js -->
        <script src="plugins/jquery/jquery.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> 
        <script src="plugins/bootstrap/js/bootstrap.js"></script> 
        <script src="plugins/jquery-slimscroll/jquery.slimscroll.js"></script>
        <script src="plugins/node-waves/waves.js"></script>
        <script src="plugins/jquery-spinner/js/jquery.spinner.js"></script>
        <script src="js/image.js" type="text/javascript"></script>
        <script src="plugins/light-gallery/js/lightgallery-all.js"></script>
        <script src="js/admin.js"></script>
        <script src="js/demo.js"></script>  
        <script src="js/birthday_script.js" type="text/javascript"></script>
        <script src="js/ajax/customer.js" type="text/javascript"></script> 
    </body>

</html> 