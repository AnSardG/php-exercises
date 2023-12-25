<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 3</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="get">
                    <div class="form-group">
                        <label for="number">Número:</label>
                        <input type="number" class="form-control" name="number" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </form>
            </div>
        </div>

        <?php
        /**
         * ENUNCIADO:
         * 3. Desarrollar un formulario que solicite un número. Al enviar el
         * formulario, mostrar la tabla de multiplicar de ese número usando el
         * método GET.
         */

        if (isset($_GET['number'])) {
            $numero = $_GET['number'];

            echo "<div class='container mt-3'>";
            echo "<h5>Tabla de multiplicar del $numero:</h5>";
            echo "<ul class='list-group'>";
            for ($i = 1; $i <= 10; $i++) {
                echo "<li class='list-group-item'>$numero X $i = " . $numero * $i . "</li>";
            }
            echo "</ul>";
            echo "</div>";
        }
        ?>

    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>