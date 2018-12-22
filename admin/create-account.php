
<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/auth.php');

//check user level
$USERS = new User(NULL);
$USERS = new User($_SESSION['id']);
$DEFAULTDATA = new DefaultData(NULL);
$DEFAULTDATA->checkUserLevelAccess('1,2,3', $USERS->user_level);

$id = '';
$id = $_GET['id'];
$ACCOUNT_TYPE = null;
$ACCOUNT_TYPE = new AccountType($id);
?>

<!DOCTYPE html>
<html> 
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

        <title>Add Account   || Credit Master</title>
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
                        <h2><?php echo $ACCOUNT_TYPE->name ?>  </h2>

                    </div>
                    <div class="body">
                        <form class="" action="post-and-get/account.php" method="post"  enctype="multipart/form-data"> 

                            <div class="row">
                                <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                    <label for="account_type">Account Types</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 p-bottom">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="account_type" class="hidden-lg hidden-md">Account Types</label>
                                            <select id="account_type"  name="account_type"   class="form-control" autocomplete="off"  >
                                                <?php
                                                foreach ($ACCOUNT_TYPE->all()as $account_type) {
                                                    if ($account_type['id'] == $ACCOUNT_TYPE->id) {
                                                        ?>
                                                        <option selected="" value="<?php echo $ACCOUNT_TYPE->id ?>"> <?php echo $ACCOUNT_TYPE->name ?>   </option>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <option value="<?php echo $account_type['id'] ?>"> <?php echo $account_type['name'] ?>   </option>
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
                                    <label for="users">Users  </label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 p-bottom">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="users" class="hidden-lg hidden-md">Users Name</label>
                                            <select id="users"  name="user"  class="form-control" autocomplete="off"  >
                                                <?php
                                                foreach ($USERS->activeUsers() as $users) {
                                                    $name = $users['name'];
                                                    if ($users['id'] == $USERS->id) {
                                                        ?>
                                                        <option selected="" value="<?php echo $users['id'] ?>" data-name="<?php echo $name ?>"  > <?php echo $users['username'] ?>   </option>
                                                    <?php } else { ?>

                                                        <option value="<?php echo $users['id'] ?>" data-name="<?php echo $name ?>"> <?php echo $users['username'] ?>   </option>
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
                                    <label for="users_name">User Name</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 p-bottom">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="users_name" class="hidden-lg hidden-md">User Name</label>

                                            <input type="text" id="users_name" value="<?php echo $USERS->name ?>"  class="form-control" />
                                        </div>
                                    </div>
                                </div>
                            </div> 


                            <div class="row clearfix">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5">  
                                </div>  
                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7"> 
                                    <button class="btn btn-primary m-t-15 waves-effect  pull-left" type="submit" name="create">Save </button>
                                </div>
                            </div>
                        </form> 
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                        <div class="card">
                            <div class="header">
                                <h2>
                                    Manage Account
                                </h2>

                            </div> 
                            <div class="body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>User</th>                                                  
                                                <th>User Name</th>                                                  
                                                <th>Option</th> 
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $ACCOUNTS = new Account(NULL);
                                            foreach ($ACCOUNTS->getAccountByAccountType($id) as $key => $accounts) {
                                                ?>
                                                <tr id="row_<?php echo $accounts['id']; ?>">
                                                    <td>#<?php echo $accounts['id']; ?></td> 
                                                    <td><?php
                                                        $USER = new User($accounts ['user']);
                                                        echo $USER->username;
                                                        ?></td>  
                                                    <td><?php echo $USER->name; ?></td>  

                                                    <td>
                                                        <a href="#"  class="delete-branch" data-id="<?php echo $branch['id']; ?>"> <button class="glyphicon glyphicon-trash delete-btn" title="Delete"></button></a>

                                                    </td> 
                                                </tr>
                                                <?php
                                            }
                                            ?>   
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>ID</th>
                                                <th>User</th>                                                  
                                                <th>User Name</th>                                                  
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

        <!-- Jquery Core Js -->
        <script src="plugins/jquery/jquery.min.js"></script>
        <script src="plugins/bootstrap/js/bootstrap.js"></script> 
        <script src="plugins/jquery-slimscroll/jquery.slimscroll.js"></script>
        <script src="plugins/node-waves/waves.js"></script>
        <script src="plugins/jquery-spinner/js/jquery.spinner.js"></script>
        <script src="plugins/sweetalert/sweetalert.min.js"></script>
        <script src="js/admin.js"></script>
        <script src="js/demo.js"></script> 
        <script src="delete/js/branch.js" type="text/javascript"></script>
        <script>
            $(document).ready(function () {
                $('#users').change(function () {
                    var user_name = $('option:selected', this).attr('data-name');
                    $('#users_name').val(user_name);
                })
            });
        </script>
    </body>

</html>