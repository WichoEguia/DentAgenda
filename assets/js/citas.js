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

    $("#enviar_cita").click(function(){
      enivia_formulario();
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
    if($("#select_cliente").val() != "" && $("#cita_descripcion").val() != "" && $("#fecha_cita").val() != ""){
      $.ajax({
          method : "POST",
          url : base_url + "index.php/Citas/crear_nueva_cita",
          async : true,
          data : {
            "cliente_id" : $("#select_cliente").val(),
            "descripcion" : $("#cita_descripcion").val(),
            "fecha" : $("#fecha_cita").val() + " " + convertir_ampm_24($("#hora_cita").val())
          }
      }).done(function(data){
        var data = JSON.parse(data);
        if(data.resultado){
          swal("Todo correcto","Los datos fueron enviados correctamente.","success").then(function(){
            $("#select_cliente").val("");
            $("#cita_descripcion").val("");
            $("#fecha_cita").val("");
            $("#hora_cita").val("");
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
}
