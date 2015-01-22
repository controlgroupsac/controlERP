<?php  
	include "../../config/conexion.php"; 
    include("../../queries/query.php"); 

    $query_almacen = "SELECT almacen.almacen, ventas.almacen_id
			  FROM almacen , ventas
			  WHERE almacen.almacen_id = ventas.almacen_id 
			  AND ventas.ventas_id = $_GET[ventas_id]" ;
    mysql_select_db($database_fastERP, $fastERP);
    $almacen = mysql_query($query_almacen, $fastERP) or die(mysql_error());
    $row_almacen = mysql_fetch_assoc($almacen); 

    $query_comprobante = "SELECT comprobante_tipo.comprobante_tipo, comprobante.ultimo_numero
					  FROM comprobante_tipo , comprobante_det , comprobante
					  WHERE comprobante.comprobante_id = comprobante_det.comprobante_id 
					  AND comprobante.comprobante_tipo_id = comprobante_tipo.comprobante_tipo_id
					  AND comprobante_det.ventas_id = $_GET[ventas_id]" ;
    mysql_select_db($database_fastERP, $fastERP);
    $comprobante = mysql_query($query_comprobante, $fastERP) or die(mysql_error());
    $row_comprobante = mysql_fetch_assoc($comprobante);

    $query_producto = "SELECT ventas_det.cantidad, ventas_det.precio, producto.producto
					   FROM ventas , ventas_det , producto
					   WHERE ventas_det.ventas_id = ventas.ventas_id 
					   AND ventas_det.producto_id = producto.producto_id
					   AND ventas.ventas_id = $_GET[ventas_id]" ;
    mysql_select_db($database_fastERP, $fastERP);
    $producto = mysql_query($query_producto, $fastERP) or die(mysql_error());
    $row_producto = mysql_fetch_assoc($producto); 

    $query_precio = "SELECT ventas_det.cantidad, ventas_det.precio, producto.producto
					   FROM ventas , ventas_det , producto
					   WHERE ventas_det.ventas_id = ventas.ventas_id 
					   AND ventas_det.producto_id = producto.producto_id
					   AND ventas.ventas_id = $_GET[ventas_id]" ;
    mysql_select_db($database_fastERP, $fastERP);
    $precio = mysql_query($query_precio, $fastERP) or die(mysql_error());
    $row_precio = mysql_fetch_assoc($precio); 

    $valor_neto = "";
    do {
		$valor_neto += $row_precio["precio"] * $row_precio["cantidad"];
    } while ($row_precio = mysql_fetch_assoc($precio));

    if(empty($_GET['descuento'])) { $_GET['descuento'] = 0; }
    $impuesto = $valor_neto * 0.18;
    $total = ($valor_neto - $_GET['descuento']) + $impuesto ;
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php query_table_campo("SELECT * FROM empresa", "empresa"); ?></title>
		<link rel="stylesheet" href="../../views/css/bootstrap.min.css" type="text/css" />
</head>
<body>
	<div class="col-xs-12 col-sm-3">
		<table class='table'>
			<caption>
				<h2><?php query_table_campo("SELECT * FROM empresa", "empresa"); ?></h2>
				<h3><?php echo $row_almacen['almacen']; ?></h3>
				<h4>Nro de <?php echo $row_comprobante['comprobante_tipo']. ': ' .$row_comprobante['ultimo_numero']; ?></h4>
			</caption>
			<thead>
				<th colspan='2'>Descripción</th>
				<th align='center'>Precio</th>
				<th align='center'>Cantidad</th>
			</thead>
			<tbody>
				<?php do { ?>
					<tr>
						<td colspan='2'><?php echo $row_producto['producto']; ?></td>
						<td align='right'><?php echo number_format($row_producto['precio'], 2); ?></td>
						<td align='right'><?php echo number_format($row_producto['cantidad'], 2); ?></td>
					</tr>
				<?php } while ($row_producto = mysql_fetch_assoc($producto)); ?>

				<tr>
					<th align='left'>Subtotal</th>
					<td></td>
					<td></td>
					<th align='right'>S/. <?php echo $valor_neto; ?></th>
				</tr>
				</tr>
				<tr>
					<th>IGV</th>
					<td>18%</td>
					<td>S/. <?php echo number_format($valor_neto, 2); ?></td>
					<th>S/. <?php echo number_format($impuesto, 2); ?></th>
				</tr>
				<tr>
					<th>TOTAL</th>
					<td></td>
					<td></td>
					<th>S/. <?php echo number_format($total, 2); ?></th>
				</tr>
				<!-- <tr>
					<th>Cliente</th>
					<td>Mirk</td>
					<td></td>
					<th></th>
				</tr> -->
			</tbody>
		</table>
	</div>


	<div class="col-lg-12"></div>






