/**/
/**/
/**/
/*BEGIN POP UP functions*/
function fn_cerrar(){
  $.unblockUI({ 
    onUnblock: function(){
      $("#div_oculto_usuarios").html("");
      fn_buscar_usuario();
      fn_buscar_empresa();
    }
  }); 
};

/*USUARIO DETALLE*/
$("#nuevoUsuario").click(function () {
  $("#div_oculto_usuario").load("../models/usuario/usuario_form_agregar.php", function(){
    $.blockUI({
      message: $('#div_oculto_usuario'),
      css:{
        top: '2%',
        width: '60%',
      }
    });
    $('.blockOverlay').attr('title','Click to unblock').click($.unblockUI); 
  });
});

function fn_buscar_usuario(){
  var str = $("#frm_buscar_usuario").serialize();
  $.ajax({
    url: '../models/usuario/usuario_listar.php',
    type: 'get',
    data: str,
    success: function(data){
      $("#div_listar_usuario").html(data);
    }
  });
}
function fn_eliminar_usuario(usuario_id){
  var respuesta = confirm("Desea eliminar este usuario?");
  if (respuesta){
    $.ajax({
      url: '../models/usuario/usuario_eliminar.php',
      data: 'usuario_id=' + usuario_id,
      type: 'post',
      success: function(data){
        if(data!="")
          alert(data);
        fn_buscar_usuario()
      }
    });
  }
}
function fn_mostrar_frm_modificar_usuario(usuario_id){
  $("#div_oculto_usuario").load("../models/usuario/usuario_form_modificar.php", {usuario_id: usuario_id}, function(){
    $.blockUI({
      message: $('#div_oculto_usuario'),
      css:{
        top: '5%',
        width: '40%'
      }
    }); 
    $('.blockOverlay').attr('title','Click to unblock').click($.unblockUI); 
  });
};




/*EMPRESA*/
function fn_buscar_empresa(){
  var str = $("#frm_buscar_empresa").serialize();
  $.ajax({
    url: '../models/usuario/empresa_listar.php',
    type: 'get',
    data: str,
    success: function(data){
      $("#div_listar_empresa").html(data);
    }
  });
}
function fn_mostrar_frm_modificar_empresa(empresa_id){
  $("#div_oculto_empresa").load("../models/usuario/empresa_form_modificar.php", {empresa_id: empresa_id}, function(){
    $.blockUI({
      message: $('#div_oculto_empresa'),
      css:{
        top: '5%',
        width: '40%'
      }
    }); 
    $('.blockOverlay').attr('title','Click to unblock').click($.unblockUI); 
  });
};




/*PRODUCTO DETALLE*/
function fn_cerrar_producto(){
  $.unblockUI({ 
    onUnblock: function(){
      fn_buscar_producto();
      fn_buscar_unidad();
    }
  }); 
};
$("#nuevoProducto").click(function () {
  $("#div_oculto_producto").load("../models/producto/producto_form_agregar.php", function(){
    $.blockUI({
      message: $('#div_oculto_producto'),
      css:{
        top: '5%',
        width: '40%',
      }
    });
    $('.blockOverlay').attr('title','Click to unblock').click($.unblockUI); 
  });
});

function fn_buscar_producto(){
  var str = $("#frm_buscar_producto").serialize();
  $.ajax({
    url: '../models/producto/producto_listar.php',
    type: 'get',
    data: str,
    success: function(data){
      $("#div_listar_producto").html(data);
    }
  });
}
function fn_eliminar_producto(producto_id){
  var respuesta = confirm("Desea eliminar este producto?");
  if (respuesta){
    $.ajax({
      url: '../models/producto/producto_eliminar.php',
      data: 'producto_id=' + producto_id,
      type: 'post',
      success: function(data){
        if(data!="")
          alert(data);
        fn_buscar_producto()
      }
    });
  }
}
function fn_mostrar_frm_modificar_producto(producto_id){
  $("#div_oculto_producto").load("../models/producto/producto_form_modificar.php", {producto_id: producto_id}, function(){
    $.blockUI({
      message: $('#div_oculto_producto'),
      css:{
        top: '5%',
        width: '40%'
      }
    }); 
    $('.blockOverlay').attr('title','Click to unblock').click($.unblockUI); 
  });
};

