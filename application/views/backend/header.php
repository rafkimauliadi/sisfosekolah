<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url('favicon.png'); ?>">
    <title><?php echo $this->session->flashdata('title'); ?></title>
    <!-- This page CSS -->
    <!-- chartist CSS -->
    <link href="<?php echo base_url('assets/backend/komponen/morrisjs/morris.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/backend/css/pagination.css'); ?>" rel="stylesheet">
    <!--Toaster Popup message CSS -->
    <link href="<?php echo base_url('assets/backend/komponen/toast-master/css/jquery.toast.css') ?>" rel="stylesheet">

    <link href="<?php echo base_url('assets/backend/komponen/bootstrap-select/bootstrap-select.min.css') ?>" rel="stylesheet">


    <link rel="stylesheet" type="text/css"
        href="<?php echo base_url('assets/backend/komponen/datatables.net-bs4/css/dataTables.bootstrap4.css'); ?>">
    <link rel="stylesheet" type="text/css"
        href="<?php echo base_url('assets/backend/komponen/datatables.net-bs4/css/responsive.dataTables.min.css'); ?>">

    <link href="<?php echo base_url('assets/backend/komponen/sweetalert2/dist/sweetalert2.min.css'); ?>" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url('assets/backend/css/style.min.css'); ?>" rel="stylesheet">
    <!-- Dashboard 1 Page CSS -->
    <link href="<?php echo base_url('assets/backend/css/pages/dashboard1.css'); ?>" rel="stylesheet">

    <link rel="stylesheet" href="<?php echo base_url('assets/backend/cookies/jquery.treegrid.css'); ?>">

    
    <script src="<?php echo base_url('assets/backend/komponen/jquery/jquery-3.2.1.min.js'); ?>"></script>
    <!-- Bootstrap popper Core JavaScript -->
    <script src="<?php echo base_url('assets/backend/komponen/popper/popper.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/backend/komponen/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="<?php echo base_url('assets/backend/js/perfect-scrollbar.jquery.min.js'); ?>"></script>
    <!--Wave Effects -->
    <script src="<?php echo base_url('assets/backend/js/waves.js'); ?>"></script>
    <!--Menu sidebar -->
    <script src="<?php echo base_url('assets/backend/js/sidebarmenu.js'); ?>"></script>
    <!--Custom JavaScript -->
    <script src="<?php echo base_url('assets/backend/js/custom.min.js'); ?>"></script>

    <!-- ============================================================== -->
    <!-- This page plugins -->
    <!-- ============================================================== -->
    <!--morris JavaScript -->
    <script src="<?php echo base_url('assets/backend/komponen/raphael/raphael-min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/backend/komponen/morrisjs/morris.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/backend/komponen/jquery-sparkline/jquery.sparkline.min.js'); ?>"></script>
    <!-- Popup message jquery -->
    <script src="<?php echo base_url('assets/backend/komponen/toast-master/js/jquery.toast.js'); ?>"></script>

    <!-- Sweet-Alert  -->
    <script src="<?php echo base_url('assets/backend/komponen/sweetalert2/dist/sweetalert2.all.min.js'); ?>"></script>


    <!-- Chart JS -->
    <script src="<?php echo base_url('assets/backend/js/dashboard1.js'); ?>"></script>
    <script src="<?php echo base_url('assets/backend/komponen/toast-master/js/jquery.toast.js'); ?>"></script>

    <script src="<?php echo base_url('assets/backend/komponen/datatables.net/js/jquery.dataTables.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/backend/komponen/datatables.net-bs4/js/dataTables.responsive.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/backend/komponen/bootstrap-select/bootstrap-select.min.js'); ?>"></script>

    <link href="<?php echo base_url('assets/backend/komponen/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css'); ?>" rel="stylesheet" />
    <script src="<?php echo base_url('assets/backend/komponen/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.js'); ?>"></script>

    <link href="<?php echo base_url('assets/backend/select/css/select2.min.css'); ?>" rel="stylesheet" />
    <script src="<?php echo base_url('assets/backend/select/js/select2.full.min.js'); ?>"></script>

    <script src="<?php echo base_url('assets/backend/js/jquery.autocomplete.min.js'); ?>"></script>

    
</head>

