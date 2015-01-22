<?php  
	include "../../config/conexion.php"; 
    include("../../queries/query.php"); 
    $query = "SELECT compra_det.monto, compra_det.cantidad
			  FROM compra_det, compra
			  WHERE compra_det.compra_id = $_GET[compra_id]
			  AND compra_det.compra_id = compra.compra_id" ;
    mysql_select_db($database_fastERP, $fastERP);
    $table = mysql_query($query, $fastERP) or die(mysql_error());
    $totalRows_table = mysql_num_rows($table);
    $row_table = mysql_fetch_assoc($table);

    $valor_neto = "";
    do {
		$valor_neto += $row_table["monto"] * $row_table["cantidad"];
    } while ($row_table = mysql_fetch_assoc($table));

    $impuesto = $valor_neto * 0.18;
    $total = ($valor_neto - $_GET['descuento']) + $impuesto ;
?>
<div class="col-lg-6 form-horizontal">							    		
	<div class="form-group">
		<label class="col-sm-3 control-label" for="valor_neto"> <strong>Valor Neto</strong> </label>

		<div class="col-sm-9">
			<input class="form-control col-xs-10 col-sm-5 input-xlarge text-right" name="valor_neto" id="valor_neto" type="text" value="<?php echo number_format($valor_neto, 2); ?>" readonly />
		</div>
	</div>								    		
	<div class="form-group">
		<label class="col-sm-3 control-label" for="impuesto1"> <strong>Impuesto (18%)</strong> </label>

		<div class="col-sm-9">
			<input class="form-control col-xs-10 col-sm-5 input-xlarge text-right" name="impuesto1" id="impuesto1" type="text" value="<?php echo number_format($impuesto, 2); ?>" readonly />
		</div>
	</div>								    		
	<div class="form-group">
		<label class="col-sm-3 control-label" for="total"> <strong>Total</strong> </label>

		<div class="col-sm-9">
			<input class="form-control col-xs-10 col-sm-5 input-xlarge text-right" name="total" id="total" type="text" value="<?php echo number_format($total, 2); ?>" readonly />
		</div>
	</div>
</div>