<?php 
    include "../../config/conexion.php"; 
    include "../../queries/functions.php"; 
?>
<style type="text/css">
    .chosen-container {
        width: 250px !important;
    }
</style>
<form action="javascript: fn_agregar_ventas_registro();" class="form-horizontal" method="post" id="frm_ventas_registro" enctype="multipart/form-data" >
    <input type="hidden" id="ventas_id" name="ventas_id" value="1" />
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" onclick="fn_cerrar_ventas();">&times;</button>
        <h4 class="blue bigger">Agregar Venta</h4>
    </div>
    <div class="modal-body overflow-visible">
        <div class="row-fluid">
            <div class="form-group">
                <label class="col-sm-3 control-label" for="almacen_id"><b>almacen </b></label>

                <div class="col-sm-9">
                    <select class="chosen-select form-control" name="almacen_id" id="almacen_id">
                        <?php query_table_option("SELECT * FROM almacen WHERE almacen_id <> 1", "almacen_id", "almacen") ?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label" for="cliente_id"><b>cliente </b></label>

                <div class="col-sm-9">
                    <select class="chosen-select form-control" name="cliente_id" id="cliente_id">
                        <?php query_table_option("SELECT cliente_id, CONCAT(cliente.nombres, ' ' ,cliente.apellidos) AS nombre_apellidos FROM cliente", "cliente_id", "nombre_apellidos") ?>
                    </select>
                </div>
            </div>

            <div class="col-xs-12">
                <div>
                    <a href="#" class="btn btn-small" data-dismiss="modal" onclick="fn_cerrar_ventas();">Cancelar</a>

                    <button type="submit" class="btn btn-small btn-primary">
                        <i class="fa fa-ok"></i>
                        Agregar
                    </button>
                </div>
                <input type="hidden" name="MM_insert" value="frm_ventas_registro">

            </div>
        </div>
    </div>
</form>
<script language="javascript" type="text/javascript">
    $(".chosen-select").chosen({no_results_text: "Oops, no existe!"}); 

    function fn_agregar_ventas_registro(){
        var str = $("#frm_ventas_registro").serialize();
        $.ajax({
            url: '../models/ventas_registro/ventas_registro_agregar.php',
            data: str,
            type: 'post',
            success: function(data){
                if(data != "")
                    alert(data);
                fn_cerrar_ventas();
                fn_buscar_ventas_registro();
            }
        });
    };
</script>