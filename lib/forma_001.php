<?php
//ini_set("display_errors",true);
session_start();
require_once('tcpdf/tcpdf.php');

class PDF extends TCPDF {
	// Cabecera de página
	function Header(){
		// get the current page break margin
		$bMargin = $this->getBreakMargin();
		// get current auto-page-break mode
		$auto_page_break = $this->AutoPageBreak;
		// disable auto-page-break
		$this->SetAutoPageBreak(false, 0);
		// set bacground image
		//$img_file = 'pdf_templates/membrete.png';
		//$this->Image($img_file, 0, 0, 215, 279, '', '', '', false, 300, '', false, false, 0);
		$this->ImageSVG($file='pdf_templates/membrete.svg', $x=0, $y=0, $w='', $h='', $link='', $align='', $palign='', $border=0, $fitonpage=false);
		// restore auto-page-break status
		$this->SetAutoPageBreak($auto_page_break, $bMargin);
		// set the starting point for the page content
		$this->setPageMark();
	}
	
	// Pie de página
	function Footer(){
		/*// Posición: a 1,5 cm del final
		$this->SetY(-15);
		$this->SetFont('times','B',8);
		// Número de página
		$this->Cell(0,10,'Page '.$this->PageNo(),0,0,'C');*/
	}
}
function generar_licencia_pdf($licencia_id){
	$arr = array();
	include_once(PATH_RAIZ."lib/conexion/conexion.php");
	include_once(PATH_RAIZ."audiomu/lib/lic_samples/lic_samplesAdo.php");
	$lic_samplesAdo = new Lic_samplesAdo("audiomu");
	$lic_samples    = new Lic_samples;
	$lic_samples->setLic_samples_id($licencia_id);
	$rs_lic_samples = $lic_samplesAdo->lista($lic_samples);
	if(!is_array($rs_lic_samples) || $rs_lic_samples["total"] == 0){
		$respuesta = array(
			"success"=>false,
			"errors"=>array("reason"=>"No existe la licencia")
		);
		return $respuesta;
	}
	$arr_lic_samples = $rs_lic_samples["datos"][0];
	// create new PDF document
	$pdf = new PDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'Letter', true, 'UTF-8', false);
	// set default header data
	// set header and footer fonts
	$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));

	// set default monospaced font
	$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

	// set margins
	$pdf->SetMargins(22, 35, 21);
	$pdf->SetHeaderMargin(0);
	$pdf->SetFooterMargin(0);

	// remove default footer
	$pdf->setPrintFooter(false);

	// set auto page breaks
	$pdf->SetAutoPageBreak(TRUE, 50);

	// set image scale factor
	$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
	// set font
	$pdf->SetFont('helvetica', '', 10);
	// add a page
	$pdf->AddPage('P','Letter');
	$pdf->setListIndentWidth(5);

	$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

	$html = '
		<p style="text-align:right">LICENCIA No. '.str_pad($arr_lic_samples["lic_samples_id"], 6, "0",STR_PAD_LEFT).'</p>
		<h4>LICENCIA DE USO DE SAMPLES "CONDENSADA"</h4>
		<p style="text-align:justify">
			AudioMu S.A.S. empresa legalmente constituida conforme a las leyes de Colombia, 
			en su calidad de Licenciante confiere a 
			<strong>'.$arr_lic_samples["lic_samples_nombre"].'</strong>, identificado como aparece 
			al final de este documento, la Licencia de uso de las obra(s) descritas en esta Licencia; 
			que se regirá por las siguientes:
		</p>
		<p>Condiciones:</p>
		<ol>
		<li>
			<p style="text-align:justify">
				La presente Licencia otorga al Licenciatario, el uso del Sample o 
				Muestra de la obra musical denominada 
				<strong><i>Sample '.$arr_lic_samples["samples_id"].' - '.$arr_lic_samples["samples_nombre"].'</i></strong>, 
				compuesta e interpretada por JUAN PABLO HURTADO CUBILLOS "Señor Invisible Mudo", 
				obligándose a cumplir con las condiciones expresadas en el portal web www.AudioMu.com y sus 
				términos y condiciones.
			</p>
		</li>
		<li>
			<p style="text-align:justify">
				La Licencia otorgada, no constituye la compra de las obras creadas, ni de 
				los títulos, ni derechos de autor correspondientes.
			</p>
		</li>
		<li>
			<p style="text-align:justify">
				La presente Licencia de samples denominada "Condensada" está basada en el
