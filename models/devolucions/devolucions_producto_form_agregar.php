<?php 
    include "../../config/conexion.php"; 
    include "../../queries/functions.php"; 

    /*id del producto ensamblado(kit)*/
    $query = "SELECT almacen.almacen, 
                    producto.producto, 
                    producto.producto_id, 
                    Sum(almacen_det.cantidad) AS suma_cantidad,
                    Sum(almacen_det.cantidad) DIV producto.factor AS cajas,
                    Sum(almacen_det.cantidad) MOD producto.factor AS botellas,
                    almacen_det.producto_ensamblado_id,
                    producto.factor
              FROM almacen_det , almacen , producto
              WHERE almacen.almacen_id = almacen_det.almacen_id 
              AND almacen_det.producto_id = producto.producto_id
              AND almacen.almacen_id = $_GET[origen]
              GROUP BY producto.producto_id, almacen.almacen, producto.producto" ;
    mysql_select_db($database_fastERP, $fastERP);
    $table = mysql_query($query, $fastERP) or die(mysql_error());
    $totalRows_table = mysql_num_rows($table);
    $row_table = mysql_fetch_assoc($table); 


    /*NOMBRE del de los almacenes*/
    $query_almacen = "SELECT origen.almacen AS origen, destino.almacen AS destino
                      FROM almacen AS origen , almacen AS destino
                      WHERE origen.almacen_id = $_GET[origen]  
                      AND destino.almacen_id = $_GET[destino] " ;
    mysql_select_db($database_fastERP, $fastERP);
    $table_almacen = mysql_query($query_almacen, $fastERP) or die(mysql_error());
    $totalRows_table_almacen = mysql_num_rows($table_almacen);
    $row_table_almacen = mysql_fetch_assoc($table_almacen);
?>

<style type="text/css">
    .chosen-container {
      width: 250px !important;
    }
</style>
<div class="col-xs-12 widget-container-col">
    <div class="widget-box transparent widget-color-blue">
        <form action="javascript: fn_agregar_devolucions();" class="form-horizontal" method="post" id="frm_devolucions">

            <div class="widget-body">
                <div class="widget-main scrollable" data-size="400">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" onclick="fn_cerrar_devolucions();">&times;</button>
                        <h4 class="blue bigger">Agregar devoluciones</h4>
                    </div>
                    <div class="modal-body overflow-visible">
                        <div class="row-fluid">
                            <div class="form-group">
                                <span class="label label-lg arrowed-in arrowed-right"> Devolucion </span>
                                <span class="label label-lg label-yellow arrowed-in arrowed-right"> Origen: <?=$row_table_almacen['origen']; ?> </span>
                                <span class="fa fa-long-arrow-right"></span>
                                <span class="label label-lg label-yellow arrowed-in arrowed-right"> Destino: <?=$row_table_almacen['destino']; ?> </span>
                            </div>

                            <?php 
                                $producto = 0; 
                                $producto_name = 0; 
                                $producto_ensamblado = 0; 
                                $producto_ensamblado_name = 0;
                                $factor = 0; 
                                $factor_name = 0; 
                                $lleva = 0; 
                                $lleva_name = 0; 
                                $devuelve = 0; 
                                $devuelve_name = 0; 
                                $totalX = 0; 
                                $totalX_name = 0; 

                                $lleva_caja = 0;
                                $devuelve_caja = 0;
                                $total_caja = 0;

                                $row_add = 0;
                            ?>


                            <?php do { 
                                if ($row_table['suma_cantidad'] <> 0){ $row_add++; ?>
                                <input type="hidden" id="totalRows_table" name="totalRows_table" value="<?=$row_add; ?>" />
                                
                                <input type="hidden" id="origen" name="origen" value="<?=$_GET['origen']; ?>" />
                                <input type="hidden" id="destino" name="destino" value="<?=$_GET['destino']; ?>" />
                                <input type="hidden" id="transferencia_id" name="transferencia_id" value="<?=$_GET['transferencia_id']; ?>" />
                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-5"><?=$row_table['producto']; ?></label>
                                    <input type="hidden" name="producto_id<?=$producto_name++; ?>" id="producto_id<?=$producto++; ?>" value="<?=$row_table['producto_id']; ?>">
                                    <input type="hidden" name="producto_ensamblado_id<?=$producto_ensamblado_name++; ?>" id="producto_ensamblado_id<?=$producto_ensamblado++; ?>" value="<?=$row_table['producto_ensamblado_id']; ?>">
                                    <input type="hidden" name="factor<?=$factor_name++; ?>" id="factor<?=$factor++; ?>" value="<?=$row_table['factor']; ?>">

                                    <div class="col-sm-9">
                                        <div class="col-xs-3">
                                            <?php  
                                                /*Variables para el name, id, title y value del input lleva*/
                                                $name = "lleva".$lleva_name++; /*Variable para el NAME*/
                                                if ($row_table['factor']==1) { $id = "lleva0".$lleva_caja++; } else { $id = "lleva".$lleva++; } /*Variable para el ID*/
                                                $title = "Tiene $row_table[cajas]CAJAS / $row_table[botellas]BOTELLAS"; /*Variable para el TITLE*/
                                                if ($row_table['factor']==1) $value = $row_table['cajas']; else $value = $row_table['cajas']."/".$row_table['botellas']; /*Variable para el VALUE*/
                                            ?>
                                            <input type="text" class="col-xs-12" data-rel="tooltip" name="<?=$name; ?>" id="<?=$id; ?>" data-original-title="<?=$title; ?>" value="<?=$value; ?>" readonly />
                                        </div>
                                        <div class="col-xs-3">
                                            <?php  
                                                /*Variables para el name, id, title y value del input devuelve*/
                                                $name1 = "devuelve".$devuelve_name++; /*Variable para el NAME*/
                                                if ($row_table['factor']==1) { $id1 = "devuelve0".$devuelve_caja++; } else { $id1 = "devuelve".$devuelve++; } /*Variable para el ID*/
                                                $title1 = "Devuelves $row_table[cajas]CAJAS / $row_table[botellas]BOTELLAS"; /*Variable para el TITLE*/
                                                if ($row_table['factor']==1) $value1 = $row_table['cajas']; else $value1 = $row_table['cajas']."/".$row_table['botellas']; /*Variable para el VALUE*/
                                            ?>
                                            <input type="text" class="col-xs-12" data-rel="tooltip" name="<?=$name1; ?>" id="<?=$id1; ?>" data-original-title="<?=$title1; ?>" value="<?=$value1; ?>" />
                                        </div>
                                        <div class="col-xs-3">
                                            <?php  
                                                /*Variables para el name | id del input total*/
                                                $name2 = "total".$totalX_name++; /*Variable para el NAME*/
                                                if ($row_table['factor']==1) { $id2 = "total0".$total_caja++; } else { $id2 = "total".$totalX++; } /*Variable para el ID*/
                                            ?>
                                            <input type="text" class="col-xs-12" data-rel="tooltip" name="<?=$name2; ?>" id="<?=$id2; ?>" data-original-title="Aún te falta por devolver!!!" value="0" readonly />
                                        </div>  
                                    </div>
                                </div>
                            <?php }
                                } while ($row_table = mysql_fetch_assoc($table)); ?>

                            <div class="col-xs-12">
                                <div>
                                    <a href="#" class="btn btn-small boton" data-dismiss="modal" onclick="fn_cerrar_devolucions();">Cancelar</a>

                                    <button type="submit" class="btn btn-small btn-primary boton">
                                        <i class="fa fa-ok"></i>
                                        Devolver
                                    </button>
                                </div>
                                <input type="hidden" name="MM_insert" value="frm_devolucions">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div>
