<?php
class Music{
	var $music_id;
	var $music_nombre;
	var $music_archivo;
	function music(){
		//constructor vacio
	}
	function setMusic_id($music_id){
		$this->music_id = $music_id;
	}
	function getMusic_id(){
		return $this->music_id;
	}
	function setMusic_nombre($music_nombre){
		$this->music_nombre = $music_nombre;
	}
	function getMusic_nombre(){
		return $this->music_nombre;
	}
	function setMusic_archivo($music_archivo){
		$this->music_archivo = $music_archivo;
	}
	function getMusic_archivo(){
		return $this->music_archivo;
	}
}
?>