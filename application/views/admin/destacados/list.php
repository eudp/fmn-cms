<div class="container">
	<div class="row">
		<div class="col-12"></div>
		<div class="col-3">
			<a href="<?= site_url('admin/destacados/agenda');?>"><button type="button" class="btn btn-success">Agregar destacado agenda</button></a>
		</div>
		<div class="col-3">
			<a href="<?= site_url('admin/destacados/noticia');?>"><button type="button" class="btn btn-success">Agregar destacado noticia</button></a>
		</div>
		<div class="col-3">
			<a href="<?= site_url('admin/destacados/multimedia');?>"><button type="button" class="btn btn-success">Agregar destacado multimedia</button></a>
		</div>
		<div class="col-3">
			<a href="<?= site_url('admin/destacados/enlace');?>"><button type="button" class="btn btn-success">Agregar destacado enlace</button></a>
		</div>
		<div class="col-12">
			<table class="table">
				<thead>
					<tr>
					<th scope="col">ID</th>
					<th scope="col">Title</th>
					<th scope="col">Eliminar</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($highlights as $highlights_item): ?>

						<tr>
							<th scope="row"><?= $highlights_item['highlight_id']; ?></th>
							<td><?= $highlights_item['title']; ?></td>
							<!-- Handle delete permisology -->
							<td>
								<form method="post" action="<?= site_url('admin/destacados/'. $highlights_item['highlight_id'] . '/destroy');?>">
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