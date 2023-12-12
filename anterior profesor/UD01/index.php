<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">    
    <title>Ejemplo 01</title>
</head>
<body>
    <p>
        <?php 
            $radio = 2;
            $longitud = 2 * M_PI * $radio;
            $superficie = M_PI * $radio ** 2;
            $volumen = 4/3 * M_PI * $radio ** 3;

            echo "<h1>Radio: $radio</h1>";
            echo "<h1>La longitud es: $longitud</h1>";
            echo "<h2>La superficie es: $superficie</h2>";
            echo "<h3>El volumen es: $volumen</h3>";
            echo "El número PI redondeado a 4 decimales sería: ",round(M_PI, 4),"</br>";

            echo "Fecha actual: " . date("d-m-Y") . "</br>";
            echo "Fecha y hora actual: " . date("d-m-Y\th:i:s") . "</br>";
            echo "Hoy es: ".date("l").", ".date("d")." de ".date("F")
            ." de ".date("Y")."</br>";
        ?>  
    </p>    
</body>
</html>