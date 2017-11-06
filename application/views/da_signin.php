<p class="titulo_login">Entrar</p>

<div class="field field_login">
  <label for="signin_email">Correo electronico</label><br>
  <input type="email" name="signin_email" id="signin_email">
</div>

<div class="field field_login">
  <label for="signin_password">Contraseña</label><br>
  <input type="password" name="signin_password" id="signin_password">
</div>

<button id="inicar_sesion" class="success boton_alargado login" type="button" name="button">Entrar</button>

<a href="<?php echo base_url("index.php/Login/sign_up") ?>">Registrarse</a>
