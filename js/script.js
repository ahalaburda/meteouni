/*  Author:Leonel Gamarra y Adrian Halaburda
    Ultima modificacion
 */

var chart;
var chartData = [];
var chartMM;
var chartDataMM = [];
var idSenal = 10; //guarda el id de la senhal actual del radar

var tipo = '0008';

var fechaActual;
var fechaMesAnterior;

var data; //datos de la consulta
var desde; //fecha desde
var hasta; //fecha hasta


$(document).ready(function () {
    $("#grafico1").hide();
    $("#grafico2").hide();
    $("#grafico3").hide();
    $("#grafico4").hide();

    $('.flip').click(function(){
        $(this).find('.card').toggleClass('flipped');
    });

    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
});



$(document).ready(function () {
    
    // hasta = getFechaActual();
    // desde = getFechaActualResta(30);
    desde = "2015-01-01";
    hasta = "2015-01-01";
   
    //carga los datos iniciales para el index
    if ('index.php' == returnDocument() || '' == returnDocument() ) {
    // if ('index.php' == returnDocument() || '' == returnDocument() || '#prettyPhoto' == returnDocument()) {
        tabs();//setea los tabs
        // pronostico(); //edita el pronostico
        setData(); //setea los datos iniciales
        slides();  //carga los slides
        // setRadar();
        
        //timer para recargar los graficos
        setInterval(setData, 60000);
        //timers para el radar doppler
        // setInterval(setRadar, 1000); //hace que se muestren en secuencia  
        // setInterval(reloadRadar, 60000); //actualiza las imagenes del radar cada 100000 milisegundos

        // $("a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'fast', slideshow:10000, hideflash:true});

    }
    //#################################################       REPORTES.PHP        #########################################################
        //carga los datos iniciales para el reporte
        if ('reportes.php' == returnDocument()) {
            //datapickers
            calendario("#txtDesde");
            calendario("#txtHasta");

            //carga los eventos del menu
            menu();

            $("#txtHasta").val(hasta);
            $("#txtDesde").val(desde);


            //carga la opcion por defecto
            graficoLinea('tempAire', desde, hasta, 'grafico');
            tipo = 'tempAire';
            menuCssOn('li1');
            fechaUpdate(); //controla los cambios de fecha
        }
});


function fechaUpdate(){
    $('#txtDesde').change(function() {
        desde = $('#txtDesde').val();
    });

    $('#txtHasta').change(function() {
        hasta = $('#txtHasta').val();
    });
}


function returnDocument() {
    var file_name = document.location.href;
    var end = (file_name.indexOf("?") == -1) ? file_name.length : file_name.indexOf("?");
    var file = file_name.substring(file_name.lastIndexOf("/") + 1, end);
    return file;
}

/**
 * Carga los tabs y los graficos al cambiar de tabs
 */
function tabs() {
    // $("#tabsTemperatura").tabs();
    // $("#tabsVientoVel").tabs();
    // $("#tabsVientoDir").tabs();
    // $("#tabsPrecipitaciones").tabs();

    //temperatura

    $("#aTabTemp").click(function () {
        graficoLinea('tempAire', desde, hasta,'graficoTemp');
        $("#graficoTempMaxMin").html('<img src="img/cargando.gif">');
    });
    $("#aTabTempMaxMin").click(function () {
        loadGraficoTempMinMax('2015-01-01','2015-02-01');
        $("#graficoTemp").html('<img src="img/cargando.gif">');
    });

    //velocidad viento

    $("#aTabVientoVel").click(function () {
        graficoLinea('vientoInt', desde, hasta, 'graficoVientoVel');
        $("#graficoVientoMax").html('<img src="img/cargando.gif">');
    });

    $("#aTabVientoMax").click(function () {
        loadGraficoVientoMax(hasta, hasta,'graficoVientoMax');
        $("#graficoVientoVel").html('<img src="img/cargando.gif">');
    });

    //direccion del viento

    $("#aTabVientDir").click(function () {
        graficoLinea('vientoDir', desde, hasta, 'graficoVientoDir');
        $("#graficoVientoPre").html('<img src="img/cargando.gif">');
    });

    $("#aTabVientoPre").click(function () {
        loadGraficoVientoPre(hasta, hasta, 'graficoVientoPre');
        $("#graficoVientoDir").html('<img src="img/cargando.gif">');
    });

    //precitaciones
    // no hay tabs

}

