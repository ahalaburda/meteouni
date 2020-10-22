<!DOCTYPE html>
<html>
<title>Sensores</title>
<head>
</head>
<body>
<?php
$servidor = "localhost";
$dbusuario = "root";
$dbpassword = "123";
$dbpuerto = "3306";
$basededatos = "meteorologia";
$tabla = "datos";

try {
    $conn = new PDO("mysql:host=$servidor;dbname=$basededatos", $dbusuario, $dbpassword);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // "**************   Conexion Exitosa! :)   **********************";
    echo "<h3>Ultimos datos de las lectura de los sensores</h3>";
    echo "<table>";
    echo "<tr><th>Sensor</th><th>Descripcion</th><th>Fecha</th><th>Hora</th><th>Dato</th></tr>";

    class TableRows extends RecursiveIteratorIterator {
        function __construct($it) {
            parent::__construct($it, self::LEAVES_ONLY);
        }

        function current() {
            return "<td style='width:150px;border:1px solid black;'>" . parent::current(). "</td>";
        }

        function beginChildren() {
            echo "<tr>";
        }

        function endChildren() {
            echo "</tr>" . "\n";
        }
    }
    try {
         $sql = 'SELECT tipo, s.descripcion, fecha, hora, data FROM datos d LEFT JOIN descripcion_sensores s ON s.codigo = d.tipo WHERE tipo =  :tiposensor ORDER BY d.id DESC LIMIT 1';
         $sensores = $conn -> prepare("SELECT distinct tipo FROM datos order by tipo asc");
         $sensores -> execute();
         $result = $sensores->setFetchMode(PDO::FETCH_ASSOC);
         foreach(($sensores->fetchAll()) as $k=>$v) {
             //echo "Hola mundo: ",$v['tipo'] . "\n";
			 $stmt = $conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			 $stmt->execute(array(':tiposensor' => $v['tipo']));
			 //set the resulting array to associative
			 $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			 foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			    echo $v;
			 }
         }
		}
    catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $conn = null;
    echo "</table>";
    // *******************************************************************************************
}
catch(PDOException $e)
{
    echo "Conexion fallida: " . $e->getMessage();
}
$conn = null;
?>

</body>
