<?php
require_once('config.php');
require_once('bbdd.php');

/**
 * Método para ejecutar una consulta que obtiene los clientes con el correo especificado
 * por parámetro y devuelve si están ya registrados o no.
 * 
 * @param string $email Email del cliente que está tratando de registrarse en la base de datos.
 * @return bool Si el cliente se encuentra ya registrado en la base de datos.
 */
function isRegistered($email) {
    $registered = false;
    $conexion = crear_conexion(DB_HOST, DB_USER_ADMIN, DB_PASSWORD_ADMIN, DB_NAME);
    $resultado = consulta_base_de_datos("SELECT CORREO FROM CLIENTES WHERE CORREO = '$email';", $conexion);
    if(obtener_resultados($resultado) != null) {
        $registered = true;
    }
    cerrar_conexion($conexion);
    return $registered;
}

/**
 * Método que recibe dos string por parámetro y se encarga de introducir dichos datos
 * como cliente a la base de datos.
 * 
 * @param string $email Email del cliente que se va a insertar a la base de datos.
 * @param string $password Correo del cliente que se va a insertar a la base de datos.
 * @return void
 */
function insertCliente($email, $password) {
    $conexion = crear_conexion(DB_HOST, DB_USER_ADMIN, DB_PASSWORD_ADMIN, DB_NAME);
    consulta_base_de_datos("INSERT IGNORE INTO CLIENTES (CORREO, PASSWD) VALUES ('$email', '$password');", $conexion);
    cerrar_conexion($conexion);
}

/**
 * Método que recibe dos string por parámetro y se encarga de comprobar si dichos
 * datos de cliente se encuentran en la base de datos o no, devolviendo dicho resultado.
 * 
 * @param string $email Email del cliente que se va a comprobar si se ha registrado en la base de datos.
 * @param string $password Contraseña del cliente que se va a comprobar si se ha registrado en la base de datos.
 * @return bool Existencia del cliente en la base de datos.
 */
function checkLoginCliente($email, $password) {
    $exists = false;
    $conexion = crear_conexion(DB_HOST, DB_USER_ADMIN, DB_PASSWORD_ADMIN, DB_NAME);
    $resultado = consulta_base_de_datos("SELECT * FROM CLIENTES WHERE CORREO = '$email' AND PASSWD = '$password';", $conexion);
    if(obtener_resultados($resultado) != null) {
        $exists = true;
    }
    cerrar_conexion($conexion);
    return $exists;    
}

/**
 * Método que recibe el correo del cliente por parámetro y se encarga de obtener todo
 * su histórico de reservas de la base de datos.
 * 
 * @param string $email Email del cliente del que se quiere obtener su histórico de reservas.
 * @return array|null Devuelve el historial de todas las reservas del cliente si tiene alguna, de lo contrario null.
 */
function getHistoryCliente($email) {
    $conexion = crear_conexion(DB_HOST, DB_USER_ADMIN, DB_PASSWORD_ADMIN, DB_NAME);
    $resultado = consulta_base_de_datos("SELECT FECHA, HORA, MESA, DESCRIPCION FROM RESERVAS WHERE CORREO_CLIENTE = '$email';", $conexion);
    while ($fila = obtener_resultados($resultado)) {
        $history[] = $fila;
    }
    cerrar_conexion($conexion);
    if(!isset($history)){
        $history = null;
    }
    return $history;
}

/**
 * Método que recibe el correo del cliente por parámetro y se encarga de obtener las
 * reservas que tiene activas (estas son las reservas del día actual en adelante) de la 
 * base de datos.
 * 
 * @param string $email Email del cliente del que se quiere obtener sus reservas activas.
 * @return array|null Devuelve un array de todas las reservas activas si hay alguna, de lo contrario null.
 */
function getActiveBookings($email) {
    $conexion = crear_conexion(DB_HOST, DB_USER_ADMIN, DB_PASSWORD_ADMIN, DB_NAME);
    $resultado = consulta_base_de_datos("SELECT FECHA, HORA, MESA, DESCRIPCION FROM RESERVAS WHERE CORREO_CLIENTE = '$email' AND FECHA>=CURDATE();", $conexion);
    while ($fila = obtener_resultados($resultado)) {
        $history[] = $fila;
    }
    cerrar_conexion($conexion);
    if(!isset($history)){
        $history = null;
    }
    return $history;
}

/**
 * Método que recibe los datos de una reserva, en cuanto a fecha, hora y mesa, y
 * procede a eliminar dicho registro de la base de datos.
 * 
 * @param string $fecha Fecha de la reserva que se desea eliminar.
 * @param string $hora Hora de la reserva que se desea eliminar.
 * @param int $mesa Mesa de la reserva que se desea eliminar.
 */
function deleteBooking($fecha, $hora, $mesa) {
    $conexion = crear_conexion(DB_HOST, DB_USER_ADMIN, DB_PASSWORD_ADMIN, DB_NAME);
    consulta_base_de_datos("DELETE FROM RESERVAS WHERE FECHA = '$fecha' AND HORA = '$hora' AND MESA = '$mesa';", $conexion);
    cerrar_conexion($conexion);
}

/**
 * Método que recibe los datos de una reserva, en cuanto a fecha, hora y mesa, y 
 * procede a comprobar si dicho registro se encuentra en la base de datos o no.
 * 
 * @param string $fecha Fecha de la reserva que se desea comprobar si existe.
 * @param string $hora Hora de la reserva que se desea comprobar si existe.
 * @param int $mesa Mesa de la reserva que se desea comprobar si existe.
 * @return array|null Devuelve un array asociativo con la reserva si existe, de lo contrario null.
 */
