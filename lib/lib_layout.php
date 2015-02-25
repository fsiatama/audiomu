<?php
//print_r($_SERVER);
include_once("config.php");
function layout_analytics(){
	$return = "
		<script>
		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		  ga('create', 'UA-17938304-1', 'auto');
		  ga('send', 'pageview');

		</script>
	";
	return $return;
}
function layout_header_menu(){
	$return = '
	<section id="header" class="appear"></section>
	<div class="navbar navbar-fixed-top" role="navigation">
		 <div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="fa fa-bars"></span>
				</button>
			</div>
			<div class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
					<li>
						<a href="'.URL_RAIZ.'"><img alt="" class="" src="img/menu-inicio.png"></a>
					</li>
					<li><a href="'.URL_RAIZ.'audiomu"><img alt="" class="" src="img/menu-about.png"></a></li>
					<li><a href="'.URL_RAIZ.'musica"><img alt="" class="" src="img/menu-musica.png"></a></li>
					<li>
						<a href="'.URL_RAIZ.'contacto"><img alt="" class="" src="img/menu-contact.png"></a>
					</li>
					<li><a href="'.URL_RAIZ.'terminos"><img alt="" class="" src="img/menu-terms.png"></a></li>
					<li class="menu-social hidden-xs">
						<a target="_blank" href="https://www.facebook.com/audiomu">
							<i class="fa fa-facebook-square fa-2x color-blue-faceb"></i>
						</a>
						<a target="_blank" href="https://twitter.com/audiomu"><i class="fa fa-twitter-square fa-2x"></i></a>
						<a target="_blank" href="http://vimeo.com/audiomu"><i class="fa fa-vimeo-square fa-2x"></i></a>
						<a target="_blank" href="https://www.youtube.com/channel/UCOHfhddbbt2eYcriZfyi33Q">
							<i class="fa fa-youtube-square fa-2x"></i>
						</a>
					</li>
				</ul>
			</div><!--/.navbar-collapse -->
		</div>
	</div>
	';
	return $return;
}
function layout_footer(){
	$return = '
	<section id="footer" class="section footer">
		<div class="footer-section">
			<div class="container">
				<div class="row animated opacity mar-bot20 mar-top20" data-andown="fadeIn" data-animation="animation">
					<div class="col-sm-12 align-center">
						<ul class="footer-menu-links">
							<li><a href="'.URL_RAIZ.'">Inicio</a></li>
							<li><a href="'.URL_RAIZ.'audiomu">¿Qué es AudioMu?</a></li>
							<li><a href="'.URL_RAIZ.'musica">Música</a></li>
							<li><a href="'.URL_RAIZ.'contacto">Contacto</a></li>
							<li><a href="'.URL_RAIZ.'terminos">Terminos y condiciones</a></li>
						</ul>			
					</div>
				</div>
	
				<div class="row align-center copyright">
						<div class="col-sm-12"><p>&copy; 2014 Audiomu.com &middot;</p></div>
				</div>
			</div>
		</div>
	</section>
	<a href="#header" class="scrollup"><i class="fa fa-chevron-up"></i></a>
	';
	return $return;
}
function layout_footer_orange(){
	$return = '
	<section id="footer" class="section footer">
		<div class="footer-section-orange">
			<div class="container">
				<div class="row animated opacity mar-bot20 mar-top20" data-andown="fadeIn" data-animation="animation">
					<div class="col-sm-12 align-center">
						<ul class="footer-menu-links">
							<li><a href="'.URL_RAIZ.'">Inicio</a></li>
							<li><a href="'.URL_RAIZ.'audiomu">¿Qué es AudioMu?</a></li>
							<li><a href="'.URL_RAIZ.'musica">Música</a></li>
							<li><a href="'.URL_RAIZ.'contacto">Contacto</a></li>
							<li><a href="'.URL_RAIZ.'terminos">Terminos y condiciones</a></li>
						</ul>			
					</div>
				</div>
	
				<div class="row align-center copyright">
						<div class="col-sm-12"><p>&copy; 2014 Audiomu.com &middot;</p></div>
				</div>
			</div>
		</div>
	</section>
	<a href="#header" class="scrollup"><i class="fa fa-chevron-up"></i></a>
	';
	return $return;
}
function layout_download_samples_modal(){
	$html_samples = '';
	$rs_samples = arr_samples();
	if ($rs_samples["success"]){
		foreach($rs_samples["datos"] as $key => $data){
			$html_samples .= '<option value="'.$data["samples_id"].'">Sample '.$data["samples_id"].' - '.$data["samples_nombre"].'</option>';
		}
	}
	$return = '
		<!-- modal-->
		<div class="" style="display:none">
			<div id="contact-modal">
				<div class="container">
					<div class="row mar-bot40">
						<div class="col-md-offset-3 col-md-6">
							<div class="section-header">
								<p class="color-white big-advent">
									ANTES DE CONTINUAR QUEREMOS QUE SEPAS
								</p>
								<h2 class="section-heading animated">
									SOBRE LA LICENCIA DE ESTOS SAMPLES
								</h2>
								<p class="align-center mar-top40">
									<img alt="" class="" src="img/audiomu-separator-hrz-white.png">
								</p>
								<p class="align-center color-white big">
									<strong>LICENCIA</strong>
								</p>
								<hr>
								<p class="align-center color-white">
									Los samples son solo una porción determinada y editada por AudioMu, de algunas de sus canciones y no se pueden modificar. Basada en el concepto de "Royalty free" se puede utilizar este “Sample” en un (1) proyecto audiovisual o creativo válido por el periodo de un (1) año y sin restricción geográfica, publicación o reproducción del producto resultante del proyecto a cambio de diligenciar una encuesta y la licencia de uso para poder utilizar el “Sample”. 
								</p>
								<hr>
								<p class="mar-top20 big-advent dark-blue">
									PARA DESCARGAR LLENA <strong>LOS SIGUIENTES DATOS</strong>
								</p>
							</div>
						</div>
					</div>
					<form class="form-horizontal" id="contactForm" role="form">
						<div class="row">
							<div class="col-md-8 col-md-offset-2">
								<div class="color-white">
									<div id="sendmessage">
										 Your message has been sent. Thank you!
									</div>
									<div class="form-group">
										<label for="name" class="col-sm-4 control-label">Nombre / Empresa</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" name="name" id="name" placeholder="Tu Nombre" required />
										</div>
									</div>
									<div class="form-group">
										<label for="documento" class="col-sm-4 control-label">Doc. de identidad / NIT</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" name="documento" id="documento" placeholder="Tu Identificación" required />
										</div>
									</div>
									<div class="form-group">
										<label for="email" class="col-sm-4 control-label">Correo electrónico</label>
										<div class="col-sm-8">
											<input type="email" class="form-control" name="email" id="email" placeholder="Tu Email" required />
										</div>
									</div>
									<div class="form-group">
										<label for="sample_select" class="col-sm-4 control-label">Sample</label>
										<div class="col-sm-8">
											<select required class="form-control" name="sample" id="sample_select">
												'.$html_samples.'
											</select>
										</div>
									</div>
									<div class="form-group">
										<label for="descripcion" class="col-sm-4 control-label">
											Descripción (Se tan explicativo como puedas)
										</label>
										<div class="col-sm-8">
											<textarea class="form-control" id="descripcion" name="descripcion" rows="5" required placeholder="Ejemplo, vídeo institucional para AudioMu sobre como utilizar el portal web"></textarea>
										</div>
									</div>
									<hr>
									<p class="align-center color-white">
										Queremos hacer un portal a tu medida y te agradecemos por el tiempo que te estas tomando para darnos tu opinión
									</p>
									<div class="align-center color-white">
										<ol>
											<li>
												¿La interfaz de la página web te permite una navegación fácil y dinámica?
												<div class="form-group">
													<div class="radio-inline">
													  <label>
													    <input type="radio" name="pregunta1" value="1" required>
													    si
													  </label>
													</div>
													<div class="radio-inline">
													  <label>
													    <input type="radio" name="pregunta1" value="0" required>
													    no
													  </label>
													</div>
												</div>
												<div class="form-group">
													<label for="porque1" class="col-sm-4 control-label">Por qué (Opcional)</label>
													<div class="col-sm-8">
														<input type="text" class="form-control" name="porque1" id="porque1" />
													</div>
												</div>
											</li>
											<li>
												¿Adquirirías el audio completo para tu proyecto audiovisual a través de este portal web? 
												<div class="form-group">
													<div class="radio-inline">
													  <label>
													    <input type="radio" name="pregunta2" value="1" required>
													    si
													  </label>
													</div>
													<div class="radio-inline">
													  <label>
													    <input type="radio" name="pregunta2" value="0" required>
													    no
													  </label>
													</div>
												</div>
												<div class="form-group">
													<label for="porque2" class="col-sm-4 control-label">Por qué (Opcional)</label>
													<div class="col-sm-8">
														<input type="text" class="form-control" name="porque2" id="porque2"/>
													</div>
												</div>
											</li>
											<li>
												¿Cuánto sería lo máximo que estarías dispuesto a pagar por una composición musical de stock?
												<div class="form-group">
													<div class="col-sm-8 col-sm-offset-3">
														<select required class="form-control" name="pregunta3" id="pregunta3">
															<option value="1">Entre $400.000 y $600.000</option>
															<option value="2">Entre $601.000 y $800.000</option>
															<option value="3">Entre $801.000 y $1’000.000</option>
															<option value="4">Más de  $1’000.000</option>
														</select>
													</div>
												</div>
											</li>
										</ol>
									</div>
								</div>
							</div>
							<!-- ./span12 -->
						</div> <!-- ./row -->
						<div class="row mar-bot40">
							<div class="col-md-offset-3 col-md-6">
								<hr>
								<div class="align-center mar-bot10">
									<a class="big soft-blue" target="_blank" href="'.URL_RAIZ.'terminos">Ver términos y condiciones</a>
									<div class="form-group">
										<div class="checkbox-inline color-white">
											<label>
										    	<input type="checkbox" required> He leído y acepto los <a target="_blank" href="'.URL_RAIZ.'terminos">terminos y condiciones</a>
											</label>
										</div>
									</div>
								</div>
								<div class="align-center">
									<button id="contactFormSubmit" type="submit" class="btn btn-warning btn-lg"><i class="fa fa-download"></i> Descargar</button>
								</div>
							</div> <!-- ./col-md-offset-3 col-md-6 -->
						</div> <!-- ./row -->
						<input type="hidden" name="accion" id="accion" value="download_sample">
					</form>
					<div class="row mar-top20">
						<div class="col-md-8 col-md-offset-2">
							<p class="align-center color-white">
								Para que sea válido y legal el uso del sample debes de haber diligenciado los datos y recibido la licencia "Condensada –Sample" en tu correo y <strong>también dar los créditos correspondientes al compositor e intérprete de la obra y a nosotros AudioMu.com como el medio de adquisición de la Licencia y descarga de la música.</strong> 
							</p>
							<p class="align-center color-white">
								SOLO se podrá utilizar el sample tal cual como lo ha ofrecido AudioMu. El uso de cualquier otra porción de la canción original no está autorizado bajo esta licencia. 
							</p>
							<p class="align-center mar-top10">
								<img alt="" class="" src="img/audiomu-separator-hrz-white-down.png">
							</p>
							<p class="align-center mar-top10">
								<img alt="" class="" src="img/audiomu.png">
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /modal-->
	';
	return $return;
}
function layout_modal_alerts(){
	$return = '
		<!-- MODALS DIALOGS -->
		<div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="errorModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<!-- modal header -->
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title" id="errorModalLabel"><i class="fa fa-warning"></i> Error!</h4>
					</div>
					<!-- /modal header -->
					<!-- modal body -->
					<div class="modal-body">
						<div id="modal-error-msg" class="">
						</div>
					</div>
					<!-- /modal body -->
					<div class="modal-footer margin-top0">
						<!-- modal footer -->
						<button class="btn btn-info btn-lg" data-dismiss="modal">Cerrar</button>
					</div>
					<!-- /modal footer -->
				</div>
			</div>
		</div>
		<div class="modal fade" id="sucessModal" tabindex="-1" role="dialog" aria-labelledby="sucessModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<!-- modal header -->
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title" id="sucessModalLabel"><i class="fa fa-check"></i> Success!</h4>
					</div>
					<!-- /modal header -->
					<!-- modal body -->
					<div class="modal-body">
						<div id="modal-success-msg" class="">
						</div>
					</div>
					<!-- /modal body -->
					<div class="modal-footer margin-top0">
						<!-- modal footer -->
						<button class="btn btn-info btn-lg" data-dismiss="modal">Cerrar</button>
					</div>
					<!-- /modal footer -->
				</div>
			</div>
		</div>
	';
	return comprimir($return);
}
?>