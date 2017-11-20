function Citas(){
  var base_url = "";

  this.eventos_ = function(){
    eventos();
  }

  this.setUrl = function(url){
    base_url = url;
  }

  var eventos = function(){
    $("#enviar_cita").off();
    $("#select_cliente").off();

    $("#enviar_cita").click(function(){
      enivia_formulario();
    });

    $("#select_cliente").change(function(){
      var idcontacto = $(this).val();
      $("#foto_contacto").html("");

      $.ajax({
          method : "POST",
          url : base_url + "index.php/Citas/obtener_foto_perfil",
          async : true,
          data : {
            idcontacto : idcontacto
          }
      }).done(function(data){
        data = JSON.parse(data);
        if(data.resultado){
          console.log(data.path_foto);
          if(data.path_foto != null){
            c = '<img style="width:300px;height:300px;" src="' + data.path_foto + '">';
            $("#foto_contacto").html(c);
          }
        }
      });
    });
  }

  this.obtener_clientes = function(){
    $.ajax({
        method : "POST",
        url : base_url + "/index.php/Citas/obtener_clientes",
        async : true,
        data : {}
    }).done(function(data){
      var data = JSON.parse(data);
      var c = "<option value = '' disabled selected>selecciona</option>";
      console.log(data);

      if(data.resultado){
        for (var i = 0; i < data.clientes.length; i++) {
          var cliente = data.clientes[i];
          c += "<option value = '" + cliente.idcontacto + "'>" + cliente.folio + " - " + cliente.nombre + "</option>";
        }
        $("#select_cliente").html(c);
      }else{
        swal("UPS...","No tienes registrado ningún contacto aún.","warning").then(function(){
          window.location.href = base_url + "index.php/Perfil";
        });
      }
    });
  }

  var enivia_formulario = function(){
    $(".validable").removeClass("campo_error");
    var pase = validar_campos($("#select_cliente").val(),$("#cita_descripcion").val(),$("#fecha_cita").val(),$("#hora_cita").val());
    if(pase){
      $.ajax({
          method : "POST",
          url : base_url + "index.php/Citas/crear_nueva_cita",
          async : true,
          data : {
            "cliente_id" : $("#select_cliente").val(),
            "descripcion" : $("#cita_descripcion").val(),
            "fecha" : $("#fecha_cita").val() + " " + convertir_ampm_24($("#hora_cita").val()),
            "tiempo_estimado" : $("#tiempo_estimado_cita").val()
          }
      }).done(function(data){
        data = JSON.parse(data);
        if(data.resultado){
          swal("Todo correcto","Los datos fueron enviados correctamente.","success").then(function(){
            $("#select_cliente").val("");
            $("#cita_descripcion").val("");
            $("#fecha_cita").val("");
            $("#hora_cita").val("");
            $("#tiempo_estimado_cita").val("");
            $("#foto_contacto").html("");
          });
        }else{
          swal("Error al enviar el formulario","Intentalo nuevamente más tarde.","error");
        }
      });
    }else{
      swal("No se puede enviar el formulario","Asegurate de llenar todos los campos para continuar.","error");
    }
  }

  var convertir_ampm_24 = function(time){
    var time = moment(time, ["h:mm A"]).format("HH:mm");
    return time;
  }

  var validar_campos = function(cliente,descripcion,fecha,hora){
    var res_c = false;
    var res_d = false;
    var res_f = false;
    var res_h = false;
    var paso = false;

    if(cliente != ""){
      res_c = true;
    }else{
      $("#select_cliente").addClass("campo_error");
    }

    if(descripcion != ""){
      res_d = true;
    }else{
      $("#cita_descripcion").addClass("campo_error");
    }

    if(fecha != ""){
      res_f = true;
    }else{
      $("#fecha_cita").addClass("campo_error");
    }

    if(hora != ""){
      res_h = true;
    }else{
      $("#hora_cita").addClass("campo_error");
    }

    if(res_c && res_d && res_f && res_h){
      paso = true;
    }

    return paso;
  }
}
 /*
 TODO: DOGE

 ─────────▄──────────────▄
────────▌▒█───────────▄▀▒▌
────────▌▒▒▀▄───────▄▀▒▒▒▐
───────▐▄▀▒▒▀▀▀▀▄▄▄▀▒▒▒▒▒▐
─────▄▄▀▒▒▒▒▒▒▒▒▒▒▒█▒▒▄█▒▐
───▄▀▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▀██▀▒▌
──▐▒▒▒▄▄▄▒▒▒▒▒▒▒▒▒▒▒▒▒▀▄▒▒▌
──▌▒▒▐▄█▀▒▒▒▒▄▀█▄▒▒▒▒▒▒▒█▒▐
─▐▒▒▒▒▒▒▒▒▒▒▒▌██▀▒▒▒▒▒▒▒▒▀▄▌
─▌▒▀▄██▄▒▒▒▒▒▒▒▒▒▒▒░░░░▒▒▒▒▌
─▌▀▐▄█▄█▌▄▒▀▒▒▒▒▒▒░░░░░░▒▒▒▐
▐▒▀▐▀▐▀▒▒▄▄▒▄▒▒▒▒▒░░░░░░▒▒▒▒▌
▐▒▒▒▀▀▄▄▒▒▒▄▒▒▒▒▒▒░░░░░░▒▒▒▐
─▌▒▒▒▒▒▒▀▀▀▒▒▒▒▒▒▒▒░░░░▒▒▒▒▌
─▐▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▐
──▀▄▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▄▒▒▒▒▌
────▀▄▒▒▒▒▒▒▒▒▒▒▄▄▄▀▒▒▒▒▄▀
───▐▀▒▀▄▄▄▄▄▄▀▀▀▒▒▒▒▒▄▄▀
──▐▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▀▀

 */
