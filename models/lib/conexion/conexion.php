<?php
$ADODB_CACHE_DIR = PATH_RAIZ.'cache'; 
include(PATH_RAIZ.'adodb5/adodb.inc.php');	   # Carga el codigo comun de ADOdb

class Conexion{
    var $conn;
    function Conexion($bd){
		include(PATH_RAIZ.'lib/config.php');
		$this->conn = ADONewConnection('mysql');	# crea la conexion
		$this->conn->Connect($coneccion[$bd]['server'], $coneccion[$bd]['login'], $coneccion[$bd]['password'], $coneccion[$bd]['bd']);
		$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC; 
    }
}


?>
