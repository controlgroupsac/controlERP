<?php  
  include "../../config/conexion.php"; 
    include("../../queries/query.php");

    $query = "SELECT origen.almacen AS origen, destino.almacen AS destino, 
                     almacen_transferencia.transferencia_id, almacen_transferencia.almacen_origen_id, almacen_transferencia.almacen_destino_id
              FROM almacen_transferencia , almacen AS origen , almacen AS destino
              WHERE origen.almacen_id = almacen_transferencia.almacen_origen_id
              AND destino.almacen_id = almacen_transferencia.almacen_destino_id 
              AND almacen_transferencia.transferencia_id <> 1
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
        <th>Transferencia</th>
        <th>Producto</th>
        <th>Transferencia</th>

        <th></th>
      </tr>
    </thead>

    <tbody>
      <?php do { ?>
      <tr>
        <td><?php echo $row_table["transferencia_id"]; ?></td>
        <td><?php echo $row_table["origen"]; ?></td>
        <td><?php echo $row_table["destino"]; ?></td>
        <td>
          <div class="btn-group">
            <a href="devolucions.php?transferencia_id=<?=$row_table['transferencia_id']?>&origen=<?=$row_table['almacen_origen_id']?>&destino=<?=$row_table['almacen_destino_id']?>" class="btn btn-xs btn-yellow tooltip-info" data-rel="tooltip" data-placement="left" title="TRANSFERIR....!">
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