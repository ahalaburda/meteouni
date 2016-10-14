<?php
require 'class/tcpdf/tcpdf.php';
require 'class/Meteo.php';

if (function_exists($_GET['f'])) {
    if ($_GET['f'] == 'getValores')
        $_GET['f']();
    if ($_GET['f'] == 'getFechaHora')
        $_GET['f']();
    if ($_GET['f'] == 'getMeteoData')
        $_GET['f']($_GET['tipo']);
    if ($_GET['f'] == 'getMeteoDataFecha')
        $_GET['f']($_GET['tipo'], $_GET['desde'], $_GET['hasta']);
    if ($_GET['f'] == 'printMeteoData')
        $_GET['f']($_GET['tipo'], $_GET['desde'], $_GET['hasta']);
    if ($_GET['f'] == 'getPronostico')
        $_GET['f']();
}

/**
 * Obtiene la fecha y la hora de la ultima lectura
 */
function getFechaHora(){
    $m = new Meteo();
    $arrFechaHora = $m->getFechaHoraUltimaLectura();
    $fecha = $arrFechaHora['fecha'];
    $hora = $arrFechaHora['hora'];
    $a = array(
        'fecha' => $fecha,
        'hora' => $hora
    );
    echo json_encode($a);
}

//--------------------------------------------------------------------------
// Query database for data
//--------------------------------------------------------------------------
function getValores() {

 /*   $file = fopen("class/getValores.json", "r") or exit("Unable to open file!");    
    while(!feof($file)){
	echo fgets($file);
    }
    fclose($file);
*/
    $m = new Meteo();

    $arrFechaHora = $m->getFechaHoraUltimaLectura();

    $fecha = $arrFechaHora['fecha'];
    $hora = $arrFechaHora['hora'];

    $vientoInt = $m->getVientoIntensidad($fecha, $hora);
    $vientoDir = $m->getVientoDireccion($fecha, $hora);
    $arrVientoMax = $m->getVientoMaximo($fecha);
    $vientoMax = $arrVientoMax['velocidad'];
    $vientoMaxHora = $arrVientoMax['hora'];
    $vientoMaxDir = $m->getVientoMaximoDir($fecha);
    $precipitaciones = $m->getPrecipitaciones($fecha, $hora);
    $precipitacionesDia = $m->getPrecipitacionesDia();
    $precipitacionesMes = $m->getPrecipitacionesMes();
    $precipitacionesAnho = $m->getPrecipitacionesAnho();
    $humedad = $m->getHumedad($fecha, $hora);
    $tempSuelo = $m->getTemperaturaSuelo($fecha, $hora);
    $tempAire = $m->getTemperaturaAire($fecha, $hora);

    $arrTempMin = $m->getTemperaturaMin($fecha);
    $tempMin = $arrTempMin['temperatura'];
    $tempMinHora = $arrTempMin['hora'];

    $arrTempMax = $m->getTemperaturaMax($fecha);
    $tempMax = $arrTempMax['temperatura'];
    $tempMaxHora = $arrTempMax['hora'];


    $presionAtm = $m->getPresionAtmosferica($fecha, $hora);
    $radiacion = $m->getRadiacionGlobal($fecha, $hora);

    $arrDirVientoPre = $m->getVientoPredominante($fecha);

    $vientoPreDir = $arrDirVientoPre['direccion'];
    $vientoPreCount = $arrDirVientoPre['count'];

    $a = array(
        'fecha' => $fecha,
        'hora' => $hora,
        'vientoInt' => $vientoInt,
        'vientoDir' => $vientoDir,
        'vientoMax' => $vientoMax,
        'vientoMaxHora' => $vientoMaxHora,
        'vientoMaxDir' => $vientoMaxDir,
        'precipitacion' => $precipitaciones,
        'precipitacionDia' => $precipitacionesDia,
        'precipitacionMes' => $precipitacionesMes,
        'precipitacionAnho' => $precipitacionesAnho,
        'humedad' => $humedad,
        'tempSuelo'=> $tempSuelo,
        'tempAire' => $tempAire,
        'tempMin' => $tempMin,
        'tempMinHora' => $tempMinHora,
        'tempMax' => $tempMax,
        'tempMaxHora' => $tempMaxHora,
        'presionAtm' => $presionAtm,
        'radiacion' => $radiacion,
        'vientoPreDir' => $vientoPreDir,
        'vientoPreCount' => $vientoPreCount
    );
    echo json_encode($a);
}

