<?php 
echo "Fecha actual: " . date("d-m-Y") . "</br>";
echo "Fecha y hora actual: " . date("d-m-Y\th:i:s") . "</br>";
echo "Hoy es: ".date("l").", ".date("d")." de ".date("F")." de "
.date("Y")."</br>";

echo "<h3>Generamos una fecha nueva con mktime</h3>";
$fecha = mktime(10,15,35,10,5,2019);
$dia = date("l, d-m-Y", $fecha);
$hora = date("H:i:s", $fecha);
echo "Fecha generada con mktime: $dia $hora </br>";

echo "<h2> Fecha con date_create, DateTime y format() </h2>";
// La fecha actual
$hoy = date_create("m/d/Y");
// otra fecha (fin de año)
$fechaFinAnio=date_create("12/31/2023");
$diferencia=date_diff($hoy, $fechaFinAnio);
$diasQueFaltan=$diferencia->format("%a");
echo "Faltan $diasQueFaltan dias para fin de año.";

?>