/**
 * Carga los slides y los graficos
 */

function slides() {
    $("#btnGrafTemp").click(function () {
        if ($("#grafico1").css('display') == 'none') {
            $("#grafico1").fadeIn('slow');
            setTimeout(function () {
                graficoLinea('tempAire', desde, hasta,'graficoTemp');
                loadGraficoTempMinMax('2015-01-01','2015-02-01');
            }, 600);

            $("#grafico2").fadeOut(600);
            $("#grafico3").fadeOut(600);
            $("#grafico4").fadeOut(600);

            $('#gbtn1').removeClass('glyphicon glyphicon-plus');
            $('#gbtn1').addClass('glyphicon glyphicon-chevron-up');

            $('#gbtn2').removeClass('glyphicon glyphicon-chevron-up');
            $('#gbtn2').addClass('glyphicon glyphicon-plus');
            $('#gbtn3').removeClass('glyphicon glyphicon-chevron-up');
            $('#gbtn3').addClass('glyphicon glyphicon-plus');
            $('#gbtn4').removeClass('glyphicon glyphicon-chevron-up');
            $('#gbtn4').addClass('glyphicon glyphicon-plus');

        } else {
            $("#grafico1").fadeOut(600);
            $('#gbtn1').removeClass('glyphicon glyphicon-chevron-up');
            $('#gbtn1').addClass('glyphicon glyphicon-plus');

        }
    });

    $("#btnGrafVientoVel").click(function () {
        if ($("#grafico2").css('display') == 'none') {
            $("#grafico2").fadeIn('slow');
            setTimeout(function () {
                graficoLinea('vientoInt',desde, hasta, 'graficoVientoVel');
                loadGraficoVientoMax(desde, hasta, 'graficoVientoMax'); //{hasta} => fecha de hoy
            }, 600);
            $("#grafico1").fadeOut(600);
            $("#grafico3").fadeOut(600);
            $("#grafico4").fadeOut(600);

            $('#gbtn2').removeClass('glyphicon glyphicon-plus');
            $('#gbtn2').addClass('glyphicon glyphicon-chevron-up');

            $('#gbtn1').removeClass('glyphicon glyphicon-chevron-up');
            $('#gbtn1').addClass('glyphicon glyphicon-plus');
            $('#gbtn3').removeClass('glyphicon glyphicon-chevron-up');
            $('#gbtn3').addClass('glyphicon glyphicon-plus');
            $('#gbtn4').removeClass('glyphicon glyphicon-chevron-up');
            $('#gbtn4').addClass('glyphicon glyphicon-plus');

        } else {
            $("#grafico2").fadeOut(600);
            $('#gbtn2').removeClass('glyphicon glyphicon-chevron-up');
            $('#gbtn2').addClass('glyphicon glyphicon-plus');
        }
    });

    $("#btnGrafVientoDir").click(function () {
        if ($("#grafico3").css('display') == 'none') {
            $("#grafico3").fadeIn('slow');
            setTimeout(function () {
                graficoLinea('vientoDir', desde, hasta, 'graficoVientoDir');
                loadGraficoVientoPre(desde, hasta, 'graficoVientoPre');
            }, 600);
            $("#grafico1").fadeOut(600);
            $("#grafico2").fadeOut(600);
            $("#grafico4").fadeOut(600);

            $('#gbtn3').removeClass('glyphicon glyphicon-plus');
            $('#gbtn3').addClass('glyphicon glyphicon-chevron-up');

            $('#gbtn1').removeClass('glyphicon glyphicon-chevron-up');
            $('#gbtn1').addClass('glyphicon glyphicon-plus');
            $('#gbtn2').removeClass('glyphicon glyphicon-chevron-up');
            $('#gbtn2').addClass('glyphicon glyphicon-plus');
            $('#gbtn4').removeClass('glyphicon glyphicon-chevron-up');
            $('#gbtn4').addClass('glyphicon glyphicon-plus');

        } else {
            $("#grafico3").fadeOut(600);
            $('#gbtn3').removeClass('glyphicon glyphicon-chevron-up');
            $('#gbtn3').addClass('glyphicon glyphicon-plus');
        }
    });

    $("#btnGrafPrecipitaciones").click(function () {
        if ($("#grafico4").css('display') == 'none') {
            $("#grafico4").fadeIn('slow');
            setTimeout(function () {
                graficoLinea('precipitacion', desde, hasta, 'graficoPrecipitaciones');
            }, 600);
            $("#grafico1").fadeOut(600);
            $("#grafico2").fadeOut(600);
            $("#grafico3").fadeOut(600);

            $('#gbtn4').removeClass('glyphicon glyphicon-plus');
            $('#gbtn4').addClass('glyphicon glyphicon-chevron-up');

            $('#gbtn1').removeClass('glyphicon glyphicon-chevron-up');
            $('#gbtn1').addClass('glyphicon glyphicon-plus');
            $('#gbtn2').removeClass('glyphicon glyphicon-chevron-up');
            $('#gbtn2').addClass('glyphicon glyphicon-plus');
            $('#gbtn3').removeClass('glyphicon glyphicon-chevron-up');
            $('#gbtn3').addClass('glyphicon glyphicon-plus');

        } else {
            $("#grafico4").fadeOut(600);
            $('#gbtn4').removeClass('glyphicon glyphicon-chevron-up');
            $('#gbtn4').addClass('glyphicon glyphicon-plus');
        }
    });

}


