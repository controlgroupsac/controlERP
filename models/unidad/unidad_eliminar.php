<?php
	include "../../config/conexion.php"; 
	include "../../config/basico.php";

	$unidad_id = $_POST['unidad_id'];
	$sql = sprintf("DELETE FROM `controlg_controlerp`.`unidad` WHERE `unidad_id` = %s",
		(int)$unidad_id
	);
	if(!mysql_query($sql))
		echo "Ocurrio un error\n$sql";
	exit;
?>