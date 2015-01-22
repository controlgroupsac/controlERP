<?
	include "../../models/conexion.php";
	$usu_per = $_GET['producto'];
	$sql = "SELECT * FROM producto WHERE producto = '$producto'";
	$per = mysql_query($sql);
	$num_rs_per = mysql_num_rows($per);
	if($num_rs_per == 0)
		echo "true";
	else
		echo "false";
?>