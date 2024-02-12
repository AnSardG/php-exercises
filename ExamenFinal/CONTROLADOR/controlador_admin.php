<?php
// Comprobamos si tenemos la información por método GET del rol.
if (isset($_GET['rol']) && $_GET['rol'] == 'personal') {
    // Si es así, configuramos el encabezado para los empleados.
    $data['header'] = HEADER_ADMIN;

    // Verificamos si el empleado no ha iniciado sesión aún, o lo ha hecho insatisfactoriamente.
    if (!isset($_SESSION['admin_logged'])
    || (isset($_SESSION['admin_logged']) && !$_SESSION['admin_logged'])) {
        // Mostramos la vista del formulario de inicio de sesión.
        $data['body'] = BODY_LOGIN_ADMIN;

        // Procesamos si se ha enviado el formulario de inicio de sesión.
        if(isset($_POST['loginAdmin']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
            $user = $_POST['user'];
            $password = $_POST['password'];

            /**
             * Guardamos dos variables de sesión para mantener el empleado que 
             * ha iniciado sesión y si la ha iniciado satisfactoriamente.
             */
            $_SESSION['current_user'] = $user;
            $_SESSION['admin_logged'] = checkLoginAdmin($user, $password);
 
            /**
             * Si el empleado se ha registrado, lo redireccionamos a la página 
             * de inicio, en caso contrario obtendremos un mensaje de error.
             */
            if ($_SESSION['admin_logged']) {
                header("Location: index.php");
            } else {
                header("Location: index.php?rol=personal&wrong=");
            }
        }
    }
}

// Verificamos si el empleado ha iniciado sesión satisfactoriamente.
if(isset($_SESSION['admin_logged']) && $_SESSION['admin_logged']) {
    // Introducimos las vistas del encabezado y el menú del empleado.
    $data['header'] = HEADER_ADMIN;
    $data['body'] = BODY_MENU_ADMIN;    

    // Lógica para añadir un nuevo usuario.
    if((isset($_POST['addUser']) && $_SERVER['REQUEST_METHOD'] == "POST")) {
        // Introducimos la vista de creación de empleado nuevo.
        $data['body'] = BODY_ADD_USER;
    }

    // Procesamos el formulario para añadir un nuevo empleado si se ha enviado.
    if(isset($_POST['newUser']) && $_SERVER['REQUEST_METHOD'] == "POST") {  
        // Verificamos si el empleado ya está registrado en la base de datos. 
        $wrong = adminAlreadyRegistered($_POST['user']); 

        // Si el empleado ya está registrado, mostramos nuevamente el formulario de agregar empleado con un error.
        // De lo contrario, añadimos el nuevo empleado y redirigimos al empleado a la página de éxito.
        if($wrong) {
            $data['body'] = BODY_ADD_USER;
        } else {
            addUser($_POST['user'], $_POST['password']);
            header("Location: index.php?addUser=true");
        }
    }

    // Lógica para cancelar reservas.
    if (isset($_POST['cancelar'])) {
        deleteBooking($_POST['fecha'], $_POST['hora'], $_POST['mesa']);
    }

    // Lógica para filtrar las reservas por fecha.
    if(isset($_POST['filtrar']) && $_SERVER['REQUEST_METHOD'] == "POST") {
        $bookings_history = getBookingsByDate($_POST['fecha']);
        $data['body'] = BODY_VIEW_BOOKINGS;
    }

    // Lógica para visualizar las reservas.
    if(isset($_POST['viewBookings']) && $_SERVER['REQUEST_METHOD'] == "POST"
    || (isset($_GET['cancelar']))) {
        $bookings_history = getAllBookings();
        $data['body'] = BODY_VIEW_BOOKINGS;
    }                
    
    // Verificamos si no hay historial de reservas.
    $bookings_history_empty = !isset($bookings_history);
}


