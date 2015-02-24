<?php  
	include "../../config/conexion.php"; 

    mysql_select_db($database_fastERP, $fastERP);
	$almacen_det = "TRUNCATE TABLE `almacen_det`";
    $ventas = mysql_query($almacen_det, $fastERP) or die(mysql_error());

	$almacen_transferencia = "TRUNCATE TABLE `almacen_transferencia`";
    $ventas = mysql_query($almacen_transferencia, $fastERP) or die(mysql_error());

	$almacen_transferencias_detalle = "TRUNCATE TABLE `almacen_transferencias_detalle`";
    $ventas = mysql_query($almacen_transferencias_detalle, $fastERP) or die(mysql_error());



	$compra = "TRUNCATE TABLE `compra`";
    $ventas = mysql_query($compra, $fastERP) or die(mysql_error());

	$compra_det = "TRUNCATE TABLE `compra_det`";
    $ventas = mysql_query($compra_det, $fastERP) or die(mysql_error());



	$comprobante_det = "TRUNCATE TABLE `comprobante_det`";
    $ventas = mysql_query($comprobante_det, $fastERP) or die(mysql_error());

	

	$ctacorriente_cliente = "TRUNCATE TABLE `ctacorriente_cliente`";
    $ventas = mysql_query($ctacorriente_cliente, $fastERP) or die(mysql_error());

	$ctacorriente_cliente_env = "TRUNCATE TABLE `ctacorriente_cliente_env`";
    $ventas = mysql_query($ctacorriente_cliente_env, $fastERP) or die(mysql_error());

	

	$ctacorriente_vendedor = "TRUNCATE TABLE `ctacorriente_vendedor`";
    $ventas = mysql_query($ctacorriente_vendedor, $fastERP) or die(mysql_error());

	$ctacorriente_vendedor_env = "TRUNCATE TABLE `ctacorriente_vendedor_env`";
    $ventas = mysql_query($ctacorriente_vendedor_env, $fastERP) or die(mysql_error());



	$ventas = "TRUNCATE TABLE `ventas`";
    $ventas = mysql_query($ventas, $fastERP) or die(mysql_error());

	$ventas_det = "TRUNCATE TABLE `ventas_det`";
    $ventas = mysql_query($ventas_det, $fastERP) or die(mysql_error());

	$ventas_env = "TRUNCATE TABLE `ventas_env`";
    $ventas = mysql_query($ventas_env, $fastERP) or die(mysql_error());



    /*INSERCION DE COMPRAS*/
    $almacen_det_insert = "INSERT INTO `almacen_det` (`almacendet_id`, `almacen_id`, `transferencia_id`, `compra_id`, `ventas_id`, `producto_id`, `producto_ensamblado_id`, `cantidad`, `activo`) 
    		   VALUES (1, 1, 0, 1, 0, 1, 85, 2400, 1),
			   (2, 1, 0, 1, 0, 40, 85, 2400, 1),
			   (3, 1, 0, 1, 0, 43, 85, 200, 1),
			   (4, 1, 0, 1, 0, 3, 87, 4800, 1),
			   (5, 1, 0, 1, 0, 42, 87, 4800, 1),
			   (6, 1, 0, 1, 0, 45, 87, 200, 1),
			   (7, 1, 0, 1, 0, 8, 92, 2400, 1),
			   (8, 1, 0, 1, 0, 41, 92, 2400, 1),
			   (9, 1, 0, 1, 0, 44, 92, 200, 1);";
    $almacen_det_insert = mysql_query($almacen_det_insert, $fastERP) or die(mysql_error());

	$compra_insert = "INSERT INTO `compra` (`compra_id`, `usuario_id`, `almacen_id`, `estado`, `proveedor_id`, `comprobtipo_id`, `serie`, `numero`, `guiaremision`, `fecha`, `fecha_doc`, `condic_pago`, `impuesto1`, `impuesto2`, `impuesto3`, `impuesto4`, `valor_neto`, `descuento`, `total`) 
			   VALUES
			   (1, 1, 1, '2', 1, 0, '001', '23581799', '001-158548', '2015-02-24 06:11:28', '2015-02-24', '1', 2466, 0, 0, 0, 13700, 0, 16166);";
    $compra_insert = mysql_query($compra_insert, $fastERP) or die(mysql_error());

	$compra_det_insert = "INSERT INTO `compra_det` (`compra_det_id`, `compra_id`, `producto_id`, `cantidad`, `monto`) 
			   VALUES
			   (1, 1, 85, 200, 60),
			   (2, 1, 92, 200, 5),
			   (3, 1, 87, 200, 3.5);";
    $compra_det_insert = mysql_query($compra_det_insert, $fastERP) or die(mysql_error());


    header("Location: ../../views/index.php");
?>