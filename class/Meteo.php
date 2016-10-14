<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Meteo
 *
 * @author leonel
 */
include 'conexion.php';

class Meteo {

    /**
     * Constructor 
     */
    function Meteo() {
        
    }

    /**
     * Obtiene la fecha y la hora de la ultima lectura
     * @return Array fecha, hora
     */
    function getFechaHoraUltimaLectura() {
        $query = "select d.fecha, d.hora from datos d, (select max(fecha) fecha from datos) mf where d.fecha = mf.fecha and d.data != -0 and tipo = 8 order by d.hora desc limit 1";
        $resultado = mysql_query($query);
        $row = mysql_fetch_row($resultado);
        $a = array('fecha' => $row[0], 'hora' => $row[1]);
        return $a;
    }

    /**
     * Obtiene las lecturas de intensidad del viento
     * @return String
     */
    public function getVientoIntensidad($fecha, $hora) {
        $query = "select data from datos where tipo = 1 and fecha = '$fecha' and hora = '$hora'  and data != -0 limit 1";
        $resultado = mysql_query($query);
        $row = mysql_fetch_row($resultado);
        return $row[0];
    }

    /**
     * Obtiene las lecturas de direccion del viento
     * @param String $fecha 
     * @param String $hora
     * @return String 
     */
    function getVientoDireccion($fecha, $hora) {
        $query = "select data from datos where tipo = 2 and fecha = '$fecha' and hora = '$hora' and data != -0 limit 1";
        $resultado = mysql_query($query);
        $row = mysql_fetch_row($resultado);
        return $row[0];
    }

    /**
     * Obtiene la velocidad y la hora en que el viento soplo con mayor intensidad
     * @param String $fecha
     * @return Array velocidad, hora
     */
    function getVientoMaximo($fecha) {
        //$query = "select d.data, d.hora from datos d, (select max(data) data, fecha from datos where tipo = 1 and fecha = '$fecha') as m where d.tipo = 1 and d.fecha = '$fecha' and d.data = m.data order by hora asc limit 1";
        $query = "select data, hora from datos where tipo = 1 and fecha = '$fecha' and data = (select max(data) from datos where tipo = 1 and fecha = '$fecha' limit 1) and data != -0 limit 1;";
        $resultado = mysql_query($query);
        $row = mysql_fetch_row($resultado);
        $a = array('velocidad' => $row[0], 'hora' => $row[1]);
        return $a;
    }

    /**
     * Obtiene la direccion en que el viento soplo con mayor intensidad
     * @param String $fecha
     * @return String 
     */
    function getVientoMaximoDir($fecha) {
        $query = "select dv.data from datos dv, (select d.hora from datos d, (select max(data) data, fecha from datos where tipo = 1 and fecha = '$fecha') as m where d.tipo = 1 and d.fecha = '$fecha' and d.data = m.data order by hora asc limit 1) vm where dv.tipo = 2 and dv.fecha = '$fecha' and dv.hora = vm.hora and dv.data != -0 order by dv.hora limit 1";
        $resultado = mysql_query($query);
        $row = mysql_fetch_row($resultado);
        return $row[0];
    }

    /**
     * Obtiene las lecturas de precipitaciones
     * @param String $fecha 
     * @param String $hora
     * @return String 
     */
    function getPrecipitaciones($fecha, $hora) {
        $query = "select data from datos where tipo = 3 and fecha = '$fecha' and hora = '$hora' and data != -0 limit 1";
        $resultado = mysql_query($query);
        $row = mysql_fetch_row($resultado);
        return $row[0];
    }

    /**
     * Obtiene las lecturas de precipitaciones del dia     
     * @return String 
     */
    function getPrecipitacionesDia() {
        $query = "select sum(data) data from datos where tipo = 3 and fecha = date(now()) and data != -0";
        $resultado = mysql_query($query);
        $row = mysql_fetch_row($resultado);
        return $row[0];
    }

    /**
     * Obtiene la sumatoria de las precipitaciones del mes
     * @return String
     */
    function getPrecipitacionesMes() {
        $query = "select sum(data) data from datos where tipo = 3 and fecha like date_format(now(), '%Y-%m%') and data != -0;";
        $resultado = mysql_query($query);
        $row = mysql_fetch_row($resultado);
        return $row[0];
    }

