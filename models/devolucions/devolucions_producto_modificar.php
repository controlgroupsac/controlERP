<?php
	include "../../config/conexion.php"; 
	include "../../config/basico.php";


	/*Variables de formulario */
	$origen 						   = $_GET['origen'];
	$destino 						   = $_GET['destino'];
	$almacen_transferencias_detalle_id = $_GET['almacen_transferencias_detalle_id'];
	$transferencia_id 				   = $_GET['transferencia_id'];
	$producto_id 					   = $_GET['producto_id'];
	$producto_ensamblado_id 		   = $_GET['producto_ensamblado_id'];
	$factor 						   = $_GET['factor'];
	$tiene 							   = $_GET['lleva'];
	$devuelve 						   = $_GET['devuelve'];
	$diferencia 							   = $_GET['total'];

	/*Desconposicion de input de la forma (cajas/botellas) a sus respectivas unidades*/
	if($factor > 1) {
		$posicion = strrpos($tiene, "/");
		$cajas 	  = substr($tiene, 0, $posicion) * $factor;
		$botellas = substr($tiene, $posicion + 1);
		$tiene = $cajas + $botellas;

		$posicion1 = strrpos($devuelve, "/");
		$caja1 	  = substr($devuelve, 0, $posicion1) * $factor;
		$botella1 = substr($devuelve, $posicion1 + 1);
		$devuelve = $caja1 + $botella1;

		$posicion2  = strrpos($diferencia, "/");
		$cajas2 	= substr($diferencia, 0, $posicion2) * $factor;
		$botellas2  = substr($diferencia, $posicion2 + 1);
		$diferencia = $cajas2 + $botellas2;
	} 


	/**/
	/**/
	/*Almacen Detalle de transferencia */
	$cantidad = $tiene + $devuelve;
	$query_transferencia_detalle = sprintf("UPDATE `controlg_controlerp`.`almacen_transferencias_detalle` 
											SET `cantidad` = %s, `faltante` = %s
											WHERE `almacen_transferencias_detalle_id`= %s",
											fn_filtro($cantidad),
											fn_filtro($diferencia),
											fn_filtro($almacen_transferencias_detalle_id)
	);	
	mysql_select_db($database_fastERP, $fastERP);
	$transferencia_detalle = mysql_query($query_transferencia_detalle, $fastERP) or die(mysql_error());
	/**/
	/**/
	

	
	/**/
	/**/
	/*ORIGEN */
	$cantidad = $tiene + $devuelve;
	$sql = sprintf("UPDATE `controlg_controlerp`.`almacen_det` SET cantidad='%s'
                    WHERE almacen_id    = %d
                    AND   transferencia_id = %d
                    AND   producto_id 	   = %d;", 
                    fn_filtro($cantidad),
                    fn_filtro((int)$origen),
                    fn_filtro((int)$transferencia_id),
                    fn_filtro((int)$producto_id)
	);
	mysql_select_db($database_fastERP, $fastERP);
	$table = mysql_query($sql, $fastERP) or die(mysql_error());
	/**/
	/**/



	/**/
	/**/
	/*DESTINO */
	$cantidad = $tiene + $devuelve;
	$sql = sprintf("UPDATE `controlg_controlerp`.`almacen_det` SET cantidad='%s'
                    WHERE almacen_id    = %d
                    AND   transferencia_id = %d
                    AND   producto_id 	   = %d;", 
                    fn_filtro(-1 * $cantidad),
                    fn_filtro((int)$destino),
                    fn_filtro((int)$transferencia_id),
                    fn_filtro((int)$producto_id)
	);
	mysql_select_db($database_fastERP, $fastERP);
	$table = mysql_query($sql, $fastERP) or die(mysql_error());
	/**/
	/**/



	/**/
	/**/
	/*CTACORRIENTE_VENDEDOR ENVASES*/
	$cantidad = $tiene + $devuelve;
	$sql = sprintf("UPDATE `controlg_controlerp`.`ctacorriente_vendedor_env` SET cantidad='%s'
                    WHERE producto_id = %d;", 
                    fn_filtro(-1 * $cantidad),
                    fn_filtro((int)$producto_id)
	);
	mysql_select_db($database_fastERP, $fastERP);
	$table = mysql_query($sql, $fastERP) or die(mysql_error());
	/**/
	/**/
?>