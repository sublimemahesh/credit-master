<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/auth.php');
?>

<link href="css/custom.css" rel="stylesheet" type="text/css"/>
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
                <li class="dropdown">
                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
                        <i class="material-icons">settings</i>
                        <span class="label-count"></span>
                    </a>
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
                <?php
                $USERS = new User($_SESSION['id'])
                ?>
                <img src="../upload/users/<?php echo $USERS->image_name; ?>" width="48" height="48" alt="User" />
            </div>
            <div class="info-container m-top-z"  >
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
                        <i class="material-icons">
                            subtitles
                        </i>
                        <span>Loan</span>
                    </a>
                    <ul class="ml-menu">
                        <li>
                            <a href="create-loan.php">
                                <i class="material-icons">add</i>
                                <span>Create New</span>
                            </a>
                        </li>
                        <li>
                            <a href="manage-pending-loans.php">
                                <i class="material-icons">report_off</i>
                                <span>Pending Loans</span>
                            </a>
                        </li>
                        <li>
                            <a href="manage-verified-loans.php">
                                <i class="material-icons">report</i>
                                <span>Verified Loans</span>
                            </a>
                        </li>
                        <li>
                            <a href="manage-approved-loans.php">
                                <i class="material-icons">playlist_add_check</i>
                                <span>Approved Loans</span>
                            </a>
                        </li>
                        <li>
                            <a href="manage-active-loans.php">
                                <i class="material-icons">directions_bike</i>
                                <span>Active Loans</span>
                            </a>
                        </li>
                        <li>
                            <a href="manage-rejected-loans.php">
                                <i class="material-icons">remove_circle_outline</i>
                                <span>Rejected Loans</span>
                            </a>
                        </li>
                        <li>
                            <a href="manage-loan.php">
                                <i class="material-icons">list</i>
                                <span>View All Loans</span>
                            </a>
                        </li>
                    </ul>
                </li> 

                <li>
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">hourglass_full</i>
                        <span>Installments</span>
                    </a>
                    <ul class="ml-menu">
                        <li>
                            <a href="all-installments.php">
                                <i class="material-icons">event_available</i>
                                <span>All Installments</span>
                            </a>
                        </li> 
                        <li>
                            <a href="day-installment.php">
                                <i class="material-icons">calendar_today</i>
                                <span>Daily Installments</span>
                            </a>
                        </li> 
                        <li>
                            <a href="weekly-installment.php">
                                <i class="material-icons">date_range</i>
                                <span>Weekly Installments</span>
                            </a>
                        </li> 
                        <li>
                            <a href="monthly-installment.php">
                                <i class="material-icons">event</i>
                                <span>Monthly Installments</span>
                            </a>
                        </li> 
                    </ul>
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
                            <a href="view-active-customer.php">
                                <i class="material-icons">
                                    how_to_reg
                                </i>
                                <span>Active Customer</span>
                            </a>
                        </li>
                        <li>
                            <a href="view-inactive-customer.php">
                                <i class="material-icons">
                                    person_add_disabled
                                </i>
                                <span>Inactive Customer</span>
                            </a>
                        </li>
                    </ul>
                </li> 

                <li>
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">
                            date_range
                        </i>
                        <span>Postpone Date</span>
                    </a>
                    <ul class="ml-menu">
                        <li>
                            <a href="add-new-postpone-date.php">
                                <i class="material-icons">add</i>
                                <span>Add New</span>
                            </a>
                        </li>
                        <li>
                            <a href="manage-postpone-dates.php">
                                <i class="material-icons">list</i>
                                <span>Manage</span>
                            </a>
                        </li>
                        <li>
                            <a href="calender.php">
                                <i class="material-icons">insert_invitation</i>
                                <span>Calendar</span>
                            </a>
                        </li>

                    </ul>
                </li> 
                <li>
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">
                            assignment_turned_in
                        </i>
                        <span>Petty Cash</span>
                    </a>
                    <ul class="ml-menu">
                        <li>
                            <a href="add-new-petty-cash.php">
                                <i class="material-icons">add</i>
                                <span>Add New</span>
                            </a>
                        </li>
                        <li>
                            <a href="manage-petty-cash.php">
                                <i class="material-icons">list</i>
                                <span>Manage</span>
                            </a>
                        </li> 
                    </ul>
                </li> 
                <li>
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">
                            how_to_vote
                        </i>
                        <span>Collector Payment Detail</span>
                    </a>
                    <ul class="ml-menu">
                        <li>
                            <a href="add-collector-payment-detail.php">
                                <i class="material-icons">add</i>
                                <span>Add New</span>
                            </a>
                        </li>
                        <li>
                            <a href="manage-collector-payment-detail.php">
                                <i class="material-icons">list</i>
                                <span>Manage</span>
                            </a>
                        </li> 
                    </ul>
                </li> 

                <li>
                    <a href="cash-book.php" class="menu-toggle">
                        <i class="material-icons">
                            import_contacts
                        </i>
                        <span>Cash Book</span>
                    </a>

                </li>

                <li>
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">
                            store_mall_directory
                        </i>
                        <span>Bank</span>
                    </a>
                    <ul class="ml-menu">
                        <li>
                            <a href="add-new-bank.php">
                                <i class="material-icons">add</i>
                                <span>Add New</span>
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
                            monetization_on
                        </i>
                        <span>Expenses</span>
                    </a>
                    <ul class="ml-menu">
                        <li>
                            <a href="add-new-expenses.php">
                                <i class="material-icons">add</i>
                                <span>Add New</span>
                            </a>
                        </li>
                        <li>
                            <a href="manage-expenses.php">
                                <i class="material-icons">list</i>
                                <span>Manage</span>
                            </a>
                        </li>
                    </ul>
                </li> 


                <li>
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">
                            trending_up
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
                            room
                        </i>

                        <span>City</span>
                    </a>
                    <ul class="ml-menu">
                        <li>
                            <a href="create-city.php">
                                <i class="material-icons">add</i>
                                <span>Add New</span>
                            </a>
                        </li>
                        <li>
                            <a href="manage-city.php">
                                <i class="material-icons">list</i>
                                <span>Manage</span>
                            </a>
                        </li>

                    </ul>
                </li>

                <li>
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">
                            perm_identity
                        </i>

                        <span>Users</span>
                    </a>
                    <ul class="ml-menu">
                        <li>
                            <a href="create-users.php">
                                <i class="material-icons">add</i>
                                <span>Add New</span>
                            </a>
                        </li>

                        <li>
                            <a href="view-active-users.php">
                                <i class="material-icons">
                                    how_to_reg
                                </i>
                                <span>Active Users</span>
                            </a>
                        </li>
                        <li>
                            <a href="view-inactive-users.php">
                                <i class="material-icons">
                                    person_add_disabled
                                </i>
                                <span>Inactive Users</span>
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