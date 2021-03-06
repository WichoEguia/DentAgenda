<div class="flex">
  <div class="">
    <div class="field">
      <span class="obligatorio">*</span><label for="cita_cliente">Nombre del paciente</label><br>
      <select class="validable" id="select_cliente" name="cita_cliente"></select>
      <p class="texto_error">Seleccione un elemento de la lista.</p>
    </div>

    <div class="field">
      <span class="obligatorio">*</span><label for="cita_descripcion">Descripción de la cita</label><br>
      <textarea class="validable" id="cita_descripcion" name="cita_descripcion" rows="5" cols="50"></textarea>
      <p class="texto_error">Cada cita necesita llevar una descripción.</p>
    </div>

    <div class="field">
      <span class="obligatorio">*</span><label for="cita_fecha">Fecha y hora de cita</label><br>
      <div class="flex">
        <div class="input_icono">
          <i class="fa fa-calendar"></i>
          <input class="validable" type="text" id="fecha_cita" placeholder="seleccionar fecha">
        </div>

        <div style="margin-left: 10px;" class="input_icono">
          <i class="fa fa-clock-o"></i>
          <input class="validable" type="text" id="hora_cita" placeholder="seleccionar hora">
        </div>
      </div>
      <p class="texto_error">Asigne una fecha y una hora para la cita.</p>
    </div>

    <div class="field">
      <span class="obligatorio">*</span><label for="tiempo_estimado_cita">Tiempo estimado de cita (Numero de horas)</label><br>
      <input type="number" id="tiempo_estimado_cita" name="tiempo_estimado_cita" value="1" min="1" max="10">
    </div>

    <div class="field">
      <label for="elemento_inventario">Elemento de Inventario</label><br>
      <select id="elemento_inventario" name="elemento_inventario">
        <option value="" disabled selected>Selecciona</option>
      </select>
    </div>

    <button id="enviar_cita" class="success" type="button" name="button">Crear</button>
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
  });
</script>
