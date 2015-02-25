<?php
class Tipo_usuario{
	var $tipo_usuario_id;
	var $tipo_usuario_nombre;
	function tipo_usuario(){
		//constructor vacio
	}
	function setTipo_usuario_id($tipo_usuario_id){
		$this->tipo_usuario_id = $tipo_usuario_id;
	}
	function getTipo_usuario_id(){
		return $this->tipo_usuario_id;
	}
	function setTipo_usuario_nombre($tipo_usuario_nombre){
		$this->tipo_usuario_nombre = $tipo_usuario_nombre;
	}
	function getTipo_usuario_nombre(){
		return $this->tipo_usuario_nombre;
	}
}
?>