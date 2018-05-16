
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Colecciones
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i>&nbsp;&nbsp;Colecciones</li>
        <li class="active">Lista</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Listado de colecciones</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="list-table" class="table table-bordered table-hover">
                <thead>
                <tr>
        					<th>ID</th>
        					<th>Autor</th>
        					<th>Title</th>
        					<th>Carrusel</th>
        					<th>Url</th>
        					<th>Fecha de creación</th>
        					<th>Fecha de última modificación</th>
        					<th>Status</th>
        					<th>Eliminar</th>
        					</tr>
        				</thead>
        				<tbody>
        					<?php foreach ($collection as $collection_item): ?>

        						<tr>
        							<td><?= $collection_item['collection_id']; ?></td>
        							<td><?= $collection_item['first_name']; ?></td>
        							<td><a href="<?= site_url('admin/colecciones/'. $collection_item['collection_id']);?>"><?= $collection_item['title']; ?></a></td>
        							<td><a href="<?= site_url('admin/carrusel/coleccion/'. $collection_item['collection_id']);?>" role="button" class="btn btn-primary">Ver/editar carrusel</a></td>
        							<td><a target="_blank" href="<?= site_url('colecciones/'. $collection_item['slug']);?>"><?= site_url('colecciones/'. $collection_item['slug']); ?></a></td>
        							<td><?= date('j \d\e F, Y', $collection_item['creation_date']); ?></td>
        							<td><?= date('j \d\e F, Y',$collection_item['modified_date']); ?></td>
        							<td><?= ($collection_item['status'] == 1 ? 'Activo': 'Inactivo'); ?></td>
        							<!-- Handle delete permisology -->
        							<td>
        								<form  onsubmit="return confirm('¿Confirmas la eliminación de este elemento?');" method="post" action="<?= site_url('admin/colecciones/'. $collection_item['collection_id'] . '/destroy');?>">
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

