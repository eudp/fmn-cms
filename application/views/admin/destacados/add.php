
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Destacados
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i>&nbsp;&nbsp;Destacados</li>
        <li class="active">Agregar</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Agregar destacado</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="list-table" class="table table-bordered table-hover">
                <thead>
                <tr>
					<th>ID</th>
					<th>Title</th>
					<th>Agregar</th>
					</tr>
				</thead>
				<tbody>

					<?php foreach ($element as $element_item): ?>
						<?php 
							if ($table == 'agenda') {
								$id = $element_item['diary_id'];
								$s = '/'. $id;
							} else if ($table == 'noticias'){
								$id = $element_item['news_id'];
								$s = '/'. $id;
							} else if ($table == 'multimedia') {
								$id = $element_item['multimedia_id'];
								$s = '/'. $id;
							} else if ($table == 'enlaces') {
								$id = $element_item['link_id'];
								$s = '';
							}
						?>

						<tr>
							<td><?= $id; ?></td>
							<td><a href="<?= site_url( $table . $s);?>"><?= $element_item['title']; ?></a></td>
							<td>
								<form method="post" action="<?= site_url('admin/destacados/' . $table);?>">
									<input type="hidden" name="id" value="<?= $id;?>">
									<button type="submit" class="btn btn-primary">Agregar</button>
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

