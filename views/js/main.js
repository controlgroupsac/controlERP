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
        top: '5%',
        width: '40%',
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


/*Empresa*/
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
fn_buscar_usuario();
fn_buscar_empresa();