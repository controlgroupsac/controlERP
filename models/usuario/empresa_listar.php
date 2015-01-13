<?php  
	include "../../config/conexion.php"; 
    include("../../queries/query.php"); 

    mysql_select_db($database_fastERP, $fastERP);
    $table = mysql_query("SELECT * FROM empresa", $fastERP) or die(mysql_error());
    $totalRows_table = mysql_num_rows($table);
    $row_table = mysql_fetch_assoc($table);
?>
 <div class="table-responsive">
	<table id="simple-table" class="table table-striped table-bordered table-hover">
		<thead>
			<tr>
				<th>Empresa</th>
				<th>propiedtario</th>
				<th>ruc</th>
				<th>direccion</th>
				<th>ciudad</th>
				<th>pais</th>

				<th></th>
			</tr>
		</thead>

		<tbody>
			<?php do { ?>
			<tr>
				<td><?php echo $row_table["empresa"]; ?></td>
				<td><?php echo $row_table["propiedtario"]; ?></td>
				<td><?php echo $row_table["ruc"]; ?></td>
				<td><?php echo $row_table["direccion"]; ?></td>
				<td><?php echo $row_table["ciudad"]; ?></td>
				<td><?php echo $row_table["pais"]; ?></td>
				<td>
					<div class="hidden-sm hidden-xs btn-group">
						<button class="btn btn-xs btn-info" onclick="javascript: fn_mostrar_frm_modificar_empresa(<?=$row_table['empresa_id']?>);">
							<i class="ace-icon fa fa-pencil bigger-120"></i>
						</button>

						<!-- <button class="btn btn-xs btn-danger" onclick="javascript: fn_eliminar_empresa(<?=$row_table['empresa_id']?>);">
							<i class="ace-icon fa fa-trash-o bigger-120"></i>
						</button> -->
					</div>

					<div class="hidden-md hidden-lg">
						<div class="inline pos-rel">
							<button class="btn btn-minier btn-primary dropdown-toggle" data-toggle="dropdown" data-position="auto">
								<i class="ace-icon fa fa-cog icon-only bigger-110"></i>
							</button>

							<ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
								<li>
									<a href="javascript: fn_mostrar_frm_modificar_empresa(<?=$row_table['empresa_id']?>);" class="tooltip-success" data-rel="tooltip" title="Edit">
										<span class="green">
											<i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
										</span>
									</a>
								</li>

								<!-- <li>
									<a href="javascript: fn_eliminar_empresa(<?=$row_table['empresa_id']?>);" class="tooltip-error" data-rel="tooltip" title="Delete">
										<span class="red">
											<i class="ace-icon fa fa-trash-o bigger-120"></i>
										</span>
									</a>
								</li> -->
							</ul>
						</div>
					</div>
				</td>
			</tr>
			<?php } while ( $row_table = mysql_fetch_assoc($table) ); ?>
		</tbody>
	</table>
</div>