concepto de "Royalty free" que para AudioMu se refiere al derecho de utilizar material con
derechos de autor o propiedad intelectual, en un (1) único proyecto audiovisual o creativo
sin restricción geografía, publicación o reproducción del producto resultante del proyecto,
en esta Licencia en particular la Muestra o Sample es una porción determinada y editada
por AudioMu, de una canción y que no se puede modificar.
			</p>
		</li>
		<li>
			<p style="text-align:justify">
				Esta Licencia es válida únicamente por el periodo de un (1) año, de ser necesario
contar con los derechos por más de este periodo o por tiempo indefinido, puede adquirir la
Licencia de la canción completa también a través del portal web www.audiomu.com en
"contacto" o directamente cuando sea habilitada la función.
			</p>
		</li>
		<li>
			<p style="text-align:justify">
				La presente Licencia, permite al Licenciatario usar la Muestra o Sample de la obra
musical en mención, que ha sido editada por AudioMu.com, únicamente en el producto que
a continuación describe.
			</p>
			<p>
				Descripción del proyecto:
			</p>
			<p style="text-align:justify">
				<i>'.$arr_lic_samples["lic_samples_desc"].'</i>
			</p>
		</li>
		<li>
			<p style="text-align:justify">
				Como "uso" de la música se refiere a la sincronización de la canción con una imagen,
video o fonograma, este "uso" está condicionado al producto con el que es sincronizado, es
decir, que no importa cuántas veces ni como se utilice la canción dentro del producto con el
que se sincroniza, ni el tiempo de duración o extensión de este mientras sea utilizado
únicamente para ese proyecto. Esta Licencia también permite que ese producto final sea
reproducido cuantas veces se quiera, que sea publicado, comunicado o presentado en los
medios que se deseen y de igual forma distribuido.
			</p>
		</li>
		<li>
			<p style="text-align:justify">
				El permiso de "uso" o la Licencia de la canción en ese producto o proyecto específico
es dado con un límite de tiempo de un año y no tiene delimitación geográfica, pero no
significa que se tengan los derechos o pertenencia sobre ésta, no se puede distribuir,
reproducir, poner a disposición, revender, modificar o transformar la obra musical o archivo
de audio que se ha licenciado en este caso particular la Muestra o Sample de la obra y
demás indicaciones que se especifiquen en esta Licencia.
			</p>
			<p style="text-align:justify">
				Todo lo anterior, sin perjuicio de los derechos morales de autor y patrimoniales no
licenciados en el presente documento.
			</p>
		</li>
		<li>
			<p style="text-align:justify">
				No se pacta exclusividad alguna del uso de la presente creación, y 
				se libera a AudioMu de todo tipo de responsabilidad frente a la 
				competencia por el uso malintencionado de la obra musical licenciada.
			</p>
		</li>
		<li>
			<p style="text-align:justify">
				Todos los productos que utilicen la obra aquí licenciada, deberán dar crédito del
artista autor-compositor, e intérprete y obliga de manera especial al adquirente a enunciar
que la presente obra ha sido adquirida de la empresa o portal web AudioMu.com.
			</p>
			<p style="text-align:justify">
				Para todos aquellos proyectos en los que se presenten créditos el comprador debe, en
estos, nombrar al artista como autor/compositor e intérprete según corresponda y a la
página AudioMu.com como fuente o distribuidor del producto.
			</p>
		</li>
	
		<li>
			<p style="text-align:justify">
				Limitaciones de uso. Todas las canciones y Licencias están amparadas bajo los
derechos de autor "copyright", no se permite su reventa o uso en condiciones diferentes a
las estipuladas en la Licencia, el contrato y los términos y condiciones. Para todos los casos
esta Licencia no representa ni permite:
			</p>
			<ol style="list-style-type:lower-alpha;">
				<li>
					La cesión, adquisición o posesión de los derechos patrimoniales de la(s) canción(es)
referenciada(s) en la presente Licencia.
				</li>
				<li>
					La reventa o sub-licenciamiento total o parcial de la música. (incluye su venta para
uso cómo ringtones en todas su variedades).
				</li>
				<li>
					La transformación de la canción, incluyendo la adición de letra, composición y/o
notas y ponerla a la venta como una nueva obra para cualquier propósito o usar esta
modificación en otros productos.
				</li>
				<li>
					No se puede Crear compilaciones de audio (cd, dvd, archivo digital) de música
descargada de AudioMu y ponerlo a la venta o distribuirlo como propio.
				</li>
				<li>
					AudioMu no efectúa intervención alguna frente a negociaciones que tengan relación
con banda sonora. Sin embargo servirá como medio para el primer contacto con él titular de
los derechos para que se realice la negociación entre las partes interesadas.
				</li>
				<li>
					Se prohíbe habilitar la descarga de la música adquirida en AudioMu, por medio de
