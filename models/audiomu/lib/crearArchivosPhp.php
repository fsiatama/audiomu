<?php
$base         = "audiomu"; //$_GET["db"];
$nombre_tabla = "music"; //$_GET["tabla"];

if($base == "" || $nombre_tabla == ""){
	print "no hay datos";
	exit();
}
if(!file_exists($nombre_tabla)){
	mkdir($nombre_tabla);
}

include('../../adodb5/adodb.inc.php');	   # Carga el codigo comun de ADOdb
$conn = &ADONewConnection('mysqli');  # crea la conexion
$conn->PConnect('localhost','root','','information_schema');# se conecta a la base de datos agora
$sql = "SELECT * FROM COLUMNS WHERE TABLE_SCHEMA = '".$base."' AND (TABLE_NAME = '".$nombre_tabla."' )";
$rs = $conn->Execute($sql);
//print $rs->GetMenu('COLUMN_NAME','orden_compra_cab_id');
$result    = array();
$result2   = array();
$contenido = "";
$cabecera  = "";
$variables = "";

$cabecera  = "<?php\r\nclass ".ucfirst($nombre_tabla)."{\r\n";

$llave_primaria = false;
while (!$rs->EOF) {
	$contenido  .= "	function set". ucfirst($rs->fields["COLUMN_NAME"])."(\$". $rs->fields["COLUMN_NAME"] ."){\r\n";
	$contenido  .= "		\$this->". $rs->fields["COLUMN_NAME"]." = \$". $rs->fields["COLUMN_NAME"].";\r\n";
	$contenido  .= "	}\r\n";
	$contenido  .= "	function get". ucfirst($rs->fields["COLUMN_NAME"])."(){\r\n";
	$contenido  .= "		return \$this->". $rs->fields["COLUMN_NAME"].";\r\n";
	$contenido  .= "	}\r\n";
	$variables  .= "	var \$". $rs->fields["COLUMN_NAME"]. ";\r\n";
	$result[]    = $rs->fields["COLUMN_NAME"];
	$result2[]   = $rs->fields;
	if($rs->fields["COLUMN_KEY"] == "PRI"){
		$llave_primaria = $rs->fields["COLUMN_NAME"];
	}
	$rs->MoveNext();
}

if($llave_primaria === false){
	print "no existe llave primaria";
	exit();
}
$cabecera .= $variables;
$cabecera .= "	function ".$nombre_tabla."(){\r\n";
$cabecera .= "		//constructor vacio\r\n";
$cabecera .= "	}\r\n";
$cabecera .= $contenido;
$cabecera .= "}\r\n?>";
//printf($contenido);

$archivo = $nombre_tabla . "/" . $nombre_tabla.".php";
if(!file_exists($archivo)){
	$fp = fopen($archivo,"w+");
	fwrite($fp, $cabecera);
	fclose($fp);
}
else {
	print $archivo . " ya existe, no se ha creado \r\n";
}


$contenido = "";
$cabecera  = "";
$variables = "";


$contenido .= "<?php\r\n";
$contenido .= "include(\"".$nombre_tabla.".php\");\r\n";
$contenido .= "class ".ucfirst($nombre_tabla)."Ado extends Conexion{\r\n";
$contenido .= "	var \$conn;\r\n";
$contenido .= "	function ".ucfirst($nombre_tabla)."Ado(\$_bd){\r\n";
$contenido .= "		parent::Conexion(\$_bd);\r\n";
$contenido .= "	}\r\n";
$contenido .= "	function lista(\$".$nombre_tabla."){\r\n";
$contenido .= "		\$conn = \$this->conn;\r\n";
$contenido .= "		\$filtro = array();\r\n";
$contenido .= "		foreach(\$".$nombre_tabla." as \$key => \$data){\r\n";
$contenido .= "			if (\$data <> ''){\r\n";	
$contenido .= "				\$filtro[] = \$key . \" = '\" . \$data .\"'\";\r\n";
$contenido .= "			}\r\n";
$contenido .= "		}\r\n";
$contenido .= "		\$sql  = 'SELECT * FROM ".$nombre_tabla."';\r\n";
$contenido .= "		if(!empty(\$filtro)){\r\n";
$contenido .= "			\$sql .= ' WHERE '. implode(' AND ', \$filtro);\r\n";
$contenido .= "		}\r\n";
$contenido .= "		\$rs   = \$conn->Execute(\$sql);\r\n";
$contenido .= "		\$result = array();\r\n";
$contenido .= "		if(!\$rs){\r\n";
$contenido .= "			return \$conn->ErrorMsg();\r\n";
$contenido .= "		}\r\n";
$contenido .= "		\$total = \$rs->RecordCount();\r\n";
$contenido .= "		while(!\$rs->EOF){\r\n";
$contenido .= "			\$result[\"datos\"][] = \$rs->fields;\r\n";
$contenido .= "			\$rs->MoveNext();\r\n";
$contenido .= "		}\r\n";
$contenido .= "		\$result[\"total\"] = \$total;\r\n";
$contenido .= "		\$rs->Close();\r\n";
$contenido .= "		return \$result;\r\n";
$contenido .= "	}\r\n";

