<?php

function fn_filtro($cadena) {
	if(get_magic_quotes_gpc() != 0) {
		$cadena = stripslashes($cadena);
	}
	return mysql_real_escape_string($cadena);
}

?>