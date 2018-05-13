
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Obras
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i>&nbsp;&nbsp;Obras</li>
        <li class="active">Lista</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Listado de obras</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="list-table" class="table table-bordered table-hover">
                <thead>
                <tr>
        					<th>ID</th>
        					<th>Autor</th>
        					<th>Title</th>
        					<th>Colección</th>
        					<th>Fecha de creación</th>
        					<th>Fecha de última modificación</th>
        					<th>Status</th>
        					<th>Eliminar</th>
        					</tr>
        				</thead>
        				<tbody>
        					<?php foreach ($obra as $obra_item): ?>

        						<tr>
        							<td><?= $obra_item['obra_id']; ?></td>
        							<td><?= $obra_item['first_name']; ?></td>
        							<td><a href="<?= site_url('admin/obras/'. $obra_item['obra_id']);?>"><?= $obra_item['title']; ?></a></td>
        							<th scope="row"><?= $obra_item['title_c']; ?></th>
        							<td><?= date('j \d\e F, Y', $obra_item['creation_date']); ?></td>
        							<td><?= date('j \d\e F, Y',$obra_item['modified_date']); ?></td>
        							<td><?= ($obra_item['status'] == 1 ? 'activo': 'inactivo'); ?></td>
        							<!-- Handle delete permisology -->
        							<td>
        								<form method="post" action="<?= site_url('admin/obras/'. $obra_item['obra_id'] . '/destroy');?>">
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

