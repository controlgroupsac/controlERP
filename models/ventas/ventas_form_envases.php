<?php
	if(empty($_POST['ventas_id'])){
		echo "Por favor no altere el fuente";
		exit;
	}

	include "../../config/conexion.php"; 
    include("../../queries/query.php"); 

    /*id del producto ensamblado(kit)*/
    $query = "SELECT producto_ensamblado.producto_ensamblado_id, producto_ensamblado.producto
              FROM ventas_det , ventas , producto_ensamblado
              WHERE ventas_det.ventas_id = $_POST[ventas_id]
              AND ventas_det.ventas_id = ventas.ventas_id 
              AND ventas_det.producto_id = producto_ensamblado.producto_ensamblado_id
              ORDER BY `ventas_det`.ventas_det_id DESC" ;
    mysql_select_db($database_fastERP, $fastERP);
    $table = mysql_query($query, $fastERP) or die(mysql_error());
    $totalRows_table = mysql_num_rows($table);
    $row_table = mysql_fetch_assoc($table); 
?>
<!-- page specific plugin styles -->
<link rel="stylesheet" href="css/datepicker.min.css" />
<form action="javascript: fn_modificar_venta();" class="form-inline" method="post" id="frm_ventas">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" onclick="fn_cerrar_ventas();">&times;</button>
        <h4 class="blue bigger">Detalle de Envases</h4>
    </div>
    <div class="modal-body overflow-visible">
        <div class="row-fluid">
            <div class="form-group text-left">
                <label class="col-xs-8 control-label" for="botella"><b>Devolución total </b></label>
                <div class="col-xs-4">
                    <label>
                        <input name="switch-field-1" class="ace ace-switch ace-switch-2" type="checkbox">
                        <span class="lbl"></span>
                    </label>
                </div>
            </div>
            
            <?php do { 
                /*Envases del producto*/
                $query_envases = "SELECT producto.factor, producto.producto
                                  FROM producto_ensamblado_det , producto_ensamblado , producto
                                  WHERE producto_ensamblado_det.producto_ensamblado_id = producto_ensamblado.producto_ensamblado_id 
                                  AND producto_ensamblado_det.producto_id = producto.producto_id
                                  AND producto_ensamblado.producto_ensamblado_id = $row_table[producto_ensamblado_id]" ;
                mysql_select_db($database_fastERP, $fastERP);
                $envases = mysql_query($query_envases, $fastERP) or die(mysql_error());
                $totalRows_envases = mysql_num_rows($envases);
                $row_envases = mysql_fetch_assoc($envases); ?>
                <div class="form-group col-xs-12 text-left">
                    <label class="col-xs-12 control-label" for="botella"><b><?php echo  $row_table['producto']; ?></b></label>
                </div>
                <?php do { ?>
                    <div class="form-group col-xs-4 text-left">
                        <div>
                            <input type="text" class="col-xs-5" name="CPB" id="CPB" placeholder="<?php echo $row_envases['producto']; ?>" />  &nbsp;&nbsp;&nbsp;
                            <span class="label label-lg label-yellow arrowed-in arrowed-in-right"><?php echo $row_envases['factor']."Und."; ?></span>
                        </div>
                    </div>
                <?php } while ($row_envases = mysql_fetch_assoc($envases)); ?>
                <div class='row'><div class="col-xs-12"></div></div>
            <?php } while ($row_table = mysql_fetch_assoc($table)); ?>
            <br><br>

            <div class="col-xs-12">
                <div>
                    <a href="#" class="btn btn-small uppercase" data-dismiss="modal" onclick="fn_cerrar_ventas();">Cancelar</a>

                    <button type="submit" class="btn btn-small btn-primary uppercase">
                        <i class="fa fa-ok"></i>
                        TERminar!
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