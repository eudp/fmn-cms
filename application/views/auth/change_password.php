<?php  $this->load->view('includes/header_admin');?>

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo lang('change_password_heading');?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Contraseña</a></li>
        <li class="active">Cambiar</li>
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
              <h3 class="box-title">Cambiar contraseña</h3>
              <div id="infoMessage"><?php echo $message;?></div>
            </div>
            <!-- /.box-header -->

<div id="infoMessage"><?php echo $message;?></div>

<?php echo form_open("auth/change_password");?>

      <div class="box-body">
      <div class="form-group">
            <?php echo lang('change_password_old_password_label', 'old_password');?> <br />
            <?php echo form_input($old_password);?>
      </div>

      <div class="form-group">
            <label for="new_password"><?php echo sprintf(lang('change_password_new_password_label'), $min_password_length);?></label> 
            <?php echo form_input($new_password);?>
      </div>

      <div class="form-group">
            <?php echo lang('change_password_new_password_confirm_label', 'new_password_confirm');?> 
            <?php echo form_input($new_password_confirm);?>
      </div>
      </div>
      <!-- /.box-body -->

      <div class="box-footer">

      <?php echo form_input($user_id);?>
      <?php echo form_submit('submit', lang('change_password_submit_btn'));?>
      </div>

<?php echo form_close();?>
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