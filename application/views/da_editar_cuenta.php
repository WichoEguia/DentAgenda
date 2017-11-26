<div id="editar_cuenta">
  <?php echo form_open_multipart('Perfil/editar_datos_cuenta',array("id"=>"formulario_editar_cuenta"));?>
    <input type="hidden" name="id_cuenta" id="id_cuenta" value="">

    <div class="field">
      <span class="obligatorio">*</span><label for="nombre_cuenta">Nombre</label><br>
      <input type="text" name="nombre_cuenta" id="nombre_cuenta" value="">
      <p class="texto_error">Este campo es obligatorio.</p>
    </div>

    <div class="field">
      <span class="obligatorio">*</span><label for="email_cuenta">Email</label><br>
      <input type="text" name="email_cuenta" id="email_cuenta" value="">
      <p class="texto_error">Ingrese un email valido.</p>
    </div>

    <div class="field">
      <label for="foto_perfil">Foto de perfil</label><br>
      <input type="file" name="foto_perfil" id="foto_perfil">
    </div>

    <div class="field">
      <label for="nuevo_password">Nueva Contraseña (Deje en blanco para conservar la contraseña)</label><br>
      <input type="password" name="nuevo_password" id="nuevo_password">
    </div>

    <div class="field">
      <label for="nuevo_password_confirmacion">Confirmar Contraseña</label><br>
      <input type="password" name="nuevo_password_confirmacion" id="nuevo_password_confirmacion">
      <p class="texto_error">Las contraseñas no coinciden.</p>
    </div>

    <input type="submit" value="Guardar" class="success">
    <!-- <button type="button" id="enviar_cambio_cuenta">enviar</button> -->
  </form>
</div>

<script src="<?php echo base_url("assets/js/perfil.js") ?>" charset="utf-8"></script>
<script type="text/javascript">
  $(document).ready(function(){
    var base_url = "<?php echo base_url() ?>";
    var perfil = new Perfil();

    perfil.setUrl(base_url);
    perfil.ev();
    perfil.obttener_datos_perfil();
    perfil.llenar_datos_editar();
  });
</script>
