<?php
require_once('config.php');
require_once('bbdd.php');

function getFamilias() {
    //Conectamos con la base de datos y realizamos la consulta.
    $conexion = crear_conexion(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    $resultado = consulta_base_de_datos('SELECT DISTINCT NOMBRE, COD FROM FAMILIA;', $conexion);
    //Creamos un array de elementos para la capa de la vista
    $familias = array();
    while($fila = obtener_resultados($resultado)){
        $familias[] = $fila;
    }
    // Cerramos la conexión
    cerrar_conexion($conexion);
    return $familias;
}

function getCodFamilias() {
    //Conectamos con la base de datos y realizamos la consulta.
    $conexion = crear_conexion(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    $resultado = consulta_base_de_datos('SELECT DISTINCT COD FROM FAMILIA;', $conexion);
    $codigos = array();
    while($fila = obtener_resultados($resultado)){
        $codigos[] = $fila;
    }
    cerrar_conexion($conexion);
    return $codigos;
}

function getProductos($seleccionado) {
    $conexion = crear_conexion(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    $resultado = consulta_base_de_datos("SELECT NOMBRE_CORTO, PVP, COD FROM PRODUCTO WHERE FAMILIA = (SELECT COD FROM FAMILIA WHERE COD = '$seleccionado');", $conexion);
    $productos = array();
    while($fila = obtener_resultados($resultado)){
        $productos[] = $fila;
    }
    cerrar_conexion($conexion);
    return $productos;    
}

function getNombre($codigo){
    $conexion = crear_conexion(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    $resultado = consulta_base_de_datos("SELECT NOMBRE FROM FAMILIA WHERE COD = '$codigo';", $conexion);
    $nombre = obtener_resultados($resultado);
    cerrar_conexion($conexion);
    return $nombre['NOMBRE'];
}

function getDatosProducto($codigo){
    $conexion = crear_conexion(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    $resultado = consulta_base_de_datos("SELECT NOMBRE_CORTO, PVP, NOMBRE, DESCRIPCION FROM PRODUCTO WHERE COD = '$codigo' LIMIT 1;", $conexion);
    $producto = obtener_resultados($resultado);
    cerrar_conexion($conexion);
    return $producto;
}

function updateNombreCorto($nombre_corto, $codigo){
    $conexion = crear_conexion(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    consulta_base_de_datos("UPDATE PRODUCTO SET NOMBRE_CORTO = '$nombre_corto' WHERE COD = '$codigo'", $conexion);
    cerrar_conexion($conexion);
}

function updateNombre($nombre, $codigo){
    $conexion = crear_conexion(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    consulta_base_de_datos("UPDATE PRODUCTO SET NOMBRE = '$nombre' WHERE COD = '$codigo';", $conexion);
    cerrar_conexion($conexion);
}

function updatePvp($pvp, $codigo){
    $conexion = crear_conexion(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    consulta_base_de_datos("UPDATE PRODUCTO SET PVP = '$pvp' WHERE COD = '$codigo';", $conexion);
    cerrar_conexion($conexion);
}

function updateDescripcion($descripcion, $codigo){
    $conexion = crear_conexion(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    consulta_base_de_datos("UPDATE PRODUCTO SET DESCRIPCION = '$descripcion' WHERE COD = '$codigo';", $conexion);
    cerrar_conexion($conexion);
}
