<p class="titulo_login">Registro</p>

<div class="flex">
  <div class="field field_login">
    <!-- <label for="signup_email">Correo electronico</label><br> -->
    <input type="email" name="signup_email" id="signup_email" class="input_login" placeholder="Correo">
  </div>

  <div style="margin-left:20px;" class="field field_login">
    <!-- <label for="signup_nombre">Nombre</label><br> -->
    <input type="text" name="signup_nombre" id="signup_nombre" class="input_login" placeholder="Nombre">
  </div>
</div>

<div class="flex">
  <div class="field field_login">
    <!-- <label for="signup_password">Contraseña</label><br> -->
    <input type="password" name="signup_password" id="signup_password" class="input_login password_field" placeholder="Contraseña">
  </div>

  <div style="margin-left:20px;" class="field field_login">
    <!-- <label for="signup_password_confirm">Confirmar contraseña</label><br> -->
    <input type="password" name="signup_password_confirm" id="signup_password_confirm" placeholder="Confirma tu contraseña" class="input_login password_field">
  </div>
</div>

<div class="flex center-Y button_link_login">
  <button id="enviar_regitro" class="success boton_alargado" type="button" name="button">Registrarse</button>
  <a href="<?php echo base_url("index.php/Login/sign_in") ?>">Entrar</a>
</div>
