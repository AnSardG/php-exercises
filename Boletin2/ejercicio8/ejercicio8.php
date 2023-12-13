<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 8</title>
</head>

<body>
    <!--
    ENUNCIADO:
        8. Desarrollar un formulario que solicite un nombre de usuario y una
        contraseña. Verificar si el usuario y la contraseña coinciden (pueden
        ser valores predefinidos en el código) usando el método POST.
    -->
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
        <label for="user">Usuario: </label>
        <input type="text" name="user" required/></br>
        <label for="pass">Contraseña: </label>
        <input type="password" name="pass" required/></br>
        <input type="submit" value="Comprobar" name="submit" />
    </form>

    <?php    
    if (isset($_POST['submit'])) {
        $user = $_POST['user'];
        $pass = $_POST['pass'];
        if($user === $pass){
            echo "El usuario y la contraseña concuerdan.";
        } else {
            echo "No concuerdan usuario y contraseña.";
        }
    }
    ?>
</body>

</html>