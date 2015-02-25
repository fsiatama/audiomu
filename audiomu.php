<?php
session_start();
include('./lib/config.php');
include('./lib/lib_layout.php');
include_once(PATH_RAIZ."lib/conexion/conexion.php");

include_once(PATH_RAIZ."audiomu/lib/frecuentes/frecuentesAdo.php");
$frecuentesAdo = new FrecuentesAdo("audiomu");
$frecuentes    = new Frecuentes;
$rs_frecuentes = $frecuentesAdo->lista($frecuentes);
if(!is_array($rs_frecuentes)){
	$respuesta = array(
		"success"=>false,
		"errors"=>array("reason"=>$rs_frecuentes)
	);
	echo json_encode($respuesta);
	exit();
}
$html_frecuentes = '';
foreach($rs_frecuentes["datos"] as $key => $data){
	$str = utf8_encode($data["frecuentes_respuesta"]);
	eval("\$str = '$str';");
	$html_frecuentes .= '
		<div class="toggle">
			<label>'.utf8_encode($data["frecuentes_pregunta"]).'</label>
			<div class="toggle-content bg-md-blue">
				<p>'.$str.'</p>
			</div>
		</div>
	';
}


?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
	<head>
		<!-- BASICS -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title>Audiomu, productos audiovisuales y producciones artísticas</title>
		<meta name="description" content="En Audiomu es un portal para los creadores de los productos audiovisuales y producciones artísticas, donde podran adquirir licencias de obras musicales para su uso.">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="css/isotope.css" media="screen" />	
		<link rel="stylesheet" href="js/fancybox/jquery.fancybox.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="css/bootstrap.css">
		<link rel="stylesheet" href="css/bootstrap-theme.css">
		<link rel="stylesheet" href="css/style.css">
		
		<link rel="apple-touch-icon" sizes="57x57" href="apple-touch-icon-57x57.png">
		<link rel="apple-touch-icon" sizes="114x114" href="apple-touch-icon-114x114.png">
		<link rel="apple-touch-icon" sizes="72x72" href="apple-touch-icon-72x72.png">
		<link rel="apple-touch-icon" sizes="144x144" href="apple-touch-icon-144x144.png">
		<link rel="apple-touch-icon" sizes="60x60" href="apple-touch-icon-60x60.png">
		<link rel="apple-touch-icon" sizes="120x120" href="apple-touch-icon-120x120.png">
		<link rel="apple-touch-icon" sizes="76x76" href="apple-touch-icon-76x76.png">
		<link rel="apple-touch-icon" sizes="152x152" href="apple-touch-icon-152x152.png">
		<link rel="icon" type="image/png" href="favicon-196x196.png" sizes="196x196">
		<link rel="icon" type="image/png" href="favicon-160x160.png" sizes="160x160">
		<link rel="icon" type="image/png" href="favicon-96x96.png" sizes="96x96">
		<link rel="icon" type="image/png" href="favicon-16x16.png" sizes="16x16">
		<link rel="icon" type="image/png" href="favicon-32x32.png" sizes="32x32">
		<meta name="msapplication-TileColor" content="#2d89ef">
		<meta name="msapplication-TileImage" content="mstile-144x144.png">
		<script src="js/modernizr-2.6.2-respond-1.1.0.min.js"></script>
	</head>
	 
	<body>
		<?php echo layout_header_menu(); ?>
		<section class="section-audiomu section clearfix text-center appear">
			<div class="intro-body">
				<div class="container">
					<div class="row">
						<div class="col-md-8 col-md-offset-2">
							<h3><img alt="que es audiomu" src="img/que-es-audiomu.png"></h3>
							<div class="page-scroll">
								<p class="mar-bot60">
									<a class="link-slogan color-white " href="#">
										<img alt="" src="img/btn-arrow-white-sm.png">
									</a>
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<section class="section clearfix">
			<div class="content-section">
				<div class="container">
					<div class="row mar-top0">
						<div class="col-md-10 col-md-offset-1">
							<p class="text-justify separator-span12-white">
								En AudioMu te ofrecemos Licencias de uso de obras musicales puestas a disposición por sus autores, para que puedas acompañar tus proyectos audiovisuales y creativos, te invitamos a explorar nuestro portal web y escuchar nuestros Samples y Canciones. Recuerda, en este momento estamos en construcción.
							</p>
							<p class="text-justify">
								Sabemos que cuando se trabaja con audiovisuales el acompañamiento de música, va a presentar complicaciones tales como, encontrar la canción adecuada para la intención y emoción que se quiere plasmar, hasta los trámites para poder usarla o incluso crearla. Y Para el músico es un proceso igual de arduo, buscar clientes, componer la canción deseada, efectuar los trámites, a veces repetir el proceso y aún más difícil es vender lo ya creado. Por esto en AudioMu buscamos ayudarlos a establecer ese vínculo entre lo audio y lo visual.
							</p>
							<p class="text-justify">
								Pronto contaras con más información y funcionalidades de nuestro portal web, que estamos construyendo a tu medida. Si necesitas o quieres conocer más sobre AudioMu y nuestro portal web puedes consultar los
								<a class="orange" href="<?php echo URL_RAIZ; ?>terminos">términos y condiciones.</a>
							</p>
						</div>
					</div><!-- row -->
					<div class="row mar-top40">
						<div class="col-md-10 col-md-offset-1">
							<p class="align-center">
								<img alt="Preguntas Frecuentes" class="" src="img/preguntas-frecuentes.png">
							</p>
							<div class="toogle pad10 bg-dark-blue">
								<?php echo $html_frecuentes; ?>
							</div><!-- accordion -->
							<p class="separator-span12-white-down mar-top20 ">&nbsp;</p>
						</div><!-- col-md-10 -->
					</div><!-- row -->
				</div>
			</div>
		</section>
		<section class="section clearfix text-center">
			<div class="terms-section">
				<div class="container">
					<div class="row">
						<div class="col-md-6 col-md-offset-3">
							<p class="align-center">
								<img alt="" class="" src="img/audiomu-cow.png">
							</p>
						</div>
					</div><!-- row -->
				</div>
			</div>
		</section>
		<?php 
			echo layout_footer_orange();
			echo layout_analytics();
		?>
	
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.0.min.js"><\/script>')</script>
		<script src="js/jquery.easing.1.3.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/fancybox/jquery.fancybox.pack.js"></script>
		<script src="js/skrollr.min.js"></script>		
		<script src="js/jquery.scrollTo-1.4.3.1-min.js"></script>
		<script src="js/jquery.localscroll-1.2.7-min.js"></script>
		<script src="js/jquery.appear.js"></script>
		<script src="js/jquery.pagescroller.lite.js"></script>
		<script src="js/jquery.queryloader2.min.js"></script>
		<script src="js/main.js"></script>
		<script>
			jQuery(".navbar-nav li:eq( 1 )").addClass("active");
		</script>
	</body>
</html>