<?php
// Comprobamos si el usuario no ha iniciado sesión aún, o lo ha intentado sin éxito.
if (!isset($_SESSION['logged_succesfully'])
    || (isset($_SESSION['logged_succesfully']) && !$_SESSION['logged_succesfully'])) {

    // Mostramos diferentes vistas dependiendo si recibimos por GET una información u otra.
    if (isset($_GET['login']) && $_GET['login'] == 'false') {
        $data['body'] = BODY_REGISTER;
    } else if (isset($_GET['login']) && $_GET['login'] == 'true') {
        $data['body'] = BODY_LOGIN;
    }

    // Procesamos el formulario de registro si se ha enviado.
    if (isset($_POST['register']) && $_SERVER['REQUEST_METHOD'] == "POST") {
        // Guardamos el correo y comprobamos si dicho correo se encuentra ya registrado en la base de datos.
        $email = $_POST['email'];
        $alreadyRegistered = isRegistered($email);

        // Si el correo no se encuentra en la base de datos se añade y redirige al usuario a login.
        if (!$alreadyRegistered) {
            $password = $_POST['password'];
            insertCliente($email, $password);
            header("Location: index.php?login=true");
        }
    }

    // Procesamos el formulario de inicio de sesión si se ha enviado.
    if (isset($_POST['login']) && $_SERVER['REQUEST_METHOD'] == "POST") {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Guardamos el correo y si el inicio de sesión se realizó con éxito en dos variables de sesión.
        $_SESSION['current_email'] = $email;
        $_SESSION['logged_succesfully'] = checkLoginCliente($email, $password);
        
        /**
         * Si el inicio de sesión es exitoso, redirigimos al usuario a la página principal.
         * De lo contrario, redirigimos de nuevo a la página de inicio de sesión con un indicador de error.
         */                
        if ($_SESSION['logged_succesfully']) {
            header("Location: index.php");
        } else {
            header("Location: index.php?login=true&wrong=");
        }
    }
} else {
    // Lógica cuando el cliente inicia sesión satisfactoriamente.

    // Modificamos las vistas correspondientes al header y al menú principal del usuario.
    $data['header'] = HEADER_LOGGED;
    $data['body'] = BODY_LOGGED;

    // Verificamos si se está gestionando una reserva.
    if ((isset($_POST['gestionar']) && $_SERVER['REQUEST_METHOD'] == "POST")
        || (isset($_GET['gestionar']) && $_SERVER['REQUEST_METHOD'] == "GET")) {
        // Obtenemos los datos de las reservas activas del cliente de la base de datos.
        $current_active_bookings = getActiveBookings($_SESSION['current_email']);

        // Introducimos la vista de las reservas activas con la información obtenida.
        $data['body'] = BODY_RESERVATION_GESTION;
    }

    // Verificamos si se está creando una nueva reserva.
    if ((isset($_POST['nueva']) && $_SERVER['REQUEST_METHOD'] == "POST")
        || (isset($_GET['nueva']) && $_SERVER['REQUEST_METHOD'] == "GET")) {    
        // Introducimos la vista de nueva reserva.                   
        $data['body'] = BODY_RESERVATION_NEW;
    }

    // Verificamos si se está accediendo al historial de reservas.
    if ((isset($_POST['historico']) && $_SERVER['REQUEST_METHOD'] == "POST")
        || (isset($_GET['historico']) && $_SERVER['REQUEST_METHOD'] == "GET")) {
        // Obtener datos del historial de reservas del cliente de la base de datos            
        $current_historic = getHistoryCliente($_SESSION['current_email']);

        // Introducimos la vista del histórico de reservas con la información obtenida.
        $data['body'] = BODY_RESERVATION_HISTORY;
    }
    

    // Lógica de cancelación de reserva.
    if (isset($_POST['cancelar'])) {
        deleteBooking($_POST['fecha'], $_POST['hora'], $_POST['mesa']);
        header("Location: index.php?gestionar=");
    }

    // Lógica para realizar una nueva reserva de cliente.
    if (isset($_POST['reservar'])) {
        // Guardamos los datos introducidos por el formulario y comprobamos si ya existe en la base de datos.
        $fecha_elegida = $_POST['fecha'];
        $hora_elegida = $_POST['hora'];
        $mesa_elegida = $_POST['mesa'];
        $descripcion = $_POST['descripcion'];
        $reservaExistente = checkReserva($fecha_elegida, $hora_elegida, $mesa_elegida);

        // En caso de que exista se redireccionará con un parámetro de error.
        if ($reservaExistente != null) {
            header("Location: index.php?nueva=&wrong=");
        } else {
            // Primero comprobamos si la descripción está vacía y posteriormente creamos la reserva nueva.
            if (trim($descripcion) == '') {
                $descripcion = NULL;
            }
            createBooking($fecha_elegida, $hora_elegida, $mesa_elegida, $descripcion, $_SESSION['current_email']);
        }
    }
}