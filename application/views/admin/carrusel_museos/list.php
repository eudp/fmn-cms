
	  <!-- Content Wrapper. Contains page content -->
	  <div class="content-wrapper">
	    <!-- Content Header (Page header) -->
	    <section class="content-header">
	      <h1>
	        Carrusel Museos
	      </h1>
	      <ol class="breadcrumb">
	        <li><i class="fa fa-dashboard"></i>&nbsp;&nbsp;Carrusel Museos</li>
	        <li class="active">Lista</li>
	      </ol>
	    </section>

	    <!-- Main content -->
	    <section class="content">
	      <div class="row">
	        <div class="col-xs-12">
	          <div class="box">
	            <div class="box-header">
	              <h3 class="box-title">Listado de carrusel museos</h3>
	            </div>
	            <!-- /.box-header -->
	            <div class="box-body">
	              <table id="list-table" class="table table-bordered table-hover">
	                <thead>
	                <tr>
						<th>Imagen</th>
						<th>Título</th>
						<th>Descripción</th>
						<th>Link ("Ver más...")</th>
						<th>Ancho</th>
						<th>Alto</th>
						<th>Editar</th>
					</tr>
				</thead>
				<tbody>

					<?php foreach ($carousel as $carousel_item): ?>

						<tr>
							<td><a href="<?= site_url('assets/images') . str_replace('public:/', '', $carousel_item['path']); ?>"><?= $carousel_item['file_name'];?></a></td>
							<td><?= $carousel_item['title']; ?></td>
							<td><?= $carousel_item['description']; ?></td>
							<td><?= $carousel_item['width']; ?></td>
							<td><?= $carousel_item['height']; ?></td>
							<td><a href="<?= $carousel_item['url']; ?>"><?= $carousel_item['url']; ?></a></td>
							<td><a href="<?= site_url('admin/carrusel-museos/'. $carousel_item['carousel_id']);?>" role="button" class="btn btn-primary">Editar</a></td>
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

