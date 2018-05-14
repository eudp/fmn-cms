
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Actualizar "<?= $establishment['title'];?>"
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Establecimientos</a></li>
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

			<?php echo form_open_multipart('admin/establecimientos/' . $establishment['type']); ?>
			<div class="box-body">
			<div class="form-group">
				<label for="acronimo">Acrónimo</label>
				<input type="text" class="form-control"  placeholder="" name="acronimo" value="<?= $establishment['acronym'];?>">
			</div>
			<div class="form-group">
				<label for="titulo">Título</label>
				<input type="text" class="form-control"  placeholder="" name="titulo" value="<?= $establishment['title'];?>" required>
				<input type="hidden"  placeholder="" name="titulo_original" value="<?= $establishment['title'];?>">
			</div>
			<div class="form-group">
				<label for="descripcion">Descripción</label>
				<textarea rows="3" class="form-control" id="descripcion" placeholder="" name="descripcion" "></textarea>
				<input type="hidden" id="descripcion-oculta" name="descripcion-oculta" value='<?= $establishment["description"];?>'>
			</div>
			<div class="form-group">
				<label for="direccion">Dirección</label>
				<input type="text" class="form-control"  placeholder="" name="direccion" value="<?= $establishment['address'];?>">
			</div>
			<div class="form-group">
				<label for="telefono">Teléfono</label>
				<input type="tel" class="form-control"  placeholder="" name="telefono" value="<?= $establishment['phone'];?>">
			</div>
			<div class="form-group">
				<label for="correo">Correo</label>
				<input type="email" class="form-control"  placeholder="" name="correo" value="<?= $establishment['email'];?>">
			</div>
			<div class="form-group">
				<label for="facebook">Facebook</label>
				<input type="text" class="form-control"  placeholder="" name="facebook" value="<?= $establishment['facebook_url'];?>">
			</div>
			<div class="form-group">
				<label for="instagram">Instagram</label>
				<input type="text" class="form-control"  placeholder="" name="instagram" value="<?= $establishment['instagram_url'];?>">
			</div>
			<div class="form-group">
				<label for="twitter">Twitter</label>
				<input type="text" class="form-control"  placeholder="" name="twitter" value="<?= $establishment['twitter_url'];?>">
			</div>
			<div class="form-group">
				<label for="url">Site url</label>
				<input type="text" class="form-control"  placeholder="" name="url" value="<?= $establishment['site_url'];?>">
			</div>
			<div class="form-group">
				<label for="horario">Horario</label>
				<input type="text" class="form-control"  placeholder="" name="horario" value="<?= $establishment['schedule'];?>">
			</div>

			<?php if ($establishment['type'] == 'museo') :?>

				<p>Servicios</p>

				<div class="form-check form-check-inline">
					<input class="form-check-input" name="ser_1" type="checkbox" value="1" <?= $services[0];?>>
					<label class="form-check-label" for="ser_1">Información</label>
				</div>
				<div class="form-check form-check-inline">
					<input class="form-check-input" name="ser_2" type="checkbox" value="1" <?= $services[1];?>>
					<label class="form-check-label" for="ser_2">Cafetín</label>
				</div>
				<div class="form-check form-check-inline">
					<input class="form-check-input" name="ser_3" type="checkbox" value="1" <?= $services[2];?>>
					<label class="form-check-label" for="ser_3">Teléfono</label>
				</div>
				<div class="form-check form-check-inline">
					<input class="form-check-input" name="ser_4" type="checkbox" value="1" <?= $services[3];?>>
					<label class="form-check-label" for="ser_4">Estacionamiento</label>
				</div>
				<div class="form-check form-check-inline">
					<input class="form-check-input" name="ser_5" type="checkbox" value="1" <?= $services[4];?>>
					<label class="form-check-label" for="ser_5">Baño</label>
				</div>
				<div class="form-check form-check-inline">
					<input class="form-check-input" name="ser_6" type="checkbox" value="1" <?= $services[5];?>>
					<label class="form-check-label" for="ser_6">Tienda</label>
				</div>
				<div class="form-check form-check-inline">
					<input class="form-check-input" name="ser_7" type="checkbox" value="1" <?= $services[6];?>>
					<label class="form-check-label" for="ser_7">WIFI</label>
				</div>
				<div class="form-check form-check-inline">
					<input class="form-check-input" name="ser_8" type="checkbox" value="1" <?= $services[7];?>>
					<label class="form-check-label" for="ser_8">Ascensor</label>
				</div>
				<div class="form-check form-check-inline">
					<input class="form-check-input" name="ser_9" type="checkbox" value="1" <?= $services[8];?>>
					<label class="form-check-label" for="ser_9">Escaleras</label>
				</div>
				<div class="form-check form-check-inline">
					<input class="form-check-input" name="ser_10" type="checkbox" value="1" <?= $services[9];?>>
					<label class="form-check-label" for="ser_10">Cine</label>
				</div>
				<div class="form-check form-check-inline">
					<input class="form-check-input" name="ser_11" type="checkbox" value="1" <?= $services[10];?>>
					<label class="form-check-label" for="ser_11">Multimedia</label>
				</div>
				<div class="form-check form-check-inline">
					<input class="form-check-input" name="ser_12" type="checkbox" value="1" <?= $services[11];?>>
					<label class="form-check-label" for="ser_12">Primeros auxilios</label>
				</div>
				<div class="form-check form-check-inline">
					<input class="form-check-input" name="ser_13" type="checkbox" value="1" <?= $services[12];?>>
					<label class="form-check-label" for="ser_13">Silla de ruedas</label>
				</div>
				<div class="form-check form-check-inline">
					<input class="form-check-input" name="ser_14" type="checkbox" value="1" <?= $services[13];?>>
					<label class="form-check-label" for="ser_14">Biblioteca</label>
				</div>

			<?php else : ?>

				<div class="form-group">
					<label for="servicio">Servicio</label>
					<input type="text" class="form-control"  placeholder="" name="servicio"  value="<?= $establishment['services'];?>">
				</div>

			<?php endif ?>

			<div class="form-group">
				<p>Archivo actual : <a target="_blank" href="<?= site_url('assets/images') . str_replace('public:/', '', $establishment['path']); ?>"><?= $establishment['file_name'];?></a></p>
				<label for="userfile">Selecciona una nueva imagen</label>
				<input  type="file" class="form-control-file" name="userfile" size="20" />
			</div>
			<div class="form-check">
				<?php $status = ($establishment['status'] == 1 ? 'checked' : '');?>
				<input class="form-check-input" name="status" type="checkbox" value="1" <?= $status;?>>
				<label class="form-check-label" for="status">
					Activo
				</label>
			</div>

			<input type="hidden" name="id" value="<?= $establishment['establishment_id'];?>">

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