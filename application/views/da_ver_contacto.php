<button type="button" id="nuevo_contacto" class="success" name="button">Agregar Paciente</button>
<div id="contactos_contenedor" class=""></div>

<script src="<?php echo base_url('assets/js/contacto.js') ?>" charset="utf-8"></script>
<script type="text/javascript">
  $(document).ready(function(){
    var base_url = "<?php echo base_url() ?>";
    var contacto = new Contacto();
    contacto.ev();
    contacto.setUrl(base_url);
    contacto.traer_contactos();
  });
</script>
