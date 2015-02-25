<?php
function arr_samples($id = false){
	include_once(PATH_RAIZ."lib/conexion/conexion.php");
	include_once(PATH_RAIZ."audiomu/lib/samples/samplesAdo.php");
	$samplesAdo = new SamplesAdo("audiomu");
	$samples    = new Samples;
	if ($id !== false) {
		$samples->setSamples_id($id);
	}
	$rs_samples = $samplesAdo->lista($samples);
	if(!is_array($rs_samples)){
		$respuesta = array(
			"success"=>false,
			"errors"=>array("reason"=>$rs_samples)
		);
		return $respuesta;
	}
	elseif($rs_samples["total"] == 0){
		$respuesta = array(
			"success"=>false,
			"errors"=>array("reason"=>"no hay datos para mostrar")
		);
		return $respuesta;
	}
	$array = array();
	foreach($rs_samples["datos"] as $key => $data){
		$arr[] = sanear_string($data);
	}
	$respuesta = array(
		"success"=>true,
		"total"=>$rs_samples["total"],
		"datos"=>$arr
	);
	return $respuesta;
}

function arr_music($id = false){
	include_once(PATH_RAIZ."lib/conexion/conexion.php");
	include_once(PATH_RAIZ."audiomu/lib/music/musicAdo.php");
	$musicAdo = new MusicAdo("audiomu");
	$music    = new Music;
	if ($id !== false) {
		$music->setMusic_id($id);
	}
	$rs_music = $musicAdo->lista($music);
	if(!is_array($rs_music)){
		$respuesta = array(
			"success"=>false,
			"errors"=>array("reason"=>$rs_music)
		);
		return $respuesta;
	}
	elseif($rs_music["total"] == 0){
		$respuesta = array(
			"success"=>false,
			"errors"=>array("reason"=>"no hay datos para mostrar")
		);
		return $respuesta;
	}
	$array = array();
	foreach($rs_music["datos"] as $key => $data){
		$arr[] = sanear_string($data);
	}
	$respuesta = array(
		"success"=>true,
		"total"=>$rs_music["total"],
		"datos"=>$arr
	);
	return $respuesta;
}
function arr_country($id = false){
	include_once(PATH_RAIZ."lib/conexion/conexion.php");
	include_once(PATH_RAIZ."audiomu/lib/country/countryAdo.php");
	$countryAdo = new CountryAdo("audiomu");
	$country    = new Country;
	if ($id !== false) {
		$country->setCode($id);
	}
	$rs_country = $countryAdo->lista($country);
	if(!is_array($rs_country)){
		$respuesta = array(
			"success"=>false,
			"errors"=>array("reason"=>$rs_country)
		);
		return $respuesta;
	}
	elseif($rs_country["total"] == 0){
		$respuesta = array(
			"success"=>false,
			"errors"=>array("reason"=>"no hay datos para mostrar")
		);
		return $respuesta;
	}
	$array = array();
	foreach($rs_country["datos"] as $key => $data){
		$arr[] = sanear_string($data);
	}
	$respuesta = array(
		"success"=>true,
		"total"=>$rs_country["total"],
		"datos"=>$arr
	);
	return $respuesta;
}
function arr_tipo_usuario($id = false){
	include_once(PATH_RAIZ."lib/conexion/conexion.php");
	include_once(PATH_RAIZ."audiomu/lib/tipo_usuario/tipo_usuarioAdo.php");
	$tipo_usuarioAdo = new Tipo_usuarioAdo("audiomu");
	$tipo_usuario    = new Tipo_usuario;
	if ($id !== false) {
		$tipo_usuario->setTipo_usuario_id($id);
	}
	$rs_tipo_usuario = $tipo_usuarioAdo->lista($tipo_usuario);
	if(!is_array($rs_tipo_usuario)){
		$respuesta = array(
			"success"=>false,
			"errors"=>array("reason"=>$rs_tipo_usuario)
		);
		return $respuesta;
	}
	elseif($rs_tipo_usuario["total"] == 0){
		$respuesta = array(
			"success"=>false,
			"errors"=>array("reason"=>"no hay datos para mostrar")
		);
		return $respuesta;
	}
	$array = array();
	foreach($rs_tipo_usuario["datos"] as $key => $data){
		$arr[] = sanear_string($data);
	}
	$respuesta = array(
		"success"=>true,
		"total"=>$rs_tipo_usuario["total"],
		"datos"=>$arr
	);
	return $respuesta;
}
function arr_tipo_contacto($id = false){
	include_once(PATH_RAIZ."lib/conexion/conexion.php");
	include_once(PATH_RAIZ."audiomu/lib/tipo_contacto/tipo_contactoAdo.php");
	$tipo_contactoAdo = new Tipo_contactoAdo("audiomu");
	$tipo_contacto    = new Tipo_contacto;
	if ($id !== false) {
		$tipo_contacto->setTipo_contacto_id($id);
	}
	$rs_tipo_contacto = $tipo_contactoAdo->lista($tipo_contacto);
	if(!is_array($rs_tipo_contacto)){
		$respuesta = array(
			"success"=>false,
			"errors"=>array("reason"=>$rs_tipo_contacto)
		);
		return $respuesta;
	}
	elseif($rs_tipo_contacto["total"] == 0){
		$respuesta = array(
			"success"=>false,
			"errors"=>array("reason"=>"no hay datos para mostrar")
		);
		return $respuesta;
	}
	$array = array();
	foreach($rs_tipo_contacto["datos"] as $key => $data){
		$arr[] = ($data);
	}
	$respuesta = array(
		"success"=>true,
		"total"=>$rs_tipo_contacto["total"],
		"datos"=>$arr
	);
	return $respuesta;
}
function sanear_string($string){
	if(is_array($string)){
		$tmp = array();
		foreach($string as $key => $valor){
			$tmp[$key] = sanear_string($valor);
		}
		return $tmp;
	}
	$string = trim($string);
	$string = str_replace(
		array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
		array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
		$string
	);
	$string = str_replace(
		array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
		array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
		$string
	);
	$string = str_replace(
		array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
		array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
		$string
	);
	$string = str_replace(
		array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
		array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
		$string
	);
	$string = str_replace(
		array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
		array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
		$string
	);
	$string = str_replace(
		array('ñ', 'Ñ', 'ç', 'Ç'),
		array('n', 'N', 'c', 'C',),
		$string
	);
	//$string = utf8_decode($string);
	//print_r($string."\n");
	//Esta parte se encarga de eliminar cualquier caracter extraño
	$string = str_replace(
		array("\\", "¨", "º", "°",/*"-",*/ "~",
			 "#",  "|", "!", "\"",
			 "·", "$", "%", "&", "/",
			 "(", ")", "?", "'", "¡",
			 "¿", "[", "^", "`", "]",
			 "+", "}", "{", "¨", "´",
			 ">", "<", ";", "U2022", "°", "•", "", 
			 ""),
		'',
		$string
	);
	$string = strip_tags($string);
	$string = htmlentities($string);
	$string = stripslashes($string);
	$string = filter_var($string,FILTER_SANITIZE_STRING);
	//$string = utf8_encode($string);
	return $string;
}
function comprimir($buffer) { 
	/* remove comments */
	$buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);
	/* remove tabs, spaces, newlines, etc. */
	$buffer = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $buffer);
	return $buffer;
}
function email($mensaje, $asunto, $fromName, $fromEmail, $to, $adjunto = false){ //$to es un array con los destinatarios
	require_once('PHPMailer/PHPMailerAutoload.php');
	$mail = new PHPMailer();
	$mail->isSMTP();
	
	try {
		$mail->SMTPDebug = 0;
		//Ask for HTML-friendly debug output
		$mail->Debugoutput = 'html';
		//Set the hostname of the mail server
		$mail->Host = MAIL_HOST;
		//Set the SMTP port number - likely to be 25, 465 or 587
		$mail->Port = 25;
		//Whether to use SMTP authentication
		$mail->SMTPAuth = false;
		//Username to use for SMTP authentication
		//$mail->Username = "noresponder@audiomu.com";
		//Password to use for SMTP authentication
		//$mail->Password = "audiomu.com";
		if($adjunto !== false){
			foreach ($adjunto as $key => $value) {
				if (is_file($value)) {
					$mail->addAttachment($value);
				}
			}
		}

		$mail->setFrom($fromEmail, $fromName);

		if(!is_array($to)){
			$mail->addAddress($to);
		}
		else{
			foreach($to as $email => $nombre){
				$mail->addAddress($email, $nombre);
			}
		}
		
		//$mail->AddReplyTo('name@yourdomain.com', 'Webmaster');
		$mail->Subject = $asunto;
		$mail->AltBody = 'To view the message, please use an HTML compatible email viewer!'; // optional - MsgHTML will create an alternate automatically
		$mail->msgHTML($mensaje);
		$mail->send();
		$mail->clearAddresses();
    	$mail->clearAttachments();
		return true;
	}
	catch (phpmailerException $e) {
		return $e->errorMessage(); //Pretty error messages from PHPMailer
	}
	catch (Exception $e) {
		return $e->getMessage(); //Boring error messages from anything else!
	}
}

?>