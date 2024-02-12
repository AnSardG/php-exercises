<?php
require_once('config.php');
require_once('bbdd.php');

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

function insertCliente($email, $password) {
    $conexion = crear_conexion(DB_HOST, DB_USER_ADMIN, DB_PASSWORD_ADMIN, DB_NAME);
    consulta_base_de_datos("INSERT IGNORE INTO CLIENTES (CORREO, PASSWD) VALUES ('$email', '$password');", $conexion);
    cerrar_conexion($conexion);
}

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

function deleteBooking($fecha, $hora, $mesa) {
    $conexion = crear_conexion(DB_HOST, DB_USER_ADMIN, DB_PASSWORD_ADMIN, DB_NAME);
    consulta_base_de_datos("DELETE FROM RESERVAS WHERE FECHA = '$fecha' AND HORA = '$hora' AND MESA = '$mesa';", $conexion);
    cerrar_conexion($conexion);
}

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

function createBooking($fecha, $hora, $mesa, $descripcion, $user_email) {
    $conexion = crear_conexion(DB_HOST, DB_USER_ADMIN, DB_PASSWORD_ADMIN, DB_NAME);
    consulta_base_de_datos("INSERT INTO RESERVAS (FECHA, HORA, MESA, DESCRIPCION, CORREO_CLIENTE) VALUES ('$fecha', '$hora', $mesa, '$descripcion', '$user_email');", $conexion);
    cerrar_conexion($conexion);
}

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

function addUser($user, $password) {
    $conexion = crear_conexion(DB_HOST, DB_USER_ADMIN, DB_PASSWORD_ADMIN, DB_NAME);
    consulta_base_de_datos("INSERT IGNORE INTO EMPLEADOS (USUARIO, PASSWD) VALUES ('$user', '$password');", $conexion);
    cerrar_conexion($conexion);
}

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
