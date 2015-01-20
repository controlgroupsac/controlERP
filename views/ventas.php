<?php  
	include "../config/conexion.php"; 
	include "../config/basico.php";
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>ControlERP</title>

		<meta name="description" content="User login page" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" />
		<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
		<link rel="stylesheet" href="css/main.css" type="text/css" />

		<!-- page specific plugin styles -->
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
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								<?php include("../models/sidebar.php"); ?>


								<!-- Small boxes (Stat box) -->
								<div class="row">
									<div class="col-xs-8">
										<div class="row">
											<div class="col-xs-12">
												<h3>
													<input type="hidden" name="ventas_id" id="ventas_id" value="<?php echo $_GET['ventas_id']; ?>">
													<input type="hidden" name="almacen_id" id="almacen_id" value="<?php echo $_GET['almacen_id']; ?>">
													Ventas
												</h3>
											</div>
											<!-- <div class="col-xs-12">
												<span>Cusqueña 620 ml Caja	</span><br>
												<span>1 * 68,44 = 68,44		</span>
											</div> -->

											<div class="col-xs-12">
												<div class="widget-box">
													<div class="widget-body">
														<div class="widget-main scrollable" data-size="400">
															<div class="tabbable">
																<div id="div_listar_categorias"></div>
																<div id="div_listar_categorias_productos"></div>
																<br>
															</div>
														</div>
													</div>
												</div>
												
											</div><!-- /.col -->
										</div>
									</div>

									<div class="col-xs-4">
										<div class="widget-box">
											<div class="widget-body">
												<div class="widget-main scrollable" data-size="250">
													<div id="div_ventas_det_listar"></div>
													<div class="none" id="div_ventas_det_oculto"></div>													
												</div>
											</div>
										</div>

										<div class="widget-box">

											<div class="widget-header">
											    <h5 class="widget-title bigger lighter">DESCUENTO <span class="right"> 
											        <input type="text" class="form-control text-right" name="descuentoVenta" id="descuentoVenta" value="0" /> </span>
											    </h5>
											</div>

											<div id="div_ventas_det_listar_precios"></div>

											<div class="widget-body">
												<div class="widget-main">
													<button class="btn btn-success btn-block" onclick="javascript: fn_mostrar_frm_ventas_agregar();">REGISTRAR</button>
												</div>
												<div class="none" id="div_ventas_agregar"></div> <!-- POP UP, el cual agrega nuestra venta! -->
											</div>

											<!-- <div class="widget-body">
												<div class="widget-main">
													<table class="table table-striped table-bordered table-hover no-margin-bottom no-border-top">
														<tbody id="tbodyBTN">
															<tr>
																<td rowspan="5">
																	<button class="btn btn-success btn-block" id="registrar-venta">REGISTRAR</button>
																</td>
															</tr>

															<tr>
																<td><button class="btn btn-inverse btn-block">1</button></td>
																<td><button class="btn btn-inverse btn-block">2</button></td>
																<td><button class="btn btn-inverse btn-block">3</button></td>
															</tr>

															<tr>
																<td><button class="btn btn-inverse btn-block">4</button></td>
																<td><button class="btn btn-inverse btn-block">5</button></td>
																<td><button class="btn btn-inverse btn-block">6</button></td>
															</tr>

															<tr>
																<td><button class="btn btn-inverse btn-block">7</button></td>
																<td><button class="btn btn-inverse btn-block">8</button></td>
																<td><button class="btn btn-inverse btn-block">9</button></td>
															</tr>
															<tr>
																<td colspan="3">
																	<button class="btn btn-inverse btn-block border">0</button>
																</td>
															</tr>
														</tbody>
													</table>
												</div>
											</div> -->
										</div>

									</div>
								</div><!-- /.row -->

								

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
				fn_buscar_ventas_categorias();
				fn_buscar_ventas_categorias_productos();
				fn_buscar_ventas_det();
				$("#ventas").addClass("active");
				$("#ventas_view").addClass("active");
			   $("#calendar").datepicker();
			   $('#sidebar2').insertBefore('.page-content').ace_sidebar('collapse', false);
			   $('#navbar').addClass('h-navbar');
			   $('.footer').insertAfter('.page-content');
			
				$('[data-rel=tooltip]').tooltip(); 
				
				//datepicker plugin
				//link
				$('.date-picker').datepicker({
					autoclose: true,
					todayHighlight: true
				})
				//show datepicker when clicking on the icon
				.next().on(ace.click_event, function(){
					$(this).prev().focus();
				});
			
				// scrollables
				$('.scrollable').each(function () {
					var $this = $(this);
					$(this).ace_scroll({
						size: $this.attr('data-size') || 100,
						//styleClass: 'scroll-left scroll-margin scroll-thin scroll-dark scroll-light no-track scroll-visible'
					});
				});
			   
			   $('.page-content').addClass('main-content');
			   
			   $('.menu-toggler[data-target="#sidebar2"]').insertBefore('.navbar-brand');
			   
			   
			   $(document).on('settings.ace.two_menu', function(e, event_name, event_val) {
				 if(event_name == 'sidebar_fixed') {
					 if( $('#sidebar').hasClass('sidebar-fixed') ) $('#sidebar2').addClass('sidebar-fixed')
					 else $('#sidebar2').removeClass('sidebar-fixed')
				 }
			   }).triggerHandler('settings.ace.two_menu', ['sidebar_fixed' ,$('#sidebar').hasClass('sidebar-fixed')]);
			   
			   $('#sidebar2[data-sidebar-hover=true]').ace_sidebar_hover('reset');
			   $('#sidebar2[data-sidebar-scroll=true]').ace_sidebar_scroll('reset', true);
			})
		</script>
	</body>
</html>
