<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 4</title>
    <!-- Agregar enlaces a los estilos de Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body class="bg-light">
    <div class="container mt-5">
        <form action=<?php echo $_SERVER['PHP_SELF'] ?> method="POST">
            <div class="form-group">
                <label for="num1">Número 1:</label>
                <input type="number" class="form-control" name="num1" required>
            </div>

            <div class="form-group">
                <label for="operador">Operación:</label>
                <select class="form-control" name="operador" required>
                    <option value="suma">Suma</option>
                    <option value="resta">Resta</option>
                    <option value="multiplicacion">Multiplicación</option>
                    <option value="division">División</option>
                </select>
            </div>

            <div class="form-group">
                <label for="num2">Número 2:</label>
                <input type="number" class="form-control" name="num2" required>
            </div>

            <button type="submit" class="btn btn-primary">Calcular</button>
        </form>

        <?php
        /**
         * ENUNCIADO:
         * Crear un formulario de calculadora básica (suma, resta,
         * multiplicación, división). Utilizar el método POST para procesar los
         * datos y mostrar el resultado.
         */
        
        if (isset($_POST['num1']) && isset($_POST['num2']) && isset($_POST['operador'])) {
            $num1 = $_POST['num1'];
            $num2 = $_POST['num2'];
            $operador = $_POST['operador'];

            switch ($operador) {
                case 'suma':
                    $result = $num1 + $num2;
                    $operacion = 'Suma';
                    break;
                case 'resta':
                    $result = $num1 - $num2;
                    $operacion = 'Resta';
                    break;
                case 'multiplicacion':
                    $result = $num1 * $num2;
                    $operacion = 'Multiplicación';
                    break;
                case 'division':
                    $operacion = 'División';
                    if ($num2 != 0) {
                        $result = $num1 / $num2;
                    } else {
                        $result = 'Error al dividir por 0.';
                    }
                    break;
                default:
                    $result = 'Operación no válida';
                    $operacion = $_POST['operador'];
                    break;
            }

            echo "<div class='mt-3'>";
            echo "<div class='alert alert-info' role='alert'>";
            echo "Resultado de la $operacion: $result";
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