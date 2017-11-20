<p class="titulo_login">Entrar</p>

<div class="field field_login">
  <!-- <label for="signin_email">Correo electronico</label><br> -->
  <input style="width: 100%;" type="email" name="signin_email" class="input_login" id="signin_email" placeholder="Correo">
</div>

<div class="field field_login">
  <!-- <label for="signin_password">Contraseña</label><br> -->
  <input style="width: 100%;" type="password" name="signin_password" class="input_login" id="signin_password" placeholder="Contraseña">
</div>

<button id="inicar_sesion" class="success boton_alargado login" type="button" name="button">Entrar</button>

<a href="<?php echo base_url("index.php/Login/sign_up") ?>">Registrarse</a>
