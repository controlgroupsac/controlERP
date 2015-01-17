<?php 
  include "config/conexion.php"; 
  include "queries/functions.php"; 

// *** Validate request to login to this site.
$usuarioEnviado=$_GET['usuario']; $claveEnviado=$_GET['clave'];
mysql_select_db($database_fastERP, $fastERP);
$query_usuarios = "SELECT * FROM `controlg_controlerp`.`usuario` WHERE usuario='$usuarioEnviado' AND clave='$claveEnviado'";
$usuarios = mysql_query($query_usuarios, $fastERP) or die(mysql_error());
$row_usuarios = mysql_fetch_assoc($usuarios);
$totalRows_usuarios = mysql_num_rows($usuarios);

if($row_usuarios['activo'] == "0"){
    header("Location: index.php?usuarioDesconectado='Cuenta deshabilitada o necesita ser aprobada!!'");
}else{
  if (!isset($_SESSION)) {
    session_start();
  }
  
  $loginFormAction = $_SERVER['PHP_SELF'];
  if (isset($_GET['accesscheck'])) {
    $_SESSION['PrevUrl'] = $_GET['accesscheck'];
  }
  $_SESSION['usuario']=$_GET['usuario'];
  $_SESSION['clave']=$_GET['clave'];
  
  if (isset($_GET['usuario'])) {
    $loginUsername=$_GET['usuario'];
    $password=$_GET['clave'];
    $MM_fldUserAuthorization = "";
    $MM_redirectLoginSuccess = "views/index.php?usuario=$_SESSION[usuario]&clave=$_SESSION[clave]";
    $MM_redirectLoginFailed = "index.php";
    $MM_redirecttoReferrer = false;
    mysql_select_db($database_fastERP, $fastERP);
    
    $LoginRS__query=sprintf("SELECT usuario, clave FROM usuario WHERE usuario=%s AND clave=%s",
                             GetSQLValueString($loginUsername, "text"), 
                             GetSQLValueString($password, "text")); 
     
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
}

?>