<button id="button_nuevo_producto" type="button" class="success" name="button">Nuevo Producto</button>

<div id="contenedor_inventario">
  <table id="inventario">
    <thead>
      <tr>
        <td>Folio</td>
        <td>Nombre elemento</td>
        <td>Descripción</td>
        <td>Cantidad</td>
        <td>Proximo abastecimiento</td>
        <td>Estado</td>
      </tr>
    </thead>

    <tbody id="elementos_inventario"></tbody>
  </table>
</div>

<script src="<?php echo base_url("assets/js/inventario.js") ?>" charset="utf-8"></script>
<script type="text/javascript">
  $(document).ready(function(){
    var base_url = "<?php echo base_url() ?>";

    var inventario = new Inventario();
    inventario.ev();
    inventario.setUrl(base_url);
    inventario.genera_inventario();
  });
</script>
