<div class="container">
	<div class="row">
		<div class="col-12">
			<table class="table">
				<thead>
					<tr>
					<th scope="col">ID</th>
					<th scope="col">Nombre</th>
					<th scope="col"></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($messages as $messages_item): ?>

						<tr>
							<th scope="row"><?= $messages_item['id']; ?></th>
							<td><?= $messages_item['data']; ?></a></td>
							<!-- Handle delete permisology -->
							<td><a href="<?= site_url('admin/contactenos/'. $messages_item['id']);?>"><button type="button" class="btn btn-success">Vista completa</button></a></td>
						</tr>

					<?php endforeach; ?>
				</tbody>
			</table>
		</div>

	</div>
</div>