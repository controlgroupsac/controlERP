<?php  
	include "../../config/conexion.php"; 
    include("../../queries/query.php"); 
    $query = "SELECT compra.total, almacen.almacen, proveedor.proveedor, compra.compra_id
			  FROM compra , almacen , proveedor
			  WHERE compra.almacen_id = almacen.almacen_id
			  AND compra.proveedor_id = proveedor.proveedor_id
			  ORDER BY compra.compra_id ASC" ;
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
				<th>proveedor</th>
				<th>total</th>

				<th></th>
			</tr>
		</thead>

		<tbody>
			<?php do { ?>
			<tr>
				<td><?php $totalRows_table--; echo $totalRows_table; ?></td>
				<td><?php echo $row_table["almacen"]; ?></td>
				<td><?php echo $row_table["proveedor"]; ?></td>
				<td><?php echo $row_table["total"]; ?></td>
				<td>
					<div class="hidden-sm hidden-xs btn-group">
						<button class="btn btn-xs btn-info tooltip-info" data-rel="tooltip" data-placement="left" title="EDITAR!" onclick="javascript: fn_mostrar_frm_modificar_compras_registro(<?=$row_table['compra_id']?>);">
							<i class="ace-icon fa fa-pencil bigger-120"></i>
						</button> 
						<a class="btn btn-xs btn-yellow tooltip-yellow" data-rel="tooltip" data-placement="left" title="REGISTRAR!" href="compras.php?compra_id=<?php echo $row_table['compra_id']; ?>">
							<span> <i class="ace-icon fa fa-pencil-square-o bigger-120"></i> </span>
						</a> 
						<a class="btn btn-xs btn-danger tooltip-error" data-rel="tooltip" data-placement="left" title="ANULAR!"  href="#">
							<span> <i class="ace-icon fa fa-trash bigger-120"></i> </span>
						</a>
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