    /**
     * Obtiene la sumatoria de las precipitaciones del anho
     * @return String
     */
    function getPrecipitacionesAnho() {
        $query = "select sum(data) data from datos where tipo = 3 and fecha like date_format(now(), '%Y%') and data != -0;";
        $resultado = mysql_query($query);
        $row = mysql_fetch_row($resultado);
        return $row[0];
    }

    /**
     * Obtiene la humedad 
     * @param String $fecha 
     * @param String $hora
     * @return String 
     */
    function getHumedad($fecha, $hora) {
        $query = "select data from datos where tipo = 4 and fecha = '$fecha' and hora = '$hora' and data != -0 limit 1 ";
        $resultado = mysql_query($query);
        $row = mysql_fetch_row($resultado);
        return $row[0];
    }

    /**
     * Obtienen la temperatura del suelo
     * @param String $fecha
     * @param String $hora
     * @return String 
     */
    function getTemperaturaSuelo($fecha, $hora) {
        $query = "select data from datos where tipo= 7 and fecha= '$fecha' and hora = '$hora' and data != -0 order by id DESC limit 1";
        $resultado = mysql_query($query);
        $row = mysql_fetch_row($resultado);
        return $row[0];
    }

    /**
     * Obtiene la temperatura del aire
     * @param String $fecha
     * @param String $hora
     * @return String 
     */
    function getTemperaturaAire($fecha, $hora) {
        $query = "select data from datos where tipo='0008' and fecha = '$fecha' and hora = '$hora' and data != -0 limit 1";
        $resultado = mysql_query($query);
        $row = mysql_fetch_row($resultado);
        return $row[0];
    }

    /**
     * Obtiene la temperatura minima de un fecha dada
     * @param String $fecha
     * @return Array temperatura, hora 
     */
    function getTemperaturaMin($fecha) {
        $query = "select d.data, d.hora from datos d, (select min(data) as data from datos where tipo= 8 and fecha = '$fecha' and data != -0) as m where d.tipo= 8 and d.fecha = '$fecha' and d.data = m.data order by hora limit 1";
        $resultado = mysql_query($query);
        $row = mysql_fetch_row($resultado);
        $a = array('temperatura' => $row[0], 'hora' => $row[1]);
        return $a;
    }

    /**
     * Obtiene la temperatura maxima de un fecha dada
     * @param String $fecha
     * @return Array temperatura, hora  
     */
    function getTemperaturaMax($fecha) {
        $query = "select d.data, d.hora from datos d, (select max(data) as data from datos where tipo = 8 and fecha = '$fecha' and data != -0 ) as m where d.tipo= 8 and d.fecha = '$fecha' and d.data = m.data order by hora limit 1";

        $resultado = mysql_query($query);
        $row = mysql_fetch_row($resultado);
        $a = array('temperatura' => $row[0], 'hora' => $row[1]);
        return $a;
    }

    /**
     * Obtiene la presion atmosferica
     * @param String $fecha
     * @param String $hora
     * @return String 
     */
    function getPresionAtmosferica($fecha, $hora) {
        $query = "select data from datos where tipo = 10 and  fecha = '$fecha' and hora = '$hora' and data != -0 limit 1";
        $resultado = mysql_query($query);
        $row = mysql_fetch_row($resultado);
        return $row[0];
    }

    /**
     * Obtiene la presion atmosferica
     * @param String $fecha
     * @param String $hora
     * @return String 
     */
    function getRadiacionGlobal($fecha, $hora) {
        $query = "select data from datos where tipo = 13 and fecha = '$fecha' and hora = '$hora' and data != -0 limit 1";
        $resultado = mysql_query($query);
        $row = mysql_fetch_row($resultado);
        return $row[0];
    }

