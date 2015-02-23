<?php  
	include "../../config/conexion.php"; 
    include("../../queries/query.php"); 
    $query = "SELECT compra.total, compra.estado, almacen.almacen, proveedor.proveedor, compra.compra_id, compra.fecha
			  FROM compra , almacen , proveedor
			  WHERE compra.almacen_id = almacen.almacen_id
			  AND compra.proveedor_id = proveedor.proveedor_id
			  ORDER BY compra.compra_id DESC" ;
    mysql_select_db($database_fastERP, $fastERP);
    $table = mysql_query($query, $fastERP) or die(mysql_error());
    $totalRows_table = mysql_num_rows($table);
    $row_table = mysql_fetch_assoc($table);

    $totalRows_table += 1; 
    if ($row_table['estado'] == "") {
    	echo '<script type="text/javascript"> $("#compras_registro_listar_lista").addClass("hidden"); </script>';
    }
?>

<div class="table-responsive" id="compras_registro_listar_lista">
	<table id="simple-table" class="table table-striped table-bordered table-hover">
		<thead>
			<tr>
				<th>&nbsp;</th>
				<th>Fecha</th>
				<th>Almacen</th>
				<th>Proveedor</th>
				<th>total</th>

				<th></th>
			</tr>
		</thead>

		<tbody>
			<?php do { ?>
			<tr>
				<td><?php $totalRows_table--; echo $totalRows_table; ?></td>
				<td>
					<span class="label label-lg label-purple arrowed-in arrowed-in-right">
						<?php echo $row_table["fecha"]; ?>
					</span>
				</td>
				<td><?php echo $row_table["almacen"]; ?></td>
				<td><?php echo $row_table["proveedor"]; ?></td>
				<td><?php echo number_format($row_table["total"], 2); ?></td>
				<td>
					<div class="hidden-sm hidden-xs btn-group">
						<?php if($row_table['estado'] == 1){ ?>
							<a class="btn btn-xs btn-yellow tooltip-yellow" id="btn_compras_registro" data-rel="tooltip" data-placement="left" title="REGISTRAR!" href="compras.php?compra_id=<?php echo $row_table['compra_id']; ?>">
								<span> <i class="ace-icon fa fa-pencil-square-o bigger-120"></i> </span>
							</a> 
							<span class="label label-lg label-yellow arrowed-right" id="registrar-span">En proceso... </span>  <!-- Fase 1 de la compra -->
						<?php } elseif($row_table['estado'] == 2) { ?>
							<a class="btn btn-xs btn-yellow tooltip-yellow" id="btn_compras_registro" data-rel="tooltip" data-placement="left" title="REGISTRAR!" href="compras.php?compra_id=<?php echo $row_table['compra_id']; ?>">
								<span> <i class="ace-icon fa fa-pencil-square-o bigger-120"></i> </span>
							</a> 
							<span class=" label label-lg label-pink arrowed-right" id="registrado" >Registrado</span>
						<?php } elseif($row_table['estado'] == 3) { ?>
							<span class=" label label-lg label-success arrowed-right" id="recibido" >Recibido</span>
						<?php }else { ?>
							<span class=" label label-lg label-danger arrowed-right" id="rechazado" >Rechazado</span>
						<?php } ?>
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