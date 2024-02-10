<?php
require_once('config.php');
require_once('bbdd.php');

function getClientes() {
    //Conectamos con la base de datos y realizamos la consulta.
    $conexion = crear_conexion(DB_HOST, DB_USER_ADMIN, DB_PASSWORD_ADMIN, DB_NAME);
    $resultado = consulta_base_de_datos("SELECT * FROM CLIENTES;", $conexion);
    $clientes = array();
    while($fila = obtener_resultados($resultado)){
        $clientes[] = $fila;
    }
    cerrar_conexion($conexion);
    return $clientes;    
}

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