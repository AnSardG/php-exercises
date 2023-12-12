<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actividad Guía Turística</title>
</head>
<body>
    <h1>Formulario</h1>
    <form action="guia_turistica.php" method="POST">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre">
        <br><br>
        <label for="pais">País:</label>
        <select id="pais" name="pais" required>
            <?php
            /**
             * Cargamos en un array todos los países con su acrónimo 
             * identificativo como clave.
             */
            $paises = array(
                'ES' => 'España',
                'FR' => 'Francia',
                'IT' => 'Italia',
                'DE' => 'Alemania',
                'UK' => 'Reino Unido',
                'PT' => 'Portugal',
                'NL' => 'Países Bajos',
                'BE' => 'Bélgica',
                'SE' => 'Suecia',
                'DK' => 'Dinamarca',
                'NO' => 'Noruega',
                'CH' => 'Suiza',
                'AT' => 'Austria'
            );

            /**
             * Recorremos todo este array y lo mostramos como opcion a cada país.
             */
            foreach ($paises as $codigo => $nombre) {
                echo "<option value='$codigo'>$nombre</option>";
            }
            ?>
        </select>
        <br><br>
        <input type="submit" value="Seleccionar País">
    </form>
</body>
</html>