<?php
	if(empty($_POST['ventas_id'])){
		echo "Por favor no altere el fuente";
		exit;
	}

	include "../../config/conexion.php"; 
    include("../../queries/query.php"); 

    /*id del producto ensamblado(kit)*/
    $envases = "SELECT * FROM ventas_env , producto
                WHERE ventas_env.producto_id = producto.producto_id 
                AND ventas_env.ventas_id = $_POST[ventas_id]" ;
    mysql_select_db($database_fastERP, $fastERP);
    $envases = mysql_query($envases, $fastERP) or die(mysql_error());
    $totalRows_envases = mysql_num_rows($envases);
    $row_envases = mysql_fetch_assoc($envases); 
    if($totalRows_envases == 0) {
        /*id del producto ensamblado(kit)*/
        $query = "SELECT 
                ventas.ventas_id, 
                producto_ensamblado.producto, 
                producto.producto, producto.factor,
                producto.producto_id, 
                ventas_det.cantidad,
                producto.unidad_id,
                SUM(IF(producto_ensamblado.categoria_id = 5 and producto.unidad_id = 1, ventas_det.cantidad * producto_ensamblado.factor, ventas_det.cantidad)) div producto.factor AS calculoc,
                SUM(IF(producto_ensamblado.categoria_id = 5 and producto.unidad_id = 1, ventas_det.cantidad * producto_ensamblado.factor, ventas_det.cantidad)) mod producto.factor AS calculob
                FROM ventas , ventas_det , producto_ensamblado , producto_ensamblado_det , producto
                WHERE ventas.ventas_id = $_POST[ventas_id] AND
                ventas.ventas_id = ventas_det.ventas_id AND
                ventas_det.producto_id = producto_ensamblado.producto_ensamblado_id AND
                producto_ensamblado.producto_ensamblado_id = producto_ensamblado_det.producto_ensamblado_id AND
                producto_ensamblado_det.producto_id = producto.producto_id AND
                producto.categoria_id = 4
                GROUP BY producto.producto_id" ;
        mysql_select_db($database_fastERP, $fastERP);
        $table = mysql_query($query, $fastERP) or die(mysql_error());
        $totalRows_table = mysql_num_rows($table);
        $row_table = mysql_fetch_assoc($table); 
    } else {
        /*id del producto ensamblado(kit)*/
        $query = "SELECT
                   ventas_env.ventas_id,
                    if (producto.unidad_id = 2,ventas_env.lleva,CONCAT((ventas_env.lleva*producto.factor div producto.factor),'/',(ventas_env.lleva*producto.factor mod producto.factor))) AS lleva,
                    if (producto.unidad_id = 2,ventas_env.devuelve,CONCAT((ventas_env.devuelve*producto.factor div producto.factor),'/',(ventas_env.devuelve*producto.factor mod producto.factor))) AS devuelve,
                    producto.producto_id,
                    producto.producto,
                    (ventas_env.devuelve - ventas_env.lleva) AS debe,
                    producto.factor,
                    producto.categoria_id,
                    producto.unidad_id
                  FROM ventas_env , producto
                  WHERE ventas_env.producto_id = producto.producto_id 
                  AND ventas_env.ventas_id = $_POST[ventas_id]" ;
        mysql_select_db($database_fastERP, $fastERP);
        $table = mysql_query($query, $fastERP) or die(mysql_error());
        $totalRows_table = mysql_num_rows($table);
        $row_table = mysql_fetch_assoc($table); 
    }
