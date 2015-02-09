<?php  
	include "../../config/conexion.php"; 
    include("../../queries/query.php"); 
    $query = "SELECT compra_det.compra_id, compra_det.cantidad, compra_det.monto, compra_det.compra_det_id, producto_ensamblado.producto
			  FROM compra_det , compra , producto_ensamblado
			  WHERE compra_det.compra_id = $_GET[compra_id]
			  AND compra_det.compra_id = compra.compra_id 
			  AND compra_det.producto_id = producto_ensamblado.producto_ensamblado_id
			  ORDER BY `compra_det`.compra_det_id DESC" ;
    mysql_select_db($database_fastERP, $fastERP);
    $table = mysql_query($query, $fastERP) or die(mysql_error());
    $totalRows_table = mysql_num_rows($table);
    $row_table = mysql_fetch_assoc($table);

    $totalRows_table += 1; 
?>
<div class="table-responsive">
	<table id="simple-table" class="table table-striped table-bordered table-hover">
		<thead>
			<tr>
				<th>&nbsp;</th>
				<th>producto</th>
				<th>cantidad</th>
				<th>monto</th>
				<th>Subtotal</th>

				<th></th>
			</tr>
		</thead>

		<tbody>
			<?php do { ?>
			<tr>
				<td><?php $totalRows_table--; echo $totalRows_table; ?></td>
				<td><?php echo $row_table["producto"]; ?></td>
				<td><?php echo $row_table["cantidad"]; ?></td>
				<td><?php echo $row_table["monto"]; ?></td>
				<td><?php echo $row_table["monto"] * $row_table["cantidad"]; ?></td>
				<td>
					<div class="btn-group">
						<button class="btn btn-xs btn-info tooltip-info" id="compra_add_det" data-rel="tooltip" data-placement="left" title="EDITAR!" onclick="javascript: fn_mostrar_frm_modificar_compra_det(<?=$row_table['compra_det_id']?>);">
							<i class="ace-icon fa fa-pencil bigger-120"></i>
						</button>

						<button class="btn btn-xs btn-danger tooltip-error" id="compra_add_det2" data-rel="tooltip" data-placement="left" title="ELMINAR!" onclick="javascript: fn_eliminar_compra_det(<?=$row_table['compra_det_id']?>);">
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
<?php  
    $query = "SELECT * FROM `controlg_controlerp`.`compra`
			  WHERE compra.compra_id = $_GET[compra_id]";
    mysql_select_db($database_fastERP, $fastERP);
    $table = mysql_query($query, $fastERP) or die(mysql_error());
    $row_table = mysql_fetch_assoc($table);

	if($row_table['estado'] == 2 || $row_table['estado'] == 3 ||$row_table['estado'] == 4) { 
		echo "<script>jQuery('input, select, button').attr('disabled', 'true');</script>"; 
		echo "<script>jQuery('#recibir, #rechazar').removeAttr('disabled');</script>"; 
		echo '<script type="text/javascript"> $("#compra_add_det, #compra_add_det2").addClass("hidden"); </script>';
	}
	if($totalRows_table == 0) { 
		echo '<script type="text/javascript"> $("#compra_add_det, #compra_add_det2").addClass("hidden"); </script>';
	}
?>