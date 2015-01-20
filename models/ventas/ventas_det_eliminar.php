<?php
	include "../../config/conexion.php"; 
	include "../../config/basico.php";

	$ventas_det_id = $_POST['ventas_det_id'];
	$sql = sprintf("DELETE FROM `controlg_controlerp`.`ventas_det` WHERE `ventas_det_id` = %s",
		(int)$ventas_det_id
	);
	if(!mysql_query($sql))
		echo "Ocurrio un error\n$sql";
	exit;
?>