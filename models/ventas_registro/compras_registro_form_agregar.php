<?php 
    include "../../config/conexion.php"; 
    include "../../queries/functions.php"; 
?>
<form action="javascript: fn_agregar_compra_registro();" class="form-horizontal" method="post" id="frm_compra_registro" enctype="multipart/form-data" >
    <input type="hidden" id="compra_id" name="compra_id" value="1" />
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" onclick="fn_cerrar_compra();">&times;</button>
        <h4 class="blue bigger">Agregar Compra</h4>
    </div>
    <div class="modal-body overflow-visible">
        <div class="row-fluid">
            <div class="form-group">
                <label class="col-sm-3 control-label" for="proveedor_id"><b>proveedor </b></label>

                <div class="col-sm-9">
                    <select class="form-control" name="proveedor_id" id="proveedor_id">
                        <?php query_table_option("SELECT * FROM proveedor", "proveedor_id", "proveedor") ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="almacen_id"><b>almacen </b></label>

                <div class="col-sm-9">
                    <select class="form-control" name="almacen_id" id="almacen_id">
                        <?php query_table_option("SELECT * FROM almacen", "almacen_id", "almacen") ?>
                    </select>
                </div>
            </div>

            <div class="col-xs-12">
                <div>
                    <a href="#" class="btn btn-small" data-dismiss="modal" onclick="fn_cerrar_compra();">Cancelar</a>

                    <button type="submit" class="btn btn-small btn-primary">
                        <i class="fa fa-ok"></i>
                        Agregar
                    </button>
                </div>
                <input type="hidden" name="MM_insert" value="frm_compra_registro">

            </div>
        </div>
    </div>
</form>
<script language="javascript" type="text/javascript">
    function fn_agregar_compra_registro(){
        var str = $("#frm_compra_registro").serialize();
        console.log(str);
        $.ajax({
            url: '../models/compra_registro/compras_registro_agregar.php',
            data: str,
            type: 'post',
            success: function(data){
                if(data != "")
                    alert(data);
                fn_cerrar_compra();
                fn_buscar_compras_registro();
            }
        });
    };
</script>