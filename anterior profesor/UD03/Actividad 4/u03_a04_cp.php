<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Caso práctico Unidad 03 Apartado 04</title>
</head>

<body>
    <h3>Creación de tabla</h1>

        <body>
            <?php
            /**
             * Crea una sesión del usuario o reanuda la actual para mantener la información
             * del usuario a lo largo de múltiples solicitudes HTTP, lo que permite almacenar
             * datos en variables de sesión que persisten a lo largo de las páginas web.
             */
            session_start();

            /**
             * Si se ha recibido la variable de mensaje, primero se saneará y luego se 
             * mostrará el contenido de dicha variable, ya sea un error o que el usuario 
             * no ha introducido algún dato.
             */
            if (isset($_SESSION['mensaje'])) {
                $mensaje = strip_tags($_SESSION['mensaje']);
                echo "<h4>$mensaje</h4>";
            }
            ?>
            <p>Vamos a crear una tabla en HTML. Especifica cuántas filas
                y columnas quieres que tenga</p>
            <!-- Enviaremos el formulario mediante el método "post", y llamaremos al archivo
                "u03_a04_cp_tabla.php" al hacer click en "Enviar".
        -->
            <form action="u03_a04_cp_tabla_solucion.php" method="POST">
                Filas: <input type="number" name="filas" /><br />
                Columnas: <input type="number" name="columnas" /><br />
                <p>Especifica asimismo qué posición quieres mostrar aparte</p>
                Fila: <input type="number" name="fila" /><br />
                Columna: <input type="number" name="columna" /><br />
                <input type="submit" value="Enviar">
            </form>
        </body>

</html>