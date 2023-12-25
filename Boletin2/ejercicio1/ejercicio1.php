<?php
/**
 * ENUNCIADO:
 * 1. Crear un formulario simple con campos de nombre y correo
 * electrónico. Al enviar el formulario, mostrar un mensaje de
 * bienvenida usando el método GET.
 */
if(isset($_GET['nombre']) && isset($_GET['email'])){
    $nombre = $_GET['nombre'];
    $correo = $_GET['email'];
    
    echo "<div class='container mt-3'>";
    echo "<div class='alert alert-success' role='alert'>";
    echo "Bienvenido <strong>$nombre</strong>. Su correo es: <strong>$correo</strong>";
    echo "</div>";
    echo "</div>";
}

?>