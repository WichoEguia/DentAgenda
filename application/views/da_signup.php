<div class="field">
  <label for="signup_email">Correo electronico</label>
  <input type="email" name="signup_email" id="signup_email">
</div>

<div class="field">
  <label for="signup_nombre">Nombre</label>
  <input type="text" name="signup_nombre" id="signup_nombre">
</div>

<div class="field">
  <label for="signup_password">Contraseña</label>
  <input type="password" name="signup_password" id="signup_password" class="password_field">
</div>

<div class="field">
  <label for="signup_password_confirm">Confirmar contraseña</label>
  <input type="password" name="signup_password_confirm" id="signup_password_confirm" class="password_field">
</div>

<button id="enviar_regitro" class="enviar" type="button" name="button">Registrarse</button>

<script src="<?php echo base_url('assets/js/login.js') ?>" charset="utf-8"></script>
<script type="text/javascript">
  var url = "<?php echo base_url() ?>";

  var login = new Login();
  login.setUrl(url);
  login.ev();
</script>
