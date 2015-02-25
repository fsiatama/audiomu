<?php
include("tipo_usuario.php");
class Tipo_usuarioAdo extends Conexion{
	var $conn;
	function Tipo_usuarioAdo($_bd){
		parent::Conexion($_bd);
	}
	function lista($tipo_usuario){
		$conn = $this->conn;
		$filtro = array();
		foreach($tipo_usuario as $key => $data){
			if ($data <> ''){
				$filtro[] = $key . " = '" . $data ."'";
			}
		}
		$sql  = 'SELECT * FROM tipo_usuario';
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
			$filtro[] = "tipo_usuario_id IN('".implode("','",$query)."')";
		}
		else{
			if(is_array($query)){
				$tmp_query = array_pop($query);
				$filtro[] = "tipo_usuario_id IN('".implode("','",$query)."')";
				$query = $tmp_query;
			}
			else{
				$filtro[] = "(
					   tipo_usuario_id LIKE '%" . $query ."%'
					OR tipo_usuario_nombre LIKE '%" . $query ."%'
				)";
			}
		}
		$sql  = 'SELECT tipo_usuario_id,tipo_usuario_nombre FROM tipo_usuario';
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
	function insertar($tipo_usuario){
		$conn = $this->conn;
		$tipo_usuario_id = $tipo_usuario->getTipo_usuario_id();
		$tipo_usuario_nombre = $tipo_usuario->getTipo_usuario_nombre();
		$sql = "
			INSERT INTO tipo_usuario (
				tipo_usuario_id,
				tipo_usuario_nombre
			)
			VALUES (
				'".$tipo_usuario_id."',
				'".$tipo_usuario_nombre."'
			)
		";
		$rs   = $conn->Execute($sql);
		if(!$rs){
			return $conn->ErrorMsg();
		}
		$rs->Close();
		return true;
	}
	function actualizar($tipo_usuario){
		$conn = $this->conn;
		$tipo_usuario_id = $tipo_usuario->getTipo_usuario_id();
		$tipo_usuario_nombre = $tipo_usuario->getTipo_usuario_nombre();
		$sql = "
			UPDATE tipo_usuario SET
				tipo_usuario_id = '".$tipo_usuario_id."',
				tipo_usuario_nombre = '".$tipo_usuario_nombre."'
			WHERE tipo_usuario_id = '".$tipo_usuario_id."'
		";
		$rs   = $conn->Execute($sql);
		if(!$rs){
			return $conn->ErrorMsg();
		}
		$rs->Close();
		return true;
	}
	function borrar($tipo_usuario){
		$conn = $this->conn;
		$tipo_usuario_id = $tipo_usuario->getTipo_usuario_id();
		$sql  = "DELETE FROM tipo_usuario WHERE tipo_usuario_id = '".$tipo_usuario_id."'";
		$rs   = $conn->Execute($sql);
		if(!$rs){
			return $conn->ErrorMsg();
		}
		$rs->Close();
		return true;
	}
}
?>
