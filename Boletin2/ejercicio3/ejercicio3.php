<?php
/**
 * ENUNCIADO:
 * 3. Desarrollar un formulario que solicite un número. Al enviar el
 * formulario, mostrar la tabla de multiplicar de ese número usando el
 * método GET.
 */

 $numero = $_GET['number'];
 echo "Tabla de multiplicar del $numero:</br>";
 for ($i=1; $i <= 10 ; $i++) { 
    echo "$numero X $i = " . $numero * $i . "</br>";
 }

?>