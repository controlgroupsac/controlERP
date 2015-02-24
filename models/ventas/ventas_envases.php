<?php
	include "../../config/conexion.php"; 
	include "../../config/basico.php";

	/*verificamos si las variables se envian*/
	if(empty($_POST['ventas_id'])) {
	  echo "Usted no a llenado todos los campos";
	  exit;
	}
	for ($i=0; $i < $_POST['devuelve']; $i++) { /*Verficamos que no esten vacios las DEVOLUCION*/
		if(empty($_POST['devuelve'.$i])) {
		  echo "Usted no a llenado todos los campos";
		  exit;
		}
	}
	for ($i=0; $i < $_POST['devuelve_caja']; $i++) { /*Verficamos que no esten vacios las DEVOLUCION CAJAS*/
		if(empty($_POST['devuelve'.$i])) {
		  echo "Usted no a llenado todos los campos";
		  exit;
		}
	}

	$query = "SELECT * FROM ventas_env WHERE ventas_env.ventas_id = $_POST[ventas_id]" ;
    mysql_select_db($database_fastERP, $fastERP);
    $table = mysql_query($query, $fastERP) or die(mysql_error());
    $totalRows_table = mysql_num_rows($table);
    $row_table = mysql_fetch_assoc($table); 

	if ($totalRows_table != 0) {
		$delete = sprintf("DELETE FROM `controlg_controlerp`.`ventas_env`
						   WHERE ventas_id=%d;",
						   fn_filtro((int)$row_table['ventas_id'])
		);

	    mysql_select_db($database_fastERP, $fastERP);
	    $ventas_delete = mysql_query($delete, $fastERP) or die(mysql_error());
	}

	for ($i=0; $i < $_POST['total_rows']; $i++) { 

		$factor = $_POST['factor'.$i];
		$lleva = $_POST['lleva'.$i];
		$devuelve = $_POST['devuelve'.$i];
		
		if($factor > 1) {
			$posicion = strrpos($devuelve, "/");
			$cajas = substr($devuelve, 0, $posicion) * $factor;
			$botellas = substr($devuelve, $posicion + 1);
			$devuelve = $cajas + $botellas;

			$posicion1 = strrpos($lleva, "/");
			$cajas1 = substr($lleva, 0, $posicion1) * $factor;
			$botellas1 = substr($lleva, $posicion1 + 1);
			$lleva = $cajas1 + $botellas1;
		} 
		
		$query_envases = sprintf("INSERT INTO `controlg_controlerp`.`ventas_env` (`ventas_id`, `producto_id`, `lleva`, `devuelve`) 
				                  VALUES ('%s', '%s', '%s', '%s');",
				                  fn_filtro($_POST['ventas_id']),
				                  fn_filtro($_POST['producto_id'.$i]),
				                  fn_filtro($lleva),
				                  fn_filtro($devuelve)
		);

	    mysql_select_db($database_fastERP, $fastERP);
	    $ventas_envases = mysql_query($query_envases, $fastERP) or die(mysql_error());
	}
?>