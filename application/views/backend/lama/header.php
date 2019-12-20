<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, user-scalable=no" />
        <title><?php echo $this->session->flashdata('title'); ?></title>
        <link href="<?php echo base_url('favicon.png'); ?>" rel="shortcut icon">
        <link href="<?php echo base_url('assets/backend/css/bootstrap.min.css'); ?>" rel="stylesheet">
        <link href="<?php echo base_url('assets/backend/css/style.css'); ?>" rel="stylesheet">
        <link href="<?php echo base_url('assets/backend/css/mediascreen.css'); ?>" rel="stylesheet">
        <link href="<?php echo base_url('assets/backend/css/custom.css'); ?>" rel="stylesheet">
        <link href="<?php echo base_url('assets/backend/css/dashboard.css'); ?>" rel="stylesheet">
        <link href="<?php echo base_url('assets/backend/css/dashboard.css'); ?>" rel="stylesheet">
        <link href="<?php echo base_url('assets/backend/css/colors.css'); ?>" rel="stylesheet">
        <link href="<?php echo base_url('assets/backend/font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet">
        <link href="<?php echo base_url('assets/backend/select/css/select2.min.css'); ?>" rel="stylesheet" />

        <script src="<?php echo base_url('assets/backend/js/jquery.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/backend/js/bootstrap.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/backend/select/js/select2.min.js'); ?>"></script>
         
        <link rel="stylesheet" href="<?php echo base_url('assets/backend/cookies/jquery.treegrid.css'); ?>">
        
        
        
        <script type="text/javascript" src="<?php echo base_url(); ?>imgs/tinymce/js/tinymce/tinymce.min.js"></script>

  </head>

   <body>
      <div id="throbber" style="display:none; min-height:120px;"></div>
        <div id="noty-holder"></div>
        <div id="wrapper">
            <!-- Navigation -->
            <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?php echo site_url('administrator'); ?>" href="">
                        <small style="color: #ffffff;"><img src="<?php echo base_url('favicon.png'); ?>" alt="sumbarprov.go.id" height="50px;"></small>
                        <?php echo $identitas->row()->display_header; ?>
                    </a>                   

                </div>
                <!-- Top Menu Items -->
                <ul class="nav navbar-right top-nav">
                    <li><a href="#" data-placement="bottom" data-toggle="tooltip" href="#" data-original-title="Stats"><i class="fa fa-bar-chart-o"></i>
                        </a>
                    </li>            
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Halo, <?php  echo $name=$this->model_hook->init_profile_user()->full_name; ?> <b class="fa fa-angle-down"></b></a>
                        <ul class="dropdown-menu">
                                <li><a href="<?php echo site_url('administrator/edit-profile'); ?>"><i class="fa fa-fw fa-user"></i> Edit Profile</a></li>
                                <li><a href="<?php echo site_url('administrator/change-password'); ?>"><i class="fa fa-fw fa-cog"></i> Change Password</a></li>
                                <li class="divider"></li>
                                <li><a href="<?php echo site_url('administrator/logout'); ?>"><i class="fa fa-fw fa-power-off"></i> Logout</a></li>
                            </ul>
                    </li>
                </ul>
                
               