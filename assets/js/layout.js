function Layout(){
  this.hora_fecha = function(){
    setInterval(hora_fecha, 500);
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