/*PRODUCTO_ensamblado DETALLE*/
function fn_cerrar_producto_ensamblado(){
  $.unblockUI({ 
    onUnblock: function(){
      fn_buscar_producto_ensamblado();
    }
  }); 
};
$("#nuevoProductoEnsamblado").click(function () {
  $("#div_oculto_producto_ensamblado").load("../models/producto_ensamblado/producto_ensamblado_form_agregar.php", function(){
    $.blockUI({
      message: $('#div_oculto_producto_ensamblado'),
      css:{
        top: '5%',
        width: '40%',
      }
    });
    $('.blockOverlay').attr('title','Click to unblock').click($.unblockUI); 
  });
});

function fn_buscar_producto_ensamblado(){
  var str = $("#frm_buscar_producto_ensamblado").serialize();
  console.log("OK!" +str);
  $.ajax({
    url: '../models/producto_ensamblado/producto_ensamblado_listar.php',
    type: 'get',
    data: str,
    success: function(data){
      $("#div_listar_producto_ensamblado").html(data);
    }
  });
}
function fn_eliminar_producto_ensamblado(producto_ensamblado_id){
  var respuesta = confirm("Desea eliminar este producto_ensamblado?");
  if (respuesta){
    $.ajax({
      url: '../models/producto_ensamblado/producto_ensamblado_eliminar.php',
      data: 'producto_ensamblado_id=' + producto_ensamblado_id,
      type: 'post',
      success: function(data){
        if(data!="")
          alert(data);
        fn_buscar_producto_ensamblado()
      }
    });
  }
}
function fn_mostrar_frm_modificar_producto_ensamblado(producto_ensamblado_id){
  $("#div_oculto_producto_ensamblado").load("../models/producto_ensamblado/producto_ensamblado_form_modificar.php", {producto_ensamblado_id: producto_ensamblado_id}, function(){
    $.blockUI({
      message: $('#div_oculto_producto_ensamblado'),
      css:{
        top: '5%',
        width: '40%'
      }
    }); 
    $('.blockOverlay').attr('title','Click to unblock').click($.unblockUI); 
  });
};

/**/
/**/
/**/
/*UNIDAD*/
$("#nuevaUnidad").click(function () {
  $("#div_oculto_unidad").load("../models/unidad/unidad_form_agregar.php", function(){
    $.blockUI({
      message: $('#div_oculto_unidad'),
      css:{
        top: '10%',
        width: '30%',
      }
    });
    $('.blockOverlay').attr('title','Click to unblock').click($.unblockUI); 
  });
});

function fn_buscar_unidad(){
  var str = $("#frm_buscar_unidad").serialize();
  $.ajax({
    url: '../models/unidad/unidad_listar.php',
    type: 'get',
    data: str,
    success: function(data){
      $("#div_listar_unidad").html(data);
    }
  });
}
function fn_eliminar_unidad(unidad_id){
  var respuesta = confirm("Desea eliminar este unidad?");
  if (respuesta){
    $.ajax({
      url: '../models/unidad/unidad_eliminar.php',
      data: 'unidad_id=' + unidad_id,
      type: 'post',
      success: function(data){
        if(data!="")
          alert(data);
        fn_buscar_unidad()
      }
    });
  }
}
function fn_mostrar_frm_modificar_unidad(unidad_id){
  $("#div_oculto_unidad").load("../models/unidad/unidad_form_modificar.php", {unidad_id: unidad_id}, function(){
    $.blockUI({
      message: $('#div_oculto_unidad'),
      css:{
        top: '5%',
        width: '40%'
      }
    }); 
    $('.blockOverlay').attr('title','Click to unblock').click($.unblockUI); 
  });
};

