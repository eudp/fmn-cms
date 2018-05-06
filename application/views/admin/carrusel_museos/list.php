<div class="container">
	<div class="row">
		<div class="col-12">
			<table class="table table-sm">
				<thead>
					<tr>
						<th scope="col">Imagen</th>
						<th scope="col">Título</th>
						<th scope="col">Descripción</th>
						<th scope="col">Link ("Ver más...")</th>
						<th scope="col">Editar</th>
					</tr>
				</thead>
				<tbody>

					<?php foreach ($carousel as $carousel_item): ?>

						<tr>
							<td><?= $carousel_item['file_name']; ?></td>
							<td><?= $carousel_item['title']; ?></td>
							<td><?= $carousel_item['description']; ?></td>
							<td><a href="<?= $carousel_item['url']; ?>"><?= $carousel_item['url']; ?></a></td>
							<td><a href="<?= site_url('admin/carrusel-museos/'. $carousel_item['carousel_id']);?>" role="button" class="btn btn-primary">Editar</a></td>
						</tr>

					<?php endforeach; ?>

				</tbody>
			</table>
		</div>
	</div>
</div>