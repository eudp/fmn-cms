
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Agregar nueva agenda
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Agenda</a></li>
        <li class="active">Crear</li>
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
			<?php echo form_open_multipart('admin/agenda/'); ?>
				<div class="box-body">
					<div class="form-group">
						<label for="titulo">Título</label>
						<input type="text" class="form-control"  placeholder="" name="titulo" required>
					</div>
					<div class="form-group">
						<label for="descripcion">Descripción</label>
						<textarea rows="3" class="form-control" id="descripcion" placeholder="" name="descripcion" "></textarea>
						<input type="hidden" id="descripcion-oculta" name="descripcion-oculta">
					</div>
					<div class="form-group">
						<label for="id_establecimiento">Selecciona un establecimiento:</label>
						<select class="form-control" id="id_establecimiento" name="id_establecimiento">
							<?php foreach ($establishments as $establishment_item): ?>

									<option value="<?= $establishment_item['establishment_id']; ?>"><?= $establishment_item['title']; ?></option>
								
							<?php endforeach; ?>
						</select>
					</div>
					<div class="form-group">
						<label for="userfile">Imagen</label>
						<input  type="file" class="form-control-file" name="userfile" size="20" />
					</div>
					<div class="form-check">
						<input class="form-check-input" name='status' type="checkbox" value="1">
						<label class="form-check-label" for="status">
							Activo
						</label>
					</div>

					<input type="hidden" name="id" >

					<?php $this->load->view('includes/errors'); ?>
				</div>
				<!-- /.box-body -->

				<div class="box-footer">
					<button type="submit" class="btn btn-primary">Crear</button>
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