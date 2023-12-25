<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 7</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body class="bg-light d-flex align-items-center justify-content-center" style="height: 100vh;">
    <!-- 
        ENUNCIADO:
        7. Implementar un formulario que pida al usuario ingresar una serie
        de números separados por comas. Usar el método POST para procesar los datos y calcular la suma de los números. 
    -->

    <div class="container text-center">        
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
            <div class="form-group">
                <label for="numeros">Introduzca números separados por ",":</label>
                <input type="text" class="form-control" name="numeros" required />
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Sumar</button>
        </form>

        <?php
        if (isset($_POST['submit'])) {
            $numeros = preg_replace('/\s+/', '', $_POST['numeros']);
            $msj = "Compruebe que los números estén separados por \",\".";
            if (preg_match('/^\d+(\,\d+)*$/', $numeros)) {
                $numeros_separados = explode(",", $numeros);
                $suma = array_sum($numeros_separados);
                $msj = "La suma total de todos los números es: $suma";
            }
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
