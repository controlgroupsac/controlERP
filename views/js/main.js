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

/*UNIDAD DETALLE*/
$("#nuevaUnidad").click(function () {
  $("#div_oculto_unidad").load("../models/unidad/unidad_form_agregar.php", function(){
    $.blockUI({
      message: $('#div_oculto_unidad'),
      css:{
        top: '5%',
        width: '40%',
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


fn_buscar_usuario();
fn_buscar_empresa();
fn_buscar_producto();
fn_buscar_unidad();