function checkReserva($fecha, $hora, $mesa) {
    $conexion = crear_conexion(DB_HOST, DB_USER_ADMIN, DB_PASSWORD_ADMIN, DB_NAME);
    $resultado = consulta_base_de_datos("SELECT FECHA, HORA, MESA FROM RESERVAS WHERE FECHA = '$fecha' AND HORA='$hora' AND MESA = '$mesa'", $conexion);
    while($fila = obtener_resultados($resultado)){
        $reserva[] = $fila;
    }
    cerrar_conexion($conexion);
    if(!isset($reserva)){
        $reserva = null;
    }
    return $reserva;
}

/**
 * Crea una reserva en la base de datos con la información proporcionada por parámetro.
 * 
 * @param string $fecha Fecha de la reserva a crear.
 * @param string $hora Hora de la reserva a crear.
 * @param int $mesa Número de mesa para la reserva a crear.
 * @param string $descripcion Descripción de la reserva a crear.
 * @param string $user_email Correo electrónico del usuario que realiza la reserva.
 * @return void
 */
function createBooking($fecha, $hora, $mesa, $descripcion, $user_email) {
    $conexion = crear_conexion(DB_HOST, DB_USER_ADMIN, DB_PASSWORD_ADMIN, DB_NAME);
    consulta_base_de_datos("INSERT INTO RESERVAS (FECHA, HORA, MESA, DESCRIPCION, CORREO_CLIENTE) VALUES ('$fecha', '$hora', $mesa, '$descripcion', '$user_email');", $conexion);
    cerrar_conexion($conexion);
}

/**
 * Verifica si las credenciales de inicio de sesión del empleado son válidas.
 * 
 * @param string $user Nombre de usuario del empleado a iniciar sesión.
 * @param string $password Contraseña del empleado a iniciar sesión.
 * @return bool Devuelve true si las credenciales son válidas, de lo contrario false.
 */
function checkLoginAdmin($user, $password) {
    $exists = false;
    $conexion = crear_conexion(DB_HOST, DB_USER_ADMIN, DB_PASSWORD_ADMIN, DB_NAME);
    $resultado = consulta_base_de_datos("SELECT * FROM EMPLEADOS WHERE USUARIO = '$user' AND PASSWD = '$password';", $conexion);
    if(obtener_resultados($resultado) != null) {
        $exists = true;
    }
    cerrar_conexion($conexion);
    return $exists;    
}

/**
 * Verifica si un empleado ya está registrado en la base de datos.
 * 
 * @param string $user Nombre de usuario del empleado a comprobar.
 * @return bool Devuelve true si el usuario ya está registrado, de lo contrario false.
 */
function adminAlreadyRegistered($user) {
    $registered = false;
    $conexion = crear_conexion(DB_HOST, DB_USER_ADMIN, DB_PASSWORD_ADMIN, DB_NAME);
    $resultado = consulta_base_de_datos("SELECT USUARIO FROM EMPLEADOS WHERE USUARIO = '$user';", $conexion);
    if(obtener_resultados($resultado) != null) {
        $registered = true;
    }
    cerrar_conexion($conexion);
    return $registered;
}

/**
 * Agrega un nuevo empleado a la base de datos de empleados.
 * 
 * @param string $user Nombre de usuario del nuevo empleado.
 * @param string $password Contraseña del nuevo empleado.
 * @return void
 */
function addUser($user, $password) {
    $conexion = crear_conexion(DB_HOST, DB_USER_ADMIN, DB_PASSWORD_ADMIN, DB_NAME);
    consulta_base_de_datos("INSERT IGNORE INTO EMPLEADOS (USUARIO, PASSWD) VALUES ('$user', '$password');", $conexion);
    cerrar_conexion($conexion);
}

/**
 * Obtiene todas las reservas almacenadas en la base de datos.
 * 
 * @return array|null Devuelve un array de todas las reservas si hay alguna, de lo contrario null.
 */
function getAllBookings() {
    $conexion = crear_conexion(DB_HOST, DB_USER_ADMIN, DB_PASSWORD_ADMIN, DB_NAME);
    $resultado = consulta_base_de_datos("SELECT * FROM RESERVAS;", $conexion);
    while ($fila = obtener_resultados($resultado)) {
        $history[] = $fila;
    }
    cerrar_conexion($conexion);
    if(!isset($history)){
        $history = null;
    }
    return $history;
}

/**
 * Obtiene todas las reservas para una fecha específica introducida por parámetro.
 * 
 * @param string $fecha Fecha para la cual se desean obtener las reservas.
 * @return array|null Devuelve un array de las reservas para la fecha dada si hay alguna, de lo contrario null.
 */
function getBookingsByDate($fecha) {
    $conexion = crear_conexion(DB_HOST, DB_USER_ADMIN, DB_PASSWORD_ADMIN, DB_NAME);
    $resultado = consulta_base_de_datos("SELECT * FROM RESERVAS WHERE FECHA = '$fecha';", $conexion);
    while ($fila = obtener_resultados($resultado)) {
        $history[] = $fila;
    }
    cerrar_conexion($conexion);
    if(!isset($history)){
        $history = null;
    }
    return $history;
}
