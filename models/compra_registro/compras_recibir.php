<?php
	include "../../config/conexion.php"; 
	include "../../config/basico.php";
	
	$query = "SELECT * FROM `controlg_controlerp`.`almacen_det` 
			  WHERE almacen_det.compra_id = $_GET[compra_id]";
    mysql_select_db($database_fastERP, $fastERP);
    $almacen = mysql_query($query, $fastERP) or die(mysql_error());
    $totalRows_almacen = mysql_num_rows($almacen);

	$query = "SELECT * FROM `controlg_controlerp`.`compra_det`
			  WHERE compra_det.compra_id = $_GET[compra_id]";
    mysql_select_db($database_fastERP, $fastERP);
    $table = mysql_query($query, $fastERP) or die(mysql_error());
    $row_table = mysql_fetch_assoc($table);

    if ($totalRows_almacen >= 1) {
    	exit;
    }else {
    	do {
            $sql = sprintf("INSERT INTO `controlg_controlerp`.`almacen_det` (`almacen_id`, `compra_id`, `producto_id`, `cantidad`, `activo`) 
                            VALUES ('%s', '%s', '%s', '%s', '%s');",
                            fn_filtro($_GET['almacen_id']),
                            fn_filtro($_GET['compra_id']),
                            fn_filtro($row_table['producto_id']),
                            fn_filtro("+".$row_table['cantidad']),
                            fn_filtro(1)
            );
            if(!mysql_query($sql, $fastERP))
                echo "Error al insertar:\n$sql";

    	} while ( $row_table = mysql_fetch_assoc($table) );

        $sql2 = sprintf("UPDATE `controlg_controlerp`.`compra` SET estado='%s'
                         WHERE compra_id=%d;",
                         fn_filtro(3),
                         fn_filtro((int)$_GET['compra_id'])
        );
        if(!mysql_query($sql2, $fastERP))
            echo "Error al insertar:\n$sql2";
    }
?>
<span class=" label label-lg label-success arrowed-right" id="recibido" >Recibido</span> <!-- Fase 3 de la compra -->
<a class="btn btn-xs btn-info" href="compras_registro.php">Cerrar</a>