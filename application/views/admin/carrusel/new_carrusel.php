
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Agregar un elemento para el carrusel
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Carrusel</a></li>
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
			<?php echo form_open_multipart('admin/carrusel'); ?>
				<div class="box-body">
					<div class="form-group">
						<label for="titulo">Título</label>
						<input type="text" class="form-control"  placeholder="" name="titulo" >
					</div>
					<div class="form-group">
						<label for="descripcion">Descripción</label>
						<input type="text" class="form-control"  placeholder="" name="descripcion" >
					</div>
					<div class="form-group">
						<label for="link">Link</label>
						<input type="text" class="form-control"  placeholder="" name="link" >
					</div>
					<div class="form-group">
						<label for="userfile">Imagen</label>
						<input  type="file" class="form-control-file" name="userfile" size="20" required/>
					</div>

					<input type="hidden" name="tipo"  value="<?= $type ; ?>">
					<input type="hidden" name="elemento_id"  value="<?= $element_id ; ?>">
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