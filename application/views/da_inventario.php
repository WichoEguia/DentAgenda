<div id="contenedor_inventario">
  <table>
    <thead>
      <tr>
        <td>ID</td>
        <td>Nombre elemento</td>
        <td>Descripción</td>
        <td>Cantidad de unidades</td>
        <td>Proximo abastecimiento</td>
      </tr>
    </thead>

    <tbody id="elementos_inventario">

    </tbody>
  </table>
</div>

<script src="<?php echo base_url("assets/js/citas.js") ?>" charset="utf-8"></script>
<script type="text/javascript">
  $(document).ready(function(){
    var base_url = "<?php echo base_url() ?>";

    var inventario = new Inventario();
    inventario.ev();
    inventario.setUrl(base_url);
    inventario.genera_inventario();
  });
</script>