/**
 * Setea los datos meteorologicos
 */
function setData() {
    $.ajax({
        // url:'api.php?f=getValores',
        // url:'http://meteo.uni.edu.py/class/getValores.json',
        url:'class/getValores.json',
        data:"",
        type:"GET",
        async:false,
        dataType:'json',
        success:function (data) {

            if(data.fecha == null) return; //no existen lecturas
            //resta n horas para obtener hora actual GMT
            var arrFecha = data.fecha.split('-');
            var anho = arrFecha[0];
            var mes = arrFecha[1];
            var dia = arrFecha[2];

            var arrHora = data.hora.split(':');
            var hora = arrHora[0];
            var minuto = arrHora[1];
            var segundo = arrHora[2];

            var olddate = new Date(anho, mes, dia, hora, minuto, segundo, 0);
            var subbed = new Date(olddate - 4*60*60*1000); // sustraemos 3 horas

            $('#fechaHoraData').text(' el ' + data.fecha + ' a las ' + data.hora + ' UTC / ' + subbed.toTimeString() );


            //temperatura
            $('#tempActual').text(data.tempAire);
            $('#tempMin').text(data.tempMin);
            $('#tempMax').text(data.tempMax);
            $('#horaTempMin').text(data.tempMinHora);
            $('#horaTempMax').text(data.tempMaxHora);

            //velocidad del viento
            $('#velViento').text(roundNumber(data.vientoInt * 3.6, 1));
            $('#velVeintoMax').text(roundNumber(data.vientoMax * 3.6, 1));
            $('#horaVientoMax').text(data.vientoMaxHora);
            $('#dirVientoMax').text(vientoPolar(data.vientoMaxDir));
            $('#graVientoMax').text(data.vientoMaxDir);


            //direccion del viento
            $('#dirViento').text(vientoPolar(data.vientoDir));
            $('#dirVientoPre').text(data.vientoPreDir);
            $('#dirVientoLect').text(data.vientoPreCount);

            //precipitaciones
            $('#precipitaciones').text(roundNumber(data.precipitacion, 1));
            $('#precipDia').text(roundNumber(data.precipitacionDia, 1));
            $('#precipMes').text(roundNumber(data.precipitacionMes, 1));

            //presion
            $("#presion").text(data.presionAtm);

            //humedad
            $("#humedad").text(data.humedad);

            //temperatura del suelo
            $("#tempSuelo").text(data.tempSuelo);

            //radiacion global
            $('#radiacion').text(data.radiacion);


        }
    });

}


/**
 * Redondea los numeros a una cantidad de decimales
 * @param num numero a redondear
 * @param dec cantidad de decimales
 */