    /**
     * Obtiene la direccion predominante del viento
     * @param String $fecha
     * @return Array count, direccion
     */
    function getVientoPredominante($fecha) {
        $query = "       
          select
              @c := Greatest(n, nne, ne, ene, e, ese, se, sse, s, ssw, sw, wsw, w, wnw, nw, nnw) as count,
              case
                when n = @c then 'N'
                when nne = @c then 'NNE'
                when ne = @c then 'NE'
                when ene = @c then 'ENE'
                when e = @c then 'E'
                when ese = @c then 'ESE'
                when se = @c then 'SE'
                when sse = @c then 'SSE'
                when s = @c then 'S'
                when ssw = @c then 'SSW'
                when sw = @c then 'SW'
                when wsw = @c then 'WSW'
                when w = @c then 'W'
                when wnw = @c then 'WNW'
                when nw = @c then 'NW'
                when nnw = @c then 'NNW'
                else 'S/D'
              end as data
          from
            (select count(*) as n from datos
              where tipo = 2
              and fecha = '$fecha'
              and ((data between 1 and 11.2) or data >= 348.8)) n,

            (select count(*) as nne from datos
                where tipo = 2
                and fecha = '$fecha'
                and data between 11.3 and 33.7) nne,

            (select count(*) as ne from datos
                where tipo = 2
                and fecha = '$fecha'
                and data between 33.8 and 56.2) ne,

            (select count(*) as ene from datos
                where tipo = 2
                and fecha = '$fecha'
                and data between 56.3 and 78.7) ene,

            (select count(*) as e from datos
                where tipo = 2
                and fecha = '$fecha'
                and data between 78.8 and 101.2) e,

            (select count(*) as ese from datos
                where tipo = 2
                and fecha = '$fecha'
                and data between 101.3 and 113.7) ese,

            (select count(*) as se from datos
                where tipo = 2
                and fecha = '$fecha'
                and data between 113.8 and 136.2) se,

            (select count(*) as sse from datos
                where tipo = 2
                and fecha = '$fecha'
                and data between 136.3 and 168.7) sse,

            (select count(*) as s from datos
                where tipo = 2
                and fecha = '$fecha'
                and data between 168.8 and 191.2) s,

            (select count(*) as ssw from datos
                where tipo = 2
                and fecha = '$fecha'
                and data between 191.3 and 213.7) ssw,

            (select count(*) as sw from datos
                where tipo = 2
                and fecha = '$fecha'
                and data between 213.8 and 236.2) sw,

            (select count(*) as wsw from datos
                where tipo = 2
                and fecha = '$fecha'
                and data between 236.3 and 258.7) wsw,

            (select count(*) as w from datos
                where tipo = 2
                and fecha = '$fecha'
                and data between 258.8 and 281.2) w,

            (select count(*) as wnw from datos
                where tipo = 2
                and fecha = '$fecha'
                and data between 281.3 and 303.7) wnw,

            (select count(*) as nw from datos
                where tipo = 2
                and fecha = '$fecha'
                and data between 303.8 and 326.2) nw,

            (select count(*) as nnw from datos
                where tipo = 2
                and fecha = '$fecha'
                and data between 326.3 and 348.7) nnw
        ";
        $resultado = mysql_query($query);
        $row = mysql_fetch_row($resultado);
        $a = array('count' => $row[0], 'direccion' => $row[1]);
        return $a;
    }

    /* -------DATOS HISTORICOS------- */

    function getAllVientoIntensidad($desde, $hasta) {        
        $result = mysql_query("SELECT fecha, hora, data FROM datos where tipo = 1 and fecha between '$desde' and '$hasta'   order by fecha,hora ASC;");
        $rows = array();
        while ($r = mysql_fetch_assoc($result)) {
            $rows[] = $r;
        }
        return $rows;
    }

    function getAllVientoDireccion($desde, $hasta) {
        $result = mysql_query("SELECT fecha, hora, data FROM datos where tipo = 2 and fecha between '$desde' and '$hasta'   order by fecha,hora ASC;");
        $rows = array();
        while ($r = mysql_fetch_assoc($result)) {
            $rows[] = $r;
        }
        return $rows;
    }

