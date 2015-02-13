<?php  
	include "../../config/conexion.php"; 
    include("../../queries/query.php"); 
    $query = "SELECT ventas_det.ventas_id, ventas_det.cantidad, ventas_det.precio, ventas_det.ventas_det_id, ventas.descuento, 
    				 producto_ensamblado.producto_ensamblado_id, producto_ensamblado.producto
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
						<div class="btn-group">
							<button id="btn_ventas_det_listar_editar" class="btn btn-xs btn-info tooltip-info " data-rel="tooltip" data-placement="left" title="EDITAR!" onclick="javascript: fn_mostrar_frm_modificar_ventas_det(<?=$row_table['ventas_det_id']?>);">
								<i class="ace-icon fa fa-pencil bigger-120"></i>
							</button>

							<button id="btn_ventas_det_listar_eliminar" class="btn btn-xs btn-danger tooltip-error" data-rel="tooltip" data-placement="left" title="ELMINAR!" onclick="javascript: fn_eliminar_ventas_det(<?=$row_table['ventas_id']?>, <?=$row_table['ventas_det_id']?>, <?=$row_table['producto_ensamblado_id']?>);">
								<i class="ace-icon fa fa-trash-o bigger-120"></i>
							</button>
						</div>
					</td>
				</tr>
				<?php } while ( $row_table = mysql_fetch_assoc($table) ); ?>
		</tbody>
	</table>
</div>
<?php  
  if($totalRows_table == 0) { 
    echo '<script type="text/javascript"> $("#btn_ventas_det_listar_editar, #btn_ventas_det_listar_eliminar").addClass("hidden"); </script>';
  }
?>