?>
<!-- page specific plugin styles -->
<link rel="stylesheet" href="css/datepicker.min.css" />
<form action="javascript: fn_modificar_venta();" class="form-inline" method="post" id="frm_envases">
    <input type="hidden" name="ventas_id" id="ventas_id" value="<?=$row_table['ventas_id']; ?>">
    <input type="hidden" name="total_rows" id="total_rows" value="<?=$totalRows_table; ?>">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" onclick="fn_cerrar_ventas();">&times;</button>
        <h4 class="blue bigger">Detalle de Envases</h4>
    </div>
    <div class="modal-body overflow-visible">
        <div class="row-fluid">
            <?php 
                $producto = 0; 
                $lleva = 0; 
                $lleva_name = 0; 
                $devuelve = 0; 
                $devuelve_name = 0; 
                $totalX = 0; 
                $factor = 0; 
                $factor_name = 0;  

                $lleva_caja = 0;
                $devuelve_caja = 0;
                $total_caja = 0;

                $row_add = 0;
            ?>
            <?php if($totalRows_envases == 0) { ?>
                <?php do { ?>
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-5"><?=$row_table['producto']; ?></label>
                    <input type="hidden" name="producto_id<?=$producto++; ?>" id="producto_id" value="<?=$row_table['producto_id']; ?>">
                    <input type="hidden" name="factor<?=$factor_name++; ?>" id="factor<?=$factor++; ?>" value="<?=$row_table['factor']; ?>">

                    <div class="col-sm-9">
                        <div class="col-xs-3">
                            <input type="text" name="lleva<?=$lleva_name++; ?>" id="lleva<?php if ($row_table['factor']==1) { echo "0".$lleva_caja++; } else {echo $lleva++;} ?>" data-rel="tooltip"  data-original-title="Lleva" value="<?php if ($row_table['unidad_id'] == 1){ echo ($row_table['calculoc']."/". $row_table['calculob']); } else { echo $row_table['calculoc']; } ?>" readonly />
                        </div>
                        <div class="col-xs-4">
                            <input type="text" name="devuelve<?=$devuelve_name++; ?>" id="devuelve<?php if ($row_table['factor']==1) { echo "0".$devuelve_caja++; } else { echo $devuelve++; } ?>" data-rel="tooltip" data-original-title="Devuelve" value="<?php if ($row_table['unidad_id'] == 1){ echo ($row_table['calculoc']."/". $row_table['calculob']); } else { echo $row_table['calculoc']; } ?>" />
                            <div class="space-6"></div>
                        </div>
                        <div class="col-xs-3">
                            <input type="text" data-rel="tooltip" name="totalX" id="total<?php if ($row_table['factor']==1){ echo "0".$total_caja++; } else {  echo $totalX++; } ?>" data-original-title="Diferencia entre lleva y devuelve" value="0" readonly />
                        </div>
                    </div>
                </div>
                <?php } while ($row_table = mysql_fetch_assoc($table)); ?>
            <?php } else { ?>
                <?php do { ?>
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-5"><?=$row_table['producto']; ?></label>
                    <input type="hidden" name="producto_id<?=$producto++; ?>" id="producto_id" value="<?=$row_table['producto_id']; ?>">
                    <input type="hidden" name="factor<?=$factor_name++; ?>" id="factor<?=$factor++; ?>" value="<?=$row_table['factor']; ?>">

                    <div class="col-sm-9">
                        <div class="col-xs-3">
                            <input type="text" name="lleva<?=$lleva_name++; ?>" id="lleva<?php if ($row_table['factor']==1) { echo "0".$lleva_caja++; } else {echo $lleva++;} ?>" data-rel="tooltip"  data-original-title="Lleva" value="<?php if ($row_table['unidad_id'] == 1){ echo ($row_table['calculoc']."/". $row_table['calculob']); } else { echo $row_table['calculoc']; } ?>" readonly />
                        </div>
                        <div class="col-xs-4">
                            <input type="text" name="devuelve<?=$devuelve_name++; ?>" id="devuelve<?php if ($row_table['factor']==1) { echo "0".$devuelve_caja++; } else { echo $devuelve++; } ?>" data-rel="tooltip" data-original-title="Devuelve" value="<?php if ($row_table['unidad_id'] == 1){ echo ($row_table['calculoc']."/". $row_table['calculob']); } else { echo $row_table['calculoc']; } ?>" />
                            <div class="space-6"></div>
                        </div>
                        <div class="col-xs-3">
                            <input type="text" data-rel="tooltip" name="totalX" id="total<?php if ($row_table['factor']==1){ echo "0".$total_caja++; } else {  echo $totalX++; } ?>" data-original-title="Diferencia entre lleva y devuelve" value="0" readonly />
                        </div>
                    </div>
                </div>
                <?php } while ($row_table = mysql_fetch_assoc($table)); ?>
            <?php } ?>

            <div class="col-xs-12">
                <div>
                    <a href="#" class="btn btn-small uppercase" data-dismiss="modal" onclick="fn_cerrar_ventas();">Cancelar</a>

                    <button type="submit" id='terminar' class="btn btn-small btn-primary uppercase">
                        <i class="fa fa-ok"></i>
                        TERminar!
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>

