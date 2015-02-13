<?php
	include "../../config/conexion.php"; 
	include "../../config/basico.php";

	/*verificamos si las variables se envian*/
	$query = "SELECT * FROM ventas_det
              WHERE ventas_det.producto_id = $_POST[producto_id]
              AND ventas_det.ventas_id = $_POST[ventas_id]";
    mysql_select_db($database_fastERP, $fastERP);
    $table = mysql_query($query, $fastERP) or die(mysql_error());
    $totalRows_table = mysql_num_rows($table);
    $row_table = mysql_fetch_assoc($table);

    /*Borrando los envases registrados previamente,  y asi evitar doble registro*/
    $query_delete = sprintf("DELETE FROM `controlg_controlerp`.`ventas_env`
    				   WHERE ventas_env.ventas_id=%d;",
    				   fn_filtro((int)$_POST['ventas_id'])
    );
    $delete = mysql_query($query_delete, $fastERP) or die(mysql_error());


    if ($totalRows_table > 0) { /*verificamos si ya existe el producto y si es asi, agregamos uno a la cantidad*/
    	$cantidad = $row_table['cantidad'] + 1;
    	$sql2 = sprintf("UPDATE `controlg_controlerp`.`ventas_det` SET cantidad='%s'
    	                 WHERE ventas_det_id=%d;",
    	                 fn_filtro($cantidad),
    	                 fn_filtro((int)$row_table['ventas_det_id'])
    	);
		if(!mysql_query($sql2, $fastERP))
			echo "Error al insertar el nuevo detalle de ventas:\n$sql2";
    }else {/*Si no hay un  producto se agrega uno al detalle de las ventas*/
		$sql = sprintf("INSERT INTO `controlg_controlerp`.`ventas_det` (`ventas_id`, `producto_id`, `cantidad`, `precio`) 
		                VALUES ('%s', '%s', '%s', '%s');",
						fn_filtro($_POST['ventas_id']),
						fn_filtro($_POST['producto_id']),
						fn_filtro(1),
						fn_filtro($_POST['precio'])
		);
		if(!mysql_query($sql, $fastERP))
			echo "Error al insertar el nuevo detalle de ventas:\n$sql";
    }
?>