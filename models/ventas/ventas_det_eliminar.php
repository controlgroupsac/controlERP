<?php
	include "../../config/conexion.php"; 
	include "../../config/basico.php";

	$ventas_det_id = $_POST['ventas_det_id'];
	$sql = sprintf("DELETE FROM `controlg_controlerp`.`ventas_det` WHERE `ventas_det_id` = %s",
		   (int)$ventas_det_id
	);
	if(!mysql_query($sql))
		echo "Ocurrio un error\n$sql";

	$envases = "SELECT producto.producto_id, producto.producto, producto_ensamblado.producto as ensamblado
			  FROM producto , producto_ensamblado_det , producto_ensamblado
			  WHERE producto_ensamblado_det.producto_id = producto.producto_id 
			  AND producto_ensamblado_det.producto_ensamblado_id = producto_ensamblado.producto_ensamblado_id
			  AND producto_ensamblado_det.producto_ensamblado_id = $_POST[producto_ensamblado_id]
			  AND producto.categoria_id = 4";
	mysql_select_db($database_fastERP, $fastERP);
    $envases = mysql_query($envases, $fastERP) or die(mysql_error());
    $totalRows_envases = mysql_num_rows($envases);
    $row_envases = mysql_fetch_assoc($envases); 

    do {
    	$query = "DELETE FROM `controlg_controlerp`.`ventas_env` 
				  WHERE `ventas_id`   = $_POST[ventas_id] 
				  AND   `producto_id` = $row_envases[producto_id]";
    	$delete_envases = mysql_query($query, $fastERP) or die(mysql_error());
    } while ($row_envases = mysql_fetch_assoc($envases));
?>