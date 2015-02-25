<?php
include("lic_samples.php");
class Lic_samplesAdo extends Conexion{
	var $conn;
	function Lic_samplesAdo($_bd){
		parent::Conexion($_bd);
	}
	function lista($lic_samples){
		$conn = $this->conn;
		$filtro = array();
		foreach($lic_samples as $key => $data){
			if ($data <> ''){
				$filtro[] = $key . " = '" . $data ."'";
			}
		}
		$sql  = 'SELECT * FROM lic_samples LEFT JOIN samples ON lic_samples_sample_id = samples_id';
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
			$filtro[] = "lic_samples_id IN('".implode("','",$query)."')";
		}
		else{
			if(is_array($query)){
				$tmp_query = array_pop($query);
				$filtro[] = "lic_samples_id IN('".implode("','",$query)."')";
				$query = $tmp_query;
			}
			else{
				$filtro[] = "(
					   lic_samples_id LIKE '%" . $query ."%'
					OR lic_samples_nombre LIKE '%" . $query ."%'
					OR lic_samples_ident LIKE '%" . $query ."%'
					OR lic_samples_email LIKE '%" . $query ."%'
					OR lic_samples_sample_id LIKE '%" . $query ."%'
					OR lic_samples_desc LIKE '%" . $query ."%'
					OR lic_samples_preg1 LIKE '%" . $query ."%'
					OR lic_samples_porq1 LIKE '%" . $query ."%'
					OR lic_samples_preg2 LIKE '%" . $query ."%'
					OR lic_samples_porq2 LIKE '%" . $query ."%'
					OR lic_samples_preg3 LIKE '%" . $query ."%'
					OR lic_samples_disponible1 LIKE '%" . $query ."%'
					OR lic_samples_disponible2 LIKE '%" . $query ."%'
					OR lic_samples_disponible3 LIKE '%" . $query ."%'
					OR lic_samples_disponible4 LIKE '%" . $query ."%'
					OR lic_samples_disponible5 LIKE '%" . $query ."%'
					OR lic_samples_disponible6 LIKE '%" . $query ."%'
					OR lic_samples_finsert LIKE '%" . $query ."%'
					OR lic_samples_key LIKE '%" . $query ."%'
					OR lic_samples_descargada LIKE '%" . $query ."%'
					OR lic_samples_fdescarga LIKE '%" . $query ."%'
				)";
			}
		}
		$sql  = 'SELECT lic_samples_id,lic_samples_nombre,lic_samples_ident,lic_samples_email,lic_samples_sample_id,lic_samples_desc,lic_samples_preg1,lic_samples_porq1,lic_samples_preg2,lic_samples_porq2,lic_samples_preg3,lic_samples_disponible1,lic_samples_disponible2,lic_samples_disponible3,lic_samples_disponible4,lic_samples_disponible5,lic_samples_disponible6,lic_samples_finsert,lic_samples_key,lic_samples_descargada,lic_samples_fdescarga FROM lic_samples';
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
	function insertar($lic_samples){
		$conn = $this->conn;
		$lic_samples_id = $lic_samples->getLic_samples_id();
		$lic_samples_nombre = $lic_samples->getLic_samples_nombre();
		$lic_samples_ident = $lic_samples->getLic_samples_ident();
		$lic_samples_email = $lic_samples->getLic_samples_email();
		$lic_samples_sample_id = $lic_samples->getLic_samples_sample_id();
		$lic_samples_desc = $lic_samples->getLic_samples_desc();
		$lic_samples_preg1 = $lic_samples->getLic_samples_preg1();
		$lic_samples_porq1 = $lic_samples->getLic_samples_porq1();
		$lic_samples_preg2 = $lic_samples->getLic_samples_preg2();
		$lic_samples_porq2 = $lic_samples->getLic_samples_porq2();
		$lic_samples_preg3 = $lic_samples->getLic_samples_preg3();
		$lic_samples_disponible1 = $lic_samples->getLic_samples_disponible1();
		$lic_samples_disponible2 = $lic_samples->getLic_samples_disponible2();
		$lic_samples_disponible3 = $lic_samples->getLic_samples_disponible3();
		$lic_samples_disponible4 = $lic_samples->getLic_samples_disponible4();
		$lic_samples_disponible5 = $lic_samples->getLic_samples_disponible5();
		$lic_samples_disponible6 = $lic_samples->getLic_samples_disponible6();
		$lic_samples_finsert = $lic_samples->getLic_samples_finsert();
		$lic_samples_key = $lic_samples->getLic_samples_key();
		$lic_samples_descargada = $lic_samples->getLic_samples_descargada();
		$lic_samples_fdescarga = $lic_samples->getLic_samples_fdescarga();
		$sql = "
			INSERT INTO lic_samples (
				lic_samples_id,
				lic_samples_nombre,
				lic_samples_ident,
				lic_samples_email,
				lic_samples_sample_id,
				lic_samples_desc,
				lic_samples_preg1,
				lic_samples_porq1,
				lic_samples_preg2,
				lic_samples_porq2,
				lic_samples_preg3,
				lic_samples_disponible1,
				lic_samples_disponible2,
				lic_samples_disponible3,
				lic_samples_disponible4,
				lic_samples_disponible5,
				lic_samples_disponible6,
				lic_samples_finsert,
				lic_samples_key,
				lic_samples_descargada,
				lic_samples_fdescarga
			)
			VALUES (
				'".$lic_samples_id."',
				'".$lic_samples_nombre."',
				'".$lic_samples_ident."',
				'".$lic_samples_email."',
				'".$lic_samples_sample_id."',
				'".$lic_samples_desc."',
				'".$lic_samples_preg1."',
				'".$lic_samples_porq1."',
				'".$lic_samples_preg2."',
				'".$lic_samples_porq2."',
				'".$lic_samples_preg3."',
				'".$lic_samples_disponible1."',
				'".$lic_samples_disponible2."',
				'".$lic_samples_disponible3."',
				'".$lic_samples_disponible4."',
				'".$lic_samples_disponible5."',
				'".$lic_samples_disponible6."',
				'".$lic_samples_finsert."',
				'".$lic_samples_key."',
				'".$lic_samples_descargada."',
				'".$lic_samples_fdescarga."'
			)
		";
		$rs   = $conn->Execute($sql);
		if(!$rs){
			return $conn->ErrorMsg();
		}
		$rs->Close();
		$result = array();
		$result["InsertID"] = $conn->Insert_ID();
		return $result;
	}
	function actualizar($lic_samples){
		$conn = $this->conn;
		$valores = array();
		foreach($lic_samples as $key => $data){
			if($data <> ''){
				$valores[] = $key . " = '" . $data ."'";
			}
		}
		$sql  = 'UPDATE lic_samples ';
		if(!empty($valores)){
			$sql .= ' set '. implode(', ', $valores);
		}
		$lic_samples_id = $lic_samples->getLic_samples_id();
		$sql .= ' WHERE lic_samples_id = "'.$lic_samples_id.'"';
		$rs   = $conn->Execute($sql);
		if(!$rs){
			return $conn->ErrorMsg();
		}
		$rs->Close();
		return true;
	}
	function borrar($lic_samples){
		$conn = $this->conn;
		$lic_samples_id = $lic_samples->getLic_samples_id();
		$sql  = "DELETE FROM lic_samples WHERE lic_samples_id = '".$lic_samples_id."'";
		$rs   = $conn->Execute($sql);
		if(!$rs){
			return $conn->ErrorMsg();
		}
		$rs->Close();
		return true;
	}
}
?>
