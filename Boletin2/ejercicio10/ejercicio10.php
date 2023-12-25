<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 10</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body class="bg-light d-flex align-items-center justify-content-center" style="height: 100vh;">
    <div class="container text-center">
        <h2>Elige tu color favorito</h2>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="get">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="color" id="rojo" value="rojo">
                <label class="form-check-label" for="rojo">Rojo</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="color" id="azul" value="azul">
                <label class="form-check-label" for="azul">Azul</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="color" id="verde" value="verde">
                <label class="form-check-label" for="verde">Verde</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="color" id="morado" value="morado">
                <label class="form-check-label" for="morado">Morado</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="color" id="blanco" value="blanco">
                <label class="form-check-label" for="blanco">Blanco</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="color" id="negro" value="negro">
                <label class="form-check-label" for="negro">Negro</label>
            </div>
            </br></br>
            <button type="submit" class="btn btn-primary" name="submit">Elegir</button>
        </form>

        <?php
        /**
         * 10. Implementar un formulario que permita al usuario elegir su color
         * favorito de un conjunto de opciones. Al enviar el formulario,
         * mostrar un mensaje personalizado utilizando el método GET.
         */

        if (isset($_GET['color'])) {
            $color = $_GET['color'];
            echo "<div class='mt-3'>";
            echo "<div class='alert alert-info' role='alert'>";
            echo "El color elegido ha sido el $color.";
            echo "</div>";
            echo "</div>";
        } else {
            echo "<div class='mt-3'>";
            echo "<div class='alert alert-warning' role='alert'>";
            echo "No ha elegido ningún color.";
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