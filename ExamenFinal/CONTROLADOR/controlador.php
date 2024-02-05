<?php
    require_once('./MODELO/modelo.php');

    $GLOBALS['title'] = "Restaurante XYZ";
    $GLOBALS['header'] = "./VISTA/header1.php";
    $GLOBALS['body'] = "./VISTA/vista.php";
    $GLOBALS['footer'] = "© " . date("Y") . " Restaurante XYZ. Todos los derechos reservados.";

    require('./VISTA/LAYOUT/layout.php');