<?php
//Inicialización de la base de datos
try {
    $db = new PDO('mysql:host=localhost;dbname=dwes', 'user_dwes', 'userUSER2');
    //Configuramos el modo de error para que lance excepciones en lugar de warning.
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Error de conexión: ' . $e->getMessage();
}

session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado</title>
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
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
        <label for="familias">Seleccione la familia: </label>
        <select name="seleccionado" id="familia">
            <?php
            $result = $db->query("SELECT DISTINCT COD FROM FAMILIA;");
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $cod_familia = $row['COD'];
                $result_nombre_familia = $db->query("SELECT NOMBRE FROM FAMILIA WHERE COD = '$cod_familia';")->fetch(PDO::FETCH_ASSOC);
                $nombre_familia = $result_nombre_familia['NOMBRE'];

                echo "<option value='$cod_familia'>$nombre_familia</option>";
            }
            ?>
        </select>
        <input type="submit" name="submit" value="Mostrar">
    </form>

    <?php
    if (isset($_POST['submit'])) {
        $seleccionado = $_POST['seleccionado'];

    ?>

        <h3>Listado de productos de la familia <?php echo $seleccionado ?>:</h3>
        <table>
            <tr>
                <th>Nombre</th>
                <th>P.V.P.</th>
            </tr>
            <?php

            $productosFamilia = $db->query("SELECT NOMBRE_CORTO, PVP, NOMBRE, DESCRIPCION, COD FROM PRODUCTO WHERE FAMILIA = (SELECT COD FROM FAMILIA WHERE COD = '$seleccionado');");

            while ($rowProducto = $productosFamilia->fetch(PDO::FETCH_ASSOC)) {
            ?>
                <tr>
                    <td>
                        <?php echo $rowProducto["NOMBRE_CORTO"] ?>
                    </td>
                    <td>
                        <?php echo $rowProducto["PVP"] ?>
                    </td>
                    <td>
                        <a href="editar.php?cod=<?php echo $rowProducto['COD'];?>">Editar</a>
                        <!-- <form method="post" action="editar.php">                            
                            <input type="hidden" name="nombreCortoProducto" value="<?php echo htmlspecialchars($rowProducto['NOMBRE_CORTO']); ?>">
                            <input type="hidden" name="pvpProducto" value="<?php echo htmlspecialchars($rowProducto['PVP']); ?>">
                            <input type="hidden" name="nombreProducto" value="<?php echo htmlspecialchars($rowProducto['NOMBRE']); ?>">
                            <input type="hidden" name="descProducto" value="<?php echo htmlspecialchars($rowProducto['DESCRIPCION']); ?>">
                            <input type="submit" value="Editar">
                        </form> -->
                    </td>
                </tr>
            <?php
            }
            ?>
        </table>

    <?php
    }
    ?>
</body>

</html>