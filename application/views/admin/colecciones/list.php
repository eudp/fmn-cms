<div class="container">
	<div class="row">
		<div class="col-12"></div>
		<div class="col-12">
			<a href="<?= site_url('admin/nueva_coleccion');?>"><button type="button" class="btn btn-success">Agregar colección</button></a>
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
					<?php foreach ($collection as $collection_item): ?>

						<tr>
							<th scope="row"><?= $collection_item['collection_id']; ?></th>
							<td><a href="<?= site_url('admin/colecciones/'. $collection_item['collection_id']);?>"><?= $collection_item['title']; ?></a></td>
							<td><?= date('j \d\e F, Y', $collection_item['creation_date']); ?></td>
							<td><?= date('j \d\e F, Y',$collection_item['modified_date']); ?></td>
							<td><?= ($collection_item['status'] == 1 ? 'activo': 'inactivo'); ?></td>
							<!-- Handle delete permisology -->
							<td><a href="<?= site_url('admin/eliminar_coleccion/'. $collection_item['collection_id']);?>"><button type="button" class="btn btn-danger">Eliminar</button></a></td>
						</tr>

					<?php endforeach; ?>
				</tbody>
			</table>
		</div>

	</div>
</div>