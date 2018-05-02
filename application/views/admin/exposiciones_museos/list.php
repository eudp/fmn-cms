<div class="container">
	<div class="row">
		<div class="col-12"></div>
		<div class="col-12">
			<table class="table">
				<thead>
					<tr>
					<th scope="col">ID</th>
					<th scope="col">Title</th>
					<th scope="col">Fecha de creación</th>
					<th scope="col">Fecha de última modificación</th>
					<th scope="col">Status</th>
					<th scope="col">Museo</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($exposition as $exposition_item): ?>

						<tr>
							<th scope="row"><?= $exposition_item['exposition_id']; ?></th>
							<td><a href="<?= site_url('admin/exposiciones-museos/'. $exposition_item['exposition_id']);?>"><?= $exposition_item['title']; ?></a></td>
							<td><?= date('j \d\e F, Y', $exposition_item['creation_date']); ?></td>
							<td><?= date('j \d\e F, Y',$exposition_item['modified_date']); ?></td>
							<td><?= ($exposition_item['status'] == 1 ? 'activo': 'inactivo'); ?></td>
							<td><?= domain_museum($exposition_item['museums']); ?></td>
						</tr>

					<?php endforeach; ?>
				</tbody>
			</table>
		</div>

	</div>
</div>