$contenido .= "	function lista_filtro(\$query, \$queryValuesIndicator, \$limit){\r\n";
$contenido .= "		\$conn = \$this->conn;\r\n";
$contenido .= "		\$filtro = array();\r\n";

$contenido .= "		if(\$queryValuesIndicator && is_array(\$query)){\r\n";
$contenido .= "			\$filtro[] = \"".$llave_primaria." IN('\".implode(\"','\",\$query).\"')\";\r\n";
$contenido .= "		}\r\n";
$contenido .= "		else{\r\n";
$contenido .= "			if(is_array(\$query)){\r\n";
$contenido .= "				\$tmp_query = array_pop(\$query);\r\n";
$contenido .= "				\$filtro[] = \"".$llave_primaria." IN('\".implode(\"','\",\$query).\"')\";\r\n";
$contenido .= "				\$query = \$tmp_query;\r\n";
$contenido .= "			}\r\n";
$contenido .= "			else{\r\n";

$variables = array();
foreach($result as $key => $campos){
	$variables[] = $campos." LIKE '%\" . \$query .\"%'";
}
$contenido .= "				\$filtro[] = \"(\r\n";
$contenido .= "					   ".implode("\r\n					OR ",$variables)."\r\n";
$contenido .= "				)\";\r\n";
$contenido .= "			}\r\n";
$contenido .= "		}\r\n";

$contenido .= "		\$sql  = 'SELECT ".implode(",",$result)." FROM ".$nombre_tabla."';\r\n";
$contenido .= "		if(!empty(\$filtro)){\r\n";
$contenido .= "			\$sql .= ' WHERE '. implode(' AND ', \$filtro);\r\n";
$contenido .= "		}\r\n";

$contenido .= "		\$result = array();\r\n";
$contenido .= "		if(\$queryValuesIndicator && is_array(\$query)){\r\n";
$contenido .= "			\$rs = \$conn->Execute(\$sql);\r\n";
$contenido .= "			\$result[\"total\"] = \$rs->RecordCount();\r\n";
$contenido .= "		}\r\n";
$contenido .= "		elseif(\$limit != \"\"){\r\n";
$contenido .= "			\$arr_limit = explode(\",\",\$limit);\r\n";
$contenido .= "			\$savec = \$ADODB_COUNTRECS;\r\n";
$contenido .= "			if(\$conn->pageExecuteCountRows) \$ADODB_COUNTRECS = true;\r\n";
$contenido .= "			\$rs = \$conn->PageExecute(\$sql,\$arr_limit[1], \$arr_limit[0]);\r\n";
$contenido .= "			\$ADODB_COUNTRECS = \$savec;\r\n";
$contenido .= "			\$result[\"total\"] = \$rs->_maxRecordCount;\r\n";
$contenido .= "		}\r\n";
$contenido .= "		if(!\$rs){\r\n";
$contenido .= "			return \$conn->ErrorMsg();\r\n";
$contenido .= "		}\r\n";
$contenido .= "		while(!\$rs->EOF){\r\n";
$contenido .= "			\$result[\"datos\"][] = \$rs->fields;\r\n";
$contenido .= "			\$rs->MoveNext();\r\n";
$contenido .= "		}\r\n";
$contenido .= "		\$rs->Close();\r\n";
$contenido .= "		return \$result;\r\n";
$contenido .= "	}\r\n";

