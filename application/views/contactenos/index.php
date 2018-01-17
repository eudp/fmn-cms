<div class="container"><div class="row">

<div class="col-12">
	

<?php echo form_open('contactenos/send'); ?>
  <div class="form-group">
    <label for="nombre">Nombre</label>
    <input type="text" class="form-control"  placeholder="" name="nombre">
  </div>
  <div class="form-group">
    <label for="apellido">Apellido</label>
    <input type="text" class="form-control"  placeholder="" name="apellido">
  </div>
  <div class="form-group">
    <label for="email">Correo</label>
    <input type="email" class="form-control"  placeholder="" name="email">
  </div>
    <div class="form-group">
    <label for="asunto">Asunto</label>
    <input type="text" class="form-control"  placeholder="" name="asunto">
  </div>
  <div class="form-group">
    <label for="mensaje">Mensaje</label>
    <textarea name="mensaje"  class="form-control" rows="3" ></textarea>
  </div>

  <button type="submit" class="btn btn-primary">Enviar</button>
</form>
</div>
<div class="col-12">
	<?php echo validation_errors(); ?>
</div></div></div>
