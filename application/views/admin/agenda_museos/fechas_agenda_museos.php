<div class="container">
	<div class="row">

		<div class="col-12">
			<table class="table table-sm">
				<thead>
					<tr>
						<th scope="col">Fecha</th>
						<th scope="col">Día de la semana</th>
						<th scope="col">Hora</th>
					</tr>
				</thead>
				<tbody>

					<?php foreach ($diary_dates as $diary_date_item): ?>

						<tr>
							<td><?= date('d/m/Y', strtotime($diary_date_item['date'])); ?></td>
							<td><?= date('l', strtotime($diary_date_item['date'])); ?></td>
							<td><?= date('G:i', strtotime($diary_date_item['date'])); ?></td>
						</tr>

					<?php endforeach; ?>

				</tbody>
			</table>
		</div>

	</div>
</div>