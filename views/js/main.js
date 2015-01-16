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
$("#nuevaCompra_det").click(function () {
  $("#div_oculto_compra_det").load("../models/compra/compra_det_form_agregar.php", function(){
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

function fn_buscar_compra_det(){
  var str = $("#frm_buscar_compra_det").serialize();
  $.ajax({
    url: '../models/compra/compra_det_listar.php',
    type: 'get',
    data: str,
    success: function(data){
      $("#div_listar_compra_det").html(data);
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
function fn_mostrar_frm_modificar_compras_registro(compras_registro_id){
  $("#div_oculto_compras_registro").load("../models/compra_registro/compras_registro_form_modificar.php", {compras_registro_id: compras_registro_id}, function(){
    $.blockUI({
      message: $('#div_oculto_compras_registro'),
      css:{
        top: '10%',
        width: '40%'
      }
    }); 
    $('.blockOverlay').attr('title','Click to unblock').click($.unblockUI); 
  });
};


fn_buscar_usuario();
fn_buscar_empresa();
fn_buscar_producto();
fn_buscar_unidad();
fn_buscar_moneda();
fn_buscar_categoria();
fn_buscar_compra_det();
fn_buscar_compras_registro();















// var almacen_id = document.getElementById('almacen_id').value;
  // var proveedor_id = document.getElementById('proveedor_id').value;
  // var comprobtipo_id = document.getElementById('comprobtipo_id').value;
  // var serie = document.getElementById('serie').value;
  // var numero = document.getElementById('numero').value;
  // var fecha_doc = document.getElementById('fecha_doc').value;
  // var impuesto1 = document.getElementById('impuesto1').value;
  // var valor_neto = document.getElementById('valor_neto').value;
  // var descuento = document.getElementById('descuento').value;
  // var tota = document.getElementById('total').value;
  // var data = {
  //   fecha_doc: fecha_doc,
  //   almacen_id: almacen_id,
  //   proveedor_id: proveedor_id,
  //   comprobtipo_id: comprobtipo_id,
  //   serie: serie,
  //   numero: numero,
  //   impuesto1: impuesto1,
  //   valor_neto: valor_neto,
  //   descuento: descuento,
  //   total: total
  // };
  // console.log(data);

  // $.ajax({
  //   url: '../models/compra_registro/compra_agregar.php',
  //   type: 'get',
  //   data: data
  // });