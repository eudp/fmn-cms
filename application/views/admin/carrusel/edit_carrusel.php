<div class="container">
	<div class="row">
		<div class="col-12">
			<a href="<?= site_url('admin/carrusel/') . $carousel['type'] . '/' .  $carousel['element_id']; ?>">Volver</a>
		</div>
		<div class="col-12">
			<h3>Actualizar carrusel</h3>
		</div>
		<div class="col-12">
			<?php echo form_open_multipart('admin/carrusel'); ?>
			<div class="form-group">
				<label for="titulo">Título</label>
				<input type="text" class="form-control"  placeholder="" name="titulo" value="<?= $carousel['title'];?>">
			</div>
			<div class="form-group">
				<label for="descripcion">Descripción</label>
				<input type="text" class="form-control"  placeholder="" name="descripcion" value="<?= $carousel['description'];?>">
			</div>
			<div class="form-group">
				<label for="link">Link</label>
				<input type="text" class="form-control"  placeholder="" name="link" value="<?= $carousel['url'];?>">
			</div>

			<div class="form-group">
				<p>Archivo actual : <a href="<?= site_url('assets/images') . str_replace('public:/', '', $carousel['path']); ?>"><?= $carousel['file_name'];?></a></p>
				<input  type="file" class="form-control-file" name="userfile" size="20" />
			</div>

			<input type="hidden" name="id" value="<?= $carousel['carousel_id'];?>">
			<input type="hidden" name="tipo"  value="<?= $carousel['type'] ; ?>">
			<input type="hidden" name="elemento_id"  value="<?= $carousel['element_id'] ; ?>">

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
