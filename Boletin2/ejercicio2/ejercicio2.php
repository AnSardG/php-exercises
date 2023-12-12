<?php
/**
 * 2. Modificar el ejercicio anterior para usar el método POST en lugar de
 * GET. Acceder a los datos enviados desde el formulario y mostrar el
 * mensaje de bienvenida.
 */
$nombre = $_POST['nombre'];
$correo = $_POST['email'];

echo "Bienvenido $nombre. Su correo es: $correo";
?>