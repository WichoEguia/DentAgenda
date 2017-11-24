<div id="contenido_perfil">
  <div id="foto_perfil_contenedor" class="flex center-X center-Y">
    <div class="flex">
      <div class="">
        <img src="<?php echo base_url("assets/img/perfil_da.jpg") ?>" alt="">
      </div>

      <div id="datos_dentistas" class="flex center-X">
        <p class="dato_dentista" id="nombre_perfil"></p>
        <p class="dato_dentista" id="email_perfil"></p>
      </div>
    </div>
  </div>
  <div id="caracteristicas">
    <div id="no_pacientes" class="flex center-X center-Y">###</div>
    <div id="no_citas" class="flex center-X center-Y">###</div>
    <div id="no_citas_hoy" class="flex center-X center-Y">###</div>
    <div id="no_citas_manana" class="flex center-X center-Y">###</div>
  </div>
</div>

<script src="<?php echo base_url("assets/js/perfil.js") ?>" charset="utf-8"></script>
<script type="text/javascript">
  $(document).ready(function(){
    var base_url = "<?php echo base_url() ?>";
    var perfil = new Perfil();

    perfil.setUrl(base_url);
    perfil.ev();
    perfil.obttener_datos_perfil()
  })
</script>
