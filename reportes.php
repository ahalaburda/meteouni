<?php
/**
 * @author leonel 
 */
$view = new stdClass();
      
//carga el link al index 
$view->reportesLink = '<a href="index.php">
                        <img src="img/home.png" alt="estadisticas">
                        <br>
                        Inicio
                    </a>';

//carga el contenido del reporte
$view->content = "reportes/_content.php";   

//carga el template
include_once ('templates/layout.php');
?>