/**/
/**/
/**/
/*MONEDA*/
$("#nuevaMoneda").click(function () {
  $("#div_oculto_moneda").load("../models/moneda/moneda_form_agregar.php", function(){
    $.blockUI({
      message: $('#div_oculto_moneda'),
      css:{
        top: '10%',
        width: '30%',
      }
    });
    $('.blockOverlay').attr('title','Click to unblock').click($.unblockUI); 
  });
});

function fn_buscar_moneda(){
  var str = $("#frm_buscar_moneda").serialize();
  $.ajax({
    url: '../models/moneda/moneda_listar.php',
    type: 'get',
    data: str,
    success: function(data){
      $("#div_listar_moneda").html(data);
    }
  });
}
function fn_eliminar_moneda(moneda_id){
  var respuesta = confirm("Desea eliminar este moneda?");
  if (respuesta){
    $.ajax({
      url: '../models/moneda/moneda_eliminar.php',
      data: 'moneda_id=' + moneda_id,
      type: 'post',
      success: function(data){
        if(data!="")
          alert(data);
        fn_buscar_moneda()
      }
    });
  }
}
function fn_mostrar_frm_modificar_moneda(moneda_id){
  $("#div_oculto_moneda").load("../models/moneda/moneda_form_modificar.php", {moneda_id: moneda_id}, function(){
    $.blockUI({
      message: $('#div_oculto_moneda'),
      css:{
        top: '5%',
        width: '40%'
      }
    }); 
    $('.blockOverlay').attr('title','Click to unblock').click($.unblockUI); 
  });
};


/**/
/**/
/**/
/*cliente*/
function fn_cerrar_cliente(){
  $.unblockUI({  
    onUnblock: function(){
      fn_buscar_cliente();
    }
  }); 
};
$("#nuevoCliente").click(function () {
  $("#div_oculto_cliente").load("../models/cliente/cliente_form_agregar.php", function(){
    $.blockUI({
      message: $('#div_oculto_cliente'),
      css:{
        top: '5%',
        width: '30%',
      }
    });
    $('.blockOverlay').attr('title','Click to unblock').click($.unblockUI); 
  });
});

function fn_buscar_cliente(){
  var str = $("#frm_buscar_cliente").serialize();
  $.ajax({
    url: '../models/cliente/cliente_listar.php',
    type: 'get',
    data: str,
    success: function(data){
      $("#div_listar_cliente").html(data);
    }
  });
}
function fn_eliminar_cliente(cliente_id){
  var respuesta = confirm("Desea eliminar este cliente?");
  if (respuesta){
    $.ajax({
      url: '../models/cliente/cliente_eliminar.php',
      data: 'cliente_id=' + cliente_id,
      type: 'post',
      success: function(data){
        if(data!="")
          alert(data);
        fn_buscar_cliente()
      }
    });
  }
}
function fn_mostrar_frm_modificar_cliente(cliente_id){
  $("#div_oculto_cliente").load("../models/cliente/cliente_form_modificar.php", {cliente_id: cliente_id}, function(){
    $.blockUI({
      message: $('#div_oculto_cliente'),
      css:{
        top: '5%',
        width: '40%'
      }
    }); 
    $('.blockOverlay').attr('title','Click to unblock').click($.unblockUI); 
  });
};


/**/
/**/
/**/
/*categoria*/
$("#nuevaCategoria").click(function () {
  $("#div_oculto_categoria").load("../models/categoria/categoria_form_agregar.php", function(){
    $.blockUI({
      message: $('#div_oculto_categoria'),
      css:{
        top: '10%',
        width: '30%',
      }
    });
    $('.blockOverlay').attr('title','Click to unblock').click($.unblockUI); 
  });
});

