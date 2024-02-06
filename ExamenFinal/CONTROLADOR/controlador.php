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


    // Lógica de personal
    if(isset($_GET['rol']) && $_GET['rol'] == 'personal') {
        echo "TODO: LOGICA DEL PERSONAL";
    }

    // Requerimos el layout.
    require('./VISTA/LAYOUT/layout.php');   