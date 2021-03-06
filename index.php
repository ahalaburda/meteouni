<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Title Page</title>
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
		<!-- animate.css -->
		<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css"> -->
		<!-- Google Fonts - Lato, Open Sans, Raleway -->
		<link href="https://fonts.googleapis.com/css?family=Lato:100i,400" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">

        <link rel="stylesheet" href="css/modal.css">
        <link rel="stylesheet" href="css/estilo.css">

        <link rel="stylesheet" href="css/jquery-ui-1.8.21.custom.css">

		<!-- jQuery -->
		<script src="//code.jquery.com/jquery.js"></script>
		<!-- Bootstrap JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
		<!-- SCROLL REVEAL -->
		<!-- <script src="https://unpkg.com/scrollreveal@3.3.2/dist/scrollreveal.min.js"></script> -->

        <!-- <script src="js/libs/modernizr-2.5.3-respond-1.1.0.min.js"></script> -->
        <!-- <script type="text/javascript" src="js/libs/jquery-1.7.2.min.js"></script> -->
        <!-- <script type="text/javascript" src="js/libs/amcharts.js"></script> -->
        <script type="text/javascript" src="js/libs/jquery-ui-1.8.21.custom.min.js"></script>
        <!-- <script type="text/javascript" src="js/libs/jquery.prettyPhoto.js"></script>        -->
        <!-- <script type="text/javascript" src="js/libs/bootstrap.min.js"></script> -->
        <script type="text/javascript" src="js/plugins.js"></script>
        <script type="text/javascript" src="js/modal.js"></script>
        <script type="text/javascript" src="js/script.js"></script>
        
        <!-- <script type="text/javascript" src="js/libs/amcharts.js"></script> -->

		<script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
		<script src="https://www.amcharts.com/lib/3/radar.js"></script>
		<script src="https://www.amcharts.com/lib/3/serial.js"></script>
		<link rel="stylesheet" href="http://extra.amcharts.com/support/ameffects.css">

		<script>
				;(function (window) {

				  'use strict';

				  var docElem = window.document.documentElement;

				  function getViewportH () {
				    var client = docElem['clientHeight'],
				      inner = window['innerHeight'];

				    return (client < inner) ? inner : client;
				  }

				  function getOffset (el) {
				    var offsetTop = 0,
				        offsetLeft = 0;

				    do {
				      if (!isNaN(el.offsetTop)) {
				        offsetTop += el.offsetTop;
				      }
				      if (!isNaN(el.offsetLeft)) {
				        offsetLeft += el.offsetLeft;
				      }
				    } while (el = el.offsetParent)

				    return {
				      top: offsetTop,
				      left: offsetLeft
				    }
				  }

				  function isElementInViewport (el, h) {
				    var scrolled = window.pageYOffset,
				        viewed = scrolled + getViewportH(),
				        elH = el.offsetHeight,
				        elTop = getOffset(el).top,
				        elBottom = elTop + elH,
				        h = h || 0;

				    return (elTop + elH * h) <= viewed && (elBottom) >= scrolled;
				  }

				  function extend (a, b) {
				    for (var key in b) {
				      if (b.hasOwnProperty(key)) {
				        a[key] = b[key];
				      }
				    }
				    return a;
				  }


				  function scrollReveal(options) {
				      this.options = extend(this.defaults, options);
				      this._init();
				  }



				  scrollReveal.prototype = {
				    defaults: {
				      axis: 'y',
				      distance: '25px',
				      duration: '0.66s',
				      delay: '0s',

				  //  if 0, the element is considered in the viewport as soon as it enters
				  //  if 1, the element is considered in the viewport when it's fully visible
				      viewportFactor: 0.33
				    },

				    /*=============================================================================*/

				    _init: function () {

				      var self = this;

				      this.elems = Array.prototype.slice.call(docElem.querySelectorAll('[data-scrollReveal]'));
				      this.scrolled = false;

				  //  Initialize all scrollreveals, triggering all
				  //  reveals on visible elements.
				      this.elems.forEach(function (el, i) {
				        self.animate(el);
				      });

				      var scrollHandler = function () {
				        if (!self.scrolled) {
				          self.scrolled = true;
				          setTimeout(function () {
				            self._scrollPage();
				          }, 60);
				        }
				      };

				      var resizeHandler = function () {
				        function delayed() {
				          self._scrollPage();
				          self.resizeTimeout = null;
				        }
				        if (self.resizeTimeout) {
				          clearTimeout(self.resizeTimeout);
				        }
				        self.resizeTimeout = setTimeout(delayed, 200);
				      };

				      window.addEventListener('scroll', scrollHandler, false);
				      window.addEventListener('resize', resizeHandler, false);
				    },

				    /*=============================================================================*/

				    _scrollPage: function () {
				        var self = this;

				        this.elems.forEach(function (el, i) {
				            if (isElementInViewport(el, self.options.viewportFactor)) {
				                self.animate(el);
				            }
				        });
				        this.scrolled = false;
				    },

				    /*=============================================================================*/

				    parseLanguage: function (el) {

				  //  Splits on a sequence of one or more commas, periods or spaces.
				      var words = el.getAttribute('data-scrollreveal').split(/[, ]+/),
				          enterFrom,
				          parsed = {};

				      function filter (words) {
				        var ret = [],

				            blacklist = [
				              "from",
				              "the",
				              "and",
				              "then",
				              "but"
				            ];

				        words.forEach(function (word, i) {
				          if (blacklist.indexOf(word) > -1) {
				            return;
				          }
				          ret.push(word);
				        });

				        return ret;
				      }

				      words = filter(words);

				      words.forEach(function (word, i) {

				        switch (word) {
				          case "enter":
				            enterFrom = words[i + 1];

				            if (enterFrom == "top" || enterFrom == "bottom") {
				              parsed.axis = "y";
				            }

				            if (enterFrom == "left" || enterFrom == "right") {
				              parsed.axis = "x";
				            }

				            return;

				          case "after":
				            parsed.delay = words[i + 1];
				            return;

				          case "wait":
				            parsed.delay = words[i + 1];
				            return;

				          case "move":
				            parsed.distance = words[i + 1];
				            return;

				          case "over":
				            parsed.duration = words[i + 1];
				            return;

				          case "trigger":
				            parsed.eventName = words[i + 1];
				            return;

				          default:
				        //  Unrecognizable words; do nothing.
				            return;
				        }
				      });

				  //  After all values are parsed, let’s make sure our our
				  //  pixel distance is negative for top and left entrances.
				  //
				  //  ie. "move 25px from top" starts at 'top: -25px' in CSS.

				      if (enterFrom == "top" || enterFrom == "left") {

				        if (!typeof parsed.distance == "undefined") {
				          parsed.distance = "-" + parsed.distance;
				        }

				        else {
				          parsed.distance = "-" + this.options.distance;
				        }

				      }

				      return parsed;
				    },

				    /*=============================================================================*/

				    genCSS: function (el, axis) {
				      var parsed = this.parseLanguage(el);

				      var dist   = parsed.distance || this.options.distance,
				          dur    = parsed.duration || this.options.duration,
				          delay  = parsed.delay    || this.options.delay,
				          axis   = parsed.axis     || this.options.axis;

				      var transition = "-webkit-transition: all " + dur + " ease " + delay + ";" +
				                          "-moz-transition: all " + dur + " ease " + delay + ";" +
				                            "-o-transition: all " + dur + " ease " + delay + ";" +
				                               "transition: all " + dur + " ease " + delay + ";";

				      var initial = "-webkit-transform: translate" + axis + "(" + dist + ");" +
				                       "-moz-transform: translate" + axis + "(" + dist + ");" +
				                            "transform: translate" + axis + "(" + dist + ");" +
				                              "opacity: 0;";

				      var target = "-webkit-transform: translate" + axis + "(0);" +
				                      "-moz-transform: translate" + axis + "(0);" +
				                           "transform: translate" + axis + "(0);" +
				                             "opacity: 1;";
				      return {
				        transition: transition,
				        initial: initial,
				        target: target,
				        totalDuration: ((parseFloat(dur) + parseFloat(delay)) * 1000)
				      };
				    },

				    /*=============================================================================*/

				    animate: function (el) {
				      var css = this.genCSS(el);

				      if (!el.getAttribute('data-sr-init')) {
				        el.setAttribute('style', css.initial);
				        el.setAttribute('data-sr-init', true);
				      }

				      if (el.getAttribute('data-sr-complete')) {
				        return;
				      }

				      if (isElementInViewport(el, this.options.viewportFactor)) {
				        el.setAttribute('style', css.target + css.transition);

				        setTimeout(function () {
				          el.removeAttribute('style');
				          el.setAttribute('data-sr-complete', true);
				        }, css.totalDuration);
				      }

				    }
				  }; // end scrollReveal.prototype

				  document.addEventListener("DOMContentLoaded", function (evt) {
				    window.scrollReveal = new scrollReveal();
				  });
				})(window);
		</script>

	</head>
	<body>
		<?php
			include ('pronostico.php');
			include ('checkBrowser.php')
		?>

		<nav class="navbar navbar-default" role="navigation">
		    <!-- Brand and toggle get grouped for better mobile display -->
		    <div class="navbar-header">
		      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-1">
		        <span class="sr-only">Toggle navigation</span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		      </button>
		    </div>
			<div class="container">
				    <a class="navbar-brand hidden-xs" href="#">
				    	<div id="titulo">
							<span id="titulo">Universidad Nacional de Itapúa <br> Dirección Nacional de Aeronáutica Civil</span>
						</div>
					</a>
				    <a class="navbar-brand hidden-sm hidden-md hidden-lg" href="#">
						<div id="titulo">
							<span id="titulo">UNI - DINAC</span>
						</div>
					</a>
			    <!-- Collect the nav links, forms, and other content for toggling -->
			    <div class="collapse navbar-collapse" id="navbar-collapse-1">
			      <ul class="nav navbar-nav navbar-left">
			        <li class="active"><a href="#">Inicio</a></li>
			        <li><a href="/reportes.php">Reportes</a></li>
			      </ul>
			      <ul class="nav navbar-nav navbar-right">
					<li><a href="http://www.meteorologia.gov.py/satelital.php" target="_blank">Sensores Remotos</a></li>
			        <li class="dropdown">
			          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
			          <ul class="dropdown-menu">
			            <li><a href="#">Action</a></li>
			            <li><a href="#">Another action</a></li>
			            <li><a href="#">Something else here</a></li>
			            <li class="divider"></li>
			            <li><a href="#">Separated link</a></li>
			          </ul>
			        </li>
			      </ul>
			    </div><!-- /.navbar-collapse -->
			</div>
		</nav>

		<div class="container">
			<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
						<div id= "pronostico" >
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="padding-right: 0px; padding-left: 0px;">
								<p id="encarnacion">Encarnación</p >
								<?php
									echo" <span id='actualizado'>
									".$a["actualizacion"]."
									</span>";
								?>
								<div class="row" id="contenedor">
									<!-- ########HOY####### -->
									<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4" data-scrollreveal="enter top over 0.5s after 0.2s">
										<div class="flip">
											<div class="card">
												<div class="face front">
													<div id="columna1" class="well2 well-sm inner" >
														<!-- dia -->
														<p class="dia">Hoy</p>
														<hr>
														<div class="row">
														<!-- temperatura -->
															<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
																<br>
																	<?php
																		echo" <p class='temperatura'>
																		".$a["tempHoy"]."
																		</p>";
																	?>
																	<div class="min-max" id="max">
																		<span >máx</span>
																	</div>
															</div>
														<!-- imagen del clima -->
															<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
																<div class="pronostico_img1">
																	<img <?php echo" src=' ".$a["imgHoy"]." ' "; ?> alt="">
																</div>
															</div>
														</div>
														<br>
													</div>
													<div class="well3">
														<div style="text-align: center; cursor: pointer;">
															<span id="boton-pronostico" >Ver Pronostico </span>
														</div>
													</div>
												</div>
												<div class="face back">
													<div class="well3 well-sm inner"> 
														<!-- dia -->
														<p class="dia">Hoy</p>
														<hr>
														<!-- pronostico -->
															<?php
																echo" <p class='pronostico' >
																".$a["pronosticoHoy"]."
																</p>";
															?>
													</div>
												</div>
											</div>
										</div>
									</div>
									<!-- ########MAÑANA####### -->
									<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4" data-scrollreveal="enter top over 0.5s after 0.4s">
										<div class="flip">
											<div class="card">
												<div class="face front">
													<div id="columna2" class="well2 well-sm inner" >
														<!-- dia -->
															<?php
																echo" <p class='dia'>
																".$a["manhana"]."
																</p>";
															?>
														<hr>
														<div class="row">
															<!-- temperatura -->
																<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
																	<?php
																		echo" <p class='temperatura'>
																		".$a["tempMinManhana"]."
																		</p>";
																	?>
																	<div class="min-max" id="min">
																		<span>min</span>
																	</div>
																	<?php 
																		echo" <p class='temperatura'>
																		".$a["tempMaxManhana"]."
																		</p>";
																	?>
																	<div class="min-max" id="max">
																		<span >máx</span>
																	</div>
																</div>
															<!-- imagen del clima -->
																<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
																	<div class="pronostico_img1">
																		<img <?php echo" src=' ".$a["imgManhana"]." ' "; ?> alt="">
																	</div>
																</div>
														</div>
													</div>
													<div class="well3">
														<div style="text-align: center; cursor: pointer;">
															<span id="boton-pronostico" >Ver Pronostico </span>
														</div>
													</div>
												</div>
												<div class="face back">
														<div class="well3 well-sm inner">
														<!-- dia -->
															<?php
																echo" <p class='dia'>
																".$a["manhana"]."
																</p>";
															?>
														<hr>
															<!-- pronostico -->
															<?php
																echo" <p class='pronostico' >
																".$a["pronosticoManhana"]."
																</p>";
															?>
														</div>
												</div>
											</div>
										</div>
									</div>
									<!-- ########PASADO####### -->
									<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4" data-scrollreveal="enter top over 0.5s after 0.6s">
										<div class="flip">
											<div class="card">
												<div class="face front">
													<div id="columna2" class="well2 well-sm inner" >
														<!-- dia -->
															<?php
																echo" <p class='dia'>
																".$a["pasado"]."
																</p>";
															?>
														<hr>
														<div class="row">
															<!-- temperatura -->
																<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
																	<?php
																		echo" <p class='temperatura'>
																		".$a["tempMinPasado"]."
																		</p>";
																	?>
																	<div class="min-max" id="min">
																		<span>min</span>
																	</div>
																	<?php 
																		echo" <p class='temperatura'>
																		".$a["tempMaxPasado"]."
																		</p>";
																	?>
																	<div class="min-max" id="max">
																		<span >máx</span>
																	</div>
																</div>
															<!-- imagen del clima -->
																<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
																	<div class="pronostico_img1">
																		<img <?php echo" src=' ".$a["imgPasado"]." ' "; ?> alt="">
																	</div>
																</div>
														</div>
													</div>
													<div class="well3">
														<div style="text-align: center; cursor: pointer;">
															<span id="boton-pronostico" >Ver Pronostico</span>
														</div>
													</div>
												</div>
												<div class="face back">
														<div class="well3 well-sm inner">
															<!-- dia -->
																<?php
																	echo" <p class='dia'>
																	".$a["pasado"]."
																	</p>";
																?>
															<hr>
															<!-- pronostico -->
															<?php
																echo" <p class='pronostico' >
																".$a["pronosticoPasado"]."
																</p>";
															?>
														</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div id="radar2" data-scrollreveal="enter top over 0.5s after 0.8s">
							<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8" style="padding-right: 0px; padding-left: 0px;">
								<div class="well3">
									<div id="radar" >
										<div class="hovereffect">
											<?php  $browser = new Browser();
													if($browser->isMobile()) {
														if($browser->getBrowser() == Browser::BROWSER_OPERA  ||  Browser::BROWSER_CHROME || Browser::BROWSER_ANDROID || Browser::BROWSER_IPHONE || Browser::BROWSER_IPOD || Browser::BROWSER_IPAD ){
															?>
																<video id="myImg" width="350" height="310" controls loop >
																	<source src="img/doppler/video4.webm"  type='video/webm; codecs="vp8, vorbis"' />
																	<source src="img/doppler/video4.mp4" type='video/mp4; codecs="avc1.42E01E, mp4a.40.2"' />
																	<source src="img/doppler/video4.ogv" type='video/ogg; codecs="theora, vorbis"' />
																	Your browser does not support the video tag.
																</video>
															<?php
														}else{
															?>
																	<video id="myImg" width="350" height="310" autoplay loop >
																		<source src="img/doppler/video4.webm"  type='video/webm; codecs="vp8, vorbis"' />
																		<source src="img/doppler/video4.mp4" type='video/mp4; codecs="avc1.42E01E, mp4a.40.2"' />
																		<source src="img/doppler/video4.ogv" type='video/ogg; codecs="theora, vorbis"' />
																		Your browser does not support the video tag.
																	</video>
															<?php
														}
													} else {
														if($browser->getBrowser() == Browser::BROWSER_FIREFOX  ||  Browser::BROWSER_CHROME ) {
																?>
																	<video id="myImg" width="350" height="310" autoplay loop >
																		<source src="img/doppler/video4.webm"  type='video/webm; codecs="vp8, vorbis"' />
																		<source src="img/doppler/video4.mp4" type='video/mp4; codecs="avc1.42E01E, mp4a.40.2"' />
																		<source src="img/doppler/video4.ogv" type='video/ogg; codecs="theora, vorbis"' />
																		Your browser does not support the video tag.
																	</video>
																<?php
														} else {
																?>
																	<video id="myImg" width="350" height="310" autoplay loop >
																		<source src="img/doppler/video4.webm"  type='video/webm; codecs="vp8, vorbis"' />
																		<source src="img/doppler/video4.mp4" type='video/mp4; codecs="avc1.42E01E, mp4a.40.2"' />
																		<source src="img/doppler/video4.ogv" type='video/ogg; codecs="theora, vorbis"' />
																		Your browser does not support the video tag.
																	</video>
																<?php
														}
													}
											?>
											<div id="overlay1" class="overlay">
												<a class="info" href="#" title="">
													<span class="glyphicon glyphicon-zoom-in" aria-hidden="true"></span>
												</a>
											</div>
										</div>
										<div id="myModal" class="modal">
											<span class="close">×</span>
											<video class="modal-content" id="img01"  autoplay controls loop >
												<source src="img/doppler/video3.webm" type='video/webm; codecs="vp8, vorbis"' />
												<source src="img/doppler/video3.mp4" type='video/mp4; codecs="avc1.42E01E, mp4a.40.2"' />
												<source src="img/doppler/video3.ogv" type='video/ogg; codecs="theora, vorbis"' />
												Your browser does not support the video tag.
											</video>
											<div id="caption"> Últimas imágenes del radar meteorológico doppler</div>
										</div>
									</div>
								<!-- <div class="last-lecturas hidden-md hidden-lg">
										<div class="dato">
											<a href="http://www.meteorologia.gov.py/radar/" title="doppler"> 
												<h3>Radar Meteorologico</h3>
												<img src="img/radar.svg" alt="radar" >
											</a>
										</div>
										<div class="dato">
											<a href="http://www.meteorologia.gov.py/sudamerica.html" title="doppler"> 
												<h3>Imágen Satelital</h3>
												<img src="img/GOES.svg" alt="radar" >
											</a>
										</div>
									</div> -->
								</div>
							</div>
						</div>
						<div id="pronosticos-varios" data-scrollreveal="enter top over 0.5s after 1s">
						<!-- Presión - Humedad - Suelo - Radiación -->
							<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4" id="varios">
								<div class="well2">
									<div class="last-lecturas">
									<!-- ######PRESION###### -->
										<div class="dato" id="macanada">
											<h3>Presión</h3>
											<img src="img/barometro.svg" alt="presion">
											<br>
											<div>
												<label id="presion"></label> hPa
											</div>
										</div>
									<!-- ########HUMEDAD###### -->
										<div class="dato" id="macanada">
											<h3>Humedad</h3>
											<img src="img/humedad-5.svg" alt="humedad">
											<br>
											<div>
												<label id="humedad"></label>%
											</div>
										</div>
									<!-- ########Temp Suelo###### -->
										<div class="dato" id="macanada">
											<h3>Suelo</h3>
											<img src="img/SVG/sw-52.svg" alt="suelo">
											<br>
											<div>
												<label id="tempSuelo"></label> °C
											</div>
										</div>
									<!-- ##########Radiacion######### -->
										<div class="dato" id="macanada">
											<h3>Radiación</h3>
											<img src="img/sw-01.svg" alt="radiacion">
											<br>
											<div>
												<label id="radiacion"></label> w/m²
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6" >
						<div id="lecturas-estacion">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<div id="main" class="wrapper clearfix">
									<article id="contIndex">
										<header>Lecturas Obtenidas
											<label id='fechaHoraData'></label>
										</header>
										<div>
											<?php
												require 'class/Meteo.php';
								                $m = new Meteo();
								                $arrFechaHora = $m->getFechaHoraUltimaLectura();
								                $fecha = $arrFechaHora['fecha'];
								                $hora = $arrFechaHora['hora'];

								                $fecha_sistema = date("m/d/Y h:i:s a", time());

								                $s = $fecha." ". $hora;
								                $date = strtotime($s);
								                $fecha_lectura = date('m/d/Y  h:i:s a', $date);

								                $f0 = strtotime($fecha_lectura);
								                $f1 = strtotime($fecha_sistema);
								                $resultado = ($f1 - $f0);
								                $minutos_dif = round ($resultado / 60 );	

								                if($minutos_dif > 360){ ?>
								                    <br>
								                    <div style="border-color:indianred; border-style: solid; text-align: center; background-color: beige; padding: 10px; color:black">
								                        No se están registrando lecturas actualizadas desde la estación meteorológica
								                    <br>
								                        Última lectura registrada hace <?php echo " ". $minutos_dif. " "?> minutos
								                    </div><?php
								                }   ?>
										</div>
										<!-- Temperatura -->
										<section>
											<div class="lecturas row well3 " data-scrollreveal="enter top over 0.5s and move 200px">
												<p class="lectura-titulo">Temperatura</p>
												<div class="col-xs-2 col-sm-2 col-md-2">
													<div class="iconos">
														<img src="img/SVG/sw-52.svg" alt="radiacion">
													</div>
												</div>
												<div class="col-xs-3 col-xs-offset-1 col-sm-2 col-sm-offset-0 col-md-2 col-md-offset-0">
													<div class="dato">
														<label id="tempActual"></label>
														° C
													</div>
												</div>
												<div class="col-xs-6 col-sm-7 col-md-7">
													<div class="right">
														<div class="top"><b>Min: <label id="tempMin"></label>° C </b>a las <label id="horaTempMin"></label> hs
														</div>
														<div class="button"><b> Max: <label id="tempMax"></label>° C </b> a las <label id="horaTempMax"></label>
														    hs
														</div>
													</div>
												</div>
												<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 hidden-xs">
													<div id="botonera1">
														<div>
															<div class="boton" id="btnGrafTemp" href="#"><i id="gbtn1" class="glyphicon glyphicon-plus"></i></div>
														</div>
													</div>
												</div>
												<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" id="grafico1">
													<div id="tabsTemperatura">
														<ul class="nav nav-tabs">
															<li class="active" ><a data-toggle="tab" id="aTabTemp" href="#tabTemp">Temperatura</a></li>
															<li><a data-toggle="tab" id="aTabTempMaxMin" href="#tabTempMaxMin">Máximas vs Mínimas</a></li>
														</ul>
														<div class="tab-content">
															<div id="tabTemp" class="tab-pane fade active in">
																<div id="graficoTemp">
																	<img src="img/cargando.gif">
																</div>
															</div>
															<div id="tabTempMaxMin" class="tab-pane fade">
																<div id="graficoTempMaxMin">
																	<img src="img/cargando.gif">
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</section>
										<!-- Velocidad del Viento -->
										<section>
											<div class="lecturas row well3" data-scrollreveal="enter top over 0.5s and move 200px after 0.3s">
												<p class="lectura-titulo">Velocidad del Viento</p>
												<div class="col-xs-2 col-sm-2 col-md-2">
													<div class="iconos">
														<img src="img/wind-sock.svg" alt="velocidad">
													</div>
												</div>
												<div class="col-xs-3 col-xs-offset-1 col-sm-2 col-sm-offset-0 col-md-2 col-md-offset-0">
													<div class="dato">
														<label id="velViento"></label>
														Km/h
													</div>
												</div>
												<div class="col-xs-6 col-sm-7 col-md-7">
													<div class="right">
														<div class="top">
															<b>Max: <label id="velVeintoMax"></label> Km/h </b>a las 
															<label id="horaVientoMax"></label> hs
														</div>
														<div class="button">
															<b> Dir: <label id="dirVientoMax"></label>
															<label id="graVientoMax"></label>° </b>
														</div>
													</div>
												</div>
												<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 hidden-xs">
													<div id="botonera2">
														<div>
															<div class="boton" id="btnGrafVientoVel" href="#"><i id="gbtn2" class="glyphicon glyphicon-plus"></i></div>
														</div>
													</div>
												</div>
												<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" id="grafico2">
													<div id="tabsVientoVel">
														<ul class="nav nav-tabs">
															<li class="active" ><a data-toggle="tab" id="aTabVientoVel" href="#tabVientoVel">Velocidad</a></li>
															<li><a data-toggle="tab" id="aTabVientoMax" href="#aTabVientoMax">Máximo</a></li>
														</ul>
														<div class="tab-content">
															<div id="tabVientoVel" class="tab-pane fade active in">
																<div id="graficoVientoVel">
																	<img src="img/cargando.gif">
																</div>
															</div>
															<div id="tabVientoMax" class="tab-pane fade">
																<div id="graficoVientoMax">
																	<img src="img/cargando.gif">
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</section>
										<!-- Dirección del Viento -->
										<section>
											<div class="lecturas row well3 " data-scrollreveal="enter top over 0.5s and move 200px after 0.4s">
												<p class="lectura-titulo">Dirección del Viento</p>
												<div class="col-xs-2 col-sm-2 col-md-2">
													<div class="iconos">
														<img src="img/SVG/sw-41.svg" alt="direccion">
													</div>
												</div>
												<div class="col-xs-3 col-xs-offset-1 col-sm-2 col-sm-offset-0 col-md-2 col-md-offset-0">
													<div class="dato">
														<label id="dirViento"></label>
													</div>
												</div>
												<div class="col-xs-6 col-sm-7 col-md-7">
													<div class="right">
														<div class="top"><b>Predominante del Día: <label id="dirVientoPre"></label> </b></div>
														<div class="button"><b> Lecturas: <label id="dirVientoLect"></label> veces</b></div>
													</div>
												</div>
												<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 hidden-xs">
													<div id="botonera3">
														<div>
															<div class="boton" id="btnGrafVientoDir" href="#"><i id="gbtn3" class="glyphicon glyphicon-plus"></i></div>
														</div>
													</div>
												</div>
												<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" id="grafico3" >
													<ul class="nav nav-tabs">
														<li class="active" ><a data-toggle="tab" id="aTabVientDir" href="#tabVientoDir">Dirección</a></li>
														<li><a data-toggle="tab" id="aTabVientoPre" href="#tabVientoPre">Predominante del Día</a></li>
													</ul>
													<div class="tab-content">
														<div id="tabVientoDir" class="tab-pane fade active in">
															<div id="graficoVientoDir">
																<img src="img/cargando.gif">
															</div>
														</div>
														<div id="tabVientoPre" class="tab-pane fade">
															<div id="graficoVientoPre">
																<img src="img/cargando.gif">
															</div>
														</div>
													</div>
												</div>
											</div>
										</section>
								        <!-- Precipitaciones -->
										<section>
											<div class="lecturas row well3 " data-scrollreveal="enter top over 0.5s and move 200px after 0.5s">
												<p class="lectura-titulo">Precipitaciones</p>
												<div class="col-xs-2 col-sm-2 col-md-2">
													<div class="iconos">
														<img src="img/SVG/sw-22.svg" alt="direccion">
													</div>
												</div>
												<div class="col-xs-3 col-xs-offset-1 col-sm-2 col-sm-offset-0 col-md-2 col-md-offset-0">
													<div class="dato">
														<label id="precipitaciones"></label>mm
													</div>
												</div>
												<div class="col-xs-6 col-sm-7 col-md-7">
													<div class="right">
														<div class="top"><b>Del Día: <label id="precipDia"></label> mm</b></div>
														<div class="button"><b>Del Mes: <label id="precipMes"></label> mm</b></div>
													</div>
												</div>
												<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 hidden-xs">
													<div id="botonera4">
														<div>
															<div class="boton" id="btnGrafPrecipitaciones" href="#"><i id="gbtn4" class="glyphicon glyphicon-plus"></i></div>
														</div>
													</div>
												</div>
												<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" id="grafico4">
													<ul class="nav nav-tabs">
														<li class="active" ><a data-toggle="tab" id="aTabPrecipitaciones" href="#tabPrecipitaciones">Precipitaciones</a></li>
													</ul>
													<div class="tab-content">
														<div id="tabPrecipitaciones" class="tab-pane fade active in">
															<div id="graficoPrecipitaciones">
																<img src="img/cargando.gif">
															</div>
														</div>
													</div>
												</div>
											</div>
										</section>
									</article>
								</div>
							</div>
						</div>
					</div>		
				<!-- </div> -->
			</div> <!-- row -->
		</div> <!-- container -->


		<footer>
			<div class="row" style="width: 100% !important";>
				<div class="col-xs-6 col-sm-6 col-md-4 col-lg-2 hidden-xs">
					<div id="imagen-footer">
						<a href="http://www.uni.edu.py" target="_blank">
							<div class="logo">
								<img src="img/uni3.svg" alt="uni" >
							</div>
						</a>
						 <a href="http://www.meteorologia.gov.py" target="_blank">
							<div class="logo">
								<img src="img/dinac.png" alt="dinac">
							</div>
						</a>
					</div>
				</div>
				<div class="col-xs-6 col-sm-6 col-md-4 col-lg-4">
					<p id="descripcion">Esta página es producto de tareas en conjunto entre el Departamento de Informática de la Universidad Nacional de Itapúa y la Dirección de Meteorología e Hidrología de la DINAC, en el marco del convenio entre ambas partes.</p>
				</div>
				<div class="col-xs-6 col-sm-6 col-md-2 col-lg-2">
					<div class="pequeño">
						<a href="http://www.uni.edu.py" target="_blank" data-toggle="tooltip" data-placement="left" title="Ir al sitio de la Universidad Nacional de Itapúa">
							<h3>UNI</h3>
						</a>
						<div class="footer-center inline">
							<div>
								<div class="input-group">
									<span class="input-group-btn"  data-toggle="tooltip" data-placement="left" title="Ver donde esta ubicado">
										<a class="btn btn-xs btn-square" href="https://www.google.com.py/maps/place/Universidad+Nacional+de+Itap%C3%BAa/@-27.3069477,-55.8873538,18z/data=!4m5!3m4!1s0x0:0xf31765db5e25c553!8m2!3d-27.3067583!4d-55.8874941?hl=es-419" target="_blank" role="button"><span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span>  </a>
									</span>
									<p style="line-height: 11px;">Abog. Lorenzo Zacarías 255 y Ruta 1 - <span>Encarnación, Paraguay</span></p>
								</div><!-- /input-group -->
							</div>
							<div>
								<div class="input-group">
									<span class="input-group-btn">
										<button class="btn btn-xs btn-square" style="cursor: none;" ><span class="glyphicon glyphicon-earphone" aria-hidden="true"></span></button>
									</span>
									<p>+595 71 206990</p>
								</div><!-- /input-group -->
							</div>
							<div>
								<div class="input-group">
									<span class="input-group-btn" data-toggle="tooltip" data-placement="left" title="Enviar un correo al desarrollador">
										<a class="btn btn-xs btn-square" href="mailto:informatica@uni.edu.py" target="_blank" role="button"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>  </a>
									</span>
									<p>informatica@uni.edu.py</p>
								</div><!-- /input-group -->
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-6 col-sm-6 col-md-2 col-lg-2">
					<div class="pequeño">
						<a href="http://www.meteorologia.gov.py" target="_blank" data-toggle="tooltip" data-placement="left" title="Ir al sitio de la Direccion de Meteorologia e Hidrología de la DINAC">
							<h3>DINAC</h3>
						</a>
						<div class="footer-center ">
							<div>
								<div class="input-group">
									<span class="input-group-btn" data-toggle="tooltip" data-placement="left" title="Ver donde esta ubicado" >
										<a class="btn btn-xs btn-square" href="https://www.google.com.py/maps/place/Centro+Meteorol%C3%B3gico+Nacional/@-25.2864383,-57.6553166,15z/data=!4m5!3m4!1s0x0:0x9626810dc66e423c!8m2!3d-25.2864383!4d-57.6553166" target="_blank" role="button"><span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span>  </a>
									</span>
									<p style="line-height: 11px;">Cnel Francisco López 1080 c/ De La Conquista - <span>Asunción, Paraguay</span></p>
								</div><!-- /input-group -->
							</div>
							<div>
								<div class="input-group">
									<span class="input-group-btn">
										<button class="btn btn-xs btn-square" style="cursor: none;" ><span class="glyphicon glyphicon-earphone" aria-hidden="true"></span></button>
									</span>
									<p>+595 21 4381000</p>
								</div><!-- /input-group -->
							</div>
							<div>
								<div class="input-group">
									<span class="input-group-btn">
										<button class="btn btn-xs btn-square" style="cursor: none;" ><span class="glyphicon glyphicon-earphone" aria-hidden="true"></span></button>
									</span>
									<p>+595 21 4381220</p>
								</div><!-- /input-group -->
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 hidden-xs hidden-sm hidden-md">
					<ul>
						<li><a href="http://www.meteorologia.gov.py/adm/uploads/Tasas.pdf" target="_blank" title="Tasas y tarifas establecidas para reportes del servicio meteorologico para el publico en general">Precios</a></li>
						<li><a href="http://www.meteorologia.gov.py/serviciopublico.php" target="_blank" title="">Consultas</a></li>
						<li><a href="mailto:director@meteorologia.gov.py" target="_blank" title="">Contacto</a></li>
					</ul>
				</div>
			</div>
			<div style="background-color: #111; text-align-last: center;">
				<p style="margin-bottom: 0px;">Copyright © 2016 Universidad Nacional de Itapúa.</p>
			</div>
		</footer>
	</body>
</html>