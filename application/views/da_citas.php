<h2 class="">Crear cita</h2>

<div class="field">
  <label for="cita_cliente">Nombre del cliente</label><br>
  <select id="select_cliente" name="cita_cliente"></select>
</div>

<div class="field">
  <label for="cita_descripcion">Descripción de la cita</label><br>
  <textarea name="cita_descripcion" rows="5" cols="50"></textarea>
</div>

<div class="field">
  <label for="cita_fecha">Fecha y hora de cita</label><br>
  <input type="text" id="datepicker">
</div>

<button class="enviar" type="button" name="button">Crear</button>

<script src="<?php echo base_url("assets/js/citas.js") ?>" charset="utf-8"></script>
<script type="text/javascript">
  $(document).ready(function(){
    var base_url = "<?php echo base_url(); ?>";

    var citas = new Citas();
    citas.setUrl(base_url);
    citas.obtener_clientes();

    $( "#datepicker" ).datepicker();
  });
</script>
