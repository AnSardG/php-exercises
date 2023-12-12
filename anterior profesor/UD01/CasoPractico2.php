<?php
$fecha1="23 de Abril de 2023";
$posDe1= strpos($fecha1, " de ");
$posDe2= strrpos($fecha1, " de ");
$dia1 = substr($fecha1, 0, $posDe1);
$mes1 = substr($fecha1, $posDe1 + 3, $posDe2 - $posDe1 - 3);
$anio1 = substr($fecha1, -4, 4);

echo "<h3> Primera fecha: $fecha1</h3>";
echo "<strong> Día: </strong>$dia1</br>";
echo "<strong> Mes: </strong>$mes1</br>";
echo "<strong> Año: </strong>$anio1</br>";
?>