<?php  
	include "../../config/conexion.php"; 
	$query_almacen = "SELECT * FROM almacen , almacen_det
					  WHERE almacen.almacen_id = almacen_det.almacen_id
					GROUP BY almacen_det.almacen_id" ;
	mysql_select_db($database_fastERP, $fastERP);
	$almacen = mysql_query($query_almacen, $fastERP) or die(mysql_error());
	$totalRows_almacen = mysql_num_rows($almacen);
	$row_almacen = mysql_fetch_assoc($almacen);
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>ControlERP</title>

		<meta name="description" content="ventas" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" />
		<link rel="stylesheet" href="../../views/fonts/css/font-awesome.min.css" />
		<link rel="stylesheet" href="../../views/css/bootstrap.min.css" type="text/css" />
		<link rel="stylesheet" href="../../views/css/main.css" type="text/css" />

		<!-- text fonts -->
		<link rel="stylesheet" href="../../views/fonts/fonts.googleapis.com.css" />

		<!-- ace styles -->
		<link rel="stylesheet" href="../../views/css/ace.min.css" />
		<link rel="stylesheet" href="../../views/css/ace-rtl.min.css" />
		
		<!-- ace settings handler -->
		<script src="js/vendor/ace-extra.min.js"></script>
	</head>

<body class="no-skin">
	<div class="main-container" id="main-container">
		<div class="main-content">
			<div class="row">
				<!-- <div class="col-xs-12" id="div_compra_registro"> -->
				<div class="col-xs-12">
					<!-- PAGE CONTENT BEGINS -->

						<div class="page-header">
							<h1>
								Invervalle
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									Existencia de productos por almacen
								</small>
							</h1>
						</div><!-- /.page-header -->

						<?php do { ?>
							<?php  
								$query = "SELECT almacen_det.almacendet_id, almacen.almacen, producto.producto, almacen_det.cantidad
										  FROM almacen , almacen_det , producto
										  WHERE almacen_det.almacen_id = almacen.almacen_id 
										  AND almacen_det.producto_id = producto.producto_id 
										  AND almacen_det.almacen_id = $row_almacen[almacen_id]" ;
								mysql_select_db($database_fastERP, $fastERP);
								$table = mysql_query($query, $fastERP) or die(mysql_error());
								$totalRows_table = mysql_num_rows($table);
								$row_table = mysql_fetch_assoc($table);
							?>
							<div class="bloque col-xs-4 col-sm-3">
								<table class='table table-condensed'>
									<thead>
										<th colspan='2'>Almacen <?php echo $row_almacen['almacen']; ?></th>
										<th align='center'>Producto</th>
										<th align='center'>Cantidad</th>
									</thead>
									<tbody>
										<?php do { ?>
											<tr>
												<td colspan='2'><?php echo $row_table['almacen']; ?></td>
												<td><?php echo $row_table['producto'] ; ?></td>
												<td><?php echo $row_table['cantidad']; ?></td>
											</tr>
										<?php } while ($row_table = mysql_fetch_assoc($table)); ?>
									</tbody>
								</table>
							</div>
						<?php } while ( $row_almacen = mysql_fetch_assoc($almacen) ); ?>

					<!-- PAGE CONTENT ENDS -->
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.main-content -->
	</div><!-- /.container -->
</body>
</html>

