<?php
include_once(dirname(__FILE__) . '/../class/include.php');

//if (Input::exists()) {
//    $validate = new Validator();
//    $validation = $validate->check($_POST, array('username' => array(
//    'name' => 'username',
//    'required' => true,
//    'min' => 2,
//    'max' => 20,
//    'unique' => 'user'),
//    'password' => array (
//    'required' => true,
//    'min' => 6),
//    ));
//    if ($validation->passed()) {
//        echo 'passed';
//    } else {
//        foreach ($validation ->errors() as $error){
//            echo $error, '<br>';
//        }
//    }
//}
?> ﻿
<!DOCTYPE html>
<html> 
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <title>Sign In | Sublime Web Manager</title>
        <!-- Favicon-->
        <link rel="icon" href="favicon.ico" type="image/x-icon">

        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

        <!-- Bootstrap Core Css -->
        <link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

        <!-- Waves Effect Css -->
        <link href="plugins/node-waves/waves.css" rel="stylesheet" />

        <!-- Animation Css -->
        <link href="plugins/animate-css/animate.css" rel="stylesheet" />

        <!-- Custom Css -->
        <link href="css/style.css" rel="stylesheet">
    </head> 

    <body class="login-page">
        <div class="login-box">
            <div class="logo">
                <a href="javascript:void(0);">Web <b>Mananger</b></a>
                <small>Lorem ipsum dolor sit amet.</small>
            </div>
            <div class="card">
                <div class="body">
                    <?php
                    if (isset($_GET['message'])) {

                        $MESSAGE = New Message($_GET['message']);
                        ?>
                        <div class="alert alert-<?php echo $MESSAGE->status; ?>" role = "alert">
                            <?php echo $MESSAGE->description; ?>
                        </div>
                        <?php
                    }
                    ?>
                    <form id="sign_in" method="POST" action="post-and-get/change-password.php">

                        <div class="msg">Please check your email</div>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">person</i>
                            </span>
                            <div class="form-line">
                                <input type="text" class="form-control" name="code" placeholder="Password Reset code"  autofocus>
                            </div>
                        </div>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">lock</i>
                            </span>
                            <div class="form-line">
                                <input type="password" class="form-control" minlength="6" name="password" placeholder="New Password" required="true">
                            </div>
                        </div>

                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">lock</i>
                            </span>
                            <div class="form-line">
                                <input type="password" class="form-control" minlength="6" name="confirmpassword" placeholder="Confirm your new Password" required="true">
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-xs-4">
                                <button class="btn btn-block bg-pink waves-effect" name="PasswordReset" type="submit">SIGN IN</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>

        <!-- Jquery Core Js -->
        <script src="plugins/jquery/jquery.min.js"></script>

        <!-- Bootstrap Core Js -->
        <script src="plugins/bootstrap/js/bootstrap.js"></script>

        <!-- Waves Effect Plugin Js -->
        <script src="plugins/node-waves/waves.js"></script>

        <!-- Validation Plugin Js -->
        <script src="plugins/jquery-validation/jquery.validate.js"></script>

        <!-- Custom Js -->
        <script src="js/admin.js"></script>
        <script src="js/pages/examples/sign-in.js"></script>
    </body>

</html>