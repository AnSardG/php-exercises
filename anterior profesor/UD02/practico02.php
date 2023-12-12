<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if (isset($_POST['nombre']) && isset($_POST['apellidos'])
        && isset($_POST['direccion']) && isset($_POST['poblacion'])
        && isset($_POST['sexo'])) {
        
        // Saneamos las cadenas recogidas por el POST con strip_tags y htmlspecialchars.
        $nombre = strip_tags($_POST['nombre']);
        $apellidos = strip_tags($_POST['apellidos']);
        $direccion = strip_tags($_POST['direccion']);
        $poblacion = strip_tags($_POST['poblacion']);   

        if (!isset($_POST['condiciones'])) {
            echo "No ha aceptado las condiciones.";
            // header("Location: http://localhost/UD03/practico02.html?error=condiciones");
            exit;
        }

        if (!preg_match('/^\d{5}-[A-Za-z]+$/', $poblacion)) {
            echo "El código postal es incorrecto.";
            // header("Location: http://localhost/UD03/practico02.html?error=poblacion");
            exit;
        }

        if($_POST['sexo'] == "masculino"){
            echo "Bienvenido " . $_POST["nombre"];
        } else {
            echo "Bienvenida " . $_POST["nombre"];
        }
    } else { 
        echo "No se han introducido todos los datos.";
        // header("Location: http://localhost/UD03/practico02.html?error=datos");
        exit;
    }
} else {
    header("Location: http://localhost/UD03/practico02.html");
    exit;
}

?>