$contenido .= "	function insertar(\$".$nombre_tabla."){\r\n";
$contenido .= "		\$conn = \$this->conn;\r\n";
foreach($result as $key => $campos){
	$contenido .= "		\$" . $campos . " = \$" . $nombre_tabla ."->get".ucfirst($campos)."();\r\n";
}
//print(implode(",",$result));
$contenido .= "		\$sql = \"\r\n";
$contenido .= "			INSERT INTO ".$nombre_tabla." (\r\n";
$contenido .= "				".implode(",\r\n				",$result)."\r\n";
$contenido .= "			)\r\n";
$contenido .= "			VALUES (\r\n";
$contenido .= "				'\".\$".implode(".\"',\r\n				'\".\$",$result).".\"'\r\n";
$contenido .= "			)\r\n";
$contenido .= "		\";\r\n";
$contenido .= "		\$rs   = \$conn->Execute(\$sql);\r\n";
$contenido .= "		if(!\$rs){\r\n";
$contenido .= "			return \$conn->ErrorMsg();\r\n";
$contenido .= "		}\r\n";
$contenido .= "		\$rs->Close();\r\n";
$contenido .= "		return true;\r\n";
$contenido .= "	}\r\n";

$variables = array();
$contenido .= "	function actualizar(\$".$nombre_tabla."){\r\n";
$contenido .= "		\$conn = \$this->conn;\r\n";
foreach($result as $key => $campos){
	$contenido .= "		\$" . $campos . " = \$" . $nombre_tabla ."->get".ucfirst($campos)."();\r\n";
	$variables[] = $campos . " = '\".\$" . $campos . ".\"'";
}

$contenido .= "		\$sql = \"\r\n";
$contenido .= "			UPDATE ".$nombre_tabla." SET\r\n";
$contenido .= "				".implode(",\r\n				",$variables)."\r\n";
$contenido .= "			WHERE ".$llave_primaria." = '\".\$".$llave_primaria.".\"'\r\n";
$contenido .= "		\";\r\n";
$contenido .= "		\$rs   = \$conn->Execute(\$sql);\r\n";
$contenido .= "		if(!\$rs){\r\n";
$contenido .= "			return \$conn->ErrorMsg();\r\n";
$contenido .= "		}\r\n";
$contenido .= "		\$rs->Close();\r\n";
$contenido .= "		return true;\r\n";
$contenido .= "	}\r\n";

$contenido .= "	function borrar(\$".$nombre_tabla."){\r\n";
$contenido .= "		\$conn = \$this->conn;\r\n";
$contenido .= "		\$" . $llave_primaria . " = \$" . $nombre_tabla ."->get".ucfirst($llave_primaria)."();\r\n";
$contenido .= "		\$sql  = \"DELETE FROM ".$nombre_tabla." WHERE ".$llave_primaria." = '\".\$".$llave_primaria.".\"'\";\r\n";
$contenido .= "		\$rs   = \$conn->Execute(\$sql);\r\n";
$contenido .= "		if(!\$rs){\r\n";
$contenido .= "			return \$conn->ErrorMsg();\r\n";
$contenido .= "		}\r\n";
$contenido .= "		\$rs->Close();\r\n";
$contenido .= "		return true;\r\n";
$contenido .= "	}\r\n";
$contenido .= "}\r\n";
$contenido .= "?>\r\n";


$archivo = $nombre_tabla . "/" .$nombre_tabla."Ado.php";
if(!file_exists($archivo)){
	$fp = fopen($archivo,"w+");
	fwrite($fp, $contenido);
	fclose($fp);
}
else {
	print $archivo . " ya existe, no se ha creado ";
}


$contenido = "";
$cabecera  = "";
$variables = "";

$contenido .= "<?php\r\n";
$contenido .= "session_start();\r\n";
$contenido .= "include('../../lib/config.php');\r\n";
$contenido .= "include_once(PATH_APP.\"lib/idioma.php\");\r\n";
$contenido .= "include_once(PATH_APP.\"lib/lib_funciones.php\");\r\n";
$contenido .= "include_once(PATH_APP.\"lib/lib_sesion.php\");\r\n";
$contenido .= "include_once(PATH_RAIZ.\"".$base."/lib/".$nombre_tabla."/".$nombre_tabla."Ado.php\");\r\n";

