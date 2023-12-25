<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 8</title>
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body class="bg-light d-flex align-items-center justify-content-center" style="height: 100vh;">
    <!-- 
        ENUNCIADO:
        8. Desarrollar un formulario que solicite un nombre de usuario y una
        contraseña. Verificar si el usuario y la contraseña coinciden (pueden
        ser valores predefinidos en el código) usando el método POST. 
    -->

    <div class="container">        
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
            <div class="form-group">
                <label for="user">Usuario:</label>
                <input type="text" class="form-control" name="user" required/>
            </div>
            <div class="form-group">
                <label for="pass">Contraseña:</label>
                <input type="password" class="form-control" name="pass" required/>
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Comprobar</button>
        </form>

        <?php
        if (isset($_POST['submit'])) {
            $user = $_POST['user'];
            $pass = $_POST['pass'];
            if ($user === $pass) {
                echo "<div class='mt-3'>";
                echo "<div class='alert alert-success' role='alert'>";
                echo "El usuario y la contraseña concuerdan.";
                echo "</div>";
                echo "</div>";
            } else {
                echo "<div class='mt-3'>";
                echo "<div class='alert alert-danger' role='alert'>";
                echo "No concuerdan usuario y contraseña.";
                echo "</div>";
                echo "</div>";
            }
        }
        ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
