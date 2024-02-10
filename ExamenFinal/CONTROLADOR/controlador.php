<?php
    // Requerimos una vez la lógica y la configuración de la vista.
    require_once('./MODELO/modelo.php'); 
    require_once('./VISTA/config.php');       
    session_start();

    // Array para manipular el contenido dinámico del layout, con los valores
    // preestablecidos en la configuración de la vista como constantes.
    $data = array();
    $data['title'] = TITLE;
    $data['header'] = HEADER;    
    $data['body'] = BODY;
    $data['footer'] = FOOTER;  

    if(isset($_GET['logout'])){
        $_SESSION['logged_succesfully'] = false;
    }

    // Lógica de cliente  
    if(!isset($_SESSION['logged_succesfully']) 
    || (isset($_SESSION['logged_succesfully']) && !$_SESSION['logged_succesfully'])){

        if(isset($_GET['login']) && $_GET['login'] == 'false') {
            $data['body'] = "./VISTA/register.php";                
        } else if (isset($_GET['login']) && $_GET['login'] == 'true') {
            $data['body'] = "./VISTA/login.php";        
        }
    
        if(isset($_POST['register']) && $_SERVER['REQUEST_METHOD'] == "POST") {
            $email = $_POST['email'];
            $alreadyRegistered = isRegistered($email);
    
            // Si el correo no se encuentra en la base de datos se añade y redirige al usuario a login.
            if(!$alreadyRegistered) {
                $password = $_POST['password'];
                insertCliente($email, $password);
                header("Location: index.php?login=true");
            }
        }
    
        if(isset($_POST['login']) && $_SERVER['REQUEST_METHOD'] == "POST") {      
            $email = $_POST['email'];
            $password = $_POST['password'];            
            $_SESSION['current_email'] = $email;
            $_SESSION['logged_succesfully'] = checkLoginCliente($email, $password);
            if($_SESSION['logged_succesfully']) {
                header("Location: index.php");
            } else {                
                header("Location: index.php?login=true&wrong=");
            }            
        }
    } else {        
        // Lógica cuando el usuario cliente se logea.
        if((isset($_SESSION['logged_succesfully']) && $_SESSION['logged_succesfully'])) {        
            $data['header'] = HEADER_LOGGED;
            $data['body'] = BODY_LOGGED;                
            
            if((isset($_POST['gestionar']) && $_SERVER['REQUEST_METHOD'] == "POST")
            || (isset($_GET['gestionar']) && $_SERVER['REQUEST_METHOD'] == "GET")) {                   
                $current_active_bookings = getActiveBookings($_SESSION['current_email']); 
                $data['body'] = BODY_RESERVATION_GESTION;      
            }

            if((isset($_POST['nueva']) && $_SERVER['REQUEST_METHOD'] == "POST")
            || (isset($_GET['nueva']) && $_SERVER['REQUEST_METHOD'] == "GET")) {
                // TODO: Llamada y lógica de nuevas reservas                       
                $data['body'] = BODY_RESERVATION_NEW;
            }

            if((isset($_POST['historico']) && $_SERVER['REQUEST_METHOD'] == "POST") 
            || (isset($_GET['historico']) && $_SERVER['REQUEST_METHOD'] == "GET")) {
                // Obtener datos del historial de reservas del cliente de la base de datos            
                $current_historic = getHistoryCliente($_SESSION['current_email']);                

                // Mostrar los datos en el body de historico
                $data['body'] = BODY_RESERVATION_HISTORY;
            }
        }

        // Lógica de borrado de reserva
        if(isset($_POST['cancelar'])){                            
            deleteBooking($_POST['fecha'], $_POST['hora'], $_POST['mesa']);
            header("Location: index.php?gestionar=");
        }

        // Lógica de nueva reserva
        if(isset($_POST['reservar'])) {            
            $fecha_elegida = $_POST['fecha'];
            $hora_elegida = $_POST['hora'];
            $mesa_elegida = $_POST['mesa'];
            $descripcion = $_POST['descripcion'];

            $reservaExistente = checkReserva($fecha_elegida, $hora_elegida, $mesa_elegida);
            if($reservaExistente != null) {
                header("Location: index.php?nueva=&wrong=");
            } else {
                if(trim($descripcion) == ''){
                    $descripcion = NULL;
                }
                createBooking($fecha_elegida, $hora_elegida, $mesa_elegida, $descripcion, $_SESSION['current_email']);
            }
        }    

        // Lógica de personal
        if(isset($_GET['rol']) && $_GET['rol'] == 'personal') {
            // TODO: Lógica entera del personal
        }
    }    
   

    // Requerimos el layout.
    require('./VISTA/LAYOUT/layout.php');   