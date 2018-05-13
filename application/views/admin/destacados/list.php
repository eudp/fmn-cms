
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Destacados
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i>&nbsp;&nbsp;Destacados</li>
        <li class="active">Lista</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Listado de Destacados</h3>
              <a class="pull-right" href="<?= site_url('admin/destacados/agenda');?>"><button type="button" class="btn btn-primary">Agregar destacado agenda</button></a>
              <a class="pull-right" href="<?= site_url('admin/destacados/noticia');?>"><button type="button" class="btn btn-primary">Agregar destacado noticia</button></a>
              <a class="pull-right" href="<?= site_url('admin/destacados/multimedia');?>"><button type="button" class="btn btn-primary">Agregar destacado multimedia</button></a>
              <a class="pull-right" href="<?= site_url('admin/destacados/enlace');?>"><button type="button" class="btn btn-primary">Agregar destacado enlace</button></a>
            </div>
            
            <!-- /.box-header -->
            <div class="box-body">
              <table id="list-table" class="table table-bordered table-hover">
                <thead>
                <tr>
					<th>ID</th>
					<th>Title</th>
					<th>Eliminar</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($highlights as $highlights_item): ?>

						<tr>
							<td><?= $highlights_item['highlight_id']; ?></td>
							<td><?= $highlights_item['title']; ?></td>
							<!-- Handle delete permisology -->
							<td>
								<form method="post" action="<?= site_url('admin/destacados/'. $highlights_item['highlight_id'] . '/destroy');?>">
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
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

