<div class="container">
	<div class="row">
		<div class="col-12"></div>
		<div class="col-12">
			<a href="<?= site_url('admin/multimedia/new');?>"><button type="button" class="btn btn-success">Agregar multimedia</button></a>
		</div>
		<div class="col-12">
			<table class="table">
				<thead>
					<tr>
					<th scope="col">ID</th>
					<th scope="col">Title</th>
					<th scope="col">Fecha de creación</th>
					<th scope="col">Fecha de última modificación</th>
					<th scope="col">Status</th>
					<th scope="col">Eliminar</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($multimedia as $multimedia_item): ?>

						<tr>
							<th scope="row"><?= $multimedia_item['multimedia_id']; ?></th>
							<td><a href="<?= site_url('admin/multimedia/'. $multimedia_item['multimedia_id']);?>"><?= $multimedia_item['title']; ?></a></td>
							<td><?= date('j \d\e F, Y', $multimedia_item['creation_date']); ?></td>
							<td><?= date('j \d\e F, Y',$multimedia_item['modified_date']); ?></td>
							<td><?= ($multimedia_item['status'] == 1 ? 'activo': 'inactivo'); ?></td>
							<!-- Handle delete permisology -->
							<td>
								<form method="post" action="<?= site_url('admin/multimedia/'. $multimedia_item['multimedia_id'] . '/destroy');?>">
									<button type="submit" class="btn btn-danger">Eliminar</button>
								</form>
							</td>
						</tr>

					<?php endforeach; ?>
				</tbody>
			</table>
		</div>

	</div>
</div>