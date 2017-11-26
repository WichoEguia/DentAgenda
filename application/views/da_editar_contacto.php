<?php echo form_open_multipart('Contactos/edita_contacto',array("id"=>"formulario_nuevo_contacto"));?>
  <div id="contacto_container" class="flex">
    <div class="">
      <input type="hidden" name="idcontacto" value="<?php echo isset($idcontacto) ? $idcontacto : "" ?>">

      <div class="field">
        <span class="obligatorio">*</span><label for="folio_contacto">Folio</label><br>
        <input type="text" name="folio_contacto" id="folio_contacto" value="<?php echo isset($folio) ? $folio : "" ?>">
        <p class="texto_error">Ingrese un folio.</p>
      </div>

      <div class="flex">
        <div class="field">
          <span class="obligatorio">*</span><label for="nombre_contacto">Nombre</label><br>
          <input type="text" name="nombre_contacto" id="nombre_contacto" value="<?php echo isset($nombre) ? $nombre : "" ?>">
          <p class="texto_error">Este campo es obligatorio.</p>
        </div>

        <div style="margin-left: 10px;" class="field">
          <label for="email_contacto">Email</label><br>
          <input type="text" name="email_contacto" id="email_contacto" value="<?php echo isset($email) ? $email : "" ?>">
          <p class="texto_error">El correo es invalido.</p>
        </div>
      </div>

      <div class="flex">
        <div class="field">
          <span class="obligatorio">*</span><label for="telefono_contacto">Telefono</label><br>
          <input type="text" name="telefono_contacto" id="telefono_contacto" value="<?php echo isset($telefono_principal) ? $telefono_principal : "" ?>">
          <p class="texto_error">Se necesita un telefono de contacto.</p>
        </div>

        <div style="margin-left: 10px;" class="field">
          <label for="telefono_secundario_contacto">Telefono auxiliar</label><br>
          <input type="text" name="telefono_secundario_contacto" id="telefono_secundario_contacto" value="<?php echo isset($telefono_auxiliar) ? $telefono_auxiliar : "" ?>">
        </div>
      </div>

      <div class="field" id="field_alergias_contacto">
        <label for="alergias_contacto">Alergias</label><br>
        <input type="text" name="alergias_contacto" id="alergias_contacto" value="<?php echo isset($alergias) ? $alergias : "" ?>">
      </div>

      <input type="submit" class="success" value="Guardar">
    </div>

    <div class="field" style="margin-left: 10px;">
      <div class="field" id="sangre_contacto">
        <span class="obligatorio">*</span><label for="tipo_sangre_contacto">Tipo de sangre</label><br>
        <select id="select_tipo_sangre_contacto" name="tipo_sangre_contacto" value="<?php echo isset($tipo_sangre) ? $tipo_sangre : "" ?>">
          <option disabled value="">Seleccione</option>
          <option value="A">A</option>
          <option value="B">B</option>
          <option value="AB">AB</option>
          <option value="O">O</option>
        </select>
        <p class="texto_error">Seleccione una opcion.</p>
      </div>

      <div class="field" id="field_sexofoto_contacto">
        <span class="obligatorio">*</span><label for="sexo_contacto">Sexo de contacto</label><br>
        <select id="select_sexo_contacto" name="sexo_contacto" value="<?php echo isset($sexo) ? $sexo : "" ?>">
          <option disabled value="">Seleccione</option>
          <option value="hombre">Masculino</option>
          <option value="mujer">Femenino</option>
        </select>
        <p class="texto_error">Seleccione una opcion.</p>
      </div>

      <div class="field" id="field_foto_contacto">
        <label for="foto_contacto">Foto del contacto</label><br>
        <input type="file" name="foto_contacto" id="input_foto_contacto" value="<?php echo isset($foto) ? $foto : "" ?>">
      </div>
    </div>
  </div>
</form>

<script src="<?php echo base_url("assets/js/contacto.js") ?>" charset="utf-8"></script>
<script type="text/javascript">
$(document).ready(function(){
    var url = "<?php echo base_url() ?>";

    var contacto = new Contacto();
    contacto.setUrl(url);
    contacto.ev();

    $('#select_tipo_sangre_contacto option[value="<?php echo isset($tipo_sangre) ? $tipo_sangre : "" ?>"]').attr("selected", true);
    $('#select_sexo_contacto option[value="<?php echo isset($sexo) ? $sexo : "" ?>"]').attr("selected", true);
  });
</script>
