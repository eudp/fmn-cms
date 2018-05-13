
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Fechas Agenda Museos
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i>&nbsp;&nbsp;Fechas Agenda Museos</li>
        <li class="active">Lista</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Listado de fechas agenda museos</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="list-table" class="table table-bordered table-hover">
                <thead>
                <tr>
						<th>Fecha</th>
						<th>Día de la semana</th>
						<th>Hora</th>
					</tr>
				</thead>
				<tbody>

					<?php foreach ($diary_dates as $diary_date_item): ?>

						<tr>
							<td><?= date('d/m/Y', strtotime($diary_date_item['date'])); ?></td>
							<td><?= date('l', strtotime($diary_date_item['date'])); ?></td>
							<td><?= date('G:i', strtotime($diary_date_item['date'])); ?></td>
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

