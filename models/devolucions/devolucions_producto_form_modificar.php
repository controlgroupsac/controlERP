<?php 
    include "../../config/conexion.php"; 
    include "../../queries/functions.php"; 

    /*id del producto ensamblado(kit)*/
    $query = "SELECT almacen_transferencias_detalle.almacen_transferencias_detalle_id,
                     almacen_transferencias_detalle.producto_id,
                     almacen_transferencias_detalle.cantidad,
                     almacen_transferencias_detalle.producto_ensamblado_id, 
                     producto.producto,
                     producto.factor,
                    if(producto.unidad_id = 2, almacen_transferencias_detalle.cantidad, CONCAT((almacen_transferencias_detalle.cantidad DIV producto.factor), '/', (almacen_transferencias_detalle.cantidad MOD producto.factor))) AS devuelto,
                    if(producto.unidad_id = 2, 0, '0/0') AS devuelve,
                    if(producto.unidad_id = 2, almacen_transferencias_detalle.faltante, CONCAT((almacen_transferencias_detalle.faltante DIV producto.factor), '/', (almacen_transferencias_detalle.faltante MOD producto.factor))) AS faltante,
                    (almacen_transferencias_detalle.cantidad DIV producto.factor) AS cajas_devueltas,
                    (almacen_transferencias_detalle.cantidad MOD producto.factor) AS botellas_devueltas,
                    (almacen_transferencias_detalle.faltante DIV producto.factor) AS cajas_faltantes,
                    (almacen_transferencias_detalle.faltante MOD producto.factor) AS botellas_faltantes
             FROM almacen_transferencias_detalle , producto
             WHERE almacen_transferencias_detalle.almacen_transferencias_detalle_id = $_POST[almacen_transferencias_detalle_id] 
             AND almacen_transferencias_detalle.producto_id = producto.producto_id" ;
    mysql_select_db($database_fastERP, $fastERP);
    $table = mysql_query($query, $fastERP) or die(mysql_error());
    $totalRows_table = mysql_num_rows($table);
    $row_table = mysql_fetch_assoc($table); 


    /*NOMBRE del de los almacenes*/
    $query_almacen = "SELECT origen.almacen AS origen, destino.almacen AS destino
                      FROM almacen AS origen , almacen AS destino
                      WHERE origen.almacen_id = $_POST[origen]  
                      AND destino.almacen_id = $_POST[destino] " ;
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

                            <input type="hidden" name="origen"                            value="<?=$_POST['origen']; ?>" />
                            <input type="hidden" name="destino"                           value="<?=$_POST['destino']; ?>" />
                            <input type="hidden" name="transferencia_id"                  value="<?=$_POST['transferencia_id']; ?>" />
                            <input type="hidden" name="almacen_transferencias_detalle_id" value="<?=$_POST['almacen_transferencias_detalle_id']; ?>" />
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-5"><?=$row_table['producto']; ?></label>
                                <input type="hidden" name="producto_id"            value="<?=$row_table['producto_id']; ?>">
                                <input type="hidden" name="producto_ensamblado_id" value="<?=$row_table['producto_ensamblado_id']; ?>">
                                <input type="hidden" name="factor"                 value="<?=$row_table['factor']; ?>">

                                <div class="col-sm-9">
                                    <div class="col-xs-3">
                                        <?php if ($row_table['factor'] == 1) { $id = "lleva0"; } else { $id = "lleva"; } ?>
                                        <input type="text" class="col-xs-12" data-rel="tooltip" name="lleva" id="<?=$id?>" data-original-title="Devuelto" value="<?=$row_table['devuelto']?>" readonly />
                                    </div>
                                    <div class="col-xs-3">
                                        <?php if ($row_table['factor'] == 1) { $id1 = "devuelve0"; } else { $id1 = "devuelve"; } ?>
                                        <input type="text" class="col-xs-12" data-rel="tooltip" name="devuelve" id="<?=$id1?>" data-original-title="Devuelve" value="<?=$row_table['devuelve']?>" /><!-- Dato de visualización al usuario -->
                                        <input type="hidden" id="cajas_faltantes" value="<?=$row_table['cajas_faltantes'];?>" readonly /><!-- Datos de la base de datos -->
                                        <input type="hidden" id="botellas_faltantes" value="<?=$row_table['botellas_faltantes'];?>" readonly /><!-- Datos de la base de datos -->
                                    </div>
                                    <div class="col-xs-3">
                                        <?php if ($row_table['factor'] == 1) { $id2 = "total0"; } else { $id2 = "total"; } ?>
                                        <input type="text" class="col-xs-12" data-rel="tooltip" name="total" id="<?=$id2?>" data-original-title="Aún te falta por devolver!!!" value="<?=$row_table['faltante']?>" readonly /><!-- Dato de visualización al usuario -->
                                        <input type="hidden" class="col-xs-12" data-rel="tooltip" id="<?=$id2?>X" value="<?=$row_table['faltante']?>" readonly /><!-- Datos de la base de datos -->
                                    </div>  
                                </div>
                            </div>


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
        // console.log(data)
        $.ajax({
            url: '../models/devolucions/devolucions_producto_modificar.php',
            data: data,
            type: 'get',
            success: function(data){
                // alert(data);
                fn_cerrar_devolucions_producto();
                fn_buscar_devolucions_producto();
            }
        });
    };


    /*BEGIN KEYUP de los input devuelve*/
    $("#devuelve").keyup(function () {
        /*Variables de input*/
        var $factor             = $("#factor").val();
        var $lleva              = $("#lleva").val();
        var $devuelve           = $("#devuelve").val();
        var $cajas_faltantes    = $("#cajas_faltantes").val();
            $cajas_faltantes    = parseInt($cajas_faltantes);
        var $botellas_faltantes = $("#botellas_faltantes").val();
            $botellas_faltantes = parseInt($botellas_faltantes);
        var $devuelve           = $(this).val();

        var posicion_devuelve = $devuelve.indexOf('/');
        if (posicion_devuelve == -1) {
            var devuelve_caja    = 0;
            var devuelve_botella = 0;
        } else {
            devuelve_caja    = $devuelve.substring(0, posicion_devuelve);
            devuelve_caja    = parseInt(devuelve_caja);
            devuelve_botella = $devuelve.substring(posicion_devuelve + 1);
            devuelve_botella = parseInt(devuelve_botella);
        }
        var resta_caja    = devuelve_caja    + $cajas_faltantes;
        var resta_botella = devuelve_botella + $botellas_faltantes;

        if (resta_caja == 0) 
            resta_botella = devuelve_botella + $botellas_faltantes;
        else
            if (resta_caja < 0 && resta_botella > 0) {
                resta_botella = devuelve_botella + $factor;
                resta_caja++;
            }
        if(isNaN(resta_botella)) { resta_botella = 0; }

        var resta = (resta_caja) +"/"+ (resta_botella);
        $("#total").attr("value", (resta));
    });

    /*Si el producto es CPB, se realiza este KEYUP*/    
    $("#devuelve0").keyup(function () {
        var $total    = $("#total0X");
            total    = parseInt($total.val());
        var $devuelve = $(this);
            devuelve = parseInt($devuelve.val());

        var resta = devuelve + total;
        $("#total0").attr("value", resta);
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