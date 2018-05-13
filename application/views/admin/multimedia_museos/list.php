
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Multimedia Museos
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i>&nbsp;&nbsp;Multimedia Museos</li>
        <li class="active">Lista</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Listado de multimedia museos</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="list-table" class="table table-bordered table-hover">
                <thead>
                <tr>
        					<th>ID</th>
        					<th>Title</th>
        					<th>Autor</th>
        					<th>Url</th>
        					<th>Fecha de creación</th>
        					<th>Fecha de última modificación</th>
        					<th>Status</th>
        					<th>Museo</th>
        					</tr>
        				</thead>
        				<tbody>
        					<?php foreach ($multimedia as $multimedia_item): ?>

        						<tr>
        							<td><?= $multimedia_item['multimedia_id']; ?></td>
        							<td><?= $multimedia_item['first_name']; ?></td>
        							<td><a href="<?= site_url('admin/multimedia-museos/'. $multimedia_item['multimedia_id']);?>"><?= $multimedia_item['title']; ?></a></td>
        							<td><a target="_blank" href="<?= site_url('multimedia-museos/'. $multimedia_item['slug']);?>"><?= site_url('multimedia-museos/'. $multimedia_item['slug']); ?></a></td>
        							<td><?= date('j \d\e F, Y', $multimedia_item['creation_date']); ?></td>
        							<td><?= date('j \d\e F, Y',$multimedia_item['modified_date']); ?></td>
        							<td><?= ($multimedia_item['status'] == 1 ? 'activo': 'inactivo'); ?></td>
        							<td><?= domain_museum($multimedia_item['museums']); ?></td>
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

