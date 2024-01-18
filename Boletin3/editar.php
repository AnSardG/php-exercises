<?php
//Inicialización de la base de datos
try {
    $db = new PDO('mysql:host=localhost;dbname=dwes', 'user_dwes', 'userUSER2');
    //Configuramos el modo de error para que lance excepciones en lugar de warning.
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Error de conexión: ' . $e->getMessage();
}

//session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar</title>
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

<?php
//Verificamos  que se han enviado los datos en la página anterior, si no es así se redireccionará a la página anterior.
if($_SERVER["REQUEST_METHOD"] == "POST"){
    //Datos del producto que se ha seleccionado en el formulario anterior.
    $nombreCorto = $_POST['nombreCortoProducto'];
    $nombre = $_POST['nombreProducto'];
    $pvp = $_POST['pvpProducto'];
    $descripcion = $_POST['descProducto'];
} else {
    header("Location: listado.php");
    exit();
}

?>

<body>
    <h1>DESCRIPCIÓN DEL PRODUCTO SELECCIONADO</h1>
    <form action="actualizar.php" method="post">
        <label for="nombre"><b>Nombre: </b></label>
        <input type="text" name="nombre" id="nombre" placeholder="<?php echo $nombre?>">

        <label for="nombreCorto"><b>Nombre Corto: </b></label>
        <input type="text" name="nombreCorto" id="nombreCorto" placeholder="<?php echo $nombreCorto?>">

        <label for="pvp"><b>P.V.P.: </b></label>
        <input type="number" name="pvp" id="pvp" placeholder="<?php echo $pvp?>">

        <label for="descripcion"><b>Descripción: </b></label>
        <textarea id="descripcion" name="descripcion" required><?php echo $descripcion; ?></textarea>

        <input type="hidden" name="nombreCortoProducto" value="<?php echo $nombreCorto; ?>">
        <input type="hidden" name="pvpProducto" value="<?php echo $pvp; ?>">
        <input type="hidden" name="nombreProducto" value="<?php echo $nombre; ?>">
        <input type="hidden" name="descProducto" value="<?php echo $descripcion; ?>">

        <button type="submit">Actualizar</button>
        <button type="button" onclick="window.location.href='listado.php'">Cancelar</button>

    </form>

</body>

</html>