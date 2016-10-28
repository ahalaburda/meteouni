<!-- begin: head noeval -->

<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <title>Meteorologia UNI - DINAC</title>
    <meta name="description" content="">
    <meta name="author" content="">

    <meta name="viewport" content="width=device-width">

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/jquery-ui-1.8.21.custom.css">
    <link rel="stylesheet" type="text/css" href="css/demo.css" />
    <link rel="stylesheet" type="text/css" href="css/elastislide.css" />
    <link rel="stylesheet" type="text/css" href="css/prettyPhoto.css" />

    <script src="js/libs/modernizr-2.5.3-respond-1.1.0.min.js"></script>
    <script type="text/javascript" src="js/libs/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="js/libs/amcharts.js"></script>
    <script type="text/javascript" src="js/libs/jquery-ui-1.8.21.custom.min.js"></script>
    <script type="text/javascript" src="js/libs/jquery.prettyPhoto.js"></script>
    <script type="text/javascript" src="js/script.js"></script>

</head>

<!-- end:  head -->
<!-- begin: header -->

<body>
<!--[if lt IE 7]><p class=chromeframe>Your browser is <em>ancient!</em> <a href="http://browsehappy.com/">Upgrade to a
    different browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a>
    to experience this site.</p><![endif]-->

<div id="header-container">
    <header class="wrapper clearfix">

        <div id="title">
            <h2>
                Universidad Nacional de Itapúa <br>
                Dirección Nacional de Aeronáutica Civil
            </h2>
            <h4>
                Datos de la Estación de Encarnación - WMO: 086297
            </h4>
        </div>


        <h2 id="title2">UNI -
            DINAC</h2>
        <nav>
            <ul>
                <li>
                {reportes_link}
                </li>
                <li>
                    <a href="http://www.uni.edu.py" target="_blank">
                        <img src="img/uni.png" alt="uni">
                        <br>
                        <label>UNI</label>
                    </a>
                </li>
                <li>
                    <a href="http://www.meteorologia.gov.py" target="_blank">
                        <img src="img/dinac.jpg" alt="dinac">
                        <br>
                        <label>DINAC</label>
                    </a>
                </li>
            </ul>
        </nav>
    </header>
</div>
<!-- end: head -->

<!-- begin: container -->

<div id="main-container">

{contenidoReportes}

    <div id="main" class="wrapper clearfix">
    {titulo}
        <article id="contIndex">
        {contenido}
        {gallery}
        </article>
    {pronostico}
    {radar_doppler}
    {descripcion}
    </div>
    <!-- #main -->
</div>
<!-- #main-container -->

<!-- end: container -->


<!-- begin: end noeval-->

<div id="footer-container">
    <footer class="wrapper">
        Desarrollado por el Departamento de Informática.
        <br>
        © 2012 <a href="http://uni.edu.com.py"> Universidad Nacional de Itapúa</a> | Todos los derechos
        reservados,
    </footer>
</div>


</body>
</html>
<!-- end: end -->