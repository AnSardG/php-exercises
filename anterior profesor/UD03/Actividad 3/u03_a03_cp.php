<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Caso práctico Unidad 03 Apartado 03</title>
</head>

<body>
    <h3>Validación datos usuario</h1>

        <body>
            <?php
            /**
             * Crea una sesión del usuario o reanuda la actual para mantener la información
             * del usuario a lo largo de múltiples solicitudes HTTP, lo que permite almacenar
             * datos en variables de sesión que persisten a lo largo de las páginas web.
             */
            session_start();
            
            /**
             * Si se ha recibido la variable de mensaje, mostrará el contenido de dicha variable,
             * ya sea un error o que el usuario no ha introducido algún dato.
             */            
            if (isset($_SESSION['mensaje'])) {
                $mensaje = strip_tags($_SESSION['mensaje']);
                echo "<h4>$mensaje</h4>";
            }
            ?>
            <form action="u03_a03_cp_valida.php" method="POST">
                Nombre: <input type="text" name="nombre" /><br />
                Apellidos: <input type="text" name="apellidos" /><br />
                Dirección: <input type="text" name="direccion" /><br />
                Población: <input type="text" name="poblacion" /><br />
                Género: Masculino <input type="radio" name="genero" value="masculino" />
                Femenino <input type="radio" name="genero" value="femenino" /><br />
                He leído y acepto las condiciones de la página web
                <input type="checkbox" name="acepto" /><br />
                <input type="submit" value="Enviar">
            </form>
        </body>

</html>