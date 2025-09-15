<!doctype html>
<html lang="en">
    <head>
    	<title><?=$title; ?></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <meta name="keywords" content="bootstrap, bootstrap admin template, admin theme, admin dashboard, dashboard template, admin template, responsive" />
        <meta name="author" content="Codedthemes" />
        <!-- Favicon icon -->
    	<link rel="icon" type="image/png" sizes="96x96" href="<?= base_url() ?>assets/img/favicon.png">
        <!-- Google font-->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet">
        <!-- waves.css -->
        <link rel="stylesheet" href="<?= base_url() ?>assets/dupak/admin/pages/waves/css/waves.min.css" type="text/css" media="all">
        <!-- Required Fremwork -->
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/dupak/admin/css/bootstrap/css/bootstrap.min.css">
        <!-- themify icon -->
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/dupak/admin/icon/themify-icons/themify-icons.css">
        <!-- font-awesome-n -->
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/dupak/admin/css/font-awesome-n.min.css">
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/dupak/admin/css/font-awesome.min.css">
        <!-- scrollbar.css -->
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/dupak/admin/css/jquery.mCustomScrollbar.css">
        <!-- Style.css -->
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/dupak/admin/css/style.css">
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/dupak/admin/sweetalert/sweetalert2.min.css" />
        <link rel="stylesheet" href="<?= base_url() ?>assets/vendor/select2/select2.min.css">

        <!-- Datatables -->
        <link href="<?= base_url() ?>assets/dupak/admin/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
        <link href="<?= base_url() ?>assets/dupak/admin/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
        <link href="<?= base_url() ?>assets/dupak/admin/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
        <link href="<?= base_url() ?>assets/dupak/admin/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
        <link href="<?= base_url() ?>assets/dupak/admin/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

        <!-- Amcharts -->
        <!-- <link rel="stylesheet" href="<?= base_url() ?>assets/dupak/admin/amcharts/plugins/export/export.css" type="text/css" media="all" /> -->

        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/dupak/admin/daterangepicker/daterangepicker.css">

        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.9/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
        <!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"> -->


    </head>

    <body>
        <div class="theme-loader">
            <div class="loader-track">
                <div class="preloader-wrapper">
                    <div class="spinner-layer spinner-blue">
                        <div class="circle-clipper left">
                            <div class="circle"></div>
                        </div>
                        <div class="gap-patch">
                            <div class="circle"></div>
                        </div>
                        <div class="circle-clipper right">
                            <div class="circle"></div>
                        </div>
                    </div>
                    <div class="spinner-layer spinner-red">
                        <div class="circle-clipper left">
                            <div class="circle"></div>
                        </div>
                        <div class="gap-patch">
                            <div class="circle"></div>
                        </div>
                        <div class="circle-clipper right">
                            <div class="circle"></div>
                        </div>
                    </div>

                    <div class="spinner-layer spinner-yellow">
                        <div class="circle-clipper left">
                            <div class="circle"></div>
                        </div>
                        <div class="gap-patch">
                            <div class="circle"></div>
                        </div>
                        <div class="circle-clipper right">
                            <div class="circle"></div>
                        </div>
                    </div>

                    <div class="spinner-layer spinner-green">
                        <div class="circle-clipper left">
                            <div class="circle"></div>
                        </div>
                        <div class="gap-patch">
                            <div class="circle"></div>
                        </div>
                        <div class="circle-clipper right">
                            <div class="circle"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="pcoded" class="pcoded">
            <div class="pcoded-overlay-box"></div>
            <div class="pcoded-container navbar-wrapper">
                <nav class="navbar header-navbar pcoded-header">
                    <div class="navbar-wrapper">
                        <div class="navbar-logo">
                            <a class="mobile-menu waves-effect waves-light" id="mobile-collapse" href="#!">
                                <i class="ti-menu"></i>
                            </a>
                            <div class="mobile-search waves-effect waves-light">
                                <div class="header-search">
                                    <div class="main-search morphsearch-search">
                                        <div class="input-group">
                                            <span class="input-group-prepend search-close"><i class="ti-close input-group-text"></i></span>
                                            <input type="text" class="form-control" placeholder="Enter Keyword">
                                            <span class="input-group-append search-btn"><i class="ti-search input-group-text"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a href="<?=base_url(str_replace('=', '', base64_encode('dupak/dashboard')));?>" >
                                <h3>e-DUPAK</h3>
                            </a>
                            <a class="mobile-options waves-effect waves-light">
                                <i class="ti-more"></i>
                            </a>
                        </div>
                        <div class="navbar-container container-fluid">
                            <ul class="nav-right">
                                <li class="user-profile header-notification">
                                    <a href="#!" class="waves-effect waves-light">
                                        <span><?=$this->session->userdata('user_logged')->name?></span>
                                        <i class="ti-angle-down"></i>
                                    </a>
                                    <ul class="show-notification profile-notification">
                                        <li class="waves-effect waves-light">
                                            <a href="<?=base_url('dupak/login-user/submit-logout'); ?>">
                                                <i class="ti-layout-sidebar-left"></i> Logout
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>

                <?php if($view == '/dupak/dashboard/index'){
                    $aktif1 = 'active';
                    $breadcrumb = '<li class="breadcrumb-item"><a href="#!">Dashboard</a></li>';
                }else if($view == '/dupak/akun/verifikasi-akun/grid'){
                    $aktif2 = 'active';
                }else if($view == '/dupak/akun/users/grid'){
                    $aktif3 = 'active';
                    $breadcrumb = '<li class="breadcrumb-item"><a href="#!">Akun</a></li> <li class="breadcrumb-item"><a href="#!">Users</a></li>';
                }else if($view == '/dupak/users/resetpassword'){
                    $aktif4 = 'active';
                    $breadcrumb = '<li class="breadcrumb-item"><a href="#!">Akun</a></li> <li class="breadcrumb-item"><a href="#!">Reset Password</a></li>';
                }else if($view == '/dupak/pengusuldupak/admin/grid'){
                    $aktif5 = 'active';
                    $breadcrumb = '<li class="breadcrumb-item"><a href="#!">Data Pengusul Dupak</a></li>';
                }else if($view == 'dupak/datappupd'){
                    $aktif6 = 'active';
                }else if($view == '/dupak/pengusuldupak/admin/grid-rekomendasi'){
                    $aktif7 = 'active';
                    $breadcrumb = '<li class="breadcrumb-item"><a href="#!">Rekomendasi</a></li>';
                }else if($view == 'dupak/penilai'){
                    $aktif8 = 'active';
                }else if($view == 'dupak/verifikasiusulan'){
                    $aktif9 = 'active';
                }else if($view == 'dupak/usulanternilai'){
                    $aktif10 = 'active';
                }else if($view == '/dupak/file-takkah/grid'){
                    $aktif11 = 'active';
                    $breadcrumb = '<li class="breadcrumb-item"><a href="#!">Dokumen Kepegawaian</a></li>';
                }else if($view == '/dupak/inisiasipak/grid'){
                    $aktif12 = 'active';
                    $breadcrumb = '<li class="breadcrumb-item"><a href="#!">PAK Lama</a></li>';
                }else if($view == '/dupak/pengusuldupak/pengusuldupak/grid'){
                    $aktif13 = 'active';
                    $breadcrumb = '<li class="breadcrumb-item"><a href="#!">Pengusul Dupak</a></li>';
                }else if($view == '/dupak/users/gantipassword'){
                    $aktif14 = 'active';
                    $breadcrumb = '<li class="breadcrumb-item"><a href="#!">Ganti Password</a></li>';
                }else if($view == '/dupak/diklatteknis/grid'){
                    $aktif15 = 'active';
                    $breadcrumb = '<li class="breadcrumb-item"><a href="#!">Master</a></li> <li class="breadcrumb-item"><a href="#!">Diklat Teknis</a></li>';
                }else if($view == '/dupak/input-atasan/grid'){
                    $aktif16 = 'active';
                    $breadcrumb = '<li class="breadcrumb-item"><a href="#!">Input Atasan</a></li>';
                }else if($view == '/dupak/data-pribadi/grid'){
                    $aktif17 = 'active';
                    $breadcrumb = '<li class="breadcrumb-item"><a href="#!">Data Pribadi</a></li>';
                }else{
                    $aktif1 = '';
                    $aktif2 = '';
                    $aktif3 = '';
                    $aktif4 = '';
                    $aktif5 = '';
                    $aktif6 = '';
                    $aktif7 = '';
                    $aktif8 = '';
                    $aktif9 = '';
                    $aktif10 = '';
                    $aktif11 = '';
                    $aktif12 = '';
                    $aktif13 = '';
                    $aktif14 = '';
                    $aktif15 = '';
                    $aktif16 = '';
                    $aktif17 = '';
                }

                ?>

                <div class="pcoded-main-container">
                    <div class="pcoded-wrapper">
                        <nav class="pcoded-navbar">
                            <div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>
                            <div class="pcoded-inner-navbar main-menu">
                                <div class="">
                                    <div class="main-menu-content">
                                        <ul>
                                            <li class="more-details">
                                                <a href="<?=base_url('dupak/login-user/submit-logout'); ?>" ><i class="ti-layout-sidebar-left"></i>Logout</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <ul class="pcoded-item pcoded-left-item">
                                    <?php if($this->session->userdata('user_logged')->role == '3' ){ ?>
                                        <li class="<?=$aktif1?>">
                                            <a href="<?=base_url(str_replace('=', '', base64_encode('dupak/dashboard')));?>" class="waves-effect waves-dark">
                                                <span class="pcoded-micon"><i class="ti-home"></i><b>D</b></span>
                                                <span class="pcoded-mtext">Dashboard</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                        <li class="<?=$aktif17?>">
                                            <a href="<?=base_url(str_replace('=', '', base64_encode('dupak/data-pribadi')));?>"  class="waves-effect waves-dark">
                                                <span class="pcoded-micon"><i class="ti-user"></i><b>D</b></span>
                                                <span class="pcoded-mtext">Data Pribadi</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                        <li class="<?=$aktif16?>">
                                            <a href="<?=base_url(str_replace('=', '', base64_encode('dupak/input-atasan')));?>"  class="waves-effect waves-dark">
                                                <span class="pcoded-micon"><i class="ti-user"></i><b>D</b></span>
                                                <span class="pcoded-mtext">Input Atasan</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                        <li class="<?=$aktif11?>">
                                            <a href="<?=base_url(str_replace('=', '', base64_encode('dupak/filetakkah')));?>"  class="waves-effect waves-dark">
                                                <span class="pcoded-micon"><i class="ti-notepad"></i><b>B</b></span>
                                                <span class="pcoded-mtext">Dokumen Kepegawaian</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                        <li class="<?=$aktif12?>">
                                            <a href="<?=base_url(str_replace('=', '', base64_encode('dupak/inisiasipak')));?>"  class="waves-effect waves-dark">
                                                <span class="pcoded-micon"><i class="ti-check-box"></i><b>B</b></span>
                                                <span class="pcoded-mtext">Inisiasi PAK</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                        <li class="<?=$aktif13?>">
                                            <a href="<?=base_url(str_replace('=', '', base64_encode('dupak/pengusuldupak')));?>" class="waves-effect waves-dark">
                                                <span class="pcoded-micon"><i class="ti-layers"></i><b>B</b></span>
                                                <span class="pcoded-mtext">Pengusul DUPAK</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                        <li class="<?=$aktif14?>">
                                            <a href="<?=base_url(str_replace('=', '', base64_encode('dupak/users/gantipassword')));?>" class="waves-effect waves-dark">
                                                <span class="pcoded-micon"><i class="ti-key"></i><b>B</b></span>
                                                <span class="pcoded-mtext">Ganti Password</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                    <?php }else{ ?>
                                        <li class="<?=$aktif1?>">
                                            <a href="<?=base_url(str_replace('=', '', base64_encode('dupak/dashboard')));?>" class="waves-effect waves-dark">
                                                <span class="pcoded-micon"><i class="ti-home"></i><b>D</b></span>
                                                <span class="pcoded-mtext">Dashboard</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                        <li class="pcoded-hasmenu">
                                            <a href="javascript:void(0)" class="waves-effect waves-dark">
                                                <span class="pcoded-micon"><i class="ti-user"></i><b>BC</b></span>
                                                <span class="pcoded-mtext">Akun</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                            <ul class="pcoded-submenu" style="<?php echo $aktif2 || $aktif3 || $aktif4?'display: block;':''; ?>">
                                                <li class="<?=$aktif2?>">
                                                    <a href="<?=base_url(str_replace('=', '', base64_encode('dupak/akun/verifikasi')));?>" class="waves-effect waves-dark">
                                                        <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                        <span class="pcoded-mtext">Verifikasi Akun</span>
                                                        <span class="pcoded-mcaret"></span>
                                                    </a>
                                                </li>
                                                <li class="<?=$aktif3?>">
                                                    <a href="<?=base_url(str_replace('=', '', base64_encode('dupak/users')));?>" class="waves-effect waves-dark">
                                                        <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                        <span class="pcoded-mtext">Users</span>
                                                        <span class="pcoded-mcaret"></span>
                                                    </a>
                                                </li>
                                                <li class="<?=$aktif4?>">
                                                    <a href="<?=base_url(str_replace('=', '', base64_encode('dupak/users/resetpassword')));?>" class="waves-effect waves-dark">
                                                        <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                        <span class="pcoded-mtext">Reset Password</span>
                                                        <span class="pcoded-mcaret"></span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="pcoded-hasmenu">
                                            <a href="javascript:void(0)" class="waves-effect waves-dark">
                                                <span class="pcoded-micon"><i class="ti-layers"></i><b>BC</b></span>
                                                <span class="pcoded-mtext">Data Usulan Dupak</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                            <ul class="pcoded-submenu" style="<?php echo $aktif5?'display: block;':''; ?>">
                                                <li class="<?=$aktif5?>">
                                                    <a href="<?=base_url(str_replace('=', '', base64_encode('dupak/admin/pengusuldupak')));?>" class="waves-effect waves-dark">
                                                        <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                        <span class="pcoded-mtext">Data Usulan Dupak</span>
                                                        <span class="pcoded-mcaret"></span>
                                                    </a>
                                                </li>

                                            </ul>
                                        </li>
                                        <li class="pcoded-hasmenu">
                                            <a href="javascript:void(0)" class="waves-effect waves-dark">
                                                <span class="pcoded-micon"><i class="ti-receipt"></i><b>BC</b></span>
                                                <span class="pcoded-mtext">Laporan</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                            <ul class="pcoded-submenu">
                                                <li class="<?=$aktif6?>">
                                                    <a href="#" class="waves-effect waves-dark">
                                                        <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                        <span class="pcoded-mtext">Data PPUPD</span>
                                                        <span class="pcoded-mcaret"></span>
                                                    </a>
                                                </li>

                                            </ul>
                                        </li>
                                        <li class="<?=$aktif7?>">
                                            <a href="<?=base_url(str_replace('=', '', base64_encode('dupak/admin/rekomendasi')));?>" class="waves-effect waves-dark">
                                                <span class="pcoded-micon"><i class="ti-notepad"></i><b>FC</b></span>
                                                <span class="pcoded-mtext">Rekomendasi</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                        <li class="pcoded-hasmenu">
                                            <a href="javascript:void(0)" class="waves-effect waves-dark">
                                                <span class="pcoded-micon"><i class="ti-user"></i><b>BC</b></span>
                                                <span class="pcoded-mtext">Tim Penilai</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                            <ul class="pcoded-submenu">
                                                <li class="<?=$aktif8?>">
                                                    <a href="#" class="waves-effect waves-dark">
                                                        <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                        <span class="pcoded-mtext">Penilai</span>
                                                        <span class="pcoded-mcaret"></span>
                                                    </a>
                                                </li>

                                            </ul>
                                        </li>
                                        <li class="pcoded-hasmenu">
                                            <a href="javascript:void(0)" class="waves-effect waves-dark">
                                                <span class="pcoded-micon"><i class="ti-user"></i><b>BC</b></span>
                                                <span class="pcoded-mtext">Verifikator</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                            <ul class="pcoded-submenu">
                                                <li class="<?=$aktif9?>">
                                                    <a href="#" class="waves-effect waves-dark">
                                                        <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                        <span class="pcoded-mtext">Verifikasi Usulan</span>
                                                        <span class="pcoded-mcaret"></span>
                                                    </a>
                                                </li>
                                                <li class="<?=$aktif10?>">
                                                    <a href="#" class="waves-effect waves-dark">
                                                        <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                        <span class="pcoded-mtext">Usulan Ternilai</span>
                                                        <span class="pcoded-mcaret"></span>
                                                    </a>
                                                </li>

                                            </ul>
                                        </li>
                                        <li class="<?=$aktif11?>">
                                            <a href="bs-basic-table.html" class="waves-effect waves-dark">
                                                <span class="pcoded-micon"><i class="ti-notepad"></i><b>B</b></span>
                                                <span class="pcoded-mtext">Dokumen Kepegawaian</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                        <li class="<?=$aktif12?>">
                                            <a href="<?=base_url(str_replace('=', '', base64_encode('dupak/inisiasipak')));?>" class="waves-effect waves-dark">
                                                <span class="pcoded-micon"><i class="ti-check-box"></i><b>B</b></span>
                                                <span class="pcoded-mtext">Inisiasi PAK</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                        <li class="<?=$aktif13?>">
                                            <a href="<?=base_url(str_replace('=', '', base64_encode('dupak/pengusuldupak')));?>" class="waves-effect waves-dark">
                                                <span class="pcoded-micon"><i class="ti-layers"></i><b>B</b></span>
                                                <span class="pcoded-mtext">Pengusul DUPAK</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                        <li class="<?=$aktif14?>">
                                            <a href="<?=base_url(str_replace('=', '', base64_encode('dupak/users/gantipassword')));?>" class="waves-effect waves-dark">
                                                <span class="pcoded-micon"><i class="ti-key"></i><b>B</b></span>
                                                <span class="pcoded-mtext">Ganti Password</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                        <li class="pcoded-hasmenu">
                                            <a href="javascript:void(0)" class="waves-effect waves-dark">
                                                <span class="pcoded-micon"><i class="ti-settings"></i><b>BC</b></span>
                                                <span class="pcoded-mtext">Master</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                            <ul class="pcoded-submenu">
                                                <li class="<?=$aktif15?>">
                                                    <a href="<?=base_url(str_replace('=', '', base64_encode('dupak/diklatTeknis/index')));?>" class="waves-effect waves-dark">
                                                        <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                        <span class="pcoded-mtext">Diklat Teknis</span>
                                                        <span class="pcoded-mcaret"></span>
                                                    </a>
                                                </li>


                                            </ul>
                                        </li>
                                    <?php } ?>

                                </ul>
                            </div>
                        </nav>

                        <div class="pcoded-content">
                            <!-- Page-header start -->
                            <div class="page-header">
                                <div class="page-block">
                                    <div class="row align-items-center">
                                        <div class="col-md-8">
                                            <div class="page-header-title">
                                                <h5 class="m-b-10"><?=$title?></h5>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <ul class="breadcrumb">
                                                <li class="breadcrumb-item">
                                                    <a href="<?=base_url(str_replace('=', '', base64_encode('dupak/dashboard')));?>"> <i class="fa fa-home"></i> </a>
                                                </li>
                                                <?=$breadcrumb?>

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Page-header end -->
                            <div class="pcoded-inner-content">
                                <!-- Main-body start -->
                                <div class="main-body">
                                    <div class="page-wrapper">
                                        <!-- Page-body start -->
                                        <div class="page-body">
                                            <div class="row">
                                                <?php $this->load->view($view);?>

                                            </div>
                                        </div>
                                    </div>
                                    <div id="styleSelector"> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>






        <script type="text/javascript" src="<?= base_url() ?>assets/dupak/admin/js/jquery/jquery.min.js "></script>
        <script type="text/javascript" src="<?= base_url() ?>assets/dupak/admin/js/jquery-ui/jquery-ui.min.js "></script>
        <script type="text/javascript" src="<?= base_url() ?>assets/dupak/admin/js/popper.js/popper.min.js"></script>
        <script type="text/javascript" src="<?= base_url() ?>assets/dupak/admin/js/bootstrap/js/bootstrap.min.js "></script>
        <!-- waves js -->
        <script src="<?= base_url() ?>assets/dupak/admin/pages/waves/js/waves.min.js"></script>
        <!-- jquery slimscroll js -->
        <script type="text/javascript" src="<?= base_url() ?>assets/dupak/admin/js/jquery-slimscroll/jquery.slimscroll.js"></script>
        <script src="<?= base_url() ?>assets/vendor/select2/select2.min.js"></script>
    	<script src="<?= base_url() ?>assets/vendor/datepicker/bootstrap-datepicker.js"></script>

        <!-- Custom js -->
        <script src="<?= base_url() ?>assets/dupak/admin/js/pcoded.min.js"></script>
        <script src="<?= base_url() ?>assets/dupak/admin/js/vertical/vertical-layout.min.js"></script>
        <script src="<?= base_url() ?>assets/dupak/admin/js/jquery.mCustomScrollbar.concat.min.js"></script>
        <script type="text/javascript" src="<?= base_url() ?>assets/dupak/admin/js/script.js"></script>
        <script type="text/javascript" src="<?= base_url() ?>assets/dupak/admin/sweetalert/sweetalert2.min.js"></script>

        <script type="text/javascript" src="<?= base_url() ?>assets/dupak/admin/daterangepicker/daterangepicker.js"></script>
        <script type="text/javascript" src="<?= base_url() ?>assets/dupak/admin/daterangepicker/moment.min.js"></script>
        <script type="text/javascript" src="<?= base_url() ?>assets/dupak/admin/daterangepicker/daterangepicker.js"></script>

        <script src="<?= base_url() ?>assets/dupak/admin/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="<?= base_url() ?>assets/dupak/admin/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
        <script src="<?= base_url() ?>assets/dupak/admin/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
        <script src="<?= base_url() ?>assets/dupak/admin/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
        <script src="<?= base_url() ?>assets/dupak/admin/datatables.net-buttons/js/buttons.flash.min.js"></script>
        <script src="<?= base_url() ?>assets/dupak/admin/datatables.net-buttons/js/buttons.html5.min.js"></script>
        <script src="<?= base_url() ?>assets/dupak/admin/datatables.net-buttons/js/buttons.print.min.js"></script>
        <script src="<?= base_url() ?>assets/dupak/admin/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
        <script src="<?= base_url() ?>assets/dupak/admin/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
        <script src="<?= base_url() ?>assets/dupak/admin/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
        <script src="<?= base_url() ?>assets/dupak/admin/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
        <script src="<?= base_url() ?>assets/dupak/admin/datatables.net-scroller/js/dataTables.scroller.min.js"></script>

        <!-- amcharts -->
        <!-- <script src="<?= base_url() ?>assets/dupak/admin/amcharts/amcharts.js" rel="stylesheet"></script>
        <script src="<?= base_url() ?>assets/dupak/admin/amcharts/serial.js" rel="stylesheet"></script>
        <script src="<?= base_url() ?>assets/dupak/admin/amcharts/plugins/export/export.min.js"></script> -->

        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.1.2/js/plugins/sortable.min.js" type="text/javascript"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.9/js/fileinput.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.9/js/plugins/piexif.min.js" type="text/javascript"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.9/themes/fas/theme.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>


    </body>
    <script>
        function formatTanggal(tgl){
            var date = new Date(tgl);
            var tahun = date.getFullYear();
            var bulan = ("0" + date.getMonth()).slice(-2);
            var tanggal = ("0" + date.getDate()).slice(-2);
            var hari = date.getDay();
            var jam = ("0" + date.getHours()).slice(-2);
            var menit = ("0" + date.getMinutes()).slice(-2);
            var detik = ("0" + date.getSeconds()).slice(-2);
            switch(hari) {
             case 0: hari = "Minggu"; break;
             case 1: hari = "Senin"; break;
             case 2: hari = "Selasa"; break;
             case 3: hari = "Rabu"; break;
             case 4: hari = "Kamis"; break;
             case 5: hari = "Jum'at"; break;
             case 6: hari = "Sabtu"; break;
            }
            switch(bulan) {
             case "00": bulan = "Januari"; break;
             case "01": bulan = "Februari"; break;
             case "02": bulan = "Maret"; break;
             case "03": bulan = "April"; break;
             case "04": bulan = "Mei"; break;
             case "05": bulan = "Juni"; break;
             case "06": bulan = "Juli"; break;
             case "07": bulan = "Agustus"; break;
             case "08": bulan = "September"; break;
             case "09": bulan = "Oktober"; break;
             case "10": bulan = "November"; break;
             case "11": bulan = "Desember"; break;
            }
            var jam = (jam=="00" && menit=="00" && detik=="00")?"":" "+jam+":"+menit+":"+detik
            return tanggal + " " + bulan + " " + tahun;
        }

        function formatTanggalJam(tgl){
            var date = new Date(tgl);
            var tahun = date.getFullYear();
            var bulan = ("0" + date.getMonth()).slice(-2);
            var tanggal = ("0" + date.getDate()).slice(-2);
            var hari = date.getDay();
            var jam = ("0" + date.getHours()).slice(-2);
            var menit = ("0" + date.getMinutes()).slice(-2);
            var detik = ("0" + date.getSeconds()).slice(-2);
            switch(hari) {
             case 0: hari = "Minggu"; break;
             case 1: hari = "Senin"; break;
             case 2: hari = "Selasa"; break;
             case 3: hari = "Rabu"; break;
             case 4: hari = "Kamis"; break;
             case 5: hari = "Jum'at"; break;
             case 6: hari = "Sabtu"; break;
            }
            switch(bulan) {
             case "00": bulan = "Januari"; break;
             case "01": bulan = "Februari"; break;
             case "02": bulan = "Maret"; break;
             case "03": bulan = "April"; break;
             case "04": bulan = "Mei"; break;
             case "05": bulan = "Juni"; break;
             case "06": bulan = "Juli"; break;
             case "07": bulan = "Agustus"; break;
             case "08": bulan = "September"; break;
             case "09": bulan = "Oktober"; break;
             case "10": bulan = "November"; break;
             case "11": bulan = "Desember"; break;
            }
            var jam = (jam=="00" && menit=="00" && detik=="00")?"":" "+jam+":"+menit+":"+detik
            return tanggal + " " + bulan + " " + tahun + " " + jam;
        }
    </script>
</html>
