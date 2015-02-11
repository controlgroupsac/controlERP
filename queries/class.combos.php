<?php
	class selects extends MySQL {
		var $code = "";
		function cargarComprobante_tipo(){
			$consulta = parent::consulta("SELECT * FROM comprobante_tipo");
			$num_total_registros = parent::num_rows($consulta);
			if($num_total_registros > 0)
			{
				$sistemas = array();
				while($sistema = parent::fetch_assoc($consulta)){
					$code = $sistema["comprobante_tipo_id"];
					$name = $sistema["comprobante_tipo"];
					$sistemas[$code]=$name;
				}
				return $sistemas;
			} else {
				return false;
			}
		}

		function cargarCondicion_pago() {
			$consulta = parent::consulta("SELECT comprobante.serie, comprobante.comprobante_id
										  FROM comprobante, comprobante_tipo
										  WHERE comprobante.comprobante_tipo_id = comprobante_tipo.comprobante_tipo_id AND comprobante.comprobante_tipo_id  = '".$this->code."'");
			$num_total_registros = parent::num_rows($consulta);
			if($num_total_registros>0)
			{
				$detalles = array();
				while($detalle = parent::fetch_assoc($consulta)){
					$code = $detalle["comprobante_id"];
					$name = $detalle["serie"];
					$detalles[$code]=$name;
				}
				return $detalles;
			} else {
				return false;
			}
		}
	}
?>