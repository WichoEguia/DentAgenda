<div class="flex">
  <div class="">

    <input type="hidden" id="idcita" value="<?php echo $idcita ?>">

    <div class="field">
      <span class="obligatorio">*</span><label for="cita_cliente">Nombre del paciente</label><br>
      <select class="validable" id="select_cliente" name="cita_cliente"></select>
      <p class="texto_error">Seleccione un elemento de la lista.</p>
    </div>

    <div class="field">
      <span class="obligatorio">*</span><label for="cita_descripcion">Descripción de la cita</label><br>
      <textarea class="validable" id="cita_descripcion" name="cita_descripcion" rows="5" cols="50"><?php echo isset($descripcion) ? $descripcion : "" ?></textarea>
      <p class="texto_error">Cada cita necesita llevar una descripción.</p>
    </div>

    <div class="field">
      <span class="obligatorio">*</span><label for="cita_fecha">Fecha y hora de cita</label><br>
      <div class="flex">
        <div class="input_icono">
          <i class="fa fa-calendar"></i>
          <input class="validable" type="text" id="fecha_cita" placeholder="seleccionar fecha" value="<?php echo isset($fecha) ? substr($fecha, 0, 10) : "" ?>">
        </div>

        <div style="margin-left: 10px;" class="input_icono">
          <i class="fa fa-clock-o"></i>
          <input class="validable" type="text" id="hora_cita" placeholder="seleccionar hora" value="<?php echo isset($fecha) ? substr($fecha, 11, 15) : "" ?>">
        </div>
      </div>
      <p class="texto_error">Asigne una fecha y una hora para la cita.</p>
    </div>

    <div class="field">
      <span class="obligatorio">*</span><label for="tiempo_estimado_cita">Tiempo estimado de cita (Numero de horas)</label><br>
      <input type="number" id="tiempo_estimado_cita" name="tiempo_estimado_cita" min="1" max="10" value="<?php echo isset($duracion) ? $duracion : "1" ?>">
    </div>

    <div class="field">
      <label for="elemento_inventario">Elemento de Inventario</label><br>
      <select id="elemento_inventario" name="elemento_inventario">
        <option value="" disabled selected>Selecciona</option>
      </select>
    </div>

    <button id="enviar_cita_editada" class="success" type="button" name="button">Guardar Cambios</button>
  </div>

  <div class="flex center-X">
    <div id="foto_contacto"></div>
  </div>
</div>

<script src="<?php echo base_url("assets/js/citas.js") ?>" charset="utf-8"></script>
<script type="text/javascript">
  $(document).ready(function(){
    var base_url = "<?php echo base_url() ?>";

    var citas = new Citas();
    citas.eventos_();
    citas.setUrl(base_url);
    citas.obtener_clientes();
    citas.obtener_elementos_inventario();

    $("#fecha_cita").datepicker({
      dateFormat: 'yy-mm-dd',
      minDate: 1
    });

    $("#hora_cita").wickedpicker({
      // twentyFour: true,
      title: "Selecciona hora"
    });

    $('#select_cliente option[value="<?php echo $contacto_id ?>"]').attr("selected", true);
    $('#elemento_inventario option[value="<?php echo $producto_id ?>"]').attr("selected", true);
  });
</script>
