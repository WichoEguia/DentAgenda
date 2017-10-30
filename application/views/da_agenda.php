<div id="agenda_contenedor"></div>

<script src="<?php echo base_url('assets/js/agenda.js') ?>" charset="utf-8"></script>
<script type="text/javascript">
  $(document).ready(function(){
    var base_url = "<?php echo base_url() ?>";
    var agenda = new Agenda();
    agenda.ev();
    agenda.setUrl(base_url);
    agenda.traer_eventos();
  });
</script>
