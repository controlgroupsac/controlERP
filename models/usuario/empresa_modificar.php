<?php
	include "../../config/conexion.php"; 
	include "../../config/basico.php";

	/*verificamos si las variables se envian*/
	if(empty($_POST['empresa']) || empty($_POST['propiedtario']) || empty($_POST['ruc']) || empty($_POST['direccion']) || empty($_POST['ciudad']) || empty($_POST['pais'])) {
	  echo "Usted no a llenado todos los campos";
	  exit;
	}


	$sql = sprintf("UPDATE `controlg_controlerp`.`empresa` SET empresa='%s', propiedtario='%s', ruc='%s', direccion='%s', ciudad='%s', pais='%s'
					WHERE empresa_id=%d;",
		fn_filtro($_POST['empresa']),
		fn_filtro($_POST['propiedtario']),
		fn_filtro($_POST['ruc']),
		fn_filtro($_POST['direccion']),
		fn_filtro($_POST['ciudad']),
		fn_filtro($_POST['pais']),
		fn_filtro((int)$_POST['empresa_id'])
	);

	if(!mysql_query($sql, $fastERP))
		echo "Error al modificar el detalle de compra:\n$sql";

	exit;
?>