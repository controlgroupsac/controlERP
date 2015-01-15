<?php
	include "../../config/conexion.php"; 
	include "../../config/basico.php";

	/*verificamos si las variables se envian*/
	if(empty($_POST['unidad']) || empty($_POST['abrev'])) {
	  echo "Usted no a llenado todos los campos";
	  exit;
	}
	
	$sql = sprintf("INSERT INTO `controlg_controlerp`.`unidad` (`unidad`, `abrev`) 
	                VALUES ('%s', '%s');",
					fn_filtro($_POST['unidad']),
					fn_filtro($_POST['abrev'])
	);

	if(!mysql_query($sql, $fastERP))
		echo "Error al insertar el nueva unidad:\n$sql";

	exit;
?>