<?php 
    include "../../config/conexion.php"; 
    include "../../queries/query.php"; 

    $query = "SELECT SUM(almacen_det.cantidad) AS total, almacen_det.cantidad, almacen_det.producto_id, almacen_det.almacendet_id
              FROM almacen_det , producto
              WHERE almacen_det.producto_ensamblado_id = $_GET[producto_id]
              AND almacen_det.almacen_id = $_GET[origen]
              AND almacen_det.producto_id = producto.producto_id
              AND producto.categoria_id <> 4
              GROUP BY almacen_det.producto_id" ;
    mysql_select_db($database_fastERP, $fastERP);
    $table = mysql_query($query, $fastERP) or die(mysql_error());
    $totalRows_table = mysql_num_rows($table);
    $row_table = mysql_fetch_assoc($table);

    if ($totalRows_table > 0) {
        $total = $row_table['total'];
    } else {
        $total = 0;
    }
?>
<span class="input-icon">
	<input type="text" class="input-xlarge" name="monto" id="monto" value="<?php echo $total; ?>" placeholder="monto" required />
	<i class="ace-icon fa fa-user"></i>
</span>