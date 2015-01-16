<?php
	include "../../models/conexion.php";
	$compra_det = $_GET['compra_det'];
	$sql = "SELECT * FROM `controlg_controlerp`.`compra_det` WHERE compra_det = '$compra_det'";
	$per = mysql_query($sql);
	$num_rs_per = mysql_num_rows($per);
	if($num_rs_per == 0)
		echo "true";
	else
		echo "false";
?>