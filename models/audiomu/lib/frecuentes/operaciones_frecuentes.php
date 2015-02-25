<?php
session_start();
include('../../lib/config.php');
include_once(PATH_APP."lib/idioma.php");
include_once(PATH_APP."lib/lib_funciones.php");
include_once(PATH_APP."lib/lib_sesion.php");
include_once(PATH_RAIZ."audiomu/lib/frecuentes/frecuentesAdo.php");
$frecuentesAdo = new FrecuentesAdo("audiomu");
$frecuentes    = new Frecuentes;
if(isset($accion)){
	switch($accion){
		case "act":
			$frecuentes->setFrecuentes_id($frecuentes_id);
			$frecuentes->setFrecuentes_pregunta($frecuentes_pregunta);
			$frecuentes->setFrecuentes_respuesta($frecuentes_respuesta);
			$rs_frecuentes = $frecuentesAdo->actualizar($frecuentes);
			if($rs_frecuentes !== true){
				$success = false;
			}
			else{
				$success = true;
			}
			$respuesta = array(
				"success"=>$success,
				"errors"=>array("reason"=>$rs_frecuentes)
			);
			echo json_encode($respuesta);
			exit();
		break;
		case "del":
			$frecuentes->setFrecuentes_id($frecuentes_id);
			$rs_frecuentes = $frecuentesAdo->borrar($frecuentes);
			if($rs_frecuentes !== true){
				$success = false;
			}
			else{
				$success = true;
			}
			$respuesta = array(
				"success"=>$success,
				"errors"=>array("reason"=>$rs_frecuentes)
			);
			echo json_encode($respuesta);
			exit();
		break;
		case "crea":
			$frecuentes->setFrecuentes_id($frecuentes_id);
			$frecuentes->setFrecuentes_pregunta($frecuentes_pregunta);
			$frecuentes->setFrecuentes_respuesta($frecuentes_respuesta);
			$rs_frecuentes = $frecuentesAdo->insertar($frecuentes);
			if($rs_frecuentes !== true){
				$success = false;
			}
			else{
				$success = true;
			}
			$respuesta = array(
				"success"=>$success,
				"errors"=>array("reason"=>$rs_frecuentes)
			);
			echo json_encode($respuesta);
			exit();
		break;
		case "lista":
			$arr = array();
			$frecuentes->setFrecuentes_id($frecuentes_id);
			$frecuentes->setFrecuentes_pregunta($frecuentes_pregunta);
			$frecuentes->setFrecuentes_respuesta($frecuentes_respuesta);
			$rs_frecuentes = $frecuentesAdo->lista($frecuentes);
			if(!is_array($rs_frecuentes)){
				$respuesta = array(
					"success"=>false,
					"errors"=>array("reason"=>$rs_frecuentes)
				);
				echo json_encode($respuesta);
				exit();
			}
			foreach($rs_frecuentes["datos"] as $key => $data){
				$arr[] = sanear_string($data);
			}
			$respuesta = array(
				"success"=>true,
				"total"=>$rs_frecuentes["total"],
				"datos"=>$arr
			);
			echo json_encode($respuesta);
			exit();
		break;
		case "lista_filtro":
			$arr = array();
			$start = (isset($start))?$start:0;
			$limit = (isset($limit))?$limit:MAXREGEXCEL;
			$page = ($start==0)?1:($start/$limit)+1;
			$limit = $page . ", " . $limit;
			$rs_frecuentes = $frecuentesAdo->lista_filtro($query, $valuesqry, $limit);
			if(!is_array($rs_frecuentes)){
				$respuesta = array(
					"success"=>false,
					"errors"=>array("reason"=>$rs_frecuentes)
				);
				echo json_encode($respuesta);
				exit();
			}
			elseif($rs_frecuentes["total"] == 0){
				$respuesta = array(
					"success"=>false,
					"errors"=>array("reason"=>sanear_string(_NOSEENCONTRARONREGISTROS))
				);
				echo json_encode($respuesta);
				exit();
			}
			else{
				foreach($rs_frecuentes["datos"] as $key => $data){
					$arr[] = sanear_string($data);
				}
				$respuesta = array(
					"success"=>true,
					"total"=>$rs_frecuentes["total"],
					"datos"=>$arr
				);
				echo json_encode($respuesta);
				exit();
			}
		break;
	}
}
?>
