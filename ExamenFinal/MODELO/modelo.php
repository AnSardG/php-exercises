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