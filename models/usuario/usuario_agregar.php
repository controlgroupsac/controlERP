<?php
	include "../../config/conexion.php"; 
	include "../../config/basico.php";

	/*verificamos si las variables se envian*/
	if(empty($_POST['usuario']) || empty($_POST['clave']) || empty($_POST['repetir_clave']) || empty($_POST['nombres']) || empty($_POST['apellidos']) || empty($_POST['email'])) {
	  echo "Usted no a llenado todos los campos";
	  exit;
	}

	if (isset($_POST['activo'])) { $activo = 1; }else{ $activo = 0; }
	
	$sql = sprintf("INSERT INTO `controlg_controlerp`.`usuario` (`usuario`, `clave`, `nivel`, `activo`,`direccion`, `telefono1`, `telefono2`, `email`, `nombres`, `apellidos`, `fecha_nac`, `fecha_registro`, `sexo`) 
	                VALUES ('%s', '%s', '%s', %d, '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s');",
					fn_filtro($_POST['usuario']),
					fn_filtro($_POST['clave']),
					fn_filtro($_POST['nivel']),
					fn_filtro($activo),
					fn_filtro($_POST['direccion']),
					fn_filtro($_POST['telefono1']),
					fn_filtro($_POST['telefono2']),
					fn_filtro($_POST['email']),
					fn_filtro($_POST['nombres']),
					fn_filtro($_POST['apellidos']),
					fn_filtro($_POST['fecha_nac']),
					fn_filtro($_POST['fecha_registro']),
					fn_filtro($_POST['sexo'])

	);

	if(!mysql_query($sql, $fastERP))
		echo "Error al insertar el nuevo usuario:\n$sql";

	exit;
?>