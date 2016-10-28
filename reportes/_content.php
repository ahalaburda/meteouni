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