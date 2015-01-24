<?php 
    include "../../config/conexion.php"; 
    include "../../queries/functions.php"; 
?>
<form action="javascript: fn_agregar_producto();" method="post" id="frm_producto" enctype="multipart/form-data" >
    <input type="hidden" id="fecha_registro" name="fecha_registro" value="<?php echo date("Y/m/d H:i:s"); ?>" />
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" onclick="fn_cerrar_producto();">&times;</button>
        <h4 class="blue bigger">Agregar producto</h4>
    </div>
    <div class="modal-body overflow-visible">
        <div class="row-fluid">
            <div class="col-xs-12">
                <div class="col-xs-8">
                    <div class="form-group">
                        <label class="control-label" for="producto"><b>producto </b></label>

                        <div>
                            <span class=" input-icon">
                                <input type="text" class="input-xlarge uppercase" name="producto" id="producto" placeholder="Digite su producto" autofocus />
                                <i class="ace-icon fa fa-user"></i>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="col-xs-4">
                    <div class="form-group">
                        <label class="control-label" for="unidad"><b>unidad </b></label>

                        <div>
                            <span>
                                <select id="unidad_id" name="unidad_id">
                                    <?php query_table_option("SELECT * FROM unidad", "unidad_id", "unidad"); ?>
                                </select>
                            </span>
                        </div>
                    </div> 
                </div>
            </div>

            <div class="col-xs-12">
                <div class="col-xs-4">
                    <div class="form-group">
                        <label class="control-label" for="moneda"><b>moneda </b></label>

                        <div>
                            <span>
                                <select id="moneda_id" name="moneda_id">
                                    <?php query_table_option("SELECT * FROM moneda", "moneda_id", "moneda"); ?>
                                </select>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="col-xs-3">
                    <div class="form-group">
                        <label class="control-label" for="categoria"><b>categoria </b></label>

                        <div>
                            <span>
                                <select id="categoria_id" name="categoria_id">
                                    <?php query_table_option("SELECT * FROM categoria", "categoria_id", "categoria"); ?>
                                </select>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="col-xs-5">
                    <div class="form-group">
                        <label class="control-label" for="imp_tipo"><b>Impuesto </b></label>

                        <div>
                            <span>
                                <select id="imp_tipo_id" name="imp_tipo_id">
                                    <?php query_table_option("SELECT * FROM imp_tipo", "imp_tipo_id", "descripcion"); ?>
                                </select>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xs-12"> 
                <div class="form-group col-xs-8">

                    <div>
                        <span class="input-icon">
                            <input type="text" class="input-xlarge uppercase" name="num_serie" id="num_serie" placeholder="Numero de serie" value="" />
                            <i class="ace-icon fa fa-user"></i>
                        </span>
                    </div>
                </div>

                <div class="form-group col-xs-4">
                    <div>
                        <span class="input-icon">
                            <input type="text" class="input-small" name="precio" id="precio" placeholder="S/. 0.00" value="" />
                            <i class="ace-icon fa fa-user"></i>
                        </span>
                    </div>
                </div>
            </div>
    
            <div class="col-xs-12"> 
                <div class="form-group col-xs-6">
                    <br><br>
                    <label for="estado"><b>Estado</b></label>

                    <div>
                        <label>
                            <input name="activo" id="activo1" type="radio" class="ace" value="1" checked />
                            <span class="lbl"><strong> Activo</strong></span>
                        </label>
                        &nbsp;&nbsp; &nbsp;&nbsp;
                        <label>
                            <input name="activo" id="activo2" type="radio" class="ace" value="0">
                            <span class="lbl"><strong> Inactivo</strong></span>
                        </label>
                        &nbsp;&nbsp;&nbsp;&nbsp;
                    </div>
                </div>

                <div class="form-group col-xs-6">
                    <div class="">
                        <input multiple="" type="file" name="imagen"id="imagen" />
                    </div>
                </div>
            </div>

            <div class="col-xs-12">
                <div>
                    <span class="input-icon">
                        <textarea name="notas" id="notas" cols="60" rows="2" class="uppercase" placeholder="Agregue una nota aquí..."></textarea>
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
                <input type="hidden" name="MM_insert" value="frm_producto">

            </div>
        </div>
    </div>
</form>
<script type="text/javascript">
    var producto = document.getElementById('producto');
    var unidad_id = document.getElementById('unidad_id');
    var moneda_id = document.getElementById('moneda_id');
    var categoria_id = document.getElementById('categoria_id');
    var imp_tipo_id = document.getElementById('imp_tipo_id');
    var activo1 = document.getElementById('activo1');
    var activo2 = document.getElementById('activo2');
    var num_serie = document.getElementById('num_serie');
    var precio = document.getElementById('precio');
    var notas = document.getElementById('notas');

    function fn_agregar_producto(){
        var inputFileImage = document.getElementById("imagen");
        var file = inputFileImage.files[0];
        var data = new FormData();

        if(activo1.checked){
            activo = 1;
        }
        if(activo2.checked) {
            activo = 0;
        }

        data.append('imagen',file);
        data.append('producto',producto.value);
        data.append('unidad_id',unidad_id.value);
        data.append('moneda_id',moneda_id.value);
        data.append('categoria_id',categoria_id.value);
        data.append('imp_tipo_id',imp_tipo_id.value);
        data.append('activo', activo);
        data.append('num_serie',num_serie.value);
        data.append('precio',precio.value);
        data.append('notas',notas.value);

        console.log(data);
        $.ajax({
            url: '../models/producto/producto_agregar.php',
            type: 'POST',
            contentType: false,
            data: data,
            processData: false,
            cache: false,
            success: function(data){
                if(data != "")
                    alert(data);
                fn_cerrar_producto();
                fn_buscar_producto();
            }
        });
    };
    
    $('#imagen').ace_file_input({
        style:'well',
        btn_choose:'Drop files here or click to choose',
        btn_change:null,
        no_icon:'ace-icon fa fa-cloud-upload',
        droppable:true,
        thumbnail:'large'//large | fit
        //,icon_remove:null//set null, to hide remove/reset button
        /**,before_change:function(files, dropped) {
            //Check an example below
            //or examples/file-upload.html
            return true;
        }*/
        /**,before_remove : function() {
            return true;
        }*/
        ,
        preview_error : function(filename, error_code) {
            //name of the file that failed
            //error_code values
            //1 = 'FILE_LOAD_FAILED',
            //2 = 'IMAGE_LOAD_FAILED',
            //3 = 'THUMBNAIL_FAILED'
            //alert(error_code);
        }
    
    }).on('change', function(){
        //console.log($(this).data('ace_input_files'));
        //console.log($(this).data('ace_input_method'));
    });
    
    
    //$('#imagen')
    //.ace_file_input('show_file_list', [
        //{type: 'image', name: 'name of image', path: 'http://path/to/image/for/preview'},
        //{type: 'file', name: 'hello.txt'}
    //]);

    $('#frm_producto').validate({
        errorElement: 'span',
        errorClass: 'help-inline',
        focusInvalid: false,
        rules: {
            producto: {
                required: true
            },
            precio: {
                required: true
            }
        },

        messages: {
            producto: {
                required: "<a data-original-title='The last tip!' title='Ingresa un producto válido.' data-rel='tooltip' href='#'><i class='fa fa-warning-sign'></i></a>"
            },
            precio: {
                required: "<a data-original-title='The last tip!' title='Ingresa un precio válido.' data-rel='tooltip' href='#'><i class='fa fa-warning-sign'></i></a>"
            }
        }
    });
</script>