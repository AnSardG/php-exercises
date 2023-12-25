<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 5</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body class="bg-light d-flex align-items-center justify-content-center" style="height: 100vh;">
    <div class="container" style="max-width: 600px;">
        <form action=<?php echo $_SERVER['PHP_SELF'] ?> method="post">
            <div class="form-group">
                <label for="edad">Introduzca su edad:</label>
                <input type="number" class="form-control" name="edad" required>
            </div>
            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>

        <?php
        /**
         * ENUNCIADO:
         * 5. Desarrollar un formulario que solicite la edad del usuario. Usar el
         * método POST y mostrar un mensaje indicando si el usuario es
         * mayor de edad o no.
         */

        if (isset($_POST['edad'])) {
            $edad = $_POST['edad'];
            $msj = $edad < 18 ? "Usted es menor de edad." : "Es mayor de edad... +18";

            echo "<div class='mt-3'>";
            echo "<div class='alert alert-info' role='alert'>";
            echo $msj;
            echo "</div>";
            echo "</div>";
        }
        ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>