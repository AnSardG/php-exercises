<?php
/**
 * Reanudamos la sesión ya iniciada.
 */
session_start();

/**
 * En caso de que se haya tratado de acceder a esta página sin haber introducido
 * datos, volverá a la página de inicio con un mensaje de error pasado a través de 
 * la sesión.
 */
if(!isset($_SESSION['nombre'])) {
    $_SESSION["mensaje"]="Debes rellenar el formulario";
    header("location:u03_a03_cp.php");
}

/**
 * Volvemos a sanear los datos pasados por la variable de sesión y 
 * mostraremos un mensaje de bienvenida con la función echo, discerniendo
 * entre género masculino y femenino.
 */
else {
    $nombre=strip_tags($_SESSION['nombre']);
    $apellidos=strip_tags($_SESSION['apellidos']);
    $genero=strip_tags($_SESSION['genero']);
    $bienvenida=($genero=="masculino"?"Bienvenido, ":"Bienvenida, ");
    echo $bienvenida.$nombre." ".$apellidos;
}
?>
