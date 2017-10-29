function Citas(){
  var base_url = "";

  this.eventos = function(){
    eventos();
  }

  this.setUrl = function(url){
    base_url = url;
  }

  var eventos = function(){

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
          c += "<option = '" + cliente.idcontacto + "'>" + cliente.folio + " - " + cliente.nombre + "</option>";
        }
        $("#select_cliente").html(c);
      }else{
        swal("UPS...","No tienes registrado ningún usuario aún.","warning").then(function(){
          window.location.href = base_url + "index.php/Cuenta";
        });
      }
    });
  }
}
