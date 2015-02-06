<?php  
	include "../../config/conexion.php"; 
	$query = "SELECT usuario.usuario, 
					 CONCAT(cliente.nombres, cliente.apellidos) as cliente, ventas.ventas_id, ventas_det.ventas_det_id, producto_ensamblado.producto, ventas_det.cantidad, 
					 producto_ensamblado.precio
			  FROM ventas , ventas_det , producto_ensamblado , cliente , usuario
			  WHERE ventas.ventas_id = ventas_det.ventas_id
			  AND ventas_det.producto_id = producto_ensamblado.producto_ensamblado_id
			  AND ventas.cliente_id = cliente.cliente_id
			  AND usuario.usuario_id = ventas.usuario_id" ;
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
									Existencia de productos en total
								</small>
							</h1>
						</div><!-- /.page-header -->

						<div class="bloque col-xs-4 col-sm-3">
							<table class='table table-condensed'>
								<thead>
									<th></th>
									<th>Usuario</th>
									<th>Cliente</th>
									<th>Producto</th>
									<th>Cantidad</th>
								</thead>
								<tbody>
									<?php do { ?>
										<tr>
											<td></td>
											<td><?php echo $row_table['usuario']; ?></td>
											<td><?php echo $row_table['cliente']; ?></td>
											<td><?php echo $row_table['producto'] ; ?></td>
											<td><?php echo $row_table['cantidad']; ?></td>
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