$contenido .= "\$".$nombre_tabla."Ado = new " . ucfirst($nombre_tabla) ."Ado(\"".$base."\");\r\n";
$contenido .= "\$".$nombre_tabla."    = new " . ucfirst($nombre_tabla) .";\r\n";


$contenido .= "if(isset(\$accion)){\r\n";
$contenido .= "	switch(\$accion){\r\n";
$contenido .= "		case \"act\":\r\n";
foreach($result as $key => $campos){
	$contenido .= "			\$" . $nombre_tabla ."->set".ucfirst($campos)."(\$" . $campos . ");\r\n";
}
$contenido .= "			\$rs_".$nombre_tabla." = \$".$nombre_tabla."Ado->actualizar(\$".$nombre_tabla.");\r\n";
$contenido .= "			if(\$rs_".$nombre_tabla." !== true){\r\n";
$contenido .= "				\$success = false;\r\n";
$contenido .= "			}\r\n";
$contenido .= "			else{\r\n";
$contenido .= "				\$success = true;\r\n";
$contenido .= "			}\r\n";
$contenido .= "			\$respuesta = array(\r\n";
$contenido .= "				\"success\"=>\$success,\r\n";
$contenido .= "				\"errors\"=>array(\"reason\"=>\$rs_".$nombre_tabla.")\r\n";
$contenido .= "			);\r\n";
$contenido .= "			echo json_encode(\$respuesta);\r\n";
$contenido .= "			exit();\r\n";
$contenido .= "		break;\r\n";
$contenido .= "		case \"del\":\r\n";
$contenido .= "			\$".$nombre_tabla."->set".ucfirst($llave_primaria)."(\$".$llave_primaria.");\r\n";
$contenido .= "			\$rs_".$nombre_tabla." = \$".$nombre_tabla."Ado->borrar(\$".$nombre_tabla.");\r\n";
$contenido .= "			if(\$rs_".$nombre_tabla." !== true){\r\n";
$contenido .= "				\$success = false;\r\n";
$contenido .= "			}\r\n";
$contenido .= "			else{\r\n";
$contenido .= "				\$success = true;\r\n";
$contenido .= "			}\r\n";
$contenido .= "			\$respuesta = array(\r\n";
$contenido .= "				\"success\"=>\$success,\r\n";
$contenido .= "				\"errors\"=>array(\"reason\"=>\$rs_".$nombre_tabla.")\r\n";
$contenido .= "			);\r\n";
$contenido .= "			echo json_encode(\$respuesta);\r\n";
$contenido .= "			exit();\r\n";
$contenido .= "		break;\r\n";
$contenido .= "		case \"crea\":\r\n";
foreach($result as $key => $campos){
	$contenido .= "			\$" . $nombre_tabla ."->set".ucfirst($campos)."(\$" . $campos . ");\r\n";
}
$contenido .= "			\$rs_".$nombre_tabla." = \$".$nombre_tabla."Ado->insertar(\$".$nombre_tabla.");\r\n";
$contenido .= "			if(\$rs_".$nombre_tabla." !== true){\r\n";
$contenido .= "				\$success = false;\r\n";
$contenido .= "			}\r\n";
$contenido .= "			else{\r\n";
$contenido .= "				\$success = true;\r\n";
$contenido .= "			}\r\n";
$contenido .= "			\$respuesta = array(\r\n";
$contenido .= "				\"success\"=>\$success,\r\n";
$contenido .= "				\"errors\"=>array(\"reason\"=>\$rs_".$nombre_tabla.")\r\n";
$contenido .= "			);\r\n";
$contenido .= "			echo json_encode(\$respuesta);\r\n";
$contenido .= "			exit();\r\n";
$contenido .= "		break;\r\n";
$contenido .= "		case \"lista\":\r\n";
$contenido .= "			\$arr = array();\r\n";
foreach($result as $key => $campos){
	$contenido .= "			\$" . $nombre_tabla ."->set".ucfirst($campos)."(\$" . $campos . ");\r\n";
}
$contenido .= "			\$rs_".$nombre_tabla." = \$".$nombre_tabla."Ado->lista(\$".$nombre_tabla.");\r\n";
$contenido .= "			if(!is_array(\$rs_".$nombre_tabla.")){\r\n";
$contenido .= "				\$respuesta = array(\r\n";
$contenido .= "					\"success\"=>false,\r\n";
$contenido .= "					\"errors\"=>array(\"reason\"=>\$rs_".$nombre_tabla.")\r\n";
$contenido .= "				);\r\n";
$contenido .= "				echo json_encode(\$respuesta);\r\n";
$contenido .= "				exit();\r\n";
$contenido .= "			}\r\n";
$contenido .= "			foreach(\$rs_".$nombre_tabla."[\"datos\"] as \$key => \$data){\r\n";
$contenido .= "				\$arr[] = sanear_string(\$data);\r\n";
$contenido .= "			}\r\n";

