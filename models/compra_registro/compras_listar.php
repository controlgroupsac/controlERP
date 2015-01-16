<?php  
	include "../../config/conexion.php"; 
    include("../../queries/query.php"); 
    $query = "SELECT compra.total, almacen.almacen, proveedor.proveedor, compra.compra_id
			  FROM compra , almacen , proveedor
			  WHERE compra.almacen_id = almacen.almacen_id
			  AND compra.proveedor_id = proveedor.proveedor_id" ;
    mysql_select_db($database_fastERP, $fastERP);
    $table = mysql_query($query, $fastERP) or die(mysql_error());
    $totalRows_table = mysql_num_rows($table);
    $row_table = mysql_fetch_assoc($table);;
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
				<td><?php echo $row_table["compra_id"]; ?></td>
				<td><?php echo $row_table["almacen"]; ?></td>
				<td><?php echo $row_table["proveedor"]; ?></td>
				<td><?php echo $row_table["total"]; ?></td>
				<td>
					<div class="hidden-sm hidden-xs btn-group">
						<button class="btn btn-xs btn-info tooltip-info" data-rel="tooltip" data-placement="left" title="EDITAR!" onclick="javascript: fn_mostrar_frm_modificar_compras(<?=$row_table['compras_id']?>);">
							<i class="ace-icon fa fa-pencil bigger-120"></i>
						</button>

						<button class="btn btn-xs btn-danger tooltip-error" data-rel="tooltip" data-placement="left" title="ELMINAR!" onclick="javascript: fn_eliminar_compras(<?=$row_table['compras_id']?>);">
							<i class="ace-icon fa fa-trash-o bigger-120"></i>
						</button>
					</div>

					<div class="hidden-md hidden-lg">
						<div class="inline pos-rel">
							<button class="btn btn-minier btn-primary dropdown-toggle" data-toggle="dropdown" data-position="auto">
								<i class="ace-icon fa fa-cog icon-only bigger-110"></i>
							</button>

							<ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
								<li>
									<a href="javascript: fn_mostrar_frm_modificar_compras(<?=$row_table['compras_id']?>);" class="tooltip-success" data-rel="tooltip" title="Edit">
										<span class="green">
											<i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
										</span>
									</a>
								</li>

								<li>
									<a href="javascript: fn_eliminar_compras(<?=$row_table['compras_id']?>);" class="tooltip-error" data-rel="tooltip" title="Delete">
										<span class="red">
											<i class="ace-icon fa fa-trash-o bigger-120"></i>
										</span>
									</a>
								</li>
							</ul>
						</div>
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