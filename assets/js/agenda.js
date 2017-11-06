function Agenda(){
  var base_url = "";

  this.ev = function(){
    eventos();
  }

  this.setUrl = function(url){
    base_url = url;
  }

  var eventos = function(){
    $(".eliminar_evento").off();

    $(".eliminar_evento").click(function(){
      var idcita = $(this).parent().find(".idcita").val();
      var idelemento = $(this).parent().attr("id");
      // console.log(idcita);
      $.ajax({
          method : "POST",
          url : base_url + "index.php/Agenda/eliminar_cita",
          async : true,
          data : {
            "cita_id" : idcita
          }
      }).done(function(data){
        var data = JSON.parse(data);
        if(data.resultado){
          $("#" + idelemento).remove();
        }
      });
    });
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
        swal("Ups...","Aún no tienes ninguna cita programada.","warning");
      }
    });
  }

  var crear_eventos_vista = function(citas){
    c = "";
    for(var i = 0;i < citas.length; i++){
      c += "<div id='evento" + citas[i].idcita + "' class='evento' style='background: #fff;padding: 15px 30px;width: 80%;margin: 20px auto;box-shadow: 0 1px 3px rgba(0,0,0,0.12),0 1px 2px rgba(0,0,0,0.24);border-radius: 5px;'>";
      c += "  <p class='fecha_evento' style='font-size: 18px;color: #3368d6;font-weight: lighter;'>Cita: " + citas[i].fecha.substr(0,10) + "</p>";
      c += "  <p class='paciente_evento' style='font-size:18px;margin: 5px 0;color: #4b4b4b;font-weight: bolder;'>" + citas[i].folio + " - " + citas[i].nombre + "</p>";
      c += "  <p class='descripcion_evento' style='font-size:20px;margin: 10px 0;'>" + citas[i].descripcion + "</p>";
      c += "  <div class='flex' style='justify-content: space-between;'>";
      c += "    <p class='fecha_creacion_evento' style='font-size:15px;color: #95949B;font-weight: lighter;'>Folio cita: " + citas[i].folio_cita.substr(0,10) + "</p>";
      c += "    <p class='fecha_creacion_evento' style='font-size:15px;color: #95949B;font-weight: lighter;'>" + citas[i].fecha_creacion.substr(0,10) + "</p>";
      c += "  </div>";
      c += "  <input class='idcita' type='hidden' value='" + citas[i].idcita + "'>";
      c += "  <p class='eliminar_evento' style='color: red; text-align: right; margin-top: 10px; cursor: pointer; font-size: 20px;'><i class='fa fa-trash'></i></p>";
      c += "</div>";
    };
    $("#agenda_contenedor").html(c);
    eventos();
  }
}

// TODO: Tarea
// 1 - ¿Como se modifica la configuración de la memoria virtual de mi SO?
// - Hacer minitutorial con screeshots en PDF donde se describe paso a paso.