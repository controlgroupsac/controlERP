<?php 
    include "../../config/conexion.php"; 
    include "../../queries/functions.php"; 

    /*id del producto ensamblado(kit)*/
    $query = "SELECT almacen.almacen, producto.producto, producto.producto_id, Sum(almacen_det.cantidad) AS suma_cantidad,
                     almacen_det.producto_ensamblado_id
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
                                <span class="label label-lg label-yellow arrowed-in arrowed-right"> Origen: <?php echo $row_table_almacen['origen']; ?> </span>
                                <span class="fa fa-long-arrow-right"></span>
                                <span class="label label-lg label-yellow arrowed-in arrowed-right"> Destino: <?php echo $row_table_almacen['destino']; ?> </span>
                            </div>

                            <?php 
                                $producto = 0; 
                                $producto_name = 0; 
                                $producto_ensamblado = 0; 
                                $producto_ensamblado_name = 0; 
                                $lleva = 0; 
                                $lleva_name = 0; 
                                $devuelve = 0; 
                                $devuelve_name = 0; 
                                $totalX = 0; 
                                $totalX_name = 0; 
                            ?>

                            <input type="hidden" id="totalRows_table" name="totalRows_table" value="<?php echo $totalRows_table; ?>" />
                            <input type="hidden" id="totalRows_table" name="totalRows_table" value="<?php echo $totalRows_table; ?>" />
                            <?php do { ?>
                                <input type="hidden" id="origen" name="origen" value="<?php echo $_GET['origen']; ?>" />
                                <input type="hidden" id="destino" name="destino" value="<?php echo $_GET['destino']; ?>" />
                                <input type="hidden" id="transferencia_id" name="transferencia_id" value="<?php echo $_GET['transferencia_id']; ?>" />
                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-5"><?php echo $row_table['producto']; ?></label>
                                    <input type="hidden" name="producto_id<?php echo $producto_name++; ?>" id="producto_id<?php echo $producto++; ?>" value="<?php echo $row_table['producto_id']; ?>">
                                    <input type="hidden" name="producto_ensamblado_id<?php echo $producto_ensamblado_name++; ?>" id="producto_ensamblado_id<?php echo $producto_ensamblado++; ?>" value="<?php echo $row_table['producto_ensamblado_id']; ?>">

                                    <div class="col-sm-9">
                                        <div class="col-xs-3">
                                            <input type="text" class="col-xs-12" data-rel="tooltip" name="lleva<?php echo $lleva_name++; ?>" id="lleva<?php echo $lleva++; ?>" data-original-title="Tiene" value="<?php echo $row_table['suma_cantidad']; ?>" readonly />
                                        </div>
                                        <div class="col-xs-3">
                                            <input type="text" class="col-xs-12" data-rel="tooltip" name="devuelve<?php echo $devuelve_name++; ?>" id="devuelve<?php echo $devuelve++; ?>" data-original-title="Devuelve" value="<?php echo $row_table['suma_cantidad']; ?>" />
                                        </div>
                                        <div class="col-xs-3">
                                            <input type="text" class="col-xs-12" data-rel="tooltip" name="total<?php echo $totalX_name++; ?>" id="total<?php echo $totalX++; ?>" data-original-title="Diferencia entre lleva y devuelve" value="0" readonly />
                                        </div>  
                                    </div>
                                </div>
                            <?php } while ($row_table = mysql_fetch_assoc($table)); ?>

                            <div class="col-xs-12">
                                <div>
                                    <a href="#" class="btn btn-small" data-dismiss="modal" onclick="fn_cerrar_devolucions();">Cancelar</a>

                                    <button type="submit" class="btn btn-small btn-primary">
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
        console.log(data);
        $.ajax({
            url: '../models/devolucions/devolucions_producto_agregar.php',
            data: data,
            type: 'get',
            success: function(data){
                if(data != "")
                    alert(data);
                fn_cerrar_devolucions_producto();
                fn_buscar_devolucions_producto();
            }
        });
    };

    $("#devuelve0").keyup(function () {
        var $lleva = $("#lleva0").val();
        var $devuelve = $(this).val();
        $resta = $lleva - $devuelve;

        $("#total0").attr("value", ($resta * (-1)));
    });

    $("#devuelve1").keyup(function () {
        var $lleva = $("#lleva1").val();
        var $devuelve = $(this).val();
        $resta = $lleva - $devuelve;

        $("#total1").attr("value", ($resta * (-1)));
    });

    $("#devuelve2").keyup(function () {
        var $lleva = $("#lleva2").val();
        var $devuelve = $(this).val();
        $resta = $lleva - $devuelve;

        $("#total2").attr("value", ($resta * (-1)));
    });

    $("#devuelve3").keyup(function () {
        var $lleva = $("#lleva3").val();
        var $devuelve = $(this).val();
        $resta = $lleva - $devuelve;

        $("#total3").attr("value", ($resta * (-1)));
    });

    $("#devuelve4").keyup(function () {
        var $lleva = $("#lleva4").val();
        var $devuelve = $(this).val();
        $resta = $lleva - $devuelve;

        $("#total4").attr("value", ($resta * (-1)));
    });

    $("#devuelve5").keyup(function () {
        var $lleva = $("#lleva5").val();
        var $devuelve = $(this).val();
        $resta = $lleva - $devuelve;

        $("#total5").attr("value", ($resta * (-1)));
    });

    $("#devuelve6").keyup(function () {
        var $lleva = $("#lleva6").val();
        var $devuelve = $(this).val();
        $resta = $lleva - $devuelve;

        $("#total6").attr("value", ($resta * (-1)));
    });

    // $('#devuelve0').ace_spinner({value:0,min:0,max:1000,step:1, on_sides: true, btn_up_class:'hidden' , btn_down_class:'hidden'});
    // $('#devuelve1').ace_spinner({value:0,min:0,max:1000,step:1, on_sides: true, btn_up_class:'hidden' , btn_down_class:'hidden'});
    // $('#devuelve2').ace_spinner({value:0,min:0,max:1000,step:1, on_sides: true, btn_up_class:'hidden' , btn_down_class:'hidden'});
    // $('#devuelve3').ace_spinner({value:0,min:0,max:1000,step:1, on_sides: true, btn_up_class:'hidden' , btn_down_class:'hidden'});
    // $('#devuelve4').ace_spinner({value:0,min:0,max:1000,step:1, on_sides: true, btn_up_class:'hidden' , btn_down_class:'hidden'});
    // $('#devuelve5').ace_spinner({value:0,min:0,max:1000,step:1, on_sides: true, btn_up_class:'hidden' , btn_down_class:'hidden'});
    // $('#devuelve6').ace_spinner({value:0,min:0,max:1000,step:1, on_sides: true, btn_up_class:'hidden' , btn_down_class:'hidden'});
    // $('#devuelve7').ace_spinner({value:0,min:0,max:1000,step:1, on_sides: true, btn_up_class:'hidden' , btn_down_class:'hidden'});


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