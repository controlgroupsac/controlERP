<?php  
	include "../../config/conexion.php"; 
    include("../../queries/query.php"); 
    $condicion_pago = @$_GET['condicion_pago'];
    $query = "SELECT comprobante.ultimo_numero
			  FROM comprobante
			  WHERE comprobante.comprobante_id = $condicion_pago";

    mysql_select_db($database_fastERP, $fastERP);
    $table = mysql_query($query, $fastERP) or die(mysql_error());
    $totalRows_table = mysql_num_rows($table);
    $row_table = mysql_fetch_assoc($table);
?>
<input type="text" name="numero" id="numero" placeholder="numero" value="<?php echo @$row_table['ultimo_numero']; ?>" readonly required />