<?php
include("tipo_contacto.php");
class Tipo_contactoAdo extends Conexion{
	var $conn;
	function Tipo_contactoAdo($_bd){
		parent::Conexion($_bd);
	}
	function lista($tipo_contacto){
		$conn = $this->conn;
		$filtro = array();
		foreach($tipo_contacto as $key => $data){
			if ($data <> ''){
				$filtro[] = $key . " = '" . $data ."'";
			}
		}
		$sql  = 'SELECT * FROM tipo_contacto';
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
			$filtro[] = "tipo_contacto_id IN('".implode("','",$query)."')";
		}
		else{
			if(is_array($query)){
				$tmp_query = array_pop($query);
				$filtro[] = "tipo_contacto_id IN('".implode("','",$query)."')";
				$query = $tmp_query;
			}
			else{
				$filtro[] = "(
					   tipo_contacto_id LIKE '%" . $query ."%'
					OR tipo_contacto_nombre LIKE '%" . $query ."%'
				)";
			}
		}
		$sql  = 'SELECT tipo_contacto_id,tipo_contacto_nombre FROM tipo_contacto';
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
	function insertar($tipo_contacto){
		$conn = $this->conn;
		$tipo_contacto_id = $tipo_contacto->getTipo_contacto_id();
		$tipo_contacto_nombre = $tipo_contacto->getTipo_contacto_nombre();
		$sql = "
			INSERT INTO tipo_contacto (
				tipo_contacto_id,
				tipo_contacto_nombre
			)
			VALUES (
				'".$tipo_contacto_id."',
				'".$tipo_contacto_nombre."'
			)
		";
		$rs   = $conn->Execute($sql);
		if(!$rs){
			return $conn->ErrorMsg();
		}
		$rs->Close();
		return true;
	}
	function actualizar($tipo_contacto){
		$conn = $this->conn;
		$tipo_contacto_id = $tipo_contacto->getTipo_contacto_id();
		$tipo_contacto_nombre = $tipo_contacto->getTipo_contacto_nombre();
		$sql = "
			UPDATE tipo_contacto SET
				tipo_contacto_id = '".$tipo_contacto_id."',
				tipo_contacto_nombre = '".$tipo_contacto_nombre."'
			WHERE tipo_contacto_id = '".$tipo_contacto_id."'
		";
		$rs   = $conn->Execute($sql);
		if(!$rs){
			return $conn->ErrorMsg();
		}
		$rs->Close();
		return true;
	}
	function borrar($tipo_contacto){
		$conn = $this->conn;
		$tipo_contacto_id = $tipo_contacto->getTipo_contacto_id();
		$sql  = "DELETE FROM tipo_contacto WHERE tipo_contacto_id = '".$tipo_contacto_id."'";
		$rs   = $conn->Execute($sql);
		if(!$rs){
			return $conn->ErrorMsg();
		}
		$rs->Close();
		return true;
	}
}
?>
