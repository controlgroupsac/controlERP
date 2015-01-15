<?php
	include "../../config/conexion.php"; 
	include "../../config/basico.php";

	$moneda_id = $_POST['moneda_id'];
	$sql = sprintf("DELETE FROM `controlg_controlerp`.`moneda` WHERE `moneda_id` = %s",
		(int)$moneda_id
	);
	if(!mysql_query($sql))
		echo "Ocurrio un error\n$sql";
	exit;
?>