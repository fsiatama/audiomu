<?php
session_start();
include('../../lib/config.php');
include_once(PATH_APP."lib/idioma.php");
include_once(PATH_APP."lib/lib_funciones.php");
include_once(PATH_APP."lib/lib_sesion.php");
include_once(PATH_RAIZ."audiomu/lib/tipo_usuario/tipo_usuarioAdo.php");
$tipo_usuarioAdo = new Tipo_usuarioAdo("audiomu");
$tipo_usuario    = new Tipo_usuario;
if(isset($accion)){
	switch($accion){
		case "act":
			$tipo_usuario->setTipo_usuario_id($tipo_usuario_id);
			$tipo_usuario->setTipo_usuario_nombre($tipo_usuario_nombre);
			$rs_tipo_usuario = $tipo_usuarioAdo->actualizar($tipo_usuario);
			if($rs_tipo_usuario !== true){
				$success = false;
			}
			else{
				$success = true;
			}
			$respuesta = array(
				"success"=>$success,
				"errors"=>array("reason"=>$rs_tipo_usuario)
			);
			echo json_encode($respuesta);
			exit();
		break;
		case "del":
			$tipo_usuario->setTipo_usuario_id($tipo_usuario_id);
			$rs_tipo_usuario = $tipo_usuarioAdo->borrar($tipo_usuario);
			if($rs_tipo_usuario !== true){
				$success = false;
			}
			else{
				$success = true;
			}
			$respuesta = array(
				"success"=>$success,
				"errors"=>array("reason"=>$rs_tipo_usuario)
			);
			echo json_encode($respuesta);
			exit();
		break;
		case "crea":
			$tipo_usuario->setTipo_usuario_id($tipo_usuario_id);
			$tipo_usuario->setTipo_usuario_nombre($tipo_usuario_nombre);
			$rs_tipo_usuario = $tipo_usuarioAdo->insertar($tipo_usuario);
			if($rs_tipo_usuario !== true){
				$success = false;
			}
			else{
				$success = true;
			}
			$respuesta = array(
				"success"=>$success,
				"errors"=>array("reason"=>$rs_tipo_usuario)
			);
			echo json_encode($respuesta);
			exit();
		break;
		case "lista":
			$arr = array();
			$tipo_usuario->setTipo_usuario_id($tipo_usuario_id);
			$tipo_usuario->setTipo_usuario_nombre($tipo_usuario_nombre);
			$rs_tipo_usuario = $tipo_usuarioAdo->lista($tipo_usuario);
			if(!is_array($rs_tipo_usuario)){
				$respuesta = array(
					"success"=>false,
					"errors"=>array("reason"=>$rs_tipo_usuario)
				);
				echo json_encode($respuesta);
				exit();
			}
			foreach($rs_tipo_usuario["datos"] as $key => $data){
				$arr[] = sanear_string($data);
			}
			$respuesta = array(
				"success"=>true,
				"total"=>$rs_tipo_usuario["total"],
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
			$rs_tipo_usuario = $tipo_usuarioAdo->lista_filtro($query, $valuesqry, $limit);
			if(!is_array($rs_tipo_usuario)){
				$respuesta = array(
					"success"=>false,
					"errors"=>array("reason"=>$rs_tipo_usuario)
				);
				echo json_encode($respuesta);
				exit();
			}
			elseif($rs_tipo_usuario["total"] == 0){
				$respuesta = array(
					"success"=>false,
					"errors"=>array("reason"=>sanear_string(_NOSEENCONTRARONREGISTROS))
				);
				echo json_encode($respuesta);
				exit();
			}
			else{
				foreach($rs_tipo_usuario["datos"] as $key => $data){
					$arr[] = sanear_string($data);
				}
				$respuesta = array(
					"success"=>true,
					"total"=>$rs_tipo_usuario["total"],
					"datos"=>$arr
				);
				echo json_encode($respuesta);
				exit();
			}
		break;
	}
}
?>
