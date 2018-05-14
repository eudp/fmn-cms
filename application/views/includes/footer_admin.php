  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
      Administración
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2018 <a href="#">Fundación Nacional de Museos</a>.</strong> Todo los derechos reservados.
  </footer>
    <?php if ($this->ion_auth->is_admin()) : ?>
      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Create the tabs -->
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
          <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-users"></i></a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
          <!-- Home tab content -->
          <div class="tab-pane active" id="control-sidebar-home-tab">
            <h3 class="control-sidebar-heading">Administrador de usuarios</h3>
            <ul class="control-sidebar-menu">
              <li>
                <a href="<?= site_url('auth'); ?>">
                  <i class="menu-icon fa fa-server  bg-red"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Listar usuarios</h4>
                  </div>
                </a>
              </li>
              <li>
                <a href="<?= site_url('auth/create_user/'); ?>">
                  <i class="menu-icon fa fa-user-plus bg-red"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Crear usuario</h4>
                  </div>
                </a>
              </li>
              <li>
                <a href="<?= site_url('auth/create_group/'); ?>">
                  <i class="menu-icon fa fa-object-group bg-red"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Crear grupo</h4>
                  </div>
                </a>
              </li>
            </ul>
            <!-- /.control-sidebar-menu -->
          </div>
          <!-- /.tab-pane -->
        </div>
      </aside>
      <!-- /.control-sidebar -->
    <?php endif ?>
  <!-- Add the sidebar's background. This div must be placed
  immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

</body>
</html>