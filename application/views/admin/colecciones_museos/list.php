<div class="container">
	<div class="row">
		<div class="col-12"></div>
		<div class="col-12">
			<table class="table">
				<thead>
					<tr>
					<th scope="col">ID</th>
					<th scope="col">Title</th>
					<th scope="col">Carrusel</th>
					<th scope="col">Fecha de creación</th>
					<th scope="col">Fecha de última modificación</th>
					<th scope="col">Status</th>
					<th scope="col">Museo</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($collection as $collection_item): ?>

						<tr>
							<th scope="row"><?= $collection_item['collection_id']; ?></th>
							<td><a href="<?= site_url('admin/colecciones-museos/'. $collection_item['collection_id']);?>"><?= $collection_item['title']; ?></a></td>
							<td><a href="<?= site_url('admin/carrusel-museos/coleccion/'. $collection_item['collection_id']);?>" role="button" class="btn btn-primary">Ver/editar carrusel</a></td>
							<td><?= date('j \d\e F, Y', $collection_item['creation_date']); ?></td>
							<td><?= date('j \d\e F, Y',$collection_item['modified_date']); ?></td>
							<td><?= ($collection_item['status'] == 1 ? 'activo': 'inactivo'); ?></td>
							<td><?= domain_museum($collection_item['museums']); ?></td>
						</tr>

					<?php endforeach; ?>
				</tbody>
			</table>
		</div>

	</div>
</div>