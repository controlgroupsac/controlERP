<?php  
	include "../../config/conexion.php"; 
    include("../../queries/query.php"); 

    $query_almacen = "SELECT almacen.almacen, ventas.almacen_id, ventas.pago, 
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
	<link rel="stylesheet" href="../../views/css/main.css" type="text/css" />
	<style type="text/css"> td {background: #fff !important; } </style>
</head>
<body>
	<div class="bloque col-xs-4 col-sm-3">
		<table class='table table-condensed'>
			<caption>
				<h4>
					<?php query_table_campo("SELECT * FROM empresa", "empresa"); ?><br>
					<span class="text-xsm"><strong>RUC: </strong><?php query_table_campo("SELECT * FROM empresa", "ruc"); ?></span class="text-sm">
				</h4>
				<h5>
					<?php echo $row_almacen['almacen']; ?> 
					<span class="text-xsm right">
						<strong>
						<?php 
							if ($row_almacen['pago'] == "E") {
								echo "Efectivo";
							} elseif ($row_almacen['pago'] == "C") {
								echo "Credito";
							} elseif ($row_almacen['pago'] == "T") {
								echo "Tarjeto";
							} 
						?>
						</strong>
					</span>
				</h5>
				<h6><?php echo $row_comprobante['comprobante_tipo']. ' Nro: ' .$row_comprobante['ultimo_numero']; ?></h6>
				<h6><?php echo $row_almacen['cliente']."  - <strong>DNI</strong>: ".$row_almacen['dni']; ?></h6>
			</caption>
			<thead>
				<th nowrap colspan='2'>Descripción</th>
				<th nowrap align='center'>Precio S/.</th>
				<th nowrap align='center'>Cantidad</th>
				<th nowrap align='center'>Sub Total</th>
			</thead>
			<tbody>
				<?php do { ?>
					<tr>
						<td nowrap colspan='2'><?php echo $row_producto['producto']; ?></td>
						<td nowrap><?php echo number_format($row_producto['precio'], 2); ?></td>
						<td nowrap class="text-center"><?php echo $row_producto['cantidad']; ?></td>
						<td nowrap class="text-right"><?php echo $row_producto['cantidad'] * $row_producto['precio']; ?></td>
					</tr>
				<?php } while ($row_producto = mysql_fetch_assoc($producto)); ?>

				<tr>
					<th align='left'>Subtotal S/.</th>
					<th></th>
					<th></th>
					<th></th>
					<th  class="text-right"> <?php echo $valor_neto; ?></th>
				</tr>

				<tr>
					<th align='left'>Descuento S/.</th>
					<th></th>
					<th></th>
					<th></th>
					<th  class="text-right"><?php echo number_format($_GET['descuento'], 2); ?></th>
				</tr>

				<tr>
					<th>IGV S/. (18%)</th>
					<th></th>
					<th></th>
					<th></th>
					<th class="text-right"><?php echo number_format($impuesto, 2); ?></th>
				</tr>

				<tr>
					<th>TOTAL S/.</th>
					<th></th>
					<th></th>
					<th></th>
					<th class="text-right"><?php echo number_format($total, 2); ?></th>
				</tr>
			</tbody>
		</table>
	</div>





<?php  
    $query_almacen2 = "SELECT almacen.almacen, ventas.almacen_id, ventas.pago, 
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
    $totalnum_producto2 = mysql_num_rows($producto2); 
    $row_producto2 = mysql_fetch_assoc($producto2); 

    $query_precio2 = "SELECT ventas_det.cantidad, ventas_det.precio, producto_ensamblado.producto
				     FROM ventas , ventas_det , producto_ensamblado
				     WHERE ventas_det.ventas_id = ventas.ventas_id 
				     AND ventas_det.producto_id = producto_ensamblado.producto_ensamblado_id
				     AND ventas.ventas_id = $_GET[ventas_id]" ;
    mysql_select_db($database_fastERP, $fastERP);
    $precio2 = mysql_query($query_precio2, $fastERP) or die(mysql_error());
    $row_precio2 = mysql_fetch_assoc($precio2); 
?>
	<div class="col-xs-12"></div>

	<div class="bloque col-xs-4 col-sm-3" id="envases_credito">
		<table class='table table-condensed'>
			<caption>
				<h4>
					<?php query_table_campo("SELECT * FROM empresa", "empresa"); ?><br>
					<span class="text-xsm"><strong>RUC: </strong><?php query_table_campo("SELECT * FROM empresa", "ruc"); ?></span class="text-sm">
				</h4>
				<h5>
					<?php echo $row_almacen2['almacen']; ?> 
					<span class="text-xsm right">
						<strong>
						<?php 
							if ($totalnum_producto2 != 0) {
								echo "Credito";
							} 
						?>
						</strong>
					</span>
				</h5>
				<h6>Ticket de pago: <?php echo $row_comprobante2['ultimo_numero']; ?></h6>
				<h6><?php echo $row_almacen['cliente']."  - <strong>DNI</strong>: ".$row_almacen['dni']; ?></h6>
			</caption>
			<thead>
				<th>Descripción</th>
				<th nowrap>Precio S/.</th>
				<th>Cantidad</th>
				<th nowrap>Sub Total</th>
			</thead>
			<tbody>
				<?php $valor_neto2 = 0; ?>
				<?php do { ?>
					<tr>
						<td nowrap><?php echo $row_producto2['producto']; ?></td>
						<td><?php echo number_format($row_producto2['precio'], 2); ?></td>
						<td class="text-center">
							<?php echo $row_producto2['devuelve'] - $row_producto2['lleva'];  /*Cantidad de productos*/
							    $valor_neto2 += $row_producto2["precio"] * ($row_producto2['devuelve'] - $row_producto2['lleva']); /*Acumulador de montos de deudas*/
							    if(empty($_GET['descuento'])) { $_GET['descuento'] = 0; }
							    $total2 = -1 * ($valor_neto2 - $_GET['descuento']); /*Total del monto de deudas, respecto a las botellas */
							?>
						</td>
						<td class="text-right"><?php echo number_format(($row_producto2['devuelve'] - $row_producto2['lleva']) * $row_producto2['precio'], 2); ?></td>
					</tr>
				<?php } while ($row_producto2 = mysql_fetch_assoc($producto2)); ?>

				<tr>
					<th>TOTAL (S/.)</th>
					<th></th>
					<th></th>
					<th nowrap class="text-right"><?php echo number_format($total2, 2); ?></th>
					<input type="hidden" id="total2" value="<?php echo $total2; ?>">
				</tr>
				<tr>
					<td colspan="4" class="text-xsm">Ticket de pago de botellas y Cajas</td>
				</tr>
			</tbody>
		</table>
	</div>


	<!-- basic scripts -->
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<!--[if !IE]> -->
	<script type="text/javascript">
		window.jQuery || document.write("<script src='../../views/js/vendor/jquery.min.js'>"+"<"+"/script>");
	</script>

	<script type="text/javascript">
		var total2 = document.getElementById('total2').value;
		if(total2 == 0){
			$("#envases_credito").addClass('none');
		}
	</script>
</body>
</html>
