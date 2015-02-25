<?php
session_start();
include('../../lib/config.php');
include_once(PATH_APP."lib/idioma.php");
include_once(PATH_APP."lib/lib_funciones.php");
include_once(PATH_APP."lib/lib_sesion.php");
include_once(PATH_RAIZ."audiomu/lib/tipo_contacto/tipo_contactoAdo.php");
$tipo_contactoAdo = new Tipo_contactoAdo("audiomu");
$tipo_contacto    = new Tipo_contacto;
if(isset($accion)){
	switch($accion){
		case "act":
			$tipo_contacto->setTipo_contacto_id($tipo_contacto_id);
			$tipo_contacto->setTipo_contacto_nombre($tipo_contacto_nombre);
			$rs_tipo_contacto = $tipo_contactoAdo->actualizar($tipo_contacto);
			if($rs_tipo_contacto !== true){
				$success = false;
			}
			else{
				$success = true;
			}
			$respuesta = array(
				"success"=>$success,
				"errors"=>array("reason"=>$rs_tipo_contacto)
			);
			echo json_encode($respuesta);
			exit();
		break;
		case "del":
			$tipo_contacto->setTipo_contacto_id($tipo_contacto_id);
			$rs_tipo_contacto = $tipo_contactoAdo->borrar($tipo_contacto);
			if($rs_tipo_contacto !== true){
				$success = false;
			}
			else{
				$success = true;
			}
			$respuesta = array(
				"success"=>$success,
				"errors"=>array("reason"=>$rs_tipo_contacto)
			);
			echo json_encode($respuesta);
			exit();
		break;
		case "crea":
			$tipo_contacto->setTipo_contacto_id($tipo_contacto_id);
			$tipo_contacto->setTipo_contacto_nombre($tipo_contacto_nombre);
			$rs_tipo_contacto = $tipo_contactoAdo->insertar($tipo_contacto);
			if($rs_tipo_contacto !== true){
				$success = false;
			}
			else{
				$success = true;
			}
			$respuesta = array(
				"success"=>$success,
				"errors"=>array("reason"=>$rs_tipo_contacto)
			);
			echo json_encode($respuesta);
			exit();
		break;
		case "lista":
			$arr = array();
			$tipo_contacto->setTipo_contacto_id($tipo_contacto_id);
			$tipo_contacto->setTipo_contacto_nombre($tipo_contacto_nombre);
			$rs_tipo_contacto = $tipo_contactoAdo->lista($tipo_contacto);
			if(!is_array($rs_tipo_contacto)){
				$respuesta = array(
					"success"=>false,
					"errors"=>array("reason"=>$rs_tipo_contacto)
				);
				echo json_encode($respuesta);
				exit();
			}
			foreach($rs_tipo_contacto["datos"] as $key => $data){
				$arr[] = sanear_string($data);
			}
			$respuesta = array(
				"success"=>true,
				"total"=>$rs_tipo_contacto["total"],
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
			$rs_tipo_contacto = $tipo_contactoAdo->lista_filtro($query, $valuesqry, $limit);
			if(!is_array($rs_tipo_contacto)){
				$respuesta = array(
					"success"=>false,
					"errors"=>array("reason"=>$rs_tipo_contacto)
				);
				echo json_encode($respuesta);
				exit();
			}
			elseif($rs_tipo_contacto["total"] == 0){
				$respuesta = array(
					"success"=>false,
					"errors"=>array("reason"=>sanear_string(_NOSEENCONTRARONREGISTROS))
				);
				echo json_encode($respuesta);
				exit();
			}
			else{
				foreach($rs_tipo_contacto["datos"] as $key => $data){
					$arr[] = sanear_string($data);
				}
				$respuesta = array(
					"success"=>true,
					"total"=>$rs_tipo_contacto["total"],
					"datos"=>$arr
				);
				echo json_encode($respuesta);
				exit();
			}
		break;
	}
}
?>