function fn_buscar_categoria(){
  var str = $("#frm_buscar_categoria").serialize();
  $.ajax({
    url: '../models/categoria/categoria_listar.php',
    type: 'get',
    data: str,
    success: function(data){
      $("#div_listar_categoria").html(data);
    }
  });
}
function fn_eliminar_categoria(categoria_id){
  var respuesta = confirm("Desea eliminar este categoria?");
  if (respuesta){
    $.ajax({
      url: '../models/categoria/categoria_eliminar.php',
      data: 'categoria_id=' + categoria_id,
      type: 'post',
      success: function(data){
        if(data!="")
          alert(data);
        fn_buscar_categoria()
      }
    });
  }
}
function fn_mostrar_frm_modificar_categoria(categoria_id){
  $("#div_oculto_categoria").load("../models/categoria/categoria_form_modificar.php", {categoria_id: categoria_id}, function(){
    $.blockUI({
      message: $('#div_oculto_categoria'),
      css:{
        top: '5%',
        width: '40%'
      }
    }); 
    $('.blockOverlay').attr('title','Click to unblock').click($.unblockUI); 
  });
};



/**/
/**/
/**/
/*COMPRA*/

/*compra_det*/
function fn_cerrar_compra(){
  $.unblockUI({  
    onUnblock: function(){
      fn_buscar_compra_det();
      fn_buscar_compras_registro();
    }
  }); 
};

var compra_id = document.getElementById('compra_id');
var descuento = document.getElementById('descuento');
$("#nuevaCompra_det").click(function () {
  $("#div_oculto_compra_det").load("../models/compra/compra_det_form_agregar.php?compra_id=" +compra_id.value, function(){
    $.blockUI({
      message: $('#div_oculto_compra_det'),
      css:{
        top: '10%',
        width: '30%',
      }
    });
    $('.blockOverlay').attr('title','Click to unblock').click($.unblockUI); 
  });
});

$("#descuento").focus(function () {
  fn_buscar_compra_det();
});
$("#descuento").blur(function () {
  fn_buscar_compra_det();
});

function fn_buscar_compra_det(){
  var str = $("#frm_buscar_compra_det").serialize();
  $.ajax({
    url: '../models/compra/compra_det_listar.php?compra_id=' +compra_id.value,
    type: 'get',
    data: str,
    success: function(data){
      $("#div_listar_compra_det").html(data);
    }
  });
  $.ajax({
    url: '../models/compra/compra_det_listar_precios.php?compra_id=' +compra_id.value+ '&descuento=' +descuento.value,
    type: 'get',
    data: 'compra_id=' +compra_id.value+ '&descuento=' +descuento.value,
    success: function(data){
      $("#div_listar_compra_det_precios").html(data);
    }
  });
}
function fn_eliminar_compra_det(compra_det_id){
  var respuesta = confirm("Desea eliminar este compra_det?");
  if (respuesta){
    $.ajax({
      url: '../models/compra/compra_det_eliminar.php',
      data: 'compra_det_id=' + compra_det_id,
      type: 'post',
      success: function(data){
        if(data!="")
          alert(data);
        fn_buscar_compra_det()
      }
    });
  }
}
function fn_mostrar_frm_modificar_compra_det(compra_det_id){
  $("#div_oculto_compra_det").load("../models/compra/compra_det_form_modificar.php", {compra_det_id: compra_det_id}, function(){
    $.blockUI({
      message: $('#div_oculto_compra_det'),
      css:{
        top: '10%',
        width: '40%'
      }
    }); 
    $('.blockOverlay').attr('title','Click to unblock').click($.unblockUI); 
  });
};



