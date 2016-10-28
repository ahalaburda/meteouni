<!doctype html>

<html class="no-js" lang="en"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

        <title>Meteorologia UNI - DINAC</title>
        <meta name="description" content="Estacion meteorologica UNI">
        <meta name="keywords" content="tiempo, clima, pronostico, doppler, satellite, calor, frio, lluvia, viento, presion, radiacion, humedad, temperatura, encarnacion, itapua, uni">

        <meta name="viewport" content="width=device-width">

<!--         <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/jquery-ui-1.8.21.custom.css">
        <link rel="stylesheet" type="text/css" href="css/demo.css" />
        <link rel="stylesheet" type="text/css" href="css/elastislide.css" />
        <link rel="stylesheet" type="text/css" href="css/prettyPhoto.css" />
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />

        <script src="js/libs/modernizr-2.5.3-respond-1.1.0.min.js"></script>
        <script type="text/javascript" src="js/libs/jquery-1.7.2.min.js"></script>
        <script type="text/javascript" src="js/libs/amcharts.js"></script>
        <script type="text/javascript" src="js/libs/jquery-ui-1.8.21.custom.min.js"></script>
        <script type="text/javascript" src="js/libs/jquery.prettyPhoto.js"></script>       
        <script type="text/javascript" src="js/libs/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/script.js"></script> -->


        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <!-- Google Fonts - Lato, Open Sans, Raleway -->
       <link href="https://fonts.googleapis.com/css?family=Lato:100i,400" rel="stylesheet">
       <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
       <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
       <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">

        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/estilo.css">
        <link rel="stylesheet" href="css/jquery-ui-1.8.21.custom.css">

        
        <!-- jQuery -->
        <script src="//code.jquery.com/jquery.js"></script>
        <!-- Bootstrap JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
        <script type="text/javascript" src="js/plugins.js"></script>
        
        <!-- <script src="js/libs/modernizr-2.5.3-respond-1.1.0.min.js"></script> -->
        <!-- <script type="text/javascript" src="js/libs/jquery-1.7.2.min.js"></script> -->
        <script type="text/javascript" src="js/libs/amcharts.js"></script>
        <script type="text/javascript" src="js/libs/jquery-ui-1.8.21.custom.min.js"></script>
        <script type="text/javascript" src="js/libs/jquery.prettyPhoto.js"></script>       
        <!-- <script type="text/javascript" src="js/libs/bootstrap.min.js"></script> -->
        <script type="text/javascript" src="js/script.js"></script>

        <script type="text/javascript">

            var _gaq = _gaq || [];
            _gaq.push(['_setAccount', 'UA-35754384-1']);
            _gaq.push(['_setDomainName', 'uni.edu.py']);

            _gaq.push(['_trackPageview']);

            (function() {
                var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
                ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
            })();

        </script>
    </head>

    <body>

<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand hidden-sm hidden-md hidden-lg" href="#">
                            <div id="titulo">
                            <span id="titulo">Universidad Nacional de Itapúa <br> Dirección Nacional de Aeronáutica Civil
                            </span>
                        </div>
                    </a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li><a href="../">Inicio</a></li>
                <li class="active"><a href="/reportes.php">Reportes</a></li>
                    <li class="hidden-xs">              
                        <div id="titulo">
                            <span id="titulo">Universidad Nacional de Itapúa <br> Dirección Nacional de Aeronáutica Civil
                            </span>
                        </div>
                    </li>
                <li><a href="#">link</a></li>
                <li><a href="#">link</a></li>
            </ul>
        </div>
    </div>
</nav>


        <div id="main-container">
                <div class="clearfix">

                    <div id="navbar">
                        <ul>
                            <li id="li1"><span id="tempAire">Temperatura del Aire</span></li>
                            <li id="li2"><span id="tempMin">Temperaturas Mínima</span></li>
                            <li id="li3"><span id="tempMax">Temperaturas Máximas</span></li>
                            <li id="li4"><span id="tempSuelos">Temperatura del Suelo</span></li>
                            <li id="li5"><span id="humedad">Humedad Relativa</span></li>
                            <li id="li6"><span id="vientoDir">Dirección del Viento</span></li>
                            <li id="li7"><span id="vientoInt">Intensidad del Viento</span></li>
                            <li id="li8"><span id="presion">Presión Atmosferica</span></li>
                            <li id="li9"><span id="precipitacion">Precipitaciones</span></li>
                            <li id="li10"><span id="vientoMax">Viento Máximo</span></li>
                            <li id="li11"><span id="radiacion">Radiación</span></li>
                        </ul>

                    </div>

                    <div id="contReportes">

                        <h3>Reportes</h3>
                        <div>

                            <div>
                                Desde: <input type="text" id="txtDesde">
                                Hasta: <input type="text" id="txtHasta">
                            </div>
                            <button onclick="filtrar()">Filtrar <img src="img/filtrar.png" alt=""></button>
                            <button style="display: none" onclick="printData()">Imprimir <img src="img/print.png" alt=""></button>

                        </div>
                        <div id="grafico">

                        </div>
                    </div>
                </div>
                <br>   
        </div>
        
        <?php include_once($view->radar_modal); ?>

        <div id="footer-container">
            <footer class="wrapper">
                Desarrollado por el Departamento de Informática
                <br>
                © 2012 <a href="http://uni.edu.py"> Universidad Nacional de Itapúa</a> | Todos los derechos
                reservados
            </footer>
        </div>


    </body>
</html>
