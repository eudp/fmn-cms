<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Starter</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?= site_url('assets/AdminLTE-2.4.3/'); ?>bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= site_url('assets/AdminLTE-2.4.3/'); ?>bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?= site_url('assets/AdminLTE-2.4.3/'); ?>bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= site_url('assets/AdminLTE-2.4.3/'); ?>dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect. -->
  <link rel="stylesheet" href="<?= site_url('assets/AdminLTE-2.4.3/'); ?>dist/css/skins/skin-blue.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="<?= site_url('admin'); ?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini">FMN</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">FMN</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account Menu -->
          <li class="user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#">
              <span>Hola, <?= $this->ion_auth->user()->row()->first_name ?></span>
            </a>
          </li>
          <li class="user user-menu">
            <!-- Menu Toggle Button -->
            <a href="<?= site_url('logout');?>">
              <span>Logout</span>
            </a>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <?php if ($this->ion_auth->is_admin()) : ?>
            <li>
              <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
            </li>
          <?php endif ?>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MENÚ</li>
        <!-- Optionally, you can add icons to the links -->
        <li class="active"><a href="#"><i class="fa fa-link"></i> <span>Link</span></a></li>

        <li class="treeview">
          <a href="#"><i class="fa fa-link"></i> <span>Noticias</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?= site_url('admin/noticias');?>">Listar noticias</a></li>
            <li><a href="<?= site_url('admin/noticias/new');?>">Crear noticia</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#"><i class="fa fa-link"></i> <span>Exposiciones</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?= site_url('admin/exposiciones');?>">Listar exposiciones</a></li>
            <li><a href="<?= site_url('admin/exposiciones/new');?>">Crear exposicion</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#"><i class="fa fa-link"></i> <span>Agenda</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?= site_url('admin/agenda');?>">Listar agenda</a></li>
            <li><a href="<?= site_url('admin/agenda/new');?>">Crear agenda</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#"><i class="fa fa-link"></i> <span>Multimedia</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?= site_url('admin/multimedia');?>">Listar multimedia</a></li>
            <li><a href="<?= site_url('admin/multimedia/new');?>">Crear multimedia</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#"><i class="fa fa-link"></i> <span>Colecciones</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?= site_url('admin/colecciones');?>">Listar colecciones</a></li>
            <li><a href="<?= site_url('admin/colecciones/new');?>">Crear colección</a></li>
            <li><a href="<?= site_url('admin/obras');?>">Listar obras</a></li>
            <li><a href="<?= site_url('admin/obras/new');?>">Crear obra</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#"><i class="fa fa-link"></i> <span>Enlaces</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?= site_url('admin/enlaces');?>">Listar enlaces</a></li>
            <li><a href="<?= site_url('admin/enlaces/new');?>">Crear enlace</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#"><i class="fa fa-link"></i> <span>Establecimientos</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?= site_url('admin/establecimientos');?>">Listar establecimientos</a></li>
            <li><a href="<?= site_url('admin/museo/new');?>">Crear museo</a></li>
            <li><a href="<?= site_url('admin/instituto/new');?>">Crear centro</a></li>
          </ul>
        </li>
        
        <li><a href="<?= site_url('admin/contactenos');?>"><i class="fa fa-link"></i> <span>Contáctenos</span></a></li>

        <li class="treeview">
          <a href="#"><i class="fa fa-link"></i> <span>Museos (legacy)</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?= site_url('admin/noticias-museos');?>">Listar noticias</a></li>
            <li><a href="<?= site_url('admin/exposiciones-museos');?>">Listar exposiciones</a></li>
            <li><a href="<?= site_url('admin/multimedia-museos');?>">Listar multimedia</a></li>
            <li><a href="<?= site_url('admin/colecciones-museos');?>">Listar colecciones</a></li>
            <li><a href="<?= site_url('admin/agenda-museos');?>">Listar agenda</a></li>
          </ul>
        </li>

      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>



