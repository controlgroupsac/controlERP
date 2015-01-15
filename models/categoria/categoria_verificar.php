<?
	include "../../models/conexion.php";
	$usu_per = $_GET['categoria'];
	$sql = "SELECT * FROM categoria WHERE categoria = '$categoria'";
	$per = mysql_query($sql);
	$num_rs_per = mysql_num_rows($per);
	if($num_rs_per == 0)
		echo "true";
	else
		echo "false";
?>