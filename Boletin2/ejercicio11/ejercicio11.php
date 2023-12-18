<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 11</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        #agenda {
            margin-bottom: 20px;
        }
        #formulario {
            margin-top: 20px;
        }
        .advertencia {
            color: red;
        }
    </style>
</head>

<body>
    <!--
    11. Debes programar una aplicación para mantener una pequeña
    agenda en una única página web programada en PHP. La agenda
    almacenará únicamente dos datos de cada persona: su nombre y un
    número de teléfono. Además, no podrá haber nombres repetidos en
    la agenda. En la parte superior de la página web se mostrará el
    contenido de la agenda. En la parte inferior debe figurar un sencillo
    formulario con dos cuadros de texto, uno para el nombre y otro para
    el número de teléfono. Cada vez que se envíe el formulario:
    a. Si el nombre está vacío, se mostrará una advertencia.
    b. Si el nombre que se introdujo no existe en la agenda, y el
    número de teléfono no está vacío, se añadirá a la agenda.
    c. Si el nombre que se introdujo ya existe en la agenda y se indica
    un número de teléfono, se sustituirá el número de teléfono
    anterior.
    d. Si el nombre que se introdujo ya existe en la agenda y no se
    indica número de teléfono, se eliminará de la agenda la
    entrada correspondiente a ese nombre
-->

<?php
session_start();
if(empty($_SESSION['agenda'])){
    $_SESSION['agenda'] = [];
}

function mostrarAgenda($agenda) {
    echo '<div id="agenda">';
    echo '<h2>AGENDA</h2>';
    echo '<ul>';
    foreach ($agenda as $nombre => $telefono) {
        echo "<li>$nombre: $telefono</li>";
    }
    echo '</ul>';
    echo '</div>';
}

function mostrarAdvertencia($mensaje) {
    echo "<p class='advertencia'>$mensaje</p>";
}
?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $telefono = $_POST["telefono"];

    if (empty($nombre)) {
        mostrarAdvertencia("No ha introducido datos.");
    } else {
        // a. Verificar si el nombre ya existe en la agenda
        if (array_key_exists($nombre, $_SESSION['agenda'])) {
            // c. Si el nombre ya existe, actualizar o eliminar según corresponda
            if (empty($telefono)) {
                // d. Eliminar la entrada si no se proporciona un número de teléfono
                mostrarAdvertencia("Se ha eliminado el registro de $nombre.");
                unset($_SESSION['agenda'][$nombre]);
            } else {
                // c. Actualizar el número de teléfono
                $_SESSION['agenda'][$nombre] = $telefono;
            }
        } else {
            // b. Añadir a la agenda si el nombre no existe
            if (!empty($telefono)) {
                $_SESSION['agenda'][$nombre] = $telefono;
            }
        }
    }
}
?>

<?php mostrarAgenda($_SESSION['agenda']); ?>

<div id="formulario">
    <h3>NUEVA PERSONA</h3>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre">
        <br><br>
        <label for="telefono">Número de teléfono:</label>
        <input type="text" name="telefono" id="telefono">
        <br><br>
        <input type="submit" value="Registrar">
    </form>
</div>

</body>
</html>