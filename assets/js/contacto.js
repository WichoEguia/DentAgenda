function Contacto(){
  var base_url = "";

  this.setUrl = function(url){
    base_url = url;
  }

  this.ev = function(){
    eventos();
  }

  var eventos = function(){
    $("#formulario_nuevo_contacto").off();
    $("#select_tipo_contacto").off();
    $(".eliminar_contacto").off();
    $("#nuevo_contacto").off();
    $(".editar_contacto").off();

    // $("#select_tipo_contacto").change(function(){
    //   console.log($(this).val());
    //   if($(this).val() == "cliente"){
    //     $("#field_alergias_contacto, #sangre_contacto").addClass("activo");
    //   }else{
    //     $("#field_alergias_contacto, #sangre_contacto").removeClass("activo");
    //   }
    // });

    $("#formulario_nuevo_contacto").submit(function(e){
      // e.preventDefault();
      var folio = $("#folio_contacto").val();
      var nombre = $("#nombre_contacto").val();
      var email = $("#email_contacto").val();
      var telefono = $("#telefono_contacto").val();
      var telefono_secundario = $("#telefono_secundario_contacto").val();
      // var tipo = $("#select_tipo_contacto").val();
      var alergias = $("#alergias_contacto").val();
      var sangre = $("#select_tipo_sangre_contacto").val();
      var sexo = $("#select_sexo_contacto").val();
      // console.log("ggg");

      $("input,select").removeClass("campo_error");
      $(".texto_error").hide();

      var paso = valida_datos(folio,nombre,telefono,email,alergias,sexo,sangre);

      if(!paso){
        e.preventDefault();
        swal("¡Cuidado!","Revisa todos los campos para continuar.","error");
      }
    });

    $(".eliminar_contacto").click(function(){
      var thiss = $(this);
      swal({
        title: '¿Seguro?',
        text: "No podrás revertir esta acción.",
        icon: 'warning',
        buttons: true,
        dangerMode: true,
        cancelButtonColor: '#3085d6',
        // confirmButtonText: 'Borrar contacto'
        buttons: ["Cancelar", "Dar de baja"]
      }).then(function (result) {
        if (result) {
          var contacto_id = thiss.parent().parent().parent().find(".idcontacto").val();
          var elemento = thiss.parent().parent().parent().attr("id");
          console.log(elemento);
          $.ajax({
              method : "POST",
              url : base_url + "index.php/Contactos/baja_contacto",
              async : true,
              data : {
                contacto_id : contacto_id
              }
          }).done(function(data){
            data = JSON.parse(data);
            if(data.resultado){
              $("#" + elemento).remove();
            }
          });
        }
      });
    });

    $("#nuevo_contacto").click(function(){
      window.location.href = base_url + "index.php/Contactos/nuevo_contacto";
    });

    $(".editar_contacto").click(function(){
      var contacto_id = $(this).parent().parent().parent().find(".idcontacto").val();
      window.location.href = base_url + "index.php/Contactos/editar_contacto/?id=" + contacto_id
    })
  }

  var valida_datos = function(folio,nombre,telefono,email,alergias,sexo,sangre){
    var res_f = false;
    var res_n = false;
    var res_tel = false;
    var res_e = false;
    var res_a = false;
    var res_s = false;
    var res_sang = false;
    var re = /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/;
    var resultado = false;

    if(folio != ""){
      res_f = true;
    }else{
      $("#folio_contacto").addClass("campo_error");
      $("#folio_contacto").parent().find(".texto_error").addClass("activo");
    }

    if(nombre != ""){
      res_n = true;
    }else{
      $("#nombre_contacto").addClass("campo_error");
      $("#nombre_contacto").parent().find(".texto_error").addClass("activo");
    }

    if(telefono != ""){
      res_tel = true;
    }else{
      $("#telefono_contacto").addClass("campo_error");
      $("#telefono_contacto").parent().find(".texto_error").addClass("activo");
    }

    if(sangre != null){
      res_sang = true;
    }else{
      $("#select_tipo_sangre_contacto").addClass("campo_error");
      $("#select_tipo_sangre_contacto").parent().find(".texto_error").addClass("activo");
    }

    if(re.test(email) || email == ""){
      res_e = true;
    }else{
      $("#email_contacto").addClass("campo_error");
      $("#email_contacto").parent().find(".texto_error").addClass("activo");
    }

    if(sexo != null){
      res_s = true;
    }else{
      $("#select_sexo_contacto").addClass("campo_error");
      $("#select_sexo_contacto").parent().find(".texto_error").addClass("activo");
    }

    if(res_f && res_n && res_tel && res_e && res_s && res_sang){
      resultado = true;
    }

    return resultado;
  }

  this.traer_contactos = function(){
    $.ajax({
        method : "POST",
        url : base_url + "index.php/Contactos/obtener_contactos",
        async : true,
        data : {}
    }).done(function(data){
      data = JSON.parse(data);

      if(data.resultado){
        llenar_contactos(data.contactos);
      }else{
        swal("Ups...", "Usted aún no cuenta con ningún contacto", "warning");
      }
    });
  }

  var llenar_contactos = function(contacto){
    c = "";
    for(var i = 0;i < contacto.length; i++){
      console.log(contacto[i]);
      c += "<div id='contacto_" + contacto[i].idcontacto + "' class='evento' style='background: #fff;padding: 15px 30px;width: 100%;box-shadow: 0 1px 3px rgba(0,0,0,0.12),0 1px 2px rgba(0,0,0,0.24);border-radius: 5px;position: relative;'>";
      c += "  <img style='width:70px;height:70px;border-radius:50%;' src='" + contacto[i].foto + "'>"
      c += "  <div class='flex' style='margin: 10px 0 30px 0;'>";
      c += "    <div style='margin-left: 15px;'>";
      c += "      <p class='nombre_contacto' style='font-size:20px;margin: 5px 0;color: #2ad5be;font-weight: bolder;'>" + contacto[i].folio + " - " + contacto[i].nombre + "</p>";
      if(contacto[i].email != ""){
        c += "    <p style='font-size:18px;margin: 5px 0;color: #2ad5be;font-weight: bolder;'>" + contacto[i].email + "</p>";
      }
      c += "      <p style='font-size:16px;margin: 5px 0;color: #2ad5be;font-weight: bolder;'>" + contacto[i].telefono_principal + "</p>";
      if(contacto[i].telefono_secundario != "" && contacto[i].telefono_secundario != undefined){
        c += "    <p>Telefono secundario: " + contacto[i].telefono_secundario + "</p>";
      }
      if(contacto[i].alergias != ""){
        c += "    <p class='alergias_contacto'>Alergias: " + contacto[i].alergias + "</p>";
      }
      if(contacto[i].tipo_sangre != ""){
        c += "    <p class='alergias_contacto'>Tipo de sangre: " + contacto[i].tipo_sangre + "</p>";
      }
      c += "      <p class='sexo_contacto'>Sexo: " + contacto[i].sexo + "</p>";
      c += "    </div>";
      c += "  </div>";
      c += "  <input name='idcontacto' class='idcontacto' type='hidden' value='" + contacto[i].idcontacto + "'>";
      c += "  <div style='position: absolute;bottom: 10px;right: 30px;margin-top: 10px;'>";
      c += "    <div style='display:flex; justify-content:flex-end'>"
      c += "      <p class='editar_contacto' style='color: steelblue; text-align: right; margin-top: 10px;margin-right: 10px ;cursor: pointer; font-size: 20px;'><i class='fa fa-pencil-square-o'></i></p>";
      c += "      <p class='eliminar_contacto' style='color: tomato; text-align: right; margin-top: 10px; cursor: pointer; font-size: 20px;'><i class='fa fa-trash'></i></p>";
      c += "    </div>";
      c += "  </div>";
      c += "</div>";
    };
    $("#contactos_contenedor").html(c);
    eventos();
  }
}
