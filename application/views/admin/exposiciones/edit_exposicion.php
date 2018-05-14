
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Actualizar "<?= $exposition['title'];?>"
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Exposiciones</a></li>
        <li class="active">Editar</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Completa los campos</h3>
            </div>
            <!-- /.box-header -->
			<?php echo form_open_multipart('admin/exposiciones/'); ?>
			<div class="box-body">
			<div class="form-group">
				<label for="titulo">Título</label>
				<input type="text" class="form-control"  placeholder="" name="titulo" value="<?= $exposition['title'];?>" required>
				<input type="hidden" placeholder="" name="titulo_original" value="<?= $exposition['title'];?>">
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
				<label for="id_establecimiento">Selecciona un establecimiento</label>
				<select class="form-control" id="id_establecimiento" name="id_establecimiento">
					<?php foreach ($establishments as $establishment_item): ?>

						<?php if ($establishment_item['establishment_id'] == $exposition['establishment_id']){ ?>
							<option value="<?= $establishment_item['establishment_id']; ?>" selected><?= $establishment_item['title']; ?></option>
						<?php } else { ?>
							<option value="<?= $establishment_item['establishment_id']; ?>"><?= $establishment_item['title']; ?></option>
						<?php } ?>
					<?php endforeach; ?>
				</select>
			</div>
			<div class="form-group">
				<p>Archivo actual : <a target="_blank" href="<?= site_url('assets/images') . str_replace('public:/', '', $exposition['path']); ?>"><?= $exposition['file_name'];?></a></p>
				<label for="userfile">Selecciona una nueva imagen</label>
				<input  type="file" class="form-control-file" name="userfile" size="20" />
			</div>
			<div class="form-check">
				<?php $status = ($exposition['status'] == 1 ? 'checked' : '');?>
				<input class="form-check-input" name="status" type="checkbox" value="1" <?= $status;?>>
				<label class="form-check-label" for="status">
					Activo
				</label>
			</div>

			<input type="hidden" name="id" value="<?= $exposition['exposition_id'];?>">

			<?php $this->load->view('includes/errors'); ?>
			
			</div>
				<!-- /.box-body -->

				<div class="box-footer">
					<button type="submit" class="btn btn-primary">Actualizar</button>
				</div>
			</form>
          </div>
          <!-- /.box -->
        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>