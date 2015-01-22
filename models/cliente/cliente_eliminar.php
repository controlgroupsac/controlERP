<?php
	include "../../config/conexion.php"; 
	include "../../config/basico.php";

	$cliente_id = $_POST['cliente_id'];
	$sql = sprintf("DELETE FROM `controlg_controlerp`.`cliente` WHERE `cliente_id` = %s",
		(int)$cliente_id
	);
	if(!mysql_query($sql))
		echo "Ocurrio un error\n$sql";
	exit;
?>