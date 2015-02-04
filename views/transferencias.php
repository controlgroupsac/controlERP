<?php  
	include "../config/conexion.php"; 
    $query = "SELECT * FROM almacen_transferencia" ;
    mysql_select_db($database_fastERP, $fastERP);
    $table = mysql_query($query, $fastERP) or die(mysql_error());
    $totalRows_table = mysql_num_rows($table);
    $row_table = mysql_fetch_assoc($table);
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>ControlERP</title>

		<meta name="description" content="ventas" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" />
		<link rel="stylesheet" href="fonts/css/font-awesome.min.css" />
		<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
		<link rel="stylesheet" href="css/main.css" type="text/css" />

		<!-- page specific plugin styles -->
		<link rel="stylesheet" href="css/chosen.min.css" />
		<link rel="stylesheet" href="css/datepicker.min.css" />

		<!-- text fonts -->
		<link rel="stylesheet" href="fonts/fonts.googleapis.com.css" />

		<!-- ace styles -->
		<link rel="stylesheet" href="css/ace.min.css" />
		<link rel="stylesheet" href="css/ace-rtl.min.css" />
		
		<!-- ace settings handler -->
		<script src="js/vendor/ace-extra.min.js"></script>
	</head>

	<body class="no-skin">
		<?php include("../models/header.php"); ?>

		<div class="main-container" id="main-container">
			

			<?php include("../models/navbar.php"); ?>

			<div class="main-content">
				<div class="main-content-inner">
					<div class="page-content">


						<!-- /.ace-settings-container -->



						<div class="row">
							<!-- <div class="col-xs-12" id="div_compra_registro"> -->
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								<?php include("../models/sidebar.php"); ?>


								<!-- Small boxes (Stat box) -->
								<div class="row">
									<!-- Datos de los Clientes -->
									<div class="col-xs-12 widget-container-col">
										<form action="javascript: fn_buscar_transferencias();" class="form-inline disabled" method="post" id="frm_buscar_transferencias">
											<div class="col-xs-3">
												<span class="label label-lg label-pink arrowed-right">Transferencias</span>
											</div>
											<div class="col-xs-9 text-left">
												<label class="control-label no-padding-right" for="origen"> Origen </label>
												<select class="chosen-select col-xs-2" name="origen" id="origen">
													<?php query_table_option("SELECT * FROM almacen", "almacen_id", "almacen") ?>
												</select>

												<label class=" control-label no-padding-right" for="destino"> 
													<span class="fa fa-long-arrow-right"></span>
													destino 
												</label>
												<select class="chosen-select col-xs-2" name="destino" id="destino">
													<?php query_table_option("SELECT * FROM almacen", "almacen_id", "almacen") ?>
												</select>

												<button type="submit" class="btn btn-info btn-sm" id="crear_transferencias">
													<i class="ace-icon fa fa-key bigger-110"></i>Crear Transferencia
												</button>
											</div>
										</form>
									</div><!--/span-->
								</div>
								
								<hr />
								<div class="row">
									<!-- Datos de los Ventas -->
									<div class="col-xs-12 widget-container-col" id="div_listar_transferencias"></div>
								</div>

								<div id="div_compra_formulario"></div>

								<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->

			<?php include("../models/footer.php"); ?>

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->

		<!-- basic scripts -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<!--[if !IE]> -->
		<script type="text/javascript">
			window.jQuery || document.write("<script src='js/vendor/jquery.min.js'>"+"<"+"/script>");
		</script>

		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='js/vendor/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="js/vendor/bootstrap.min.js"></script>

		<!-- page specific plugin scripts -->
		<script src="js/vendor/chosen.jquery.min.js"></script>

		<!-- ace scripts -->
		<script src="js/vendor/ace-elements.min.js"></script>
		<script src="js/vendor/ace.min.js"></script>


		<!-- daterangepicker -->
		<script src="js/vendor/daterangepicker.min.js" type="text/javascript"></script>
		<!-- datepicker -->
		<script src="js/vendor/bootstrap-datepicker.min.js" type="text/javascript"></script>


		<!-- blockUI -->
        <script language="javascript" type="text/javascript" src="js/vendor/jquery.blockUI.js"></script>
        <script language="javascript" type="text/javascript" src="js/vendor/jquery.validate-1.11.1.min.js"></script>
        <script src="js/main.js"></script>


		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			
			jQuery(function($) {
				$("#ventas").addClass("active");
				$("#ventas_tranfer").addClass("active");

				/*Choosen select*/
				$('.chosen-select').chosen();

				$('[data-rel=tooltip]').tooltip();
				
				/*datepicker plugin
				link*/
				$('.date-picker').datepicker({
					autoclose: true,
					todayHighlight: true
				})
				/*show datepicker when clicking on the icon*/
				.next().on(ace.click_event, function(){
					$(this).prev().focus();
				});
			
			   $('#sidebar2').insertBefore('.page-content').ace_sidebar('collapse', true);
			   $('#navbar').addClass('h-navbar');
			   $('.footer').insertAfter('.page-content');
			   
			   $('.page-content').addClass('main-content');
			   
			   $('.menu-toggler[data-target="#sidebar2"]').insertBefore('.navbar-brand');  
			
				// scrollables
				$('.scrollable').each(function () {
					var $this = $(this);
					$(this).ace_scroll({
						size: $this.attr('data-size') || 100,
						//styleClass: 'scroll-left scroll-margin scroll-thin scroll-dark scroll-light no-track scroll-visible'
					});
				});
			})
		</script>
	</body>
</html>