function roundNumber(num, dec) {
    var result = Math.round(num * Math.pow(10, dec)) / Math.pow(10, dec);
    return result;
}

/**
 * Retorna la direccion del viento de acuerdo al grado
 * @param grado Direccion del viento en grados
 * @return {string}
 */

function vientoPolar(grado) {
    var vardire;
    if (grado >= 1 && grado <= 11.2) {
        vardire = 'N';
    }
    else if (grado >= 11.3 && grado <= 33.7) {
        vardire = 'NNE';
    }
    else if (grado >= 33.8 && grado <= 56.2) {
        vardire = 'NE';
    }
    else if (grado >= 56.3 && grado <= 78.7) {
        vardire = 'ENE';
    }
    else if (grado >= 78.8 && grado <= 101.2) {
        vardire = 'E';
    }
    else if (grado >= 101.3 && grado <= 113.7) {
        vardire = 'ESE';
    }
    else if (grado >= 113.8 && grado <= 136.2) {
        vardire = 'SE';
    }
    else if (grado >= 136.3 && grado <= 168.7) {
        vardire = 'SSE';
    }
    else if (grado >= 168.8 && grado <= 191.2) {
        vardire = 'S';
    }
    else if (grado >= 191.3 && grado <= 213.7) {
        vardire = 'SSW';
    }
    else if (grado >= 213.8 && grado <= 236.2) {
        vardire = 'SW';
    }
    else if (grado >= 236.3 && grado <= 258.7) {
        vardire = 'WSW';
    }
    else if (grado >= 258.8 && grado <= 281.2) {
        vardire = 'W';
    }
    else if (grado >= 281.3 && grado <= 303.7) {
        vardire = 'WNW';
    }
    else if (grado >= 303.8 && grado <= 326.2) {
        vardire = 'NW';
    }
    else if (grado >= 326.3 && grado <= 348.7) {
        vardire = 'NNW';
    }
    else if (grado >= 348.8) {
        vardire = 'N';
    }
    else {
        vardire = 'S/D';
    }
    return vardire;

}


/**
 * Obtiene los datos del historial meteorologico
 * @param tipo Tipo de Grafico
 * @param desde Fecha desde donde se desea obtener los datos
 * @param hasta Feha hasta donde se desea obtener los datos
 */
function loadData(tipo, desde, hasta) {
    var meteo;

    $.ajax({
        url:"api.php?f=getMeteoData&tipo=" + tipo + "&desde=" + desde + "&hasta=" + hasta,        
        type:"GET",
        async:false,
        dataType:"json",
        success:function (datos) {
            meteo = datos;
        }
    });
    data = meteo;
    return meteo;

}


/**
 * Zoom para los graficos
 */
function zoomChart() {
    // different zoom methods can be used - zoomToIndexes, zoomToDates, zoomToCategoryValues
    chart.zoomToIndexes(chartData.length - 40, chartData.length - 1);
}

/**
 * Zoom para el grafico de temperaturas maximas y minimas
 */
function zoomChartMM() {
    // different zoom methods can be used - zoomToIndexes, zoomToDates, zoomToCategoryValues
    chartMM.zoomToIndexes(chartDataMM.length - 40, chartDataMM.length - 1);
}


/**
 * Carga el grafico de temperaturas maximas y minimas
 */
