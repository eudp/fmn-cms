<div class="container">
	<div class="row">

		<div class="col-12">
			<table class="table table-sm">
				<thead>
					<tr>
						<th scope="col">Imagen</th>
						<th scope="col">Ancho</th>
						<th scope="col">Alto</th>
						<th scope="col">Eliminar</th>
					</tr>
				</thead>
				<tbody>

					<?php foreach ($photo_gallery as $photo_gallery_item): ?>

						<tr>
							<td><a href="<?= site_url('assets/images') . str_replace('public:/', '', $photo_gallery_item['path']); ?>"><?= $photo_gallery_item['file_name'];?></a></td>
							<td><?= $photo_gallery_item['width']; ?></td>
							<td><?= $photo_gallery_item['height']; ?></td>
						</tr>

					<?php endforeach; ?>

				</tbody>
			</table>
		</div>
	</div>
</div>