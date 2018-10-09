<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . './auth.php');
?>


<!-- Page Loader -->
<!--<div class="page-loader-wrapper">
    <div class="loader">
        <div class="preloader">
            <div class="spinner-layer pl-red">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div>
                <div class="circle-clipper right">
                    <div class="circle"></div>
                </div>
            </div>
        </div>
        <p>Please wait...</p>
    </div>
</div>-->
<!-- #END# Page Loader -->
<!-- Overlay For Sidebars -->
<div class="overlay"></div>
<!-- #END# Overlay For Sidebars -->
<!-- Search Bar -->
<div class="search-bar">
    <div class="search-icon">
        <i class="material-icons">search</i>
    </div>
    <input type="text" placeholder="START TYPING...">
    <div class="close-search">
        <i class="material-icons">close</i>
    </div>
</div>
<!-- #END# Search Bar -->
<!-- Top Bar -->
<nav class="navbar">
    <div class="container-fluid">
        <div class="navbar-header">
            <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
            <a href="javascript:void(0);" class="bars"></a>
            <a class="navbar-brand" href="index.php">Micro Credit System</a>
        </div>
        <div class="collapse navbar-collapse" id="navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <!-- Call Search -->
                <li><a href="javascript:void(0);" class="js-search" data-close="true"><i class="material-icons">search</i></a></li>
                <!-- #END# Call Search -->
                <!-- Notifications -->
                <li class="dropdown">
                    <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button">
                        <i class="material-icons">notifications</i>
                        <span class="label-count">4</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">NOTIFICATIONS</li>
                        <li class="body">
                            <ul class="menu">
                                <li>
                                    <a href="manage-messages-member.php">
                                        <div class="icon-circle bg-light-green">
                                            <i class="material-icons">person_add</i>
                                        </div>
                                        <div class="menu-info">
                                            <h4>6&nbsp;<span>Member Messages</span></h4>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="manage-messages-company.php">
                                        <div class="icon-circle bg-cyan">
                                            <i class="material-icons">recent_actors</i>
                                        </div>
                                        <div class="menu-info">
                                            <h4>5 &nbsp;<span>Company Messages</span></h4>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="manage-messages-vacancy.php">  
                                        <div class="icon-circle bg-red">
                                            <i class="material-icons">next_week</i>
                                        </div>
                                        <div class="menu-info">
                                            <h4>2 &nbsp;<span>Vacancy Messages</span></h4>       
                                        </div>

                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="footer">
                            <a href="javascript:void(0);">View All Notifications</a>
                        </li>
                    </ul>
                </li>
                <!-- #END# Notifications -->
                <!-- Tasks -->
                <li class="dropdown">
                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
                        <i class="material-icons">flag</i>
                        <span class="label-count"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">FEED BACK</li>
                        <li class="body">
                            <ul class="menu tasks">
                                <li>
                                    <a href="manage-messages-company.php">
                                        <div class="icon-circle bg-cyan">
                                            <i class="material-icons">recent_actors</i>
                                        </div>
                                        <div class="menu-info">
                                            <h4>3 &nbsp;<span>Active Feedback</span></h4>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="manage-messages-vacancy.php">  
                                        <div class="icon-circle bg-red">
                                            <i class="material-icons">next_week</i>
                                        </div>
                                        <div class="menu-info">
                                            <h4>4 &nbsp;<span>Inactive Feedback</span></h4>       
                                        </div>

                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="footer">
                            <a href="javascript:void(0);">View Feedback All</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- #Top Bar -->
<section>
    <!-- Left Sidebar -->
    <aside id="leftsidebar" class="sidebar">
        <!-- User Info -->
        <div class="user-info">
            <div class="image">
                <img src="images/profile/<?php echo $_SESSION["id"]; ?>.jpg" width="48" height="48" alt="User" />
            </div>
            <div class="info-container">
                <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php echo $_SESSION['name']; ?>
                </div>
                <div class="email"><?php echo $_SESSION['email']; ?></div>
                <div class="btn-group user-helper-dropdown">
                    <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">settings</i>
                    <ul class="dropdown-menu pull-right">
                        <li>
                            <a href="profile.php?id=<?php echo $_SESSION['id']; ?>">
                                <i class="material-icons">person</i>Profile</a>
                        </li>
                        <li role="seperator" class="divider"></li>
                        <li><a href="edit-profile.php?id=<?php echo $_SESSION['id']; ?>"><i class="material-icons">edit</i>Edit My Profile</a></li>
                        <li><a href="change-password.php?id=<?php echo $_SESSION['id']; ?>"><i class="material-icons">vpn_key</i>Change Password</a></li> 
                        <li role="seperator" class="divider"></li>
                        <li><a href="post-and-get/log-out.php"><i class="material-icons">input</i>Sign Out</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- #User Info -->
        <!-- Menu -->
        <div class="menu">
            <ul class="list">
                <li class="header">MAIN NAVIGATION</li>
                <li class="active">
                    <a href="index.php">
                        <i class="material-icons">av_timer</i>
                        <span>Dashboard</span>
                    </a>
                </li> 
                <li>
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">group</i>
                        <span>Customer</span>
                    </a>
                    <ul class="ml-menu">
                        <li>
                            <a href="add-new-customer.php">
                                <i class="material-icons">add</i>
                                <span>Add New</span>
                            </a>
                        </li>
                        <li>
                            <a href="manage-customers.php">
                                <i class="material-icons">list</i>
                                <span>Manage</span>
                            </a>
                        </li>
                    </ul>
                </li> 

                <li>
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">
                            account_balance
                        </i>
                        <span>Center</span>
                    </a>
                    <ul class="ml-menu">
                        <li>
                            <a href="add-new-center.php">
                                <i class="material-icons">add</i>
                                <span>Add New</span>
                            </a>
                        </li>
                        <li>
                            <a href="manage-center.php">
                                <i class="material-icons">list</i>
                                <span>Manage</span>
                            </a>
                        </li>
                    </ul>
                </li> 
                <li>
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">
                            add_location
                        </i>
                        <span>Route</span>
                    </a>
                    <ul class="ml-menu">
                        <li>
                            <a href="create-route.php">
                                <i class="material-icons">add</i>
                                <span>Add New</span>
                            </a>
                        </li>
                        <li>
                            <a href="manage-route.php">
                                <i class="material-icons">list</i>
                                <span>Manage</span>
                            </a>
                        </li>
                    </ul>
                </li> 
                <li>
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">
                            add_location
                        </i>
                        <span>Route</span>
                    </a>
                    <ul class="ml-menu">
                        <li>
                            <a href="add-route.php">
                                <i class="material-icons">add</i>
                                <span>Add New</span>
                            </a>
                        </li>
                        <li>
                            <a href="manage-route.php">
                                <i class="material-icons">list</i>
                                <span>Manage</span>
                            </a>
                        </li>
                    </ul>
                </li> 
            </ul>
        </div>
        <!-- #Menu -->
        <!-- Footer -->
        <div class="legal">
            <div class="copyright">
                &copy; <?php echo date('Y'); ?> <a href="javascript:void(0);">BY : SUBLIME HOLDINGS</a>.
            </div>
            <div class="version">
                <b>Version: </b> 1.0.0
            </div>
        </div>
        <!-- #Footer -->
    </aside>
    <!-- #END# Left Sidebar -->
    <!-- Right Sidebar -->
</section>