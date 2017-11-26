function Inventario(){
  var base_url = "";

  this.ev = function(){
    eventos();
  }

  this.setUrl = function(url){
    base_url = url;
  }

  var eventos = function(){
    $("#button_nuevo_producto").off();
    $("#enviar_producto").off();
    $("#cantidad_producto").off();

    $("#button_nuevo_producto").click(function(){
      window.location.href = base_url + "index.php/Inventario/nuevo_producto";
    });

    $("#enviar_producto").click(function(){
      enviar_formulario();
    });

    $("#cantidad_producto").change(function(){
      if($(this).val() < 0){
        $(this).val(0);
      }
    });
  }

  this.genera_inventario = function(){
    $.ajax({
        method : "POST",
        url : base_url + "index.php/Inventario/obtener_elementos",
        async : true,
        data : {}
    }).done(function(data){
      data = JSON.parse(data);

      if(data.resultado){
        llenar_tabla(data.productos);
      }else{
        swal("Ups...","Usted no tiene ningún producto registrado al momento.","warning");
      }
    });
  }

  var llenar_tabla = function(productos){
    c = "";
    for(var i=0;i<productos.length;i++){
      c += "<tr style='height: 50px;'>";
      c += "  <td>" + productos[i].folio + "</td>";
      c += "  <td>" + productos[i].nombre + "</td>";
      c += "  <td>" + productos[i].descripcion + "</td>";
      c += productos[i].cantidad < 0 ? "<td>0</td>" : "<td>" + productos[i].cantidad + "</td>";
      c += "  <td>" + productos[i].restock + "</td>";
      c += productos[i].cantidad > 0 ? "<td></td>" : "<td>No hay elementos</td>";
      c += "</tr>";
    }
    $("#elementos_inventario").html(c);
  }

  var enviar_formulario = function(){
    $(".validable").removeClass("campo_error");
    $(".texto_error").hide();
    var pase = validar_campos($("#nombre_producto").val(),$("#producto_descripcion").val(),$("#cantidad_producto").val(),$("#fecha_restock").val());

    if(pase){
      $.ajax({
          method : "POST",
          url : base_url + "index.php/Inventario/crear_producto",
          async : true,
          data : {
            nombre: $("#nombre_producto").val(),
            descripcion: $("#producto_descripcion").val(),
            cantidad: $("#cantidad_producto").val(),
            restock: $("#fecha_restock").val()
          }
      }).done(function(data){
        data = JSON.parse(data);
        if(data.resultado){
          swal("Listo", "El producto ha sido dado de alta y ya puede verlo en el inventario", "success");
          $(".validable").val("");
        }
      });
    }
  }

  var validar_campos = function(nombre,descripcion,cantidad,fecha_restock){
    var res_n = false;
    var res_d = false;
    var res_c = false;
    var res_f = false;
    var paso = false;

    if(nombre != ""){
      res_n = true;
    }else{
      $("#nombre_producto").addClass("campo_error");
      $("#nombre_producto").parent().find(".texto_error").addClass("activo");
    }

    if(descripcion != ""){
      res_d = true;
    }else{
      $("#producto_descripcion").addClass("campo_error");
      $("#producto_descripcion").parent().find(".texto_error").addClass("activo");
    }

    if(cantidad != 0){
      res_c = true;
    }else{
      $("#cantidad_producto").addClass("campo_error");
      $("#cantidad_producto").parent().find(".texto_error").addClass("activo");
    }

    if(fecha_restock != ""){
      res_f = true;
    }else{
      $("#fecha_restock").addClass("campo_error");
      $("#fecha_restock").parent().find(".texto_error").addClass("activo");
    }

    if(res_n && res_d && res_c && res_f){
      paso = true;
    }

    return paso;
  }
}
