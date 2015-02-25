<?php
include("country.php");
class CountryAdo extends Conexion{
	var $conn;
	function CountryAdo($_bd){
		parent::Conexion($_bd);
	}
	function lista($country){
		$conn = $this->conn;
		$filtro = array();
		foreach($country as $key => $data){
			if ($data <> ''){
				$filtro[] = $key . " = '" . $data ."'";
			}
		}
		$sql  = 'SELECT * FROM country';
		if(!empty($filtro)){
			$sql .= ' WHERE '. implode(' AND ', $filtro);
		}
		$sql .= ' ORDER BY Name ';
		$rs   = $conn->Execute($sql);
		$result = array();
		if(!$rs){
			return $conn->ErrorMsg();
		}
		$total = $rs->RecordCount();
		while(!$rs->EOF){
			$result["datos"][] = $rs->fields;
			$rs->MoveNext();
		}
		$result["total"] = $total;
		$rs->Close();
		return $result;
	}
	function lista_filtro($query, $queryValuesIndicator, $limit){
		$conn = $this->conn;
		$filtro = array();
		if($queryValuesIndicator && is_array($query)){
			$filtro[] = "Code IN('".implode("','",$query)."')";
		}
		else{
			if(is_array($query)){
				$tmp_query = array_pop($query);
				$filtro[] = "Code IN('".implode("','",$query)."')";
				$query = $tmp_query;
			}
			else{
				$filtro[] = "(
					   Code LIKE '%" . $query ."%'
					OR Name LIKE '%" . $query ."%'
					OR Continent LIKE '%" . $query ."%'
					OR Region LIKE '%" . $query ."%'
					OR SurfaceArea LIKE '%" . $query ."%'
					OR IndepYear LIKE '%" . $query ."%'
					OR Population LIKE '%" . $query ."%'
					OR LifeExpectancy LIKE '%" . $query ."%'
					OR GNP LIKE '%" . $query ."%'
					OR GNPOld LIKE '%" . $query ."%'
					OR LocalName LIKE '%" . $query ."%'
					OR GovernmentForm LIKE '%" . $query ."%'
					OR HeadOfState LIKE '%" . $query ."%'
					OR Capital LIKE '%" . $query ."%'
					OR Code2 LIKE '%" . $query ."%'
				)";
			}
		}
		$sql  = 'SELECT Code,Name,Continent,Region,SurfaceArea,IndepYear,Population,LifeExpectancy,GNP,GNPOld,LocalName,GovernmentForm,HeadOfState,Capital,Code2 FROM country';
		if(!empty($filtro)){
			$sql .= ' WHERE '. implode(' AND ', $filtro);
		}
		$result = array();
		if($queryValuesIndicator && is_array($query)){
			$rs = $conn->Execute($sql);
			$result["total"] = $rs->RecordCount();
		}
		elseif($limit != ""){
			$arr_limit = explode(",",$limit);
			$savec = $ADODB_COUNTRECS;
			if($conn->pageExecuteCountRows) $ADODB_COUNTRECS = true;
			$rs = $conn->PageExecute($sql,$arr_limit[1], $arr_limit[0]);
			$ADODB_COUNTRECS = $savec;
			$result["total"] = $rs->_maxRecordCount;
		}
		if(!$rs){
			return $conn->ErrorMsg();
		}
		while(!$rs->EOF){
			$result["datos"][] = $rs->fields;
			$rs->MoveNext();
		}
		$rs->Close();
		return $result;
	}
	function insertar($country){
		$conn = $this->conn;
		$Code = $country->getCode();
		$Name = $country->getName();
		$Continent = $country->getContinent();
		$Region = $country->getRegion();
		$SurfaceArea = $country->getSurfaceArea();
		$IndepYear = $country->getIndepYear();
		$Population = $country->getPopulation();
		$LifeExpectancy = $country->getLifeExpectancy();
		$GNP = $country->getGNP();
		$GNPOld = $country->getGNPOld();
		$LocalName = $country->getLocalName();
		$GovernmentForm = $country->getGovernmentForm();
		$HeadOfState = $country->getHeadOfState();
		$Capital = $country->getCapital();
		$Code2 = $country->getCode2();
		$sql = "
			INSERT INTO country (
				Code,
				Name,
				Continent,
				Region,
				SurfaceArea,
				IndepYear,
				Population,
				LifeExpectancy,
				GNP,
				GNPOld,
				LocalName,
				GovernmentForm,
				HeadOfState,
				Capital,
				Code2
			)
			VALUES (
				'".$Code."',
				'".$Name."',
				'".$Continent."',
				'".$Region."',
				'".$SurfaceArea."',
				'".$IndepYear."',
				'".$Population."',
				'".$LifeExpectancy."',
				'".$GNP."',
				'".$GNPOld."',
				'".$LocalName."',
				'".$GovernmentForm."',
				'".$HeadOfState."',
				'".$Capital."',
				'".$Code2."'
			)
		";
		$rs   = $conn->Execute($sql);
		if(!$rs){
			return $conn->ErrorMsg();
		}
		$rs->Close();
		return true;
	}
	function actualizar($country){
		$conn = $this->conn;
		$Code = $country->getCode();
		$Name = $country->getName();
		$Continent = $country->getContinent();
		$Region = $country->getRegion();
		$SurfaceArea = $country->getSurfaceArea();
		$IndepYear = $country->getIndepYear();
		$Population = $country->getPopulation();
		$LifeExpectancy = $country->getLifeExpectancy();
		$GNP = $country->getGNP();
		$GNPOld = $country->getGNPOld();
		$LocalName = $country->getLocalName();
		$GovernmentForm = $country->getGovernmentForm();
		$HeadOfState = $country->getHeadOfState();
		$Capital = $country->getCapital();
		$Code2 = $country->getCode2();
		$sql = "
			UPDATE country SET
				Code = '".$Code."',
				Name = '".$Name."',
				Continent = '".$Continent."',
				Region = '".$Region."',
				SurfaceArea = '".$SurfaceArea."',
				IndepYear = '".$IndepYear."',
				Population = '".$Population."',
				LifeExpectancy = '".$LifeExpectancy."',
				GNP = '".$GNP."',
				GNPOld = '".$GNPOld."',
				LocalName = '".$LocalName."',
				GovernmentForm = '".$GovernmentForm."',
				HeadOfState = '".$HeadOfState."',
				Capital = '".$Capital."',
				Code2 = '".$Code2."'
			WHERE Code = '".$Code."'
		";
		$rs   = $conn->Execute($sql);
		if(!$rs){
			return $conn->ErrorMsg();
		}
		$rs->Close();
		return true;
	}
	function borrar($country){
		$conn = $this->conn;
		$Code = $country->getCode();
		$sql  = "DELETE FROM country WHERE Code = '".$Code."'";
		$rs   = $conn->Execute($sql);
		if(!$rs){
			return $conn->ErrorMsg();
		}
		$rs->Close();
		return true;
	}
}
?>
