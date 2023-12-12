<?php
    $cantidad = $_POST['cantidad'];
    $unidadesDecimales = $_POST['unidadesDecimales'];
    $unidadesConversion = $_POST['unidadesConversion'];
    
    $resultado = convierte_medida($unidadesConversion, $cantidad, $unidadesDecimales);
    
    echo "La conversión de $cantidad $unidadesConversion a $unidadesDecimales es: $resultado $unidadesDecimales.";
    
    function convierte_medida($tipoUnidad, $cantidad, $unidadDecimal) {
        $factoresConversion = [
            "pulgadas" => ["centimetros" => 2.54, "metros" => 0.0254, "kilometros" => 2.54e-5],
            "pies" => ["centimetros" => 30.48, "metros" => 0.3048, "kilometros" => 0.0003048],
            "yardas" => ["centimetros" => 91.44, "metros" => 0.9144, "kilometros" => 0.0009144],
            "millas" => ["centimetros" => 160934, "metros" => 1609.34, "kilometros" => 1.60934]
        ];

        return $cantidad * $factoresConversion[$tipoUnidad][$unidadDecimal];
    }
?>  