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

    // Lógica de cliente  

    if(isset($_GET['login']) && $_GET['login'] == 'false') {
        $data['body'] = "./VISTA/register.php";                
    } else if (isset($_GET['login']) && $_GET['login'] == 'true') {
        $data['body'] = "./VISTA/login.php";        
    }

    if(isset($_POST['register']) && $_SERVER['REQUEST_METHOD'] == "POST") {
        $email = $_POST['email'];
        $alreadyRegistered = isRegistered($email);

        // Si el correo no se encuentra en la base de datos se añade y redirige al usuario
        // A login.
        if(!$alreadyRegistered) {
            $password = $_POST['password'];
            insertCliente($email, $password);
            header("Location: index.php?login=true");
        }
    }

    if(isset($_POST['login']) && $_SERVER['REQUEST_METHOD'] == "POST") {      
        $email = $_POST['email'];
        $password = $_POST['password'];
        $loggedSuccesfully = checkLoginCliente($email, $password);
    }

    // Lógica cuando el usuario cliente se logea.
    if(isset($loggedSuccesfully) && $loggedSuccesfully) {        
        $data['header'] = HEADER_LOGGED;
        $data['body'] = BODY_LOGGED;

        if((isset($_POST['gestionar']) && $_SERVER['REQUEST_METHOD'] == "POST") 
        || (isset($_GET['gestionar']) && $_GET['gestionar'])) {
            // TODO: Llamada y lógica de reservas activas
        }

        if((isset($_POST['nueva']) && $_SERVER['REQUEST_METHOD'] == "POST") 
        || (isset($_GET['nueva']) && $_GET['nueva'])) {
            // TODO: Llamada y lógica de nuevas reservas
        }

        if((isset($_POST['historico']) && $_SERVER['REQUEST_METHOD'] == "POST") 
        || (isset($_GET['historico']) && $_GET['historico'])) {
            // TODO: Llamada y lógica de histórico de reservas
        }
    }


    // Lógica de personal
    if(isset($_GET['rol']) && $_GET['rol'] == 'personal') {
        // TODO: Lógica entera del personal
    }

    // Requerimos el layout.
    require('./VISTA/LAYOUT/layout.php');   