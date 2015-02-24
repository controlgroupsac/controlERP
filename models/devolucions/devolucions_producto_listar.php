<?php  
    include "../../config/conexion.php"; 
    include("../../queries/query.php");

    $transferencia = @$_GET['transferencia_id'];
    if($transferencia == "" || empty($transferencia)) {
      $transferencia = "";
    }
    
    $query = "SELECT almacen_transferencias_detalle.almacen_transferencias_detalle_id, almacen_transferencias_detalle.almacen_transferencias_id, 
                     almacen_transferencias_detalle.cantidad, almacen_transferencias_detalle.faltante, producto.producto
              FROM almacen_transferencias_detalle , producto 
              WHERE almacen_transferencias_detalle.almacen_transferencias_id = $transferencia 
              AND almacen_transferencias_detalle.producto_id = producto.producto_id";
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
        <th>Producto</th>
        <th>Devuelto</th>
        <th>Faltante</th>

        <th></th>
      </tr>
    </thead>

    <tbody>
      <?php do { ?>
      <tr>
        <td><?php echo $row_table["almacen_transferencias_detalle_id"]; ?></td>
        <td><?php echo $row_table["producto"]; ?></td>
        <td><?php echo $row_table["cantidad"]; ?></td>
        <td><?php echo $row_table["faltante"]; ?></td>
        <td>
          <div class="btn-group">
            <button class="btn btn-xs btn-info tooltip-info" data-rel="tooltip" data-placement="left" title="EDITAR!" onclick="javascript: fn_mostrar_frm_modificar_devolucions_producto(<?=$row_table['almacen_transferencias_detalle_id']?>, <?=$transferencia?>, <?=$_GET['origen']?>, <?=$_GET['destino']?>);">
              <i class="ace-icon fa fa-pencil bigger-120"></i>
            </button>

            <!-- <button class="btn btn-xs btn-danger tooltip-info" data-rel="tooltip" data-placement="left" title="ELMINAR!" onclick="javascript: fn_eliminar_devolucions_producto(<?=$row_table['almacen_transferencias_detalle_id']?>, <?=$_GET['transferencia_id']?>, <?=$_GET['origen']?>, <?=$_GET['destino']?>);">
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