    function getAllPrecipitaciones($desde, $hasta) {
        $result = mysql_query("SELECT fecha, hora, data FROM datos where tipo = 3 and fecha between '$desde' and '$hasta'   order by fecha,hora ASC;");
        $rows = array();
        while ($r = mysql_fetch_assoc($result)) {
            $rows[] = $r;
        }
        return $rows;
    }

    function getAllHumedad($desde, $hasta) {
        $result = mysql_query("SELECT fecha, hora, data FROM datos where tipo = 4 and fecha between '$desde' and '$hasta'   order by fecha,hora ASC;");
        $rows = array();
        while ($r = mysql_fetch_assoc($result)) {
            $rows[] = $r;
        }
        return $rows;
    }

    function getAllTemperaturaSuelo($desde, $hasta) {
        $result = mysql_query("SELECT fecha, hora, data FROM datos where tipo= 7 and fecha between '$desde' and '$hasta'   order by fecha,hora ASC;");
        $rows = array();
        while ($r = mysql_fetch_assoc($result)) {
            $rows[] = $r;
        }
        return $rows;
    }

    function getAllTemperaturaAire($desde, $hasta) {
        $result = mysql_query("SELECT fecha, hora, data FROM datos where tipo = 8 and data!=0 and fecha between '$desde' and '$hasta' order by fecha,hora ASC;");
        $rows = array();
        while ($r = mysql_fetch_assoc($result)) {
            $rows[] = $r;
        }
        return $rows;
    }

    function getAllPresionAtmosferica($desde, $hasta) {
        $result = mysql_query("SELECT fecha, hora, data FROM datos where tipo= 10 and data!=0 and fecha between '$desde' and '$hasta' order by fecha,hora ASC;");
        $rows = array();
        while ($r = mysql_fetch_assoc($result)) {
            $rows[] = $r;
        }
        return $rows;
    }

    function getAllRadiacionGlobal($desde, $hasta) {
        $result = mysql_query("SELECT fecha, hora, data FROM datos where tipo= 13 and fecha between '$desde' and '$hasta'   order by fecha,hora ASC;");
        $rows = array();
        while ($r = mysql_fetch_assoc($result)) {
            $rows[] = $r;
        }
        return $rows;
    }

    function getAllTemperaturaMinima($desde, $hasta) {
        $result = mysql_query("select d.fecha, d.hora, d.data from (select min(data) as data, fecha from datos where tipo = 8 and data != -0 group by fecha) as m, (select * from datos where tipo = 8 and data != -0 group by data, fecha order by fecha) d where d.data = m.data and d.fecha = m.fecha and m.fecha between '$desde' and '$hasta'  order by d.fecha;");
        $rows = array();
        while ($r = mysql_fetch_assoc($result)) {
            $rows[] = $r;
        }
        return $rows;
    }

    function getAllTemperaturaMaxima($desde, $hasta) {
        $result = mysql_query("SELECT m.fecha, hora, m.data FROM datos d, (SELECT fecha, max(data) as data from datos where tipo = 8 and data != 0 group by fecha) m where d.fecha = m.fecha and d.data = m.data and m.fecha between '$desde' and '$hasta'  group by m.fecha order by m.fecha ASC;");
        $rows = array();
        while ($r = mysql_fetch_assoc($result)) {
            $rows[] = $r;
        }
        return $rows;
    }