function loadGraficoTempMinMax(desde, hasta) {
    var medida = "°C";
    chartDataMM = new Array();
    var datos = loadData('tempMaxMin', desde, hasta); //16 es temperatura maxima y minima combinados
    //Para cada dato...
    for (var i = 0; i < datos.length; i++) {
        var dato = datos[i];

        var arrFecha = dato.fecha.split('-');
        var anho = arrFecha[0];
        var mes = arrFecha[1] - 1;
        var dia = arrFecha[2];

        var arrHoraMax = dato.maxhora.split(':');
        var horaMax = arrHoraMax[0];
        var minMax = arrHoraMax[1];
        var segMax = arrHoraMax[2];

        var arrHoraMin = dato.minhora.split(':');
        var horaMin = arrHoraMin[0];
        var minMin = arrHoraMin[1];
        var segMin = arrHoraMin[2];

        var dateMax = new Date(anho, mes, dia, horaMax, minMax, segMax);
        var dateMin = new Date(anho, mes, dia, horaMin, minMin, segMin);

        //Carga el dato al Grafico
        chartDataMM.push({
            date:dateMin,
            minima:dato.mindata
        });
        chartDataMM.push({
            date:dateMax,
            maxima:dato.maxdata
        });

    }


    // SERIAL CHART
    var chartMM = AmCharts.makeChart( "graficoTempMaxMin" , {
        "type": "serial",
        "dataProvider": chartDataMM,
        "fontFamily" : "Lato",
        // "legend": {
        //     "useGraphSettings": true
        // },
        // AXES
        // Category
        "categoryField": "date",
        "categoryAxis": {
            "gridPosition": "start",
            "parseDates": true,
            "minPeriod" : "mm",
            "axisAlpha": 0,
            "fillAlpha": 0.09,
            "fillColor": "#000000",
            "gridAlpha": 0,
        },

        // Value
        "valueAxes": [{
            "integersOnly": true,
            "axisAlpha": 0.5,
            "dashLength": 5,
            "title": "Datos obtenidos"
        }],
        
        "startDuration": 0.5,

        // GRAPH MIN
        "graphs": [{
            "id": "g1",
            "title": "Temperatura Minima",
            "valueField": "minima",
            "balloonText": "Min [[value]] " + medida,
            "lineColor": "#3399D9",
            "bullet": "round",
            "fillAlphas": 0,

                "bulletBorderAlpha": 1,
                "bulletColor": "#FFFFFF",
                "hideBulletsCount": 50,

                "useLineColorForBulletBorder": true,


            },{
            "id": "g2",
            "title": "Temperatura Maxima",
            "valueField": "maxima",
            "balloonText": "Max [[value]] " + medida,
            "lineColor": "#D94112",
            "bullet": "round",
            "fillAlphas": 0,
                            "bulletBorderAlpha": 1,
                "bulletColor": "#FFFFFF",
                "hideBulletsCount": 50,

                "useLineColorForBulletBorder": true,


        }],
        // CURSOR
        "chartCursor": {
            "limitToGraph":"g1",
            "cursorPosition" : "mouse",
            "cursorAlpha": 0.3,
            "categoryBalloonDateFormat": "JJ:NN, DD MMMM"
        },
        //SCROLLBAR
        "chartScrollbar": {
            "autoGridCount": true,
            "graph": "g1",
            "scrollbarHeight": 40
        },
        //ZOOM MOUSE
         "mouseWheelZoomEnabled": true
    });

    chartMM.dayNames = ['Do','Lu','Ma','Mi','Ju','Vi','Sa'];
    chartMM.shortDayNames = ['Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado'];
    chartMM.monthNames = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
    chartMM.shortMonthNames = ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'];
    
    // data updated event will be fired when chart is first displayed,
    // also when data will be updated. We'll use it to set some
    // initial zoom
    chartMM.addListener("dataUpdated", zoomChartMM);


}

/**
 * Carga el Grafico Viento Predominante
 * @param desde
 * @param hasta
 * @param grafico
 */
function loadGraficoVientoPre(desde, hasta, grafico) {

    var datos = loadData('vientoPreDia', desde, hasta);
    var dato = datos[0];

    loadGraficoPolar(grafico, 'lecturas', dato.n, dato.nne, dato.ne, dato.ene, dato.e, dato.ese,
        dato.se, dato.sse, dato.s, dato.ssw, dato.sw, dato.wsw, dato.w,
        dato.wnw, dato.nw, dato.nnw);

}

/**
 * Carga el grafico de Viento Maximo con Direccion
 * @param desde
 * @param hasta
 * @param grafico
 */
