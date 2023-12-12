<?php
/**
 * ENUNCIADO:
 * Crear un formulario de calculadora básica (suma, resta,
 * multiplicación, división). Utilizar el método POST para procesar los
 * datos y mostrar el resultado.
 */

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

    echo "<p>Resultado de la $operacion: $result</p>";
?>