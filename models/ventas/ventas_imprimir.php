<?php  
	include "../../config/conexion.php"; 
    include("../../queries/query.php"); 

    $query_almacen = "SELECT almacen.almacen, ventas.almacen_id,
					  CONCAT(cliente.nombres, ' ',cliente.apellidos) AS cliente, cliente.dni
					  FROM almacen , ventas, cliente
					  WHERE almacen.almacen_id = ventas.almacen_id 
					  AND ventas.cliente_id = cliente.cliente_id
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

    $query_producto = "SELECT ventas_det.cantidad, ventas_det.precio, producto_ensamblado.producto
					   FROM ventas , ventas_det , producto_ensamblado
					   WHERE ventas_det.ventas_id = ventas.ventas_id 
					   AND ventas_det.producto_id = producto_ensamblado.producto_ensamblado_id
					   AND ventas.ventas_id = $_GET[ventas_id]" ;
    mysql_select_db($database_fastERP, $fastERP);
    $producto = mysql_query($query_producto, $fastERP) or die(mysql_error());
    $row_producto = mysql_fetch_assoc($producto); 

    $query_precio = "SELECT ventas_det.cantidad, ventas_det.precio, producto_ensamblado.producto
				     FROM ventas , ventas_det , producto_ensamblado
				     WHERE ventas_det.ventas_id = ventas.ventas_id 
				     AND ventas_det.producto_id = producto_ensamblado.producto_ensamblado_id
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
    $descuento = $valor_neto - $_GET['descuento'];
    $total = $descuento + $impuesto ;
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php query_table_campo("SELECT * FROM empresa", "empresa"); ?></title>
	<link rel="stylesheet" href="../../views/css/bootstrap.min.css" type="text/css" />
	<link rel="stylesheet" href="imprimir.css">	
</head>
<body>
	<div class="bloque col-xs-4 col-sm-3">
		<table class='table table-condensed'>
			<caption>
				<h4><?php query_table_campo("SELECT * FROM empresa", "empresa"); ?></h4>
				<h5><?php echo $row_almacen['almacen']; ?></h5>
				<h6>Nro de <?php echo $row_comprobante['comprobante_tipo']. ': ' .$row_comprobante['ultimo_numero']; ?></h6>
				<h6><?php echo $row_almacen['cliente']."  - <strong>DNI</strong>: ".$row_almacen['dni']; ?></h6>
			</caption>
			<thead>
				<th colspan='2'>Descripción</th>
				<th align='center'>Precio S/.</th>
				<th align='center'>Cantidad</th>
			</thead>
			<tbody>
				<?php do { ?>
					<tr>
						<td colspan='2'><?php echo $row_producto['producto']; ?></td>
						<td><?php echo number_format($row_producto['precio'], 2); ?></td>
						<td><?php echo $row_producto['cantidad']; ?></td>
					</tr>
				<?php } while ($row_producto = mysql_fetch_assoc($producto)); ?>

				<tr>
					<th align='left'>Subtotal</th>
					<td></td>
					<td></td>
					<th align='right'>S/. <?php echo $valor_neto; ?></th>
				</tr>

				<tr>
					<th align='left'>Descuento</th>
					<td></td>
					<td></td>
					<th align='right'>S/. <?php echo $_GET['descuento']; ?></th>
				</tr>

				<tr>
					<th>IGV (18%)</th>
					<td></td>
					<td></td>
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





<?php  
    $query_almacen2 = "SELECT almacen.almacen, ventas.almacen_id,
					  CONCAT(cliente.nombres, ' ',cliente.apellidos) AS cliente, cliente.dni
					  FROM almacen , ventas, cliente
					  WHERE almacen.almacen_id = ventas.almacen_id 
					  AND ventas.cliente_id = cliente.cliente_id
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

	$query_producto2 = "SELECT producto.producto, ventas_env.lleva, ventas_env.devuelve, ventas_env.producto_id, producto.precio
						FROM ventas , ventas_env , producto
						WHERE ventas.ventas_id = $_GET[ventas_id] AND
						ventas_env.ventas_id = ventas.ventas_id AND
						ventas_env.producto_id = producto.producto_id ";
    mysql_select_db($database_fastERP, $fastERP);
    $producto2 = mysql_query($query_producto2, $fastERP) or die(mysql_error());
    $row_producto2 = mysql_fetch_assoc($producto2); 

    $query_precio2 = "SELECT ventas.ventas_id, producto_ensamblado.producto, producto.producto, ventas_det.cantidad, producto.precio
					  FROM ventas , ventas_det , producto_ensamblado , producto_ensamblado_det , producto
					  WHERE ventas.ventas_id = $_GET[ventas_id]
					  AND ventas.ventas_id = ventas_det.ventas_id
					  AND ventas_det.producto_id = producto_ensamblado.producto_ensamblado_id
					  AND producto_ensamblado.producto_ensamblado_id = producto_ensamblado_det.producto_ensamblado_id
					  AND producto_ensamblado_det.producto_id = producto.producto_id
					  AND producto.categoria_id = 4
					  GROUP BY producto.producto_id" ;
    mysql_select_db($database_fastERP, $fastERP);
    $precio2 = mysql_query($query_precio2, $fastERP) or die(mysql_error());
    $row_precio2 = mysql_fetch_assoc($precio2); 

    $valor_neto2 = "";
    do {
		$valor_neto2 += $row_precio2["precio"] * $row_precio2["cantidad"];
    } while ($row_precio2 = mysql_fetch_assoc($precio2));

    if(empty($_GET['descuento'])) { $_GET['descuento'] = 0; }
    $total2 = ($valor_neto2 - $_GET['descuento']) ;
?>
	<div class="col-xs-12"></div>

	<div class="bloque col-xs-4 col-sm-3">
		<table class='table table-condensed'>
			<caption>
				<h4><?php query_table_campo("SELECT * FROM empresa", "empresa"); ?></h4>
				<h5><?php echo $row_almacen2['almacen']; ?></h5>
				<h6>Nro de Recibo: <?php echo $row_comprobante2['ultimo_numero']; ?></h6>
				<h6><?php echo $row_almacen['cliente']."  - <strong>DNI</strong>: ".$row_almacen['dni']; ?></h6>
			</caption>
			<thead>
				<th>Descripción</th>
				<th nowrap>Precio S/.</th>
				<th>Cantidad</th>
			</thead>
			<tbody>
				<?php do { ?>
					<tr>
						<td><?php echo $row_producto2['producto']; ?></td>
						<td><?php echo number_format($row_producto2['precio'], 2); ?></td>
						<td><?php echo $row_producto2['devuelve'] - $row_producto2['lleva']; ?></td>
					</tr>
				<?php } while ($row_producto2 = mysql_fetch_assoc($producto2)); ?>

				<tr>
					<th>TOTAL</th>
					<td></td>
					<th nowrap>S/. <?php echo number_format($total2, 2); ?></th>
				</tr>
				<tr>
					<td>Recibo de botellas y CPB</td>
				</tr>
			</tbody>
		</table>
	</div>
</body>
</html>