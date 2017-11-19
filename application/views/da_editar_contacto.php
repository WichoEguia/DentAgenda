<?php echo form_open_multipart('Contactos/edita_contacto',array("id"=>"formulario_nuevo_contacto"));?>
  <div id="contacto_container" class="flex">
    <div class="">
      <input type="hidden" name="idcontacto" value="<?php echo isset($idcontacto) ? $idcontacto : "" ?>">

      <div class="field">
        <label for="folio_contacto">Folio</label><br>
        <input type="text" name="folio_contacto" id="folio_contacto" value="<?php echo isset($folio) ? $folio : "" ?>">
      </div>

      <div class="flex">
        <div class="field">
          <label for="nombre_contacto">Nombre</label><br>
          <input type="text" name="nombre_contacto" id="nombre_contacto" value="<?php echo isset($nombre) ? $nombre : "" ?>">
        </div>

        <div style="margin-left: 10px;" class="field">
          <label for="email_contacto">Email</label><br>
          <input type="text" name="email_contacto" id="email_contacto" value="<?php echo isset($email) ? $email : "" ?>">
        </div>
      </div>

      <div class="flex">
        <div class="field">
          <label for="telefono_contacto">Telefono</label><br>
          <input type="text" name="telefono_contacto" id="telefono_contacto" value="<?php echo isset($telefono_principal) ? $telefono_principal : "" ?>">
        </div>

        <div style="margin-left: 10px;" class="field">
          <label for="telefono_secundario_contacto">Telefono auxiliar</label><br>
          <input type="text" name="telefono_secundario_contacto" id="telefono_secundario_contacto" value="<?php echo isset($telefono_auxiliar) ? $telefono_auxiliar : "" ?>">
        </div>
      </div>

      <div class="field">
        <label for="tipo_contacto">Tipo de contacto</label>
        <select id="select_tipo_contacto" name="tipo_contacto" value="<?php echo isset($tipo_contacto) ? $tipo_contacto : "" ?>">
          <option disabled value="">Seleccione</option>
          <option value="cliente">Paciente</option>
          <option value="proveedor">Proveedor</option>
        </select>
      </div>

      <div class="field" id="field_alergias_contacto">
        <label for="alergias_contacto">Alergias</label><br>
        <input type="text" name="alergias_contacto" id="alergias_contacto" value="<?php echo isset($alergias) ? $alergias : "" ?>">
      </div>

      <input type="submit" class="success" value="Guardar">
    </div>

    <div class="">
      <div class="field" id="sangre_contacto">
        <label for="tipo_sangre_contacto">Tipo de sangre</label>
        <select id="select_tipo_sangre_contacto" name="tipo_sangre_contacto" value="<?php echo isset($tipo_sangre) ? $tipo_sangre : "" ?>">
          <option disabled value="">Seleccione</option>
          <option value="A">A</option>
          <option value="B">B</option>
          <option value="AB">AB</option>
          <option value="O">O</option>
        </select>
      </div>

      <div class="field" id="field_sexofoto_contacto">
        <label for="sexo_contacto">Sexo de contacto</label>
        <select id="select_sexo_contacto" name="sexo_contacto" value="<?php echo isset($sexo) ? $sexo : "" ?>">
          <option disabled value="">Seleccione</option>
          <option value="hombre">Masculino</option>
          <option value="mujer">Femenino</option>
        </select>
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

    $('#select_tipo_contacto option[value="<?php echo isset($tipo_contacto) ? $tipo_contacto : "" ?>"]').attr("selected", true);
    $('#select_tipo_sangre_contacto option[value="<?php echo isset($tipo_sangre) ? $tipo_sangre : "" ?>"]').attr("selected", true);
    $('#select_sexo_contacto option[value="<?php echo isset($sexo) ? $sexo : "" ?>"]').attr("selected", true);

    if($("#select_tipo_contacto").val() == "cliente"){
      $("#field_alergias_contacto, #sangre_contacto").addClass("activo");
    }
  });
</script>
