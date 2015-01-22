<?php
	include "../../config/conexion.php"; 
	include "../../config/basico.php";

	/*verificamos si las variables se envian*/
	if(empty($_POST['nombres'])) {
	  echo "Usted no a llenado todos los campos";
	  exit;
	}
	
	$fecha = date("Y-m-d H:i:s");
	$sql = sprintf("INSERT INTO `controlg_controlerp`.`cliente` (`nombres`, `apellidos`, `dni`, `empresa`, `ruc`, `direccion`, `zona_id`, `fecha_nac`, `fecha`) 
	                VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '$fecha');",
					fn_filtro($_POST['nombres']),
					fn_filtro($_POST['apellidos']),
					fn_filtro($_POST['dni']),
					fn_filtro($_POST['empresa']),
					fn_filtro($_POST['ruc']),
					fn_filtro($_POST['direccion']),
					fn_filtro($_POST['zona_id']),
					fn_filtro($_POST['fecha_nac'])
	);

	if(!mysql_query($sql, $fastERP))
		echo "Error al insertar:\n$sql";

	exit;
?>