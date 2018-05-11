<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= site_url('assets/css/bootstrap.min.css'); ?>">

    <!-- Image picker CSS -->
	<link rel="stylesheet" href="<?= site_url('assets/css/image-picker/image-picker.css'); ?>">
	
    <title><?= $title?></title>
</head>
<body>
	<!-- Menú principal -->
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item">
					<a class="nav-link" href="#">Hola, <?= $this->ion_auth->user()->row()->first_name ?> </a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= site_url('logout');?>">Logout</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= site_url('admin/');?>">Admin </a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= site_url('admin/establecimientos');?>">Establecimientos</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= site_url('admin/colecciones');?>">Colecciones</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= site_url('admin/obras');?>">Obras</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= site_url('admin/exposiciones');?>">Exposiciones</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= site_url('admin/noticias');?>">Noticias</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= site_url('admin/agenda');?>">Agenda</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= site_url('admin/multimedia');?>">Multimedia</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= site_url('admin/enlaces');?>">Enlaces</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= site_url('admin/contactenos');?>">Contacto</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= site_url('admin/agenda-museos');?>">Agenda Museos</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= site_url('admin/exposiciones-museos');?>">Exposiciones Museos</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= site_url('admin/multimedia-museos');?>">Multimedia Museos</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= site_url('admin/noticias-museos');?>">Noticias Museos</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= site_url('admin/colecciones-museos');?>">Colecciones Museos</a>
				</li>
			</ul>
		</div>
	</nav>
	<!-- Fin menú principal -->
