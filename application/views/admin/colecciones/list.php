<div class="container">
	<div class="row">
		<div class="col-12"></div>
		<div class="col-12">
			<a href="<?= site_url('admin/colecciones/new');?>"><button type="button" class="btn btn-success">Agregar colección</button></a>
		</div>
		<div class="col-12">
			<table class="table">
				<thead>
					<tr>
					<th scope="col">ID</th>
					<th scope="col">Autor</th>
					<th scope="col">Title</th>
					<th scope="col">Carrusel</th>
					<th scope="col">Url</th>
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
							<th scope="row"><?= $collection_item['first_name']; ?></th>
							<td><a href="<?= site_url('admin/colecciones/'. $collection_item['collection_id']);?>"><?= $collection_item['title']; ?></a></td>
							<td><a href="<?= site_url('admin/carrusel/coleccion/'. $collection_item['collection_id']);?>" role="button" class="btn btn-primary">Ver/editar carrusel</a></td>
							<td><a target="_blank" href="<?= site_url('colecciones/'. $collection_item['slug']);?>"><?= site_url('colecciones/'. $collection_item['slug']); ?></a></td>
							<td><?= date('j \d\e F, Y', $collection_item['creation_date']); ?></td>
							<td><?= date('j \d\e F, Y',$collection_item['modified_date']); ?></td>
							<td><?= ($collection_item['status'] == 1 ? 'activo': 'inactivo'); ?></td>
							<!-- Handle delete permisology -->
							<td>
								<form method="post" action="<?= site_url('admin/colecciones/'. $collection_item['collection_id'] . '/destroy');?>">
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