<body class="skin-default fixed-layout">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">Loading...</p>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <!-- ============================================================== -->
                <!-- Logo -->
                <!-- ============================================================== -->
                <div class="navbar-header">
                    <a class="navbar-brand" href="<?php echo site_url('administrator'); ?>">
                        <!-- Logo icon --><b>
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Dark Logo icon -->
                            <img src="<?php echo base_url('favicon.png'); ?>" alt="homepage" class="dark-logo" style="width: 60px;" />
                            <!-- Light Logo icon -->
                            <img src="<?php echo base_url('favicon.png'); ?>" alt="homepage" class="light-logo" style="width: 60px;" />
                        </b>
                        <!--End Logo icon -->
                        <!-- Logo text --><span>
                         <!-- dark Logo text -->
                         <!-- <img src="../assets/images/logo-text.png" alt="homepage" class="dark-logo" />
                         Light Logo text    
                         <img src="../assets/images/logo-light-text.png" class="light-logo" alt="homepage" /></span>  --></a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav mr-auto">
                        <!-- This is  -->
                        <li class="nav-item"> <a class="nav-link nav-toggler d-block d-md-none waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                        <li class="nav-item"> <a class="nav-link sidebartoggler d-none d-lg-block d-md-block waves-effect waves-dark" href="javascript:void(0)"><i class="icon-menu"></i></a> </li>

                    </ul>
                    <!-- ============================================================== -->
                    <!-- User profile and search -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav my-lg-0">
                        <!-- ============================================================== -->
                        <!-- Comment -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="ti-email"></i>
                                <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right mailbox animated bounceInDown">
                                <ul>
                                    <li>
                                        <div class="drop-title">Notifications</div>
                                    </li>
                                    <li>
                                        <div class="message-center">
                                            <!-- Message -->
                                            <a href="javascript:void(0)">
                                                <div class="btn btn-danger btn-circle"><i class="fa fa-link"></i></div>
                                                <div class="mail-contnet">
                                                    <h5>Luanch Admin</h5> <span class="mail-desc">Hello</span> <span class="time"></span> <?php echo date('h:m:s'); ?> </div>
                                            </a>
                                        </div>
                                    </li>
                                    <li>
                                        <a class="nav-link text-center link" href="javascript:void(0);"> <strong>Check all notifications</strong> <i class="fa fa-angle-right"></i> </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <!-- ============================================================== -->
                        <!-- End Comment -->
                        <!-- ============================================================== -->
                        <!-- ============================================================== -->
                        <!-- Messages -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark" href="#" id="2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="icon-note"></i>
                                <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>
                            </a>
                            <div class="dropdown-menu mailbox dropdown-menu-right animated bounceInDown" aria-labelledby="2">
                                <ul>
                                    <li>
                                        <div class="drop-title">You have 1 new messages</div>
                                    </li>
                                    <li>
                                        <div class="message-center">
                                            <!-- Message -->
                                            <a href="javascript:void(0)">
                                                <div class="user-img"> <img src="<?php echo base_url('user-icon.png'); ?>" alt="user" class="img-circle"> <span class="profile-status online pull-right"></span> </div>
                                                <div class="mail-contnet">
                                                    <h5>Welcome</h5> <span class="mail-desc">Please Enjoy</span> <span class="time"><?php echo date('h:m:s'); ?></span> </div>
                                            </a>
                                            <!-- Message -->
                                        </div>
                                    </li>
                                    <li>
                                        <a class="nav-link text-center link" href="javascript:void(0);"> <strong>See all e-Mails</strong> <i class="fa fa-angle-right"></i> </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item right-side-toggle"> <a class="nav-link  waves-effect waves-light" href="javascript:void(0)"><i class="ti-settings"></i></a></li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- User Profile-->
                <div class="user-profile">
                    <div class="user-pro-body">
                        <div>
                            <img src="<?php echo base_url('user-icon.png'); ?>" alt="user-img" class="img-circle">
                        </div>
                        <div class="dropdown">
                            <a href="javascript:void(0)" class="dropdown-toggle u-dropdown link hide-menu" data-toggle="dropdown" role="button" aria-haspopup="true"
                                aria-expanded="false"><?php  echo $name=$this->model_hook->init_profile_user()->full_name; ?>
                                <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu animated flipInY">
                                <!-- text-->
                                <a href="<?php echo site_url('administrator/edit-profile'); ?>" class="dropdown-item">
                                    <i class="ti-user"></i> My Profile</a>
                                <!-- text-->
                                <div class="dropdown-divider"></div>
                                <!-- text-->
                                <a href="<?php echo site_url('administrator/change-password'); ?>" class="dropdown-item">
                                    <i class="ti-settings"></i> Change Password</a>
                                <!-- text-->
                                <div class="dropdown-divider"></div>
                                <!-- text-->
                                <a href="<?php echo site_url('administrator/logout'); ?>" class="dropdown-item">
                                    <i class="fa fa-power-off"></i> Logout</a>
                                <!-- text-->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Sidebar navigation-->
                