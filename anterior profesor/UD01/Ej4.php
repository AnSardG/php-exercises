<?php
$cadena = "esto es una cadena";
$palabras = explode(" ", $cadena);
sort($palabras);
$cadenaOrdenada = implode(" ", $palabras);
echo "<strong>Cadena original</strong>: $cadena</br>";
echo "<strong>Cadena reordenada alfabéticamente</strong>: $cadenaOrdenada";
?>