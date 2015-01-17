<?php  
	include "../config/conexion.php"; 
	include "../config/basico.php";

	if (!isset($_SESSION)) {
	  session_start();
	}

// *** Validate request to login to this site.
$usuario=$_SESSION['usuario'];
$clave=$_SESSION['clave'];
$ultimo_acceso=date("Y-m-d H:m:s");

  $updateSQL = sprintf("UPDATE usuario SET ultimo_acceso='%s' WHERE usuario='%s' AND clave='%s'",
                       fn_filtro($ultimo_acceso),
                       fn_filtro(strtoupper($usuario)),
                       fn_filtro(strtoupper($clave))
               );

  mysql_select_db($database_fastERP, $fastERP);
  $Result1 = mysql_query($updateSQL, $fastERP) or die(mysql_error());



// *** Validate request to login to this site.


if (isset($_GET['usuario'])) {
  $loginUsername=$_GET['usuario'];
  $password=$_GET['clave'];
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "index.php";
  $MM_redirectLoginFailed = "../index.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_fastERP, $fastERP);
  
  $LoginRS__query=sprintf("SELECT usuario, clave FROM usuario WHERE usuario='%s' AND clave='%s'",
    					  fn_filtro($loginUsername), 
    					  fn_filtro($password)); 
   
  $LoginRS = mysql_query($LoginRS__query, $fastERP) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);

  if ($loginFoundUser) {
     $loginStrGroup = "";
    
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
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



						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								<?php include("../models/sidebar.php"); ?>


								<!-- Small boxes (Stat box) -->
								<div class="row">
								    <div class="col-lg-2 col-xs-6">
								        <!-- small box -->
								        <div class="small-box bg-blue">
								            <div class="icon">
								                <a href="#" class="text-light-gray"><i class="fa fa-file-text-o"></i></a>
								            </div>
								            <div class="inner">
								                <h4> <br>Nueva</h4>
								                <h6>Orden de venta </h6>
								            </div>
								            <a href="#" class="small-box-footer">
								                Más información <i class="fa fa-arrow-circle-right"></i>
								            </a>
								        </div>
								    </div><!-- ./col -->
								    <div class="col-lg-3 col-xs-6">
								        <!-- small box -->
								        <div class="small-box bg-aqua">
								            <div class="inner">
								                <h3><span class="text-lg">S/.</span> 150 </h3>
								                <p> Sub Total </p>
								            </div>
								            <div class="icon">
								                <i class="fa fa-briefcase"></i>
								            </div>
								            <a href="#" class="small-box-footer">
								                Más información <i class="fa fa-arrow-circle-right"></i>
								            </a>
								        </div>
								    </div><!-- ./col -->
								    <div class="col-lg-3 col-xs-6">
								        <!-- small box -->
								        <div class="small-box bg-red">
								            <div class="inner">
								                <h3>
								                    <span class="text-lg">S/.</span> 53
								                </h3>
								                <p> Saldo </p>
								            </div>
								            <div class="icon">
								                <i class="fa fa-briefcase"></i>
								            </div>
								            <a href="#" class="small-box-footer">
								                Más información <i class="fa fa-arrow-circle-right"></i>
								            </a>
								        </div>
								    </div><!-- ./col -->
								    <div class="col-lg-2 col-xs-6">
								        <!-- small box -->
								        <div class="small-box bg-gray">
								            <div class="icon">
								                <i class="fa fa-gear"></i>
								            </div>
								            <div class="inner">
								                <h3>Nuevo &nbsp;&nbsp;</h3>
								                <h4>Cliente</h4>
								            </div>
								            <a href="#" class="small-box-footer">
								                Crear Cliente <i class="fa fa-arrow-circle-right"></i>
								            </a>
								        </div>
								    </div><!-- ./col -->
								    <div class="col-lg-2 col-xs-6">
								        <!-- small box -->
								        <div class="small-box bg-gray">
								            <div class="icon">
								                <i class="fa fa-gear"></i>
								            </div>
								            <div class="inner">
								                <h3>Nuevo &nbsp;&nbsp;</h3>
								                <h4>Socio</h4>
								            </div>
								            <a href="#" class="small-box-footer">
								                Crear Socio <i class="fa fa-arrow-circle-right"></i>
								            </a>
								        </div>
								    </div><!-- ./col -->
								</div><!-- /.row -->>


								<!-- Small boxes (Stat box) -->
								<div class="row">
								    <div class="col-lg-3 col-xs-6">
								        <!-- small box -->
								        <div class="small-box bg-aqua">
								            <div class="inner">
								                <h3> 150 </h3>
								                <p> Sub Total </p>
								            </div>
								            <div class="icon">
								                <i class="ion ion-bag"></i>
								            </div>
								            <a href="#" class="small-box-footer">
								                Más información <i class="fa fa-arrow-circle-right"></i>
								            </a>
								        </div>
								    </div><!-- ./col -->
								    <div class="col-lg-3 col-xs-6">
								        <!-- small box -->
								        <div class="small-box bg-green">
								            <div class="inner">
								                <h3> 53<sup style="font-size: 20px">%</sup> </h3>
								                <p> Saldo </p>
								            </div>
								            <div class="icon">
								                <i class="ion ion-bag"></i>
								            </div>
								            <a href="#" class="small-box-footer">
								                Más información <i class="fa fa-arrow-circle-right"></i>
								            </a>
								        </div>
								    </div><!-- ./col -->
								    <div class="col-lg-3 col-xs-6">
								        <!-- small box -->
								        <div class="small-box bg-yellow">
								            <div class="inner">
								                <h3>
								                    44
								                </h3>
								                <p>
								                    User Registrations
								                </p>
								            </div>
								            <div class="icon">
								                <i class="ion ion-person-add"></i>
								            </div>
								            <a href="#" class="small-box-footer">
								                Más información <i class="fa fa-arrow-circle-right"></i>
								            </a>
								        </div>
								    </div><!-- ./col -->
								    <div class="col-lg-3 col-xs-6">
								        <!-- small box -->
								        <!-- Calendar -->
        								<div class="box box-solid bg-green-gradient">
        								    <div class="box-body no-padding">
        								        <!--The calendar -->
        								        <div id="calendar" style="width: 100%"></div>
        								    </div><!-- /.box-body -->  
        								</div><!-- /.box --> 
								    </div><!-- ./col -->
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
