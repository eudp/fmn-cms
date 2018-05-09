<?php if ($this->session->flashdata('success')):?>
<div class="form-group">
	<div class="alert alert-success">
		<ul>
			
			<?php echo $this->session->flashdata('success'); ?>

		</ul>
	</div>
</div>
<?php endif ?>