/**/
/**/
/**/
/**/
/*COMPRAS REGISTRO*/
$("#registrar").click(function () {
  var compra_id = document.getElementById('compra_id');
  var almacen_id = document.getElementById('almacen_id');
  var proveedor_id = document.getElementById('proveedor_id');
  var condic_pago = document.getElementById('condic_pago');
  var serie = document.getElementById('serie');
  var numero = document.getElementById('numero');
  var fecha_doc = document.getElementById('fecha_doc');
  var impuesto1 = document.getElementById('impuesto1');
  var valor_neto = document.getElementById('valor_neto');
  var descuento = document.getElementById('descuento');
  var total = document.getElementById('total');

  var data = {
    compra_id: compra_id.value,
    almacen_id: almacen_id.value,
    estado: 1,
    proveedor_id: proveedor_id.value,
    condic_pago: condic_pago.value,
    serie: serie.value,
    numero: numero.value,
    fecha_doc: fecha_doc.value,
    impuesto1: impuesto1.value,
    valor_neto: valor_neto.value,
    descuento: descuento.value,
    total: total.value
  };
  var respuestaRegistrar = confirm("Realmente desea registrar esta COMPRA?. \nSi acepta, el documento no podrá ser modificado!");
  if (respuestaRegistrar){
    $.ajax({
      url: '../models/compra_registro/compras_registrar.php',
      type: 'post',
      data: data,
      success: function(data){
        $("#proceso-registro").html(data);
      }
    });
  }
});
$("#salir").click(function () {
  var compra_id = document.getElementById('compra_id');
  var almacen_id = document.getElementById('almacen_id');
  var proveedor_id = document.getElementById('proveedor_id');
  var condic_pago = document.getElementById('condic_pago');
  var serie = document.getElementById('serie');
  var numero = document.getElementById('numero');
  var fecha_doc = document.getElementById('fecha_doc');
  var impuesto1 = document.getElementById('impuesto1');
  var valor_neto = document.getElementById('valor_neto');
  var descuento = document.getElementById('descuento');
  var total = document.getElementById('total');

  var data = {
    compra_id: compra_id.value,
    almacen_id: almacen_id.value,
    estado: 1,
    proveedor_id: proveedor_id.value,
    condic_pago: condic_pago.value,
    serie: serie.value,
    numero: numero.value,
    fecha_doc: fecha_doc.value,
    impuesto1: impuesto1.value,
    valor_neto: valor_neto.value,
    descuento: descuento.value,
    total: total.value
  };
  var respuesta = confirm("Desea conservar los cambios?");
  if (respuesta){
    $.ajax({
      url: '../models/compra_registro/compras_salir.php',
      type: 'post',
      data: data,
      success: function(data){
        $("#proceso-registro").html(data);
        location.href="compras_registro.php";
      }
    });
  }else{
    location.href="compras_registro.php";
  }
});
$("#recibir").click(function () {
  var compra_id = document.getElementById('compra_id');
  var almacen_id = document.getElementById('almacen_id');
  var data = { 
    compra_id: compra_id.value,
    almacen_id: almacen_id.value 
  };
  var respuesta = confirm("Desea confirmar la RECEPCIÓN de los productos?");
  if (respuesta){
    $.ajax({
      url: '../models/compra_registro/compras_recibir.php',
      type: 'get',
      data: data,
      success: function(data){
        alert("Registrado!");
        $("#proceso-registro").html(data);
      }
    });
  }
});

$("#rechazar").click(function () {
  var compra_id = document.getElementById('compra_id');
  var data = { compra_id: compra_id.value };

  
  var respuesta = confirm("Desea eliminar este compras_registro?");
  if (respuesta){
    $.ajax({
      url: '../models/compra_registro/compras_rechazar.php',
      type: 'get',
      data: data,
      success: function(data){
        alert("Registrado!");
        $("#proceso-registro").html(data);
      }
    });
  }
});

$("#nuevaCompras_registro").click(function () {
  $("#div_oculto_compras_registro").load("../models/compra_registro/compras_registro_form_agregar.php", function(){
    $.blockUI({
      message: $('#div_oculto_compras_registro'),
      css:{
        top: '10%',
        width: '30%',
      }
    });
    $('.blockOverlay').attr('title','Click to unblock').click($.unblockUI); 
  });
});