$contenido .= "			\$respuesta = array(\r\n";
$contenido .= "				\"success\"=>true,\r\n";
$contenido .= "				\"total\"=>\$rs_".$nombre_tabla."[\"total\"],\r\n";
$contenido .= "				\"datos\"=>\$arr\r\n";
$contenido .= "			);\r\n";
$contenido .= "			echo json_encode(\$respuesta);\r\n";
$contenido .= "			exit();\r\n";
$contenido .= "		break;\r\n";

$contenido .= "		case \"lista_filtro\":\r\n";
$contenido .= "			\$arr = array();\r\n";

$contenido .= "			\$start = (isset(\$start))?\$start:0;\r\n";
$contenido .= "			\$limit = (isset(\$limit))?\$limit:MAXREGEXCEL;\r\n";
$contenido .= "			\$page = (\$start==0)?1:(\$start/\$limit)+1;\r\n";
$contenido .= "			\$limit = \$page . \", \" . \$limit;\r\n";

$contenido .= "			\$rs_".$nombre_tabla." = \$".$nombre_tabla."Ado->lista_filtro(\$query, \$valuesqry, \$limit);\r\n";
$contenido .= "			if(!is_array(\$rs_".$nombre_tabla.")){\r\n";
$contenido .= "				\$respuesta = array(\r\n";
$contenido .= "					\"success\"=>false,\r\n";
$contenido .= "					\"errors\"=>array(\"reason\"=>\$rs_".$nombre_tabla.")\r\n";
$contenido .= "				);\r\n";
$contenido .= "				echo json_encode(\$respuesta);\r\n";
$contenido .= "				exit();\r\n";
$contenido .= "			}\r\n";
$contenido .= "			elseif(\$rs_".$nombre_tabla."[\"total\"] == 0){\r\n";
$contenido .= "				\$respuesta = array(\r\n";
$contenido .= "					\"success\"=>false,\r\n";
$contenido .= "					\"errors\"=>array(\"reason\"=>sanear_string(_NOSEENCONTRARONREGISTROS))\r\n";
$contenido .= "				);\r\n";
$contenido .= "				echo json_encode(\$respuesta);\r\n";
$contenido .= "				exit();\r\n";
$contenido .= "			}\r\n";
$contenido .= "			else{\r\n";
$contenido .= "				foreach(\$rs_".$nombre_tabla."[\"datos\"] as \$key => \$data){\r\n";
$contenido .= "					\$arr[] = sanear_string(\$data);\r\n";
$contenido .= "				}\r\n";
$contenido .= "				\$respuesta = array(\r\n";
$contenido .= "					\"success\"=>true,\r\n";
$contenido .= "					\"total\"=>\$rs_".$nombre_tabla."[\"total\"],\r\n";
$contenido .= "					\"datos\"=>\$arr\r\n";
$contenido .= "				);\r\n";
$contenido .= "				echo json_encode(\$respuesta);\r\n";
$contenido .= "				exit();\r\n";
$contenido .= "			}\r\n";
$contenido .= "		break;\r\n";


$contenido .= "	}\r\n";
$contenido .= "}\r\n";
$contenido .= "?>\r\n";

$archivo = $nombre_tabla . "/" ."operaciones_".$nombre_tabla.".php";
if(!file_exists($archivo)){
	$fp = fopen($archivo,"w+");
	fwrite($fp, $contenido);
	fclose($fp);
}
else {
	print $archivo . " ya existe, no se ha creado ";
}


$contenido = "";
$cabecera  = "";
$variables = "";


$contenido .= "<?php\r\n";
$contenido .= "session_start();\r\n";
$contenido .= "include_once('../../lib/config.php');\r\n";
$contenido .= "?>\r\n";
$contenido .= "/*<script>*/\r\n";