<?php  
    $query_almacen2 = "SELECT almacen.almacen, ventas.almacen_id
			  FROM almacen , ventas
			  WHERE almacen.almacen_id = ventas.almacen_id 
			  AND ventas.ventas_id = $_GET[ventas_id]" ;
    mysql_select_db($database_fastERP, $fastERP);
    $almacen2 = mysql_query($query_almacen2, $fastERP) or die(mysql_error());
    $row_almacen2 = mysql_fetch_assoc($almacen2); 

    $query_comprobante2 = "SELECT comprobante_tipo.comprobante_tipo, comprobante.ultimo_numero
					  FROM comprobante_tipo , comprobante_det , comprobante
					  WHERE comprobante.comprobante_id = comprobante_det.comprobante_id 
					  AND comprobante.comprobante_tipo_id = comprobante_tipo.comprobante_tipo_id
					  AND comprobante_det.ventas_id = $_GET[ventas_id]" ;
    mysql_select_db($database_fastERP, $fastERP);
    $comprobante2 = mysql_query($query_comprobante2, $fastERP) or die(mysql_error());
    $row_comprobante2 = mysql_fetch_assoc($comprobante2);

    $query_producto2 = "SELECT ventas_det.cantidad, ventas_det.precio, producto.producto
					   FROM ventas , ventas_det , producto
					   WHERE ventas_det.ventas_id = ventas.ventas_id 
					   AND ventas_det.producto_id = producto.producto_id
					   AND ventas.ventas_id = $_GET[ventas_id]" ;
    mysql_select_db($database_fastERP, $fastERP);
    $producto2 = mysql_query($query_producto2, $fastERP) or die(mysql_error());
    $row_producto2 = mysql_fetch_assoc($producto2); 

    $query_precio2 = "SELECT ventas_det.cantidad, ventas_det.precio, producto.producto
					   FROM ventas , ventas_det , producto
					   WHERE ventas_det.ventas_id = ventas.ventas_id 
					   AND ventas_det.producto_id = producto.producto_id
					   AND ventas.ventas_id = $_GET[ventas_id]" ;
    mysql_select_db($database_fastERP, $fastERP);
    $precio2 = mysql_query($query_precio2, $fastERP) or die(mysql_error());
    $row_precio2 = mysql_fetch_assoc($precio2); 

    $valor_neto = "";
    do {
		$valor_neto += $row_precio["precio"] * $row_precio["cantidad"];
    } while ($row_precio = mysql_fetch_assoc($precio));

    if(empty($_GET['descuento'])) { $_GET['descuento'] = 0; }
    $impuesto = $valor_neto * 0.18;
    $total = ($valor_neto - $_GET['descuento']) + $impuesto ;
?>

	<div class="col-xs-12 col-sm-3">
		<table class='table'>
			<caption>
				<h2><?php query_table_campo("SELECT * FROM empresa", "empresa"); ?></h2>
				<h3><?php echo $row_almacen2['almacen']; ?></h3>
				<h4>Nro de <?php echo $row_comprobante2['comprobante_tipo']. ': ' .$row_comprobante2['ultimo_numero']; ?></h4>
			</caption>
			<thead>
				<th colspan='2'>Descripción</th>
				<th align='center'>Precio</th>
				<th align='center'>Cantidad</th>
			</thead>
			<tbody>
				<?php do { ?>
					<tr>
						<td colspan='2'><?php echo $row_producto2['producto']; ?></td>
						<td align='right'><?php echo number_format($row_producto2['precio'], 2); ?></td>
						<td align='right'><?php echo number_format($row_producto2['cantidad'], 2); ?></td>
					</tr>
				<?php } while ($row_producto2 = mysql_fetch_assoc($producto)); ?>

				<tr>
					<th align='left'>Subtotal</th>
					<td></td>
					<td></td>
					<th align='right'>S/. <?php echo $valor_neto; ?></th>
				</tr>
				</tr>
				<tr>
					<th>IGV</th>
					<td>18%</td>
					<td>S/. <?php echo number_format($valor_neto, 2); ?></td>
					<th>S/. <?php echo number_format($impuesto, 2); ?></th>
				</tr>
				<tr>
					<th>TOTAL</th>
					<td></td>
					<td></td>
					<th>S/. <?php echo number_format($total, 2); ?></th>
				</tr>
				<!-- <tr>
					<th>Cliente</th>
					<td>Mirk</td>
					<td></td>
					<th></th>
				</tr> -->
			</tbody>
		</table>
	</div>
</body>
</html>