cualquier portal web, paquete de datos, o cualquier otro medio que lo permita. Si se hace
con carácter oneroso habrá lugar a las acciones de responsabilidad civil para el pago de las
indemnizaciones a que haya lugar. En caso de incumplir esta disposición habrá una
resolución del contrato y se presentara la denuncia penal pertinente, por la comisión de los
delitos a los que haya lugar.
				</li>
				<li>
					No se puede utilizar la música de AudioMu como parte de propaganda, publicidad,
apoyo o cualquier producto relacionado con: grupos por fuera de la ley, pornografía infantil
o material calumnioso y/o difamatorio o que atente contra la integridad de terceros y la
sociedad en general; y todos aquellos que están en contra del ordenamiento jurídico, la
moral y las buenas costumbres.
				</li>
			</ol>
		</li>
		<li>
			<p style="text-align:justify">
				Esta es una Licencia de uso, está incluida la sincronización que se refiere 
				a la combinación o fijación de una composición musical o audio en una obra 
				audiovisual, a la mezcla de imágenes o en un fonograma constituyendo una 
				nueva obra como una unidad. Como por ejemplo con uno de estos 
				productos: un filme, un programa de televisión, comerciales, 
				"Voice-Over" - voz superpuesta, obra teatral, entre otros.
			</p>
		</li>
		<li>
			<p style="text-align:justify">
				Quien adquiere la Licencia tiene la posibilidad de uso personal o privado de la creación, sin
habilitar la transferencia a otros usuarios.
			</p>
		</li>
		<li>
			<p style="text-align:justify">
				Bajo ninguna circunstancia podrán transferirse derechos otorgados por la presente
Licencia.
			</p>
		</li>
		<li>
			<p style="text-align:justify">
				AudioMu declara tener la autorización del titular de los derechos 
				patrimoniales para realizar la comercialización de las obras mediantes la 
				Licencia aquí expuesta. Y que este ha expresado que su obra, hasta el 
				momento en que se genera esta Licencia, no pertenece o hace parte de 
				ninguna sociedad de gestión colectiva, editora o disquera y/o que su obra 
				está comprometida bajo contrato con alguna otra parte y que por lo mismo 
				ninguna de las mencionadas pude reclamar al titular de esta Licencia 
				algún otro derecho o reconocimiento por el uso de la obra musical en las 
				condiciones expuestas en esta Licencia.
			</p>
		</li>
		<li>
			<p style="text-align:justify">
				El tomador de la Licencia permite que a través de AudioMu terceros puedan 
				consultar información  relacionada con esta, con el propósito de dar 
				confianza y seguridad sobre la veracidad de la adquisición y brindar 
				información sobre los proyectos en los que la obra musical ha sido usada. 
				La información que será presentada en la consulta de Licencia será su 
				número de consecutivo, el nombre del licenciado, la canción licenciada 
				y la descripción del proyecto en la que se usará, y la información 
				presentada en la información de la canción será la descripción del 
				proyecto del que habría hecho parte.
			</p>
		</li>
		</ol>
		<p style="text-align:justify">
			Las partes de manera libre, consciente y voluntaria aceptan las condiciones de la presente
Licencia
		</p>
		<p style="text-align:justify">
			Siendo las '.date("G").' horas del día '.date("j").' del mes de '.$meses[date('n')-1].' 
			de '.date("Y").', se establece el presente acuerdo. (esto es estampado de tiempo)
		</p><br><br>
	';
	//(esto es estampado de tiempo)
	$pdf->writeHTML($html, true, 0, true, 0);

	$left_column = 'AudioMu S.A.S.<br>NIT: 900748358-7';
	$pdf->writeHTMLCell(80, '', '', $y, $left_column, 0, 0, 0, true, 'J', true);

	$right_column = '
		MuUsario: '.$arr_lic_samples["lic_samples_nombre"].'<br>
		C.C. / NIT. '.$arr_lic_samples["lic_samples_ident"].'
	';
	$pdf->writeHTMLCell(80, '', '', '', $right_column, 0, 1, 0, true, 'J', true);

	$html = '
		<br>
		<p style="text-align:justify">
			Para quien necesite confirmación sobre la validez de la Licencia se puede comunicar al
correo atencionaudiomu@audiomu.com o en el área de "Contacto" en el portal web
www.audiomu.com.
		</p>
	';
	$pdf->writeHTML($html, true, 0, true, 0);
	$nombre = 'licencia '.$licencia_id.' Sample '.$arr_lic_samples["samples_id"].' - '.$arr_lic_samples["samples_nombre"].'.pdf';
	$pdf->Output(PATH_REPORTES.$nombre, 'f');
	$respuesta = array(
		"success"=>true,
		"archivo"=>$nombre
	);
	return $respuesta;
}




?>