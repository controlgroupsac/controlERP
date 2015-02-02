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
    <input type="hidden" name="cliente_id" id="cliente_id" value="<?php echo $_POST['cliente_id']; ?>" />
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

            <div class="form-group text-left">
                <label class="col-xs-4 control-label" for="total"><b>Total </b></label>
                <div>
                    <span class="input-icon">
                        <input type="text" name="total" id="total" placeholder="total" value="<?php echo $total; ?>" readonly />
                        <i class="ace-icon fa fa-user"></i>
                    </span>
                </div>
            </div>



            <div class="form-group col-xs-6 text-right">
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
            		    <input type="text" name="cambio" id="cambio" placeholder="cambio" readonly  />
            		    <i class="ace-icon fa fa-user"></i>
            		</span>
            	</div>
            	<div id="credito">
            		<span class="input-icon">
            		    <input type="text" class="date-picker" name="fechapago" id="fechapago" placeholder="Fecha Compromiso" />
            		    <i class="ace-icon fa fa-user"></i>
            		</span>
            	</div>
            </div>



            <div class="form-group text-left">
                <label class="col-xs-4 control-label" for="comprobante"><b>Comprobante </b></label>
                <div>
                    <span class="input-icon">
                        <select id="comprobante_tipo_id" name="comprobante_tipo_id">
                            <option value="">Comprobante</option>
                    	    <?php @query_table_option_comparar("SELECT * FROM comprobante_tipo", "comprobante_tipo_id", "comprobante_tipo", 4); ?>
                    	</select>
                    </span>
                </div>
            </div>

            <div class="form-group text-left">
                <label class="col-xs-4 control-label" for="serie"><b>Serie </b></label>
                <div>
                    <span class="input-icon">
                    	<span>
                            <div id="div_listar_comprobante_tipo"> 
                                <select name="condicion_pago" id="condicion_pago"> <!-- Al hacer click, muestra en input id="numero" el ultimo número correlativo! -->
                                    <option value="">Serie</option>
                                    <?php do { ?>
                                        <option value="<?php echo @$row_table['comprobante_id']; ?>"><?php echo @$row_table['serie']; ?></option>
                                    <?php } while ( $row_table = mysql_fetch_assoc($table) ); ?>
                                </select>
                            </div>
                        </span><!-- Lista de todos los tipos de comprobantes mediante AJAX -->
                    </span>
                    <span class="input-icon">
                        <span id="div_listar_comprobante_pago">
                            <input type="text" name="numero" id="numero" placeholder="numero" value="<?php echo @$row_table['serie']; ?>" readonly required />
                        </span><!-- Número de serie del el comprobante seleccionado -->
                    </span>
                </div>
            </div>

            <div class="col-xs-12">
                <div>
                    <a href="#" class="btn btn-small uppercase" data-dismiss="modal" onclick="fn_cerrar_ventas();">Cancelar</a>

                    <button type="submit" class="btn btn-small btn-primary">
                        <i class="fa fa-ok"></i>
                        IMPRIMIR!
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
        var ventas_id = document.getElementById('ventas_id');
        $.ajax({
            url: '../models/ventas/ventas_agregar.php',
            data: str,
            type: 'post',
            success: function(data){
                if(data != "")
                    alert(data);
                var respuesta = confirm("Desea imprimir esta venta?");
                if (respuesta){
                    location.href = "../models/ventas/ventas_imprimir.php?ventas_id=" +ventas_id.value;
                }
                fn_cerrar_ventas();
                // location.href = "ventas_registro.php"
			}
		});
	};

    $("#comprobante_tipo_id").change(function(){/*Funcion para listar todos los tipos de comprobantes...*/
        var comprobante_tipo_id = document.getElementById('comprobante_tipo_id');
        $.ajax({
            url: '../models/ventas/ventas_listar_comprobante_tipo.php?comprobante_tipo_id=' +comprobante_tipo_id.value,
            data: "comprobante_tipo_id=" +comprobante_tipo_id.value,
            type: 'get',
            success: function(data){
              $("#div_listar_comprobante_tipo").html(data);
            }
        });
    });

    $("#pago-efectivo").keyup(function(){
        var pago = $(this).val();
        var total = document.getElementById('total').value;
        var monto = $("#cambio").attr("value", (pago - total));
        parseFloat(monto).toFixed(2);
    });
</script>