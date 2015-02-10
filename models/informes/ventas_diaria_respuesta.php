<?php  
	include "../../config/conexion.php"; 
	$query_contado = "SELECT ventas.ventas_id, almacen.almacen, 
			CONCAT(cliente.nombres, ' ',cliente.apellidos) AS cliente,
			FORMAT(ventas.valor_neto,2) AS valorneto,
			FORMAT(ventas.descuento,2) AS descuento,
			FORMAT(ventas.impuesto1,2) AS IGV,
			FORMAT(ventas.impuesto2,2) AS ISC,
			FORMAT(ventas.total,2) AS total, NOW() AS fecha
			FROM ventas , almacen , cliente
			WHERE almacen.almacen_id = ventas.almacen_id 
			AND date(ventas.fecha) = date(now())
			AND ventas.cliente_id = cliente.cliente_id
			AND ventas.almacen_id = $_GET[almacen_id] " ;
	mysql_select_db($database_fastERP, $fastERP);
	$contado = mysql_query($query_contado, $fastERP) or die(mysql_error());
	$totalRows_contado = mysql_num_rows($contado);
	$row_contado = mysql_fetch_assoc($contado);


	$query_contado_detalle = "SELECT ventas.ventas_id,
							CONCAT(cliente.nombres, ' ',cliente.apellidos) AS cliente,
							producto_ensamblado.producto, unidad.abrev, ventas_det.cantidad,
							FORMAT(ventas_det.precio/1.18,2) AS valorneto,
							FORMAT((ventas_det.precio/1.18)*0.18,2) AS IGV,
							FORMAT(ventas_det.precio/1.18,2) AS ISC,
							FORMAT(ventas_det.precio,2) AS total
							FROM ventas , almacen , cliente , ventas_det , producto_ensamblado , unidad
							WHERE almacen.almacen_id = ventas.almacen_id 
							AND date(ventas.fecha) = date(now())
							AND ventas.cliente_id = cliente.cliente_id
							AND ventas.ventas_id = ventas_det.ventas_id
							AND almacen.almacen_id = $_GET[almacen_id]
							AND ventas_det.producto_id = producto_ensamblado.producto_ensamblado_id
							AND producto_ensamblado.unidad_id = unidad.unidad_id " ;
	mysql_select_db($database_fastERP, $fastERP);
	$contado_detalle = mysql_query($query_contado_detalle, $fastERP) or die(mysql_error());
	$totalRows_contado_detalle = mysql_num_rows($contado_detalle);
	$row_contado_detalle = mysql_fetch_assoc($contado_detalle);


	$query_credito = "SELECT ventas.ventas_id, almacen.almacen, 
					  CONCAT(cliente.nombres, ' ',cliente.apellidos) AS cliente,
					  FORMAT(ventas.valor_neto,2) AS valorneto,
					  FORMAT(ventas.descuento,2) AS descuento,
					  FORMAT(ventas.impuesto1,2) AS IGV,
					  FORMAT(ventas.impuesto2,2) AS ISC,
					  FORMAT(ventas.total,2) AS total, NOW() as fecha
					  FROM ventas , almacen , cliente
					  WHERE almacen.almacen_id = ventas.almacen_id 
					  AND date(ventas.fecha) = date(now())
					  AND ventas.cliente_id = cliente.cliente_id
					  AND ventas.almacen_id = $_GET[almacen_id]" ;
	mysql_select_db($database_fastERP, $fastERP);
	$credito = mysql_query($query_credito, $fastERP) or die(mysql_error());
	$totalRows_credito = mysql_num_rows($credito);
	$row_credito = mysql_fetch_assoc($credito);


	$query_credito_detalle = "SELECT almacen.almacen,
							CONCAT(cliente.nombres, ' ',cliente.apellidos) AS cliente,
							CONCAT(comprobante_tipo.comprobante_tipo_abrev, ' ',comprobante.serie, '-',comprobante_det.ventas_id) AS comprobante,
							FORMAT(ctacorriente_cliente.monto,2) AS monto
							FROM ctacorriente_cliente , ventas , cliente , comprobante_det , comprobante , comprobante_tipo , almacen
							WHERE ctacorriente_cliente.ventas_id = ventas.ventas_id 
							AND cliente.cliente_id = ventas.cliente_id
							AND ventas.ventas_id = comprobante_det.ventas_id
							AND comprobante.comprobante_id = comprobante_det.comprobante_id
							AND comprobante.comprobante_tipo_id = comprobante_tipo.comprobante_tipo_id
							AND DATE(ctacorriente_cliente.fecha) = DATE(now())
							AND ctacorriente_cliente.almacen_id = almacen.almacen_id
							AND ctacorriente_cliente.almacen_id = $_GET[almacen_id]" ;
	mysql_select_db($database_fastERP, $fastERP);
	$credito_detalle = mysql_query($query_credito_detalle, $fastERP) or die(mysql_error());
	$totalRows_credito_detalle = mysql_num_rows($credito_detalle);
	$row_credito_detalle = mysql_fetch_assoc($credito_detalle);
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
									Reporte de ventas por cliente
								</small>
								<span class="label label-lg arrowed-right" id="registrar-span"><?php echo $row_contado['almacen']; ?> </span>
							</h1>
						</div><!-- /.page-header -->

						<div class="bloque col-xs-4 col-sm-3">
							<table class='table table-condensed'>
								<caption><strong>Ventas al contado</strong></caption>
								<thead>
									<th></th>
									<th>Cliente</th>
									<th nowrap>Valor Neto</th>
									<th>descuento</th>
									<th>IGV</th>
									<th>ISC</th>
									<th>total</th>
									<th>fecha</th>
								</thead>
								<tbody>
									<?php do { ?>
										<tr>
											<td></td>
											<td nowrap><?php echo $row_contado['cliente']; ?></td>
											<td><?php echo $row_contado['valorneto']; ?></td>
											<td nowrap><?php echo $row_contado['descuento'] ; ?></td>
											<td align="right"><?php echo $row_contado['IGV']; ?></td>
											<td align="right"><?php echo $row_contado['ISC']; ?></td>
											<td align="right"><?php echo $row_contado['total']; ?></td>
											<td nowrap><?php echo $row_contado['fecha']; ?></td>
										</tr>
									<?php } while ($row_contado = mysql_fetch_assoc($contado)); ?>
								</tbody>
							</table>
						</div>
						
						<div class="col-xs-12"><hr></div>

						<div class="bloque col-xs-4 col-sm-3">
							<table class='table table-condensed'>
								<caption><strong>Detalle de Ventas al contado</strong></caption>
								<thead>
									<th></th>
									<th>Cliente</th>
									<th>producto</th>
									<th>abrev</th>
									<th>cantidad</th>
									<th>valorneto</th>
									<th>IGV</th>
									<th>ISC</th>
									<th>total</th>
								</thead>
								<tbody>
									<?php do { ?>
										<tr>
											<td></td>
											<td nowrap><?php echo $row_contado_detalle['cliente']; ?></td>
											<td nowrap><?php echo $row_contado_detalle['producto'] ; ?></td>
											<td nowrap><?php echo $row_contado_detalle['abrev'] ; ?></td>
											<td nowrap><?php echo $row_contado_detalle['cantidad'] ; ?></td>
											<td nowrap><?php echo $row_contado_detalle['valorneto'] ; ?></td>
											<td align="right"><?php echo $row_contado_detalle['IGV']; ?></td>
											<td align="right"><?php echo $row_contado_detalle['ISC']; ?></td>
											<td align="right"><?php echo $row_contado_detalle['total']; ?></td>
										</tr>
									<?php } while ($row_contado_detalle = mysql_fetch_assoc($contado_detalle)); ?>
								</tbody>
							</table>
						</div>
						
						<div class="col-xs-12"><hr></div>

						<div class="bloque col-xs-4 col-sm-3">
							<table class='table table-condensed'>
								<caption><strong>Ventas al credito</strong></caption>
								<thead>
									<th></th>
									<th>Cliente</th>
									<th>valorneto</th>
									<th>descuento</th>
									<th>IGV</th>
									<th>ISC</th>
									<th>total</th>
									<th>fecha</th>
								</thead>
								<tbody>
									<?php do { ?>
										<tr>
											<td></td>
											<td nowrap><?php echo $row_credito['cliente']; ?></td>
											<td nowrap><?php echo $row_credito['valorneto'] ; ?></td>
											<td nowrap><?php echo $row_credito['descuento'] ; ?></td>
											<td nowrap><?php echo $row_credito['IGV']; ?></td>
											<td nowrap><?php echo $row_credito['ISC']; ?></td>
											<td nowrap><?php echo $row_credito['total']; ?></td>
											<td nowrap><?php echo $row_credito['fecha']; ?></td>
										</tr>
									<?php } while ($row_credito = mysql_fetch_assoc($credito)); ?>
								</tbody>
							</table>
						</div>
						
						<div class="col-xs-12"><hr></div>

						<div class="bloque col-xs-4 col-sm-3">
							<table class='table table-condensed'>
								<caption><strong>Detalle de Ventas al credito</strong></caption>
								<thead>
									<th></th>
									<th>Cliente</th>
									<th>comprobante</th>
									<th>monto</th>
								</thead>
								<tbody>
									<?php do { ?>
										<tr>
											<td></td>
											<td nowrap><?php echo $row_credito_detalle['cliente']; ?></td>
											<td nowrap><?php echo $row_credito_detalle['comprobante'] ; ?></td>
											<td nowrap><?php echo $row_credito_detalle['monto'] ; ?></td>
										</tr>
									<?php } while ($row_credito_detalle = mysql_fetch_assoc($credito_detalle)); ?>
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

