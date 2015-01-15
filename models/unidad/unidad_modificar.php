<?php
	include "../../config/conexion.php"; 
	include "../../config/basico.php";

	/*verificamos si las variables se envian*/
	if(empty($_POST['unidad']) || empty($_POST['abrev'])) {
	  echo "Usted no a llenado todos los campos";
	  exit;
	}

	$sql = sprintf("UPDATE `controlg_controlerp`.`unidad` SET unidad='%s', abrev='%s'
					WHERE unidad_id=%d;",
					fn_filtro($_POST['unidad']),
					fn_filtro($_POST['abrev']),
					fn_filtro((int)$_POST['unidad_id'])
	);

	if(!mysql_query($sql, $fastERP))
		echo "Error al modificar el detalle de compra:\n$sql";

	exit;
?>