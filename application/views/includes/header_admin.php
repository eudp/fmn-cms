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
		<a class="navbar-brand" href="<?= site_url('');?>">
			<img src="http://www.fmn.gob.ve/sites/default/files/logo.jpg" width="120" height="64" alt="">
		</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item active">
					<a class="nav-link" href="<?= site_url('admin/');?>">Admin <span class="sr-only">(actual)</span></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= site_url('admin/fmn');?>">FMN</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= site_url('admin/establecimientos');?>">Establecimientos</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= site_url('admin/centros');?>">Centros</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= site_url('admin/colecciones');?>">Colecciones</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= site_url('admin/exposiciones');?>">Exposiciones</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= site_url('admin/noticias');?>">Noticias</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= site_url('admin/educacion');?>">Educación</a>
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
			</ul>
		</div>
	</nav>
	<!-- Fin menú principal -->
