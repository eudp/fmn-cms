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
			      <th scope="col">Eliminar</th>
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
				      <!-- Handle delete permisology -->
				      <td><a href="<?= site_url('admin/eliminar_museo/'. $establishment_item['establishment_id']);?>"><button type="button" class="btn btn-danger">Eliminar</button></a></td>
				    </tr>

		        <?php endforeach; ?>
			  </tbody>
			</table>
		</div>
		<div class="col-12">
			<a href="<?= site_url('admin/nuevo_museo/');?>"><button type="button" class="btn btn-success">Agregar museo</button></a>
		</div>
	</div>
</div>