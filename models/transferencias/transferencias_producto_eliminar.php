<?php
	include "../../config/conexion.php"; 
	include "../../config/basico.php";

	$transferencia_id = $_GET['transferencia_id'];
	$query_sql = sprintf("DELETE FROM `controlg_controlerp`.`almacen_det` 
						  WHERE almacen_det.transferencia_id = '%s'",
						  (int)$transferencia_id
	);
	mysql_select_db($database_fastERP, $fastERP);
    $sql = mysql_query($query_sql, $fastERP) or die(mysql_error());


    
	$query_sql2 = sprintf("DELETE FROM `controlg_controlerp`.`almacen_transferencias_detalle` 
						   WHERE almacen_transferencias_detalle.almacen_transferencias_id = '%s'",
						   (int)$transferencia_id
	);
	mysql_select_db($database_fastERP, $fastERP);
    $sql2 = mysql_query($query_sql2, $fastERP) or die(mysql_error());
?>