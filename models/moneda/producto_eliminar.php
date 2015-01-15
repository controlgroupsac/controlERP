<?php
	include "../../config/conexion.php"; 
	include "../../config/basico.php";

	$producto_id = $_POST['producto_id'];
	$sql = sprintf("DELETE FROM `controlg_controlerp`.`producto` WHERE `producto_id` = %s",
		(int)$producto_id
	);
	if(!mysql_query($sql))
		echo "Ocurrio un error\n$sql";
	exit;
?>