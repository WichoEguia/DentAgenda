function Agenda(){
  var base_url = "";

  this.ev = function(){
    eventos();
  }

  this.setUrl = function(url){
    base_url = url;
  }

  var eventos = function(){

  }

  this.traer_eventos = function(){
    $.ajax({
        method : "POST",
        url : base_url + "index.php/Agenda/traer_eventos",
        async : true,
        data : {}
    }).done(function(data){
      console.log(JSON.parse(data));
      var data = JSON.parse(data);
      if(data.resultado){
        crear_eventos_vista(data.citas);
      }else{
        swal("Ups...","Aún no tienes ninguna cita programada.","warning")
      }
    });
  }

  var crear_eventos_vista = function(eventos){
    c = "";
    for(var i = 0;i < eventos.length; i++){
      c += "<div class='evento' style='background: #fff;padding: 30px;width: 80%;margin: 20px auto;box-shadow: 0 1px 3px rgba(0,0,0,0.12),0 1px 2px rgba(0,0,0,0.24);border-radius: 5px;'>";
      c += "  <p class='fecha_evento' style='font-size: 18px;color: #3368d6;font-weight: lighter;'>Cita: " + eventos[i].fecha.substr(0,10) + "</p>";
      c += "  <p class='paciente_evento' style='font-size:18px;margin: 5px 0;color: #4b4b4b;font-weight: bolder;'>" + eventos[i].folio + " - " + eventos[i].nombre + "</p>";
      c += "  <p class='descripcion_evento' style='font-size:20px;margin: 10px 0;'>" + eventos[i].descripcion + "</p>";
      c += "  <div class='flex' style='justify-content: space-between;'>";
      c += "    <p class='fecha_creacion_evento' style='font-size:15px;color: #95949B;font-weight: lighter;'>Folio cita: " + eventos[i].folio_cita.substr(0,10) + "</p>";
      c += "    <p class='fecha_creacion_evento' style='font-size:15px;color: #95949B;font-weight: lighter;'>" + eventos[i].fecha_creacion.substr(0,10) + "</p>";
      c += "  </div>";
      c += "</div>";
    };
    $("#agenda_contenedor").html(c);
  }
}
