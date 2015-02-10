<?php  
	include "../../config/conexion.php"; 
	$query = "SELECT ventas.ventas_id, almacen.almacen, 
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
			  AND ventas.almacen_id = 2" ;
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
									Credito de clientes por vendedor
								</small>
							</h1>
						</div><!-- /.page-header -->

						<div class="bloque col-xs-4 col-sm-3">
							<table class='table table-condensed'>
								<caption><span class="label label-lg arrowed-right" id="registrar-span"><?php echo $row_table['almacen']; ?> </span></caption>
								<thead>
									<th></th>
									<th>Fecha</th>
									<th>Nombre Cliente</th>
									<th>CTA</th>
								</thead>
								<tbody>
									<tr>
										<td rowspan="3">aaaaaaa</td>
									</tr>
									<?php do { ?>
										<tr>
											<td></td>
											<td nowrap><?php echo $row_table['fecha']; ?></td>
											<td><?php echo $row_table['nombre_cliente']; ?></td>
											<td nowrap><?php echo $row_table['cta']; ?></td>
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

