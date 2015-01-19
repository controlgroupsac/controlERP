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



						<div class="page-header">
							<h1>
								Ventas
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								<?php include("../models/sidebar.php"); ?>


								<!-- Small boxes (Stat box) -->
								<div class="row">
									<div class="col-xs-9">
										<div class="row">
											<div class="col-xs-12">
												<span>Cusqueña 620 ml Caja	1 * 68,44 = 68,44	</span><br>
												<span>1 * 68,44 = 68,44		</span>
											</div>

											<div class="col-xs-12">
												<div class="tabbable">
													<ul class="nav nav-tabs padding-12 tab-color-blue background-blue right" id="myTab4">
														<li class="active">
															<a data-toggle="tab" href="#home4">Bebida</a>
														</li>

														<li>
															<a data-toggle="tab" href="#profile4">Categoría Predeterminada</a>
														</li>

														<li>
															<a data-toggle="tab" href="#dropdown14">Embase</a>
														</li>
													</ul>

													<div class="tab-content">
														<div id="home4" class="tab-pane in active">
															
															
																<!-- PAGE CONTENT BEGINS -->
																<div>
																	<ul class="ace-thumbnails clearfix">
																		<li>
																			<a href="assets/images/gallery/image-1.jpg" title="Photo Title" data-rel="colorbox">
																				<img width="150" height="150" alt="150x150" src="assets/images/gallery/thumb-1.jpg" />
																			</a>

																			<div class="tags">
																				<span class="label-holder">
																					<span class="label label-info">breakfast</span>
																				</span>

																				<span class="label-holder">
																					<span class="label label-danger">fruits</span>
																				</span>

																				<span class="label-holder">
																					<span class="label label-success">toast</span>
																				</span>

																				<span class="label-holder">
																					<span class="label label-warning arrowed-in">diet</span>
																				</span>
																			</div>

																			<div class="tools">
																				<a href="#">
																					<i class="ace-icon fa fa-link"></i>
																				</a>

																				<a href="#">
																					<i class="ace-icon fa fa-paperclip"></i>
																				</a>

																				<a href="#">
																					<i class="ace-icon fa fa-pencil"></i>
																				</a>

																				<a href="#">
																					<i class="ace-icon fa fa-times red"></i>
																				</a>
																			</div>
																		</li>

																		<li>
																			<a href="assets/images/gallery/image-2.jpg" data-rel="colorbox">
																				<img width="150" height="150" alt="150x150" src="assets/images/gallery/thumb-2.jpg" />
																				<div class="text">
																					<div class="inner">Sample Caption on Hover</div>
																				</div>
																			</a>
																		</li>

																		<li>
																			<a href="assets/images/gallery/image-3.jpg" data-rel="colorbox">
																				<img width="150" height="150" alt="150x150" src="assets/images/gallery/thumb-3.jpg" />
																				<div class="text">
																					<div class="inner">Sample Caption on Hover</div>
																				</div>
																			</a>

																			<div class="tools tools-bottom">
																				<a href="#">
																					<i class="ace-icon fa fa-link"></i>
																				</a>

																				<a href="#">
																					<i class="ace-icon fa fa-paperclip"></i>
																				</a>

																				<a href="#">
																					<i class="ace-icon fa fa-pencil"></i>
																				</a>

																				<a href="#">
																					<i class="ace-icon fa fa-times red"></i>
																				</a>
																			</div>
																		</li>

																		<li>
																			<a href="assets/images/gallery/image-4.jpg" data-rel="colorbox">
																				<img width="150" height="150" alt="150x150" src="assets/images/gallery/thumb-4.jpg" />
																				<div class="tags">
																					<span class="label-holder">
																						<span class="label label-info arrowed">fountain</span>
																					</span>

																					<span class="label-holder">
																						<span class="label label-danger">recreation</span>
																					</span>
																				</div>
																			</a>

																			<div class="tools tools-top">
																				<a href="#">
																					<i class="ace-icon fa fa-link"></i>
																				</a>

																				<a href="#">
																					<i class="ace-icon fa fa-paperclip"></i>
																				</a>

																				<a href="#">
																					<i class="ace-icon fa fa-pencil"></i>
																				</a>

																				<a href="#">
																					<i class="ace-icon fa fa-times red"></i>
																				</a>
																			</div>
																		</li>

																		<li>
																			<div>
																				<img width="150" height="150" alt="150x150" src="assets/images/gallery/thumb-5.jpg" />
																				<div class="text">
																					<div class="inner">
																						<span>Some Title!</span>

																						<br />
																						<a href="assets/images/gallery/image-5.jpg" data-rel="colorbox">
																							<i class="ace-icon fa fa-search-plus"></i>
																						</a>

																						<a href="#">
																							<i class="ace-icon fa fa-user"></i>
																						</a>

																						<a href="#">
																							<i class="ace-icon fa fa-share"></i>
																						</a>
																					</div>
																				</div>
																			</div>
																		</li>

																		<li>
																			<a href="assets/images/gallery/image-6.jpg" data-rel="colorbox">
																				<img width="150" height="150" alt="150x150" src="assets/images/gallery/thumb-6.jpg" />
																			</a>

																			<div class="tools tools-right">
																				<a href="#">
																					<i class="ace-icon fa fa-link"></i>
																				</a>

																				<a href="#">
																					<i class="ace-icon fa fa-paperclip"></i>
																				</a>

																				<a href="#">
																					<i class="ace-icon fa fa-pencil"></i>
																				</a>

																				<a href="#">
																					<i class="ace-icon fa fa-times red"></i>
																				</a>
																			</div>
																		</li>

																		<li>
																			<a href="assets/images/gallery/image-1.jpg" data-rel="colorbox">
																				<img width="150" height="150" alt="150x150" src="assets/images/gallery/thumb-1.jpg" />
																			</a>

																			<div class="tools">
																				<a href="#">
																					<i class="ace-icon fa fa-link"></i>
																				</a>

																				<a href="#">
																					<i class="ace-icon fa fa-paperclip"></i>
																				</a>

																				<a href="#">
																					<i class="ace-icon fa fa-pencil"></i>
																				</a>

																				<a href="#">
																					<i class="ace-icon fa fa-times red"></i>
																				</a>
																			</div>
																		</li>

																		<li>
																			<a href="assets/images/gallery/image-2.jpg" data-rel="colorbox">
																				<img width="150" height="150" alt="150x150" src="assets/images/gallery/thumb-2.jpg" />
																			</a>

																			<div class="tools tools-top in">
																				<a href="#">
																					<i class="ace-icon fa fa-link"></i>
																				</a>

																				<a href="#">
																					<i class="ace-icon fa fa-paperclip"></i>
																				</a>

																				<a href="#">
																					<i class="ace-icon fa fa-pencil"></i>
																				</a>

																				<a href="#">
																					<i class="ace-icon fa fa-times red"></i>
																				</a>
																			</div>
																		</li>
																	</ul>
																</div><!-- PAGE CONTENT ENDS -->
															<!-- /.col -->
														</div>

														<div id="profile4" class="tab-pane">
															<p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid.</p>
														</div>

														<div id="dropdown14" class="tab-pane">
															<p>Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack lo-fi farm-to-table readymade.</p>
														</div>
													</div>
												</div>
											</div><!-- /.col -->
										</div>
									</div>

									<div class="col-xs-3">
										<div>
											<span>.col-xs-1</span>
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
        <script>window.jQuery || document.write('<script src="views/js/vendor/jquery-1.11.1.min.js"><\/script>')</script>

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


		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			jQuery(function($) {
				$("#ventas").addClass("active");
				$("#ventas_view").addClass("active");
			   $("#calendar").datepicker();
			   $('#sidebar2').insertBefore('.page-content').ace_sidebar('collapse', false);
			   $('#navbar').addClass('h-navbar');
			   $('.footer').insertAfter('.page-content');
			   
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
