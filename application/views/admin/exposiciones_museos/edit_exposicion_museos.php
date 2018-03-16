<div class="container">
	<div class="row">
		<div class="col-12">
			<h3>Actualizar "<?= $exposition['title'];?>"</h3>
		</div>
		<div class="col-12">
			<?php echo form_open_multipart('admin/set_exposicion_museos/'); ?>
			<div class="form-group">
				<label for="titulo">Título</label>
				<input type="text" class="form-control"  placeholder="" name="titulo" value="<?= $exposition['title'];?>">
			</div>
			<div class="form-group">
				<label for="descripcion">Descripción</label>
				<textarea rows="3" class="form-control" id="descripcion" placeholder="" name="descripcion"></textarea>
				<input type="hidden" id="descripcion-oculta" name="descripcion-oculta" value='<?= $exposition["description"];?>'>
			</div>
			<div class="form-group">
				<label for="lugar_exhibicion">Lugar de exhibición</label>
				<input type="text" class="form-control"  placeholder="" name="lugar_exhibicion" value="<?= $exposition['exhibition_place'];?>">
			</div>
			<div class="form-group">
				<label for="horario">Horario</label>
				<input type="text" class="form-control"  placeholder="" name="horario" value="<?= $exposition['schedule'];?>">
			</div>
			<div class="form-check">
				<?php $actual = ($exposition['actual'] == 1 ? 'checked' : '');?>
				<input class="form-check-input" name="actual" type="checkbox" value="1" <?= $actual;?>>
				<label class="form-check-label" for="actual">
					Actual
				</label>
			</div>
			<div class="form-group">
				<p>Archivo actual : <a href="<?= site_url('assets/images') . str_replace('public:/', '', $exposition['path']); ?>"><?= $exposition['file_name'];?></a></p>
				<input  type="file" class="form-control-file" name="userfile" size="20" />
			</div>
			<div class="form-check">
				<?php $status = ($exposition['status'] == 1 ? 'checked' : '');?>
				<input class="form-check-input" name="status" type="checkbox" value="1" <?= $status;?>>
				<label class="form-check-label" for="status">
					Activo
				</label>
			</div>

			<!-- Button trigger modal -->
			<!-- 			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#pick-image" id="pick-image-button">
			Seleccionar imagen
			</button> -->

			<input type="hidden" name="id" value="<?= $exposition['exposition_id'];?>">
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
