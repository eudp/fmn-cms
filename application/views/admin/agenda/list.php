<div class="container">
	<div class="row">
		<div class="col-12"></div>
		<div class="col-12">
			<a href="<?= site_url('admin/agenda/new');?>"><button type="button" class="btn btn-success">Agregar agenda</button></a>
		</div>
		<div class="col-12">
			<table class="table">
				<thead>
					<tr>
					<th scope="col">ID</th>
					<th scope="col">Autor</th>
					<th scope="col">Title</th>
					<th scope="col">Fechas de agenda</th>
					<th scope="col">Url</th>
					<th scope="col">Fecha de creación</th>
					<th scope="col">Fecha de última modificación</th>
					<th scope="col">Fecha de publicación</th>
					<th scope="col">Status</th>
					<th scope="col">Eliminar</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($diary as $diary_item): ?>

						<tr>
							<th scope="row"><?= $diary_item['diary_id']; ?></th>
							<th scope="row"><?= $diary_item['first_name']; ?></th>
							<td><a href="<?= site_url('admin/agenda/'. $diary_item['diary_id']);?>"><?= $diary_item['title']; ?></a></td>
							<td><a href="<?= site_url('admin/fechas-agenda/'. $diary_item['diary_id']);?>" role="button" class="btn btn-primary">Ver/agregar/eliminar fechas agenda</a></td>
							<td><a target="_blank" href="<?= site_url('agenda/'. $diary_item['slug']);?>"><?= site_url('agenda/'. $diary_item['slug']); ?></a></td>
							<td><?= date('j \d\e F, Y', $diary_item['creation_date']); ?></td>
							<td><?= date('j \d\e F, Y',$diary_item['modified_date']); ?></td>
							<td><?= date('j \d\e F, Y',$diary_item['publication_date']); ?></td>
							<td><?= ($diary_item['status'] == 1 ? 'activo': 'inactivo'); ?></td>
							<!-- Handle delete permisology -->
							<td>
								<form method="post" action="<?= site_url('admin/agenda/'. $diary_item['diary_id'] . '/destroy');?>">
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