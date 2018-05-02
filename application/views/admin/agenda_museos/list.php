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
					<th scope="col">Fecha de publicación</th>
					<th scope="col">Status</th>
					<th scope="col">Museo</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($diary as $diary_item): ?>

						<tr>
							<th scope="row"><?= $diary_item['diary_id']; ?></th>
							<td><a href="<?= site_url('admin/agenda-museos/'. $diary_item['diary_id']);?>"><?= $diary_item['title']; ?></a></td>
							<td><?= date('j \d\e F, Y', $diary_item['creation_date']); ?></td>
							<td><?= date('j \d\e F, Y',$diary_item['modified_date']); ?></td>
							<td><?= date('j \d\e F, Y',$diary_item['publication_date']); ?></td>
							<td><?= ($diary_item['status'] == 1 ? 'activo': 'inactivo'); ?></td>
							<td><?= domain_museum($diary_item['museums']); ?></td>
						</tr>

					<?php endforeach; ?>
				</tbody>
			</table>
		</div>

	</div>
</div>