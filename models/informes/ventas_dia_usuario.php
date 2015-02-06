<?php  
	include "../../config/conexion.php"; 
	$query = "SELECT almacen.almacen, usuario.usuario,
			CONCAT(comprobante_tipo.comprobante_tipo_abrev,'-000',comprobante_det.numero) AS comprobante,
			UPPER(CONCAT(cliente.nombres, ' ', cliente.apellidos)) AS NombreCliente,
			ventas.fecha,
			producto_ensamblado.producto,
			ventas_det.cantidad,
			FORMAT(ventas_det.precio,2) AS precio,
			FORMAT(ventas_det.precio*ventas_det.cantidad,2) AS SubTotal
			FROM ventas , ventas_det , producto_ensamblado , almacen , cliente , comprobante_det , comprobante , comprobante_tipo ,
			usuario
			WHERE almacen.almacen_id = ventas.almacen_id 
			AND ventas.ventas_id = ventas_det.ventas_id
			AND ventas_det.producto_id = producto_ensamblado.producto_ensamblado_id
			AND cliente.cliente_id = ventas.cliente_id
			AND ventas.ventas_id = comprobante_det.ventas_id
			AND comprobante_det.comprobante_id = comprobante.comprobante_id
			AND comprobante_tipo.comprobante_tipo_id = comprobante.comprobante_tipo_id
			AND ventas.usuario_id = usuario.usuario_id
			AND ventas.usuario_id = 1
			AND date(ventas.fecha) = date(now())" ;
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
									Reporte de ventas diario por usuario
								</small>
							</h1>
						</div><!-- /.page-header -->

						<div class="bloque col-xs-4 col-sm-3">
							<table class='table table-striped'>
								<thead>
									<th></th>
									<th>Almacen</th>
									<th>Usuario</th>
									<th>comprobante</th>
									<th>Nombre Cliente</th>
									<th>fecha</th>
									<th>producto</th>
									<th>cantidad</th>
									<th>precio</th>
									<th>SubTotal</th>
								</thead>
								<tbody>
									<?php 
										$var_almacen = $row_table['almacen'];
										$var_usuario = $row_table['usuario'];
									 ?>
									<?php do { ?>
										<tr>
											<td></td>
											<td nowrap><?php echo $row_table['almacen']; ?></td>
											<td><?php echo $row_table['usuario']; ?></td>
											<td nowrap><?php echo $row_table['comprobante'] ; ?></td>
											<td nowrap><?php echo $row_table['NombreCliente']; ?></td>
											<td nowrap><?php echo $row_table['fecha']; ?></td>
											<td nowrap><?php echo $row_table['producto']; ?></td>
											<td nowrap><?php echo $row_table['cantidad']; ?></td>
											<td nowrap><?php echo $row_table['precio']; ?></td>
											<td nowrap><?php echo $row_table['SubTotal']; ?></td>
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

