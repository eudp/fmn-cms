<div class="container">
	<div class="row">

		<div class="col-12">
			<table class="table table-sm">
				<thead>
					<tr>
						<th scope="col">Imagen</th>
						<th scope="col">Ancho</th>
						<th scope="col">Alto</th>
						<th scope="col">Eliminar</th>
					</tr>
				</thead>
				<tbody>

					<?php foreach ($photo_gallery as $photo_gallery_item): ?>

						<tr>
							<td><a href="<?= site_url('assets/images') . str_replace('public:/', '', $photo_gallery_item['path']); ?>"><?= $photo_gallery_item['file_name'];?></a></td>
							<td><?= $photo_gallery_item['width']; ?></td>
							<td><?= $photo_gallery_item['height']; ?></td>
							<!-- Handle delete permisology -->
							<td>
								<form method="post" action="<?= site_url('admin/galeria-fotos/'. $photo_gallery_item['photo_gallery_id'] . '/destroy');?>">
										<input type="hidden" name="noticia_id"  value="<?= $news_id; ?>">
									<button type="submit" class="btn btn-danger">Eliminar</button>
								</form>
							</td>
						</tr>

					<?php endforeach; ?>

				</tbody>
			</table>
		</div>

		<div class="col-md-12" style="margin-top: 50px">
			<h4>Asigna una nueva imagen a la galería</h4>
			<?php echo form_open_multipart('admin/galeria-fotos/' . $news_id); ?>

				<input type="hidden" name="noticia_id"  value="<?= $news_id; ?>">

				<div class="form-group">
					<label for="userfile">Seleccione una imagen: </label>
					<input  type="file" class="form-control-file" name="userfile" size="20" required/>
				</div>

 		 		<?php $this->load->view('includes/errors'); ?>
	
				<button type="submit" class="btn btn-primary">Agregar imagen</button>

			</form>
		</div>

	</div>
</div>