</div>


<script language="javascript" type="text/javascript">
    function fn_agregar_devolucions(){
        var data = $("#frm_devolucions").serialize();
        $.ajax({
            url: '../models/devolucions/devolucions_producto_agregar.php',
            data: data,
            type: 'get',
            success: function(data){
                // alert(data);
                fn_cerrar_devolucions_producto();
                fn_buscar_devolucions_producto();
            }
        });
    };

    /*Mostrar u ocultar los botones de formulario*/
    /*Se muestra cuando hay datos y se oculta cuando lo hay*/
    $totalRows_table = $("#totalRows_table").val();
    if ($totalRows_table == 0 || $totalRows_table == undefined) {
        $(".boton").addClass("hidden");
    };

    /*BEGIN KEYUP de los input devuelve*/
    $("#devuelve0").keyup(function () {
        var $factor           = $("#factor0").val();
        var $lleva            = $("#lleva0").val();
        var $devuelve         = $(this).val();
        var posicion_lleva    = $lleva.indexOf('/');
        var posicion_devuelve = $devuelve.indexOf('/');
        var lleva_caja        = $lleva.substring(0,posicion_lleva);
        var lleva_botella     = $lleva.substring(posicion_lleva+1);
        
        console.log("factor: " +$factor);
        console.log("lleva: " +$lleva);
        console.log("devuelve: " +$devuelve);
        if (posicion_devuelve == -1)
        {    
            var devuelve_botella = 0;
            var devuelve_caja    = $devuelve.substring(0);
        }
        else
        {
            devuelve_caja    = $devuelve.substring(0,posicion_devuelve);
            devuelve_botella = $devuelve.substring(posicion_devuelve+1);
        }
        var resta_caja    = 0;
        var resta_botella = 0;
        resta_caja    = devuelve_caja - lleva_caja;
        resta_botella = devuelve_botella - lleva_botella;

        if (resta_caja == 0) 
            resta_botella = devuelve_botella - lleva_botella;
        else
            if (resta_caja<0 && resta_botella>0)
            {
                resta_botella = (devuelve_botella) - ($factor);
                resta_caja++;
            }
        var $resta = (resta_caja)+"/"+(resta_botella);

        $("#total0").attr("value", ($resta));
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
    /*END KEYUP de los input devuelve*/




    /*Tootip text*/
    $('[data-rel=tooltip]').tooltip();

    
    $('#frm_devolucions').validate({
        errorElement: 'span',
        errorClass: 'help-inline',
        focusInvalid: false,
        rules: {
            devolucions: {
                required: true
            }
        },

        messages: {
            devolucions: {
                required: "<a data-original-title='The last tip!' title='Ingresa un devolucions válido.' data-rel='tooltip' href='#'><i class='fa fa-warning-sign'></i></a>"
            }
        }
    });

    // scrollables
    $('.scrollable').each(function () {
        var $this = $(this);
        $(this).ace_scroll({
            size: $this.attr('data-size') || 100,
            //styleClass: 'scroll-left scroll-margin scroll-thin scroll-dark scroll-light no-track scroll-visible'
        });
    });
</script>