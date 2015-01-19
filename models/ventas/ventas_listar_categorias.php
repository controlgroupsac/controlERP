<?php  
	include "../../config/conexion.php"; 
    include("../../queries/query.php"); 

    $query = "SELECT * FROM categoria" ;
    mysql_select_db($database_fastERP, $fastERP);
    $table = mysql_query($query, $fastERP) or die(mysql_error());
    $row_table = mysql_fetch_assoc($table);
?>
<ul class="nav nav-tabs padding-12 tab-color-blue background-blue" id="myTab4">
	<?php do { ?>
	<li class=<?php if($row_table['categoria_id'] == 5) { echo "active"; } ?>>
		<a data-toggle="tab" href="<?php echo '#'.$row_table['categoria']; ?>"><?php echo $row_table['categoria']; ?></a>
	</li>
	<?php } while ($row_table = mysql_fetch_assoc($table)); ?>
</ul>