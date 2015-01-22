<?php  
	include "../../config/conexion.php"; 
    include("../../queries/query.php"); 
    $query = "SELECT ventas_det.ventas_id, ventas_det.cantidad, ventas_det.precio, ventas_det.ventas_det_id, ventas.descuento, producto_ensamblado.producto
			  FROM ventas_det , ventas , producto_ensamblado
			  WHERE ventas_det.ventas_id = $_GET[ventas_id]
			  AND ventas_det.ventas_id = ventas.ventas_id 
			  AND ventas_det.producto_id = producto_ensamblado.producto_ensamblado_id
			  ORDER BY `ventas_det`.ventas_det_id DESC" ;
    mysql_select_db($database_fastERP, $fastERP);
    $table = mysql_query($query, $fastERP) or die(mysql_error());
    $totalRows_table = mysql_num_rows($table);
    $row_table = mysql_fetch_assoc($table);
?>
<div class="table-responsive">
	<table id="simple-table" class="table table-striped table-bordered table-hover text-right">
		<thead>
			<tr>
				<th>Producto</th>
				<th>Cant.</th>
				<th>Precio</th>
				<th>Subtot.</th>

				<th></th>
			</tr>
		</thead>

		<tbody>
			</tr><?php do { ?>
				<tr>
					<td><?php echo $row_table["producto"]; ?></td>
					<td><?php echo $row_table["cantidad"]; ?></td>
					<td><?php echo $row_table["precio"]; ?></td>
					<td><?php echo $row_table["precio"] * $row_table["cantidad"]; ?></td>
					<td>
						<div class="hidden-sm hidden-xs btn-group">
							<button class="btn btn-xs btn-info tooltip-info " data-rel="tooltip" data-placement="left" title="EDITAR!" onclick="javascript: fn_mostrar_frm_modificar_ventas_det(<?=$row_table['ventas_det_id']?>);">
								<i class="ace-icon fa fa-pencil bigger-120"></i>
							</button>

							<button class="btn btn-xs btn-danger tooltip-error" data-rel="tooltip" data-placement="left" title="ELMINAR!" onclick="javascript: fn_eliminar_ventas_det(<?=$row_table['ventas_det_id']?>);">
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
										<a href="javascript: fn_mostrar_frm_modificar_ventas_det(<?=$row_table['ventas_det_id']?>);" class="tooltip-success" data-rel="tooltip" title="Edit">
											<span class="green">
												<i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
											</span>
										</a>
									</li>

									<li>
										<a href="javascript: fn_eliminar_ventas_det(<?=$row_table['ventas_det_id']?>);" class="tooltip-error" data-rel="tooltip" title="Delete">
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