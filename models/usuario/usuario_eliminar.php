<?php
	include "../../config/conexion.php"; 
	include "../../config/basico.php";

	$usuario_id = $_POST['usuario_id'];
	$sql = sprintf("DELETE FROM `controlg_controlerp`.`usuario` WHERE `usuario_id` = %s",
		(int)$usuario_id
	);
	if(!mysql_query($sql))
		echo "Ocurrio un error\n$sql";
	exit;
?>