<?php

/**
 * Reanudamos la sesión ya iniciada.
 */
session_start();

/**
 * Si las filas no se han introducido, pasará un mensaje de error mediante la sesión
 * y volverá al documento anterior ("u03_a04_cp.php") con el método "header()".
 */
if (!isset($_POST['filas'])) {
    $_SESSION["mensaje"] = "Debes introducir las filas y columnas";
    header("location:u03_a04_cp.php");
}

/**
 * Si algún dato de los formularios está vacío se pasará un mensaje de error
 * mediante la sesión y volverá al documento anterior ("u03_a04_cp.php") con el método
 * "header()".
 */
else {
    if (
        empty($_POST['filas']) ||
        empty($_POST['columnas']) ||
        empty($_POST['fila']) ||
        empty($_POST['columna'])
    ) {
        $_SESSION['mensaje'] = "Debes rellenar todos los datos";
        header("location:u03_a04_cp.php");
    }

    /**
     * Saneamos los datos recibidos, los almacenamos en variables y creamos
     * un array vacío para almacenar los resultados de la multiplicación.
     * Dicho array irá expandiendose en un bucle anidado, el bucle externo será 
     * para las filas introducidas y el interno para las columnas.
     * 
     * Dentro del bucle, se calcula el valor de cada celda de la tabla de multiplicación 
     * utilizando la fórmula ($i+1)*($j+1), que multiplica el valor de '$i' más uno por 
     * el valor de '$j' más uno. El resultado se almacena en cada posición de la matriz.
     */
    else {
        $filas = strip_tags($_POST['filas']);
        $columnas = strip_tags($_POST['columnas']);
        $fila = strip_tags($_POST['fila']);
        $columna = strip_tags($_POST['columna']);
        $tabla = array();
        for ($i = 0; $i < $filas; $i++) {
            for ($j = 0; $j < $columnas; $j++) {
                $tabla[$i][$j] = ($i + 1) * ($j + 1);
            }
        }

        /**
         * Dibujamos la tabla aplicando estilos embebidos para darle un borde con grosor,
         * por cada fila se utilizará la etiqueta "tr", y por cada columna la etiqueta
         * "td", dentro de esta última etiqueta irán los valores de la matriz de forma
         * parecida a la anterior ya analizada (bucle for anidado, uno para filas, otro para
         * columnas).
         */
        echo "<table style='border:3px solid blue;border-collapse:collapse'>";
        for ($i = 0; $i < $filas; $i++) {
            echo "<tr>";
            for ($j = 0; $j < $columnas; $j++) {
                echo "<td style='border:3px solid blue;width:30px;height:30px;'>";
                echo $tabla[$i][$j];
                echo "</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
        echo "<br/>";

        /**
         * Imprimimos con el método "echo" un encabezado con la fila y columna elegidas
         * por el usuario, y su valor. El valor se obtiene restandole a ambos índices 1 
         * ya que las posiciones comienzan desde 0.
         */
        echo "<h4>En la fila $fila columna $columna tenemos el valor: ";
        echo $tabla[$fila - 1][$columna - 1];
        echo "</h4>";
    }
}
