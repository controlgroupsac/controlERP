<?php  
	include "../../config/conexion.php"; 
	$query = "SELECT
			producto.producto,
			unidad.unidad,
			FORMAT(Sum(almacen_det.cantidad),0) AS cantidad,
			FORMAT(producto.precio,2) AS precio,
			FORMAT(Sum(almacen_det.cantidad)*producto.precio,2) AS SubTotal,
			FORMAT(Sum(almacen_det.cantidad) div producto.factor,0) AS Cajas,
			FORMAT(Sum(almacen_det.cantidad) mod producto.factor,0) AS Botellas,
				almacen.almacen
			FROM almacen_det , producto , unidad , almacen
			WHERE almacen_det.producto_id = producto.producto_id 
			AND producto.unidad_id = unidad.unidad_id
			AND almacen.almacen_id = almacen_det.almacen_id
			AND almacen.almacen_id = $_GET[almacen_id]
			AND producto.categoria_id <> 4
			GROUP BY
			almacen.almacen_id,
			producto.producto_id" ;
	mysql_select_db($database_fastERP, $fastERP);
	$table = mysql_query($query, $fastERP) or die(mysql_error());
	$totalRows_table = mysql_num_rows($table);
	$row_table = mysql_fetch_assoc($table);

	$query1 = "SELECT almacen.almacen, almacen_det.producto_id, almacen_det.producto_ensamblado_id,
					SUM(almacen_det.cantidad) AS cantidad,
					(SUM(almacen_det.cantidad)div producto.factor) AS cajas,
					(SUM(almacen_det.cantidad)mod producto.factor) AS botella,
					producto.envase_id_bot, producto.envase_id_cj, producto.categoria_id, producto.producto, producto.factor
			  FROM almacen , almacen_det , producto
			  WHERE almacen.almacen_id = almacen_det.almacen_id 
			  AND almacen_det.producto_id = producto.producto_id
			  AND producto.categoria_id <> 4
			  AND almacen_det.almacen_id = $_GET[almacen_id]
			  GROUP BY producto.envase_id_bot";

	mysql_select_db($database_fastERP, $fastERP);
	$table1 = mysql_query($query1, $fastERP) or die(mysql_error());
	$totalRows_table1 = mysql_num_rows($table1);
	$row_table1 = mysql_fetch_assoc($table1);

	$envases = "SELECT producto.producto,
					   SUM(ctacorriente_cliente_env.cantidad)
				FROM ctacorriente_cliente_env , producto
				WHERE ctacorriente_cliente_env.producto_id = producto.producto_id
				GROUP BY ctacorriente_cliente_env.producto_id" ;
	mysql_select_db($database_fastERP, $fastERP);
	$envases = mysql_query($envases, $fastERP) or die(mysql_error());
	$totalRows_envases = mysql_num_rows($envases);
	$row_envases = mysql_fetch_assoc($envases);
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
		<link rel="stylesheet" href="../ventas/imprimir.css" type="text/css" />

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

						<div class="bloque col-xs-6 col-sm-6">
							<table class='table table-condensed'>
								<caption>
									<span class="label label-lg arrowed-right" id="registrar-span"><?php echo $row_table['almacen']; ?> </span>
								</caption>
								<thead>
									<th></th>
									<th>Producto</th>
									<th>Unidad</th>
									<th nowrap>Unitario</th>
									<th>Precio</th>
									<th nowrap>Sub Total</th>
									<th nowrap>Cajas</th>
									<th>Botellas</th>
									
								</thead>
								<tbody>
									<?php do { ?>
										<tr>
											<td></td>
											<td nowrap><?php echo $row_table['producto'] ; ?></td>
											<td><?php echo $row_table['unidad']; ?></td>
											<td class="text-right"><?php echo $row_table['cantidad']; ?></td>
											<td class="text-right"><?php echo $row_table['precio']; ?></td>
											<td class="text-right"><?php echo $row_table['SubTotal']; ?></td>
											<td class="text-right"><?php echo $row_table['Cajas']; ?></td>
											<td class="text-right"><?php echo $row_table['Botellas']; ?></td>
										</tr>
									<?php } while ($row_table = mysql_fetch_assoc($table)); ?>
								</tbody>
							</table>

							<table class='table table-condensed'>
								<caption>
									<span class="label label-lg arrowed-right" id="registrar-span">Envases Vacios </span>
								</caption>
								<thead>
									<th>Envase</th>
									<th>Cajas</th>
									<th nowrap>Botellas</th>
									<th>Envase</th>
									<th nowrap>Cajas</th>
									<th></th>
									<th></th>
									
								</thead>
								<tbody>
									<?php
									if ($totalRows_table1 > 0){	/*Verificamos que haya algun registro para poder imprimir las filas*/
										do {
											/*Consulta para ver las botellas VACIAS*/
										 	$cantidad = $row_table1['cantidad'];
											$query2 = "SELECT (Sum(almacen_det.cantidad) - '$cantidad') AS cantidad,
															  ((Sum(almacen_det.cantidad)- '$cantidad') DIV producto.factor) AS cajas,
															  ((Sum(almacen_det.cantidad)- '$cantidad') MOD producto.factor) AS botellas,
															  producto.producto
													   FROM almacen , almacen_det , producto
													   WHERE almacen.almacen_id    = almacen_det.almacen_id
													   AND almacen.almacen_id	   = $_GET[almacen_id]
													   AND almacen_det.producto_id ='$row_table1[envase_id_bot]'
													   AND producto.producto_id    = almacen_det.producto_id";
											mysql_select_db($database_fastERP, $fastERP);
											$table2 = mysql_query($query2, $fastERP) or die(mysql_error());
											$row_table2 = mysql_fetch_assoc($table2);

											/*Consulta para ver las botellas CAJAS*/
											$cajas = $row_table1['cajas'];
											$query3 = "SELECT (Sum(almacen_det.cantidad)) AS cantidad,
															 ((Sum(almacen_det.cantidad) DIV producto.factor) - '$cajas') AS cajas,
															  (Sum(almacen_det.cantidad) MOD producto.factor)  AS botellas,
															producto.producto
													   FROM almacen, almacen_det, producto
													   WHERE almacen.almacen_id    = almacen_det.almacen_id 
													   AND almacen.almacen_id	   = $_GET[almacen_id]
													   AND almacen_det.producto_id ='$row_table1[envase_id_cj]'
													   AND producto.producto_id    = almacen_det.producto_id";
											mysql_select_db($database_fastERP, $fastERP);
											$table3 = mysql_query($query3, $fastERP) or die(mysql_error());
											$row_table3 = mysql_fetch_assoc($table3);
										?>
										<tr>
											<td><?php echo $row_table2['producto']; ?></td>
											<td><?php echo $row_table2['cajas']; ?></td>
											<td><?php echo $row_table2['botellas']; ?></td>
											<td><?php echo $row_table3['producto']; ?></td>
											<td><?php echo $row_table3['cajas']; ?></td>
											<td></td>
											<td></td>
											
										</tr>
									<?php } while ($row_table1 = mysql_fetch_assoc($table1));
									} ?>
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
