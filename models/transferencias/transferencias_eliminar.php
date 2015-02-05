<?php
	include "../../config/conexion.php"; 
	include "../../config/basico.php";

	$transferencias_id = $_POST['transferencias_id'];
	$sql = sprintf("DELETE FROM `controlg_controlerp`.`almacen_transferencia` WHERE `transferencia_id` = %s",
		(int)$transferencias_id
	);
	if(!mysql_query($sql))
		echo "Ocurrio un error\n$sql";
	exit;
?>