function fn_buscar_compras_registro(){
  var str = $("#frm_buscar_compras_registro").serialize();
  $.ajax({
    url: '../models/compra_registro/compras_registro_listar.php',
    type: 'get',
    data: str,
    success: function(data){
      $("#div_listar_compras_registro").html(data);
    }
  });
}
function fn_eliminar_compras_registro(compras_registro_id){
  var respuesta = confirm("Desea eliminar este compras_registro?");
  if (respuesta){
    $.ajax({
      url: '../models/compra_registro/compras_registro_eliminar.php',
      data: 'compras_registro_id=' + compras_registro_id,
      type: 'post',
      success: function(data){
        if(data!="")
          alert(data);
        fn_buscar_compras_registro()
      }
    });
  }
}
function fn_mostrar_frm_modificar_compras_registro(compra_id){
  $("#div_oculto_compras_registro").load("../models/compra_registro/compras_registro_form_modificar.php", {compra_id: compra_id}, function(){
    $.blockUI({
      message: $('#div_oculto_compras_registro'),
      css:{
        top: '10%',
        width: '30%'
      }
    }); 
    $('.blockOverlay').attr('title','Click to unblock').click($.unblockUI); 
  });
};









/**/
/**/
/**/
/**/
/*VENTAS*/

function fn_mostrar_frm_ventas_envases(){
  var ventas_id = document.getElementById('ventas_id');

  var data = {
    ventas_id: ventas_id.value
  };

  $("#div_ventas_envases").load("../models/ventas/ventas_form_envases.php", data, function(){
    $.blockUI({
      message: $('#div_ventas_envases'),
      css:{
        left: '20%',
        top: '5%',
        width: '50%'
      }
    }); 
    $('.blockOverlay').attr('Ventas','Desbloquear').click($.unblockUI); 
  });
};

function fn_mostrar_frm_ventas_agregar(){
  var ventas_id = document.getElementById('ventas_id');
  var cliente_id = document.getElementById('cliente_id');
  var almacen_id = document.getElementById('almacen_id');
  var valor_neto = document.getElementById('valor_neto');
  var descuento = document.getElementById('descuentoVenta');
  var impuesto1 = document.getElementById('impuesto1');
  var total = document.getElementById('total');

  var data = {
    ventas_id: ventas_id.value,
    almacen_id: almacen_id.value,
    valor_neto: valor_neto.value,
    descuento: descuento.value,
    impuesto1: impuesto1.value,
    total: total.value
  };

  $("#div_ventas_agregar").load("../models/ventas/ventas_form_agregar.php", data, function(){
    $.blockUI({
      message: $('#div_ventas_agregar'),
      css:{
        top: '5%',
        width: '40%'
      }
    }); 
    $('.blockOverlay').attr('Ventas','Desbloquear').click($.unblockUI); 
  });
};

function fn_cerrar_ventas(){
  $.unblockUI({ 
    onUnblock: function(){
      $("#div_listar_ventas_registro").html("");
      fn_buscar_ventas_registro();
      fn_buscar_ventas_det();
    }
  }); 
};

function fn_buscar_ventas_categorias(){
  $.ajax({
    url: '../models/ventas/ventas_listar_categorias.php',
    type: 'get',
    success: function(data){
      $("#div_listar_categorias").html(data);
    }
  });
}

function fn_buscar_ventas_categorias_productos(){
  $.ajax({
    url: '../models/ventas/ventas_listar_categorias_productos.php',
    type: 'get',
    success: function(data){
      $("#div_listar_categorias_productos").html(data);
    }
  });
}

function fn_buscar_ventas_det(){
  var ventas_id = document.getElementById('ventas_id');
  var descuento = document.getElementById('descuentoVenta');

  $.ajax({
    url: '../models/ventas/ventas_det_listar.php?ventas_id=' +ventas_id.value,
    type: 'get',
    success: function(data){
      $("#div_ventas_det_listar").html(data);
    }
  });

  $.ajax({
    url: '../models/ventas/ventas_det_listar_precios.php?ventas_id=' +ventas_id.value+ '&descuento=' +descuento.value,
    type: 'get',
    success: function(data){
      $("#div_ventas_det_listar_precios").html(data);
    }
  });
}

$("#descuentoVenta").focus(function () {
  fn_buscar_ventas_det();
});
$("#descuentoVenta").blur(function () {
  fn_buscar_ventas_det();
});

