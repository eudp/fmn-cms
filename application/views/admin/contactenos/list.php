<div class="container">
	<div class="row">
		<div class="col-12">
			<table class="table">
				<thead>
					<tr>
					<th scope="col">ID</th>
					<th scope="col">Correo</th>
					<th scope="col">Fecha</th>
					<th scope="col"></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($messages as $messages_item): ?>

						<tr>
							<th scope="row"><?= $messages_item['id']; ?></th>
							<td><?= $messages_item['data']; ?></td>
							<td><?= date('j \d\e F, Y', $messages_item['date']); ?></td>
							<td><a href="<?= site_url('admin/contactenos/'. $messages_item['id']);?>"><button type="button" class="btn btn-success">Vista completa</button></a></td>
						</tr>

					<?php endforeach; ?>
				</tbody>
			</table>
		</div>

	</div>
</div>