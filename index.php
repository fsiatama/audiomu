<?php
session_start();
include('./lib/config.php');
include('./lib/lib_funciones.php');
include('./lib/lib_layout.php');

$html_samples = '';
$rs_samples = arr_samples();
if ($rs_samples["success"]){
	foreach($rs_samples["datos"] as $key => $data){
		$html_samples .= '
			<div class="ui360 ui360-vis float-none">
				<a href="sample/mp3/'.$data["samples_archivo"].'">&nbsp;</a>
				Sample '.$data["samples_id"].'<!-- - '.$data["samples_nombre"].'-->
			</div>
		';
	}
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
		<title>Música que acompaña tus grandes ideas </title>
		<meta name="application-name" content="Audiomu.com" />
		<meta name="author" content="John Jairo Hurtado Cubillos, Juan Pablo Hurtado Cubillos, Fredy Geovanny Abella Flechas " />
		<meta name="robots" content="All" />
		<meta name="description" content="En AudioMu.com encontraras música con Licencias de uso que te permitirán acompañar tus proyectos audiovisuales y creativos." />
		<meta name="keywords" content="Música para audiovisuales, acompañamiento musical, música con derechos de autor, música para videos, música para cine y televisión,  música para publicidad, royalty free, licencia de música, derechos de música, música de autor, obras musicales, samples gratis, música rápido, música en línea, música por Internet, compra de música, música intencional, emocional, corporativa, portal de música, portal de licencias musicales, página de licencias musicales" />
		<meta name="rating" content="General" />
		<meta name="dcterms.title" content="Música que acompaña tus grandes ideas" />
		<meta name="dcterms.contributor" content="John Jairo Hurtado Cubillos, Juan Pablo Hurtado Cubillos, Fredy Geovanny Abella Flechas " />
		<meta name="dcterms.creator" content="Fabian Siatama, John Muñoz" />
		<meta name="dcterms.publisher" content="" />
		<meta name="dcterms.description" content="En AudioMu.com encontraras Licencias de uso de música para productos audiovisuales y creativos, ofrecidas por sus autores y todo a través de nuestro portal web." />
		<meta property="og:type" content="website" />
		<meta property="og:title" content="Música que acompaña tus grandes ideas" />
		<meta property="og:description" content="En AudioMu.com encontraras Licencias de uso de música para productos audiovisuales y creativos, ofrecidas por sus autores y todo a través de nuestro portal web." />
		<meta property="og:image" content="<?php echo URL_RAIZ; ?>img/logo-audiomu.png">
		<meta property="og:image:type" content="image/png">
		<meta property="og:image:width" content="286">
		<meta property="og:image:height" content="313">
		<meta property="twitter:title" content="Música que acompaña tus grandes ideas" />
		<meta property="twitter:description" content="En AudioMu.com encontraras Licencias de uso de música para productos audiovisuales y creativos, ofrecidas por sus autores y todo a través de nuestro portal web." />

		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="css/isotope.css" media="screen" />	
		<link rel="stylesheet" href="js/fancybox/jquery.fancybox.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="css/bootstrap.css">
		<link rel="stylesheet" href="css/bootstrap-theme.css">
		<link rel="stylesheet" href="css/style.css">
		<!-- soundManager.useFlashBlock: related CSS -->
		<link rel="stylesheet" type="text/css" href="js/soundmanager/flashblock/flashblock.css" />
		
		<!-- required -->
		<link rel="stylesheet" type="text/css" href="js/soundmanager/360-player/360player.css" />
		<link rel="stylesheet" type="text/css" href="js/soundmanager/360-player/360player-visualization.css" />

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
		<div id="nav" class="pageScrollerNav standardNav hidden-xs hidden-sm">
			<ul>
				<li class="active"><a href="#section-intro">&nbsp;</a></li>
				<li><a href="#section-about">&nbsp;</a></li>
				<li><a href="#section-music">&nbsp;</a></li>
				<li><a href="#section-contact">&nbsp;</a></li>
				<li><a href="#section-terms">&nbsp;</a></li>
			</ul>
		</div>
		<section id="section-intro" class="section intro clearfix text-center appear">
			<div class="intro-body">
				<div class="container">
					<div class="row">
						<div class="col-md-8 col-md-offset-2">
							<img class="mar-top10" alt="Audiomu Logo" src="img/logo-home.png">
							<h3 class="mar-top30 mar-bot30"><span class="txt-light">MÚSICA QUE ACOMPAÑA</span> TUS GRANDES IDEAS</h3>

							<div class="page-scroll">
								<p class="margin0">
									<a class="link-slogan color-white" href="#section-about">
										continua hacia abajo y descubre más<br/>sobre nosotros<br/><img alt="" src="img/btn-arrow-white.png">
									</a>
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- about -->
		<section id="section-about" class="section clearfix text-center">
			<div class="about-section">
				<div class="container">
					<div class="row">
					<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 col-lg-offset-1 col-md-offset-1 col-sm-offset-1">
						<iframe width="560" height="315" src="//www.youtube.com/embed/yuCUMAg2Qpc" frameborder="0" allowfullscreen></iframe>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-5 col-xs-12 col-lg-offset-2 col-md-offset-2">
						<p class="text-left">
							Queremos contarte algo muy importante, aquí encontrarás música 
							para acompañar tus proyectos audiovisuales y creativos y la podrás usar a 
							través de una de nuestras Licencias, 
							haz click en el link de música que encuentras en la barra 
							superior para conocer los tipos de Licencias y precios.
						</p>
						
						<p class="text-left page-scroll appear">
						O si quieres más información sobre AudioMu <a href="<?php echo URL_RAIZ; ?>audiomu" class="">haz click aquí</a>
						o en el enlace de arriba</p>
					</div>
					</div><!-- row -->
				</div>
			</div>
		</section>
		<!-- music -->
		<section id="section-music" class="section clearfix text-center">
			<div class="music-section">
				<div class="container">
					<div class="row mar-top20">
					<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 col-lg-offset-1 col-md-offset-1 col-sm-offset-1">
						<h3 class="align-center">&nbsp;
							<img alt="" class="" src="img/audiomu-music.png">
						</h3>
					</div>
					<div class="col-lg-2 col-md-2 hidden-xs hidden-sm">
						<h3 class="align-center">&nbsp;
							<img alt="" class="" src="img/audiomu-separator-vert.png">
						</h3>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-5 col-xs-12">
						<p class="text-left">
							Sí eres músico y quieres unirte a nuestra comunidad, 
							promocionar y generar ingresos con tus obras
						</p>
						<p class="text-left">
							<strong>preinscríbete para ser parte<br/>de los pioneros</strong>
						</p>
						<p class="text-left page-scroll appear">
							<a href="<?php echo URL_RAIZ; ?>contacto" class="btn btn-warning btn-large">
								<strong>¡Contactenos!</strong>
							</a>
						</p>
					</div>
					</div><!-- row -->
				</div>
			</div>
		</section>
		<!-- contact -->
		<section id="section-contact" class="section clearfix text-center">
			<div class="contact-section">
				<div class="container">
					<div class="row mar-top20">
					<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 col-lg-offset-1 col-md-offset-1 col-sm-offset-1">
						<h3 class="align-center">&nbsp;
							<img alt="" class="" src="img/audiomu-contact.png">
						</h3>
					</div>
					<div class="col-lg-2 col-md-2 hidden-xs hidden-sm">
						<h3 class="align-center">&nbsp;
							<img alt="" class="" src="img/audiomu-separator-vert-left.png">
						</h3>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-5 col-xs-12">
						<h3 class="orange mar-bot0">
							Queremos invitarte<br/>a descargar
						</h3>
						<h1 class="">
							Una muestra<br/>de samples<br/>musicales gratis
						</h1>
						<p class="mar-bot0 appear">
							Y para que los puedas usar, solo necesitas experimentar con nosotros el
							trámite de una licencia y obvio,
						</p>
						<p class="soft-orange">
							<strong>cualquier comentario sobre cómo te fue, es más que bienvenido.</strong>
						</p>
					</div>
					</div><!-- row -->
				</div>
			</div>
		</section>
		<!-- terms -->
		<section id="section-terms" class="section clearfix text-center">
			<div class="terms-section">
				<div class="container">
					<div class="row">
						<div class="col-md-6 col-md-offset-3 hidden-xs hidden-sm">
							<p class="align-center">
								<img alt="" class="" src="img/audiomu-separator-hrz-blue-lg.png">
							</p>
						</div>
						<div class="col-md-8 col-md-offset-2">
							<div id="sm2-container">
								<!-- sm2 flash goes here -->
							</div>
							<div class="center-block appear">
								<div class="sm2-inline-list">
									<?php echo $html_samples; ?>
								</div>
							</div>
						</div>
						<div class="col-md-6 col-md-offset-3 hidden-xs hidden-sm">
							<p class="align-center mar-top20">
								<img alt="" class="" src="img/audiomu-separator-hrz-blue-lg-down.png">
							</p>
						</div>
					</div>
					<div class="row mar-top20">
					<div class="col-md-6 col-md-offset-3">
						<p class="mar-top20 dark-blue">
							Estos son los samples para que los escuches y los descargues con 
							sus respectivas licencias, son una variedad interesante y algo de 
							lo que será nuestra página en un futuro
						</p>
						<p class="">
							<a id="audiomu-tutorial" class="fancybox.iframe" href="http://www.youtube.com/embed/yozAaOcddjs?autoplay=1">
								<i class="fa fa-play"></i> <strong>Video Tutorial</strong>
							</a>
						</p>
						<p>
							<a href="#contact-modal" class="btn btn-info btn-lg fancybox">
								<i class="fa fa-download"></i> <strong>Descargar</strong>
							</a>
						</p>
						<h4 class="mar-top20 soft-blue">
							si quieres oír las canciones completas ingresa aquí
						</h4>
						<p class="">
							<a href="<?php echo URL_RAIZ; ?>musica" class="btn btn-warning btn-lg">
								<i class="fa fa-music"></i> <strong>Música</strong>
							</a>
						</p>
						<h2 class="mar-top20 dark-blue">
							Acuérdate que los samples estarán<br>solo por tiempo limitado
						</h2>
						<h2>
							<span class="bg-orange pad-side10">así que aprovecha.</span>
						</h2>
						<p class="align-center mar-top40">
							<img alt="" class="" src="img/audiomu-separator-hrz-blue.png">
						</p>
						 <p class="link-slogan dark-blue">
							MÁS ADELANTE CONTAREMOS CON<br>MÁS TIPOS DE LICENCIAS,
							<br><strong>MÁS MÚSICA</strong><br>Y MÁS CONTENIDO
						</p>
						<p class="align-center">
							<img alt="" class="" src="img/audiomu-separator-hrz-blue-down.png">
						</p>
						<p class="link-slogan orange">
							GRACIAS POR VISITARNOS.
						</p>
						<p class="align-center mar-top40">
							<img alt="" class="" src="img/audiomu-cow.png">
						</p>
					</div>
					</div><!-- row -->
				</div>
			</div>
		</section>
		<?php 
			echo layout_footer();
			echo layout_download_samples_modal();
			echo layout_modal_alerts();
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
		<script src="js/jquery.fitvids.js"></script>
		<!-- special IE-only canvas fix -->
		<!--[if IE]><script type="text/javascript" src="js/soundmanager/script/excanvas.js"></script><![endif]-->
		<!-- Apache-licensed animation library -->
		<script type="text/javascript" src="js/soundmanager/360-player/script/berniecode-animator-min.js"></script>
		<!-- the core stuff -->
		<script type="text/javascript" src="js/soundmanager/script/soundmanager2-nodebug-jsmin.js"></script>
		<script type="text/javascript" src="js/soundmanager/360-player/script/360player-min.js"></script>
		<script src="js/main.js"></script>
		<script>
			jQuery(".navbar-nav li:eq( 0 )").addClass("active");
			if(jQuery(".fullwidthbanner iframe").length < 1 && jQuery(".fullscreenbanner iframe").length < 1 && jQuery(".fullscreenvideo").length < 1) {
				jQuery("body").fitVids(); 
			}
			$("#audiomu-tutorial").fancybox({
				maxWidth	: 800,
				maxHeight	: 600,
				fitToView	: false,
				width		: '70%',
				height		: '70%',
				autoSize	: false,
				closeClick	: false,
				openEffect	: 'none',
				closeEffect	: 'none'
			});
		</script>
	</body>
</html>