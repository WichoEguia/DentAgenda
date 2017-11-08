function Contacto(){
  var base_url = "";

  this.setUrl = function(url){
    base_url = url;
  }

  this.ev = function(){
    eventos();
  }

  var eventos = function(){
    $("#crear_contacto").off();
    $("#select_tipo_contacto").off();

    $("#select_tipo_contacto").change(function(){
      console.log($(this).val());
      if($(this).val() == "cliente"){
        $("#field_alergias_contacto").addClass("activo");
      }else{
        $("#field_alergias_contacto").removeClass("activo");
      }
    });

    $("#crear_contacto").click(function(){
      var folio = $("#folio_contacto").val();
      var nombre = $("#nombre_contacto").val();
      var email = $("#email_contacto").val();
      var telefono = $("#telefono_contacto").val();
      var telefono_secundario = $("#telefono_secundario_contacto").val();
      var tipo = $("#select_tipo_contacto").val();
      var alergias = $("#alergias_contacto").val();
      var sexo = $("#select_sexo_contacto").val();

      $("input,select").removeClass("campo_error");

      var paso = valida_datos(folio,nombre,telefono,tipo,email,alergias,sexo);

      if(!paso){
        swal("¡Cuidado!","Revisa todos los campos para continuar.","warning");
      }

      console.log(paso);
    });
  }

  var valida_datos = function(folio,nombre,telefono,tipo,email,alergias,sexo){
    var res_f = false;
    var res_n = false;
    var res_tel = false;
    var res_t = false;
    var res_e = false;
    var res_a = false;
    var res_s = false;
    var re = /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/;
    var resultado = false;

    if(folio != "" && folio.length == 4){
      res_f = true;
    }else{
      $("#folio_contacto").addClass("campo_error");
    }

    if(nombre != ""){
      res_n = true;
    }else{
      $("#nombre_contacto").addClass("campo_error");
    }

    if(telefono != ""){
      res_tel = true;
    }else{
      $("#telefono_contacto").addClass("campo_error");
    }

    if(tipo != ""){
      res_t = true;
      console.log(tipo);
      if(tipo == "cliente"){
        if(alergias != ""){
          res_a = true;
        }else{
          $("#alergias_contacto").addClass("campo_error");
        }
      }else{
        if(alergias == ""){
          res_a = true;
        }
      }
    }else{
      $("#select_tipo_contacto").addClass("campo_error");
    }

    if(re.test(email) || email == ""){
      res_e = true;
    }else{
      $("#email_contacto").addClass("campo_error");
    }

    if(sexo != ""){
      res_s = true;
    }else{
      $("#select_sexo_contacto").addClass("campo_error");
    }

    // console.log(res_f);
    // console.log(res_n);
    // console.log(res_tel);
    // console.log(res_t);
    // console.log(res_e);
    // console.log(res_a);

    if(res_f && res_n && res_tel && res_t && res_e && res_a && res_s){
      resultado = true;
    }

    return resultado; // TODO: revisar que variable es falsa
  }
}