function getMeteoData(){
    $meteo = new Meteo();
    $tipo = $_GET['tipo'];
    $desde = $_GET['desde'];
    $hasta = $_GET['hasta'];
     switch ($tipo) {
        case 'vientoInt' :
            $rows = $meteo->getAllVientoIntensidad($desde, $hasta);
            break;
        case 'vientoDir' :
            $rows = $meteo->getAllVientoDireccion($desde, $hasta);
            break;
        case 'precipitacion' :
            $rows = $meteo->getAllPrecipitaciones($desde, $hasta);
            break;
        case 'humedad' :
            $rows = $meteo->getAllHumedad($desde, $hasta);
            break;
        case 'tempSuelo' :
            $rows = $meteo->getAllTemperaturaSuelo($desde, $hasta);
            break;
        case 'tempAire' :
            $rows = $meteo->getAllTemperaturaAire($desde, $hasta);
            break;
        case 'presionAtm' :
            $rows = $meteo->getAllPresionAtmosferica($desde, $hasta);
            break;
        case 'radiacion' :
            $rows = $meteo->getAllRadiacionGlobal($desde, $hasta);
            break;
        case 'tempMin' :
            $rows = $meteo->getAllTemperaturaMinima($desde, $hasta);
            break;
        case 'tempMax' :
            $rows = $meteo->getAllTemperaturaMaxima($desde, $hasta);
            break;
        case 'tempMaxMin' :
            $rows = $meteo->getAllTemperaturaMaximaMinima($desde, $hasta);
            break;
        case 'precipitacion' :
            $rows = $meteo->getAllPrecipitaciones($desde, $hasta);
            break;
        case 'vientoPreDia' :
            $rows = $meteo->getAllVientoPredominante($desde, $hasta);
            break;
        case 'vientoMax' :
            $rows = $meteo->getAllVientoMaximo($desde, $hasta);
            break;
        case 'vientoMaxDir' :
             $rows = $meteo->getAllVientoMaximoDireccion($desde, $hasta);
             break;

    }
    echo json_encode($rows);
}


/**
 * Obtiene los datos de un valor meteorologico
 * @param $tipo Tipo de valor meteorologico
 * @param $desde Fecha desde la cual se desean obtener los dados
 * @param $hasta Fecha hasta la cual se desean obtener los datos
 */