    function getAllTemperaturaMaximaMinima($desde, $hasta) {
        $result = mysql_query("select tmin.fecha as fecha, tmin.hora as minhora, tmin.data as mindata, tmax.hora as maxhora, tmax.data as maxdata
                from
                (select d.fecha, d.hora, d.data from (select min(data) as data, fecha from datos where tipo = 8 and data != -0 group by fecha) as m, (select * from datos where tipo = 8 and data != -0 group by data, fecha order by fecha) d where d.data = m.data and d.fecha = m.fecha and d.fecha between '$desde' and '$hasta' order by d.fecha) tmin,
                (select m.fecha, hora, m.data FROM datos d, (SELECT fecha, max(data) as data from datos where tipo='0008' and data != 0 group by fecha) m where d.fecha = m.fecha and d.data = m.data and d.fecha between '$desde' and '$hasta' group by m.fecha order by m.fecha ASC) tmax
                    where tmax.fecha = tmin.fecha;");
        $rows = array();
        while ($r = mysql_fetch_assoc($result)) {
            $rows[] = $r;
        }
        return $rows;
    }

    function getAllVientoMaximo($desde, $hasta) {
        $result = mysql_query("SELECT m.fecha, hora, m.data FROM datos d, (SELECT fecha, max(data) as data from datos where tipo = 1 group by fecha) m where d.fecha = m.fecha and d.data = m.data and m.fecha between '$desde' and '$hasta'  group by m.fecha order by m.fecha ASC");
        $rows = array();
        while ($r = mysql_fetch_assoc($result)) {
            $rows[] = $r;
        }
        return $rows;
    }

    function getAllVientoMaximoDireccion($desde, $hasta) {
        $result = mysql_query("select iv.data as intensidad, dv.data as direccion, dv.hora, dv.fecha from (select * from datos where tipo = 1 and fecha between '$desde' and '$hasta' group by hora) iv, (select * from datos where tipo = 2 and fecha between '$desde' and '$hasta' group by hora) dv where iv.hora = dv.hora;");
        $rows = array();
        while ($r = mysql_fetch_assoc($result)) {
            $rows[] = $r;
        }
        return $rows;
    }

    function getAllVientoPredominante($desde, $hasta){
        $result = mysql_query("select n, nne, ne, ene, e, ese, se, sse, s, ssw, sw, wsw, w, wnw, nw, nnw from
            (select count(*) as n from datos
                where tipo = 2
                and fecha between '$desde' and '$hasta'
                and ((data between 1 and 11.2) or data >= 348.8)) n,

            (select count(*) as nne from datos
                where tipo = 2
                and fecha between '$desde' and '$hasta'
                and data between 11.3 and 33.7) nne,

            (select count(*) as ne from datos
                where tipo = 2
                and fecha between '$desde' and '$hasta'
                and data between 33.8 and 56.2) ne,

            (select count(*) as ene from datos
                where tipo = 2
                and fecha between '$desde' and '$hasta'
                and data between 56.3 and 78.7) ene,

            (select count(*) as e from datos
                where tipo = 2
                and fecha between '$desde' and '$hasta'
                and data between 78.8 and 101.2) e,

            (select count(*) as ese from datos
                where tipo = 2
                and fecha between '$desde' and '$hasta'
                and data between 101.3 and 113.7) ese,

            (select count(*) as se from datos
                where tipo = 2
                and fecha between '$desde' and '$hasta'
                and data between 113.8 and 136.2) se,

            (select count(*) as sse from datos
                where tipo = 2
                and fecha between '$desde' and '$hasta'
                and data between 136.3 and 168.7) sse,

            (select count(*) as s from datos
                where tipo = 2
                and fecha between '$desde' and '$hasta'
                and data between 168.8 and 191.2) s,

            (select count(*) as ssw from datos
                where tipo = 2
                and fecha between '$desde' and '$hasta'
                and data between 191.3 and 213.7) ssw,

            (select count(*) as sw from datos
                where tipo = 2
                and fecha between '$desde' and '$hasta'
                and data between 213.8 and 236.2) sw,

            (select count(*) as wsw from datos
                where tipo = 2
                and fecha between '$desde' and '$hasta'
                and data between 236.3 and 258.7) wsw,

            (select count(*) as w from datos
                where tipo = 2
                and fecha between '$desde' and '$hasta'
                and data between 258.8 and 281.2) w,

            (select count(*) as wnw from datos
                where tipo = 2
                and fecha between '$desde' and '$hasta'
                and data between 281.3 and 303.7) wnw,

            (select count(*) as nw from datos
                where tipo = 2
                and fecha between '$desde' and '$hasta'
                and data between 303.8 and 326.2) nw,

            (select count(*) as nnw from datos
                where tipo = 2
                and fecha between '$desde' and '$hasta'
                and data between 326.3 and 348.7) nnw
            ");        
        $rows = array();
        while ($r = mysql_fetch_assoc($result)) {
            $rows[] = $r;
        }
        return $rows;
    }
}

?>
