<?php
class Samples{
	var $samples_id;
	var $samples_nombre;
	var $samples_archivo;
	function samples(){
		//constructor vacio
	}
	function setSamples_id($samples_id){
		$this->samples_id = $samples_id;
	}
	function getSamples_id(){
		return $this->samples_id;
	}
	function setSamples_nombre($samples_nombre){
		$this->samples_nombre = $samples_nombre;
	}
	function getSamples_nombre(){
		return $this->samples_nombre;
	}
	function setSamples_archivo($samples_archivo){
		$this->samples_archivo = $samples_archivo;
	}
	function getSamples_archivo(){
		return $this->samples_archivo;
	}
}
?>