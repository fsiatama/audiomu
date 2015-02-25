<?php
session_start();
include('./lib/config.php');
include('./lib/lib_funciones.php');
include('./lib/lib_layout.php');

$html_samples = '';
$html_music = '';
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

$rs_music = arr_music();
if ($rs_music["success"]){
	foreach($rs_music["datos"] as $key => $data){
		$html_music .= '
			<div class="ui360 ui360-vis float-none">
				<a href="music/mp3/'.$data["music_archivo"].'">&nbsp;</a>
				'.$data["music_nombre"].'
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
		<title>Audiomu, Música</title>
		<meta name="description" content="En Audiomu es un portal para los creadores de los productos audiovisuales y producciones artísticas, donde podran adquirir licencias de obras musicales para su uso.">
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
		<link rel="stylesheet" type="text/css" href="js/soundmanager/360-player/360player-visualization-origin.css" />

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

		<section class="section-music section clearfix text-center appear">
			<div class="intro-body">
				<div class="container">
					<div class="row">
						<div class="col-md-8 col-md-offset-2 mar-top40">
							<h3><img alt="Musica" src="img/musica.png"></h3>
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
		<section class="section clearfix content-section text-center">
			<div>
				<div class="container">
					<div class="row mar-top0">
						<div class="col-md-10 col-md-offset-1">
							<p class="separator-span12-white pad-top10">
								&nbsp;
							</p>
						</div>
					</div><!-- row -->
				</div>
			</div>
			<div class="bg-soft-blue mar-top5">
				<div class="container">
					<div class="row mar-top0 mar-bot30">
						<div class="col-md-10 col-md-offset-1">
							<p class="align-center">
								<img src="img/samples.png" class="" alt="Samples">
							</p>
						</div>
						<div class="col-md-8 col-md-offset-2">
							<div id="sm2-container">
								<!-- sm2 flash goes here -->
							</div>
							<div class="center-block bg-white pad-bot40">
								<div class="sm2-inline-list">
									<?php echo $html_samples; ?>
								</div><!-- .sm2-inline-list -->
							</div><!-- center-block -->
						</div><!-- .col-md-8 col-md-offset-2 -->
						<div class="col-md-10 col-md-offset-1 mar-top10">
							<p class="mar-top20">
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
								<a href="#contact-modal" class="btn btn-primary btn-lg fancybox">
									<i class="fa fa-download"></i> <strong>Descargar</strong>
								</a>
							</p>
						</div>
					</div><!-- row -->
				</div>
			</div>
			<div class="bg-soft-orange">
				<div class="container">
					<div class="row mar-top0">
						<div class="col-md-10 col-md-offset-1">
							<p class="align-center">
								<img src="img/musica.png" class="" alt="Preguntas Frecuentes">
							</p>
						</div>
						<div class="col-md-8 col-md-offset-2">
							<div id="sm2-container">
								<!-- sm2 flash goes here -->
							</div>
							<div class="center-block bg-white pad-bot40">
								<div class="sm2-inline-list">
									<?php echo $html_music; ?>
								</div><!-- .sm2-inline-list -->
							</div><!-- center-block -->
						</div><!-- .col-md-8 col-md-offset-2 -->
						<div class="col-md-10 col-md-offset-1 mar-top10">
							<p class="align-center mar-top20">
								<strong>Si quieres utilizar alguna de nuestras canciones completas, contáctanos!</strong>
							</p>
							<p class="align-center">
								<a href="<?php echo URL_RAIZ; ?>contacto" class="btn btn-default btn-lg dark-blue" role="button"><strong>Contacto</strong></a>
							</p>
						</div>
					</div><!-- row -->
				</div>
			</div>
			<div>
				<div class="container">
					<div class="row mar-top0">
						<div class="col-md-10 col-md-offset-1">
							<p class="separator-span12-white-down mar-top20 ">&nbsp;</p>
						</div>
					</div><!-- row -->
				</div>
			</div>
		</section>
		<section class="section clearfix text-center">
			<div class="terms-section">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<h2 class="orange mar-bot0">
								Sobre las licencias
							</h2>
							<p>Las Licencias otorgadas no constituyen, la compra de las obras, ni la titularidad, ni los derechos de autor correspondientes, estas únicamente te permiten el uso de las obras musicales o de los samples en el producto que definas al diligenciar la Licencia que selecciones. Si quieres más información puedes escribirnos <a href="<?php echo URL_RAIZ; ?>contacto" class="">aquí</a> o al correo atencionaudiomu@audiomu.com. </p>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<div class="panel panel-success">
								<div class="panel-heading">
									<p class="text-center txt-bold">CONDENSADA</p>
								</div>
								<div class="panel-body text-center">
									<p class="lead" style="font-size:40px"><strong>Gratis</strong> </p>
								</div>
								<ul class="list-group list-group-flush text-center">
									<li class="list-group-item"><i class="icon-ok text-danger"></i> Licencia para samples</li>
									<li class="list-group-item"><i class="icon-ok text-danger"></i> Una (1) porción de una canción para un (1) producto audiovisual o creativo</li>
									<li class="list-group-item"><i class="icon-ok text-danger"></i> La Licencia dura 1 año.</li>
								</ul>
								<div class="panel-footer">
									<a href="<?php echo URL_RAIZ; ?>contacto" class="btn btn-lg btn-block btn-danger">Más Información!</a> 
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="panel panel-primary">
								<div class="panel-heading">
									<p class="text-center txt-bold">LARGA VIDA</p>
								</div>
								<div class="panel-body text-center">
									<p class="lead" style="font-size:40px"><strong>$522.000</strong> </p>
								</div>
								<ul class="list-group list-group-flush text-center">
									<li class="list-group-item"><i class="icon-ok text-danger"></i> <br>Licencia para un único producto audiovisual</li>
									<li class="list-group-item"><i class="icon-ok text-danger"></i> Una (1) canción para un (1) producto audiovisual o creativo.</li>
								</ul>
								<div class="panel-footer">
									<a href="<?php echo URL_RAIZ; ?>contacto" class="btn btn-lg btn-block btn-danger">Más Información!</a> 
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="panel panel-danger">
								<div class="panel-heading">
									<p class="text-center txt-bold">DESCREMADA</p>
								</div>
								<div class="panel-body text-center">
									<p class="lead" style="font-size:40px"><strong>$290.000</strong> </p>
								</div>
								<ul class="list-group list-group-flush text-center">
									<li class="list-group-item"><i class="icon-ok text-danger"></i> <br>Licencia para estudiantes</li>
									<li class="list-group-item"><i class="icon-ok text-danger"></i> Solo para estudiantes, una (1) canción para un (1) producto audiovisual que nazca a partir de un proyecto académico</li>
								</ul>
								<div class="panel-footer">
									<a href="<?php echo URL_RAIZ; ?>contacto" class="btn btn-lg btn-block btn-danger">Más Información!</a> 
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4 col-md-offset-2">
							<div class="panel panel-info">
								<div class="panel-heading">
									<p class="text-center txt-bold">SABORIZADA</p>
								</div>
								<div class="panel-body text-center">
									<p class="lead" style="font-size:40px"><strong>$1.392.000</strong> </p>
								</div>
								<ul class="list-group list-group-flush text-center">
									<li class="list-group-item"><i class="icon-ok text-danger"></i> Licencia para programas (seriados)</li>
									<li class="list-group-item"><i class="icon-ok text-danger"></i> Una (1) canción para usar en dos (2) productos audiovisuales seriados con una duración de un (1) año.</li>
								</ul>
								<div class="panel-footer">
									<a href="<?php echo URL_RAIZ; ?>contacto" class="btn btn-lg btn-block btn-danger">Más Información!</a> 
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="panel panel-warning">
								<div class="panel-heading">
									<p class="text-center txt-bold">EN POLVO</p>
								</div>
								<div class="panel-body text-center">
									<p class="lead" style="font-size:40px"><strong>$348.000</strong> </p>
								</div>
								<ul class="list-group list-group-flush text-center">
									<li class="list-group-item"><i class="icon-ok text-danger"></i> Licencia para actos en vivo</li>
									<li class="list-group-item"><i class="icon-ok text-danger"></i> una (1) canción para un (1) producto audiovisual o creativo que se realice en vivo, durante seis (6) meses.</li>
								</ul>
								<div class="panel-footer">
									<a href="<?php echo URL_RAIZ; ?>contacto" class="btn btn-lg btn-block btn-danger">Más Información!</a> 
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<p>
								Para más información sobre las Licencias puedes consultarlas <a href="<?php echo URL_RAIZ; ?>audiomu" class="">aquí</a>
								 o haciendo click en la barra de navegación en ¿Qué es AudioMu? Y revisa la Licencia sobre la que quieres saber más. 
								 Te recomendamos que realices la compra de la Licencia solo si tienes claro su funcionamiento pero si necesitas más 
								 información por favor comunícate con nosotros, estamos a tu disposición para aclarar 
								 todas tus dudas.
							</p>
						</div>
					</div>
				</div>
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
		<!-- special IE-only canvas fix -->
		<!--[if IE]><script type="text/javascript" src="js/soundmanager/script/excanvas.js"></script><![endif]-->
		<!-- Apache-licensed animation library -->
		<script type="text/javascript" src="js/soundmanager/360-player/script/berniecode-animator-min.js"></script>
		<!-- the core stuff -->
		<script type="text/javascript" src="js/soundmanager/script/soundmanager2-nodebug-jsmin.js"></script>
		<script type="text/javascript" src="js/soundmanager/360-player/script/360player-min.js"></script>
		<script src="js/main.js"></script>
		<script>
			jQuery(".navbar-nav li:eq( 2 )").addClass("active");
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