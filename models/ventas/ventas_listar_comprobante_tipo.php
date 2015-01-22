<?php  
	include "../../config/conexion.php"; 
    include("../../queries/query.php"); 
    $comprobante_tipo_id = @$_GET['comprobante_tipo_id'];
    $query = "SELECT comprobante.serie, comprobante.comprobante_id
			  FROM comprobante, comprobante_tipo
			  WHERE comprobante.comprobante_tipo_id = comprobante_tipo.comprobante_tipo_id 
			  AND comprobante.comprobante_tipo_id = $comprobante_tipo_id";

    mysql_select_db($database_fastERP, $fastERP);
    $table = mysql_query($query, $fastERP) or die(mysql_error());
    $totalRows_table = mysql_num_rows($table);
    $row_table = mysql_fetch_assoc($table);
?>
<select id="condicion_pago" name="condicion_pago" id="condicion_pago"> <!-- Al hacer click, muestra en input id="numero" el ultimo número correlativo! -->
	<option value="">Serie</option>
	<?php do { ?>
		<option value="<?php echo @$row_table['comprobante_id']; ?>"><?php echo @$row_table['serie']; ?></option>
	<?php } while ( $row_table = mysql_fetch_assoc($table) ); ?>
</select>
<script type="text/javascript">
	$("#condicion_pago").change(function(){ /*Funcion para listar todos los tipos de comprobantes...*/
		var condicion_pago = document.getElementById('condicion_pago');
		console.log(condicion_pago.value);
		$.ajax({
			url: '../models/ventas/ventas_listar_comprobante_pago.php',
			data: "condicion_pago=" +condicion_pago.value,
			type: 'get',
			success: function(data){
			 	$("#div_listar_comprobante_pago").html(data);
			}
		});
	});
	  
</script>