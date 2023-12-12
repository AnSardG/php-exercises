<?php

$texto = "Hola que tal la ola.";
$primeraLetra=substr($texto, 0, 1);
$ultimaLetra=substr($texto, -2, 1);
echo "Texto: $texto</br>";
echo "Primera letra es: <b>$primeraLetra</b>.</br>";
echo "La última letra es: <strong>$ultimaLetra</strong>.";
?>