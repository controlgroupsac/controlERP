<?php 
    include "../../config/conexion.php"; 
    include "../../queries/functions.php"; 
?>
<select class="chosen-select form-control" name="cliente_id" id="cliente_id">
    <?php query_table_option("SELECT * FROM cliente", "cliente_id", "nombres") ?>
</select>