<script language="javascript" type="text/javascript">
    $('[data-rel=tooltip]').tooltip();
	function fn_modificar_venta(){
		var str = $("#frm_envases").serialize();
        console.log(str);
        var ventas_id = document.getElementById('ventas_id');
        $.ajax({
            url: '../models/ventas/ventas_envases.php',
            data: str,
            type: 'post',
            success: function(data){
                if(data != "")
                    alert(data);
                $("#practica_envases").html(data);
                fn_cerrar_ventas();
			}
		});
	};

    /*BEGIN KEYUP diferencia de envases*/

    $("#devuelve0").keyup(function () {
        var $factor = $("#factor0").val();
        var $lleva = $("#lleva0").val();
        var $devuelve = $(this).val();
        var posicion_lleva = $lleva.indexOf('/');
        var posicion_devuelve = $devuelve.indexOf('/');
        var lleva_caja = $lleva.substring(0,posicion_lleva);
        var lleva_botella = $lleva.substring(posicion_lleva+1);
        console.log('factor '+$factor)
        if (posicion_devuelve==-1)
        {    
            var devuelve_botella = 0;
            var devuelve_caja = $devuelve.substring(0);
        }
        else
        {
            devuelve_caja = $devuelve.substring(0,posicion_devuelve);
            devuelve_botella = $devuelve.substring(posicion_devuelve+1);
        }
        var resta_caja = 0;
        var resta_botella=0;
        resta_caja = devuelve_caja - lleva_caja;
        resta_botella = devuelve_botella - lleva_botella;

        if (resta_caja==0) 
            resta_botella = devuelve_botella - lleva_botella;
        else
            if (resta_caja<0 && resta_botella>0)
            {
                resta_botella = (devuelve_botella) - ($factor);
                resta_caja++;
            }
        var $resta = (resta_caja)+"/"+(resta_botella);

        $("#totalX0").attr("value", ($resta));
    });

    $("#devuelve1").keyup(function () {
        var $factor = $("#factor1").val();
        var $lleva = $("#lleva1").val();
        var $devuelve = $(this).val();
        var posicion_lleva = $lleva.indexOf('/');
        var posicion_devuelve = $devuelve.indexOf('/');
        var lleva_caja = $lleva.substring(0,posicion_lleva);
        var lleva_botella = $lleva.substring(posicion_lleva+1);
        
        if (posicion_devuelve==-1)
        {    
            var devuelve_botella = 0;
            var devuelve_caja = $devuelve.substring(0);
        }
        else
        {
            devuelve_caja = $devuelve.substring(0,posicion_devuelve);
            devuelve_botella = $devuelve.substring(posicion_devuelve+1);
        }
        var resta_caja = 0;
        var resta_botella=0;
        resta_caja = devuelve_caja - lleva_caja;
        resta_botella = devuelve_botella - lleva_botella;

        if (resta_caja==0) 
            resta_botella = devuelve_botella - lleva_botella;
        else
            if (resta_caja<0 && resta_botella>0)
            {
                resta_botella = (devuelve_botella) - ($factor);
                resta_caja++;
            }
        var $resta = (resta_caja)+"/"+(resta_botella);

        $("#total1").attr("value", ($resta));
    });

    $("#devuelve2").keyup(function () {
        var $factor = $("#factor2").val();
        var $lleva = $("#lleva2").val();
        var $devuelve = $(this).val();
        var posicion_lleva = $lleva.indexOf('/');
        var posicion_devuelve = $devuelve.indexOf('/');
        var lleva_caja = $lleva.substring(0,posicion_lleva);
        var lleva_botella = $lleva.substring(posicion_lleva+1);
        
        if (posicion_devuelve==-1)
        {    
            var devuelve_botella = 0;
            var devuelve_caja = $devuelve.substring(0);
        }
        else
        {
            devuelve_caja = $devuelve.substring(0,posicion_devuelve);
            devuelve_botella = $devuelve.substring(posicion_devuelve+1);
        }
        var resta_caja = 0;
        var resta_botella=0;
        resta_caja = devuelve_caja - lleva_caja;
        resta_botella = devuelve_botella - lleva_botella;

        if (resta_caja==0) 
            resta_botella = devuelve_botella - lleva_botella;
        else
            if (resta_caja<0 && resta_botella>0)
            {
                resta_botella = (devuelve_botella) - ($factor);
                resta_caja++;
            }
        var $resta = (resta_caja)+"/"+(resta_botella);

        $("#total2").attr("value", ($resta));
    });

    $("#devuelve3").keyup(function () {
        var $factor = $("#factor3").val();
        var $lleva = $("#lleva3").val();
        var $devuelve = $(this).val();
        var posicion_lleva = $lleva.indexOf('/');
        var posicion_devuelve = $devuelve.indexOf('/');
        var lleva_caja = $lleva.substring(0,posicion_lleva);
        var lleva_botella = $lleva.substring(posicion_lleva+1);
        
        if (posicion_devuelve==-1)
        {    
            var devuelve_botella = 0;
            var devuelve_caja = $devuelve.substring(0);
        }
        else
        {
            devuelve_caja = $devuelve.substring(0,posicion_devuelve);
            devuelve_botella = $devuelve.substring(posicion_devuelve+1);
        }
        var resta_caja = 0;
        var resta_botella=0;
        resta_caja = devuelve_caja - lleva_caja;
        resta_botella = devuelve_botella - lleva_botella;

        if (resta_caja==0) 
            resta_botella = devuelve_botella - lleva_botella;
        else
            if (resta_caja<0 && resta_botella>0)
            {
                resta_botella = (devuelve_botella) - ($factor);
                resta_caja++;
            }
        var $resta = (resta_caja)+"/"+(resta_botella);

        $("#total3").attr("value", ($resta));
    });

    $("#devuelve4").keyup(function () {
        var $factor = $("#factor4").val();
        var $lleva = $("#lleva4").val();
        var $devuelve = $(this).val();
        var posicion_lleva = $lleva.indexOf('/');
        var posicion_devuelve = $devuelve.indexOf('/');
        var lleva_caja = $lleva.substring(0,posicion_lleva);
        var lleva_botella = $lleva.substring(posicion_lleva+1);
        
        if (posicion_devuelve==-1)
        {    
            var devuelve_botella = 0;
            var devuelve_caja = $devuelve.substring(0);
        }
        else
        {
            devuelve_caja = $devuelve.substring(0,posicion_devuelve);
            devuelve_botella = $devuelve.substring(posicion_devuelve+1);
        }
        var resta_caja = 0;
        var resta_botella=0;
        resta_caja = devuelve_caja - lleva_caja;
        resta_botella = devuelve_botella - lleva_botella;

        if (resta_caja==0) 
            resta_botella = devuelve_botella - lleva_botella;
        else
            if (resta_caja<0 && resta_botella>0)
            {
                resta_botella = (devuelve_botella) - ($factor);
                resta_caja++;
            }
        var $resta = (resta_caja)+"/"+(resta_botella);

        $("#total4").attr("value", ($resta));
    });

    $("#devuelve5").keyup(function () {
        var $factor = $("#factor5").val();
        var $lleva = $("#lleva5").val();
        var $devuelve = $(this).val();
        var posicion_lleva = $lleva.indexOf('/');
        var posicion_devuelve = $devuelve.indexOf('/');
        var lleva_caja = $lleva.substring(0,posicion_lleva);
        var lleva_botella = $lleva.substring(posicion_lleva+1);
        
        if (posicion_devuelve==-1)
        {    
            var devuelve_botella = 0;
            var devuelve_caja = $devuelve.substring(0);
        }
        else
        {
            devuelve_caja = $devuelve.substring(0,posicion_devuelve);
            devuelve_botella = $devuelve.substring(posicion_devuelve+1);
        }
        var resta_caja = 0;
        var resta_botella=0;
        resta_caja = devuelve_caja - lleva_caja;
        resta_botella = devuelve_botella - lleva_botella;

        if (resta_caja==0) 
            resta_botella = devuelve_botella - lleva_botella;
        else
            if (resta_caja<0 && resta_botella>0)
            {
                resta_botella = (devuelve_botella) - ($factor);
                resta_caja++;
            }
        var $resta = (resta_caja)+"/"+(resta_botella);

        $("#total5").attr("value", ($resta));
    });

    $("#devuelve6").keyup(function () {
        var $factor = $("#factor6").val();
        var $lleva = $("#lleva6").val();
        var $devuelve = $(this).val();
        var posicion_lleva = $lleva.indexOf('/');
        var posicion_devuelve = $devuelve.indexOf('/');
        var lleva_caja = $lleva.substring(0,posicion_lleva);
        var lleva_botella = $lleva.substring(posicion_lleva+1);
        
        if (posicion_devuelve==-1)
        {    
            var devuelve_botella = 0;
            var devuelve_caja = $devuelve.substring(0);
        }
        else
        {
            devuelve_caja = $devuelve.substring(0,posicion_devuelve);
            devuelve_botella = $devuelve.substring(posicion_devuelve+1);
        }
        var resta_caja = 0;
        var resta_botella=0;
        resta_caja = devuelve_caja - lleva_caja;
        resta_botella = devuelve_botella - lleva_botella;

        if (resta_caja==0) 
            resta_botella = devuelve_botella - lleva_botella;
        else
            if (resta_caja<0 && resta_botella>0)
            {
                resta_botella = (devuelve_botella) - ($factor);
                resta_caja++;
            }
        var $resta = (resta_caja)+"/"+(resta_botella);

        $("#total6").attr("value", ($resta));
    });

    $("#devuelve7").keyup(function () {
        var $factor = $("#factor7").val();
        var $lleva = $("#lleva7").val();
        var $devuelve = $(this).val();
        var posicion_lleva = $lleva.indexOf('/');
        var posicion_devuelve = $devuelve.indexOf('/');
        var lleva_caja = $lleva.substring(0,posicion_lleva);
        var lleva_botella = $lleva.substring(posicion_lleva+1);
        
        if (posicion_devuelve==-1)
        {    
            var devuelve_botella = 0;
            var devuelve_caja = $devuelve.substring(0);
        }
        else
        {
            devuelve_caja = $devuelve.substring(0,posicion_devuelve);
            devuelve_botella = $devuelve.substring(posicion_devuelve+1);
        }
        var resta_caja = 0;
        var resta_botella=0;
        resta_caja = devuelve_caja - lleva_caja;
        resta_botella = devuelve_botella - lleva_botella;

        if (resta_caja==0) 
            resta_botella = devuelve_botella - lleva_botella;
        else
            if (resta_caja<0 && resta_botella>0)
            {
                resta_botella = (devuelve_botella) - ($factor);
                resta_caja++;
            }
        var $resta = (resta_caja)+"/"+(resta_botella);

        $("#total7").attr("value", ($resta));
    });

    $("#devuelve8").keyup(function () {
        var $factor = $("#factor8").val();
        var $lleva = $("#lleva8").val();
        var $devuelve = $(this).val();
        var posicion_lleva = $lleva.indexOf('/');
        var posicion_devuelve = $devuelve.indexOf('/');
        var lleva_caja = $lleva.substring(0,posicion_lleva);
        var lleva_botella = $lleva.substring(posicion_lleva+1);
        
        if (posicion_devuelve==-1)
        {    
            var devuelve_botella = 0;
            var devuelve_caja = $devuelve.substring(0);
        }
        else
        {
            devuelve_caja = $devuelve.substring(0,posicion_devuelve);
            devuelve_botella = $devuelve.substring(posicion_devuelve+1);
        }
        var resta_caja = 0;
        var resta_botella=0;
        resta_caja = devuelve_caja - lleva_caja;
        resta_botella = devuelve_botella - lleva_botella;

        if (resta_caja==0) 
            resta_botella = devuelve_botella - lleva_botella;
        else
            if (resta_caja<0 && resta_botella>0)
            {
                resta_botella = (devuelve_botella) - ($factor);
                resta_caja++;
            }
        var $resta = (resta_caja)+"/"+(resta_botella);

        $("#total8").attr("value", ($resta));
    });

    $("#devuelve9").keyup(function () {
        var $factor = $("#factor9").val();
        var $lleva = $("#lleva9").val();
        var $devuelve = $(this).val();
        var posicion_lleva = $lleva.indexOf('/');
        var posicion_devuelve = $devuelve.indexOf('/');
        var lleva_caja = $lleva.substring(0,posicion_lleva);
        var lleva_botella = $lleva.substring(posicion_lleva+1);
        
        if (posicion_devuelve==-1)
        {    
            var devuelve_botella = 0;
            var devuelve_caja = $devuelve.substring(0);
        }
        else
        {
            devuelve_caja = $devuelve.substring(0,posicion_devuelve);
            devuelve_botella = $devuelve.substring(posicion_devuelve+1);
        }
        var resta_caja = 0;
        var resta_botella=0;
        resta_caja = devuelve_caja - lleva_caja;
        resta_botella = devuelve_botella - lleva_botella;

        if (resta_caja==0) 
            resta_botella = devuelve_botella - lleva_botella;
        else
            if (resta_caja<0 && resta_botella>0)
            {
                resta_botella = (devuelve_botella) - ($factor);
                resta_caja++;
            }
        var $resta = (resta_caja)+"/"+(resta_botella);

        $("#total9").attr("value", ($resta));
    });

    $("#devuelve10").keyup(function () {
        var $factor = $("#factor10").val();
        var $lleva = $("#lleva10").val();
        var $devuelve = $(this).val();
        var posicion_lleva = $lleva.indexOf('/');
        var posicion_devuelve = $devuelve.indexOf('/');
        var lleva_caja = $lleva.substring(0,posicion_lleva);
        var lleva_botella = $lleva.substring(posicion_lleva+1);
        
        if (posicion_devuelve==-1)
        {    
            var devuelve_botella = 0;
            var devuelve_caja = $devuelve.substring(0);
        }
        else
        {
            devuelve_caja = $devuelve.substring(0,posicion_devuelve);
            devuelve_botella = $devuelve.substring(posicion_devuelve+1);
        }
        var resta_caja = 0;
        var resta_botella=0;
        resta_caja = devuelve_caja - lleva_caja;
        resta_botella = devuelve_botella - lleva_botella;

        if (resta_caja==0) 
            resta_botella = devuelve_botella - lleva_botella;
        else
            if (resta_caja<0 && resta_botella>0)
            {
                resta_botella = (devuelve_botella) - ($factor);
                resta_caja++;
            }
        var $resta = (resta_caja)+"/"+(resta_botella);

        $("#total10").attr("value", ($resta));
    });



    $("#devuelve00").keyup(function () {
        var $lleva = $("#lleva00").val();
        var $devuelve = $(this).val();
        $resta = $lleva - $devuelve;

        $("#total00").attr("value", ($resta * (-1)));
    });
    $("#devuelve01").keyup(function () {
        var $lleva = $("#lleva01").val();
        var $devuelve = $(this).val();
        $resta = $lleva - $devuelve;

        $("#total01").attr("value", ($resta * (-1)));
    });
    $("#devuelve02").keyup(function () {
        var $lleva = $("#lleva02").val();
        var $devuelve = $(this).val();
        $resta = $lleva - $devuelve;

        $("#total02").attr("value", ($resta * (-1)));
    });
    /*END KEYUP diferencia de envases*/
</script>