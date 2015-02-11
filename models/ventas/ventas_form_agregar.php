<?php
    include "../../config/conexion.php"; 
    include("../../queries/query.php"); 

	if(empty($_POST['ventas_id'])){
		echo "Por favor no altere el fuente";
		exit;
	}

    $query = "SELECT ventas_det.precio, ventas_det.cantidad, ventas.descuento
			  FROM ventas_det, ventas
			  WHERE ventas_det.ventas_id = $_POST[ventas_id]
			  AND ventas_det.ventas_id = ventas.ventas_id" ;
    mysql_select_db($database_fastERP, $fastERP);
    $table = mysql_query($query, $fastERP) or die(mysql_error());
    $totalRows_table = mysql_num_rows($table);
    $row_table = mysql_fetch_assoc($table);

    $query_almacen = "SELECT * FROM `controlg_controlerp`.`ventas_det`
                      WHERE ventas_det.ventas_id = '$_POST[ventas_id]'";
    mysql_select_db($database_fastERP, $fastERP);
    $almacen = mysql_query($query_almacen, $fastERP) or die(mysql_error());
    $totalRows_almacen = mysql_num_rows($almacen);
    $row_almacen = mysql_fetch_assoc($almacen);

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
    <input type="hidden" name="totalRows_almacen" id="totalRows_almacen" value="<?php echo $totalRows_almacen; ?>">
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
                        <input type="text" name="pago-efectivo" id="pago-efectivo" placeholder="pago efectivo" requiered  />
                    </span>
                    <span class="input-icon">
                        <input type="text" name="cambio" id="cambio" placeholder="cambio" readonly  />
                    </span>
                </div>
            </div>

            <div class="form-group col-xs-6">
            	<div id="credito">
            		<span class="input-icon">
            		    <input type="text" class="date-picker hidden" name="fechapago" id="fechapago" placeholder="Fecha Compromiso" data-date-format="yyyy-mm-dd" />
            		</span>
            	</div>
            </div>



            <div class="form-group text-left">
                <label class="col-xs-4 control-label" for="comprobante"><b>Comprobante </b></label>
                <div>
                    <span class="input-icon">
                        <select id="comprobante_tipo_id" name="comprobante_tipo_id">
                            <option value="">Comprobante</option><!-- La carga de estos datos es mediante ajax -->
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
                                    <option value="">Serie</option><!-- La carga de estos datos es mediante ajax -->
                                </select>
                            </div>
                        </span><!-- Lista de todos los tipos de comprobantes mediante AJAX -->
                    </span>
                    <span class="input-icon">
                        <span id="div_listar_comprobante_pago">
                            <input type="text" name="numero" id="numero" placeholder="numero" readonly required />
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
    /*Verificacion de el radio button, cuando es EFECTIVO o es CREDITO*/
    $("input[type='radio']").on("click", function () {
        var val = $(this).val();
        if(val == "E") {
            $("#pago-efectivo").removeClass("hidden");
            $("#cambio").removeClass("hidden");
            $("#fechapago").addClass("hidden");
            $("#fechapago").removeAttr("required");
        }
        if(val == "C") {
            $("#pago-efectivo").addClass("hidden");
            $("#cambio").addClass("hidden");
            $("#fechapago").removeClass("hidden");
            $("#fechapago").attr("required");
        }
    });

    /*INICIO Cambios de combobox a combobox para comprobante de pago y su número de serie*/
    $(function(){
        cargar_comprobante_tipo_id();
        $("#comprobante_tipo_id").change(function(){dependencia_condicion_pago();});
        $("#condicion_pago").change(function(){dependencia_numero();});
        $("#condicion_pago").attr("disabled",true);
        $("#numero").attr("disabled",true);
    });
    
    function cargar_comprobante_tipo_id(){
        $.get("../models/ventas/ventas_listar_comprobante.php", function(resultado){
            if(resultado == false){
                alert("Error");
            }
            else
            {
                $('#comprobante_tipo_id').append(resultado);            
            }
        });
    }

    function dependencia_condicion_pago(){
        var code = $("#comprobante_tipo_id").val();
        $.get("../models/ventas/ventas_listar_comprobante_tipo.php?", { code: code }, function(resultado){
            if(resultado == false)
            {
                alert("Error");
            }
            else
            {
                $("#condicion_pago").attr("disabled",false);
                document.getElementById("condicion_pago").options.length=1;
                $('#condicion_pago').append(resultado);         
            }
        });
    }

    function dependencia_numero(){
        var code = $("#condicion_pago").val();
        $.get("../models/ventas/ventas_listar_comprobante_numero.php?", { code: code }, function(resultado){
            if(resultado == false)
            {
                alert("Error");
            }
            else
            {
                $("#numero").attr("disabled",false);
                $('#numero').attr("value", resultado);         
            }
        });
    }
    /*FIN Cambios de combobox a combobox para comprobante de pago y su número de serie*/

	function fn_modificar_venta(){
		var str = $("#frm_ventas").serialize();
        var ventas_id = document.getElementById('ventas_id');
        var descuento = document.getElementById('descuento');
        var totalRows_almacen = document.getElementById('totalRows_almacen');
        
        if (totalRows_almacen.value == 0) {
            alert("Tienes que al menos ingresar un producto para CERRAR la VENTAS");
            fn_cerrar_ventas();
        } else {
            $.ajax({
                url: '../models/ventas/ventas_agregar.php',
                data: str,
                type: 'post',
                success: function(data){
                    // if(data != "")
                    //     alert(data);
                    var respuesta = confirm("Desea imprimir esta venta?");
                    if (respuesta){
                        window.open("../models/ventas/ventas_imprimir.php?ventas_id=" +ventas_id.value+ "&descuento=" +descuento.value,'','width=600,height=auto,left=50,top=50,toolbar=yes');
                    } 
                    location.href = "ventas_registro.php";
    			}
    		});
        }
	};

    $("#pago-efectivo").keyup(function(){
        var pago = $(this).val();
        var total = document.getElementById('total').value;
        var monto = $("#cambio").attr("value", (pago - total));
        parseFloat(monto).toFixed(2);
    });

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

    
    $('#frm_ventas').validate({
        errorElement: 'div',
        errorClass: 'help-block',
        focusInvalid: false,
        ignore: "",
        rules: {
            comprobante_tipo_id: {
                required: true
            },
            condicion_pago: {
                required: true
            },
            numero: {
                required: true
            }
        },
    
        messages: {
            comprobante_tipo_id: {
                required: "Seleccione un comprobante."
            },
            condicion_pago: {
                required: "Seleccione un numero de serie."
            },
            numero: {
                required: "Seleccione un numero de serie."
            }
        }
    });
</script>