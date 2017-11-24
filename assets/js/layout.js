function Layout(){
  var base_url = "";

  this.setUrl = function(url){
    base_url = url;
  }

  this.hora_fecha = function(){
    setInterval(hora_fecha, 500);
  }

  this.ev = function(){
    eventos();
  }

  var eventos = function(){
    $("#user_session_options").off();
    $("#cerrar_sesion").off();
    $("#informacion_usuario").off();

    $("#user_session_options").click(function(){
      $("#opciones_usuario").toggleClass("activo");
    });

    $("#cerrar_sesion").click(function(){
      window.location.href = base_url + "index.php/Login/salir";
    });

    $("#informacion_usuario").click(function(){
      $("#opciones_sesion").toggleClass("activo");
    });
  }

  var hora_fecha = function(){
    var fecha = new Date();
    var horas = fecha.getHours();
    var minutos = fecha.getMinutes();

    var anio = fecha.getFullYear();
    var mes = fecha.getMonth() + 1;
    var dia = fecha.getDate();

    // var meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
    //
    // mes = meses[mes];

    if(dia < 10){dia = "0" + dia}
    if(mes < 10){mes = "0" + mes}
    if(horas < 10){horas = "0" + horas}
    if(minutos < 10){minutos = "0" + minutos}
    fecha = dia + "/" + mes + "/" + anio + " " + horas + ":" + minutos;

    $("#full_date").html(fecha);
  }
}
