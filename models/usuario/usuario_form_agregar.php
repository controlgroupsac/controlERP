<form action="javascript: fn_agregar_usuario();" method="post" id="frm_usuario">
    <input type="hidden" id="fecha_registro" name="fecha_registro" value="<?php echo date("Y/m/d H:i:s"); ?>" />
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" onclick="fn_cerrar();">&times;</button>
        <h4 class="blue bigger">Agregar usuario</h4>
    </div>
    <div class="modal-body overflow-visible">
        <div class="row-fluid">
            <div class="col-xs-6">
                <div class="form-group">
                    <label class="control-label" for="usuario"><b>usuario </b></label>

                    <div>
                        <span class="input-icon">
                            <input type="text" name="usuario" id="usuario" value="usuario" />
                            <i class="ace-icon fa fa-user"></i>
                        </span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label" for="clave"><b>clave </b></label>

                    <div>
                        <span class="input-icon">
                            <input type="password" name="clave" id="clave" value="password">
                            <i class="ace-icon fa fa-lock"></i>
                        </span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label" for="nombres"><b>nombres </b></label>

                    <div>
                        <span class="input-icon">
                            <input type="text" name="nombres" id="nombres" value="nombres" />
                            <i class="ace-icon fa fa-user"></i>
                        </span>
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label" for="direccion"><b>direccion </b></label>

                    <div>
                        <span class="input-icon">
                            <input type="text" name="direccion" id="direccion" value="direccion" />
                            <i class="ace-icon fa fa-user"></i>
                        </span>
                    </div>
                </div>   

                <div class="form-group">
                    <label class="control-label" for="telefono1"><b>Telefono 1 </b></label>

                    <div>
                        <span class="input-icon">
                            <input type="text" name="telefono1" id="telefono1" value="telefono1" />
                            <i class="ace-icon fa fa-user"></i>
                        </span>
                    </div>
                </div>  

                <div class="form-group">
                    <label class="control-label" for="nivel"><b>nivel </b></label>

                    <div>
                        <span>
                            <i class="ace-icon fa fa-user"></i>

                            <select id="nivel" name="nivel">
                                <option value="1">admin</option>
                                <option value="2">user</option>
                            </select>
                        </span>
                    </div>
                </div> 
            </div>
            <div class="col-xs-6">

                <div class="form-group">
                    <label class="control-label" for="email"><b>email </b></label>

                    <div>
                        <span class="input-icon">
                            <input type="text" name="email" id="email" value="admin@gmail.com" />
                            <i class="ace-icon fa fa-user"></i>
                        </span>
                    </div>
                </div>  

                <div class="form-group">
                    <label class="control-label" for="repetir_clave"><b>repetir_clave </b></label>

                    <div>
                        <span class="input-icon">
                            <input type="password" name="repetir_clave" id="repetir_clave" value="password">
                            <i class="ace-icon fa fa-user"></i>
                        </span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label" for="apellidos"><b>apellidos </b></label>

                    <div>
                        <span class="input-icon">
                            <input type="text" name="apellidos" id="apellidos" value="apellidos" />
                            <i class="ace-icon fa fa-user"></i>
                        </span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label" for="fecha_nac"><b>F. Nacimiento </b></label>

                    <div>
                        <span class="input-icon">
                            <input type="datetime" name="fecha_nac" id="fecha_nac" value="<?php echo date("Y/m/d H:i:s"); ?>">
                            <i class="ace-icon fa fa-user"></i>
                        </span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label" for="telefono2"><b>Telefono 2 </b></label>

                    <div>
                        <span class="input-icon">
                            <input type="text" name="telefono2" id="telefono2" value="telefono2" />
                            <i class="ace-icon fa fa-user"></i>
                        </span>
                    </div>
                </div>

                <div class="form-group col-xs-6">
                    <label for="activo"><b>activo</b></label>

                    <div>
                        <label>
                            <input name="activo" name="activo" class="ace ace-switch ace-switch-5" type="checkbox" />
                            <span class="lbl"></span>
                        </label>
                    </div>
                </div>

                <div class="form-group col-xs-6">
                    <label for="sexo"><b>sexo</b></label>

                    <div>
                        <label>
                            <input name="sexo" type="radio" class="ace" value="M" checked />
                            <span class="lbl"><strong> M</strong></span>
                        </label>
                        &nbsp;&nbsp; &nbsp;&nbsp;
                        <label>
                            <input name="sexo" type="radio" class="ace" value="F">
                            <span class="lbl"><strong> F</strong></span>
                        </label>
                        &nbsp;&nbsp;&nbsp;&nbsp;
                    </div>
                </div>

                <div>
                    <a href="#" class="btn btn-small" data-dismiss="modal" onclick="fn_cerrar();">Cancelar</a>

                    <button type="submit" class="btn btn-small btn-primary">
                        <i class="fa fa-ok"></i>
                        Agregar
                    </button>
                </div>
                <input type="hidden" name="MM_insert" value="frm_usuario">

            </div>
        </div>
    </div>
