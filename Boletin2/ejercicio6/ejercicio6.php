<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 6</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body class="bg-light d-flex align-items-center justify-content-center" style="height: 100vh;">
    <!-- 
        ENUNCIADO: 
        6. Crear un formulario para cargar una imagen. Al enviar el formulario,
        permitir al usuario ver la imagen cargada utilizando el método POST. 
    -->
    
    <div class="container text-center">        
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
            <label for="peticion">Pulse para ver la imagen</label><br>
            <button type="submit" class="btn btn-primary" name="submit">Mostrar</button>
        </form>

        <?php
        // Cargamos la imagen desde un inicio y solo la mostraremos cuando se pida.
        $img = '<img src="https://comunidad.retorn.com/wp-content/uploads/cache/2018/09/gatitos/1583254719.jpg" style="max-width: 500px;">';
        if (isset($_POST['submit'])) {
            echo $img;
        }
        ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>