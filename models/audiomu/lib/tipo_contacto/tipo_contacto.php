<?php
class Tipo_contacto{
	var $tipo_contacto_id;
	var $tipo_contacto_nombre;
	function tipo_contacto(){
		//constructor vacio
	}
	function setTipo_contacto_id($tipo_contacto_id){
		$this->tipo_contacto_id = $tipo_contacto_id;
	}
	function getTipo_contacto_id(){
		return $this->tipo_contacto_id;
	}
	function setTipo_contacto_nombre($tipo_contacto_nombre){
		$this->tipo_contacto_nombre = $tipo_contacto_nombre;
	}
	function getTipo_contacto_nombre(){
		return $this->tipo_contacto_nombre;
	}
}
?>