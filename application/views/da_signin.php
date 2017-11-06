<div class="field">
  <label for="signin_email">Correo electronico</label>
  <input type="email" name="signin_email" id="signin_email">
</div>

<div class="field">
  <label for="signin_password">Contraseña</label>
  <input type="password" name="signin_password" id="signin_password">
</div>

<button id="inicar_sesion" class="enviar" type="button" name="button">Entrar</button>

<script src="<?php echo base_url('assets/js/login.js') ?>" charset="utf-8"></script>
<script type="text/javascript">
  var url = "<?php echo base_url() ?>";

  var login = new Login();
  login.setUrl(url);
  login.ev();
</script>
