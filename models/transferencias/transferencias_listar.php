<?php 
    include "../../config/conexion.php"; 
    include "../../config/basico.php";

    $fecha = date("Y/m/d H:i:s");
    $sql = sprintf("INSERT INTO `controlg_controlerp`.`almacen_transferencia` (`almacen_origen_id`, `almacen_destino_id`, `fecha`) 
                    VALUES ('%s', '%s', '%s');",
                    fn_filtro($_GET['origen']),
                    fn_filtro($_GET['destino']),
                    fn_filtro($fecha)
  );
  mysql_select_db($database_fastERP, $fastERP);
  $table = mysql_query($sql, $fastERP) or die(mysql_error());

  $id = mysql_insert_id();

  $query = "SELECT origen.almacen AS origen, destino.almacen AS destino, almacen_transferencia.transferencia_id
            FROM almacen_transferencia , almacen AS origen , almacen AS destino
            WHERE almacen_transferencia.transferencia_id = $id
            AND origen.almacen_id = almacen_transferencia.almacen_origen_id
            AND destino.almacen_id = almacen_transferencia.almacen_destino_id" ;
  mysql_select_db($database_fastERP, $fastERP);
  $table = mysql_query($query, $fastERP) or die(mysql_error());
  $totalRows_table = mysql_num_rows($table);
  $row_table = mysql_fetch_assoc($table);
?>

<form action="javascript: fn_buscar_transferencias_registro();" class="form-horizontal" method="post" id="frm_buscar_transferencias_registro">
  <input type="hidden" name="origen" id="origen" value="<?php echo $_GET['origen']; ?>">
  <input type="hidden" name="destino" id="destino" value="<?php echo $_GET['destino']; ?>">
  <input type="hidden" name="transferencia_id" id="transferencia_id" value="<?php echo $row_table['transferencia_id']; ?>">
  <div class="widget-box widget-color-blue">
    <div class="widget-header">
      <i class="fa fa-table"></i>
      <h5 class="widget-title"> Lista de tranferencias 
        <span class="label label-lg label-yellow arrowed-in arrowed-right"> <?php echo $row_table['origen']; ?> </span>
        <span class="fa fa-long-arrow-right"></span>
        <span class="label label-lg label-yellow arrowed-in arrowed-right"> <?php echo $row_table['destino']; ?> </span>
      </h5>

      <div class="widget-toolbar">
        <a href="#" data-action="collapse">
          <i class="1 ace-icon fa fa-chevron-up"></i>
        </a>
      </div>

      <div class="widget-toolbar no-border">
        <button class="btn btn-sm btn-success" id="nuevaTranferencia"> Agregar tranferencia </button>
      </div>
    </div>

    <div class="widget-body">
      <div class="widget-main scrollable" data-size="250">
        <div id="div_listar_transferencias_registro"></div>
        <div id="div_oculto_transferencias_registro" class="none"></div>
      </div>
    </div>
  </div>
</form>
<script type="text/javascript">
  function fn_cerrar_transferencias(){
    $.unblockUI({ 
      onUnblock: function(){
        $("#div_listar_transferencias_registro").html("");
        fn_buscar_transferencias_registro();
      }
    }); 
  };

  var origen = jQuery("#origen").val();
  var destino = jQuery("#destino").val();
  var transferencia_id = jQuery("#transferencia_id").val();

  var data = {
    origen: origen, 
    destino: destino,
    transferencia_id: transferencia_id
  }

  function fn_buscar_transferencias_registro(){
    $.ajax({
      url: '../models/transferencias/transferencias_registro_listar.php',
      type: 'get',
      data: data,
      success: function(data){
        $("#div_listar_transferencias_registro").html(data);
      }
    });
  }
function fn_eliminar_transferencias(almacendet_id){
  var respuesta = confirm("Desea eliminar?");
  if (respuesta){
    $.ajax({
      url: '../models/transferencias/transferencias_eliminar.php',
      data: 'almacendet_id=' + almacendet_id,
      type: 'post',
      success: function(data){
        if(data!="")
          alert(data);
        fn_buscar_transferencias_registro()
      }
    });
  }
}
function fn_mostrar_frm_modificar_transferencias(almacendet_id){
  $("#div_oculto_transferencias_registro").load("../models/transferencias/transferencias_form_modificar.php", {almacendet_id: almacendet_id}, function(){
    $.blockUI({
      message: $('#div_oculto_transferencias_registro'),
      css:{
        top: '5%',
        width: '40%'
      }
    }); 
    $('.blockOverlay').attr('title','Click to unblock').click($.unblockUI); 
  });
};


  $("#nuevaTranferencia").click(function () {
    $("#div_oculto_transferencias_registro").load("../models/transferencias/transferencias_form_agregar.php?origen=" +origen+ "&destino=" +destino+  "&transferencia_id=" +transferencia_id, function(){
      $.blockUI({
        message: $('#div_oculto_transferencias_registro'),
        css:{
          top: '10%',
          width: '30%',
        }
      });
      $('.blockOverlay').attr('title','Click to unblock').click($.unblockUI); 
    });
  });

  fn_buscar_transferencias_registro();
</script>