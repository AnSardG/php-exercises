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
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background-color: #f4f4f4;
        }

        header {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 10px 0;
            margin-bottom: 20px;
        }

        form {
            margin-bottom: 20px;
            display: flex;
            align-items: center;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        label {
            margin-right: 10px;
        }

        select {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            cursor: pointer;
        }

        select:focus {
            outline: none;
            border-color: #4CAF50;
            box-shadow: 0 0 5px rgba(76, 175, 80, 0.7);
        }

        select option:checked {
            background-color: #4CAF50;
            color: white;
        }

        input[type="submit"],
        a {
            display: inline-block;
            text-decoration: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            color: #fff;
        }

        a {
            background-color: #007BFF;
            margin-left: 10px;
        }

        a:hover {
            background-color: #0056b3;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            border: none;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        footer {
            margin-top: auto;
        padding: 10px 0;
        background-color: #333;
        color: #fff;
        text-align: center;
        }


    </style>
</head>

<body>
    <header>
        <h1>Boletín 3</h1>
    </header>
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
        $nombreFamilia = $db->query("SELECT NOMBRE FROM FAMILIA WHERE COD = '$seleccionado';")->fetch(PDO::FETCH_COLUMN);

    ?>

        <h3>Listado de productos de la familia <?php echo $nombreFamilia ?>:</h3>
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

    <footer>
        <?php
            echo "© Antonio Sard González " . date("Y");
        ?>
    </footer>
</body>

</html>