<?php
	include "../../config/conexion.php"; 
	include "../../config/basico.php";

	/*verificamos si las variables se envian*/
	if(empty($_POST['categoria'])) {
	  echo "Usted no a llenado todos los campos";
	  exit;
	}
	
	$sql = sprintf("INSERT INTO `controlg_controlerp`.`categoria` (`categoria`) 
	                VALUES ('%s');",
					fn_filtro($_POST['categoria'])
	);

	if(!mysql_query($sql, $fastERP))
		echo "Error al insertar el nueva categoria:\n$sql";

	exit;
?>