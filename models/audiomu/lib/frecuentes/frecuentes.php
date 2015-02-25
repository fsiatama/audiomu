<?php
class Frecuentes{
	var $frecuentes_id;
	var $frecuentes_pregunta;
	var $frecuentes_respuesta;
	function frecuentes(){
		//constructor vacio
	}
	function setFrecuentes_id($frecuentes_id){
		$this->frecuentes_id = $frecuentes_id;
	}
	function getFrecuentes_id(){
		return $this->frecuentes_id;
	}
	function setFrecuentes_pregunta($frecuentes_pregunta){
		$this->frecuentes_pregunta = $frecuentes_pregunta;
	}
	function getFrecuentes_pregunta(){
		return $this->frecuentes_pregunta;
	}
	function setFrecuentes_respuesta($frecuentes_respuesta){
		$this->frecuentes_respuesta = $frecuentes_respuesta;
	}
	function getFrecuentes_respuesta(){
		return $this->frecuentes_respuesta;
	}
}
?>