<?php
	include "../../config/conexion.php"; 
	include "../../config/basico.php";

	/*verificamos si las variables se envian*/
	if(empty($_POST['proveedor_id']) || empty($_POST['almacen_id'])) {
	  echo "Usted no a llenado todos los campos";
	  exit;
	}
	
	$sql = sprintf("UPDATE `controlg_controlerp`.`compra` SET almacen_id='%s', proveedor_id='%s', estado='%s', comprobtipo_id='%s', serie='%s', numero='%s', fecha_doc='%s', impuesto1='%s', valor_neto='%s', descuento='%s', total='%s'
					WHERE compra_id=%d;",
					fn_filtro($_POST['almacen_id']),
					fn_filtro($_POST['estado']),
					fn_filtro($_POST['proveedor_id']),
					fn_filtro($_POST['comprobtipo_id']),
					fn_filtro($_POST['serie']),
					fn_filtro($_POST['numero']),
					fn_filtro($_POST['fecha_doc']),
					fn_filtro($_POST['impuesto1']),
					fn_filtro($_POST['valor_neto']),
					fn_filtro($_POST['descuento']),
					fn_filtro($_POST['total']),
					fn_filtro((int)$_POST['compra_id'])
	);

	if(!mysql_query($sql, $fastERP))
		echo "Error al insertar:\n$sql";

	exit;
?>