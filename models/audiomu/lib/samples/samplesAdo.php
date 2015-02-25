<?php
include("samples.php");
class SamplesAdo extends Conexion{
	var $conn;
	function SamplesAdo($_bd){
		parent::Conexion($_bd);
	}
	function lista($samples){
		$conn = $this->conn;
		$filtro = array();
		if (!empty($samples)) {
			foreach($samples as $key => $data){
				if ($data <> ''){
					$filtro[] = $key . " = '" . $data ."'";
				}
			}
		}
		$sql  = 'SELECT * FROM samples';
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
			$filtro[] = "samples_id IN('".implode("','",$query)."')";
		}
		else{
			if(is_array($query)){
				$tmp_query = array_pop($query);
				$filtro[] = "samples_id IN('".implode("','",$query)."')";
				$query = $tmp_query;
			}
			else{
				$filtro[] = "(
					   samples_id LIKE '%" . $query ."%'
					OR samples_nombre LIKE '%" . $query ."%'
					OR samples_archivo LIKE '%" . $query ."%'
				)";
			}
		}
		$sql  = 'SELECT samples_id,samples_nombre,samples_archivo FROM samples';
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
	function insertar($samples){
		$conn = $this->conn;
		$samples_id = $samples->getSamples_id();
		$samples_nombre = $samples->getSamples_nombre();
		$samples_archivo = $samples->getSamples_archivo();
		$sql = "
			INSERT INTO samples (
				samples_id,
				samples_nombre,
				samples_archivo
			)
			VALUES (
				'".$samples_id."',
				'".$samples_nombre."',
				'".$samples_archivo."'
			)
		";
		$rs   = $conn->Execute($sql);
		if(!$rs){
			return $conn->ErrorMsg();
		}
		$rs->Close();
		return true;
	}
	function actualizar($samples){
		$conn = $this->conn;
		$samples_id = $samples->getSamples_id();
		$samples_nombre = $samples->getSamples_nombre();
		$samples_archivo = $samples->getSamples_archivo();
		$sql = "
			UPDATE samples SET
				samples_id = '".$samples_id."',
				samples_nombre = '".$samples_nombre."',
				samples_archivo = '".$samples_archivo."'
			WHERE samples_id = '".$samples_id."'
		";
		$rs   = $conn->Execute($sql);
		if(!$rs){
			return $conn->ErrorMsg();
		}
		$rs->Close();
		return true;
	}
	function borrar($samples){
		$conn = $this->conn;
		$samples_id = $samples->getSamples_id();
		$sql  = "DELETE FROM samples WHERE samples_id = '".$samples_id."'";
		$rs   = $conn->Execute($sql);
		if(!$rs){
			return $conn->ErrorMsg();
		}
		$rs->Close();
		return true;
	}
}
?>
