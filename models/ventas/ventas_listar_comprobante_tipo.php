<?php
	include("../../config/class.mysql.php");
    include("../../queries/class.combos.php"); 

	$estados = new selects();
	$estados->code = $_GET["code"];
	$estados = $estados->cargarCondicion_pago();
	foreach($estados as $key=>$value){
			echo "<option value=\"$key\">$value</option>";
	}
?>