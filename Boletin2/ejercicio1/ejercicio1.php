<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>

    <?php
    /**
     * ENUNCIADO:
     * 1. Crear un formulario simple con campos de nombre y correo
     * electrónico. Al enviar el formulario, mostrar un mensaje de
     * bienvenida usando el método GET.
     */
    if (isset($_GET['nombre']) && isset($_GET['email'])) {
        $nombre = $_GET['nombre'];
        $correo = $_GET['email'];

        echo "<div class='container mt-3'>";
        echo "<div class='alert alert-success' role='alert'>";
        echo "Bienvenido <strong>$nombre</strong>. Su correo es: <strong>$correo</strong>";
        echo "</div>";
        echo "</div>";
    }

    ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>