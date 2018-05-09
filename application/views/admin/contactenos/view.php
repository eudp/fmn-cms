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

<div class="container">
	<div class="row">
		<div class="col-12">
			<p>Nombre: <?= $messages['name']?></p>
		</div>
		<div class="col-12">
			<p>Correo: <?= $messages['email']?></p>
		</div>
		<div class="col-12">
			<p>Asunto: <?= $messages['subject']?></p>
		</div>
		<div class="col-12">
			<p>Mensaje: <?= $messages['message']?></p>
		</div>
		<div class="col-12">
			<p>Fecha: <?= $messages['date']?></p>
		</div>
		<div class="col-12">
			<p>Dirección IP: <?= $messages['remote_address']?></p>
		</div>
	</div>
</div>