<?php
session_start();
include('./lib/config.php');
include('./lib/lib_funciones.php');
include('./lib/lib_layout.php');

$html_tipo_usuario = '';
$rs_tipo_usuario = arr_tipo_usuario();
if ($rs_tipo_usuario["success"]){
	foreach($rs_tipo_usuario["datos"] as $key => $data){
		$html_tipo_usuario .= '<option value="'.$data["tipo_usuario_id"].'">'.utf8_encode($data["tipo_usuario_nombre"]).'</option>';
	}
}
$html_tipo_contacto = '';
$rs_tipo_contacto = arr_tipo_contacto();
if ($rs_tipo_contacto["success"]){
	foreach($rs_tipo_contacto["datos"] as $key => $data){
		$html_tipo_contacto .= '<option value="'.$data["tipo_contacto_id"].'">'.utf8_encode($data["tipo_contacto_nombre"]).'</option>';
	}
}
$html_country = '';
$rs_country = arr_country();
if ($rs_country["success"]){
	foreach($rs_country["datos"] as $key => $data){
		$selected = '';
		if($data["Code"] == 'COL'){
			$selected = 'selected';
		}
		$html_country .= '<option value="'.$data["Code"].'" '.$selected.'>'.$data["Name"].'</option>';
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
		<title>Audiomu, Contáctenos</title>
		<meta name="description" content="Contactso Audiomu ">
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

		<section class="section-contact section clearfix text-center appear">
			<div class="intro-body">
				<div class="container">
					<div class="row">
						<div class="col-md-8 col-md-offset-2 mar-top40">
							<h3><img alt="Contactenos" src="img/contactenos.png"></h3>
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
							<p class="text-center separator-span12-white orange big">
								<strong>Bienvenido MuUsuario</strong>
							</p>
							<p class="text-justify">
								AudioMu se encuentra en construcción y nuestro objetivo es ser un Portal web 
								que ofrece Licencias que permiten el uso en productos audiovisuales, multimedia 
								y creativos de canciones que se encontraran a disposición las 24 horas y que 
								son compuestas por una comunidad de músicos aficionados o profesionales que 
								utilizan AudioMu como una plataforma de exposición para ofrecer sus obras 
								musicales y recibir un beneficio económico.
							</p>
						</div>
					</div><!-- row -->
				</div>
			</div>
			<div class="bg-soft-orange">
				<div class="container">
					<div class="row mar-top40">
						<div class="col-md-8 col-md-offset-2">
							<div class="center-block pad-bot40">
								<div class="sm2-inline-list">
									<form class="form-horizontal" id="contactForm" role="form">
									<fieldset>
									<!-- Text input-->
									<div class="form-group">
									  <label class="col-md-4 control-label" for="nombre">Nombre / Empresa</label>  
									  <div class="col-md-5">
									  <input id="nombre" name="nombre" type="text" placeholder="Tu nombre" class="form-control input-md" required="">
									    
									  </div>
									</div>

									<!-- Text input-->
									<div class="form-group">
									  <label class="col-md-4 control-label" for="email">E-mail</label>  
									  <div class="col-md-5">
									  <input id="email" name="email" type="email" placeholder="Correo electrónico" class="form-control input-md" required="">
									    
									  </div>
									</div>

									<!-- Text input-->
									<div class="form-group">
									  <label class="col-md-4 control-label" for="telefono">Teléfono (Opcional)</label>  
									  <div class="col-md-5">
									  <input id="telefono" name="telefono" type="number" placeholder="Número telefonico" class="form-control input-md">
									    
									  </div>
									</div>

									<!-- Select Basic -->
									<div class="form-group">
									  <label class="col-md-4 control-label" for="tusuario">Tipo de usuario</label>
									  <div class="col-md-5">
									    <select id="tusuario" name="tusuario" class="form-control">
									      <?php echo $html_tipo_usuario; ?>
									    </select>
									  </div>
									</div>

									<!-- Text input-->
									<div class="form-group">
									  <label class="col-md-4 control-label" for="empresa">Empresa (Opcional)</label>  
									  <div class="col-md-5">
									  <input id="empresa" name="empresa" type="text" placeholder="Tu razón social" class="form-control input-md">
									    
									  </div>
									</div>

									<!-- Select Basic -->
									<div class="form-group">
									  <label class="col-md-4 control-label" for="pais">País</label>
									  <div class="col-md-5">
									    <select id="pais" name="pais" class="form-control">
									      <?php echo $html_country; ?>
									    </select>
									  </div>
									</div>

									<!-- Select Basic -->
									<div class="form-group">
									  <label class="col-md-4 control-label" for="tcontacto">Tipo de mensaje</label>
									  <div class="col-md-5">
									    <select id="tcontacto" name="tcontacto" class="form-control">
									      <?php echo $html_tipo_contacto; ?>
									    </select>
									  </div>
									</div>

									<!-- Textarea -->
									<div class="form-group">
									  <label class="col-md-4 control-label" for="mensaje">Mensaje</label>
									  <div class="col-md-5">                     
									    <textarea class="form-control" id="mensaje" name="mensaje" rows="5" required></textarea>
									  </div>
									</div>
									<input type="hidden" name="accion" id="accion" value="contactenos">
									<!-- Button -->
									<button id="contactFormSubmit" name="btn_contacto" class="btn btn-primary btn-lg">Enviar</button>
									</fieldset>
									</form>
								</div><!-- .sm2-inline-list -->
							</div><!-- center-block -->
						</div><!-- .col-md-8 col-md-offset-2 -->
					</div><!-- row -->
				</div>
			</div>
			<div>
				<div class="container">
					<div class="row mar-top0">
						<div class="col-md-10 col-md-offset-1">
							<p class="align-center mar-top20">
								También nos puedes contactar en el correo electrónico
								<br> <a href="mailto:atencionaudiomu@audiomu.com">atencionaudiomu@audiomu.com</a>
							</p>
							<p class="align-center mar-top20">
								John Jairo Hurtado Cubillos
								<br> <a href="mailto:jjhurtadocu@audiomu.com">jjhurtadocu@audiomu.com</a>
							</p>
							<p class="align-center mar-top20">
								Juan Pablo Hurtado Cubillos
								<br> <a href="mailto:juanpablohurtado@audiomu.com">juanpablohurtado@audiomu.com</a>
							</p>
							<p class="align-center mar-top20">
								Fredy Geovanny Abella Flechas
								<br> <a href="mailto:fredyabella@audiomu.com">fredyabella@audiomu.com</a>
							</p>
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
		<script src="js/main.js"></script>
		<script>
			jQuery(".navbar-nav li:eq( 3 )").addClass("active");
		</script>
	</body>
</html>