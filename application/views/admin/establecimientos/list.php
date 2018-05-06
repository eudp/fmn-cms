<div class="container">
	<div class="row">
		<div class="col-6">
			<a href="<?= site_url('admin/museo/new');?>"><button type="button" class="btn btn-success">Agregar museo</button></a>
		</div>
		<div class="col-6">
			<a href="<?= site_url('admin/instituto/new');?>"><button type="button" class="btn btn-success">Agregar instituto</button></a>
		</div>

		<div class="col-12">
			<table class="table">
				<thead>
					<tr>
					<th scope="col">ID</th>
					<th scope="col">Title</th>
					<th scope="col">Tipo</th>
					<th scope="col">Carrusel</th>
					<th scope="col">Fecha de creación</th>
					<th scope="col">Fecha de última modificación</th>
					<th scope="col">Status</th>
					<th scope="col">Eliminar</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($establishments as $establishment_item): ?>

						<tr>
							<th scope="row"><?= $establishment_item['establishment_id']; ?></th>
							<td><a href="<?= site_url('admin/establecimientos/'. $establishment_item['establishment_id']);?>"><?= $establishment_item['title']; ?></a></td>
							<td><?= $establishment_item['type']; ?></td>
							<td><a href="<?= site_url('admin/carrusel/' . $establishment_item['type'] . '/' . $establishment_item['establishment_id']);?>" role="button" class="btn btn-primary">Ver/editar carrusel</a></td>
							<td><?= date('j \d\e F, Y', $establishment_item['creation_date']); ?></td>
							<td><?= date('j \d\e F, Y',$establishment_item['modified_date']); ?></td>
							<td><?= ($establishment_item['status'] == 1 ? 'activo' : 'inactivo'); ?></td>
							<!-- Handle delete permisology -->
							<td>
								<form method="post" action="<?= site_url('admin/establecimientos/'. $establishment_item['establishment_id'] . '/destroy');?>">
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