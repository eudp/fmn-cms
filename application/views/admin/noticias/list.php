
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
                  <th>Galería de fotos</th>
                  <th>Url</th>
                  <th>Fecha de creación</th>
                  <th>Fecha de última modificación</th>
                  <th>Fecha de publicación</th>
                  <th>Status</th>
                  <th>Eliminar</th>
                </tr>
                </thead>
                <tbody>

                  <?php foreach ($news as $news_item): ?>

                    <tr>
                      <td><?= $news_item['news_id']; ?></td>
                      <td><?= $news_item['first_name']; ?></td>
                      <td><a href="<?= site_url('admin/noticias/'. $news_item['news_id']);?>"><?= $news_item['title']; ?></a></td>
                      <td><a href="<?= site_url('admin/galeria-fotos/'. $news_item['news_id']);?>" role="button" class="btn btn-primary">Ver/editar galería de fotos</a></td>
                      <td><a target="_blank" href="<?= site_url('noticias/'. $news_item['slug']);?>"><?= site_url('noticias/'. $news_item['slug']); ?></a></td>
                      <td><?= date('j \d\e F, Y', $news_item['creation_date']); ?></td>
                      <td><?= date('j \d\e F, Y',$news_item['modified_date']); ?></td>
                      <td><?= date('j \d\e F, Y',$news_item['publication_date']); ?></td>
                      <td><?= ($news_item['status'] == 1 ? 'Activo': 'Inactivo'); ?></td>
                      <!-- Handle delete permisology -->
                      <td>
                        <form onsubmit="return confirm('¿Confirmas la eliminación de este elemento?');" method="post" action="<?= site_url('admin/noticias/'. $news_item['news_id'] . '/destroy');?>">
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