function fn_mostrar_frm_modificar_ventas_det(ventas_det_id){
  document.getElementById("")
  var data = {
    ventas_det_id: ventas_det_id
  }
  $("#div_ventas_det_oculto").load("../models/ventas/ventas_det_form_modificar.php", data, function(){
    $.blockUI({
      message: $('#div_ventas_det_oculto'),
      css:{
        top: '10%',
        width: '30%'
      }
    }); 
    $('.blockOverlay').attr('title','Click to unblock').click($.unblockUI); 
  });
};

function fn_eliminar_ventas_det(ventas_det_id){
  var respuesta = confirm("Desea eliminar este detalle de venta?");
  if (respuesta){
    $.ajax({
      url: '../models/ventas/ventas_det_eliminar.php',
      data: 'ventas_det_id=' + ventas_det_id,
      type: 'post',
      success: function(data){
        if(data!="")
          alert(data);
        fn_buscar_ventas_det();
      }
    });
  }
}

/*Enviar producto y cantidad a detalle de ventas*/
function fn_mostrar_frm_agregar_venta_det (producto_id, precio) {
  var ventas_id = document.getElementById('ventas_id');
  var data = {
    ventas_id: ventas_id.value,
    producto_id: producto_id,
    precio: precio
  };
  $.ajax({
    url: '../models/ventas/ventas_det_agregar.php',
    data: data,
    type: 'post',
    success: function(data){
      if(data != "")
        alert(data);
      fn_cerrar_ventas();
      fn_buscar_ventas_det();
    }
  });
}
$("#tbodyBTN button").click(function(){
  var str = "";
  str += $(this).text();
  $("#cantidad").attr("value", str);
});


/**/
/**/
/**/
/*VENTAS REGISTRO*/
function fn_buscar_ventas_registro(){
  var str = $("#frm_buscar_ventas_registro").serialize();
  $.ajax({
    url: '../models/ventas_registro/ventas_registro_listar.php',
    type: 'get',
    data: str,
    success: function(data){
      $("#div_listar_ventas_registro").html(data);
    }
  });
}
function fn_eliminar_ventas_registro(ventas_registro_id){
  var respuesta = confirm("Desea eliminar este ventas_registro?");
  if (respuesta){
    $.ajax({
      url: '../models/ventas_registro/ventas_registro_eliminar.php',
      data: 'ventas_registro_id=' + ventas_registro_id,
      type: 'post',
      success: function(data){
        if(data!="")
          alert(data);
        fn_buscar_ventas_registro()
      }
    });
  }
}
function fn_mostrar_frm_modificar_ventas_registro(ventas_id){
  $("#div_oculto_ventas_registro").load("../models/ventas_registro/ventas_registro_form_modificar.php", {ventas_id: ventas_id}, function(){
    $.blockUI({
      message: $('#div_oculto_ventas_registro'),
      css:{
        top: '10%',
        width: '30%'
      }
    }); 
    $('.blockOverlay').attr('title','Click to unblock').click($.unblockUI); 
  });
};

$("#nuevaVentas_registro").click(function () {
  $("#div_oculto_ventas_registro").load("../models/ventas_registro/ventas_registro_form_agregar.php", function(){
    $.blockUI({
      message: $('#div_oculto_ventas_registro'),
      css:{
        top: '10%',
        width: '30%',
      }
    });
    $('.blockOverlay').attr('title','Click to unblock').click($.unblockUI); 
  });
});



/*Transferencias*/
function fn_buscar_transferencias(){
  var str = $("#frm_buscar_transferencias").serialize();
  var origen = $("#origen").val();
  var destino = $("#destino").val();
  if (origen == destino) {
    alert("El ORIGEN no puede ser el mismo que el DESTINO");
  }else {
    $.ajax({
      url: '../models/transferencias/transferencias_listar.php',
      type: 'get',
      data: str,
      success: function(data){
        $("#div_listar_transferencias").html(data);
      }
    });
    jQuery("#crear_transferencias").addClass("disabled");
  };
}