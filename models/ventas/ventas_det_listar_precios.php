<?php  
	include "../../config/conexion.php"; 
    include("../../queries/query.php"); 
    $query = "SELECT ventas_det.precio, ventas_det.cantidad, ventas.descuento
			  FROM ventas_det, ventas
			  WHERE ventas_det.ventas_id = $_GET[ventas_id]
			  AND ventas_det.ventas_id = ventas.ventas_id" ;
    mysql_select_db($database_fastERP, $fastERP);
    $table = mysql_query($query, $fastERP) or die(mysql_error());
    $totalRows_table = mysql_num_rows($table);
    $row_table = mysql_fetch_assoc($table);

    $valor_neto = "";
    do {
		$valor_neto += $row_table["precio"] * $row_table["cantidad"];
    } while ($row_table = mysql_fetch_assoc($table));

    if(empty($_GET['descuento'])) { $_GET['descuento'] = 0; }
    $impuesto = $valor_neto * 0.18;
    $total = ($valor_neto - $_GET['descuento']) + $impuesto ;
?>

<div class="widget-header">
    <h5 class="widget-title bigger lighter">NETO <span class="right"> 
        <input type="hidden" name="valor_neto" id="valor_neto" value="<?php echo $valor_neto; ?>" />
        <input type="text" class="form-control text-right" value="<?php echo number_format($valor_neto, 2); ?>" readonly /> </span>
    </h5>
</div>
<div class="widget-header">
    <h5 class="widget-title bigger lighter">SUBTOTAL <span class="right"> 
        <input type="hidden" name="subtotal" id="subtotal" value="<?php echo $valor_neto - $_GET['descuento']; ?>" />
        <input type="text" class="form-control text-right" value="<?php echo number_format($valor_neto - $_GET['descuento'], 2); ?>" readonly /> </span>
    </h5>
</div>
<div class="widget-header">
    <h5 class="widget-title bigger lighter">IMPUESTO <span class="right"> 
        <input type="hidden" name="impuesto1" id="impuesto1" value="<?php echo $impuesto; ?>" />
        <input type="text" class="form-control text-right" value="<?php echo number_format($impuesto, 2); ?>" readonly /> </span>
    </h5>
</div>
<div class="widget-header">
    <h5 class="widget-title bigger lighter">TOTAL (S/.) <span class="right"> 
        <input type="hidden" name="total" id="total" value="<?php echo $total; ?>" />
        <input type="text" class="form-control text-right" value="<?php echo number_format($total, 2); ?>" readonly /> </span>
    </h5>
</div>
