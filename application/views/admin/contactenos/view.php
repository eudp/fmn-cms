<!-- <div class="container">
	<div class="row">
		<div class="col-12">
			<p>Nombre: <?= $messages[0]['data']?></p>
		</div>
		<div class="col-12">
			<p>Apellido: <?= $messages[1]['data']?></p>
		</div>
		<div class="col-12">
			<p>Correo: <?= $messages[2]['data']?></p>
		</div>
		<div class="col-12">
			<p>Asunto: <?= $messages[3]['data']?></p>
		</div>
		<div class="col-12">
			<p>Mensaje: <?= $messages[4]['data']?></p>
		</div>
	</div>
</div> -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Contacto
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Contacto</a></li>
    <li class="active">Descripción</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">


		<div class="row">
			<div class="col-md-12">
			  <div class="box box-solid">
			    <div class="box-header with-border">
			      <i class="fa fa-text-width"></i>

			      <h3 class="box-title">Mensaje de contacto</h3>
			    </div>
			    <!-- /.box-header -->
			    <div class="box-body">
			      <dl>
			        <dt>Nombre:</dt>
			        <dd><?= $messages['name']?></dd>
			        <dt>Correo:</dt>
			        <dd><?= $messages['email']?></dd>
			        <dt>Asunto:</dt>
			        <dd><?= $messages['subject']?></dd>
			        <dt>Mensaje:</dt>
			        <dd><?= $messages['message']?></dd>
			        <dt>Fecha y hora:</dt>
			        <dd><?= date('d-m-Y h:i',$messages['date'])?></dd>
			        <dt>Dirección IP:</dt>
			        <dd><?= $messages['remote_address']?></dd>
			      </dl>
			    </div>
			    <!-- /.box-body -->
			  </div>
			  <!-- /.box -->
			</div>
		</div>


    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->