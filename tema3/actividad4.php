<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de Stock</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        form {
            margin-bottom: 20px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>

    <?php
    // Conexión a la base de datos
    $servername = "localhost";
    $username = "user_dwes";
    $password = "userUSER2";
    $dbname = "dwes";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar la conexión
    if ($conn->connect_error) {
    ?>
        <p>Se ha producido el error:
            <?php echo $dwes->connect_error; ?>.
        </p>
    <?php
        exit();
    }

    // Obtener la lista de productos
    $sql = "SELECT COD, NOMBRE_CORTO FROM PRODUCTO";
    $result = $conn->query($sql);

    // Manejar el envío del formulario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Obtener el código del producto seleccionado
        $productoSeleccionado = $_POST["producto"];

        // Obtener el stock por tienda para el producto seleccionado
        $sqlStock = "SELECT TIENDA.NOMBRE AS TIENDA, STOCK.UNIDADES AS UNIDADES FROM STOCK, TIENDA
                        WHERE TIENDA.COD = STOCK.TIENDA
                        AND STOCK.PRODUCTO = '$productoSeleccionado'";

        /**
         * RESPUESTA CHAT GPT: 
         * SELECT T.NOMBRE AS TIENDA, 
         *      (SELECT UNIDADES FROM STOCK WHERE PRODUCTO = '$productoSeleccionado' AND TIENDA = T.COD) 
         *      AS UNIDADES FROM TIENDA T";
         */

        $resultStock = $conn->query($sqlStock);
    }

    // Cerrar la conexión
    //$conn->close();
    ?>

    <h2>Consulta de Stock</h2>

    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <label for="producto">Selecciona un producto:</label>
        <select name="producto">
            <?php
            // Mostrar la lista de productos en el cuadro de selección
            while ($row = $result->fetch_assoc()) {
            ?>
                <option value="<?php echo $row["COD"]; ?>">
                    <?php echo $row["NOMBRE_CORTO"]; ?>
                </option>
            <?php
            }
            ?>
        </select>
        <input type="submit" value="Consultar Stock">
    </form>

    <?php
    // Mostrar el stock si se ha enviado el formulario
    if ($_SERVER["REQUEST_METHOD"] == "POST" && $resultStock->num_rows > 0) {
    ?>
        <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
            <h3>Stock del producto seleccionado por tienda:</h3>
            <table>
                <tr>
                    <th>Tienda</th>
                    <th>Stock</th>
                    <th>Nuevo Stock</th>
                </tr>
                <?php
                while ($rowStock = $resultStock->fetch_assoc()) {
                ?>
                    <tr>
                        <td>
                            <?php echo $rowStock["TIENDA"] ?>
                        </td>
                        <td>
                            <?php echo $rowStock["UNIDADES"] ?>
                        </td>
                        <td>
                            <input type="number" name="nuevoStock[<?php echo $rowStock["TIENDA"] ?>]" value="<?php echo $rowStock["UNIDADES"] ?>" required>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </table>
            <input type="hidden" name="productoSeleccionado" value="<?php echo $productoSeleccionado; ?>">
            <input type="submit" name="actualizarStock" value="Actualizar Stock">
        </form>
    <?php
    }

    // Manejar el envío del formulario de actualización
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['actualizarStock'])) {        
        // Obtener el código del producto seleccionado
        $productoSeleccionado = $_POST["productoSeleccionado"];

        // Obtener el nuevo stock ingresado por el usuario para cada tienda
        $nuevoStockPorTienda = $_POST["nuevoStock"];

        // Iniciar una transacción para asegurar que todas las actualizaciones tengan éxito o ninguna
        $conn->begin_transaction();

        try {
            // Actualizar el stock en la base de datos para cada tienda
            foreach ($nuevoStockPorTienda as $tienda => $nuevoStock) {
                $sqlActualizarStock = "UPDATE STOCK SET UNIDADES = '$nuevoStock'
                           WHERE PRODUCTO = '$productoSeleccionado'
                           AND TIENDA = '$tienda'";
                $resultActualizarStock = $conn->query($sqlActualizarStock);

                // Verificar si la actualización fue exitosa
                if (!$resultActualizarStock) {
                    throw new Exception("Error al actualizar el stock: " . $conn->error);
                }
            }

            // Confirmar la transacción si todas las actualizaciones fueron exitosas
            $conn->commit();

            echo "<p>Stock actualizado correctamente.</p>";
        } catch (Exception $e) {
            // Revertir la transacción si hubo algún error
            $conn->rollback();
            echo "<p>Error al actualizar el stock: " . $e->getMessage() . "</p>";
        }
    }


    ?>

</body>

</html>