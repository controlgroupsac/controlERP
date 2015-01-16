<?php
	include "../../config/conexion.php"; 
	include "../../config/basico.php";

	$compra_det_id = $_POST['compra_det_id'];
	$sql = sprintf("DELETE FROM `controlg_controlerp`.`compra_det` WHERE `compra_det_id` = %s",
		(int)$compra_det_id
	);
	if(!mysql_query($sql))
		echo "Ocurrio un error\n$sql";
	exit;
?>