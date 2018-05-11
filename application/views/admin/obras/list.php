<div class="container">
	<div class="row">
		<div class="col-12"></div>
		<div class="col-12">
			<a href="<?= site_url('admin/obras/new');?>"><button type="button" class="btn btn-success">Agregar obra</button></a>
		</div>
		<div class="col-12">
			<table class="table">
				<thead>
					<tr>
					<th scope="col">ID</th>
					<th scope="col">Autor</th>
					<th scope="col">Title</th>
					<th scope="col">Colección</th>
					<th scope="col">Fecha de creación</th>
					<th scope="col">Fecha de última modificación</th>
					<th scope="col">Status</th>
					<th scope="col">Eliminar</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($obra as $obra_item): ?>

						<tr>
							<th scope="row"><?= $obra_item['obra_id']; ?></th>
							<th scope="row"><?= $obra_item['first_name']; ?></th>
							<td><a href="<?= site_url('admin/obras/'. $obra_item['obra_id']);?>"><?= $obra_item['title']; ?></a></td>
							<th scope="row"><?= $obra_item['title_c']; ?></th>
							<td><?= date('j \d\e F, Y', $obra_item['creation_date']); ?></td>
							<td><?= date('j \d\e F, Y',$obra_item['modified_date']); ?></td>
							<td><?= ($obra_item['status'] == 1 ? 'activo': 'inactivo'); ?></td>
							<!-- Handle delete permisology -->
							<td>
								<form method="post" action="<?= site_url('admin/obras/'. $obra_item['obra_id'] . '/destroy');?>">
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