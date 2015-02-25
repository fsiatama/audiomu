<?php
//ini_set("display_errors",true);
session_start();
include('config.php');
include_once('lib_funciones.php');

if(!empty($accion)){
	switch($accion){
		case "contactenos":
			if( !empty($email) &&
				!empty($mensaje) &&
				!empty($nombre) &&
				!empty($pais) &&
				!empty($tcontacto) &&
				!empty($tusuario)
			){
				$mensaje  = sanear_string(($mensaje));
				$nombre   = sanear_string(($nombre));
				$telefono = sanear_string(($telefono));
				$empresa  = sanear_string(($empresa));
				
				$rs_country = arr_country($pais);
				$arr_country = array();
				if ($rs_country["success"]){
					$arr_country = $rs_country["datos"][0];
				}
				$rs_tipo_usuario = arr_tipo_usuario($tusuario);
				$arr_tipo_usuario = array();
				if ($rs_tipo_usuario["success"]){
					$arr_tipo_usuario = $rs_tipo_usuario["datos"][0];
				}
				$rs_tipo_contacto = arr_tipo_contacto($tcontacto);
				$arr_tipo_contacto = array();
				if ($rs_tipo_contacto["success"]){
					$arr_tipo_contacto = $rs_tipo_contacto["datos"][0];
				}
				$message = '
					<html>
					<body>

					<p>Datos del contacto:</p>
					<table border="1">
					<tr>
					    <td>Nombre:</td> <td><b>'.$nombre.'</b></td>
					</tr>
					<tr>
					    <td>E-mail:</td> <td><b>'.$email.'</b></td>
					</tr>
					<tr>
					    <td>'.utf8_decode('Teléfono').':</td> <td><b>'.$telefono.'</b></td>
					</tr>
					<tr>
					    <td>Tipo de usuario:</td> <td><b>'.$arr_tipo_usuario["tipo_usuario_nombre"].'</b></td>
					</tr>
					<tr>
					    <td>Empresa:</td> <td><b>'.$empresa.'</b></td>
					</tr>
					<tr>
					    <td>'.utf8_decode('País').':</td> <td><b>'.$arr_country["Name"].'</b></td>
					</tr>
					<tr>
					    <td>Tipo de mensaje:</td> <td><b>'.$arr_tipo_contacto["tipo_contacto_nombre"].'</b></td>
					</tr>
					<tr>
					    <td>Mensaje:</td> <td><b>'.$mensaje.'</b></td>
					</tr>

					</table>

					</body>
					</html>
				';

				$to        = "atencionaudiomu@audiomu.com";
				//$to        = "fas0980@gmail.com";
				$asunto    = "Contacto Audiomu.com";
				$result    = email($message, $asunto, MAIL_FROMNAME, MAIL_FROM, $to);
				if ($result !== true) {
					$respuesta = array(
						"success"=>false,
						"errors"=>array("reason"=>$result)
					);
					echo json_encode($respuesta);
					exit();
				}
				$respuesta = array(
					"success"=>true,
					"modal"=>true,
					"msg"=>"Gracias por comunicarte con nosotros, pronto nos pondremos en contacto contigo",
					"url"=>URL_RAIZ
				);
				echo json_encode($respuesta);
				exit();
			}
		break;
		case "download_sample":
			if( !empty($email) &&
				!empty($name) &&
				!empty($documento) &&
				!empty($descripcion) &&
				!empty($sample) &&
				!empty($pregunta3)
			){
				include_once('forma_001.php');
				include_once(PATH_RAIZ."lib/conexion/conexion.php");
				include_once(PATH_RAIZ."audiomu/lib/lic_samples/lic_samplesAdo.php");
				$lic_samplesAdo = new Lic_samplesAdo("audiomu");
				$lic_samples    = new Lic_samples;

				$privatekey = md5($sample.$email);
				$lic_samples->setLic_samples_key($privatekey);
				$rs_lic_samples = $lic_samplesAdo->lista($lic_samples);
				if (empty($rs_lic_samples["total"])) { //solo permite una licencia por sample y email
					$lic_samples->setLic_samples_sample_id(($sample));
					$lic_samples->setLic_samples_preg1(($pregunta1));
					$lic_samples->setLic_samples_preg2(($pregunta2));
					$lic_samples->setLic_samples_preg3(($pregunta3));
					$lic_samples->setLic_samples_email($email);
					
					$lic_samples->setLic_samples_nombre(strtoupper(sanear_string($name)));
					$lic_samples->setLic_samples_ident(strtoupper(sanear_string($documento)));
					$lic_samples->setLic_samples_desc(strtoupper(sanear_string($descripcion)));
					$lic_samples->setLic_samples_porq1(strtoupper(sanear_string($porque1)));
					$lic_samples->setLic_samples_porq2(strtoupper(sanear_string($porque2)));

					$lic_samples->setLic_samples_finsert(date("Y-m-d H:i:s"));
					$lic_samples->setLic_samples_descargada("0");
					$rs_lic_samples = $lic_samplesAdo->insertar($lic_samples);
					if(is_array($rs_lic_samples)){
						$lic_samples_id = $rs_lic_samples["InsertID"];
						$result = generar_licencia_pdf($lic_samples_id);
						if (!$result["success"]) {
							echo json_encode($respuesta);
							exit();
						}
						$arr_adjunto = array();
						$licencia_pdf = PATH_REPORTES.$result["archivo"];
						$arr_adjunto[] = $licencia_pdf;
						$pregunta1 = ($pregunta1 == "1") ? "Si" : "No" ;
						$pregunta2 = ($pregunta2 == "1") ? "Si" : "No" ;
						$rangos = array(
							"Entre \$400.000 y \$600.000",
							"Entre \$601.000 y \$800.000",
							"Entre \$801.000 y \$1’000.000",
							"Más de  \$1\’000.000"
						);
						$pregunta3 = $rangos[((int)$pregunta3 - 1)];

						$message = '
							<html>
							<body>

							<p>Se ha generado la licencia N. '.str_pad($lic_samples_id, 6, "0",STR_PAD_LEFT).'</p>
							<table border="1">
							<tr>
							    <td>Nombre:</td> <td><b>'.strtoupper(sanear_string($name)).'</b></td>
							</tr>
							<tr>
							    <td>E-mail:</td> <td><b>'.$email.'</b></td>
							</tr>
							<tr>
							    <td>pregunta1:</td> <td><b>'.$pregunta1.'</b></td>
							</tr>
							<tr>
							    <td colspan="2">'.strtoupper(sanear_string($porque1)).'</td>
							</tr>
							<tr>
							    <td>pregunta2:</td> <td><b>'.$pregunta2.'</b></td>
							</tr>
							<tr>
							    <td colspan="2">'.strtoupper(sanear_string($porque2)).'</td>
							</tr>
							<tr>
							    <td>pregunta3:</td> <td><b>'.$pregunta3.'</b></td>
							</tr>

							</table>

							</body>
							</html>
						';

						$to        = "atencionaudiomu@audiomu.com";
						//$to        = "fas0980@gmail.com";
						$asunto    = 'Licencia No. '.str_pad($lic_samples_id, 6, "0",STR_PAD_LEFT).' Audiomu.com';
						$result    = email($message, $asunto, MAIL_FROMNAME, MAIL_FROM, $to, $arr_adjunto);
						if ($result !== true) {
							$respuesta = array(
								"success"=>false,
								"errors"=>array("reason"=>$result)
							);
							echo json_encode($respuesta);
							exit();
						}

						/*Inicia envio de licencia al usuario*/
						$url = URL_RAIZ.'descargas_sample/'.$privatekey.'/';
						$message = '
							<html>
							<body>
								<p>Hola MuUsuari@</p>
								<p>Queremos agradecerte por Utilizar AudioMu.com </p>
								<p>
									En este mail encuentras en un archivo adjunto  la licencia que has solicitado 
									en nuestro sitio web también nuestro logo en formato png.</p>
								<p>
									Haz <a href="'.$url.'">click aquí</a> para acceder y descargar el 
									archivo de audio de la canción que seleccionaste.</p>
								<p>
									Si tienes alguna duda con tu licencia no te olvides de consultar 
									nuestros <a href="'.URL_RAIZ.'terminos">términos y condiciones</a>. 
								</p>
								<p>
									También puedes comunicarte con nosotros al correo electrónico 
									<a href="mailto:atencionaudiomu@audiomu.com">atencionaudiomu@audiomu.com</a> o en la barra de 
									navegación principal opción <a href="'.URL_RAIZ.'contacto">contacto</a>, estamos a tu disposición.
								</p>
								<p>Pronto tendremos más música y más opciones para acompañar tus grandes proyectos.</p>
								<p>Somos AudioMu.com Música que acompaña tus grandes ideas.<br></p>
								<p>
									Por favor no respondas este e mail ni reenviéis la información, este es un mensaje 
									automático. Puedes comunicarte con nosotros como ha sido indicado arriba. </p>
								<p>
									Este correo electrónico, su contenido y archivos adjuntos pueden 
									contener información confidencial y/o privilegiada. Es para el uso exclusivo de 
									los destinatarios, si no eres el destinatario o la persona responsable, autorizada 
									o designada para hacerles entrega del mensaje aquí contenido, o lo has recibido 
									por error, por favor evita cualquier revisión, difusión, distribución o copia de 
									este mensaje y su contenido pues está estrictamente prohibido. Y te agradecemos 
									que por favor nos lo comuniques al correo electrónico 
									<a href="mailto:atencionaudiomu@audiomu.com">atencionaudiomu@audiomu.com</a>.
								</p>
							</html>
							</body>	
						';
						$arr_adjunto[] = '../img/logo.png';
						$to        = $email;
						$result    = email($message, $asunto, MAIL_FROMNAME, MAIL_FROM, $to, $arr_adjunto);
						if ($result !== true) {
							$respuesta = array(
								"success"=>false,
								"errors"=>array("reason"=>$result)
							);
							echo json_encode($respuesta);
							exit();
						}
						/*foreach ($arr_adjunto as $key => $value) {
							if (is_file($value)) {
								unlink($value);
							}
						}*/
						$respuesta = array(
							"success"=>true,
							"modal"=>true,
							"msg"=>"Revisa tu E-mail",
							"url"=>URL_RAIZ
						);
						echo json_encode($respuesta);
						exit();
					}
					else{
						$respuesta = array(
							"success"=>false,
							"errors"=>array("reason"=>$rs_lic_samples)
						);
						echo json_encode($respuesta);
						exit();
					}
				}
				else{
					$respuesta = array(
						"success"=>false,
						"errors"=>array("reason"=>"Lo sentimos, ya existe una licencia asociada a este E-mail")
					);
					echo json_encode($respuesta);
					exit();
				}

				


				/*$fromName  = MAIL_FROMNAME;
				$fromEmail = MAIL_FROM;
				$to		   = $email;
				email($message, $asunto, $fromName, $fromEmail, $to);*/
			}
		break;
	}
}



?>