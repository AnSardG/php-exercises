<?php

/**
 * Reanudamos la sesión ya iniciada.
 */
session_start();

/**
 * Comprueba si no se ha introducido el nombre y pasa un mensaje de error
 * mediante la sesión al archivo anterior ("u03_a03_cp.php") con la 
 * función "header()".
 */
if (!isset($_POST['nombre'])) {
    $_SESSION['mensaje'] = "Debes rellenar el formulario";
    header("location:u03_a03_cp.php");

/**
 * Comprueba si algun campo del formulario está vacío o es nulo; en caso de cumplirse
 * dicha condición, se pasa un mensaje de error mediante la sesión al archivo anterior 
 * ("u03_a03_cp.php") con la función "header()".
 */
} elseif (
    empty($_POST['nombre']) ||
    empty($_POST['apellidos']) ||
    empty($_POST['direccion']) ||
    empty($_POST['poblacion']) ||
    empty($_POST['genero']) ||
    is_null($_POST['genero'])
) {    
    $_SESSION["mensaje"] = "Debes rellenar todos los campos del formulario";
    header("location:u03_a03_cp.php");

/**
 * Si no se han aceptado las condiciones de acceso, se pasa un mensaje de error
 * mediante la sesión al archivo anterior ("u03_a03_cp.php") con la función
 * "header()".
 */
} elseif (empty($_POST['acepto'])) {
    $_SESSION["mensaje"] = "Debes aceptar las condiciones de acceso";
    header("location:u03_a03_cp.php");

/**
 * Comprueba si la población no está formada de la siguiente forma: 5 digitos seguidos
 * de un guión y una palabra sin espacios, por ejemplo: 12345-Sevilla.
 * En caso de no coincidir, se pasará un mensaje de error mediante la sesión al archivo
 * anterior ("u03_a03_cp.php") con la función "header()".
 */
} elseif (!preg_match('/^[0-9]{5}-[A-Za-z]+$/', $_POST['poblacion'])) {
    $_SESSION["mensaje"] = "La población no sigue el formato establecido";
    header("location:u03_a03_cp.php");

/**
 * En caso de que haya pasado todos los filtros, se sanearán los datos con el método
 * "strip_tags()", se guardarán en variables de sesión y seguiremos a la siguiente página
 * ("u03_a03_cp_destino.php").
 */
} else {
    $nombre = strip_tags($_POST['nombre']);
    $apellidos = strip_tags($_POST['apellidos']);
    $genero = strip_tags($_POST['genero']);
    $_SESSION["nombre"] = $nombre;
    $_SESSION["apellidos"] = $apellidos;
    $_SESSION["genero"] = $genero;
    header("location:u03_a03_cp_destino.php");
}
