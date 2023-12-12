<?php
$numero =21;
echo "<h2>Con if else</h2>";
if ($numero == 0) {
    $mensaje = "es cero";
} else if ($numero % 2 == 0){
    $mensaje = "es par";
} else {
    $mensaje = "es impar";
}
echo "El número $numero $mensaje";
echo "<h2>Con ternario</h2>";
echo "El número $numero ".($numero % 2 == 0 ? "es par" : "es impar")."</br>";
?>