<?php
function crear_conexion($servidor, $usuario, $password, $base_datos){
    try {
        $db = new PDO("mysql:host=$servidor;dbname=$base_datos", "$usuario", "$password");
        //Configuramos el modo de error para que lance excepciones en lugar de warning.
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    } catch (PDOException $e) {
        return 'Error de conexión: ' . $e->getMessage();
    }        
}

function cerrar_conexion(&$conexion) {
    $conexion = null;
}

function consulta_base_de_datos($consulta, $conexion){
    return $conexion->query($consulta);
}

function obtener_resultados($resultado){
    return $resultado->fetch(PDO::FETCH_ASSOC);
}