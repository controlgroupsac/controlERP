<?php  
	include "../../config/conexion.php"; 
	$query = "SELECT producto.producto, unidad.unidad,
			FORMAT(Sum(almacen_det.cantidad),0) AS cantidad,
			FORMAT(producto.precio,2) AS precio,
			FORMAT(Sum(almacen_det.cantidad)*producto.precio,2) AS SubTotal,
			FORMAT(Sum(almacen_det.cantidad) div producto.factor,0) AS Cajas,
			FORMAT(Sum(almacen_det.cantidad) mod producto.factor,0) AS Botellas
			FROM almacen_det , producto , unidad , almacen
			WHERE almacen_det.producto_id = producto.producto_id 
			AND producto.unidad_id = unidad.unidad_id
			AND almacen.almacen_id = almacen_det.almacen_id
			AND almacen.almacen_id = $_GET[almacen_id]
			GROUP BY almacen.almacen_id, producto.producto_id" ;
	mysql_select_db($database_fastERP, $fastERP);
	$table = mysql_query($query, $fastERP) or die(mysql_error());
	$totalRows_table = mysql_num_rows($table);
	$row_table = mysql_fetch_assoc($table);
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
									Reporte Consolidado Por Almacen
								</small>
							</h1>
						</div><!-- /.page-header -->

						<div class="bloque col-xs-4 col-sm-3">
							<table class='table table-condensed'>
								<thead>
									<th></th>
									<th>Producto</th>
									<th>Unidad</th>
									<th>Cantidad</th>
									<th>Precio</th>
									<th>Sub Total</th>
									<th>Cajas</th>
									<th>Botellas</th>
								</thead>
								<tbody>
									<?php do { ?>
										<tr>
											<td></td>
											<td nowrap><?php echo $row_table['producto'] ; ?></td>
											<td><?php echo $row_table['unidad']; ?></td>
											<td><?php echo $row_table['cantidad']; ?></td>
											<td><?php echo $row_table['precio']; ?></td>
											<td><?php echo $row_table['SubTotal']; ?></td>
											<td><?php echo $row_table['Cajas']; ?></td>
											<td><?php echo $row_table['Botellas']; ?></td>
										</tr>
									<?php } while ($row_table = mysql_fetch_assoc($table)); ?>
								</tbody>
							</table>
						</div>

					<!-- PAGE CONTENT ENDS -->
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.main-content -->
	</div><!-- /.container -->
</body>
</html>

