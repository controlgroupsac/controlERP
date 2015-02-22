<?php 
    include "../../config/conexion.php"; 
    include "../../queries/functions.php"; 

    $almacen_transferencias_detalle_id = $_POST['almacen_transferencias_detalle_id'];
    $transferencia_id = $_POST['transferencia_id'];
    $origen = $_POST['origen'];
    $destino = $_POST['destino'];

    

    /*id del producto ensamblado(kit)*/
    $query_almacen = "SELECT origen.almacen AS origen, destino.almacen AS destino
                      FROM almacen AS origen , almacen AS destino
                      WHERE origen.almacen_id = $origen 
                      AND destino.almacen_id = $destino" ;
    mysql_select_db($database_fastERP, $fastERP);
    $almacen = mysql_query($query_almacen, $fastERP) or die(mysql_error());
    $row_almacen = mysql_fetch_assoc($almacen); 

    /*id del producto ensamblado(kit)*/
    $query_almacen_det = "SELECT almacen_det.cantidad, almacen_det.almacendet_id
                        FROM almacen_det
                        WHERE almacen_det.transferencia_id = $_POST[transferencia_id] 
                        AND almacen_det.producto_id = $_POST[producto_id] " ;
    mysql_select_db($database_fastERP, $fastERP);
    $almacen_det = mysql_query($query_almacen_det_det, $fastERP) or die(mysql_error());
    $row_almacen_det = mysql_fetch_assoc($almacen_det); 



    /*id del producto ensamblado(kit)*/
    $query = "SELECT producto.producto,
                    almacen_transferencias_detalle.cantidad,
                    almacen_transferencias_detalle.faltante,
                    almacen_transferencias_detalle.producto_id,
                    almacen_transferencias_detalle.producto_ensamblado_id,
                    almacen_transferencias_detalle.almacen_transferencias_id
            FROM almacen_transferencias_detalle, producto
            WHERE almacen_transferencias_detalle.producto_id = producto.producto_id 
            AND almacen_transferencias_detalle.almacen_transferencias_detalle_id = $almacen_transferencias_detalle_id " ;
    mysql_select_db($database_fastERP, $fastERP);
    $table = mysql_query($query, $fastERP) or die(mysql_error());
    $totalRows_table = mysql_num_rows($table);
    $row_table = mysql_fetch_assoc($table); 
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
                        <h4 class="blue bigger">Modificar devolucions</h4>
                    </div>
                    <div class="modal-body overflow-visible">
                        <div class="row-fluid">
                            <div class="form-group">
                                <span class="label label-lg arrowed-in arrowed-right"> Devolucion </span>
                            <span class="label label-lg label-yellow arrowed-in arrowed-right"> Origen: <?php echo $row_almacen['origen']; ?> </span>
                                <span class="fa fa-long-arrow-right"></span>
                            <span class="label label-lg label-yellow arrowed-in arrowed-right"> Destino: <?php echo $row_almacen['destino']; ?> </span>
                            </div>

                                <input type="text" id="origen" name="origen" value="<?php echo $_POST['origen']; ?>" />
                                <input type="text" id="destino" name="destino" value="<?php echo $_POST['destino']; ?>" />
                                <input type="text" id="transferencia_id" name="transferencia_id" value="<?php echo $_POST['transferencia_id']; ?>" />
                                <input type="text" id="producto_id" name="producto_id" value="<?php echo $row_table['producto_id']; ?>">
                                <input type="text" id="producto_ensamblado_id" name="producto_ensamblado_id" value="<?php echo $row_table['producto_ensamblado_id']; ?>">

                                <?php do { ?>
                                        
                                <?php } while ($row_almacen_det = mysql_fetch_assoc($almacen_det)); ?>


                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-5"><?php echo $row_table['producto']; ?></label>

                                    <div class="col-sm-9">
                                        <div class="col-xs-3">
                                            <input type="text" class="col-xs-12" data-rel="tooltip" name="devuelto" id="devuelto" data-original-title="DEVUELTO" value="<?php echo abs($row_table['cantidad']); ?>" readonly />
                                        </div>
                                        <div class="col-xs-3">
                                            <input type="text" class="col-xs-12" data-rel="tooltip" name="tiene" id="tiene" data-original-title="TIENE" value="<?php echo abs($row_table['faltante']); ?>" />
                                        </div>
                                        <div class="col-xs-3">
                                            <input type="text" class="col-xs-12" data-rel="tooltip" name="total" id="total" data-original-title="Diferencia entre lo devuelto y lo que tiene" value="0" readonly />
                                        </div>  
                                    </div>
                                </div>
                            

                            <div class="col-xs-12">
                                <div>
                                    <a href="#" class="btn btn-small" data-dismiss="modal" onclick="fn_cerrar_devolucions();">Cancelar</a>

                                    <button type="submit" class="btn btn-small btn-primary">
                                        <i class="fa fa-ok"></i>
                                        Modificar
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
            url: '../models/devolucions/devolucions_producto_modificar.php',
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

    $("#devuelve").keyup(function () {
        var $lleva = $("#lleva").val();
        var $devuelve = $(this).val();
        $resta = $lleva - $devuelve;

        $("#total").attr("value", ($resta * (-1)));
    });

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
</script>