<div class="container">
	<div class="row">
		<div class="col-12"></div>
		<div class="col-12">
			<a href="<?= site_url('admin/exposiciones/new');?>"><button type="button" class="btn btn-success">Agregar exposicion</button></a>
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
					<?php foreach ($exposition as $exposition_item): ?>

						<tr>
							<th scope="row"><?= $exposition_item['exposition_id']; ?></th>
							<td><a href="<?= site_url('admin/exposiciones/'. $exposition_item['exposition_id']);?>"><?= $exposition_item['title']; ?></a></td>
							<td><?= date('j \d\e F, Y', $exposition_item['creation_date']); ?></td>
							<td><?= date('j \d\e F, Y',$exposition_item['modified_date']); ?></td>
							<td><?= ($exposition_item['status'] == 1 ? 'activo': 'inactivo'); ?></td>
							<!-- Handle delete permisology -->
							<td>
								<form method="post" action="<?= site_url('admin/exposiciones/'. $exposition_item['exposition_id'] . '/destroy');?>">
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