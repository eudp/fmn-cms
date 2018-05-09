<div class="container"><div class="row">

<div class="col-12">
	

<?php echo form_open('contactenos'); ?>
  <div class="form-group">
    <label for="nombre">Nombre</label>
    <input type="text" class="form-control"  placeholder="" name="nombre" required>
  </div>
  <div class="form-group">
    <label for="email">Correo</label>
    <input type="email" class="form-control"  placeholder="" name="email" required>
  </div>
    <div class="form-group">
    <label for="asunto">Asunto</label>
    <input type="text" class="form-control"  placeholder="" name="asunto" required>
  </div>
  <div class="form-group">
    <label for="mensaje">Mensaje</label>
    <textarea name="mensaje"  class="form-control" rows="3"  required></textarea>
  </div>

  <?php $this->load->view('includes/errors'); ?>
  <?php $this->load->view('includes/success'); ?>

  <button type="submit" class="btn btn-primary">Enviar</button>
</form>
</div>
</div></div>
