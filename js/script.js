/* Author:
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

    $('.flip').click(function(){
        $(this).find('.card').toggleClass('flipped');
    });
});

$(document).ready(function() {
    $("#botonera").click(function(){
        $('#grafico1').fadeToggle();
        if($('#gbtn').hasClass('glyphicon glyphicon-plus')){
            $('#gbtn').removeClass('glyphicon glyphicon-plus');
            $('#gbtn').addClass('glyphicon glyphicon-chevron-up');
        }else{
            $('#gbtn').removeClass('glyphicon glyphicon-chevron-up');
            $('#gbtn').addClass('glyphicon glyphicon-plus');
        }
    });
});

$(document).ready(function () {
    
    hasta = getFechaActual();
    desde = getFechaActualResta(30);
    //carga los datos iniciales para el index
    if ('index.php' == returnDocument() || '' == returnDocument() || '#prettyPhoto' == returnDocument()) {
        tabs();//setea los tabs
        pronostico(); //edita el pronostico
        setData(); //setea los datos iniciales
        slides();  //carga los slides
        setRadar();
        
        //timer para recargar los graficos
        setInterval(setData, 60000);
        //timers para el radar doppler
        setInterval(setRadar, 1000); //hace que se muestren en secuencia  
        setInterval(reloadRadar, 60000); //actualiza las imagenes del radar cada 100000 milisegundos

        $("a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'fast', slideshow:10000, hideflash:true});

    }

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
        loadGraficoLinea('tempAire', desde, hasta, 'grafico');
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
 * Carga las imagenes del radar
 */
function setRadar() {

    if (idSenal == 10) {
        idSenal++;
        $('#senhal10').hide();
        $('#senhal11').show();
        $('#senhal10-modal').hide();
        $('#senhal11-modal').show();
    } else if (idSenal == 11) {
        idSenal++;
        $('#senhal11').hide();
        $('#senhal12').show();
        $('#senhal11-modal').hide();
        $('#senhal12-modal').show();
    } else if (idSenal == 12) {
        idSenal++;
        $('#senhal12').hide();
        $('#senhal13').show();
        $('#senhal12-modal').hide();
        $('#senhal13-modal').show();
    } else if (idSenal == 13) {
        idSenal++;
        $('#senhal13').hide();
        $('#senhal14').show();
        $('#senhal13-modal').hide();
        $('#senhal14-modal').show();
    } else if (idSenal == 14) {
        idSenal++;
        $('#senhal14').hide();
        $('#senhal15').show();
        $('#senhal14-modal').hide();
        $('#senhal15-modal').show();
    } else if (idSenal == 15) {
        idSenal = 10;
        $('#senhal15').hide();
        $('#senhal10').show();
        $('#senhal15-modal').hide();
        $('#senhal10-modal').show();
    }

}

/**
 * Recarga las imagenes del radar doppler
 */
function reloadRadar() {

    var d = new Date();
    $("#senhal10").attr("src", "../img/doppler/l10.jpg?" + d.getTime());
    $("#senhal11").attr("src", "../img/doppler/l11.jpg?" + d.getTime());
    $("#senhal12").attr("src", "../img/doppler/l12.jpg?" + d.getTime());
    $("#senhal13").attr("src", "../img/doppler/l13.jpg?" + d.getTime());
    $("#senhal14").attr("src", "../img/doppler/l14.jpg?" + d.getTime());
    $("#senhal15").attr("src", "../img/doppler/l15.jpg?" + d.getTime());
    
    $("#senhal10-modal").attr("src", "../img/doppler/l10.jpg?" + d.getTime());
    $("#senhal11-modal").attr("src", "../img/doppler/l11.jpg?" + d.getTime());
    $("#senhal12-modal").attr("src", "../img/doppler/l12.jpg?" + d.getTime());
    $("#senhal13-modal").attr("src", "../img/doppler/l13.jpg?" + d.getTime());
    $("#senhal14-modal").attr("src", "../img/doppler/l14.jpg?" + d.getTime());
    $("#senhal15-modal").attr("src", "../img/doppler/l15.jpg?" + d.getTime());
}

/**
 * Carga los tabs y los graficos al cambiar de tabs
 */
