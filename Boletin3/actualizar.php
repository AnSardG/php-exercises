<?php
//Inicialización de la base de datos
try {
    $db = new PDO('mysql:host=localhost;dbname=dwes', 'user_dwes', 'userUSER2');
    //Configuramos el modo de error para que lance excepciones en lugar de warning.
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Error de conexión: ' . $e->getMessage();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        form {
            margin-bottom: 20px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<?php
    //En caso de que haya habido un problema a la hora de pasar el código por el formulario, devolvemos información
    //por GET a "listado.php".
    if(!isset($_POST['codProducto'])){
        header("Location: listado.php?err=no_cod");
    }

    $nombre_corto = $_POST['nombreCorto'];
    $nombre = $_POST['nombre'];
    $pvp = $_POST['pvp'];
    $descripcion = $_POST['descripcion'];

    //Saneamos de nuevo el código.
    $cod = htmlspecialchars($_POST['codProducto']);

    //Comprobamos que haya algo escrito en los diferentes campos y lo controlamos con una variable bool "$modified".
    $modified = false;
    if($nombre_corto != null || $nombre != null || $pvp != null || $descripcion != null){

        $modified = true;

        if($nombre_corto != null) {
            $db->query("UPDATE PRODUCTO SET NOMBRE_CORTO = '$nombre_corto' WHERE COD = '$cod';");        
        }
        if($nombre != null) {
            $db->query("UPDATE PRODUCTO SET NOMBRE = '$nombre' WHERE COD = '$cod';");
        }
        if($pvp != null) {
            $db->query("UPDATE PRODUCTO SET PVP = '$pvp' WHERE COD = '$cod';");
        }
        if($descripcion != null) {
            $db->query("UPDATE PRODUCTO SET DESCRIPCION = '$descripcion' WHERE COD = '$cod';");        
        }
    }    

    // En caso de que no haya sido modificado le pasaremos por GET la información a la página "listado.php"
    if(!$modified){
        header("Location: listado.php?modified=false");        
    } else {
        header("Location: listado.php");
    }
?>