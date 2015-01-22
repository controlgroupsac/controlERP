<?php
	include "../../config/conexion.php"; 
	include "../../config/basico.php";

	$producto_ensamblado_id = $_POST['producto_ensamblado_id'];
	$sql = sprintf("DELETE FROM `controlg_controlerp`.`producto_ensamblado` WHERE `producto_ensamblado_id` = %s",
		(int)$producto_ensamblado_id
	);
	if(!mysql_query($sql))
		echo "Ocurrio un error\n$sql";
	exit;
?>