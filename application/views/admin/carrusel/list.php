<div class="container">
	<div class="row">
		<div class="col-12">
			<a href="<?= site_url('admin/carrusel/' . $type . '/' . $element_id . '/' . 'new');?>"><button type="button" class="btn btn-success">Agregar carrusel</button></a>
		</div>

		<div class="col-12">
			<table class="table table-sm">
				<thead>
					<tr>
						<th scope="col">Imagen</th>
						<th scope="col">Título</th>
						<th scope="col">Descripción</th>
						<th scope="col">Link ("Ver más...")</th>
						<th scope="col">Ancho</th>
						<th scope="col">Alto</th>
						<th scope="col">Editar</th>
						<th scope="col">Eliminar</th>
					</tr>
				</thead>
				<tbody>

					<?php foreach ($carousel as $carousel_item): ?>

						<tr>
							<td><?= $carousel_item['file_name']; ?></td>
							<td><?= $carousel_item['title']; ?></td>
							<td><?= $carousel_item['description']; ?></td>
							<td><a href="<?= $carousel_item['url']; ?>"><?= $carousel_item['url']; ?></a></td>
							<td><?= $carousel_item['width']; ?></td>
							<td><?= $carousel_item['height']; ?></td>
							<td><a href="<?= site_url('admin/carrusel/'. $carousel_item['carousel_id']);?>" role="button" class="btn btn-primary">Editar</a></td>
							<!-- Handle delete permisology -->
							<td>
								<form method="post" action="<?= site_url('admin/carrusel/'. $carousel_item['carousel_id'] . '/destroy');?>">

										<input type="hidden" name="tipo"  value="<?= $carousel_item['type'] ; ?>">
										<input type="hidden" name="elemento_id"  value="<?= $carousel_item['element_id'] ; ?>">
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