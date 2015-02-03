<?php
	include("../../config/class.mysql.php");
    include("../../queries/class.combos.php"); 

	$selects = new selects();
	$comprobante = $selects->cargarComprobante_tipo();
	foreach($comprobante as $key=>$value)
	{
		echo "<option value=\"$key\">$value</option>";
	}
?>