<?php
include("frecuentes.php");
class FrecuentesAdo extends Conexion{
	var $conn;
	function FrecuentesAdo($_bd){
		parent::Conexion($_bd);
	}
	function lista($frecuentes){
		$conn = $this->conn;
		$filtro = array();
		foreach($frecuentes as $key => $data){
			if ($data <> ''){
				$filtro[] = $key . " = '" . $data ."'";
			}
		}
		$sql  = 'SELECT * FROM frecuentes';
		if(!empty($filtro)){
			$sql .= ' WHERE '. implode(' AND ', $filtro);
		}
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
			$filtro[] = "frecuentes_id IN('".implode("','",$query)."')";
		}
		else{
			if(is_array($query)){
				$tmp_query = array_pop($query);
				$filtro[] = "frecuentes_id IN('".implode("','",$query)."')";
				$query = $tmp_query;
			}
			else{
				$filtro[] = "(
					   frecuentes_id LIKE '%" . $query ."%'
					OR frecuentes_pregunta LIKE '%" . $query ."%'
					OR frecuentes_respuesta LIKE '%" . $query ."%'
				)";
			}
		}
		$sql  = 'SELECT frecuentes_id,frecuentes_pregunta,frecuentes_respuesta FROM frecuentes';
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
	function insertar($frecuentes){
		$conn = $this->conn;
		$frecuentes_id = $frecuentes->getFrecuentes_id();
		$frecuentes_pregunta = $frecuentes->getFrecuentes_pregunta();
		$frecuentes_respuesta = $frecuentes->getFrecuentes_respuesta();
		$sql = "
			INSERT INTO frecuentes (
				frecuentes_id,
				frecuentes_pregunta,
				frecuentes_respuesta
			)
			VALUES (
				'".$frecuentes_id."',
				'".$frecuentes_pregunta."',
				'".$frecuentes_respuesta."'
			)
		";
		$rs   = $conn->Execute($sql);
		if(!$rs){
			return $conn->ErrorMsg();
		}
		$rs->Close();
		return true;
	}
	function actualizar($frecuentes){
		$conn = $this->conn;
		$frecuentes_id = $frecuentes->getFrecuentes_id();
		$frecuentes_pregunta = $frecuentes->getFrecuentes_pregunta();
		$frecuentes_respuesta = $frecuentes->getFrecuentes_respuesta();
		$sql = "
			UPDATE frecuentes SET
				frecuentes_id = '".$frecuentes_id."',
				frecuentes_pregunta = '".$frecuentes_pregunta."',
				frecuentes_respuesta = '".$frecuentes_respuesta."'
			WHERE frecuentes_id = '".$frecuentes_id."'
		";
		$rs   = $conn->Execute($sql);
		if(!$rs){
			return $conn->ErrorMsg();
		}
		$rs->Close();
		return true;
	}
	function borrar($frecuentes){
		$conn = $this->conn;
		$frecuentes_id = $frecuentes->getFrecuentes_id();
		$sql  = "DELETE FROM frecuentes WHERE frecuentes_id = '".$frecuentes_id."'";
		$rs   = $conn->Execute($sql);
		if(!$rs){
			return $conn->ErrorMsg();
		}
		$rs->Close();
		return true;
	}
}
?>
