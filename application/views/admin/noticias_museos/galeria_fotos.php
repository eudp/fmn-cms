
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
						</tr>

					<?php endforeach; ?>

			       </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

