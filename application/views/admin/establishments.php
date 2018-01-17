<div class="container">
	<div class="row">
		<div class="col-12">
			<table class="table">
			  <thead>
			    <tr>
			      <th scope="col">ID</th>
			      <th scope="col">Title</th>
			      <th scope="col">Fecha de creación</th>
			      <th scope="col">Fecha de última modificación</th>
			      <th scope="col">Status</th>
			    </tr>
			  </thead>
			  <tbody>
				<?php foreach ($establishments as $establishment_item): ?>
				
					<tr>
				      <th scope="row"><?= $establishment_item['establishment_id']; ?></th>
				      <td><a href="<?= site_url('admin/establecimientos/'. $establishment_item['establishment_id']);?>"><?= $establishment_item['title']; ?></a></td>
				      <td><?= date('j \d\e F, Y', $establishment_item['creation_date']); ?></td>
				      <td><?= date('j \d\e F, Y',$establishment_item['modified_date']); ?></td>
				      <td><?= $establishment_item['status']; ?></td>
				    </tr>

		        <?php endforeach; ?>

			  </tbody>
			</table>
		</div>
	</div>
</div>