<?php  $this->load->view('includes/header_admin');?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><?php echo lang('create_group_heading');?></h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Grupos</a></li>
        <li class="active">Crear</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo lang('create_group_subheading');?></h3>
              <div id="infoMessage"><?php echo $message;?></div>
            </div>
            <!-- /.box-header -->

			<?php echo form_open("auth/create_group");?>
			<div class="box-body">
				<div class="form-group">
			            <?php echo lang('create_group_name_label', 'group_name');?>
			            <?php echo form_input($group_name);?>
			    </div>

			    <div class="form-group">
			            <?php echo lang('create_group_desc_label', 'description');?> 
			            <?php echo form_input($description);?>
			    </div>
			</div>
			<!-- /.box-body -->

			<div class="box-footer">
				<?php echo form_submit('submit', lang('create_group_submit_btn'));?>
			</div>
			<?php echo form_close();?>
				</div>
			</form>
          </div>
          <!-- /.box -->
        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>

  <?php  $this->load->view('includes/footer_admin');?>