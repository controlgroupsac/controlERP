<?php  
    include "../../config/conexion.php"; 
    include("../../queries/query.php");

    $transferencia = @$_GET['transferencia_id'];
    if($transferencia == "" || empty($transferencia)) {
      $transferencia = "";
    }
    
    $query = "SELECT almacen_transferencias_detalle.almacen_transferencias_detalle_id, almacen_transferencias_detalle.almacen_transferencias_id, 
                    producto.producto,
                    if(producto.unidad_id = 2, almacen_transferencias_detalle.cantidad, CONCAT((almacen_transferencias_detalle.cantidad DIV producto.factor), ' / ', (almacen_transferencias_detalle.cantidad MOD producto.factor))) AS devuelto,
                    if(producto.unidad_id = 2, almacen_transferencias_detalle.faltante, CONCAT((almacen_transferencias_detalle.faltante DIV producto.factor), ' / ', (almacen_transferencias_detalle.faltante MOD producto.factor))) AS faltante
            FROM almacen_transferencias_detalle , producto
            WHERE almacen_transferencias_detalle.producto_id = producto.producto_id 
            AND almacen_transferencias_detalle.almacen_transferencias_id = $transferencia
            ORDER BY almacen_transferencias_detalle.almacen_transferencias_detalle_id ASC";
    mysql_select_db($database_fastERP, $fastERP);
    $table = mysql_query($query, $fastERP) or die(mysql_error());
    $totalRows_table = mysql_num_rows($table);
    $row_table = mysql_fetch_assoc($table);
?>
<div class="table-responsive">
  <table id="simple-table" class="table table-striped table-bordered table-hover">
    <thead>
      <tr>
        <th></th>
        <th>Producto</th>
        <th>Devuelto</th>
        <th>Aún por devolver</th>

        <th></th>
      </tr>
    </thead>

    <tbody>
      <?php $contador = $totalRows_table;
      do { ?>
        <tr>
          <td width="5%"><?=$contador--?></td>
          <td width="50%"><?=$row_table["producto"]; ?></td>
          <td width="10%"><?=$row_table["devuelto"]; ?></td>
          <td width="10%">
            <span class="label label-lg label-danger arrowed arrowed-right"> <?=$row_table['faltante']; ?> </span>
          </td>
          <td width="5%">
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