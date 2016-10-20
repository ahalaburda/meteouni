<?php 
	include('class/simplehtmldom/simple_html_dom.php');
	include('changeImage.php');

	$url= 'http://www.meteorologia.gov.py/interior.php?depto=7';
	$html = file_get_html($url);

	if ($html != null) {
		foreach ($html->find('img') as $element)
			$element->src = 'http://www.meteorologia.gov.py/' . $element->src;

		$html->find('title', 0)->outertext = '';
		$html->find('meta', 0)->outertext = '';
		$html->find('style', 0)->outertext = '';
		$html->find('table tbody tr', 0)->outertext = '';

		$html->find('div div', 0)->outertext = "Pron&oacute;stico extendido para la ciudad de Encarnaci&oacute;n";

		foreach ($html->find('br') as $br)
		$br->outertext = '';

		foreach ($html->find('a') as $a)
		$a->outertext = '';
		foreach ($html->find('b') as $b)
		$b->outertext = '';

		$html->find('table', 0)->width = '100%';
		$html->find('table', 1)->width = '100%';

		$html->find('td[height=55]', 0)->bgcolor = '#ffffff';

		$cuerpo = $html->find('table tbody tr', 2);
		$cuerpo->style = 'text-align:center';

		//dias
		$td1 = $cuerpo->find('td', 1);
		$td3 = $cuerpo->find('td', 3);
		$td5 = $cuerpo->find('td', 5);

		//imagenes
		$td7 = $cuerpo->find('td', 7);
		$td9 = $cuerpo->find('td', 9);
		$td11 = $cuerpo->find('td', 11);

		//pronosticos
		$td13 = $cuerpo->find('td', 13);
		$td15 = $cuerpo->find('td', 15);
		$td17 = $cuerpo->find('td', 17);

		//maximas y minimas
		$td19 = $cuerpo->find('td', 19);
		$td21 = $cuerpo->find('td', 21);
		$td23 = $cuerpo->find('td', 23);

		$td1->class = false;
		$td3->class = false;
		$td5->class = false;

		$td1->width = false;
		$td3->width = false;
		$td5->width = false;

		$td1->style = 'text-align:center;text-transform:uppercase';
		$td3->style = 'text-align:center;text-transform:uppercase';
		$td5->style = 'text-align:center;text-transform:uppercase';

		$td19->find('p', 0)->style = 'text-align:center';
		$td21->find('p', 0)->style = 'text-align:center';
		$td23->find('p', 0)->style = 'text-align:center';

		//carga los pronosticos como titles de las imagenes
		$pronostico1 = $td13->find('span', 0)->innertext;
		$pronostico2 = $td15->find('span', 0)->innertext;
		$pronostico3 = $td17->find('span', 0)->innertext;
		$td7->title = $pronostico1;
		$td9->title = $pronostico2;
		$td11->title = $pronostico3;

		//eliminamos tr de los pronosticos
		$tr2 = $cuerpo->find('tr', 2);
		$tr2->outertext = '';

		//elimina td's inutiles
		$td2 = $cuerpo->find('td', 2);
		$td4 = $cuerpo->find('td', 4);
		$td6 = $cuerpo->find('td', 6);
		$td8 = $cuerpo->find('td', 8);
		$td10 = $cuerpo->find('td', 10);
		$td12 = $cuerpo->find('td', 12);
		$td14 = $cuerpo->find('td', 14);
		$td16 = $cuerpo->find('td', 16);
		$td18 = $cuerpo->find('td', 18);
		$td20 = $cuerpo->find('td', 20);
		$td22 = $cuerpo->find('td', 22);
		$td24 = $cuerpo->find('td', 24);
		$td2->outertext = '';
		$td4->outertext = '';
		$td6->outertext = '';
		$td8->outertext = '';
		$td10->outertext = '';
		$td12->outertext = '';
		$td14->outertext = '';
		$td16->outertext = '';
		$td18->outertext = '';
		$td20->outertext = '';
		$td22->outertext = '';
		$td24->outertext = '';

		foreach ($html->find('strong') as $b)
		$b->outertext = $b->outertext . '<br>';

		$cuerpo->find('td[height=334]', 0)->height = '0';

		$actualizacion = $html->find('div div', 1)->innertext;
		
		$hoy = $td1->innertext;
		$manhana = $td3->innertext;
		$pasado = $td5->innertext;

		$srcImagenHoy = $td7->find('div img', 0)->src;
		$srcImagenManhana = $td9->find('div img', 0)->src;
		$srcImagenPasado = $td11->find('div img', 0)->src;
		
		$srcImagenHoy = change_image($srcImagenHoy);
		$srcImagenManhana = change_image($srcImagenManhana);
		$srcImagenPasado = change_image($srcImagenPasado);

		$tempHoy = $td19->find('span strong', 0)->outertext;
		$tempMinManhana = $td21->find('strong', 0)->outertext;
		$tempMaxManhana = $td21->find('span strong', 0)->outertext;
		$tempMinPasado = $td23->find('strong', 0)->outertext;
		$tempMaxPasado = $td23->find('span strong', 0)->outertext;

		$pronosticoHoy = $pronostico1;
		$pronosticoManhana = $pronostico2;
		$pronosticoPasado = $pronostico3;

		$a = array(
			'actualizacion' => $actualizacion,
			'hoy' => $hoy,
			'manhana' => $manhana,
			'pasado' => $pasado,
			'tempHoy' => $tempHoy,
			'tempMinManhana' =>  $tempMinManhana,
			'tempMaxManhana' => $tempMaxManhana,
			'tempMinPasado' =>  $tempMinPasado,
			'tempMaxPasado' => $tempMaxPasado,
			'imgHoy' => $srcImagenHoy,
			'imgManhana' => $srcImagenManhana,
			'imgPasado' => $srcImagenPasado,
			'pronosticoHoy' => $pronosticoHoy,
			'pronosticoManhana' => $pronosticoManhana,
			'pronosticoPasado' => $pronosticoPasado);
	} else {
		//$html = '<h3>Datos del Pron&oacute;stico no Disponibles</h3>';
		$a = null;
	}
 ?>