function loadGraficoVientoMax(desde, hasta, grafico) {
    chartData = new Array();
    var datos = loadData('vientoMaxDir', desde, hasta);

    var n = 0;
    var nne = 0;
    var ne = 0;
    var ene = 0;
    var e = 0;
    var ese = 0;
    var se = 0;
    var sse = 0;
    var s = 0;
    var ssw = 0;
    var sw = 0;
    var wsw = 0;
    var w = 0;
    var wnw = 0;
    var nw = 0;
    var nnw = 0;

    for (var i = 0; i < datos.length; i++) {
        var direccion = datos[i].direccion;
        var intensidad = roundNumber(datos[i].intensidad * 3.6, 1);
        var hora = datos[i].hora;
        var polo = vientoPolar(direccion);
        switch (polo) {
            case 'N':
                if (intensidad > n) n = intensidad;
                break;
            case 'NNE':
                if (intensidad > nne) nne = intensidad;
                break;
            case 'NE':
                if (intensidad > ne) ne = intensidad;
                break;
            case 'ENE':
                if (intensidad > ene) ene = intensidad;
                break;
            case 'E':
                if (intensidad > e) e = intensidad;
                break;
            case 'ESE':
                if (intensidad > ese) ese = intensidad;
                break;
            case 'SE':
                if (intensidad > se) se = intensidad;
                break;
            case 'SSE':
                if (intensidad > sse) sse = intensidad;
                break;
            case 'S':
                if (intensidad > s) s = intensidad;
                break;
            case 'SSW':
                if (intensidad > ssw) ssw = intensidad;
                break;
            case 'SW':
                if (intensidad > sw) sw = intensidad;
                break;
            case 'WSW':
                if (intensidad > wsw) wsw = intensidad;
                break;
            case 'W':
                if (intensidad > w) w = intensidad;
                break;
            case 'WNW':
                if (intensidad > wnw) wnw = intensidad;
                break;
            case 'NW':
                if (intensidad > nw) nw = intensidad;
                break;
            case 'NNW':
                if (intensidad > nnw) nnw = intensidad;
                break;
        }

    }

    loadGraficoPolar(grafico, 'Km/h', n, nne, ne, ene, e, ese, se, sse, s, ssw, sw, wsw, w, wnw, nw, nnw);

}
/**
 * Carga el grafico polar
 */
function loadGraficoPolar(grafico, medida, n, nne, ne, ene, e, ese, se, sse, s, ssw, sw, wsw, w, wnw, nw, nnw) {
    var cart;
    chartData = new Array();
    var chartData = [
        {
            direction:"N",
            value:n
        },
        {
            direction:"NNE",
            value:nne
        },
        {
            direction:"NE",
            value:ne
        },
        {
            direction:"ENE",
            value:ene
        },
        {
            direction:"E",
            value:e
        },
        {
            direction:"ESE",
            value:ese
        },
        {
            direction:"SE",
            value:se
        },
        {
            direction:"SSE",
            value:sse
        },
        {
            direction:"S",
            value:s
        },
        {
            direction:"SSW",
            value:ssw
        },
        {
            direction:"SW",
            value:sw
        },
        {
            direction:"WSW",
            value:wsw
        },
        {
            direction:"W",
            value:w
        },
        {
            direction:"WNW",
            value:wnw
        },
        {
            direction:"NW",
            value:nw
        },
        {
            direction:"NNW",
            value:nnw
        }
    ];

    // RADAR CHART
    var chart = AmCharts.makeChart( grafico , {
        "type": "radar",
        "dataProvider": chartData,
        "fontFamily" : "Lato",
        "categoryField": "direction",
        "startDuration" : 1,
         "addClassNames": true,
        // VALUE AXIS
        "valueAxes": [{
            "gridType" : "circles",
            "minimum": 0,
            "axisAlpha": 0.2,
            "dashLength": 3,
            "gridAlpha": 0,
            "fillAlpha" : 0.05,
            "fillColor" : "#000000"
        }],
        // GRAPH
        "graphs": [{
            "valueField": "value",
            "lineColor" : "#FFCC00",
            "fillAlphas" : 0.4,
            "bullet" : "round",
            "balloonText" : "[[category]]: [[value]] " + medida
        }]
   });
}


/**
 * Obtiene un string con la medida correspondiente al tipo
 * @param tipo
 * @return {*}
 */
