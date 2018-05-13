
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Contacto
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i>&nbsp;&nbsp;Contacto</li>
        <li class="active">Lista</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Listado de contacto</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="list-table" class="table table-bordered table-hover">
                <thead>
                <tr>
        					<th>ID</th>
        					<th>Nombre</th>
        					<th>Asunto</th>
        					<th>Fecha</th>
        					<th>Dirección IP</th>
        					<th></th>
        					</tr>
        				</thead>
        				<tbody>
        					<?php foreach ($messages as $messages_item): ?>

        						<tr>
        							<td><?= $messages_item['contact_id']; ?></td>
        							<td><?= $messages_item['name']; ?></td>
        							<td><?= $messages_item['subject']; ?></td>
        							<td><?= date('j \d\e F, Y', $messages_item['date']); ?></td>
        							<td><?= $messages_item['remote_address']; ?></td>
        							<td><a href="<?= site_url('admin/contactenos/'. $messages_item['contact_id']);?>"><button type="button" class="btn btn-success">Vista completa</button></a></td>
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

