<div class="container">
	<div class="row">
		<div class="col-12">
			<h3>Actualizar "<?= $multimedia['title'];?>"</h3>
		</div>
		<div class="col-12">
			<?php echo form_open_multipart('admin/multimedia-museos/'); ?>
			<div class="form-group">
				<label for="titulo">Título</label>
				<input type="text" class="form-control"  placeholder="" name="titulo" value="<?= $multimedia['title'];?>">
			</div>
			<div class="form-group">
				<label for="descripcion">Descripción</label>
				<textarea rows="3" class="form-control" id="descripcion" placeholder="" name="descripcion"></textarea>
				<input type="hidden" id="descripcion-oculta" name="descripcion-oculta" value='<?= $multimedia["description"];?>'>
			</div>
			<div class="form-group">
				<p>Archivo actual : <a href="<?= site_url('assets/images') . str_replace('public:/', '', $multimedia['path']); ?>"><?= $multimedia['file_name'];?></a></p>
				<input  type="file" class="form-control-file" name="userfile" size="20" />
			</div>
			<div class="form-group">
				<p>Archivo multimedia actual : <a href="<?= site_url('assets/files') . str_replace('public:/', '', $multimedia['multimedia_path']); ?>"><?= $multimedia['multimedia_name'];?></a></p>
				<input  type="file" class="form-control-file" name="multimediafile" size="20" />
			</div>
			<div class="form-check">
				<?php $status = ($multimedia['status'] == 1 ? 'checked' : '');?>
				<input class="form-check-input" name="status" type="checkbox" value="1" <?= $status;?>>
				<label class="form-check-label" for="status">
					Activo
				</label>
			</div>
			<p>Tipo de multimedia: </p>
			<?php 
				$documento = ($multimedia['type'] == 22 ? 'checked' : '');

			?>
			<div class="custom-control custom-radio">
				<input type="radio" id="customRadio2" name="tipo" class="custom-control-input" value="1" <?= $documento;?>>
				<label class="custom-control-label" for="customRadio2">Documento o guía</label>
			</div>

			<!-- Button trigger modal -->
			<!-- 			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#pick-image" id="pick-image-button">
			Seleccionar imagen
			</button> -->

			<input type="hidden" name="id" value="<?= $multimedia['multimedia_id'];?>">

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
