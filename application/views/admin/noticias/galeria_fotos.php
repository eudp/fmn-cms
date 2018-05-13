
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Galería Fotos
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i>&nbsp;&nbsp;Galería Fotos</li>
        <li class="active">Lista</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Listado de fotos de galería</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="list-table" class="table table-bordered table-hover">
                <thead>
                <tr>
						<th>Imagen</th>
						<th>Ancho</th>
						<th>Alto</th>
						<th>Eliminar</th>
					</tr>
				</thead>
				<tbody>

					<?php foreach ($photo_gallery as $photo_gallery_item): ?>

						<tr>
							<td><a href="<?= site_url('assets/images') . str_replace('public:/', '', $photo_gallery_item['path']); ?>"><?= $photo_gallery_item['file_name'];?></a></td>
							<td><?= $photo_gallery_item['width']; ?></td>
							<td><?= $photo_gallery_item['height']; ?></td>
							<!-- Handle delete permisology -->
							<td>
								<form method="post" action="<?= site_url('admin/galeria-fotos/'. $photo_gallery_item['photo_gallery_id'] . '/destroy');?>">
										<input type="hidden" name="noticia_id"  value="<?= $news_id; ?>">
									<button type="submit" class="btn btn-danger">Eliminar</button>
								</form>
							</td>
						</tr>

					<?php endforeach; ?>


                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
	 </div>
          <!-- /.box -->

			<div class="box box-primary">
				 <div class="box-header with-border">
	              	<h3 class="box-title">Asigna una nueva imagen a la galería</h3>
	            </div>


			<?php echo form_open_multipart('admin/galeria-fotos/' . $news_id); ?>
				<div class="box-body">

					<input type="hidden" name="noticia_id"  value="<?= $news_id; ?>">

					<div class="form-group">
						<label for="userfile">Seleccione una imagen: </label>
						<input  type="file" class="form-control-file" name="userfile" size="20" required/>
					</div>

	 		 		<?php $this->load->view('includes/errors'); ?>

 		 		</div>
				<!-- /.box-body -->

				<div class="box-footer">

					<button type="submit" class="btn btn-primary">Agregar imagen</button>
				</div>

				</form>
			</div> 
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

