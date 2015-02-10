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

    header("Location: ../../views/index.php");

?>