$arr_str_fields  = array();
$arr_col_model   = array();
$arr_form_reader = array();
$arr_form_items  = array();

foreach($result2 as $key => $campos){
	$tipo    = "string";
	$alinear = "left";
	$format  = "";
	$column_xtype = "";
	$column_format = "";
	
	if($campos["DATA_TYPE"] == "varchar"  || $campos["DATA_TYPE"] == "text"){
		$tipo = "string";
		$alinear = "left";
		$xtype   = "textfield";
	}
	elseif($campos["DATA_TYPE"] == "int" || $campos["DATA_TYPE"] == "tinyint" || $campos["DATA_TYPE"] == "mediumint" || $campos["DATA_TYPE"] == "smallint" || $campos["DATA_TYPE"] == "bigint" || $campos["DATA_TYPE"] == "double"){
		$tipo = "float";
		$alinear = "right";
		$xtype   = "numberfield";
		$column_xtype = "xtype:'numbercolumn', ";
	}
	elseif($campos["DATA_TYPE"] == "date"){
		$tipo    = "string";
		$alinear = "left";
		$xtype   = "datefield";
		$format  = ", dateFormat:'Y-m-d'";
		$column_xtype = "xtype:'datecolumn', ";
		$column_format = ", format:'Y-m-d'";
	}
	elseif($campos["DATA_TYPE"] == "datetime"){
		$tipo    = "date";
		$alinear = "left";
		$xtype   = "datefield";
		$format  = "Y-m-d H:i:s";
		$column_xtype = "xtype:'datecolumn', ";
		$column_format = ", format:'Y-m-d, g:i a'";
	}
	
	$arr_str_fields[]  = "{name:'".$campos["COLUMN_NAME"]."', type:'".$tipo."'".$format."}";;
	$arr_col_model[]   = "{".$column_xtype."header:'<?php print _".strtoupper($campos["COLUMN_NAME"])."; ?>', align:'".$alinear ."', hidden:false, dataIndex:'".$campos["COLUMN_NAME"]."'".$column_format."}";
	$arr_form_reader[] = "{name:'".$campos["COLUMN_NAME"]."', mapping:'".$campos["COLUMN_NAME"]."', type:'".$tipo."'}";
	$str  = "defaults:{anchor:'100%'}\r\n";
	$str .= "			,items:[{\r\n";
	$str .= "				,xtype:'".$xtype."'\r\n";
	$str .= "				,name:'".$campos["COLUMN_NAME"]."'\r\n";
	$str .= "				,fieldLabel:'<?php print _".strtoupper($campos["COLUMN_NAME"])."; ?>'\r\n";
	$str .= "				,id:modulo+'".$campos["COLUMN_NAME"]."'\r\n";
	$str .= "				,allowBlank:false\r\n";
	$str .= "			}]\r\n";
	
	$arr_form_items[] = $str;
}

$contenido .= "var store".ucfirst($nombre_tabla)." = new Ext.data.JsonStore({\r\n";
$contenido .= "	url:'proceso/".$nombre_tabla."/'\r\n";
$contenido .= "	,root:'datos'\r\n";
$contenido .= "	,sortInfo:{field:'".$llave_primaria."',direction:'ASC'}\r\n";
$contenido .= "	,totalProperty:'total'\r\n";
$contenido .= "	,baseParams:{accion:'lista'}\r\n";
$contenido .= "	,fields:[\r\n";
$contenido .= "		".implode(",\r\n		",$arr_str_fields)."\r\n";
$contenido .= "	]\r\n";
$contenido .= "});\r\n";


$contenido .= "var combo".ucfirst($nombre_tabla)." = new Ext.form.ComboBox({\r\n";
$contenido .= "	hiddenName:'".$nombre_tabla."'\r\n";
$contenido .= "	,id:modulo+'combo".ucfirst($nombre_tabla)."'\r\n";
$contenido .= "	,fieldLabel:'<?php print _".strtoupper($nombre_tabla)."; ?>'\r\n";
$contenido .= "	,store:store".ucfirst($nombre_tabla)."\r\n";
$contenido .= "	,valueField:'".$llave_primaria."'\r\n";
$contenido .= "	,displayField:'".$nombre_tabla."_nombre'\r\n";
$contenido .= "	,typeAhead:true\r\n";
$contenido .= "	,forceSelection:true\r\n";
$contenido .= "	,triggerAction:'all'\r\n";
$contenido .= "	,selectOnFocus:true\r\n";
$contenido .= "});\r\n";

