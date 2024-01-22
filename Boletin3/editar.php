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
//Verificamos  que se han enviado los datos en la página anterior, si no es así se redireccionará de nuevo atrás.
if(!isset($_GET['cod'])){
    header("Location: listado.php?err=no_cod");
    exit();        
} 
//Saneamos el código ya que puede inyectarse código mediante el método GET.
$cod = htmlspecialchars($_GET['cod']);
$result = $db->query("SELECT NOMBRE_CORTO, PVP, NOMBRE, DESCRIPCION FROM PRODUCTO WHERE COD = '$cod' LIMIT 1;");

//Obtenemos los datos del producto seleccionado anteriormente.
$producto = $result->fetch(PDO::FETCH_ASSOC);
$nombreCorto = $producto['NOMBRE_CORTO'];
$nombre = $producto['NOMBRE'];
$pvp = $producto['PVP'];
$descripcion = $producto['DESCRIPCION'];
?>

<body>
    <!-- Mostramos la información con los valores ya puestos por defecto.-->
    <h1>DESCRIPCIÓN DEL PRODUCTO SELECCIONADO</h1>
    <form action="actualizar.php" method="post">
        <label for="nombre"><b>Nombre: </b></label>
        <input type="text" name="nombre" id="nombre" value="<?php echo $nombre?>">

        <label for="nombreCorto"><b>Nombre Corto: </b></label>
        <input type="text" name="nombreCorto" id="nombreCorto" value="<?php echo $nombreCorto?>">

        <label for="pvp"><b>P.V.P.: </b></label>
        <input type="number" name="pvp" id="pvp" value="<?php echo $pvp?>">

        <label for="descripcion"><b>Descripción: </b></label>
        <textarea id="descripcion" name="descripcion"><?php echo $descripcion; ?></textarea>

        <input type="hidden" name="codProducto" value="<?php echo $cod; ?>">        

        <!-- Si pulsamos en el botón de actualizar iremos a la página puesta en el atributo "action" de este formulario,
        sino, mediante el atributo "onclick" volveremos al listado de productos.-->
        <button type="submit">Actualizar</button>
        <button type="button" onclick="window.location.href='listado.php'">Cancelar</button>

    </form>

</body>

</html>