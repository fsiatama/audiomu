<?php
session_start();
include('../../lib/config.php');
include_once(PATH_APP."lib/idioma.php");
include_once(PATH_APP."lib/lib_funciones.php");
include_once(PATH_APP."lib/lib_sesion.php");
include_once(PATH_RAIZ."audiomu/lib/samples/samplesAdo.php");
$samplesAdo = new SamplesAdo("audiomu");
$samples    = new Samples;
if(isset($accion)){
	switch($accion){
		case "act":
			$samples->setSamples_id($samples_id);
			$samples->setSamples_nombre($samples_nombre);
			$samples->setSamples_archivo($samples_archivo);
			$rs_samples = $samplesAdo->actualizar($samples);
			if($rs_samples !== true){
				$success = false;
			}
			else{
				$success = true;
			}
			$respuesta = array(
				"success"=>$success,
				"errors"=>array("reason"=>$rs_samples)
			);
			echo json_encode($respuesta);
			exit();
		break;
		case "del":
			$samples->setSamples_id($samples_id);
			$rs_samples = $samplesAdo->borrar($samples);
			if($rs_samples !== true){
				$success = false;
			}
			else{
				$success = true;
			}
			$respuesta = array(
				"success"=>$success,
				"errors"=>array("reason"=>$rs_samples)
			);
			echo json_encode($respuesta);
			exit();
		break;
		case "crea":
			$samples->setSamples_id($samples_id);
			$samples->setSamples_nombre($samples_nombre);
			$samples->setSamples_archivo($samples_archivo);
			$rs_samples = $samplesAdo->insertar($samples);
			if($rs_samples !== true){
				$success = false;
			}
			else{
				$success = true;
			}
			$respuesta = array(
				"success"=>$success,
				"errors"=>array("reason"=>$rs_samples)
			);
			echo json_encode($respuesta);
			exit();
		break;
		case "lista":
			$arr = array();
			$samples->setSamples_id($samples_id);
			$samples->setSamples_nombre($samples_nombre);
			$samples->setSamples_archivo($samples_archivo);
			$rs_samples = $samplesAdo->lista($samples);
			if(!is_array($rs_samples)){
				$respuesta = array(
					"success"=>false,
					"errors"=>array("reason"=>$rs_samples)
				);
				echo json_encode($respuesta);
				exit();
			}
			foreach($rs_samples["datos"] as $key => $data){
				$arr[] = sanear_string($data);
			}
			$respuesta = array(
				"success"=>true,
				"total"=>$rs_samples["total"],
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
			$rs_samples = $samplesAdo->lista_filtro($query, $valuesqry, $limit);
			if(!is_array($rs_samples)){
				$respuesta = array(
					"success"=>false,
					"errors"=>array("reason"=>$rs_samples)
				);
				echo json_encode($respuesta);
				exit();
			}
			elseif($rs_samples["total"] == 0){
				$respuesta = array(
					"success"=>false,
					"errors"=>array("reason"=>sanear_string(_NOSEENCONTRARONREGISTROS))
				);
				echo json_encode($respuesta);
				exit();
			}
			else{
				foreach($rs_samples["datos"] as $key => $data){
					$arr[] = sanear_string($data);
				}
				$respuesta = array(
					"success"=>true,
					"total"=>$rs_samples["total"],
					"datos"=>$arr
				);
				echo json_encode($respuesta);
				exit();
			}
		break;
	}
}
?>
