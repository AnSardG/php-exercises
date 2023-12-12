<?php
/**
 * ENUNCIADO:
 * 5. Desarrollar un formulario que solicite la edad del usuario. Usar el
 * método POST y mostrar un mensaje indicando si el usuario es
 * mayor de edad o no.
 */

 $edad = $_POST['edad'];
 $msj = $edad < 18 ? "Usted es menor de edad." : "Es mayor de edad... +18";
echo $msj;
?>