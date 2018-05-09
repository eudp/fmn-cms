<div class="container">
	<div class="row">
		<div class="col-12">
			<table class="table">
				<thead>
					<tr>
					<th scope="col">ID</th>
					<th scope="col">Title</th>
					<th scope="col">Agregar</th>
					</tr>
				</thead>
				<tbody>

					<?php foreach ($element as $element_item): ?>
						<?php 
							if ($table == 'agenda') {
								$id = $element_item['diary_id'];
								$s = '/'. $id;
							} else if ($table == 'noticias'){
								$id = $element_item['news_id'];
								$s = '/'. $id;
							} else if ($table == 'multimedia') {
								$id = $element_item['multimedia_id'];
								$s = '/'. $id;
							} else if ($table == 'enlaces') {
								$id = $element_item['link_id'];
								$s = '';
							}
						?>

						<tr>
							<th scope="row"><?= $id; ?></th>
							<td><a href="<?= site_url( $table . $s);?>"><?= $element_item['title']; ?></a></td>
							<td>
								<form method="post" action="<?= site_url('admin/destacados/' . $table);?>">
									<input type="hidden" name="id" value="<?= $id;?>">
									<button type="submit" class="btn btn-primary">Agregar</button>
								</form>
							</td>
						</tr>

					<?php endforeach; ?>
				</tbody>
			</table>
		</div>

	</div>
</div>