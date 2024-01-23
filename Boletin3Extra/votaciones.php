<h3>Empleados candidatos</h3>
    <!-- Tabla que muestra todos los empleados candidatos -->
        <table>
            <tr>
                <th>DNI</th>
                <th>Nombre</th>
                <th>Apellidos</th>
            </tr>
            
            <!-- Inicio del bucle para mostrar cada empleado candidato -->
            <?php
            // Consulta para obtener empleados candidatos
            $empleadosCandidatos = $db->query("SELECT DNI, NOMBRE, APELLIDOS FROM EMPLEADO WHERE ES_CANDIDATO;");

            // Recorremos los resultados y mostramos cada empleado candidato en una fila de la tabla
            while ($rowEmpleado = $empleadosCandidatos->fetch(PDO::FETCH_ASSOC)) {
            ?>
                <!-- Fila de la tabla con información del empleado candidato -->
                <tr>
                    <td>
                        <?php echo $rowEmpleado["DNI"] ?>
                    </td>
                    <td>
                        <?php echo $rowEmpleado["NOMBRE"] ?>
                    </td>
                    <td>
                        <?php echo $rowEmpleado["APELLIDOS"] ?>
                    </td>
                    <td>
                        <!-- Enlace para votar al candidato -->
                        <a href="index.php?resultados=true&candidato=<?php echo $rowEmpleado["DNI"]?>">VOTAR CANDIDATO</a>
                    </td>
                </tr>
            <?php
            }
            ?>
        </table>