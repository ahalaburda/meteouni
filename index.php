<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Title Page</title>
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
		<script type="text/javascript" src="js/script.js"></script>

        <script src="js/libs/modernizr-2.5.3-respond-1.1.0.min.js"></script>
        <script type="text/javascript" src="js/libs/jquery-1.7.2.min.js"></script>
        <script type="text/javascript" src="js/libs/amcharts.js"></script>
        <script type="text/javascript" src="js/libs/jquery-ui-1.8.21.custom.min.js"></script>
        <script type="text/javascript" src="js/libs/jquery.prettyPhoto.js"></script>       
        <script type="text/javascript" src="js/libs/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/script.js"></script>
	</head>
	<body>
		<?php
			include('class/simplehtmldom/simple_html_dom.php');
			include ('pronostico.php');
		?>

		<div class="navbar">
			<nav class="navbar navbar-default" role="navigation">
				<div class="container-fluid">
					<!-- Brand and toggle get grouped for better mobile display -->
					<div class="container">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<div id="titulo">
							<span id="titulo">Universidad Nacional de Itapúa
								<br>
								Dirección Nacional de Aeronáutica Civil
							</span>
						</div>
						
					</div>
			
					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse navbar-ex1-collapse">
						<ul class="nav navbar-nav">

						</ul>
						<ul class="nav navbar-nav navbar-right">
							<li class="active">
								<a href="reportes.php">
									<img src="img/statistics.png" alt="estadisticas">
								</a>
							</li>
							<li>
								<a href="http://www.uni.edu.py" target="_blank">
									<img src="img/uni.png" alt="uni" style="padding-left: 6px;">
	                            </a>
	                        </li>
							<li>
                            <a href="http://www.meteorologia.gov.py" target="_blank">
                                <img src="img/dinac.png" alt="dinac">
                            </a>
                        </li>
						</ul>

					</div><!-- /.navbar-collapse -->
					</div>
				</div>
			</nav>
		</div>

		<div class="container">
			<div class="row">
				<div id="pronostico">
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
						<p id="encarnacion">Encarnación</p >
						<?php 
							echo" <span id='actualizado'>
							".$a["actualizacion"]."
							</span>";
						?>
						<div class="row" id="contenedor">
							<!-- ########HOY####### -->
							<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
								<div id="columna1" class="well2 active"  >
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
												<div class="icon sun-shower">
													<div class="cloud"></div>
													<div class="cloud"></div>
													<div class="sun">
														<div class="rays"></div>
													</div>
												</div>
											</div>
									</div>
									<br>
									<!-- pronostico -->
										<?php 
											echo" <p class='pronostico' >
											".$a["pronosticoHoy"]."
											</p>";	
										?>
								</div>
							</div>
							<!-- ########MAÑANA####### -->
							<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
								<div id="columna2" class="well2" >
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
												<div class=" icon sunny" >
													  <div class="sun" >
													    <div class="rays"></div>
													  </div>
												</div>
											</div>
									</div>
									<!-- pronostico -->
										<?php 
											echo" <p class='pronostico' >
											".$a["pronosticoManhana"]."
											</p>";	
										?>
								</div>
							</div>
							<!-- ########PASADO####### -->
							<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
								<div id="columna3" class="well2" >
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
													<span>máx</span>
												</div>
											</div>
										<!-- imagen del clima -->
											<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">								
												<div class="icon sun-shower">
													<div class="cloud"></div>
													<div class="cloud"></div>
													<div class="sun">
														<div class="rays"></div>
													</div>
												</div>
											</div>
									</div>
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
				<div id="lecturas-estacion">
					<div class="col-xs-12 col-sm-12 col-md-6  col-lg-6" >
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
									<div class="lecturas row well3">
										<p class="lectura-titulo">Temperatura</p>
										<div class="col-xs-2 col-sm-2 col-md-2">
											<div class="logo">
												<img src="img/SVG/sw-52.svg" alt="radiacion">
											</div>
										</div>
										<div class="col-xs-2 col-sm-2 col-md-2">
											<div class="dato">
												<label id="tempActual"></label>
												° C
											</div>
										</div>
										<div class="col-xs-7 col-sm-7 col-md-7">
											<div class="right">
												<div class="top"><b>Min: <label id="tempMin"></label>° C </b>a las <label id="horaTempMin"></label> hs
												</div>
												<div class="button"><b> Max: <label id="tempMax"></label>° C </b> a las <label id="horaTempMax"></label>
												    hs
												</div>
											</div>
										</div>
										<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
											<div id="botonera">
												<div id="botonera-content">
													<span class="plus">
														<a href="#" title="Lorem ipsum">
															<i class="glyphicon glyphicon-plus"></i>
														</a>
													</span>
												</div>
											</div>
										</div>
									</div>
								</section>
						        <!-- Velocidad del Viento -->
								<section>
									<div class="lecturas row well3">
										<p class="lectura-titulo">Velocidad del Viento</p>
										<div class="col-xs-2 col-sm-2 col-md-2">
											<div class="logo">
												<img src="img/wind-sock.svg" alt="velocidad">
											</div>
										</div>
										<div class="col-xs-2 col-sm-2 col-md-2">
											<div class="dato">
												<label id="velViento"></label>
												Km/h
											</div>
										</div>
										<div class="col-xs-7 col-sm-7 col-md-7">
						                    <div class="right">
						                        <div class="top"><b>Max: <label id="velVeintoMax"></label> Km/h </b>a las <label
						                                id="horaVientoMax"></label> hs
						                        </div>
						                        <div class="button"><b> Dir: <label id="dirVientoMax"></label> <label id="graVientoMax"></label>° </b>
						                        </div>
						                    </div>
										</div>
										<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
											<div id="botonera">
												<div id="botonera-content">
													<span class="plus">
														<a href="#" title="Lorem ipsum">
															<i class="glyphicon glyphicon-plus"></i>
														</a>
													</span>
												</div>
											</div>
										</div>
									</div>
								</section>
						        <!-- Dirección del Viento -->
								<section>
									<div class="lecturas row well3">
										<p class="lectura-titulo">Dirección del Viento</p>
										<div class="col-xs-2 col-sm-2 col-md-2">
											<div class="logo">
												<img src="img/SVG/sw-41.svg" alt="direccion">
											</div>
										</div>
										<div class="col-xs-2 col-sm-2 col-md-2">
											<div class="dato">
												<label id="dirViento"></label>
											</div>
										</div>
										<div class="col-xs-7 col-sm-7 col-md-7">
						                    <div class="right">
						                        <div class="top"><b>Predominante del Día: <label id="dirVientoPre"></label> </b></div>
						                        <div class="button"><b> Lecturas: <label id="dirVientoLect"></label> veces</b></div>
						                    </div>
										</div>
										<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
											<div id="botonera">
												<div id="botonera-content">
													<span class="plus">
														<a href="#" title="Lorem ipsum">
															<i class="glyphicon glyphicon-plus"></i>
														</a>
													</span>
												</div>
											</div>
										</div>
									</div>
								</section>
						        <!-- Precipitaciones -->
								<section>
									<div class="lecturas row well3">
										<p class="lectura-titulo">Precipitaciones</p>
										<div class="col-xs-2 col-sm-2 col-md-2">
											<div class="logo">
												<img src="img/SVG/sw-22.svg" alt="direccion">
											</div>
										</div>
										<div class="col-xs-2 col-sm-2 col-md-2">
											<div class="dato">
												<label id="precipitaciones"></label>mm
											</div>
										</div>
										<div class="col-xs-7 col-sm-7 col-md-7">
											<div class="right">
												<div class="top"><b>Del Día: <label id="precipDia"></label> mm</b></div>
												<div class="button"><b>Del Mes: <label id="precipMes"></label> mm</b></div>
											</div>
										</div>
										<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
											<div id="botonera">
												<div id="botonera-content">
													<span class="plus">
														<a href="#" title="Lorem ipsum">
															<i class="glyphicon glyphicon-plus"></i>
														</a>
													</span>
												</div>
											</div>
										</div>
									</div>
								</section>

						        <!-- Presión - Humedad - Suelo - Radiación -->
