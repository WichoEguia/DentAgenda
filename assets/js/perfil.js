function Perfil(){
  var base_url = ""

  this.setUrl = function(url){
    base_url = url;
  }

  this.ev = function(){
    eventos();
  }

  var eventos = function(){

  }

  this.obttener_datos_perfil = function(){
    $.ajax({
        method : "POST",
        url : base_url + "index.php/Perfil/obttener_datos_perfil",
        async : true,
        data : {}
    }).done(function(data){
      data = JSON.parse(data);
      if(data.resultado){
        console.log(data);

        $("#nombre_perfil").html(data.dentista.nombre);
        $("#email_perfil").html(data.dentista.email);

        $("#no_pacientes").html(data.no_pacientes + " PACIENTES");
        $("#no_citas").html(data.no_pacientes + " CITAS PROXIMAS");
        $("#no_citas_hoy").html(data.no_citas_hoy + " CITAS HOY");
        $("#no_citas_manana").html(data.no_citas_manana + " CITAS MAÑANA");
      }else{
        swal("Error al obtener informacion","Reintentelo más tarde. Si el problema persiste contacte al administrador.","error");
      }
    });
  }
}
