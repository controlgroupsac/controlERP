<?php
	include "../../config/conexion.php"; 
	include "../../config/basico.php";

	$categoria_id = $_POST['categoria_id'];
	$sql = sprintf("DELETE FROM `controlg_controlerp`.`categoria` WHERE `categoria_id` = %s",
		(int)$categoria_id
	);
	if(!mysql_query($sql))
		echo "Ocurrio un error\n$sql";
	exit;
?>