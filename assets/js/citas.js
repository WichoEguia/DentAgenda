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
    $("#tiempo_estimado_cita").off();
    $("#cantidad_elementos").off();
    $("#enviar_cita_editada").off();

    $("#enviar_cita").click(function(){
      enivia_formulario();
    });

    $("#enviar_cita_editada").click(function(){
      enivia_formulario_editado();
    });

    $("#tiempo_estimado_cita, #cantidad_elementos").change(function(){
      if($(this).val() < 1){
        $(this).val(1);
      }

      if($(this).val() > 11){
        $(this).val(10);
      }
    })

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
    $(".texto_error").hide();
    valida_fecha($("#fecha_cita").val() + " " + convertir_ampm_24($("#hora_cita").val()));
  }

  var enivia_formulario_editado = function(){
    $(".validable").removeClass("campo_error");
    $(".texto_error").hide();
    valida_fecha_editado($("#fecha_cita").val() + " " + convertir_ampm_24($("#hora_cita").val()));
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

    if(cliente != null){
      res_c = true;
    }else{
      $("#select_cliente").addClass("campo_error");
      $("#select_cliente").parent().find(".texto_error").addClass("activo");
    }

    if(descripcion != ""){
      res_d = true;
    }else{
      $("#cita_descripcion").addClass("campo_error");
      $("#cita_descripcion").parent().find(".texto_error").addClass("activo");
    }

    if(fecha != ""){
      res_f = true;
    }else{
      $("#fecha_cita").parent().addClass("campo_error");
      $("#hora_cita").parent().addClass("campo_error");
      $("#fecha_cita").parent().parent().parent().find(".texto_error").addClass("activo");
    }

    if(hora != ""){
      res_h = true;
    }else{
      $("#fecha_cita").parent().addClass("campo_error");
      $("#hora_cita").parent().addClass("campo_error");
      $("#fecha_cita").parent().parent().parent().find(".texto_error").addClass("activo");
    }

    if(res_c && res_d && res_f && res_h){
      paso = true;
    }

    return paso;
  }

  this.obtener_elementos_inventario = function(){
    $.ajax({
        method : "POST",
        url : base_url + "index.php/Citas/obtener_elementos_inventario",
        async : true,
        data : {}
    }).done(function(data){
      data = JSON.parse(data);
      console.log(data);
      if(data.resultado){
        var c = "";
        for(var i=0;i<data.elementos.length;i++){
          c += "<option value=" + data.elementos[i].idproducto + " cantidad=" + data.elementos[i].cantidad + ">" + data.elementos[i].folio + " - " + data.elementos[i].nombre + "</option>";
        }
        $("#elemento_inventario").append(c);
        eventos();
      }
    });
  }

  var valida_fecha = function(full_date){
    $.ajax({
        method : "POST",
        url : base_url + "index.php/Citas/valida_fecha",
        async : true,
        data : {
          fecha : full_date,
          tiempo_estimado : $("#tiempo_estimado_cita").val()
        }
    }).done(function(data){
      data = JSON.parse(data);

      if(!data.resultado){
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
                "tiempo_estimado" : $("#tiempo_estimado_cita").val(),
                "elemento" : $("#elemento_inventario").val()
              }
          }).done(function(data){
            data = JSON.parse(data);
            if(data.resultado){
              swal("Todo correcto","Los datos fueron enviados correctamente.","success").then(function(){
                $("#select_cliente").val("");
                $("#cita_descripcion").val("");
                $("#fecha_cita").val("");
                $("#hora_cita").val("");
                $("#tiempo_estimado_cita").val("1");
                $("#foto_contacto").html("");
              });
            }else{
              swal("Error al enviar el formulario","Intentalo nuevamente más tarde.","error");
            }
          });
        }else{
          swal("No se puede enviar el formulario","Asegurate de llenar todos los campos para continuar.","error");
        }
      }else{
        swal("Cuidado!","La fecha ya ha sido usada con anterioridad para otra cita. Intente con una fecha diferente.","error");
      }
    });
  }

  var valida_fecha_editado = function(full_date){
    $.ajax({
        method : "POST",
        url : base_url + "index.php/Citas/valida_fecha",
        async : true,
        data : {
          fecha : full_date,
          tiempo_estimado : $("#tiempo_estimado_cita").val()
        }
    }).done(function(data){
      data = JSON.parse(data);

      if(!data.resultado){
        var pase = validar_campos($("#select_cliente").val(),$("#cita_descripcion").val(),$("#fecha_cita").val(),$("#hora_cita").val());
        if(pase){
          $.ajax({
              method : "POST",
              url : base_url + "index.php/Citas/enviar_editar_cita",
              async : true,
              data : {
                "idcita" : $("#idcita").val(),
                "cliente_id" : $("#select_cliente").val(),
                "descripcion" : $("#cita_descripcion").val(),
                "fecha" : $("#fecha_cita").val() + " " + convertir_ampm_24($("#hora_cita").val()),
                "tiempo_estimado" : $("#tiempo_estimado_cita").val(),
                "elemento" : $("#elemento_inventario").val()
              }
          }).done(function(data){
            data = JSON.parse(data);
            if(data.resultado){
              swal("Todo correcto","Los datos fueron enviados correctamente.","success").then(function(){
                $("#select_cliente").val("");
                $("#cita_descripcion").val("");
                $("#fecha_cita").val("");
                $("#hora_cita").val("");
                $("#tiempo_estimado_cita").val("1");
                $("#foto_contacto").html("");
              });
            }else{
              swal("Error al enviar el formulario","Intentalo nuevamente más tarde.","error");
            }
          });
        }else{
          swal("No se puede enviar el formulario","Asegurate de llenar todos los campos para continuar.","error");
        }
      }else{
        swal("Cuidado!","La fecha ya ha sido usada con anterioridad para otra cita. Intente con una fecha diferente.","error");
      }
    });
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
