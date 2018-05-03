<div class="container">
	<div class="row">

		<div class="col-12">
			<table class="table table-sm">
				<thead>
					<tr>
						<th scope="col">Fecha</th>
						<th scope="col">Día de la semana</th>
						<th scope="col">Hora</th>
						<th scope="col">Eliminar</th>
					</tr>
				</thead>
				<tbody>

					<?php foreach ($diary_dates as $diary_date_item): ?>

						<tr>
							<td><?= date('d/m/Y', strtotime($diary_date_item['date'])); ?></td>
							<td><?= date('l', strtotime($diary_date_item['date'])); ?></td>
							<td><?= date('G:i', strtotime($diary_date_item['date'])); ?></td>

							<!-- Handle delete permisology -->
							<td>
								<form method="post" action="<?= site_url('admin/fechas-agenda/'. $diary_date_item['diary_date_id'] . '/destroy');?>">
									<input type="hidden" name="id" value="<?= $diary_id;?>">
									<button type="submit" class="btn btn-danger">Eliminar</button>
								</form>
							</td>
						</tr>

					<?php endforeach; ?>

				</tbody>
			</table>
		</div>

		<div class="col-md-12" style="margin-top: 50px">
			<h4>Asigna una fecha y hora</h4>
			<?php echo form_open('admin/fechas-agenda/' . $diary_id ); ?>
			
 		 		<input type="datetime-local" class="form-control" id="diary_date" name="diary_date">

 		 		<input type="hidden" name="id" value="<?= $diary_id;?>">
 		 		<small>(La hora está en formato 24 horas e.g. 18:35)</small><br>

 		 		<?php $this->load->view('includes/errors'); ?>
	
				<button type="submit" class="btn btn-primary">Agregar fecha</button>

			</form>
		</div>

	</div>
</div>