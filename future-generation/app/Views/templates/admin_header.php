<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
    <meta name="author" content="Coderthemes">

    <link rel="shortcut icon" href="<?= base_url('assets/images/favicon.ico'); ?>">

    <title>Future Generations</title>
    <link rel="shortcut icon" type="image/png" href="<?= base_url(); ?>assets/web/images/sgalmala.png" />
    <!-- Base Css Files -->
    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet" />

    <!-- Font Icons -->
    <link href="<?= base_url('assets/font-awesome/css/font-awesome.min.css') ?>" rel="stylesheet" />
    <link href="<?= base_url('assets/ionicon/css/ionicons.min.css') ?>" rel="stylesheet" />
    <link href="<?= base_url('assets/css/material-design-iconic-font.min.css') ?>" rel="stylesheet">

    <!-- animate css -->
    <link href="<?= base_url('assets/css/animate.css') ?>" rel="stylesheet" />

    <!--bootstrap-wysihtml5-->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/bootstrap-wysihtml5/bootstrap-wysihtml5.css') ?>" />
    <link href="<?= base_url('assets/summernote/summernote.css') ?>" rel="stylesheet" />

    <!--Form Wizard-->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/jquery.steps.css') ?>" />

    <!-- Waves-effect -->
    <link href="<?= base_url('assets/css/waves-effect.css') ?>" rel="stylesheet">

    <!-- Plugins css-->
    <link href="<?= base_url('assets/timepicker/bootstrap-timepicker.min.css') ?>" rel="stylesheet" />
    <link href="<?= base_url('assets/timepicker/bootstrap-datepicker.min.css') ?>" rel="stylesheet" />
    <link href="<?= base_url('assets/modal-effect/css/component.css') ?>" rel="stylesheet">

    <!-- Custom Files -->
    <link href="<?= base_url('assets/css/helper.css') ?>" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/css/style_main.css') ?>" rel="stylesheet" type="text/css" /> <!-- dashboard style css -->

    <!-- DATA TABLES Files -->
    <link href="<?= base_url('assets/datatables/jquery.dataTables.min.css') ?>" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    <script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/modernizr.min.js') ?>"></script>
    <script src="<?= base_url('assets/ckeditor/ckeditor.js'); ?>"></script>
</head>
<div id="myModal" style="padding-top:200px;" class="modalpopupsss fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"></button>

            </div>
            <div class="modal-body">
                <p style="font-size:22px;text-align:center;">Report is downloaded</p>
            </div>
            <div class="modal-footer">

            </div>
        </div>

    </div>
</div>
<style>
    .modalpopupsss {
        display: none;
    }
</style>

<body class="fixed-left-void">
    <div id="loader-block" style="position: absolute;z-index: 999;background-color: #000;width: 100%;height: 100%;opacity: 0.5;">
        <img style="vertical-align: middle;margin: 0 auto;left: 50%;top: 40%;position: absolute;" src="<?= base_url('assets/images/loader-gif-color.gif') ?>" alt="Loading" />
        Loading...
    </div>
    <!-- Begin page -->
    <div id="wrapper" class="forced enlarged">

        <!-- Top Bar Start -->
        <div class="topbar">
            <!-- LOGO -->
            <div class="topbar-left">
                <div class="text-center">

                    <a href="<?= base_url('admin/Form/ViewAppList') ?>" class="logo">
                        <div><img src="<?= base_url('assets/web/images/favicon.png') ?>" width="30"></div>
                        <span style="width:70%;text-align:left;margin-top:5px;margin-left:0;"><img src="<?= base_url('assets/web/images/futureinner.png') ?>"></span>
                        <!-- <span>Future<br>Generations </span> -->
                        <div style="clear:both;"></div>
                    </a>
                </div>
            </div>
            <!-- Button mobile view to collapse sidebar menu -->
            <div class="navbar navbar-default" role="navigation">
                <div class="container">
                    <div class="">
                        <div class="pull-left">
                            <button class="button-menu-mobile open-left">
                                <i class="fa fa-bars"></i>
                            </button>
                            <span class="clearfix"></span>
                        </div>


                        <ul class="nav navbar-nav navbar-right pull-right">
                            <li class="dropdown hidden-xs">
                                <a href="#" data-target="#" class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="true">
                                    <i class="md md-notifications"></i> <span class="badge badge-xs badge-danger">3</span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-lg">
                                    <li class="text-center notifi-title">Notification</li>
                                    <li class="list-group">
                                        <!-- list item-->
                                        <a href="<?= base_url('formbuilder/Application/notifications/') ?>" class="list-group-item">
                                            <div class="media">
                                                <div class="pull-left">
                                                    <em class="fa fa-file-text  fa-2x text-info"></em>
                                                </div>
                                                <div class="media-body clearfix">
                                                    <div class="media-heading">Assign Forms</div>
                                                    <p class="m-0">
                                                        <small id="mainNav-assignForms-notification"></small>
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                        <!-- list item-->
                                        <a href="<?= base_url('formbuilder/Application/formbuilder_notify/') ?>" class="list-group-item">
                                            <div class="media">
                                                <div class="pull-left">
                                                    <em class="fa fa-file-text-o fa-2x text-primary"></em>
                                                </div>
                                                <div class="media-body clearfix">
                                                    <div class="media-heading">Formbuilder</div>
                                                    <p class="m-0">
                                                        <small id="mainNav-formbuilder-notification"></small>
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                        <!-- list item-->
                                        <a href="<?= base_url('admin/Myinbox/') ?>" class="list-group-item">
                                            <div class="media">
                                                <div class="pull-left">
                                                    <em class="fa fa-envelope fa-2x text-danger"></em>
                                                </div>
                                                <div class="media-body clearfix">
                                                    <div class="media-heading">Inbox</div>
                                                    <p class="m-0">
                                                        <small id="mainNav-inbox-notification">
                                                        </small>
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                        <!-- last list item -->
                                        <a href="javascript:void(0);" class="list-group-item">
                                            <small>See all notifications</small>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="hidden-xs">
                                <a href="#" id="btn-fullscreen" class="waves-effect waves-light"><i class="md md-crop-free"></i></a>
                            </li>

                            <li class="dropdown">
                                <!--   <a href="" class="dropdown-toggle profile" data-toggle="dropdown" aria-expanded="true"><img src="<?= base_url('assets/images/user.png') ?>" alt="user-img" class="img-circle"> </a> -->
                                <?php
                                if (session()->get('profile_image') != '') {
                                    $img_path = session()->get('profile_image');
                                } else {
                                    $img_path = 'assets/images/user.png';
                                }

                                ?>
                                <a href="" class="dropdown-toggle profile" data-toggle="dropdown" aria-expanded="true"><img src="<?php echo base_url($img_path) ?>" alt="user-img" class="img-circle"> </a>
                                <ul class="dropdown-menu">
                                    <!-- <li><a href="<?= base_url('admin/Users/changepassword') ?>"><i class="md md-settings-power"></i> Change Password</a></li> -->
                                    <li><a href="<?= base_url('admin/Users/addUsers/') . encryptor('encrypt', session()->get('USER_ID')) ?>">
                                            <i class="md md-folder-shared"></i> Update Profile</a></li>
                                    <li><a href="<?= base_url('admin/Users/profile_changepassword/') ?>"><i class="md md md-create"></i> Change Password</a></li>
                                    <li><a href="<?= base_url('admin/Home/logout') ?>"><i class="md md-settings-power"></i> Logout</a></li>
                                </ul>
                            </li>

                        </ul>
                    </div>
                    <!--/.nav-collapse -->
                </div>
            </div>
        </div>

        <!-- Top Bar End -->