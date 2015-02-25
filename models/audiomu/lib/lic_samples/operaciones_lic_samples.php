<?php
session_start();
include('../../lib/config.php');
include_once(PATH_APP."lib/idioma.php");
include_once(PATH_APP."lib/lib_funciones.php");
include_once(PATH_APP."lib/lib_sesion.php");
include_once(PATH_RAIZ."audiomu/lib/lic_samples/lic_samplesAdo.php");
$lic_samplesAdo = new Lic_samplesAdo("audiomu");
$lic_samples    = new Lic_samples;
if(isset($accion)){
	switch($accion){
		case "act":
			$lic_samples->setLic_samples_id($lic_samples_id);
			$lic_samples->setLic_samples_nombre($lic_samples_nombre);
			$lic_samples->setLic_samples_ident($lic_samples_ident);
			$lic_samples->setLic_samples_email($lic_samples_email);
			$lic_samples->setLic_samples_sample_id($lic_samples_sample_id);
			$lic_samples->setLic_samples_desc($lic_samples_desc);
			$lic_samples->setLic_samples_preg1($lic_samples_preg1);
			$lic_samples->setLic_samples_porq1($lic_samples_porq1);
			$lic_samples->setLic_samples_preg2($lic_samples_preg2);
			$lic_samples->setLic_samples_porq2($lic_samples_porq2);
			$lic_samples->setLic_samples_preg3($lic_samples_preg3);
			$lic_samples->setLic_samples_disponible1($lic_samples_disponible1);
			$lic_samples->setLic_samples_disponible2($lic_samples_disponible2);
			$lic_samples->setLic_samples_disponible3($lic_samples_disponible3);
			$lic_samples->setLic_samples_disponible4($lic_samples_disponible4);
			$lic_samples->setLic_samples_disponible5($lic_samples_disponible5);
			$lic_samples->setLic_samples_disponible6($lic_samples_disponible6);
			$lic_samples->setLic_samples_finsert($lic_samples_finsert);
			$lic_samples->setLic_samples_key($lic_samples_key);
			$lic_samples->setLic_samples_descargada($lic_samples_descargada);
			$lic_samples->setLic_samples_fdescarga($lic_samples_fdescarga);
			$rs_lic_samples = $lic_samplesAdo->actualizar($lic_samples);
			if($rs_lic_samples !== true){
				$success = false;
			}
			else{
				$success = true;
			}
			$respuesta = array(
				"success"=>$success,
				"errors"=>array("reason"=>$rs_lic_samples)
			);
			echo json_encode($respuesta);
			exit();
		break;
		case "del":
			$lic_samples->setLic_samples_id($lic_samples_id);
			$rs_lic_samples = $lic_samplesAdo->borrar($lic_samples);
			if($rs_lic_samples !== true){
				$success = false;
			}
			else{
				$success = true;
			}
			$respuesta = array(
				"success"=>$success,
				"errors"=>array("reason"=>$rs_lic_samples)
			);
			echo json_encode($respuesta);
			exit();
		break;
		case "crea":
			$lic_samples->setLic_samples_id($lic_samples_id);
			$lic_samples->setLic_samples_nombre($lic_samples_nombre);
			$lic_samples->setLic_samples_ident($lic_samples_ident);
			$lic_samples->setLic_samples_email($lic_samples_email);
			$lic_samples->setLic_samples_sample_id($lic_samples_sample_id);
			$lic_samples->setLic_samples_desc($lic_samples_desc);
			$lic_samples->setLic_samples_preg1($lic_samples_preg1);
			$lic_samples->setLic_samples_porq1($lic_samples_porq1);
			$lic_samples->setLic_samples_preg2($lic_samples_preg2);
			$lic_samples->setLic_samples_porq2($lic_samples_porq2);
			$lic_samples->setLic_samples_preg3($lic_samples_preg3);
			$lic_samples->setLic_samples_disponible1($lic_samples_disponible1);
			$lic_samples->setLic_samples_disponible2($lic_samples_disponible2);
			$lic_samples->setLic_samples_disponible3($lic_samples_disponible3);
			$lic_samples->setLic_samples_disponible4($lic_samples_disponible4);
			$lic_samples->setLic_samples_disponible5($lic_samples_disponible5);
			$lic_samples->setLic_samples_disponible6($lic_samples_disponible6);
			$lic_samples->setLic_samples_finsert($lic_samples_finsert);
			$lic_samples->setLic_samples_key($lic_samples_key);
			$lic_samples->setLic_samples_descargada($lic_samples_descargada);
			$lic_samples->setLic_samples_fdescarga($lic_samples_fdescarga);
			$rs_lic_samples = $lic_samplesAdo->insertar($lic_samples);
			if($rs_lic_samples !== true){
				$success = false;
			}
			else{
				$success = true;
			}
			$respuesta = array(
				"success"=>$success,
				"errors"=>array("reason"=>$rs_lic_samples)
			);
			echo json_encode($respuesta);
			exit();
		break;
		case "lista":
			$arr = array();
			$lic_samples->setLic_samples_id($lic_samples_id);
			$lic_samples->setLic_samples_nombre($lic_samples_nombre);
			$lic_samples->setLic_samples_ident($lic_samples_ident);
			$lic_samples->setLic_samples_email($lic_samples_email);
			$lic_samples->setLic_samples_sample_id($lic_samples_sample_id);
			$lic_samples->setLic_samples_desc($lic_samples_desc);
			$lic_samples->setLic_samples_preg1($lic_samples_preg1);
			$lic_samples->setLic_samples_porq1($lic_samples_porq1);
			$lic_samples->setLic_samples_preg2($lic_samples_preg2);
			$lic_samples->setLic_samples_porq2($lic_samples_porq2);
			$lic_samples->setLic_samples_preg3($lic_samples_preg3);
			$lic_samples->setLic_samples_disponible1($lic_samples_disponible1);
			$lic_samples->setLic_samples_disponible2($lic_samples_disponible2);
			$lic_samples->setLic_samples_disponible3($lic_samples_disponible3);
			$lic_samples->setLic_samples_disponible4($lic_samples_disponible4);
			$lic_samples->setLic_samples_disponible5($lic_samples_disponible5);
			$lic_samples->setLic_samples_disponible6($lic_samples_disponible6);
			$lic_samples->setLic_samples_finsert($lic_samples_finsert);
			$lic_samples->setLic_samples_key($lic_samples_key);
			$lic_samples->setLic_samples_descargada($lic_samples_descargada);
			$lic_samples->setLic_samples_fdescarga($lic_samples_fdescarga);
			$rs_lic_samples = $lic_samplesAdo->lista($lic_samples);
			if(!is_array($rs_lic_samples)){
				$respuesta = array(
					"success"=>false,
					"errors"=>array("reason"=>$rs_lic_samples)
				);
				echo json_encode($respuesta);
				exit();
			}
			foreach($rs_lic_samples["datos"] as $key => $data){
				$arr[] = sanear_string($data);
			}
			$respuesta = array(
				"success"=>true,
				"total"=>$rs_lic_samples["total"],
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
			$rs_lic_samples = $lic_samplesAdo->lista_filtro($query, $valuesqry, $limit);
			if(!is_array($rs_lic_samples)){
				$respuesta = array(
					"success"=>false,
					"errors"=>array("reason"=>$rs_lic_samples)
				);
				echo json_encode($respuesta);
				exit();
			}
			elseif($rs_lic_samples["total"] == 0){
				$respuesta = array(
					"success"=>false,
					"errors"=>array("reason"=>sanear_string(_NOSEENCONTRARONREGISTROS))
				);
				echo json_encode($respuesta);
				exit();
			}
			else{
				foreach($rs_lic_samples["datos"] as $key => $data){
					$arr[] = sanear_string($data);
				}
				$respuesta = array(
					"success"=>true,
					"total"=>$rs_lic_samples["total"],
					"datos"=>$arr
				);
				echo json_encode($respuesta);
				exit();
			}
		break;
	}
}
?>
