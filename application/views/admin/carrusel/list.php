<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Carrusel
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i>&nbsp;&nbsp;Carrusel</li>
        <li class="active">Lista</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Listado de carrusel</h3>
              <a class= "pull-right" href="<?= site_url('admin/carrusel/' . $type . '/' . $element_id . '/' . 'new');?>"><button type="button" class="btn btn-primary">Agregar carrusel</button></a>
            </div>
            
            <!-- /.box-header -->
            <div class="box-body">
              <table id="list-table" class="table table-bordered table-hover">
                <thead>
                <tr>
						<th>Imagen</th>
						<th>Título</th>
						<th>Descripción</th>
						<th>Link ("Ver más...")</th>
						<th>Ancho</th>
						<th>Alto</th>
						<th>Editar</th>
						<th>Eliminar</th>
					</tr>
				</thead>
				<tbody>

					<?php foreach ($carousel as $carousel_item): ?>

						<tr>
							<td><a href="<?= site_url('assets/images') . str_replace('public:/', '', $carousel_item['path']); ?>"><?= $carousel_item['file_name'];?></a></td>
							<td><?= $carousel_item['title']; ?></td>
							<td><?= $carousel_item['description']; ?></td>
							<td><a href="<?= $carousel_item['url']; ?>"><?= $carousel_item['url']; ?></a></td>
							<td><?= $carousel_item['width']; ?></td>
							<td><?= $carousel_item['height']; ?></td>
							<td><a href="<?= site_url('admin/carrusel/'. $carousel_item['carousel_id']);?>" role="button" class="btn btn-primary">Editar</a></td>
							<!-- Handle delete permisology -->
							<td>
								<form  onsubmit="return confirm('¿Confirmas la eliminación de este elemento?');"  method="post" action="<?= site_url('admin/carrusel/'. $carousel_item['carousel_id'] . '/destroy');?>">

										<input type="hidden" name="tipo"  value="<?= $carousel_item['type'] ; ?>">
										<input type="hidden" name="elemento_id"  value="<?= $carousel_item['element_id'] ; ?>">
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

