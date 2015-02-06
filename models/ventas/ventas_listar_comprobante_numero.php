<?php  
	include "../../config/conexion.php"; 
    include("../../queries/query.php"); 
    $condicion_pago = @$_GET['code'];
    $query = "SELECT comprobante.ultimo_numero, comprobante.comprobante_id
			  FROM comprobante
			  WHERE comprobante.comprobante_id = $condicion_pago";

    mysql_select_db($database_fastERP, $fastERP);
    $table = mysql_query($query, $fastERP) or die(mysql_error());
    $totalRows_table = mysql_num_rows($table);
    $row_table = mysql_fetch_assoc($table);
    $ultimo_numero = @$row_table['ultimo_numero'] + 1;
    
    echo $ultimo_numero; 
?>