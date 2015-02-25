<?php
include("music.php");
class MusicAdo extends Conexion{
	var $conn;
	function MusicAdo($_bd){
		parent::Conexion($_bd);
	}
	function lista($music){
		$conn = $this->conn;
		$filtro = array();
		foreach($music as $key => $data){
			if ($data <> ''){
				$filtro[] = $key . " = '" . $data ."'";
			}
		}
		$sql  = 'SELECT * FROM music';
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
			$filtro[] = "music_id IN('".implode("','",$query)."')";
		}
		else{
			if(is_array($query)){
				$tmp_query = array_pop($query);
				$filtro[] = "music_id IN('".implode("','",$query)."')";
				$query = $tmp_query;
			}
			else{
				$filtro[] = "(
					   music_id LIKE '%" . $query ."%'
					OR music_nombre LIKE '%" . $query ."%'
					OR music_archivo LIKE '%" . $query ."%'
				)";
			}
		}
		$sql  = 'SELECT music_id,music_nombre,music_archivo FROM music';
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
	function insertar($music){
		$conn = $this->conn;
		$music_id = $music->getMusic_id();
		$music_nombre = $music->getMusic_nombre();
		$music_archivo = $music->getMusic_archivo();
		$sql = "
			INSERT INTO music (
				music_id,
				music_nombre,
				music_archivo
			)
			VALUES (
				'".$music_id."',
				'".$music_nombre."',
				'".$music_archivo."'
			)
		";
		$rs   = $conn->Execute($sql);
		if(!$rs){
			return $conn->ErrorMsg();
		}
		$rs->Close();
		return true;
	}
	function actualizar($music){
		$conn = $this->conn;
		$music_id = $music->getMusic_id();
		$music_nombre = $music->getMusic_nombre();
		$music_archivo = $music->getMusic_archivo();
		$sql = "
			UPDATE music SET
				music_id = '".$music_id."',
				music_nombre = '".$music_nombre."',
				music_archivo = '".$music_archivo."'
			WHERE music_id = '".$music_id."'
		";
		$rs   = $conn->Execute($sql);
		if(!$rs){
			return $conn->ErrorMsg();
		}
		$rs->Close();
		return true;
	}
	function borrar($music){
		$conn = $this->conn;
		$music_id = $music->getMusic_id();
		$sql  = "DELETE FROM music WHERE music_id = '".$music_id."'";
		$rs   = $conn->Execute($sql);
		if(!$rs){
			return $conn->ErrorMsg();
		}
		$rs->Close();
		return true;
	}
}
?>
