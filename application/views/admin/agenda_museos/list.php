
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Agenda Museos
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i>&nbsp;&nbsp;Agenda Museos</li>
        <li class="active">Lista</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Listado de agenda museos</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="list-table" class="table table-bordered table-hover">
                <thead>
                <tr>
        					<th>ID</th>
        					<th>Autor</th>
        					<th>Title</th>
        					<th>Fechas de agenda</th>
        					<th>Url</th>
        					<th>Fecha de creación</th>
        					<th>Fecha de última modificación</th>
        					<th>Fecha de publicación</th>
        					<th>Status</th>
        					<th>Museo</th>
        					</tr>
        				</thead>
        				<tbody>
        					<?php foreach ($diary as $diary_item): ?>

        						<tr>
        							<td><?= $diary_item['diary_id']; ?></td>
        							<td><?= $diary_item['first_name']; ?></td>
        							<td><a href="<?= site_url('admin/agenda-museos/'. $diary_item['diary_id']);?>"><?= $diary_item['title']; ?></a></td>
        							<td><a href="<?= site_url('admin/fechas-agenda-museos/'. $diary_item['diary_id']);?>" role="button" class="btn btn-primary">Ver fechas agenda</a></td>
        							<td><a target="_blank" href="<?= site_url('agenda-museos/'. $diary_item['slug']);?>"><?= site_url('agenda-museos/'. $diary_item['slug']); ?></a></td>
        							<td><?= date('j \d\e F, Y', $diary_item['creation_date']); ?></td>
        							<td><?= date('j \d\e F, Y',$diary_item['modified_date']); ?></td>
        							<td><?= date('j \d\e F, Y',$diary_item['publication_date']); ?></td>
        							<td><?= ($diary_item['status'] == 1 ? 'activo': 'inactivo'); ?></td>
        							<td><?= domain_museum($diary_item['museums']); ?></td>
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

