<?php  
	include "../../config/conexion.php"; 
    include("../../queries/query.php"); 
    $query = "SELECT unidad.unidad, moneda.moneda, producto_ensamblado.producto_ensamblado_id, producto_ensamblado.producto, producto_ensamblado.activo, producto_ensamblado.num_serie, categoria.categoria, imp_tipo.descripcion
    		  FROM producto_ensamblado , unidad , moneda , categoria , imp_tipo 
    		  WHERE producto_ensamblado.unidad_id = unidad.unidad_id 
    		  AND producto_ensamblado.moneda_id = moneda.moneda_id 
    		  AND producto_ensamblado.categoria_id = categoria.categoria_id 
    		  AND producto_ensamblado.imp_tipo_id = imp_tipo.imp_tipo_id
    		  ORDER BY `producto_ensamblado`.`producto_ensamblado_id` DESC";
    mysql_select_db($database_fastERP, $fastERP);
    $table = mysql_query($query, $fastERP) or die(mysql_error());
    $totalRows_table = mysql_num_rows($table);
    $row_table = mysql_fetch_assoc($table);
?>
 <div class="table-responsive">
	<table id="simple-table" class="table table-striped table-bordered table-hover">
		<thead>
			<tr>
				<th>&nbsp;</th>
				<th><span class="tooltip-info" data-rel="tooltip" data-placement="right" title="nombre del producto_ensamblado!" >Producto_ensamblado <i class="fa fa-question-circle"></i></span></th>
				<th>unidad</th>
				<th>moneda</th>
				<th>categoria</th>
				<th>imp_tipo</th>
				<th>activo</th>
				<th>num_serie</th>

				<th></th>
			</tr>
		</thead>

		<tbody>
			<?php do { ?>
			<tr>
				<td><?php echo $row_table["producto_ensamblado_id"]; ?></td>
				<td><?php echo $row_table["producto"]; ?></td>
				<td><?php echo $row_table["unidad"]; ?></td>
				<td><?php echo $row_table["moneda"]; ?></td>
				<td><?php echo $row_table["categoria"]; ?></td>
				<td><?php echo $row_table["descripcion"]; ?></td>
				<td>
					<?php if($row_table["activo"] == 1){ $activo = "Activo"; $label = "label-success"; }else { $activo = "Inactivo"; $label = "label-warning";} ?>
					<span class="label <?php echo $label; ?> arrowed-in arrowed-in-right"><?php echo $activo; ?></span>
				</td>
				<td><?php echo $row_table["num_serie"]; ?></td>
				<td>
					<div class="hidden-sm hidden-xs btn-group">
						<button class="btn btn-xs btn-info tooltip-info" data-rel="tooltip" data-placement="left" title="EDITAR!" onclick="javascript: fn_mostrar_frm_modificar_producto_ensamblado(<?=$row_table['producto_ensamblado_id']?>);">
							<i class="ace-icon fa fa-pencil bigger-120"></i>
						</button>

						<button class="btn btn-xs btn-danger tooltip-info" data-rel="tooltip" data-placement="left" title="ELMINAR!" onclick="javascript: fn_eliminar_producto_ensamblado(<?=$row_table['producto_ensamblado_id']?>);">
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
									<a href="javascript: fn_mostrar_frm_modificar_producto_ensamblado(<?=$row_table['producto_ensamblado_id']?>);" class="tooltip-success" data-rel="tooltip" title="Edit">
										<span class="green">
											<i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
										</span>
									</a>
								</li>

								<li>
									<a href="javascript: fn_eliminar_producto_ensamblado(<?=$row_table['producto_ensamblado_id']?>);" class="tooltip-error" data-rel="tooltip" title="Delete">
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