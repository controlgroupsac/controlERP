<?php
	include "../../config/conexion.php"; 
	include "../../config/basico.php";

	$almacendet_id = $_POST['almacendet_id'];
	$sql = sprintf("DELETE FROM `controlg_controlerp`.`almacen_det` WHERE `almacendet_id` = %s",
		(int)$almacendet_id
	);
	if(!mysql_query($sql))
		echo "Ocurrio un error\n$sql";
	exit;
?>