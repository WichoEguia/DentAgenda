function Perfil(){
  var base_url = ""

  this.setUrl = function(url){
    base_url = url;
  }

  this.ev = function(){
    eventos();
  }

  var eventos = function(){
    $("#formulario_editar_cuenta").off();

    $("#formulario_editar_cuenta").submit(function(e){
      var paso = validar_datos($("#nombre_cuenta").val(),$("#email_cuenta").val(),$("#nuevo_password").val(),$("#nuevo_password_confirmacion").val());

      $("input,select").removeClass("campo_error");
      $(".texto_error").hide();

      if(!paso){
        e.preventDefault();
        swal("Cuidado","Llena todos los campos para continuar","error");
      }
    });
  }

  var validar_datos = function(nombre,email,nuevo_pass,confirmar_pass){
    var res_n = false;
    var res_e = false;
    var res_p = false;
    var paso = false;
    var re = /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/;

    if(nombre != ""){
      res_n = true;
    }else{
      $("#nombre_cuenta").addClass("errror");
      $("#nombre_cuenta").parent().find(".texto_error").addClass("activo");
    }

    if(re.test(email) || email == ""){
      res_e = true;
    }else{
      $("#email_cuenta").addClass("errror");
      $("#email_cuenta").parent().find(".texto_error").addClass("activo");
    }

    if(nuevo_pass == ""){
      res_p = true;
    }else{
      if(nuevo_pass == confirmar_pass){
        res_p = true;
      }else{
        $("#nuevo_password, #nuevo_password_confirmacion").addClass("errror");
        $("#nuevo_password, #nuevo_password_confirmacion").parent().find(".texto_error").addClass("activo");
      }
    }

    if(res_n && res_e && res_p){
      paso = true;
    }

    return paso;
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

        $("#nombre_cuenta").val(data.dentista.nombre);
        $("#email_cuenta").val(data.dentista.email);
        $("#id_cuenta").val(data.dentista.iddentista);
      }else{
        swal("Error al obtener informacion","Reintentelo más tarde. Si el problema persiste contacte al administrador.","error");
      }
    });
  }

  this.llenar_datos_editar = function(){

  }
}
