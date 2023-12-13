<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 6</title>
</head>

<body>
    <!--
    ENUNCIADO:
        7. Implementar un formulario que pida al usuario ingresar una serie
        de números separados por comas. Usar el método POST para
        procesar los datos y calcular la suma de los números.
    -->
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
        <label for="numeros">Introduzca números separados por ",": </label>
        <input type="text" name="numeros" /></br>
        <input type="submit" value="Sumar" name="submit" />
    </form>

    <?php
    if (isset($_POST['submit'])) {
        $numeros = preg_replace('/\s+/', '', $_POST['numeros']);        
        $msj = "Compruebe que los números estén separados por \",\".";        
        if (preg_match('/\d((,\d))*/', $numeros, $matches)) {            
            $splitted_numeros = explode(",", $matches[0]);            
            $suma = 0;
            foreach ($splitted_numeros as $key => $value) {
                $suma += $value;
            }
            $msj = "La suma total de todos los números es: $suma";
        }
        var_dump($matches);
        echo $msj;
    }
    ?>
</body>

</html>