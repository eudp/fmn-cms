
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Fechas Agenda
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i>&nbsp;&nbsp;Fechas Agenda</li>
        <li class="active">Lista</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Listado de fechas agenda</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="list-table" class="table table-bordered table-hover">
                <thead>
                <tr>
						<th>Fecha</th>
						<th>Día de la semana</th>
						<th>Hora</th>
						<th>Eliminar</th>
					</tr>
				</thead>
				<tbody>

					<?php foreach ($diary_dates as $diary_date_item): ?>

						<tr>
							<td><?= date('d/m/Y', strtotime($diary_date_item['date'])); ?></td>
							<td><?= date('l', strtotime($diary_date_item['date'])); ?></td>
							<td><?= date('G:i', strtotime($diary_date_item['date'])); ?></td>

							<!-- Handle delete permisology -->
							<td>
								<form  onsubmit="return confirm('¿Confirmas la eliminación de este elemento?');" method="post" action="<?= site_url('admin/fechas-agenda/'. $diary_date_item['diary_date_id'] . '/destroy');?>">
									<input type="hidden" name="id" value="<?= $diary_id;?>">
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

		
			<div class="box box-primary">
				 <div class="box-header with-border">
	              	<h3 class="box-title">Asigna una fecha y hora</h3>
	            </div>

				<?php echo form_open('admin/fechas-agenda/' . $diary_id ); ?>
					<div class="box-body">
					
		 		 		<input type="datetime-local" class="form-control" id="diary_date" name="diary_date">

		 		 		<input type="hidden" name="id" value="<?= $diary_id;?>">
		 		 		<small>(La hora está en formato 24 horas e.g. 18:35)</small><br>

		 		 		<?php $this->load->view('includes/errors'); ?>
	 		 		</div>
					<!-- /.box-body -->

					<div class="box-footer">
			
						<button type="submit" class="btn btn-primary">Agregar fecha</button>
					</div>

				</form>
			</div> 
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

