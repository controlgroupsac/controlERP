<?php
	include "../../config/conexion.php"; 
	include "../../config/basico.php";

	/*verificamos si las variables se envian*/
	if(empty($_GET['transferencia'])) {
	  echo "Usted no a llenado todos los campos";
	  exit;
	}

	$sql = sprintf("UPDATE `controlg_controlerp`.`almacen_det` SET cantidad='%s'
					WHERE almacendet_id=%d;",
					fn_filtro($_GET['transferencia']),
					fn_filtro((int)$_GET['almacendet_id'])
	);

	if(!mysql_query($sql, $fastERP))
		echo "Error al modificar:\n$sql";

	exit;
?>