</form>
<script language="javascript" type="text/javascript">
    function fn_agregar_usuario(){
        var str = $("#frm_usuario").serialize();
        $.ajax({
            url: '../models/usuario/usuario_agregar.php',
            data: str,
            type: 'post',
            success: function(data){
                if(data != "")
                    alert(data);
                fn_cerrar_();
                fn_buscar_usuario();
            }
        });
    };

    $('#frm_usuario').validate({
        errorElement: 'span',
        errorClass: 'help-inline',
        focusInvalid: false,
        rules: {
            email: {
                required: true,
                email:true
            },
            clave: {
                required: true,
                minlength: 4
            },
            repetir_clave: {
                required: true,
                minlength: 4,
                equalTo: "#clave"
            },
            usuario: {
                required: true
            },
            nombres: {
                required: true
            },
            apellidos: {
                required: true
            }
        },

        messages: {
            email: {
                required: "<a data-original-title='The last tip!' title='Ingresa un email válido.' data-rel='tooltip' href='#'><i class='fa fa-warning-sign'></i></a>",
                email: "<a data-original-title='The last tip!' title='Ingresa un email válido.' data-rel='tooltip' href='#'><i class='fa fa-warning-sign'></i></a>"
            },
            clave: {
                required: "<a data-original-title='The last tip!' title='Por favor, especifique una contraseña.' data-rel='tooltip' href='#'><i class='fa fa-warning-sign'></i></a>",
                minlength: "<a data-original-title='The last tip!' title='Debe tener al menos 4 caracteres.' data-rel='tooltip' href='#'><i class='fa fa-warning-sign'></i></a>."
            },
            repetir_clave: {
                required: "<a data-original-title='The last tip!' title='Por favor, especifique una contraseña' data-rel='tooltip' href='#'><i class='fa fa-warning-sign'></i></a>",
                minlength: "<a data-original-title='The last tip!' title='Debe tener al menos 4 caracteres.' data-rel='tooltip' href='#'><i class='fa fa-warning-sign'></i></a>",
                equalTo: "<a data-original-title='The last tip!' title='Por favor, introduzca la misma contraseña que el anterior' data-rel='tooltip' href='#'><i class='fa fa-remove-sign red'></i></a>"
            },
            usuario: "<a data-original-title='The last tip!' title='No deje en blanco este campo' data-rel='tooltip' href='#'><i class='fa fa-warning-sign'></i></a>",
            nombres: "<a data-original-title='The last tip!' title='No deje en blanco este campo' data-rel='tooltip' href='#'><i class='fa fa-warning-sign'></i></a>",
            apellidos: "<a data-original-title='The last tip!' title='No deje en blanco este campo' data-rel='tooltip' href='#'><i class='fa fa-warning-sign'></i></a>"
        }
    });
</script>