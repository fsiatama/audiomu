<?php
ini_set("display_errors", 0);
//ini_set('session.cookie_domain', '.thesevenseasgroup.info' );
date_default_timezone_set('America/Bogota');
//header("Content-Type: text/html; charset=iso-8859-1");

define("URL_RAIZ", "http://".$_SERVER['HTTP_HOST']."/");
define("URL_INGRESO", URL_RAIZ."main");
define("PATH_RAIZ", "C:/wamp/www/audiomu/models/");
define("PATH_MEDIA", PATH_RAIZ."media/");
define("PATH_REPORTES", PATH_RAIZ."rep/");

//Configuración para enviar los reportes especiales
define("MAIL_FROM", "noresponder@audiomu.com");
define("MAIL_FROMNAME", "AudioMu S.A.S.");
define("MAIL_REPLY", MAIL_FROM);
define("MAIL_HOST", "mail.audiomu.com");
define("MAIL_MAILER", "smtp");

//Hack para recibir las variables que son enviados por POST o GET
foreach($_POST as $var => $val)
{
    $$var = $val;
}
foreach($_GET as $var => $val)
{
    $$var = $val;
}


?>