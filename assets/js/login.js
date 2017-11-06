function Login(){
  var base_url = "";

  this.setUrl = function(url){
    base_url = url;
  }

  this.ev = function(){
    eventos();
  }

  var eventos = function(){
    $("#enviar_regitro").off();

    $("#enviar_regitro").click(function(){
      var email = $("#signup_email").val();
      var nombre = $("#signup_nombre").val();
      var password = $("#signup_password").val();
      var password_confirmation = $("#signup_password_confirm").val();

      var pase = valida_datos(email,nombre,password,password_confirmation);

      if(pase){
        valida_datos_no_existentes(email,nombre,password);
      }
    });

    $("#inicar_sesion").click(function(){
      var email = $("#signin_email").val();
      var password = $("#signin_password").val();

      if(valida_datos_inicio(email,password)){
        $.ajax({
            method : "POST",
            url : base_url + "index.php/Login/inciar_sesion",
            async : true,
            data : {
              email : email,
              password : password
            }
        }).done(function(data){
          data = JSON.parse(data);
          console.log(data);
          if(data.resultado){
            window.location.href = base_url + "index.php/Perfil";
          }else{
            swal("Ups...","Problemas al iniciar sesión.\nVuelve a intentarlo luego.","warning");
          }
        });
      }
    });
  }

  var valida_datos = function(email,nombre,password,password_confirmation){
    var res_e = false;
    var res_n = false;
    var res_p = false;
    var datos_validados = false;

    var re = /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/;

    if(nombre != ""){
      res_n = true;
    }else{
      $("input").css({
        "border" : "0.5px solid #e3e3e5"
      });
      $("#signup_nombre").css({
        "border" : "0.5px solid red"
      });
    }

    if(email != ""){
      if(re.test(email)){
        res_e = true;
      }else{
        $("input").css({
          "border" : "0.5px solid #e3e3e5"
        });
        $("#signup_email").css({
          "border" : "0.5px solid red"
        });
        swal("No se puede realizar el registro","Ingresa un email valido.","error");
        return datos_validados;
      }
    }else{
      $("input").css({
        "border" : "0.5px solid #e3e3e5"
      });
      $("#signup_email").css({
        "border" : "0.5px solid red"
      });
    }

    if(password == password_confirmation){
      res_p = true;
    }else{
      $("input").css({
        "border" : "0.5px solid #e3e3e5"
      });
      $(".password_field").css({
        "border" : "0.5px solid red"
      });
      swal("No se puede realizar el registro","Las contraseñas no coinciden.","error");
      return datos_validados;
    }

    if(res_n && res_e && res_p){
      datos_validados = true;
    }else{
      swal("No se puede realizar el registro","Llena todos los campos para continuar.","error");
    }

    return datos_validados;
  }

  var valida_datos_no_existentes = function(email,nombre,password){
    $.ajax({
        method : "POST",
        url : base_url + "index.php/Login/valida_datos_no_existentes",
        async : true,
        data : {
          email : email
        }
    }).done(function(data){
      data = JSON.parse(data);
      if(data.resultado){
        crear_usuario(email,nombre,password);
      }else{
        $("input").css({
          "border" : "0.5px solid #e3e3e5"
        });
        $("#signup_email").css({
          "border" : "0.5px solid red"
        });
        swal("No se puede realizar el registro","El email ya existe.","warning");
      }
    });
  }

  var crear_usuario = function(email,nombre,password){
    $.ajax({
        method : "POST",
        url : base_url + "index.php/Login/crear_usuario",
        async : true,
        data : {
          email : email,
          nombre : nombre,
          password : password
        }
    }).done(function(data){
      data = JSON.parse(data);
      if(data.resultado){
        window.location.href = base_url + "index.php/Perfil";
      }
    });
  }

  var valida_datos_inicio = function(email, password){
    var res_e = false;
    var res_p = false;
    var res = false;

    if(email != ""){
      res_e = true;
    }else{
      $("input").css({
        "border" : "0.5px solid #e3e3e5"
      });
      $("#signin_email").css({
        "border" : "0.5px solid red"
      });
    }

    if(password != ""){
      res_p = true;
    }else{
      $("input").css({
        "border" : "0.5px solid #e3e3e5"
      });
      $("#signin_password").css({
        "border" : "0.5px solid red"
      });
    }

    if(res_e && res_p){
      res = true;
    }else{
      swal("No se puede iniciar sesión","Llena todos los campos para continuar.","error");
    }

    return res;
  }
}
