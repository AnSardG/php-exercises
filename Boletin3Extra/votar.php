<h3>Listado de empleados:</h3>
<!-- Tabla para mostrar empleados -->
        <table>
            <tr>
                <th>DNI</th>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Candidato</th>
            </tr>
            <?php
            // Consulta para obtener todos los empleados
            $empleados = $db->query("SELECT DNI, NOMBRE, APELLIDOS, ES_CANDIDATO, VOTA_A FROM EMPLEADO;");

            // Recorremos los resultados y mostramos cada empleado en una fila de la tabla
            while ($rowEmpleado = $empleados->fetch(PDO::FETCH_ASSOC)) {
                $dni = $rowEmpleado["DNI"];
            ?>
                <!-- Fila de la tabla con información del empleado -->
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
                            // Mostrar "SÍ" si es candidato, "NO" si no lo es
                            if($rowEmpleado["ES_CANDIDATO"]){
                                echo "SÍ";
                            } else {
                                echo "NO";
                            } 
                        ?>
                    </td>
                    <td>
                        <?php
                            // Mostrar enlace para votar solo si no ha votado antes
                            if($rowEmpleado['VOTA_A'] == null){
                                
                                echo "<a href=\"index.php?dni=$dni\">VOTAR</a>";
                            }   
                        ?>                        
                    </td>
                </tr>
            <?php
            }
            ?>
        </table>