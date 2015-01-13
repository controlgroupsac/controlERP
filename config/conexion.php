<?php
	# FileName="Connection_php_mysql.htm"
	# Type="MYSQL"
	# HTTP="true"
	$hostname_fastERP = "localhost";
	$database_fastERP = "controlg_controlerp";
	$username_fastERP = "controlg_main";
	$password_fastERP = "E40186773.";
	$fastERP = mysql_connect($hostname_fastERP, $username_fastERP, $password_fastERP) or trigger_error(mysql_error(),E_USER_ERROR); 
?>