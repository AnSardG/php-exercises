<?php
    // Requerimos una vez la lógica y la configuración de la vista.
    require_once('./MODELO/modelo.php'); 
    require_once('./VISTA/config.php');   
    
    // Array para manipular el contenido dinámico del layout, con los valores
    // preestablecidos en la configuración de la vista como constantes.
    $data = array();
    $data['title'] = TITLE;
    $data['header'] = HEADER;    
    $data['body'] = BODY;
    $data['footer'] = FOOTER;

    if(isset($_GET['rol']) && $_GET['rol'] == 'cliente') {
        $data['body'] = "./VISTA/register.php";
    }


    // Requerimos el layout.
    require('./VISTA/LAYOUT/layout.php');    