function getMedida(tipo) {
    var medida;
    switch (tipo) {
        case 'vientoInt':
            medida = "Km/h";
            break;
        case 'vientoDir':
            medida = "°";
            break;
        case 'precipitacion':
            medida = "m/m";
            break;
        case 'humedad':
            medida = '%';
            break;
        case 'vientoMax':
            medida = "Km/h";
            break;
        case 'vientoMaxDir':
            medida = "°C";
            break;
        case 'tempSuelo':
            medida = "°C";
            break;
        case 'tempAire':
            medida = "°C";
            break;
        case 'tempMin':
            medida = "°C";
            break;
        case 'presionAtm':
            medida = "hPa";
            break;
        case 'sueloVirtual':
            medida = "°C";
            break;
        case 'tempMax':
            medida = "°C";
            break;
        case 'radiacionGlobal':
            medida = "w/m²";
            break;
        case 'radiacionNeta':
            medida = "w/m²";
            break;
    }
    return medida;

}


/**
 * Aplica el jquery datapicker con textos es español
 * @param inputText Id del input al cual se le va a aplicar el datapicker
 */
function calendario(inputText) {
    $(inputText).datepicker({
        dayNames:["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sabado"],
        dayNamesMin:["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
        dayNamesShort:["Dom", "Lun", "Mar", "Mie", "Jue", "Vie", "Sab"],
        monthNames:["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
        monthNamesShort:["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Set", "Oct", "Nov", "Dic"],
        nextText:"Siguiente",
        prevText:"Anterior",
        dateFormat:"yy-mm-dd",
        changeMonth:true,
        changeYear:true,
        showOn:"button",
        buttonImage:"img/calendario.jpeg",
        buttonImageOnly:true
    });

}

/**
 * Carga los eventos de los menus
 */
function menu() {
    $("#tempAire").click(function () {
        menuCssOn('li1');
        graficoLinea('tempAire', desde, hasta, 'grafico');
        tipo = 'tempAire';
    });
    $("#tempMin").click(function () {
        menuCssOn('li2');
        graficoLinea('tempMin', desde, hasta, 'grafico');
        tipo = 'tempMin';
    });
    $("#tempMax").click(function () {
        menuCssOn('li3');
        graficoLinea('tempMax', desde, hasta, 'grafico');
        tipo = 'tempMax';
    });
    $("#tempSuelos").click(function () {
        menuCssOn('li4');
        graficoLinea('tempSuelo', desde, hasta, 'grafico');
        tipo = 'tempSuelo';
    });
    $("#humedad").click(function () {
        menuCssOn('li5');
        graficoLinea('humedad', desde, hasta, 'grafico');
        tipo = 'humedad';
    });
    $("#vientoDir").click(function () {
        menuCssOn('li6');
        graficoLinea('vientoDir', desde, hasta, 'grafico');
        tipo = 'vientoDir';
    });
    $("#vientoInt").click(function () {
        menuCssOn('li7');
        graficoLinea('vientoInt', desde, hasta, 'grafico');
        tipo = 'vientoInt';
    });

    $("#presion").click(function () {
        menuCssOn('li8');
        graficoLinea('presionAtm', desde, hasta, 'grafico');
        tipo = 'presionAtm';
    });
    $("#precipitacion").click(function () {
        menuCssOn('li9');
        graficoLinea('precipitacion', desde, hasta, 'grafico');
        tipo = 'precipitacion';
    });
    $("#vientoMax").click(function () {
        menuCssOn('li10');
        graficoLinea('vientoMax', desde, hasta, 'grafico');
        tipo = 'vientoMax';
    });
    $("#radiacion").click(function () {
        menuCssOn('li11');
        graficoLinea('radiacion', desde, hasta, 'grafico');
        tipo = 'radiacion';
    });

}

/**
 * Activa el menu seleccionado y desactiva el resto
 * @param id Id del menu que se desae activar
 */
function menuCssOn(id) {
    menuCssOff();
    $("#" + id).attr('class','li-selected-on');
}

/**
 * Desactiva todos los menus css
 */
function menuCssOff() {
    $("#navbar li").attr('class', 'li-selected-off');
}

/**
 * Filtra los los resultados de la consulta de acuerdo a las fechas dadas
 */
function filtrar() {
    if (tipo == 'vientoMax') {
        loadGraficoVientoMax(desde, hasta, 'grafico');
    }
    graficoLinea(tipo, desde, hasta, 'grafico');
}


/**
 * Obtiene la fecha actual
 * @return {String}
 */
function getFechaActual() {
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth() + 1; //January is 0!
    var yyyy = today.getFullYear();
    if (dd < 10) {
        dd = '0' + dd;
    }
    if (mm < 10) {
        mm = '0' + mm;
    }
    var today = yyyy + '-' + mm + '-' + dd;
    return today;
}

/**
 * Obtiene la fecha actual menos la cantidad de dias
 * @param dias
 */
function getFechaActualResta(dias){
    var today = new Date();
    var minus = new Date(today.getTime() - (dias * 24 * 3600 * 1000));

    var dd = minus.getDate();
    var mm = minus.getMonth() + 1; //January is 0!
    var yyyy = minus.getFullYear();
    if (dd < 10) {
        dd = '0' + dd;
    }
    if (mm < 10) {
        mm = '0' + mm;
    }
    var minus = yyyy + '-' + mm + '-' + dd;
    return minus;
}

/*Imprime los datos del grafico actual*/
function printData(){
    var url = 'api.php?f=printMeteoData&tipo='+tipo+'&desde='+desde+'&hasta='+hasta+'';
    window.open(url);
}

//#########################################################################################
/**
 * Carga el grafico de linea de acuerdo al tipo
 * @param tipo Tipo de grafico
 * @param desde fecha desde donde se desea obtener el grafico
 * @param hasta fecha hasta donde se desea obtener el grafico
 * @param grafico componente html donde se cargara el grafico
 */

function graficoLinea(tipo, desde, hasta, grafico) {

    var medida = getMedida(tipo);

    chartData = new Array();
    var datos = loadData(tipo, desde, hasta);
    //Para cada dato...
    for (var i = 0; i < datos.length; i++) {
        var meteo = datos[i];

        var arrFecha = meteo.fecha.split('-');
        var anho = arrFecha[0];
        var mes = arrFecha[1] - 1;
        var dia = arrFecha[2];

        var arrHora = meteo.hora.split(':');
        var hora = arrHora[0];
        var min = arrHora[1];
        var seg = arrHora[2];

        var date = new Date(anho, mes, dia, hora, min, seg);

        if (tipo == 'vientoInt' || tipo == 'vientoMax') { //pasa a km/h las velocidades del viento
            //Carga el dato al Grafico
            chartData.push({
                date:date,
                visits:roundNumber(meteo.data * 3.6, 1)
            });
        }
        else {
            //Carga el dato al Grafico
            chartData.push({
                date:date,
                visits:meteo.data
            });
        }
    }

    var chart = AmCharts.makeChart( grafico , {
        "type": "serial",
        "dataProvider": chartData,
        "fontFamily" : "Lato",
        "categoryField": "date",
          "addClassNames": true,
        "startDuration": 1,

         // AXES
            // Category
            "categoryAxis": {
                "parseDates": true,
                "minPeriod" : "mm",
                "axisColor": "#DADADA",
                "gridAlpha" : 0.07
            },
            // Value
            "valueAxes": [{
                "axisAlpha": 0.07,
                "title": "Datos Obtenidos"
            }],
            // GRAPH
            "graphs": [{
                "id": "g1",
                "balloonText": "[[value]] " + medida,
                "bullet": "round",
                "bulletBorderAlpha": 1,
                "bulletColor": "#FFFFFF",
                "hideBulletsCount": 50,

                "title": "red line",
                "valueField": "visits",

                "useLineColorForBulletBorder": true,


            }],
            // CURSOR
            "chartCursor": {
                "limitToGraph":"g1",
                "cursorPosition" : "mouse",
                "categoryBalloonDateFormat": "JJ:NN, DD MMMM"
            },
            //SCROLLBAR
            "chartScrollbar": {
                "autoGridCount": true,
                "graph": "g1",
                "scrollbarHeight": 40
            },
            //ZOOM MOUSE
             "mouseWheelZoomEnabled": true
    });

    chart.dayNames = ['Do','Lu','Ma','Mi','Ju','Vi','Sa'];
    chart.shortDayNames = ['Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado'];
    chart.monthNames = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
    chart.shortMonthNames = ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'];
    
     // SERIAL CHART
    chart.addListener("dataUpdated", zoomChart);
}