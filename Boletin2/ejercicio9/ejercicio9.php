<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 9</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body class="bg-light d-flex align-items-center justify-content-center" style="height: 100vh;">
    <!-- 
        ENUNCIADO: 
        9. Crear un formulario que solicite una fecha de nacimiento. Calcular la
        edad del usuario y mostrarla utilizando el método POST. 
    -->

    <div class="container text-center">        
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
            <div class="form-group">
                <label for="birthday">Introduzca su fecha de nacimiento:</label>
                <input type="date" class="form-control" name="birthday" required/>
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Mostrar edad</button>
        </form>

        <?php
        if (isset($_POST['submit'])) {
            $birthday_year = date("Y", strtotime($_POST['birthday']));
            $today_year = date("Y", strtotime(date("Y-m-d")));
            if ($birthday_year > $today_year) {
                $mensaje = "Ha introducido una fecha errónea.";
            } else {
                $birthday_month = date("m", strtotime($_POST['birthday']));
                $today_month = date("m", strtotime(date("Y-m-d")));
                $birthday_day = date("d", strtotime($_POST['birthday']));
                $today_day = date("d", strtotime(date("Y-m-d")));

                //Restaremos un año al mes o al año dependiendo de las condiciones para ajustar la edad mostrada.
                if ($birthday_month > $today_month ) {
                    $birthday_year--;
                } else if ($today_month == $birthday_month && $birthday_day > $today_day) {
                    $today_year--;
                }
                $edad = $today_year - $birthday_year;
                $mensaje = "Edad del usuario: " . $edad;
            }
            echo "<div class='mt-3'>";
            echo "<div class='alert alert-info' role='alert'>";
            echo $mensaje;
            echo "</div>";
            echo "</div>";

            unset($_POST['submit']);
        }
        ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
