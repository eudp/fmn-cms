
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Noticias
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i>&nbsp;&nbsp;Noticias</li>
        <li class="active">Lista</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Listado de noticias</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="list-table" class="table table-bordered table-hover">
                <thead>
                <tr>
        					<th>ID</th>
        					<th>Autor</th>
        					<th>Title</th>
        					<th>Tipo</th>
        					<th>Carrusel</th>
        					<th>Url</th>
        					<th>Fecha de creación</th>
        					<th>Fecha de última modificación</th>
        					<th>Status</th>
        					<th>Eliminar</th>
        					</tr>
        				</thead>
        				<tbody>
        					<?php foreach ($establishments as $establishment_item): ?>

        						<tr>
        							<td><?= $establishment_item['establishment_id']; ?></td>
        							<td><?= $establishment_item['first_name']; ?></td>
        							<td><a href="<?= site_url('admin/establecimientos/'. $establishment_item['establishment_id']);?>"><?= $establishment_item['title']; ?></a></td>
        							<td><?= $establishment_item['type']; ?></td>
        							<td><a href="<?= site_url('admin/carrusel/' . $establishment_item['type'] . '/' . $establishment_item['establishment_id']);?>" role="button" class="btn btn-primary">Ver/editar carrusel</a></td>
        							<?php if ($establishment_item['type'] == 'museo'): ?>
        								<td><a target="_blank" href="<?= site_url('museos/'. $establishment_item['slug']);?>"><?= site_url('museos/'. $establishment_item['slug']); ?></a></td>
        							<?php else : ?>
        								<td><a target="_blank" href="<?= site_url('centros/'. $establishment_item['slug']);?>"><?= site_url('centros/'. $establishment_item['slug']); ?></a></td>
        							<?php endif ?>
        							<td><?= date('j \d\e F, Y', $establishment_item['creation_date']); ?></td>
        							<td><?= date('j \d\e F, Y',$establishment_item['modified_date']); ?></td>
        							<td><?= ($establishment_item['status'] == 1 ? 'activo' : 'inactivo'); ?></td>
        							<!-- Handle delete permisology -->
        							<td>
        								<form  onsubmit="return confirm('¿Confirmas la eliminación de este elemento?');" method="post" action="<?= site_url('admin/establecimientos/'. $establishment_item['establishment_id'] . '/destroy');?>">
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

