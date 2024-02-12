<?php
// Requerimos una vez la lógica y la configuración de la vista.
require_once('./MODELO/modelo.php');
require_once('./VISTA/config.php');
session_start();

/**
 * Array para manipular el contenido dinámico del layout, con los valores
 * preestablecidos en la configuración de la vista como constantes (consultar en './VISTA/config.php').
 */

$data = array();
$data['title'] = TITLE;
$data['header'] = HEADER;
$data['body'] = BODY;
$data['footer'] = "&copy; " . date('Y') ." Restaurante XYZ. Todos los derechos reservados.";

// En caso de que el usuario haya cerrado sesión, ajustamos las variables de sesión en consecuencia.
if (isset($_GET['logout'])) {
    $_SESSION['logged_succesfully'] = false;
    $_SESSION['admin_logged'] = false;
}

/**
 * Solo cuando se reciba el parámetro 'rol=personal' por GET o la variable de sesión 
 * que controla si el empleado ha iniciado sesión es verdadera, introducimos el controlador
 * que se encarga del administrador. En otro caso, se introducirá el controlador del cliente.
 */
if (isset($_GET['rol']) && $_GET['rol'] == 'personal' 
|| isset($_SESSION['admin_logged']) && $_SESSION['admin_logged']) {
    require('./CONTROLADOR/controlador_admin.php');
} else {
    require('./CONTROLADOR/controlador_cliente.php');
}

// Requerimos el layout.
require('./VISTA/LAYOUT/layout.php');