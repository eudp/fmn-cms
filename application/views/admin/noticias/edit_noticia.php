<div class="container">
	<div class="row">
		<div class="col-12">
			<h3>Actualizar "<?= $news['title'];?>"</h3>
		</div>
		<div class="col-12">
			<?php echo form_open_multipart('admin/noticias/'); ?>
			<div class="form-group">
				<label for="titulo">Título</label>
				<input type="text" class="form-control"  placeholder="" name="titulo" value="<?= $news['title'];?>">
			</div>
			<div class="form-group">
				<label for="descripcion">Descripción</label>
				<textarea rows="3" class="form-control" id="descripcion" placeholder="" name="descripcion"></textarea>
				<input type="hidden" id="descripcion-oculta" name="descripcion-oculta" value='<?= $news["description"];?>'>
			</div>
			<div class="form-group">
				<label for="resumen">Resumen</label>
				<input type="text" class="form-control"  placeholder="" name="resumen" value="<?= $news['excerpt'];?>">
			</div>
			<div class="form-group">
				<label for="fecha-publicacion">Fecha de publicación</label>
				<input class="form-control" type="date" value="<?= date('Y-m-d',$news['publication_date']);?>" name="fecha-publicacion">
			</div>
			<div class="form-group">
				<p>Archivo actual : <a href="<?= site_url('assets/images') . str_replace('public:/', '', $news['path']); ?>"><?= $news['file_name'];?></a></p>
				<input  type="file" class="form-control-file" name="userfile" size="20" />
			</div>
			<div class="form-check">
				<?php $status = ($news['status'] == 1 ? 'checked' : '');?>
				<input class="form-check-input" name="status" type="checkbox" value="1" <?= $status;?>>
				<label class="form-check-label" for="status">
					Activo
				</label>
			</div>

			<!-- Button trigger modal -->
			<!-- 			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#pick-image" id="pick-image-button">
			Seleccionar imagen
			</button> -->

			<input type="hidden" name="id" value="<?= $news['news_id'];?>">

			<?php $this->load->view('includes/errors'); ?>

			<button type="submit" class="btn btn-primary">Actualizar</button>
			</form>
		</div>
	</div>
</div>



<!-- Modal -->
<!-- <div class="modal fade" id="pick-image" tabindex="-1" role="dialog" aria-labelledby="pick-imageTitle" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="pick-imageTitle">Seleccionar imagen</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<select class="image-picker show-html" id="select-image">
					<option data-img-src="http://placekitten.com/280/300" value="1">Cute Kitten 1</option>
					<option data-img-src="http://placekitten.com/280/150" value="2">Cute Kitten 2</option>
					<option data-img-src="http://placekitten.com/280/270" value="3">Cute Kitten 3</option>
					<option data-img-src="http://placekitten.com/280/320" value="4">Cute Kitten 4</option>
					<option data-img-src="http://placekitten.com/280/200" value="5">Cute Kitten 5</option>
					<option data-img-src="http://placekitten.com/280/170" value="6">Cute Kitten 6</option>
				</select>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
				<button type="button" class="btn btn-primary">Guardar cambios</button>
			</div>
		</div>
	</div>
</div>
 -->
