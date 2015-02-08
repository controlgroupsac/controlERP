<?php
	include "../../config/conexion.php"; 
	include "../../config/basico.php";

	/*verificamos si las variables se envian*/
	if(empty($_GET['cantidad'])) {
	  echo "Usted no a llenado todos los campos";
	  exit;
	}

	/*Almacen Detalle de transferencia */
	$query_transferencia_detalle = sprintf("UPDATE `controlg_controlerp`.`almacen_transferencias_detalle` 
											SET `cantidad` = %s, `faltante` = %s
											WHERE `almacen_transferencias_detalle_id`= %s",
											fn_filtro($_GET['cantidad']),
											fn_filtro($_GET['faltante']),
											fn_filtro($_GET['almacen_transferencias_detalle_id'])
	);	
	mysql_select_db($database_fastERP, $fastERP);
	$transferencia_detalle = mysql_query($query_transferencia_detalle, $fastERP) or die(mysql_error());
?>