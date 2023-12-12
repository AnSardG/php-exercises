<!DOCTYPE html>
<html>

<head>
    <title>Guía Turística - Selección de Ciudad</title>
</head>

<body>
    <h1>Selecciona una Ciudad</h1>

    <?php
    // FUNCIONES: 

    /**
     * A esta función le pasaremos el pais y nos devolverá una matriz con las ciudades de dicho país.
     */
    function get_ciudades($pais)
    {
        /**
         * Guardamos las ciudades que queremos mostrar por cada país en un array asociativo.
         */
        $ciudades = array(
            'ES' => array('Madrid', 'Barcelona', 'Valencia', 'Sevilla', 'Málaga'),
            'FR' => array('París', 'Marsella', 'Lyon', 'Niza', 'Toulouse'),
            'IT' => array('Roma', 'Milán', 'Nápoles', 'Turín', 'Florencia'),
            'DE' => array('Berlín', 'Múnich', 'Hamburgo', 'Fráncfort', 'Colonia'),
            'UK' => array('Londres', 'Manchester', 'Birmingham', 'Glasgow', 'Liverpool'),
            'PT' => array('Lisboa', 'Oporto', 'Vila Nova de Gaia', 'Amadora', 'Braga'),
            'NL' => array('Ámsterdam', 'Róterdam', 'La Haya', 'Utrecht', 'Eindhoven'),
            'BE' => array('Bruselas', 'Amberes', 'Gante', 'Charleroi', 'Lieja'),
            'SE' => array('Estocolmo', 'Gotemburgo', 'Malmö', 'Uppsala', 'Västerås'),
            'DK' => array('Copenhague', 'Aarhus', 'Odense', 'Aalborg', 'Esbjerg'),
            'NO' => array('Oslo', 'Bergen', 'Trondheim', 'Stavanger', 'Drammen'),
            'CH' => array('Zúrich', 'Ginebra', 'Basilea', 'Berna', 'Lausana'),
            'AT' => array('Viena', 'Graz', 'Linz', 'Salzburgo', 'Innsbruck')
        );

        /**
         * Utilizamos el array asociativo para obtener solamente el array de las ciudades pertenecientes al país elegido por el usuario.
         */
        $ciudades = $ciudades[$pais];

        /**
         * Comprobamos que no sea nula esta matriz.
         */
        if ($ciudades !== null) {
            return $ciudades;
        } else {
            return 0;
        }
    }

    /**
     * Esta función comprueba si el nombre no contiene números y tampoco está vacío.
     */
    function comprueba_nombre($nombre)
    {
        return preg_match('/^[A-Z][a-zA-Z]*$/', $nombre);
    }

    /**
     * Creamos una función para sanear el código.
     */
    function sanea_str($str)
    {
        return strip_tags($str);
    }

    /**
     * Saneamos el nombre introducido con nuestra función.
     */
    $nombre = sanea_str($_POST['nombre']);

    /**
     * Mediante la función "is_numeric" comprobamos si el nombre NO es numérico; también 
     * comprobamos que el nombre no esté vacío.
     */
    if (comprueba_nombre($nombre)) {
        /**
         * Comprobamos que el país se haya seleccionado correctamente.
         */
        if (isset($_POST['pais'])) {
            $pais_seleccionado = $_POST['pais'];
            $ciudades = get_ciudades($pais_seleccionado);

    ?>

            <form action="guia_turistica_resultado.php" method="POST">
                <select name="ciudad">
                    <?php
                    /**
                     * Mediante un bucle iterativo mostramos las ciudades disponibles para la ciudad obtenida.
                     */
                    foreach ($ciudades as $ciudad) {
                        echo "<option value='$ciudad'>$ciudad</option>";
                    }
                    ?>
                </select>

                <!-- Le pasamos al siguiente php el pais y el nombre del usuario mediante un input hidden. -->
                <input type="hidden" name="pais" value="<?php echo $pais_seleccionado; ?>">
                <input type="hidden" name="nombre" value="<?php echo $nombre; ?>">
                <input type="submit" value="Seleccionar Ciudad">
            </form>

    <?php
        /**
         * En caso de que no haya elegido un país, se mostrará un mensaje de error y redireccionará al usuario a la primera página.
         */
        } else {
            echo "Por favor, selecciona un país primero.";
            header("Location: http://localhost/UD03/guia_turistica_index.php");
            exit;
        }

    /**
     * En caso de que sea numérico, se mostrará al usuario un mensaje de error y lo redirigirá a la primera página.
     */
    } else {
        echo "El nombre es un número. Por favor, ingresa un nombre válido.";
        header("Location: http://localhost/UD03/guia_turistica_index.php");
        exit;
    }

    ?>

    <!--
        
        FUNCIÓN DE COMPROBACIÓN DE NOMBRE EN JSP:

        <%@ page language="java" contentType="text/html; charset=UTF-8" pageEncoding="UTF-8"%>
        <%@ page import="java.util.regex.Pattern" %>

        <%
        String nombre = request.getParameter("nombre");

        boolean esValido = Pattern.matches("^[A-Z][a-zA-Z]*$", nombre);
        if (esValido) {
            out.println("El nombre es válido.");
        } else {
            out.println("El nombre no es válido.");
        }
        %>

        FUNCIÓN DE COMPROBACIÓN DE NOMBRE EN ASP:

        <%
        Function CompruebaNombre(nombre)
            Dim regex
            Set regex = New RegExp
            regex.Pattern = "^[A-Z][a-zA-Z]*$"
            
            If regex.Test(nombre) Then
                CompruebaNombre = "El nombre es válido."
            Else
                CompruebaNombre = "El nombre no es válido."
            End If
        End Function

        Dim nombre
        nombre = Request("nombre")

        Response.Write(CompruebaNombre(nombre))
        %>

    -->

    <!--
        FUNCIÓN DE OBTENCIÓN DE CIUDADES EN JSP:    

        <%@ page language="java" contentType="text/html; charset=UTF-8" pageEncoding="UTF-8" %>
        <%@ page import="java.util.HashMap" %>

        <%
        String pais = request.getParameter("pais");

        HashMap<String, String[]> ciudades = new HashMap<String, String[]>();
        ciudades.put("ES", new String[]{"Madrid", "Barcelona", "Valencia", "Sevilla", "Málaga"});
        ciudades.put("FR", new String[]{"París", "Marsella", "Lyon", "Niza", "Toulouse"});

        String[] ciudadesDelPais = ciudades.get(pais);

        if (ciudadesDelPais != null) {
            for (String ciudad : ciudadesDelPais) {
                out.println(ciudad + "<br>");
            }
        } else {
            out.println("País no encontrado o no tiene ciudades asociadas.");
        }
        %>

        FUNCIÓN DE OBTENCIÓN DE CIUDADES EN ASP:    

        <%
        Function GetCiudades(pais)
            Dim ciudades
            Set ciudades = CreateObject("Scripting.Dictionary")
            
            ciudades.Add "ES", Array("Madrid", "Barcelona", "Valencia", "Sevilla", "Málaga")
            ciudades.Add "FR", Array("París", "Marsella", "Lyon", "Niza", "Toulouse")
            
            If ciudades.Exists(pais) Then
                Dim ciudadesDelPais
                ciudadesDelPais = ciudades(pais)
                For Each ciudad In ciudadesDelPais
                    Response.Write(ciudad & "<br>")
                Next
            Else
                Response.Write("País no encontrado o no tiene ciudades asociadas.")
            End If
        End Function

        Dim pais
        pais = Request("pais")

        Call GetCiudades(pais)
        %>

    -->

</body>

</html>