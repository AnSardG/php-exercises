<?php
//Inicialización de la base de datos
try {
    $db = new PDO('mysql:host=localhost;dbname=dwes', 'user_dwes', 'userUSER2');
    //Configuramos el modo de error para que lance excepciones en lugar de warning.
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Error de conexión: ' . $e->getMessage();
}

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
    <?php

        //Comprobamos si otras páginas nos han mandado información por get relevante.

        if(isset($_GET['err'])) {
            echo "<h2>Ha ocurrido un error a la hora de obtener el producto.</h2>";
        } else if (isset($_GET['modified'])){
            echo "<h2>No se modificó ningún dato</h2>";
        }
    ?>    
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
        <label for="familias">Seleccione la familia: </label>
        <select name="seleccionado" id="familia">
            <?php
            $result = $db->query("SELECT DISTINCT COD FROM FAMILIA;");
            //Recorremos todas las familias mediante la consulta de arriba con el método FETCH y de forma asociativa.
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
    //Una vez se haya seleccionado la familia buscamos el producto mediante el código seleccionado anteriormente.
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

            $productosFamilia = $db->query("SELECT NOMBRE_CORTO, PVP, COD FROM PRODUCTO WHERE FAMILIA = (SELECT COD FROM FAMILIA WHERE COD = '$seleccionado');");

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
                        <!-- Para evitar hacer un formulario dentro de otro, utilizamos un vínculo que redirija a la siguiente página
                        con el código dado por GET, lo que hay que tener cuidado y sanear dicho código al pasarse por GET en la próxima
                        página como veremos en "editar.php"-->
                        <a href="editar.php?cod=<?php echo $rowProducto['COD'];?>">Editar</a>
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