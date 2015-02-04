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

  $query = "SELECT origen.almacen AS origen, destino.almacen AS destino
            FROM almacen_transferencia , almacen AS origen , almacen AS destino
            WHERE almacen_transferencia.transferencia_id = $id
            AND origen.almacen_id = almacen_transferencia.almacen_origen_id
            AND destino.almacen_id = almacen_transferencia.almacen_destino_id" ;
  mysql_select_db($database_fastERP, $fastERP);
  $table = mysql_query($query, $fastERP) or die(mysql_error());
  $totalRows_table = mysql_num_rows($table);
  $row_table = mysql_fetch_assoc($table);
?>
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
<script type="text/javascript">
  function fn_buscar_transferencias_registro(){
    var str = $("#frm_buscar_transferencias_registro").serialize();
    $.ajax({
      url: '../models/transferencias/transferencias_registro_listar.php',
      type: 'get',
      data: str,
      success: function(data){
        $("#div_listar_transferencias_registro").html(data);
      }
    });
  }

  $("#nuevaTranferencia").click(function () {
    $("#div_oculto_transferencias_registro").load("../models/transferencias/transferencias_form_agregar.php", function(){
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