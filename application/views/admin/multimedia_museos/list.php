<div class="container">
	<div class="row">
		<div class="col-12"></div>
		<div class="col-12">
			<table class="table">
				<thead>
					<tr>
					<th scope="col">ID</th>
					<th scope="col">Title</th>
					<th scope="col">Url</th>
					<th scope="col">Fecha de creación</th>
					<th scope="col">Fecha de última modificación</th>
					<th scope="col">Status</th>
					<th scope="col">Museo</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($multimedia as $multimedia_item): ?>

						<tr>
							<th scope="row"><?= $multimedia_item['multimedia_id']; ?></th>
							<td><a href="<?= site_url('admin/multimedia-museos/'. $multimedia_item['multimedia_id']);?>"><?= $multimedia_item['title']; ?></a></td>
							<td><a target="_blank" href="<?= site_url('multimedia-museos/'. $multimedia_item['slug']);?>"><?= site_url('multimedia-museos/'. $multimedia_item['slug']); ?></a></td>
							<td><?= date('j \d\e F, Y', $multimedia_item['creation_date']); ?></td>
							<td><?= date('j \d\e F, Y',$multimedia_item['modified_date']); ?></td>
							<td><?= ($multimedia_item['status'] == 1 ? 'activo': 'inactivo'); ?></td>
							<td><?= domain_museum($multimedia_item['museums']); ?></td>
						</tr>

					<?php endforeach; ?>
				</tbody>
			</table>
		</div>

	</div>
</div>