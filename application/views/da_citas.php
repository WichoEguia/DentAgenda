<h2 class="">Crear cita</h2>

<div class="field">
  <label for="cita_cliente">Nombre del cliente</label><br>
  <select id="select_cliente" name="cita_cliente"></select>
</div>

<div class="field">
  <label for="cita_descripcion">Descripción de la cita</label><br>
  <textarea id="cita_descripcion" name="cita_descripcion" rows="5" cols="50"></textarea>
</div>

<div class="field">
  <label for="cita_fecha">Fecha y hora de cita</label><br>
  <div class="input_icono">
    <i class="fa fa-calendar"></i>
    <input type="text" id="fecha_cita" placeholder="seleccionar fecha">
  </div>
</div>

<button id="enviar_cita" class="success" type="button" name="button">Crear</button>

<script src="<?php echo base_url("assets/js/citas.js") ?>" charset="utf-8"></script>
<script type="text/javascript">
  $(document).ready(function(){
    var base_url = "<?php echo base_url(); ?>";

    var citas = new Citas();
    citas.eventos_();
    citas.setUrl(base_url);
    citas.obtener_clientes();

    $("#fecha_cita").datepicker({
      dateFormat: 'yy-mm-dd'
    });
  });
</script>
