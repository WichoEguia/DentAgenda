<div class="flex">
  <div class="">
    <div class="field">
      <label for="nombre_producto">Nombre del producto</label><br>
      <input type="text" class="validable" id="nombre_producto" name="nombre_producto"></input>
    </div>

    <div class="field">
      <label for="producto_descripcion">Descripción del producto</label><br>
      <textarea class="validable" id="producto_descripcion" name="producto_descripcion" rows="5" cols="50"></textarea>
    </div>

    <div class="field">
      <label for="cantidad_producto">Cantidad de productos</label><br>
      <input type="number" class="validable" id="cantidad_producto" name="cantidad_producto" min="0" value="0"></input>
    </div>

    <div class="field">
      <label for="fecha_restock">Periodo reabastecimiento</label><br>
      <input type="text" id="fecha_restock" name="fecha_restock" class="validable">
    </div>

    <button id="enviar_producto" class="success" type="button" name="button">Crear</button>
  </div>
</div>

<script src="<?php echo base_url("assets/js/inventario.js") ?>" charset="utf-8"></script>
<script type="text/javascript">
  $(document).ready(function(){
    var base_url = "<?php echo base_url() ?>";

    var inventario = new Inventario();
    inventario.ev();
    inventario.setUrl(base_url);

    $("#fecha_restock").datepicker({
      dateFormat: 'yy-mm-dd'
    });
  });
</script>
