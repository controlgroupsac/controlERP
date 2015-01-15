<?php 
    include "../../config/conexion.php"; 
    include "../../queries/functions.php"; 
?>
<form action="javascript: fn_agregar_categoria();" class="form-horizontal" method="post" id="frm_categoria" enctype="multipart/form-data" >
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" onclick="fn_cerrar_producto();">&times;</button>
        <h4 class="blue bigger">Agregar Categoria</h4>
    </div>
    <div class="modal-body overflow-visible">
        <div class="row-fluid">
            <div class="form-group">
                <label class="col-sm-3 control-label" for="categoria"><b>categoria </b></label>

                <div class="col-sm-9">
                    <span class=" input-icon">
                        <input type="text" class="input-xlarge" name="categoria" id="categoria" placeholder="categoria" value="categoria" required />
                        <i class="ace-icon fa fa-user"></i>
                    </span>
                </div>
            </div>

            <div class="col-xs-12">
                <div>
                    <a href="#" class="btn btn-small" data-dismiss="modal" onclick="fn_cerrar_producto();">Cancelar</a>

                    <button type="submit" class="btn btn-small btn-primary">
                        <i class="fa fa-ok"></i>
                        Agregar
                    </button>
                </div>
                <input type="hidden" name="MM_insert" value="frm_categoria">

            </div>
        </div>
    </div>
</form>
<script language="javascript" type="text/javascript">
    function fn_agregar_categoria(){
        var str = $("#frm_categoria").serialize();
        $.ajax({
            url: '../models/categoria/categoria_agregar.php',
            data: str,
            type: 'post',
            success: function(data){
                if(data != "")
                    alert(data);
                fn_cerrar_producto();
                fn_buscar_categoria();
            }
        });
    };
    
    $('#frm_categoria').validate({
        errorElement: 'span',
        errorClass: 'help-inline',
        focusInvalid: false,
        rules: {
            categoria: {
                required: true
            }
        },

        messages: {
            categoria: {
                required: "<a data-original-title='The last tip!' title='Ingresa un categoria válido.' data-rel='tooltip' href='#'><i class='fa fa-warning-sign'></i></a>"
            }
        }
    });
</script>