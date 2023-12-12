<?php
/**
 * ENUNCIADO:
 * 1. Crear un formulario simple con campos de nombre y correo
 * electrónico. Al enviar el formulario, mostrar un mensaje de
 * bienvenida usando el método GET.
 */
$nombre = $_GET['nombre'];
$correo = $_GET['email'];

echo "Bienvenido $nombre. Su correo es: $correo";

?>