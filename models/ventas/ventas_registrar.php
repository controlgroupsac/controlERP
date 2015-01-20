<?php
	include "../../config/conexion.php"; 
	include "../../config/basico.php";

	/*verificamos si las variables se envian*/
	if(empty($_POST['almacen_id'])) {
	  echo "Usted no a llenado todos los campos";
	  exit;
	}

	$fecha = date("Y/m/d H:i:s");
	$fechapago = date("Y/m/d");

	$sql = sprintf("UPDATE `controlg_controlerp`.`ventas` 
					SET almacen_id='%s', fecha='%s', estado='%s', impuesto1='%s', fechapago='%s', valor_neto='%s', total='%s'
					WHERE ventas_id=%d;",
					fn_filtro($_POST['almacen_id']),
					fn_filtro($fecha),
					fn_filtro(2),
					fn_filtro($_POST['impuesto1']),
					fn_filtro($fechapago),
					fn_filtro($_POST['valor_neto']),
					fn_filtro($_POST['total']),
					fn_filtro((int)$_POST['ventas_id'])
	);

	if(!mysql_query($sql, $fastERP))
		echo "Error al insertar:\n$sql";
?>