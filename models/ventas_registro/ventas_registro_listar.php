<?php  
	include "../../config/conexion.php"; 
    include("../../queries/query.php"); 
    $query = "SELECT ventas.total, ventas.estado, almacen.almacen, ventas.ventas_id
			  FROM ventas , almacen
			  WHERE ventas.almacen_id = almacen.almacen_id
			  ORDER BY ventas.ventas_id DESC" ;
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
				<th>Almacen</th>
				<th>total</th>

				<th></th>
			</tr>
		</thead>

		<tbody>
			<?php do { ?>
			<tr>
				<td><?php $totalRows_table--; echo $totalRows_table; ?></td>
				<td><?php echo $row_table["almacen"]; ?></td>
				<td><?php echo $row_table["total"]; ?></td>
				<td>
					<div class="hidden-sm hidden-xs btn-group">
						<a class="btn btn-xs btn-yellow tooltip-yellow" data-rel="tooltip" data-placement="left" title="VENDER!" href="ventas.php?venta_id=<?php echo $row_table['ventas_id']; ?>">
							<span> <i class="ace-icon fa fa-pencil-square-o bigger-120"></i> </span>
						</a> 
					</div>
<!-- 					<?php if($row_table['estado'] == 1){ ?> 
						<span class="label label-lg label-yellow arrowed-right" id="registrar-span">En proceso... </span>  
					<?php } elseif($row_table['estado'] == 2) { ?>
						<span class=" label label-lg label-pink arrowed-right" id="registrado" >Registrado</span>
					<?php } elseif($row_table['estado'] == 3) { ?>
						<span class=" label label-lg label-success arrowed-right" id="recibido" >Recibido</span>
					<?php }else { ?>
						<span class=" label label-lg label-danger arrowed-right" id="rechazado" >Rechazado</span>
					<?php } ?>-->
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