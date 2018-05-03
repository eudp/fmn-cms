<?php if ($this->session->flashdata('errors')):?>
<div class="form-group">
	<div class="alert alert-danger">
		<ul>
			
			<?php echo $this->session->flashdata('errors'); ?>

		</ul>
	</div>
</div>
<?php endif ?>
