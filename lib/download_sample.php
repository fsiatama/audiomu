<?
session_start();
set_time_limit(0);
include("config.php");

include_once(PATH_RAIZ."lib/conexion/conexion.php");
include_once(PATH_RAIZ."audiomu/lib/lic_samples/lic_samplesAdo.php");
$lic_samplesAdo = new Lic_samplesAdo("audiomu");
$lic_samples    = new Lic_samples;
$lic_samples->setLic_samples_key($key);
$rs_lic_samples = $lic_samplesAdo->lista($lic_samples);
if(!is_array($rs_lic_samples) || $rs_lic_samples["total"] == 0){
	$_SESSION["mensaje_error"] = "Lo sentimos, esta licencia No existe!";
	header("Location: ".URL_RAIZ."error");
	exit();
}
$arr_lic_samples = $rs_lic_samples["datos"][0];
if ($arr_lic_samples["lic_samples_descargada"] === "1"){
	$_SESSION["mensaje_error"] = "Lo sentimos, esta licencia ya ha sido descargada!";
	header("Location: ".URL_RAIZ."error");
	exit();
}

$lic_samples->setLic_samples_id($arr_lic_samples["lic_samples_id"]);
$lic_samples->setLic_samples_descargada("1");
$lic_samples->setLic_samples_fdescarga(date("Y-m-d H:i:s"));
$rs_lic_samples = $lic_samplesAdo->actualizar($lic_samples);
if($rs_lic_samples !== true){
	$_SESSION["mensaje_error"] = "Lo sentimos, existe un problema con tu descarga!";
	header("Location: ".URL_RAIZ."error");
	exit();
}

$filename = PATH_MEDIA."mp3/".$arr_lic_samples["samples_archivo"];
if (!is_file($filename)) {
	$_SESSION["mensaje_error"] = "Lo sentimos, existe un problema con el archivo de tu descarga!";
	header("Location: ".URL_RAIZ."error");
	exit();
}
$file_info = pathinfo($filename);
$filename = PATH_MEDIA."wav/".$file_info["filename"].".wav";
if (!is_file($filename)) {
	$_SESSION["mensaje_error"] = "Lo sentimos, existe un problema con el archivo de tu descarga!";
	header("Location: ".URL_RAIZ."error");
	exit();
}
// required for IE
if(ini_get('zlib.output_compression'))
  ini_set('zlib.output_compression', 'Off');
 
$ctype="application/force-download";
 
header("Pragma: public"); // required
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private",false); // required for certain browsers 
header("Content-Type: $ctype");
header("Content-Disposition: attachment; filename=\"".basename($filename)."\";" );
header("Content-Transfer-Encoding: binary");
header("Content-Length: ".filesize($filename));
readfile("$filename");
exit();


?>