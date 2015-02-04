<?php  
	include "../../config/conexion.php"; 
    include("../../queries/query.php");

    $transferencia = @$_GET['transferencia_id'];
    if($transferencia == "" || empty($transferencia)) {
    	$transferencia = "";
    }
    $query = "SELECT producto.producto, almacen_det.almacendet_id, almacen_det.transferencia_id, almacen_det.cantidad
			  FROM almacen_transferencia , almacen_det , producto
			  WHERE almacen_det.transferencia_id = almacen_transferencia.transferencia_id 
			  AND almacen_det.transferencia_id <> 0
			  AND almacen_det.producto_id = producto.producto_id
			  AND almacen_det.transferencia_id = $transferencia" ;
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
				<td><?php echo $row_table["producto"]; ?></td>
				<td><?php echo $row_table["cantidad"]; ?></td>
				<td>
					<div class="btn-group">
						<button class="btn btn-xs btn-info tooltip-info" data-rel="tooltip" data-placement="left" title="EDITAR!" onclick="javascript: fn_mostrar_frm_modificar_transferencias(<?=$row_table['almacendet_id']?>);">
							<i class="ace-icon fa fa-pencil bigger-120"></i>
						</button>

						<button class="btn btn-xs btn-danger tooltip-info" data-rel="tooltip" data-placement="left" title="ELMINAR!" onclick="javascript: fn_eliminar_transferencias(<?=$row_table['almacendet_id']?>);">
							<i class="ace-icon fa fa-trash-o bigger-120"></i>
						</button>
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