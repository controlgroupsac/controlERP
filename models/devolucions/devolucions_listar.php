<?php  
  include "../../config/conexion.php"; 
    include("../../queries/query.php");

    $query = "SELECT origen.almacen AS origen, destino.almacen AS destino, 
                     almacen_transferencia.transferencia_id, almacen_transferencia.almacen_origen_id, almacen_transferencia.almacen_destino_id, 
                     almacen_transferencia.fecha
              FROM almacen_transferencia , almacen AS origen , almacen AS destino
              WHERE origen.almacen_id = almacen_transferencia.almacen_origen_id
              AND destino.almacen_id = almacen_transferencia.almacen_destino_id 
              AND almacen_transferencia.transferencia_id <> 1
              AND origen.almacen_id <> 1
              ORDER BY almacen_transferencia.transferencia_id DESC" ;
    mysql_select_db($database_fastERP, $fastERP);
    $table = mysql_query($query, $fastERP) or die(mysql_error());
    $totalRows_table = mysql_num_rows($table);
    $row_table = mysql_fetch_assoc($table);
?>
<div class="table-responsive">
  <table id="simple-table" class="table table-striped table-bordered table-hover">
    <thead>
      <tr>
        <th>Id</th>
        <th>Fecha</th>
        <th>Origen</th>
        <th>Destino</th>

        <th></th>
      </tr>
    </thead>

    <tbody>
      <?php do { ?>
      <tr>
        <td><?php echo $row_table["transferencia_id"]; ?></td>
        <td><span class="label label-lg label-info arrowed-in arrowed-in-right"><?php echo $row_table["fecha"]; ?></span></td>
        <td><?php echo $row_table["origen"]; ?></td>
        <td><?php echo $row_table["destino"]; ?></td>
        <td align="left">
          <div class="btn-group">
            <a id="btn_devolucion_registro" href="devolucions.php?transferencia_id=<?=$row_table['transferencia_id']?>&origen=<?=$row_table['almacen_origen_id']?>&destino=<?=$row_table['almacen_destino_id']?>" class="btn btn-xs btn-yellow tooltip-info" data-rel="tooltip" data-placement="left" title="DEVOLVER....!">
              <i class="ace-icon fa fa-pencil bigger-120"></i>
            .......
            </a>
              <!-- <button class="btn btn-xs btn-info tooltip-info" data-rel="tooltip" data-placement="left" title="EDITAR!" onclick="javascript: fn_mostrar_frm_modificar_transferencias(<?=$row_table['transferencia_id']?>);">
                <i class="ace-icon fa fa-pencil bigger-120"></i>
              </button>

              <button class="btn btn-xs btn-danger tooltip-info" data-rel="tooltip" data-placement="left" title="ELMINAR!" onclick="javascript: fn_eliminar_transferencias(<?=$row_table['transferencia_id']?>);">
                <i class="ace-icon fa fa-trash-o bigger-120"></i>
              </button> -->
          </div>
        </td>
      </tr>
      <?php } while ( $row_table = mysql_fetch_assoc($table) ); ?>
    </tbody>
  </table>
</div>
<script type="text/javascript">
  jQuery(function ($) {
    $('[data-rel=tooltip]').tooltip();
  });
</script>

<?php  
  if ($totalRows_table == 0) {
    echo '<script type="text/javascript"> $("#btn_devolucion_registro").addClass("hidden"); </script>';
  }
?>