function tabs() {
    $("#tabsTemperatura").tabs();
    $("#tabsVientoVel").tabs();
    $("#tabsVientoDir").tabs();
    $("#tabsPrecipitaciones").tabs();

    //temperatura

    $("#aTabTemp").click(function () {
        loadGraficoLinea('tempAire', desde, hasta, 'graficoTemp');
        $("#graficoTempMaxMin").html('<img src="img/cargando.gif">');
    });
    $("#aTabTempMaxMin").click(function () {
        loadGraficoTempMinMax(desde, hasta);
        $("#graficoTemp").html('<img src="img/cargando.gif">');
    });

    //velocidad viento

    $("#aTabVientoVel").click(function () {
        loadGraficoLinea('vientoInt', desde, hasta, 'graficoVientoVel');
        $("#graficoVientoMax").html('<img src="img/cargando.gif">');
    });

    $("#aTabVientoMax").click(function () {
        loadGraficoVientoMax(hasta, hasta,'graficoVientoMax');
        $("#graficoVientoVel").html('<img src="img/cargando.gif">');
    });

    //direccion del viento

    $("#aTabVientDir").click(function () {
        loadGraficoLinea('vientoDir', desde, hasta, 'graficoVientoDir');
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
        if ($("#slideTemp").is(":hidden")) {
            $("#slideTemp").slideDown(600);
            setTimeout(function () {
                loadGraficoLinea('tempAire', desde, hasta, 'graficoTemp');
                loadGraficoTempMinMax(desde, hasta);
            }, 600);

            $("#slideVientoVel").slideUp(600);
            $("#slideVientoDir").slideUp(600);
            $("#slidePrecipitaciones").slideUp(600);
            $('#btnGrafTemp').html('-');
            $('#btnGrafVientoVel').html('+');
            $('#btnGrafVientoDir').html('+');
            $('#btnGrafPrecipitaciones').html('+');

        } else {
            $("#slideTemp").slideUp(600)
            $('#btnGrafTemp').html('+');

        }
    });

    $("#btnGrafVientoVel").click(function () {
        if ($("#slideVientoVel").is(":hidden")) {
            $("#slideVientoVel").slideDown(600);
            setTimeout(function () {
                loadGraficoLinea('vientoInt', desde, hasta, 'graficoVientoVel');
                loadGraficoVientoMax(hasta, hasta, 'graficoVientoMax'); //{hasta} => fecha de hoy
            }, 600);
            $("#slideTemp").slideUp(600);
            $("#slideVientoDir").slideUp(600);
            $("#slidePrecipitaciones").slideUp(600);
            $('#btnGrafVientoVel').html('-');
            $('#btnGrafTemp').html('+');
            $('#btnGrafVientoDir').html('+');
            $('#btnGrafPrecipitaciones').html('+');

        } else {
            $("#slideVientoVel").slideUp(600);
            $('#btnGrafVientoVel').html('+');
        }
    });

    $("#btnGrafVientoDir").click(function () {
        if ($("#slideVientoDir").is(":hidden")) {
            $("#slideVientoDir").slideDown(600);
            setTimeout(function () {
                loadGraficoLinea('vientoDir', desde, hasta, 'graficoVientoDir');
                loadGraficoVientoPre(desde, hasta, 'graficoVientoPre');
            }, 600);
            $("#slideTemp").slideUp(600);
            $("#slideVientoVel").slideUp(600);
            $("#slidePrecipitaciones").slideUp(600);
            $('#btnGrafVientoDir').html('-');
            $('#btnGrafTemp').html('+');
            $('#btnGrafVientoVel').html('+');
            $('#btnGrafPrecipitaciones').html('+');

        } else {
            $("#slideVientoDir").slideUp(600);
            $('#btnGrafVientoDir').html('+');
        }
    });

    $("#btnGrafPrecipitaciones").click(function () {
        if ($("#slidePrecipitaciones").is(":hidden")) {
            $("#slidePrecipitaciones").slideDown(600);
            setTimeout(function () {
                loadGraficoLinea('precipitacion', desde, hasta, 'graficoPrecipitaciones');
            }, 600);
            $("#slideTemp").slideUp(600);
            $("#slideVientoVel").slideUp(600);
            $("#slideVientoDir").slideUp(600);
            $('#btnGrafPrecipitaciones').html('-');
            $('#btnGrafTemp').html('+');
            $('#btnGrafVientoVel').html('+');
            $('#btnGrafVientoDir').html('+');

        } else {
            $("#slidePrecipitaciones").slideUp(600);
            $('#btnGrafPrecipitaciones').html('+');
        }
    });


}


/**
 * Edita el estilo del pronostico
 */