<!-- 						        <section>
						            <div class="last-lecturas">
						                <div class="dato">
						                    <h3>
						                        Presión
						                    </h3>
						                    <img src="img/presion.jpg"
						                         alt="presion">
						                    <br>

						                    <div>
						                        <label id="presion"></label> hPa
						                    </div>
						                </div>
						                <div class="dato">
						                    <h3>
						                        Humedad
						                    </h3>
						                    <img src="img/humedad.png"
						                         alt="humedad">
						                    <br>

						                    <div>
						                        <label id="humedad"></label>%
						                    </div>
						                </div>
						                <div class="dato">
						                    <h3>
						                        Suelo
						                    </h3>
						                    <img src="img/thermometer.png"
						                         alt="suelo">
						                    <br>

						                    <div>
						                        <label id="tempSuelo"></label> °C
						                    </div>
						                </div>
						                <div class="dato">
						                    <h3>
						                        Radiación
						                    </h3>
						                    <img src="img/radiacion.svg"
						                         alt="radiacion">
						                    <br>

						                    <div>
						                        <label id="radiacion"></label> w/m²
						                    </div>
						                </div>
						            </div>
						            <div class="clearfix"></div>
						        </section> -->
							</article>
						</div>
					</div>
				</div>
				<!-- </div> -->
			</div>
		</div>

	</body>
</html>