function getMeteoDataFecha($tipo, $desde, $hasta) {

    if ($tipo == '0008') { //Temperatura del aire
        $result = mysql_query("SELECT fecha, hora, data FROM datos where tipo=$tipo and data!=0 and fecha between '$desde' and '$hasta' order by fecha,hora ASC;");
    } elseif ($tipo == '0009') { //Temperatura minima registrada
        $result = mysql_query("select d.fecha, d.hora, d.data from (select min(data) as data, fecha from datos where tipo = 8 and data != -0 group by fecha) as m, (select * from datos where tipo = 8 and data != -0 group by data, fecha order by fecha) d where d.data = m.data and d.fecha = m.fecha and m.fecha between '$desde' and '$hasta'  order by d.fecha;");
    } elseif ($tipo == '0010') { //Presion admosferica
        $result = mysql_query("SELECT fecha, hora, data FROM datos where tipo=$tipo and data!=0 and fecha between '$desde' and '$hasta' order by fecha,hora ASC;");
    } elseif ($tipo == '0011') { //Suelo Virtual
        $result = mysql_query("SELECT fecha, hora, data FROM datos where tipo=$tipo and data!=0 and fecha between '$desde' and '$hasta' order by fecha,hora ASC;");
    } elseif ($tipo == '0012') { //Temperatura Maxima Registrada
        $result = mysql_query("SELECT m.fecha, hora, m.data FROM datos d, (SELECT fecha, max(data) as data from datos where tipo='0008' and data != 0 group by fecha) m where d.fecha = m.fecha and d.data = m.data and m.fecha between '$desde' and '$hasta'  group by m.fecha order by m.fecha ASC;");
    } elseif ($tipo == '0005') { //Viento Maximo con direccion.
        $result = mysql_query("select iv.data as intensidad, dv.data as direccion, dv.hora from (select * from datos where tipo = 1 and fecha between '$desde' and '$hasta' group by hora) iv, (select * from datos where tipo = 2 and fecha between '$desde' and '$hasta' group by hora) dv where iv.hora = dv.hora;");
    } elseif ($tipo == '0016') { //Temperaturas maximas y minimas combinadas por dia
        $result = mysql_query("select tmin.fecha as fecha, tmin.hora as minhora, tmin.data as mindata, tmax.hora as maxhora, tmax.data as maxdata
                from
                (select d.fecha, d.hora, d.data from (select min(data) as data, fecha from datos where tipo = 8 and data != -0 group by fecha) as m, (select * from datos where tipo = 8 and data != -0 group by data, fecha order by fecha) d where d.data = m.data and d.fecha = m.fecha and d.fecha between '$desde' and '$hasta' order by d.fecha) tmin,
                (select m.fecha, hora, m.data FROM datos d, (SELECT fecha, max(data) as data from datos where tipo='0008' and data != 0 group by fecha) m where d.fecha = m.fecha and d.data = m.data and d.fecha between '$desde' and '$hasta' group by m.fecha order by m.fecha ASC) tmax
                    where tmax.fecha = tmin.fecha;");
    } elseif ($tipo == '0015') { //Viento Predominante del Dia
        $result = mysql_query("select n, nne, ne, ene, e, ese, se, sse, s, ssw, sw, wsw, w, wnw, nw, nnw from
            (select count(*) as n from datos
                where tipo = 2
                and fecha = date(now())
                and ((data between 1 and 11.2) or data >= 348.8)) n,

            (select count(*) as nne from datos
                where tipo = 2
                and fecha = date(now())
                and data between 11.3 and 33.7) nne,

            (select count(*) as ne from datos
                where tipo = 2
                and fecha = date(now())
                and data between 33.8 and 56.2) ne,

            (select count(*) as ene from datos
                where tipo = 2
                and fecha = date(now())
                and data between 56.3 and 78.7) ene,

            (select count(*) as e from datos
                where tipo = 2
                and fecha = date(now())
                and data between 78.8 and 101.2) e,

            (select count(*) as ese from datos
                where tipo = 2
                and fecha = date(now())
                and data between 101.3 and 113.7) ese,

            (select count(*) as se from datos
                where tipo = 2
                and fecha = date(now())
                and data between 113.8 and 136.2) se,

            (select count(*) as sse from datos
                where tipo = 2
                and fecha = date(now())
                and data between 136.3 and 168.7) sse,

            (select count(*) as s from datos
                where tipo = 2
                and fecha = date(now())
                and data between 168.8 and 191.2) s,

            (select count(*) as ssw from datos
                where tipo = 2
                and fecha = date(now())
                and data between 191.3 and 213.7) ssw,

            (select count(*) as sw from datos
                where tipo = 2
                and fecha = date(now())
                and data between 213.8 and 236.2) sw,

            (select count(*) as wsw from datos
                where tipo = 2
                and fecha = date(now())
                and data between 236.3 and 258.7) wsw,

            (select count(*) as w from datos
                where tipo = 2
                and fecha = date(now())
                and data between 258.8 and 281.2) w,

            (select count(*) as wnw from datos
                where tipo = 2
                and fecha = date(now())
                and data between 281.3 and 303.7) wnw,

            (select count(*) as nw from datos
                where tipo = 2
                and fecha = date(now())
                and data between 303.8 and 326.2) nw,

            (select count(*) as nnw from datos
                where tipo = 2
                and fecha = date(now())
                and data between 326.3 and 348.7) nnw
            ");
    } else {
        $result = mysql_query("SELECT fecha, hora, data FROM datos where tipo=$tipo and fecha between '$desde' and '$hasta'   order by fecha,hora ASC;");
    }
    $rows = array();

    while ($r = mysql_fetch_assoc($result)) {
        $rows[] = $r;
    }

    echo json_encode($rows);
}

/**
 * Imprime el pdf
 * @param $tipo Tipo de dato
 * @param $desde Fecha desde la cual se desea imprimir
 * @param $hasta Fecha hasta la cual se desea imprimir
 * @param $titulo
 * @param $medida
 */
function printMeteoData($tipo, $desde, $hasta) {

    /*     * *******Obtiene los datos a imprimir****************** */

    if ($tipo == '0008') { //Temperatura del aire
        $result = mysql_query("SELECT fecha, hora, data FROM datos where tipo=$tipo and data!=0 and fecha between '$desde' and '$hasta' order by fecha,hora ASC;");
    } elseif ($tipo == '0009') { //Temperatura minima registrada
        $result = mysql_query("select d.fecha, d.hora, d.data from (select min(data) as data, fecha from datos where tipo = 8 and data != -0 group by fecha) as m, (select * from datos where tipo = 8 and data != -0 group by data, fecha order by fecha) d where d.data = m.data and d.fecha = m.fecha and m.fecha between '$desde' and '$hasta'  order by d.fecha;");
    } elseif ($tipo == '0010') { //Presion admosferica
        $result = mysql_query("SELECT fecha, hora, data FROM datos where tipo=$tipo and data!=0 and fecha between '$desde' and '$hasta' order by fecha,hora ASC;");
    } elseif ($tipo == '0011') { //Suelo Virtual
        $result = mysql_query("SELECT fecha, hora, data FROM datos where tipo=$tipo and data!=0 and fecha between '$desde' and '$hasta' order by fecha,hora ASC;");
    } elseif ($tipo == '0012') { //Temperatura Maxima Registrada
        $result = mysql_query("SELECT m.fecha, hora, m.data FROM datos d, (SELECT fecha, max(data) as data from datos where tipo='0008' and data != 0 group by fecha) m where d.fecha = m.fecha and d.data = m.data and m.fecha between '$desde' and '$hasta'  group by m.fecha order by m.fecha ASC;");
    } elseif ($tipo == '0005') { //Viento Maximo con direccion.
        $result = mysql_query("select iv.data as intensidad, dv.data as direccion, dv.hora from (select * from datos where tipo = 1 and fecha between '$desde' and '$hasta' group by hora) iv, (select * from datos where tipo = 2 and fecha between '$desde' and '$hasta' group by hora) dv where iv.hora = dv.hora;");
    } elseif ($tipo == '0016') { //Temperaturas maximas y minimas combinadas por dia
        $result = mysql_query("select tmin.fecha as fecha, tmin.hora as minhora, tmin.data as mindata, tmax.hora as maxhora, tmax.data as maxdata
                 from
                 (select d.fecha, d.hora, d.data from (select min(data) as data, fecha from datos where tipo = 8 and data != -0 group by fecha) as m, (select * from datos where tipo = 8 and data != -0 group by data, fecha order by fecha) d where d.data = m.data and d.fecha = m.fecha and d.fecha between '$desde' and '$hasta' order by d.fecha) tmin,
                 (select m.fecha, hora, m.data FROM datos d, (SELECT fecha, max(data) as data from datos where tipo='0008' and data != 0 group by fecha) m where d.fecha = m.fecha and d.data = m.data and d.fecha between '$desde' and '$hasta' group by m.fecha order by m.fecha ASC) tmax
                     where tmax.fecha = tmin.fecha;");
    } elseif ($tipo == '0015') { //Viento Predominante del Dia
        $result = mysql_query("select n, nne, ne, ene, e, ese, se, sse, s, ssw, sw, wsw, w, wnw, nw, nnw from
             (select count(*) as n from datos
                 where tipo = 2
                 and fecha = date(now())
                 and ((data between 1 and 11.2) or data >= 348.8)) n,

             (select count(*) as nne from datos
                 where tipo = 2
                 and fecha = date(now())
                 and data between 11.3 and 33.7) nne,

             (select count(*) as ne from datos
                 where tipo = 2
                 and fecha = date(now())
                 and data between 33.8 and 56.2) ne,

             (select count(*) as ene from datos
                 where tipo = 2
                 and fecha = date(now())
                 and data between 56.3 and 78.7) ene,

             (select count(*) as e from datos
                 where tipo = 2
                 and fecha = date(now())
                 and data between 78.8 and 101.2) e,

             (select count(*) as ese from datos
                 where tipo = 2
                 and fecha = date(now())
                 and data between 101.3 and 113.7) ese,

             (select count(*) as se from datos
                 where tipo = 2
                 and fecha = date(now())
                 and data between 113.8 and 136.2) se,

             (select count(*) as sse from datos
                 where tipo = 2
                 and fecha = date(now())
                 and data between 136.3 and 168.7) sse,

             (select count(*) as s from datos
                 where tipo = 2
                 and fecha = date(now())
                 and data between 168.8 and 191.2) s,

             (select count(*) as ssw from datos
                 where tipo = 2
                 and fecha = date(now())
                 and data between 191.3 and 213.7) ssw,

             (select count(*) as sw from datos
                 where tipo = 2
                 and fecha = date(now())
                 and data between 213.8 and 236.2) sw,

             (select count(*) as wsw from datos
                 where tipo = 2
                 and fecha = date(now())
                 and data between 236.3 and 258.7) wsw,

             (select count(*) as w from datos
                 where tipo = 2
                 and fecha = date(now())
                 and data between 258.8 and 281.2) w,

             (select count(*) as wnw from datos
                 where tipo = 2
                 and fecha = date(now())
                 and data between 281.3 and 303.7) wnw,

             (select count(*) as nw from datos
                 where tipo = 2
                 and fecha = date(now())
                 and data between 303.8 and 326.2) nw,

             (select count(*) as nnw from datos
                 where tipo = 2
                 and fecha = date(now())
                 and data between 326.3 and 348.7) nnw
             ");
    } else {
        $result = mysql_query("SELECT fecha, hora, data FROM datos where tipo=$tipo and fecha between '$desde' and '$hasta'   order by fecha,hora ASC;");
    }
    $rows = array();

    while ($r = mysql_fetch_row($result)) {
        $rows[] = $r;
    }


    /*     * *****TCPDF******** */

    class MYPDF extends TCPDF {

        // Colored table
        public function ColoredTable($header, $data, $medida) {
            // Colors, line width and bold font
            $this->SetFillColor(150, 150, 150);
            $this->SetTextColor(255);
            $this->SetDrawColor(90, 90, 90);
            $this->SetLineWidth(0.3);
            $this->SetFont('', 'B');
            // Header
            $w = array(35, 35, 45, 15);
            $num_headers = count($header);
            for ($i = 0; $i < $num_headers; ++$i) {
                $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', 1);
            }
            $this->Ln();
            // Color and font restoration
            $this->SetFillColor(224, 235, 255);
            $this->SetTextColor(0);
            $this->SetFont('');

            // Data
            $fill = 0;

            $j = 0;
            foreach ($data as $row) {
                $this->Cell($w[0], 6, $row[0], 'LR', 0, 'R', $fill);
                $this->Cell($w[1], 6, $row[1], 'LR', 0, 'R', $fill);
                $this->Cell($w[2], 6, number_format($row[2]), 'LR', 0, 'R', $fill);
                $this->Cell($w[3], 6, $medida, 'LR', 0, 'R', $fill);
                $this->Ln();
                $fill = !$fill;

                $j++;
                if ($j == 38) {
                    $this->Cell(array_sum($w), 0, '', 'T');
                    $this->Ln();
                    $j = 0;
                    // Colors, line width and bold font
                    $this->SetFillColor(150, 150, 150);
                    $this->SetTextColor(255);
                    $this->SetDrawColor(90, 90, 90);
                    $this->SetLineWidth(0.3);
                    $this->SetFont('', 'B');


                    for ($i = 0; $i < $num_headers; ++$i) {
                        $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', 1);
                    }
                    $this->Ln();
                    // Color and font restoration
                    $this->SetFillColor(224, 235, 255);
                    $this->SetTextColor(0);
                    $this->SetFont('');
                }
            }
            $this->Cell(array_sum($w), 0, '', 'T');
        }

    }

    // create new PDF document
    $pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    // set document information
    //    $pdf->SetCreator(PDF_CREATOR);
    //    $pdf->SetTitle('TCPDF Examfdsfsdple 01fsd1');
    //    $pdf->SetSubject('TCPDF Tutorial');
    //    $pdf->SetKeywords('TCPDF, PDF, example, test, guide');
    // set default header data
    $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, getTitulo($tipo), 'Periodo : ' . $desde . ' al ' . $hasta);

    // set header and footer fonts
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

    // set default monospaced font
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

    //set margins
    $pdf->SetMargins(30, 30, 10);
    $pdf->SetHeaderMargin(10);
    $pdf->SetFooterMargin(20);

    //set auto page breaks
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

    //set image scale factor
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

    // ---------------------------------------------------------
    // set font
    $pdf->SetFont('helvetica', '', 12);

    // add a page
    $pdf->AddPage();

    //Column titles
    $header = array('Fecha', 'Hora', 'Valor', '');

    //Data loading
    $data = $rows;

    // print colored table
    $medida = getMedida($tipo);
    $pdf->ColoredTable($header, $data, $medida);

    $pdf->Output('reporte.pdf', 'I');

    //    echo json_encode($rows);
    //    echo $rows[0][2];
}

/**
 * Obtine el tipo de medida de acuerdo al tipo de dato
 * @param $tipo
 * @return string
 */
function getMedida($tipo) {

    switch ($tipo) {
        case '0001':
            $medida = "Km/h";
            break;
        case '0002':
            $medida = "°";
            break;
        case '0003':
            $medida = "m/m";
            break;
        case '0004':
            $medida = '%';
            break;
        case '0005':
            $medida = "Km/h";
            break;
        case '0006':
            $medida = "°C";
            break;
        case '0007':
            $medida = "°C";
            break;
        case '0008':
            $medida = "°C";
            break;
        case '0009':
            $medida = "°C";
            break;
        case '0010':
            $medida = "hPa";
            break;
        case '0011':
            $medida = "°C";
            break;
        case '0012':
            $medida = "°C";
            break;
        case '0013':
            $medida = "w/m²";
            break;
        case 0014:
            $medida = "w/m²";
            break;
    }
    return $medida;
}

/**
 * Obtiene el titulo de acuerdo al tipo de dato
 * @param $tipo
 * @return string
 */
function getTitulo($tipo) {

    switch ($tipo) {
        case '0001':
            $medida = "Intensidad del Viento";
            break;
        case '0002':
            $medida = "Dirección del Viento";
            break;
        case '0003':
            $medida = "Precipitaciones";
            break;
        case '0004':
            $medida = 'Humedad Relativa';
            break;
        case '0005':
            $medida = "Viento Máximo";
            break;
        case '0006':
            $medida = "Dirección del Viento Máximo";
            break;
        case '0007':
            $medida = "Temperatura del Suelo";
            break;
        case '0008':
            $medida = "Temperatura del Aire";
            break;
        case '0009':
            $medida = "Temperatura Mínima";
            break;
        case '0010':
            $medida = "Presión Atmosferica";
            break;
        case '0011':
            $medida = "Suelo Virtual";
            break;
        case '0012':
            $medida = "Temperatura Máxima Registrada";
            break;
        case '0013':
            $medida = "Radiación Global";
            break;
        case '0014':
            $medida = "Radiacion Neta";
            break;
        case '0015':
            $medida = "Dirección del Viento Predominante";
            break;
    }
    return $medida;
}

/**
 * Obtiene la imagen del pronostico del dia de hoy
 */
function getPronostico() {

    include('../class/simplehtmldom/simple_html_dom.php');
    //carga el pronostico del tiempo
    $html = file_get_html('http://www.meteorologia.gov.py/interior.php?depto=7');

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
        $td17 = $cuerpo->find('td', 15);

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


        $hoy = $td1->innertext;
        $manhana = $td3->innertext;
        $pasado = $td5->innertext;

        $srcImagenHoy = $td7->find('div img', 0)->src;
        $srcImagenManhana = $td9->find('div img', 0)->src;
        $srcImagenPasado = $td9->find('div img', 0)->src;

        $pronosticoHoy = utf8_encode($pronostico1);
        $pronosticoManhana = utf8_encode($pronostico2);
        $pronosticoPasado = utf8_encode($pronostico3);


        $a = array(
             'hoy' => $hoy,
             'manhana' => $manhana,
             'pasado' => $pasado,
             'imgHoy' => $srcImagenHoy,
             'imgManhana' => $srcImagenManhana,
             'imgPasado' => $srcImagenPasado,
             'pronosticoHoy' => $pronosticoHoy,
             'pronosticoManhana' => $pronosticoManhana,
             'pronosticoPasado' => $pronosticoPasado
        );

    } else {
        //$html = '<h3>Datos del Pron&oacute;stico no Disponibles</h3>';
        $a = null;
    }

    //codificacion utf-8
    $html = utf8_encode($html);

    $pronostico = '<aside>' . $html . '</aside>';
    //echo $pronostico;
    echo json_encode($a);

}


    ?>