function pronostico() {
    var hoy = $("aside table table tr:nth-child(3) td:nth-child(1) span");
    var manhana = $("aside table table tr:nth-child(3) td:nth-child(3) span");
    var pasado = $("aside table table tr:nth-child(3) td:nth-child(5) span");

    $("aside table table tr:nth-child(2) td:nth-child(1)").attr("title", hoy.html());
    $("aside table table tr:nth-child(2) td:nth-child(3)").attr("title", manhana.html());
    $("aside table table tr:nth-child(2) td:nth-child(5)").attr("title", pasado.html());

    $("aside table table tbody tr:nth-child(3)").remove();


}

/**
 * Setea los datos meteorologicos
 */
function setData() {
    $.ajax({
        // url:'api.php?f=getValores',
        url:'/class/getValores.json',
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
 * Carga el grafico de linea de acuerdo al tipo
 * @param tipo Tipo de grafico
 * @param desde fecha desde donde se desea obtener el grafico
 * @param hasta fecha hasta donde se desea obtener el grafico
 * @param grafico componente html donde se cargara el grafico
 */
function loadGraficoLinea(tipo, desde, hasta, grafico) {

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

    // SERIAL CHART
    chart = new AmCharts.AmSerialChart();
    chart.pathToImages = "img/amcharts/";
    chart.zoomOutButton = {
        backgroundColor:'#000000',
        backgroundAlpha:0.15};

    chart.dataProvider = chartData;
    chart.categoryField = "date";

    // data updated event will be fired when chart is first displayed,
    // also when data will be updated. We'll use it to set some
    // initial zoom
    chart.addListener("dataUpdated", zoomChart);

    // AXES
    // Category
    var categoryAxis = chart.categoryAxis;
    categoryAxis.parseDates = true; // in order char to understand dates, we should set parseDates to true
    categoryAxis.minPeriod = "mm"; // as we have data with minute interval, we have to set "mm" here.
    categoryAxis.gridAlpha = 0.07;
    categoryAxis.axisColor = "#DADADA";

    // Value
    var valueAxis = new AmCharts.ValueAxis();
    valueAxis.gridAlpha = 0.07;
    valueAxis.title = "Datos Obtenidos";
    chart.addValueAxis(valueAxis);

    // GRAPH
    var graph = new AmCharts.AmGraph();
    graph.type = "line"; // try to change it to "column"
    graph.title = "red line";
    graph.valueField = "visits";
    graph.lineAlpha = 1;
    graph.lineColor = "#d9cf73";
    graph.fillAlphas = 0.3; // setting fillAlphas to > 0 value makes it area graph
    graph.balloonText = "[[value]] " + medida;
    chart.addGraph(graph);

    // CURSOR
    var chartCursor = new AmCharts.ChartCursor();
    chartCursor.cursorPosition = "mouse";
    chartCursor.categoryBalloonDateFormat = "JJ:NN, DD MMMM";
    chart.addChartCursor(chartCursor);

    // SCROLLBAR
    var chartScrollbar = new AmCharts.ChartScrollbar();

    chart.addChartScrollbar(chartScrollbar);

    // WRITE
    $("#" + grafico).empty();
    chart.write(grafico);
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
    chartMM = new AmCharts.AmSerialChart();
    chartMM.pathToImages = "img/amcharts/";
    chartMM.zoomOutButton = {
        backgroundColor:'#000000',
        backgroundAlpha:0.15};

    chartMM.dataProvider = chartDataMM;
    chartMM.categoryField = "date";

    // data updated event will be fired when chart is first displayed,
    // also when data will be updated. We'll use it to set some
    // initial zoom
    chartMM.addListener("dataUpdated", zoomChartMM);

    // AXES
    // Category
    var categoryAxis = chartMM.categoryAxis;
    categoryAxis.parseDates = true; // in order char to understand dates, we should set parseDates to true
    categoryAxis.minPeriod = "mm"; // as we have data with minute interval, we have to set "mm" here.
    categoryAxis.gridAlpha = 0.07;
    categoryAxis.axisColor = "#DADADA";

    // Value
    var valueAxis = new AmCharts.ValueAxis();
    valueAxis.gridAlpha = 0.07;
    valueAxis.title = "Datos Obtenidos";
    chartMM.addValueAxis(valueAxis);

    // GRAPH
    var graphMin = new AmCharts.AmGraph();
    graphMin.type = "line"; // try to change it to "column"
    graphMin.title = "red line";
    graphMin.valueField = "minima";
    graphMin.lineAlpha = 1;
    graphMin.lineColor = "#2086D9";
    graphMin.fillAlphas = 0.3; // setting fillAlphas to > 0 value makes it area graph
    graphMin.balloonText = "[[value]] " + medida;
    chartMM.addGraph(graphMin);

    var graphMax = new AmCharts.AmGraph();
    graphMax.type = "line"; // try to change it to "column"
    graphMax.title = "red line";
    graphMax.valueField = "maxima";
    graphMax.lineAlpha = 1;
    graphMax.lineColor = "#D94112";
    graphMax.fillAlphas = 0.3; // setting fillAlphas to > 0 value makes it area graph
    graphMax.balloonText = "[[value]] " + medida;
    chartMM.addGraph(graphMax);


    // CURSOR
    var chartCursor = new AmCharts.ChartCursor();
    chartCursor.cursorPosition = "mouse";
    chartCursor.categoryBalloonDateFormat = "JJ:NN, DD MMMM";
    chartMM.addChartCursor(chartCursor);

    // SCROLLBAR
    var chartScrollbar = new AmCharts.ChartScrollbar();

    chartMM.addChartScrollbar(chartScrollbar);

    // WRITE
    $("#graficoTempMaxMin").empty();
    chartMM.write("graficoTempMaxMin");
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
    var chart;
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
    chart = new AmCharts.AmRadarChart();
    chart.dataProvider = chartData;
    chart.categoryField = "direction";
    chart.startDuration = 1;


    // VALUE AXIS
    var valueAxis = new AmCharts.ValueAxis();
    valueAxis.gridType = "circles";
    valueAxis.fillAlpha = 0.05;
    valueAxis.fillColor = "#000000"
    valueAxis.axisAlpha = 0.2;
    valueAxis.gridAlpha = 0;
    valueAxis.fontWeight = "bold"
    valueAxis.minimum = 0;
    chart.addValueAxis(valueAxis);

    // GRAPH
    var graph = new AmCharts.AmGraph();
    graph.lineColor = "#FFCC00"
    graph.fillAlphas = 0.4;
    graph.bullet = "round"
    graph.valueField = "value"
    graph.balloonText = "[[category]]: [[value]] " + medida
    chart.addGraph(graph);


    // WRITE
    $("#" + grafico).empty();
    chart.write(grafico);
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
        monthNames:["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Setiembre", "Octubre", "Noviembre", "Diciembre"],
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
        loadGraficoLinea('tempAire', desde, hasta, 'grafico');
        tipo = 'tempAire';
    });
    $("#tempMin").click(function () {
        menuCssOn('li2');
        loadGraficoLinea('tempMin', desde, hasta, 'grafico');
        tipo = 'tempMin';
    });
    $("#tempMax").click(function () {
        menuCssOn('li3');
        loadGraficoLinea('tempMax', desde, hasta, 'grafico');
        tipo = 'tempMax';
    });
    $("#tempSuelos").click(function () {
        menuCssOn('li4');
        loadGraficoLinea('tempSuelo', desde, hasta, 'grafico');
        tipo = 'tempSuelo';
    });
    $("#humedad").click(function () {
        menuCssOn('li5');
        loadGraficoLinea('humedad', desde, hasta, 'grafico');
        tipo = 'humedad';
    });
    $("#vientoDir").click(function () {
        menuCssOn('li6');
        loadGraficoLinea('vientoDir', desde, hasta, 'grafico');
        tipo = 'vientoDir';
    });
    $("#vientoInt").click(function () {
        menuCssOn('li7');
        loadGraficoLinea('vientoInt', desde, hasta, 'grafico');
        tipo = 'vientoInt';
    });

    $("#presion").click(function () {
        menuCssOn('li8');
        loadGraficoLinea('presionAtm', desde, hasta, 'grafico');
        tipo = 'presionAtm';
    });
    $("#precipitacion").click(function () {
        menuCssOn('li9');
        loadGraficoLinea('precipitacion', desde, hasta, 'grafico');
        tipo = 'precipitacion';
    });
    $("#vientoMax").click(function () {
        menuCssOn('li10');
        loadGraficoLinea('vientoMax', desde, hasta, 'grafico');
        tipo = 'vientoMax';
    });
    $("#radiacion").click(function () {
        menuCssOn('li11');
        loadGraficoLinea('radiacion', desde, hasta, 'grafico');
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
    loadGraficoLinea(tipo, desde, hasta, 'grafico');
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
