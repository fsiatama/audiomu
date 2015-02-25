<?php
ini_set('session.cookie_domain', '.thesevenseasgroup.info' );
//date_default_timezone_set('America/Bogota');
//header("Content-Type: text/html; charset=iso-8859-1");

define("URL_RAIZ", "http://".$_SERVER['HTTP_HOST']."/");
define("URL_INGRESO", URL_RAIZ."main");
define("PATH_RAIZ", "C:/wamp/www/audiomu/models/");
define("PATH_MEDIA", "C:/wamp/www/audiomu/models/media/");

//Configuración al servidor central
$config['server'] = "localhost";
$config['bd'] = "audiomu";
$config['login'] = "root";
$config['password'] = "";

$coneccion['audiomu'] = $config;


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