<?php
session_start();
include('../../lib/config.php');
include_once(PATH_APP."lib/idioma.php");
include_once(PATH_APP."lib/lib_funciones.php");
include_once(PATH_APP."lib/lib_sesion.php");
include_once(PATH_RAIZ."audiomu/lib/country/countryAdo.php");
$countryAdo = new CountryAdo("audiomu");
$country    = new Country;
if(isset($accion)){
	switch($accion){
		case "act":
			$country->setCode($Code);
			$country->setName($Name);
			$country->setContinent($Continent);
			$country->setRegion($Region);
			$country->setSurfaceArea($SurfaceArea);
			$country->setIndepYear($IndepYear);
			$country->setPopulation($Population);
			$country->setLifeExpectancy($LifeExpectancy);
			$country->setGNP($GNP);
			$country->setGNPOld($GNPOld);
			$country->setLocalName($LocalName);
			$country->setGovernmentForm($GovernmentForm);
			$country->setHeadOfState($HeadOfState);
			$country->setCapital($Capital);
			$country->setCode2($Code2);
			$rs_country = $countryAdo->actualizar($country);
			if($rs_country !== true){
				$success = false;
			}
			else{
				$success = true;
			}
			$respuesta = array(
				"success"=>$success,
				"errors"=>array("reason"=>$rs_country)
			);
			echo json_encode($respuesta);
			exit();
		break;
		case "del":
			$country->setCode($Code);
			$rs_country = $countryAdo->borrar($country);
			if($rs_country !== true){
				$success = false;
			}
			else{
				$success = true;
			}
			$respuesta = array(
				"success"=>$success,
				"errors"=>array("reason"=>$rs_country)
			);
			echo json_encode($respuesta);
			exit();
		break;
		case "crea":
			$country->setCode($Code);
			$country->setName($Name);
			$country->setContinent($Continent);
			$country->setRegion($Region);
			$country->setSurfaceArea($SurfaceArea);
			$country->setIndepYear($IndepYear);
			$country->setPopulation($Population);
			$country->setLifeExpectancy($LifeExpectancy);
			$country->setGNP($GNP);
			$country->setGNPOld($GNPOld);
			$country->setLocalName($LocalName);
			$country->setGovernmentForm($GovernmentForm);
			$country->setHeadOfState($HeadOfState);
			$country->setCapital($Capital);
			$country->setCode2($Code2);
			$rs_country = $countryAdo->insertar($country);
			if($rs_country !== true){
				$success = false;
			}
			else{
				$success = true;
			}
			$respuesta = array(
				"success"=>$success,
				"errors"=>array("reason"=>$rs_country)
			);
			echo json_encode($respuesta);
			exit();
		break;
		case "lista":
			$arr = array();
			$country->setCode($Code);
			$country->setName($Name);
			$country->setContinent($Continent);
			$country->setRegion($Region);
			$country->setSurfaceArea($SurfaceArea);
			$country->setIndepYear($IndepYear);
			$country->setPopulation($Population);
			$country->setLifeExpectancy($LifeExpectancy);
			$country->setGNP($GNP);
			$country->setGNPOld($GNPOld);
			$country->setLocalName($LocalName);
			$country->setGovernmentForm($GovernmentForm);
			$country->setHeadOfState($HeadOfState);
			$country->setCapital($Capital);
			$country->setCode2($Code2);
			$rs_country = $countryAdo->lista($country);
			if(!is_array($rs_country)){
				$respuesta = array(
					"success"=>false,
					"errors"=>array("reason"=>$rs_country)
				);
				echo json_encode($respuesta);
				exit();
			}
			foreach($rs_country["datos"] as $key => $data){
				$arr[] = sanear_string($data);
			}
			$respuesta = array(
				"success"=>true,
				"total"=>$rs_country["total"],
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
			$rs_country = $countryAdo->lista_filtro($query, $valuesqry, $limit);
			if(!is_array($rs_country)){
				$respuesta = array(
					"success"=>false,
					"errors"=>array("reason"=>$rs_country)
				);
				echo json_encode($respuesta);
				exit();
			}
			elseif($rs_country["total"] == 0){
				$respuesta = array(
					"success"=>false,
					"errors"=>array("reason"=>sanear_string(_NOSEENCONTRARONREGISTROS))
				);
				echo json_encode($respuesta);
				exit();
			}
			else{
				foreach($rs_country["datos"] as $key => $data){
					$arr[] = sanear_string($data);
				}
				$respuesta = array(
					"success"=>true,
					"total"=>$rs_country["total"],
					"datos"=>$arr
				);
				echo json_encode($respuesta);
				exit();
			}
		break;
	}
}
?>
