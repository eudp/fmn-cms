
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Actualizar "<?= $diary['title'];?>"
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Agenda Museos</a></li>
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

				<?php echo form_open_multipart('admin/agenda-museos'); ?>
					<div class="box-body">
						<div class="form-group">
							<label for="titulo">Título</label>
							<input type="text" class="form-control"  placeholder="" name="titulo" value="<?= $diary['title'];?>" required>
							<input type="hidden" placeholder="" name="titulo_original" value="<?= $diary['title'];?>">
						</div>
						<div class="form-group">
							<label for="descripcion">Descripción</label>
							<textarea rows="3" class="form-control" id="descripcion" placeholder="" name="descripcion"></textarea>
							<input type="hidden" id="descripcion-oculta" name="descripcion-oculta" value='<?= $diary["description"];?>'>
						</div>
						<div class="form-group">
							<p>Archivo actual : <a target="_blank" href="<?= site_url('assets/images') . str_replace('public:/', '', $diary['path']); ?>"><?= $diary['file_name'];?></a></p>
							<label for="userfile">Selecciona una nueva imagen</label>
							<input  type="file" class="form-control-file" name="userfile" size="20" />
						</div>
						<div class="form-check">
							<?php $status = ($diary['status'] == 1 ? 'checked' : '');?>
							<input class="form-check-input" name="status" type="checkbox" value="1" <?= $status;?>>
							<label class="form-check-label" for="status">
								Activo
							</label>
						</div>

						<!-- Button trigger modal -->
						<!-- 			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#pick-image" id="pick-image-button">
						Seleccionar imagen
						</button> -->

						<input type="hidden" name="id" value="<?= $diary['diary_id'];?>">

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