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
        6. Crear un formulario para cargar una imagen. Al enviar el
        formulario, permitir al usuario ver la imagen cargada utilizando el
        método POST.
    -->
    <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
        <label for="peticion">Pulse para ver la imagen</label></br>
        <input type="submit" value="Mostrar" name="submit"/>        
    </form>

    <?php
        //Cargamos la imagen desde un inicio y solo la mostraremos cuando se pida.
        $img = '<img src="https://comunidad.retorn.com/wp-content/uploads/cache/2018/09/gatitos/1583254719.jpg" style="max-width: 500px;">';
        if(isset($_POST['submit'])){
            echo $img;                  
        }
    ?>
</body>
</html>