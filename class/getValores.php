#!/usr/bin/php
<?php
    require '/var/www/html/meteo/class/Meteo.php';
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
    
    $fp = fopen("/var/www/html/meteo/class/getValores.json","w");
    fwrite($fp, json_encode($a) . PHP_EOL);
    fclose($fp);

?>
