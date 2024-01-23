<h3>Votaciones a candidatos</h3>

<!-- Formulario para mostrar votaciones y cerrar votación -->
<form action="<?php echo $_SERVER['PHP_SELF'] . "?result=true"?>" method="post">
    <!-- Tabla para mostrar resultados de votaciones -->
    <table>
        <tr>
            <th>DNI</th>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>Número de votos</th>
        </tr>
        <?php
        // Consulta para obtener empleados candidatos
        $empleadosCandidatos = $db->query("SELECT DNI, NOMBRE, APELLIDOS FROM EMPLEADO WHERE ES_CANDIDATO;");

         // Variable para verificar si hay al menos un voto
        $hayVoto = false;

         // Recorremos los resultados y mostramos cada empleado candidato en una fila de la tabla
        while ($rowEmpleado = $empleadosCandidatos->fetch(PDO::FETCH_ASSOC)) {
            $dni = $rowEmpleado["DNI"];

            // Consulta para obtener la cantidad de votos para cada candidato
            $cantidadVotos = $db->query("SELECT VOTA_A, COUNT(*) AS VOTOS FROM EMPLEADO WHERE VOTA_A = '$dni' GROUP BY VOTA_A;");
            $rowVotos = $cantidadVotos->fetch(PDO::FETCH_ASSOC);
        ?>
            <!-- Fila de la tabla con información del empleado candidato -->
            <tr>
                <td>
                    <?php echo $dni ?>
                </td>
                <td>
                    <?php echo $rowEmpleado["NOMBRE"] ?>
                </td>
                <td>
                    <?php echo $rowEmpleado["APELLIDOS"] ?>
                </td>
                <td>
                    <?php
                     // Verificamos si hay votos para el candidato actual
                    if (isset($rowVotos["VOTOS"])) {
                        $hayVoto = true;
                        echo $rowVotos["VOTOS"];
                    } else {
                        echo 0;
                    }
                    ?>
                </td>
                <td>
                    <!-- Enlace para votar al candidato -->
                    <a href="index.php?resultados=true">VOTAR CANDIDATO</a>
                </td>
            </tr>
        <?php
        }
        
        ?>
    </table>
    <br>
    <button class="button-danger" type="submit" value="CERRAR VOTACIÓN">CERRAR VOTACIÓN</button>
    <input type="hidden" name="hayVotos" value="<?php echo $hayVoto?>">
</form>