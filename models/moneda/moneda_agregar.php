<?php
	include "../../config/conexion.php"; 
	include "../../config/basico.php";

	/*verificamos si las variables se envian*/
	if(empty($_POST['moneda']) || empty($_POST['abrev']) || empty($_POST['prefijo'])) {
	  echo "Usted no a llenado todos los campos";
	  exit;
	}
	
	$sql = sprintf("INSERT INTO `controlg_controlerp`.`moneda` (`moneda`, `abrev`, `prefijo`) 
	                VALUES ('%s', '%s', '%s');",
					fn_filtro($_POST['moneda']),
					fn_filtro($_POST['abrev']),
					fn_filtro($_POST['prefijo'])
	);

	if(!mysql_query($sql, $fastERP))
		echo "Error al insertar el nueva moneda:\n$sql";

	exit;
?>