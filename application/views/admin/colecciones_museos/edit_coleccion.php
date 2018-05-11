<div class="container">
	<div class="row">
		<div class="col-12">
			<h3>Actualizar "<?= $collection['title'];?>"</h3>
		</div>
		<div class="col-12">
			<?php echo form_open_multipart('admin/colecciones-museos/'); ?>
			<div class="form-group">
				<label for="titulo">Título</label>
				<input type="text" class="form-control"  placeholder="" name="titulo" value="<?= $collection['title'];?>">
				<input type="hidden"  placeholder="" name="titulo_original" value="<?= $collection['title'];?>">
			</div>
			<div class="form-group">
				<label for="descripcion">Descripción</label>
				<textarea rows="3" class="form-control" id="descripcion" placeholder="" name="descripcion"></textarea>
				<input type="hidden" id="descripcion-oculta" name="descripcion-oculta" value='<?= $collection["description"];?>'>
			</div>
			<div class="form-group">
				<p>Archivo actual : <a href="<?= site_url('assets/images') . str_replace('public:/', '', $collection['path']); ?>"><?= $collection['file_name'];?></a></p>
				<input  type="file" class="form-control-file" name="userfile" size="20" />
			</div>
			<div class="form-check">
				<?php $status = ($collection['status'] == 1 ? 'checked' : '');?>
				<input class="form-check-input" name="status" type="checkbox" value="1" <?= $status;?>>
				<label class="form-check-label" for="status">
					Activo
				</label>
			</div>

			<input type="hidden" name="id" value="<?= $collection['collection_id'];?>">

			<?php $this->load->view('includes/errors'); ?>
			
			<button type="submit" class="btn btn-primary">Actualizar</button>
			</form>
		</div>
	</div>
</div>