$contenido .= "var cm".ucfirst($nombre_tabla)." = new Ext.grid.ColumnModel({\r\n";
$contenido .= "	columns:[\r\n";
$contenido .= "		".implode(",\r\n		",$arr_col_model)."\r\n";
$contenido .= "	]\r\n";
$contenido .= "	,defaults:{\r\n";
$contenido .= "		sortable:true\r\n";
$contenido .= "		,width:100\r\n";
$contenido .= "	}\r\n";
$contenido .= "});\r\n";

$contenido .= "var tb".ucfirst($nombre_tabla)." = new Ext.Toolbar();\r\n\r\n";

$contenido .= "var grid".ucfirst($nombre_tabla)." = new Ext.grid.GridPanel({\r\n";
$contenido .= "	store:store".ucfirst($nombre_tabla)."\r\n";
$contenido .= "	,id:modulo+'grid".ucfirst($nombre_tabla)."'\r\n";
$contenido .= "	,colModel:cm".ucfirst($nombre_tabla)."\r\n";
$contenido .= "	,viewConfig: {\r\n";
$contenido .= "		forceFit: true\r\n";
$contenido .= "		,scrollOffset:2\r\n";
$contenido .= "	}\r\n";
$contenido .= "	,sm:new Ext.grid.RowSelectionModel({singleSelect:true})\r\n";
$contenido .= "	,bbar:new Ext.PagingToolbar({pageSize:10, store:store".ucfirst($nombre_tabla).", displayInfo:true})\r\n";
$contenido .= "	,tbar:tb".ucfirst($nombre_tabla)."\r\n";
$contenido .= "	,loadMask:true\r\n";
$contenido .= "	,border:false\r\n";
$contenido .= "	,title:''\r\n";
$contenido .= "	,iconCls:'icon-grid'\r\n";
$contenido .= "	,plugins:[new Ext.ux.grid.Excel()]\r\n";
$contenido .= "});\r\n";

$contenido .= "var form".ucfirst($nombre_tabla)." = new Ext.FormPanel({\r\n";
$contenido .= "	baseCls:'x-panel-mc'\r\n";
$contenido .= "	,method:'POST'\r\n";
$contenido .= "	,baseParams:{accion:'act'}\r\n";
$contenido .= "	,autoWidth:true\r\n";
$contenido .= "	,autoScroll:true\r\n";
$contenido .= "	,trackResetOnLoad:true\r\n";
$contenido .= "	,monitorValid:true\r\n";
$contenido .= "	,bodyStyle:'padding:15px;'\r\n";
$contenido .= "	,reader: new Ext.data.JsonReader({\r\n";
$contenido .= "		root:'datos'\r\n";
$contenido .= "		,totalProperty:'total'\r\n";
$contenido .= "		,fields:[\r\n";
$contenido .= "			".implode(",\r\n			",$arr_form_reader)."\r\n";
$contenido .= "		]\r\n";
$contenido .= "	})\r\n";
$contenido .= "	,items:[{\r\n";
$contenido .= "		xtype:'fieldset'\r\n";
$contenido .= "		,title:'Information'\r\n";
$contenido .= "		,layout:'column'\r\n";
$contenido .= "		,defaults:{\r\n";
$contenido .= "			columnWidth:0.33\r\n";
$contenido .= "			,layout:'form'\r\n";
$contenido .= "			,labelAlign:'top'\r\n";
$contenido .= "			,border:false\r\n";
$contenido .= "			,xtype:'panel'\r\n";
$contenido .= "			,bodyStyle:'padding:0 18px 0 0'\r\n";
$contenido .= "		}\r\n";
$contenido .= "		,items:[{\r\n";
$contenido .= "			".implode("		},{\r\n			",$arr_form_items)."";
$contenido .= "		}]\r\n";
$contenido .= "	}]\r\n";
$contenido .= "});\r\n";


$archivo = $nombre_tabla . "/" . $nombre_tabla."_store.js.php";

if(!file_exists($archivo)){
	$fp = fopen($archivo,"w+");
	fwrite($fp, $contenido);
	fclose($fp);
}
else {
	print $archivo . " ya existe, no se ha creado ";
}


print " termino";
?>
