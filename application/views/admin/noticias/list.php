<div class="container">
	<div class="row">
		<div class="col-12">
			<a href="<?= site_url('admin/nueva_noticia');?>"><button type="button" class="btn btn-success">Agregar noticia</button></a>
		</div>
		<div class="col-12">
			<table class="table">
				<thead>
					<tr>
					<th scope="col">ID</th>
					<th scope="col">Title</th>
					<th scope="col">Fecha de creación</th>
					<th scope="col">Fecha de última modificación</th>
					<th scope="col">Fecha de publicación</th>
					<th scope="col">Status</th>
					<th scope="col">Eliminar</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($news as $news_item): ?>

						<tr>
							<th scope="row"><?= $news_item['news_id']; ?></th>
							<td><a href="<?= site_url('admin/noticias/'. $news_item['news_id']);?>"><?= $news_item['title']; ?></a></td>
							<td><?= date('j \d\e F, Y', $news_item['creation_date']); ?></td>
							<td><?= date('j \d\e F, Y',$news_item['modified_date']); ?></td>
							<td><?= date('j \d\e F, Y',$news_item['publication_date']); ?></td>
							<td><?= ($news_item['status'] == 1 ? 'activo': 'inactivo'); ?></td>
							<!-- Handle delete permisology -->
							<td><a href="<?= site_url('admin/eliminar_noticia/'. $news_item['news_id']);?>"><button type="button" class="btn btn-danger">Eliminar</button></a></td>
						</tr>

					<?php endforeach; ?>
				</tbody>
			</table>
		</div>

	</div>
</div>