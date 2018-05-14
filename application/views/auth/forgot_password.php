<?php  $this->load->view('includes/header_admin');?>

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo lang('forgot_password_heading');?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Contraseña</a></li>
        <li class="active">Olvidada</li>
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
              <h3 class="box-title"><?php echo sprintf(lang('forgot_password_subheading'), $identity_label);?></h3>
              <div id="infoMessage"><?php echo $message;?></div>
            </div>
            <!-- /.box-header -->

<?php echo form_open("auth/forgot_password");?>

      <div class="box-body">
      <div class="form-group">
      	<label for="identity"><?php echo (($type=='email') ? sprintf(lang('forgot_password_email_label'), $identity_label) : sprintf(lang('forgot_password_identity_label'), $identity_label));?></label> 
      	<?php echo form_input($identity);?>
      </div>
      <!-- /.box-body -->

      <div class="box-footer">


      <?php echo form_submit('submit', lang('forgot_password_submit_btn'));?>
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