<?php 
    include "../../config/conexion.php"; 
    include "../../queries/query.php"; 

    $query = "SELECT * FROM producto_ensamblado
			  WHERE producto.producto_id = $_GET[producto_id]" ;
    mysql_select_db($database_fastERP, $fastERP);
    $table = mysql_query($query, $fastERP) or die(mysql_error());
    $totalRows_table = mysql_num_rows($table);
    $row_table = mysql_fetch_assoc($table);
?>
<span class="input-icon">
	<input type="text" class="input-xlarge" name="monto" id="monto" value="<?php echo $row_table['precio']; ?>" placeholder="monto" required />
	<i class="ace-icon fa fa-user"></i>
</span>