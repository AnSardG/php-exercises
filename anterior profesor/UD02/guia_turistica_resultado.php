<!DOCTYPE html>
<html>

<head>
    <title>Resultado</title>
</head>

<body>
    <?php
    // FUNCIONES:
    function sanea_str($str)
    {
        return strip_tags($str);
    }    

    /**
     * Damos la bienvenida al usuario con el nombre pasado desde el anterior PHP 
     * mediante un input "hidden".
     */
    echo "<h1>¡Bienvenido, " . sanea_str($_POST['nombre']) . "!</h1>";
    /**
     * Utilizaremos este array para deconstruir el acrónimo del país a su nombre completo.
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

    if (isset($_POST['pais']) && isset($_POST['ciudad'])) {
        /**
         * Saneamos ambos datos y obtenemos del array el nombre del país completo desde su código.
         */
        $pais = $paises[sanea_str($_POST['pais'])];
        $ciudad = sanea_str($_POST['ciudad']);

        echo "Has seleccionado la ciudad de $ciudad en $pais.";

        /**
         * La url estará siempre formada por "https://es.wikipedia.org/wiki/", a lo que añadiremos el 
         * nombre de ciudad detrás de la última contrabarra para que nos redireccione a la página correcta 
         * y de este modo no tengamos que almacenar decenas de enlaces en una matriz asociativa.
         */
        $url_wikipedia = 'https://es.wikipedia.org/wiki/' . $ciudad;
        echo "<p>Para obtener más información sobre $ciudad, visita <a href='$url_wikipedia' target='_blank'>la página de Wikipedia</a>.</p>";

    /**
     * En caso de que no se haya introducido ni país ni ciudad, se mostrará un mensaje de error y redireccionará a la página inicial.
     */
    } else {
        echo "No se ha seleccionado un país y una ciudad.";
        header("Location: http://localhost/UD03/guia_turistica_index.php");
        exit;
    }
    ?>
</body>

</html>