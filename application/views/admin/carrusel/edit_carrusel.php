
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Actualizar carrusel
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Carrusel</a></li>
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
              <a class="pull-right" href="<?= site_url('admin/carrusel/') . $carousel['type'] . '/' .  $carousel['element_id']; ?>">Volver</a>
            </div>
            <!-- /.box-header -->

			<?php echo form_open_multipart('admin/carrusel'); ?>
				<div class="box-body">
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
						<p>Archivo actual : <a target="_blank" href="<?= site_url('assets/images') . str_replace('public:/', '', $carousel['path']); ?>"><?= $carousel['file_name'];?></a></p>
						<label for="userfile">Selecciona una nueva imagen</label>
						<input  type="file" class="form-control-file" name="userfile" size="20" />
					</div>

					<input type="hidden" name="id" value="<?= $carousel['carousel_id'];?>">
					<input type="hidden" name="tipo"  value="<?= $carousel['type'] ; ?>">
					<input type="hidden" name="elemento_id"  value="<?= $carousel['element_id'] ; ?>">

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