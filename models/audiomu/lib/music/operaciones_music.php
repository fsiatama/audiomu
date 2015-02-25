<?php
session_start();
include('../../lib/config.php');
include_once(PATH_APP."lib/idioma.php");
include_once(PATH_APP."lib/lib_funciones.php");
include_once(PATH_APP."lib/lib_sesion.php");
include_once(PATH_RAIZ."audiomu/lib/music/musicAdo.php");
$musicAdo = new MusicAdo("audiomu");
$music    = new Music;
if(isset($accion)){
	switch($accion){
		case "act":
			$music->setMusic_id($music_id);
			$music->setMusic_nombre($music_nombre);
			$music->setMusic_archivo($music_archivo);
			$rs_music = $musicAdo->actualizar($music);
			if($rs_music !== true){
				$success = false;
			}
			else{
				$success = true;
			}
			$respuesta = array(
				"success"=>$success,
				"errors"=>array("reason"=>$rs_music)
			);
			echo json_encode($respuesta);
			exit();
		break;
		case "del":
			$music->setMusic_id($music_id);
			$rs_music = $musicAdo->borrar($music);
			if($rs_music !== true){
				$success = false;
			}
			else{
				$success = true;
			}
			$respuesta = array(
				"success"=>$success,
				"errors"=>array("reason"=>$rs_music)
			);
			echo json_encode($respuesta);
			exit();
		break;
		case "crea":
			$music->setMusic_id($music_id);
			$music->setMusic_nombre($music_nombre);
			$music->setMusic_archivo($music_archivo);
			$rs_music = $musicAdo->insertar($music);
			if($rs_music !== true){
				$success = false;
			}
			else{
				$success = true;
			}
			$respuesta = array(
				"success"=>$success,
				"errors"=>array("reason"=>$rs_music)
			);
			echo json_encode($respuesta);
			exit();
		break;
		case "lista":
			$arr = array();
			$music->setMusic_id($music_id);
			$music->setMusic_nombre($music_nombre);
			$music->setMusic_archivo($music_archivo);
			$rs_music = $musicAdo->lista($music);
			if(!is_array($rs_music)){
				$respuesta = array(
					"success"=>false,
					"errors"=>array("reason"=>$rs_music)
				);
				echo json_encode($respuesta);
				exit();
			}
			foreach($rs_music["datos"] as $key => $data){
				$arr[] = sanear_string($data);
			}
			$respuesta = array(
				"success"=>true,
				"total"=>$rs_music["total"],
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
			$rs_music = $musicAdo->lista_filtro($query, $valuesqry, $limit);
			if(!is_array($rs_music)){
				$respuesta = array(
					"success"=>false,
					"errors"=>array("reason"=>$rs_music)
				);
				echo json_encode($respuesta);
				exit();
			}
			elseif($rs_music["total"] == 0){
				$respuesta = array(
					"success"=>false,
					"errors"=>array("reason"=>sanear_string(_NOSEENCONTRARONREGISTROS))
				);
				echo json_encode($respuesta);
				exit();
			}
			else{
				foreach($rs_music["datos"] as $key => $data){
					$arr[] = sanear_string($data);
				}
				$respuesta = array(
					"success"=>true,
					"total"=>$rs_music["total"],
					"datos"=>$arr
				);
				echo json_encode($respuesta);
				exit();
			}
		break;
	}
}
?>
