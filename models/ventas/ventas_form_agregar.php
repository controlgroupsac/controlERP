<?php
	if(empty($_POST['ventas_id'])){
		echo "Por favor no altere el fuente";
		exit;
	}

	include "../../config/conexion.php"; 
    include("../../queries/query.php"); 

    $query = "SELECT ventas_det.precio, ventas_det.cantidad, ventas.descuento
			  FROM ventas_det, ventas
			  WHERE ventas_det.ventas_id = $_POST[ventas_id]
			  AND ventas_det.ventas_id = ventas.ventas_id" ;
    mysql_select_db($database_fastERP, $fastERP);
    $table = mysql_query($query, $fastERP) or die(mysql_error());
    $totalRows_table = mysql_num_rows($table);
    $row_table = mysql_fetch_assoc($table);

    $valor_neto = "";
    do {
		$valor_neto += $row_table["precio"] * $row_table["cantidad"];
    } while ($row_table = mysql_fetch_assoc($table));

    if(empty($_POST['descuento'])) { $_POST['descuento'] = 0; }
    $impuesto = $valor_neto * 0.18;
    $total = ($valor_neto - $_POST['descuento']) + $impuesto ;
?>

<!-- page specific plugin styles -->
<link rel="stylesheet" href="css/datepicker.min.css" />
<form action="javascript: fn_modificar_venta();" class="form-horizontal" method="post" id="frm_ventas" enctype="multipart/form-data" >
    <input type="hidden" name="ventas_id" id="ventas_id" value="<?php echo $_POST['ventas_id']; ?>" />
    <input type="hidden" name="almacen_id" id="almacen_id" value="<?php echo $_POST['almacen_id']; ?>" />
    <input type="hidden" name="valor_neto" id="valor_neto" value="<?php echo $_POST['valor_neto']; ?>" />
    <input type="hidden" name="descuento" id="descuento" value="<?php echo $_POST['descuento']; ?>" />
    <input type="hidden" name="impuesto1" id="impuesto1" value="<?php echo $_POST['impuesto1']; ?>" />
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" onclick="fn_cerrar_ventas();">&times;</button>
        <h4 class="blue bigger">Modificar Detalle Ventas</h4>
    </div>
    <div class="modal-body overflow-visible">
        <div class="row-fluid">

            <!-- <div class="form-group">
                <label class="col-xs-4 control-label no-padding-right" for="neto"><b>neto </b></label>

                <div>
                    <span class="input-icon">
                        <input type="text" name="neto" id="neto" placeholder="neto" value="<?php echo $valor_neto; ?>" autofocus readonly required />
                        <i class="ace-icon fa fa-user"></i>
                </div>
            </div>

            <div class="form-group">
                <label class="col-xs-4 control-label no-padding-right" for="descuento"><b>descuento </b></label>
                <div>
                    <span class="input-icon">
                        <input type="text" name="descuento" id="descuento" placeholder="descuento" value="0" required />
                        <i class="ace-icon fa fa-user"></i>
                    </span>
                </div>
            </div>

            <div class="form-group">
                <label class="col-xs-4 control-label no-padding-right" for="igv"><b>igv 18%</b></label>
                <div>
                    <span class="input-icon">
                        <input type="text" name="igv" id="igv" placeholder="igv" value="<?php echo $impuesto; ?>" readonly required />
                        <i class="ace-icon fa fa-user"></i>
                    </span>
                </div>
            </div> -->

            <div class="form-group">
                <label class="col-xs-4 control-label no-padding-right" for="total"><b>total </b></label>
                <div>
                    <span class="input-icon">
                        <input type="text" name="total" id="total" placeholder="total" value="<?php echo $total; ?>" readonly />
                        <i class="ace-icon fa fa-user"></i>
                    </span>
                </div>
            </div>



            <div class="form-group col-xs-6">
                <div>
                    <label>
                        <input name="pago" id="efectivo" type="radio" class="ace" value="E" checked />
                        <span class="lbl"><strong> Efectivo</strong></span>
                    </label>
                    &nbsp;&nbsp; &nbsp;&nbsp;
                    <label>
                        <input name="pago" id="tarjeta" type="radio" class="ace" value="T">
                        <span class="lbl"><strong> Tarjeta</strong></span>
                    </label>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <label>
                        <input name="pago" id="credito" type="radio" class="ace" value="C">
                        <span class="lbl"><strong> Credito</strong></span>
                    </label>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                </div>
            </div>

            <div class="form-group col-xs-6">
            	<div id="efectivo">
            		<span class="input-icon">
            		    <input type="text" name="pago-efectivo" id="pago-efectivo" placeholder="pago-efectivo"  />
            		    <i class="ace-icon fa fa-user"></i>
            		</span>
            		<span class="input-icon">
            		    <input type="text" name="cambio" id="cambio" placeholder="cambio"  />
            		    <i class="ace-icon fa fa-user"></i>
            		</span>
            	</div>
            	<div id="credito">
            		<span class="input-icon">
            		    <input type="text" class="date-picker" name="fechapago" id="fechapago" placeholder="Fecha Compromiso"  required />
            		    <i class="ace-icon fa fa-user"></i>
            		</span>
            	</div>
            </div>



            <div class="form-group">
                <label class="col-xs-4 control-label no-padding-right" for="comprobante"><b>comprobante </b></label>
                <div>
                    <span class="input-icon">
                    	<select id="comprobante_tipo_id" name="comprobante_tipo_id">
                    	    <?php query_table_option("SELECT * FROM comprobante_tipo", "comprobante_tipo_id", "comprobante_tipo"); ?>
                    	</select>
                    </span>
                </div>
            </div>

            <div class="form-group">
                <label class="col-xs-4 control-label no-padding-right" for="serie"><b>serie </b></label>
                <div>
                    <span class="input-icon">
                    	<select id="condicion_pago" name="condicion_pago">
                    	    <?php query_table_option("SELECT * FROM comprobante", "comprobante_id", "serie"); ?>
                    	</select>
                    </span>
                    <span class="input-icon">
                        <input type="text" name="numero" id="numero" placeholder="numero"  required />
                        <i class="ace-icon fa fa-user"></i>
                    </span>
                </div>
            </div>

            <div class="col-xs-12">
                <div>
                    <a href="#" class="btn btn-small" data-dismiss="modal" onclick="fn_cerrar_ventas();">Cancelar</a>

                    <button type="submit" class="btn btn-small btn-primary">
                        <i class="fa fa-ok"></i>
                        Guardar!
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>

<script language="javascript" type="text/javascript">	
	//datepicker plugin
	//link
	$('.date-picker').datepicker({ 
		autoclose: true,
		todayHighlight: true
	})
	//show datepicker when clicking on the icon
	.next().on(ace.click_event, function(){
		$(this).prev().focus();
	});


	function fn_modificar_venta(){
		var str = $("#frm_ventas").serialize();
		console.log(str);
        $.ajax({
            url: '../models/ventas/ventas_agregar.php',
            data: str,
            type: 'post',
            success: function(data){
                if(data != "")
                    alert(data);
				fn_cerrar();
                location.href = "ventas_registro.php"
			}
		});
	};
</script>