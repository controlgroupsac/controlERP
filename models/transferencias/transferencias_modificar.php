<?php
	include "../../config/conexion.php"; 
	include "../../config/basico.php";

	/*verificamos si las variables se envian*/
	if(empty($_POST['origen']) || empty($_POST['destino'])) {
	  echo "Usted no a llenado todos los campos";
	  exit;
	}

	$sql = sprintf("UPDATE `controlg_controlerp`.`almacen_transferencia` SET almacen_origen_id='%s', almacen_destino_id='%s'
					WHERE transferencia_id=%d;",
					fn_filtro($_POST['origen']),
					fn_filtro($_POST['destino']),
					fn_filtro((int)$_POST['transferencia_id'])
	);

	if(!mysql_query($sql, $fastERP))
		echo "Error al modificar:\n$sql";

	exit;
?>