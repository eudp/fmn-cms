<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?= $title?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?= site_url('assets/AdminLTE-2.4.3/'); ?>bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= site_url('assets/AdminLTE-2.4.3/'); ?>bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?= site_url('assets/AdminLTE-2.4.3/'); ?>bower_components/Ionicons/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?= site_url('assets/AdminLTE-2.4.3/'); ?>bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
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


  <!-- REQUIRED JS SCRIPTS -->

  <!-- jQuery 3 -->
  <script src="<?= site_url('assets/AdminLTE-2.4.3/'); ?>bower_components/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="<?= site_url('assets/AdminLTE-2.4.3/'); ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- DataTables -->
  <script src="<?= site_url('assets/AdminLTE-2.4.3/'); ?>bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="<?= site_url('assets/AdminLTE-2.4.3/'); ?>bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
  <!-- SlimScroll -->
  <script src="<?= site_url('assets/AdminLTE-2.4.3/'); ?>bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
  <!-- FastClick -->
  <script src="<?= site_url('assets/AdminLTE-2.4.3/'); ?>bower_components/fastclick/lib/fastclick.js"></script>
  <!-- AdminLTE App -->
  <script src="<?= site_url('assets/AdminLTE-2.4.3/'); ?>dist/js/adminlte.min.js"></script>

  <script src="<?= site_url('assets/js/tinymce/tinymce.min.js'); ?>" ></script>


  <script>
    $(function () {

      $('#list-table').DataTable({
        'paging'      : true,
        'lengthChange': true,
        'searching'   : false,
        'ordering'    : false,
        'info'        : true,
        'autoWidth'   : false
      })
    })

    $(document).ready(function () {
      /* Si es una página de edición*/
      if($("#descripcion").length != 0) {
          $('#descripcion').html($('#descripcion-oculta').val())
          tinymce.init({
              selector: '#descripcion',
              height: 500,
              plugins: 'preview directionality visualblocks visualchars image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount imagetools contextmenu colorpicker textpattern help table',
              toolbar: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat | table',
              menu: {
                  view: {title: 'Edit', items: 'cut, copy, paste'}
              }
          })
      }
    })

  </script>
  
</head>

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
        <li><a href="<?= site_url('admin');?>"><i class="fa fa-link"></i> <span>Destacados</span></a></li>

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
        
        <li><a href="<?= site_url('admin/contactenos');?>"><i class="fa fa-link"></i> <span>Contacto</span></a></li>

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



